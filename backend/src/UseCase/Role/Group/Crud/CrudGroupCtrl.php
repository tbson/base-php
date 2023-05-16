<?php

namespace Src\UseCase\Role\Group\Crud;

use Illuminate\Http\Request;
use Src\Setting;
use Src\Util\ResUtil;
use Src\Controller;
use Src\Util\CtrlUtil;
use Src\Util\ListUtil;
use Src\Service\DbService;
use Src\Service\Role\GroupService;
use Src\Service\Role\PemService;
use Src\UseCase\Role\Group\Crud\CrudGroupPresenter;
use Src\UseCase\Role\Group\Crud\CrudGroupValidator;

/**
 * Class CrudGroupCtrl
 * @package Src\UseCase\Role\Group\CrudGroupCtrl
 */
class CrudGroupCtrl extends Controller {
    const SEARCH_FIELDS = ["uid", "value", "description"];
    public function list(Request $request) {
        $queryParam = $request->query();

        [$searchData, $orderData, $filterData, $pageSize] = CtrlUtil::parseQueryParams(
            $queryParam,
            self::SEARCH_FIELDS,
        );

        $flow = new CrudGroupFlow(new GroupService());
        $query = $flow->list();
        $searchFields = $searchData["fields"];
        $searchValue = $searchData["value"];

        $query = DbService::applySearch($query, $searchFields, $searchValue);
        $query = DbService::applyFilter($query, $filterData);
        $query = DbService::applyOrder($query, $orderData);
        $result = DbService::applyPaginate($query, $pageSize);

        $profileTypeOption = ListUtil::mapTopOptionList(Setting::PROFILE_TYPE_LABEL);
        $pemOption = PemService::getPemOptionList();
        $extra = [
            "profileTypeOption" => $profileTypeOption,
            "pemOption" => $pemOption,
        ];
        $response = CtrlUtil::formatPaginate($result, $extra);
        $response["items"] = CrudGroupPresenter::presentList($response["items"]);
        return ResUtil::res($response);
    }

    public function retrieve(Request $request, int $id) {
        $flow = new CrudGroupFlow(new GroupService());
        [$status, $result] = $flow->retrieve($id);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $item = $result;
        $response = CrudGroupPresenter::presentItem($item);
        return ResUtil::res($response);
    }

    public function create(Request $request) {
        $flow = new CrudGroupFlow(new GroupService());
        $attrs = $request->all();
        [$status, $result] = CrudGroupValidator::validate($attrs);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $attrs = $result;
        [$status, $result] = $flow->create($attrs);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $item = $result;
        $response = CrudGroupPresenter::presentItem($item);
        return ResUtil::res($response);
    }
    public function update(Request $request, $id) {
        $flow = new CrudGroupFlow(new GroupService());
        $attrs = $request->all();
        [$status, $result] = CrudGroupValidator::validate(
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
        $response = CrudGroupPresenter::presentItem($item);
        return ResUtil::res($response);
    }

    public function delete(Request $request, $id) {
        $flow = new CrudGroupFlow(new GroupService());
        [$status, $result] = $flow->delete($id);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $response = CrudGroupPresenter::presentDelete();
        return ResUtil::res($response);
    }
    public function deleteList(Request $request) {
        $flow = new CrudGroupFlow(new GroupService());
        $ids = $request->input("ids");
        $ids = array_map("intval", explode(",", $ids));
        [$status, $result] = $flow->deleteList($ids);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $response = CrudGroupPresenter::presentDelete();
        return ResUtil::res($response);
    }
}
