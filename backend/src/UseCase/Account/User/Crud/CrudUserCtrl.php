<?php

namespace Src\UseCase\Account\User\Crud;

use Illuminate\Http\Request;
use Src\Setting;
use Src\Util\ResUtil;
use Src\Controller;
use Src\Util\CtrlUtil;
use Src\Util\ListUtil;
use Src\Service\DbService;
use Src\Service\Account\UserService;
use Src\UseCase\Account\User\Crud\CrudUserPresenter;
use Src\UseCase\Account\User\Crud\CrudUserValidator;

/**
 * Class CrudUserCtrl
 * @package Src\UseCase\Account\User\Crud\CrudUserCtrl
 */
class CrudUserCtrl extends Controller {
    const SEARCH_FIELDS = ["uid", "value", "description"];
    public function list(Request $request) {
        $queryParam = $request->query();

        [$searchData, $orderData, $filterData, $pageSize] = CtrlUtil::parseQueryParams(
            $queryParam,
            self::SEARCH_FIELDS,
        );

        $flow = new CrudUserFlow(new UserService());
        $query = $flow->list();
        $searchFields = $searchData["fields"];
        $searchValue = $searchData["value"];

        $query = DbService::applySearch($query, $searchFields, $searchValue);
        $query = DbService::applyFilter($query, $filterData);
        $query = DbService::applyOrder($query, $orderData);
        $result = DbService::applyPaginate($query, $pageSize);

        $profileTypeOption = ListUtil::mapTopOptionList(Setting::PROFILE_TYPE_LABEL);
        $extra = [
            "profileTypeOption" => $profileTypeOption,
        ];
        $response = CtrlUtil::formatPaginate($result, $extra);
        $response["items"] = CrudUserPresenter::presentList($response["items"]);
        return ResUtil::res($response);
    }

    public function retrieve(Request $request, int $id) {
        $flow = new CrudUserFlow(new UserService());
        [$status, $result] = $flow->retrieve($id);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $item = $result;
        $response = CrudUserPresenter::presentItem($item);
        return ResUtil::res($response);
    }

    public function create(Request $request) {
        $flow = new CrudUserFlow(new UserService());
        $attrs = $request->all();
        [$status, $result] = CrudUserValidator::validate($attrs);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $attrs = $result;
        [$status, $result] = $flow->create($attrs);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $item = $result;
        $response = CrudUserPresenter::presentItem($item);
        return ResUtil::res($response);
    }
    public function update(Request $request, $id) {
        $flow = new CrudUserFlow(new UserService());
        $attrs = $request->all();
        [$status, $result] = CrudUserValidator::validate(
            $attrs,
            Setting::CRUD_ACTION["UPDATE"],
        );
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $attrs = $result;
        [$status, $result] = $flow->update($id, $attrs);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $item = $result;
        $response = CrudUserPresenter::presentItem($item);
        return ResUtil::res($response);
    }

    public function delete(Request $request, $id) {
        $flow = new CrudUserFlow(new UserService());
        [$status, $result] = $flow->delete($id);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $response = CrudUserPresenter::presentDelete();
        return ResUtil::res($response);
    }
    public function deleteList(Request $request) {
        $flow = new CrudUserFlow(new UserService());
        $ids = $request->input("ids");
        $ids = array_map("intval", explode(",", $ids));
        [$status, $result] = $flow->deleteList($ids);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $response = CrudUserPresenter::presentDelete();
        return ResUtil::res($response);
    }
}
