<?php 

namespace App\Http\Controllers\api;

use App\Helper\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaginatedRequest;
use App\Http\Requests\PostUserRequest;
use App\Models\User;
use App\Helper\RequestQueryMapper;
class UserController extends Controller{


    // main method
    public function post(PostUserRequest $request){
        $user = self::mapToModel($request);
        $user->save();
        return ResponseBuilder::responseCreated();
    }

    public function get(PaginatedRequest $request, /**search request */) {
        $query = User::query();
        RequestQueryMapper::search($request,$query,"name");
        return RequestQueryMapper::paginate($request,$query);
    }

    public function put(){

    }

    public function delete(){

    }



    public function mapToModel(PostUserRequest $request): User{
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->wa_number = $request->waNumber;
        $user->is_activated = true;
        $user->email_verified_at = now();
        return $user;
    }    
}