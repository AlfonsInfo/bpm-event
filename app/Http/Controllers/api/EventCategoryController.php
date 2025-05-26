<?php

namespace App\Http\Controllers\api;

use App\Exceptions\DataNotFoundException;
use App\Helper\RequestQueryMapper;
use App\Helper\ResponseBuilder;
use App\Http\Requests\EventCategoryRequest;
use App\Http\Requests\PaginatedRequest;
use App\Models\EventCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{   
    public function get(PaginatedRequest $request){
        $query = EventCategory::query(); 
        RequestQueryMapper::search($request,$query,"name");
        return RequestQueryMapper::paginate($request,$query);
    }
    
    public function post(EventCategoryRequest $request)
    {
        $event = self::mapToModel($request);
        $event->save();
        return ResponseBuilder::responseCreated();
        //
    }

    public function getById(int $id)
    {
        $model = self::validateGetModelById($id);
        return ResponseBuilder::responseGetById($model->toArray());
    }

    public function put(EventCategoryRequest $request, int $id)
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
        return EventCategory::where('id', $id)->first() ?? throw new DataNotFoundException("Event Category Not Found");
    }

    public function updateModel(EventCategoryRequest $request,EventCategory $model){
        $model->name = $request->name;
        $model->description = $request->description;
    }    
    
    public function mapToModel(EventCategoryRequest $request): EventCategory{
        $model = new EventCategory();
        $model->name = $request->name;
        $model->description = $request->description;
        return $model;
    }    
}
