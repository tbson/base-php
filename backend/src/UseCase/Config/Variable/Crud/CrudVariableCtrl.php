<?php

namespace Src\UseCase\Config\Variable\Crud;

use Illuminate\Http\Request;
use Src\Setting;
use Src\Util\ResUtil;
use Src\Controller;
use Src\Util\CtrlUtil;
use Src\Util\ListUtil;
use Src\Service\DbService;
use Src\Service\Config\VariableService;
use Src\UseCase\Config\Variable\Crud\CrudVariablePresenter;
use Src\UseCase\Config\Variable\Crud\CrudVariableValidator;

/**
 * Class CrudVariableCtrl
 * @package Src\UseCase\Config\Variable\CrudVariableCtrl
 */
class CrudVariableCtrl extends Controller {
    const SEARCH_FIELDS = ["uid", "value", "description"];
    public function list(Request $request) {
        $queryParam = $request->query();

        [$searchData, $orderData, $filterData, $pageSize] = CtrlUtil::parseQueryParams(
            $queryParam,
            self::SEARCH_FIELDS,
        );

        $flow = new CrudVariableFlow(new VariableService());
        $query = $flow->list();
        $searchFields = $searchData["fields"];
        $searchValue = $searchData["value"];

        $query = DbService::applySearch($query, $searchFields, $searchValue);
        $query = DbService::applyFilter($query, $filterData);
        $query = DbService::applyOrder($query, $orderData);
        $result = DbService::applyPaginate($query, $pageSize);

        $variableTypeOption = ListUtil::mapTopOptionList(Setting::VARIABLE_TYPE_LABEL);
        $extra = [
            "variableTypeOption" => $variableTypeOption,
        ];
        $response = CtrlUtil::formatPaginate($result, $extra);
        $response["items"] = CrudVariablePresenter::presentList($response["items"]);
        return ResUtil::res($response);
    }

    public function retrieve(Request $request, int $id) {
        $flow = new CrudVariableFlow(new VariableService());
        [$status, $result] = $flow->retrieve($id);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $item = $result;
        $response = CrudVariablePresenter::presentItem($item);
        return ResUtil::res($response);
    }

    public function create(Request $request) {
        $flow = new CrudVariableFlow(new VariableService());
        $attrs = $request->all();
        [$status, $result] = CrudVariableValidator::validate($attrs);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $attrs = $result;
        [$status, $result] = $flow->create($attrs);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $item = $result;
        $response = CrudVariablePresenter::presentItem($item);
        return ResUtil::res($response);
    }
    public function update(Request $request, $id) {
        $flow = new CrudVariableFlow(new VariableService());
        $attrs = $request->all();
        [$status, $result] = CrudVariableValidator::validate(
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
        $response = CrudVariablePresenter::presentItem($item);
        return ResUtil::res($response);
    }

    public function delete(Request $request, $id) {
        $flow = new CrudVariableFlow(new VariableService());
        [$status, $result] = $flow->delete($id);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $response = CrudVariablePresenter::presentDelete();
        return ResUtil::res($response);
    }
    public function deleteList(Request $request) {
        $flow = new CrudVariableFlow(new VariableService());
        $ids = $request->input("ids");
        $ids = array_map("intval", explode(",", $ids));
        [$status, $result] = $flow->deleteList($ids);
        if ($status === "error") {
            return ResUtil::err($result);
        }

        $response = CrudVariablePresenter::presentDelete();
        return ResUtil::res($response);
    }
}
