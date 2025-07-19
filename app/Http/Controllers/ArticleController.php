<?php

namespace App\Http\Controllers;

use App\Helper\ResponseBuilder;
use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function get(Request $request)
    {
        $query = Article::query();   
        return $query->get();
    }

    public function post(Request $request)
    {
        $data = self::mapToModel($request);
        $data->save();
        return ResponseBuilder::responseCreated();
    }

    public function getById(int $id)
    {
        $model = self::validateGetModelById($id);
        return ResponseBuilder::responseGetById($model->toArray()); 
    }

    public function put(Article $article)
    {
        $model = self::validateGetModelById($id);
        self::updatemodel($request,$model); 
        $model->save();
        return ResponseBuilder::responseUpdated($model->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }

    public function validateGetModelById(int $id){
        return Article::where('id', $id)->first() ?? throw new DataNotFoundException("Event Category Not Found");
    }

    public function updatemodel(Request $request){
        // $model-
    }

    public function mapToModel(Request $request){
        $model = new Article();
        return $model;
    }
}
