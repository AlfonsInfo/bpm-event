<?php

namespace App\Helper;
class RequestQueryMapper{
        public static function search($request, $query, $column){
        // Pencarian
            if ($request->has("search")) {
                $query->where(
                    $column, 
                    'like', 
                    '%' . $request->input("name") . '%'
                );
            }
        }


      public static function paginate($request, $query)
      {
        if ($request->has("page") && $request->has("per_page")) {
            $rowsPerPage = $request->input("per_page", 10);
            return $query->paginate($rowsPerPage);
        }
        return $query->paginate(10);
      }
    

}