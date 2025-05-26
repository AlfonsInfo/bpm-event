<?php
namespace App\Helper;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class ResponseBuilder
{
    public static function responseCreated()
    {
        return response()->noContent(201);
    }

    
    public static function responseDeleted()
    {
        return response()->noContent(200);
    }


    public static function responseCreatedNoContent()
    {
        return response()->noContent();
    }

    public static function responseGetById($array){
        return response()->json($array,200);
    }

    public static function responseUpdated($array){
        return response()->json($array,200);
    }
    

    //* Skema response 
    public static function responseFailed($message ,$status = 400, $header = []) : JsonResponse {
        //Default Response Schema
        $responseData = [
            "status" => false,
            "message" => $message
        ];

    // Membuat respons JSON dan mengembalikannya
    return response()->json($responseData, $status, $header); 
    }

}