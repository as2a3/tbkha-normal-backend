<?php

namespace App\Http\Controllers\API;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $recipes_query = DB::table('recipe') -> get();
      $recipes = json_decode($recipes_query, true);
      return $this->showRecipes($recipes);
    }

    /**
     * Display a listing of the featured recipes.
     *
     * @return \Illuminate\Http\Response
     */
    public function featured()
    {
      $recipes_query = DB::table('recipe')
                  ->where('featured', '>', 0)
                  ->get();
      $recipes = json_decode($recipes_query, true);
      return $this->showRecipes($recipes);
    }

    /**
     * Display a listing of the category recipes.
     *
     * @param $categoryId
     * @return \Illuminate\Http\Response
     */
    public function getCategoryRecipes($categoryId)
    {
      $recipes_query = DB::table('recipe')
                  ->where('category_id', '=', $categoryId)
                  ->get();
      $recipes = json_decode($recipes_query, true);
      return $this->showRecipes($recipes);
    }

    /**
     * Display a listing of the user recipes.
     *
     * @param $userId
     * @return \Illuminate\Http\Response
     */
    public function getUserRecipes($userId)
    {
      $recipes_query = DB::table('recipe')
                  ->where('author_id', '=', $userId)
                  ->get();
      $recipes = json_decode($recipes_query, true);
      return $this->showRecipes($recipes);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this -> getRecipe($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
