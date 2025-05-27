<?php

namespace App\Http\Controllers\api;

use App\Helper\RequestQueryMapper;
use App\Helper\ResponseBuilder;
use App\Http\Requests\PaginatedRequest;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Exceptions\DataNotFoundException;
class EventController extends Controller
{
    
    public function get(PaginatedRequest $request)
    {
        $query = Event::query(); 
        RequestQueryMapper::search($request,$query,"name");
        return RequestQueryMapper::paginate($request,$query);
    }
    
    public function post(EventRequest $request)
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

    public function put(EventRequest $request, int $id)
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
            return Event::where('id', $id)->first() ?? throw new DataNotFoundException();
    }

    public function updateModel(EventRequest $request,Event $model){
        $model->name = $request->name;
        $model->start_date = $request->start_date;
        $model->end_date = $request->end_date;
        $model->event_type = $request->event_type;
        $model->event_scope = $request->event_scope;
        $model->event_category_id = $request->event_category_id;
    }    
    
    public function mapToModel(EventRequest $request): Event{
        $model = new Event();
        $model->name = $request->name;
        $model->start_date = $request->start_date;
        $model->end_date = $request->end_date;
        $model->event_type = $request->event_type;
        $model->event_scope = $request->event_scope;
        $model->event_category_id = $request->event_category_id;
        return $model;
    }    
}
