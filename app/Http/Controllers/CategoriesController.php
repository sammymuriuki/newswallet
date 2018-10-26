<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use \Illuminate\Http\Response as Res;
use Validator;
use App\Category;
use App\Article;

class CategoriesController extends ApiController
{
    public function create(Request $request){
        $rules = array (
            'title' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator-> fails()){
            return $this->respondValidationError('Validation Failed.', $validator->errors());

        }else{
            try {
                $category = new Category();
                $category->title = $request->title;
                if($category->save()){
                        return $this->respondCreated("Category Created", $category);
                }
            }catch(\Exception $e){
                return $this->respondWithError("Creation failed:".$e->getMessage());
            }
        }

    }
    public function readSingle($id){
        $category = Category::where('id', $id)->get()->first();
        if(!($category)){
            return $this->respondNotFound();
        }else{
            $category->views++;
            $category->save();
           
            return $this->respond($category);
        }
    }
    public function readAll(){
        $categories = Category::get();
        if(!($categories)){
            return $this->respondNotFound();
        }else{
            $message= "Successful";
            return $this->respond($categories);
        }
    }
    public function readArticlesInThis($id){
        $category = Category::where('id', $id)->get()->first();
        if(!($category)) {
            return $this->respondNotFound("Category not found");
        }else{
            //get the articles in this
            //$articles = $category->articles(); 
            $articles = Article::where('category_id', $category->id)->get();
            if($articles->count()<1){
                return $this->respondNotFound("Articles not found");
            }else{
                return $this->respond($articles);
            }
            
        }
    }
    public function update(Request $request){
        $rules = array (
            'title' => 'required',
            'id' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator-> fails()){
            return $this->respondValidationError('Validation Failed.', $validator->errors());

        }else{
            try {
                $id= $request->id;
                $category = Category::where('id', $id)->get()->first();
                if(!($category)){
                    return $this->respondNotFound();
                }else{
                    $category->title = $request->title;
                    
                    if($category->save()){
                        return $this->respondCreated("Saved successfully", $category);
                    }else{
                        return $this->respondInternalError("There was an error.");
                    }
                }
            }catch(\Exception $e){
                return $this->respondWithError("Update failed:".$e->getMessage());
            }
        }
    }
    public function getPopular(){
        try{
            $categories = Category::orderby('views')->limit(5)->get();
            if(!($categories)){
                return $this->respondNotFound();
            }else{
                return $this->respond($categories);
            }  
        }catch(\Exception $e){
            return $this->respondInternalError("There was an error:".$e->getMessage());
        }
                 
    }
    public function delete($id){
        try{
            $category = Category::where('id', $id)->get()->first();
            //check if exists
            
            if(!($category)){
                return $this->respondNotFound();
            }else{
                if($category->delete()){
                    return $this->respondSuccessMessage("Deleted");
                }else{
                    return $this->respondWithError("Sorry. There was an error");
                }
            }
        }catch(\Exception $e){
            return $this->respondInternalError("Failed: ".$e->getMessage());
        }
        
    }
}
