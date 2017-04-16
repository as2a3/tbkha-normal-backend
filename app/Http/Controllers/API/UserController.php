<?php

namespace App\Http\Controllers\API;

use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Display a facebook user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFacebookUser($accesstoken)
    {
      $userData=Socialite::driver('facebook')->userFromToken($accesstoken);
      return $this -> findOrCreateUser($userData);
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
      return $this -> getUser($id);
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


    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($facebookUser)
    {
      $token = JWTAuth::fromUser($facebookUser);
      $user = User::where('facebook_id', $facebookUser->getId())->first();
      if (!$user) {
        $url = 'https://graph.facebook.com/'.$socialUser->getId().'/picture?type=large';
        $id = DB::table('image')->insertGetId(array('url' => $url));
        $token = JWTAuth::fromUser($facebookUser);

        $user = User::create([
          'facebook_id' => $socialUser->getId(),
          'name' => $socialUser->getName(),
          'email' => $socialUser->getEmail(),
          'image_id' => $id,
        ]);
      }
      return $token;//$this -> getUser($user->id);
    }


}
