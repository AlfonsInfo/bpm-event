<?php

namespace App\Http\Controllers\api;

use App\Helper\RequestQueryMapper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginatedRequest;
use App\Models\GroupCell;
use App\Models\GroupCellHasMember;

class GroupCellHasMemberController extends Controller
{
    public function get(PaginatedRequest $request, int $groupCellId)
    {
        $query = GroupCell->find;

        RequestQueryMapper::search($request,$query,"name");
        return RequestQueryMapper::paginate($request,$query);
    }
    
    public function post(GroupCellRequest $request)
    {
        $event = self::mapToModel($request);
        $event->save();
        return ResponseBuilder::responseCreated();
    }

    public function getById(int $id)
    {
        $model = self::validateGetModelById($id);
        return ResponseBuilder::responseGetById($model->toArray());
    }

    public function put(GroupCellRequest $request, int $id)
    {      
        $model = self::validateGetModelById($id);
        self::updateModel($request,$model);
        $model->save();
        return ResponseBuilder::responseUpdated($model->toArray());
    }

    public function delete($id)
    {
        $model = self::validateGetModelById($id);
        $model->delete();
        return ResponseBuilder::responseDeleted();
    }

    public function validateGetModelById(int $id){
            return GroupCell::where('id', $id)->first() ?? throw new DataNotFoundException();
    }

    public function updateModel(GroupCellRequest $request,GroupCell $model){
        $model->name = $request->name;
        $model->description = $request->description;
    }    
    
    public function mapToModel(GroupCellRequest $request): GroupCell{
        $model = new GroupCell();
        $model->name = $request->name;
        $model->description = $request->description;
        return $model;
    }    
}
