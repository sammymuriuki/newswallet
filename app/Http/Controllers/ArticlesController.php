<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Response;
use \Illuminate\Http\Response as Res;
use Validator;
use App\Category;
use App\Article;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class ArticlesController extends ApiController
{
    public function create(Request $request){
        $rules = array (
            'title' => 'required',
            'website_name' => 'required',
            'webUrl' => 'required',
            'brief_description' => 'required',
            'category_id' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator-> fails()){
            return $this->respondValidationError('Validation Failed.', $validator->errors());

        }else{
            try {
                //see if category exists
                $categoryId = $request->category_id;

                $category = Category::where('id', $categoryId)->get()->first();
                if(!($category)){
                    return $this->respondNotFound("Sorry, that category is not there");
                }else{
                    $article = new Article();
                    $article->title = $request->title;
                    $article->website_name = $request->website_name;
                    $article->webUrl = $request->webUrl;
                    $article->brief_description = $request->brief_description;
                    $article->category_id = $request->category_id;
                    $article->author = $request->author;
                    //if it has an image 
                    if ($request->hasFile('image')) {
                    
                        $image= $request->file('image');
                        $image_name=time().".".$image->getClientOriginalExtension();
            
                        $image->move(public_path('articles/images/'), $image_name);
            
                        $article->image = $image_name;
                    }
                    if($article->save()){
                            return $this->respondCreated("Article Created", $article);
                    }
                }
                
            }catch(\Exception $e){
                return $this->respondWithError("Creation failed: ".$e->getMessage());
            }
        }

    }
    public function readSingle($id){
        $article = Article::where('id', $id)->get()->first();
        if(!($article)){
            return $this->respondNotFound();
        }else{
           $article->views++;
           $article->save();
            return $this->respond($article);
        }
    }
    public function readAll(){
        $articles = Article::get();
        if($articles->count()<1){
            return $this->respondNotFound();
        }else{
          
            return $this->respond($articles);
        }
    }
    
    public function update(Request $request){
        $rules = array (
            'title' => 'required',
            'website_name' => 'required',
            'webUrl' => 'required',
            'brief_description' => 'required',
            'category_id' => 'required',
            'id' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator-> fails()){
            return $this->respondValidationError('Validation Failed.', $validator->errors());

        }else{
            try {
                $id= $request->id;
                $article = Article::where('id', $id)->get()->first();
                if(!($article)){
                    return $this->respondNotFound();
                }else{
                    //get category 
                    $categoryId = $request->category_id;

                    $category = Category::where('id', $categoryId)->get()->first();
                    if(!($category)){
                        return $this->respondNotFound("Sorry, that category is not there");
                    }else{
                        $article->title = $request->title;
                        $article->website_name = $request->website_name;
                        $article->webUrl = $request->webUrl;
                        $article->brief_description = $request->brief_description;
                        $article->category_id = $categoryId;
                        $article->author = $request->author;
                        
                        if($article->save()){
                            return $this->respondCreated("Saved successfully", $article);
                        }else{
                            return $this->respondInternalError("There was an error.");
                        }
                    }
                   
                }
            }catch(\Exception $e){
                return $this->respondWithError("Update failed:".$e->getMessage());
            }
        }
    }
    public function getPopular(){
        try{
            $article = Article::orderby('views')->limit(5)->get();
            if(!($article)){
                return $this->respondNotFound();
            }else{
                return $this->respond($article);
            }  
        }catch(\Exception $e){
            return $this->respondInternalError("There was an error:".$e->getMessage());
        }
                 
    }
    public function delete($id){
        try{
            $article = Article::where('id', $id)->get()->first();
            //check if exists
            
            if(!($article)){
                return $this->respondNotFound();
            }else{
                if($article->delete()){
                    return $this->respondSuccessMessage("Deleted");
                }else{
                    return $this->respondWithError("Sorry. There was an error");
                }
            }
        }catch(\Exception $e){
            return $this->respondInternalError("Failed: ".$e->getMessage());
        }
        
    }
    public function paginate(){
        try{
            $articles = Article::paginate(1);
            if($articles->count()<1){
                return $this->respondNotFound();
            }else{
              
                return $this->respond($articles);
            }

        }catch(\Exception $e){
            return $this->respondInternalError("Failed: ".$e->getMessage());   
        }
    }
    public function getViews($id){
        $article = Article::where('id', $id)->get()->first();
        if(!($article)){
            return $this->respondNotFound();
        }else{
            $message = "Views found";
            return $this->respondSuccessMessage($message,$article->views);
        }
    }
}
