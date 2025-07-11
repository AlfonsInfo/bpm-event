<?php

namespace App\Http\Controllers\api;

use App\Exceptions\DataNotFoundException;
use App\Helper\RequestQueryMapper;
use App\Helper\ResponseBuilder;
use App\Http\Requests\GroupCellRequest;
use App\Http\Requests\PaginatedRequest;
use App\Http\Controllers\Controller;
use App\Models\GroupCell;

class GroupCellController extends Controller
{
    public function get(PaginatedRequest $request)
    {
        $query = GroupCell::query(); 
        RequestQueryMapper::search($request,$query,"name");
        return RequestQueryMapper::paginate($request,$query);
    }

    public function getList()
    {
        $query = GroupCell::query(); 
        return $query->get();
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
        $model->load('members');
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
