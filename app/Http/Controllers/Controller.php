<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request as auth_request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//////////////////////////////// Image //////////////////////////////

    /**
     * Display an image.
     *
     * @return \Illuminate\Http\Response
     */
     public function getImage($id)
     {
       $image_query = DB::table('image')->where('id', $id)->first();

       $result = array ('id' => $image_query->id, 'url' => $image_query->url);
       return $result;
     }

//////////////////////////////// Category //////////////////////////////

    /**
     * Display a listing of categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories()
    {
      $categories_query = DB::table('category')->get();
      $categories = json_decode($categories_query, true);

      $result = array();
      foreach ($categories as $category) {
         array_push($result, $this -> getCategory($category['id']));
      }
      // return $result;
      return auth_request::header('Authorization');
    }


    /**
     * Display a category.
     *
     * @return \Illuminate\Http\Response
     */
     public function getCategory($id)
     {
       $category_query = DB::table('category')->where('id', $id)->first();
       $recipes_count = DB::table('recipe')->where('category_id', $category_query->id)->count();

       $category = array(
         'id' => $category_query->id,
         'name' => $category_query->name,
         'recipes' => $recipes_count,
         'thumbnail' => $this -> getImage($category_query->image_id));

       return $category;
     }


//////////////////////////////// Recipe //////////////////////////////

     /**
      * Display a listing of recipes.
      *
      * @param  array  $recipes
      * @return \Illuminate\Http\Response
      */
     public function showRecipes($recipes)
     {
       $result = array();
       foreach ($recipes as $recipe) {
         array_push($result, $this -> getRecipe($recipe['id']));
       }
       return $result;
     }


     /**
      * Display a recipe.
      *
      * @param $id
      * @return \Illuminate\Http\Response
      */
     public function getRecipe($id)
     {
       $recipe = DB::table('recipe')->where('id', $id)->first();
       $likes = DB::table('like')->where('recipe_id', '=', $recipe->id)->count();

       $isFeatured = false;
       if ($recipe->featured == 1) {
         $isFeatured = true;
       }

       $tempRecipe = array(
         'id' => $recipe->id,
         'status' => $recipe->status,
         'created' => strtotime($recipe->created_at),
         'name' => $recipe->name,
         'featured' => $isFeatured,
         'likes' => $likes,
         'description' => $recipe->description,
         'preparing' => $recipe->preparing,
         'serving' => $recipe->serving,
         'cover' => $this -> getImage($recipe->image_id),
         'category' => $this -> getCategory($recipe->category_id),
         'author' => $this -> getUser($recipe->author_id),
         'ingredients' => $this -> getIngredients($recipe->id),
         'steps' => $this -> getSteps($recipe->id));

       return $tempRecipe;
     }


     /**
      * Display a list of recipe ingredient.
      *
      * @param $recipe_id
      * @return \Illuminate\Http\Response
      */
     public function getIngredients($recipe_id)
     {
       $ingredients_query = DB::table('ingredient')->where('recipe_id', $recipe_id)->get();
       $ingredients = json_decode($ingredients_query, true);

       $result = array();
       foreach ($ingredients as $ingredient) {
         $tempIngredient = $ingredient['ingredient'];
          array_push($result, $tempIngredient);
       }
       return $result;
     }

     /**
      * Display a list of steps ingredient.
      *
      * @param $recipe_id
      * @return \Illuminate\Http\Response
      */
     public function getSteps($recipe_id)
     {
       $steps_query = DB::table('step')->where('recipe_id', $recipe_id)->get();
       $steps = json_decode($steps_query, true);

       $result = array();
       foreach ($steps as $step) {
         $tempStep;
         if ($step['image_id'] != null) {
           $tempStep = array('step' => $step['step'] , 'image' => $this -> getImage($step['image_id']));
         } else {
           $tempStep = array('step' => $step['step']);
         }
         array_push($result, $tempStep);
       }
       return $result;
     }

//////////////////////////////// User //////////////////////////////
     /**
      * Display a user.
      *
      * @param $id
      * @return \Illuminate\Http\Response
      */
     public function getUser($id)
     {
       $user_query = DB::table('users')->where('id', $id)->first();

       $user = array(
         'id' => $user_query->id,
         'name' => $user_query->name,
         'avatar' => $this -> getImage($user_query->image_id));

       return $user;
     }

}
