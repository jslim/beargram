<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache; //PARA LA CACHE

use App\User;

use Intervention\Image\Facades\Image; //despues de descargar intervention/images


class ProfilesController extends Controller
{
 public function index(User $user)
    {
    	// $user= User::findOrFail($user) ; //si no encuentra el usuario lanza una vista de error 404


        $follows=  ( auth()->user() ) ? auth()->user()->following->contains($user->id) : false;

        //determina si el usuario sigue el perfil.



        //---PASANDO LOS ATRIBUTOS DE CONTADOR DE POSTS, SEGUIDORES Y SEGUIDOS---///

        $postCount= Cache::remember(
            'count.posts.' . $user->id,
             now()->addSeconds(30),

              function() use($user){

                 return $user->posts->count();

         });


        $followersCount= Cache::remember(
            'count.followers.' . $user->id,
             now()->addSeconds(30),

              function() use($user){

                 return $user->profile->followers->count();

         });


        $followingCount= Cache::remember(
            'count.following.' . $user->id,
             now()->addSeconds(30),

              function() use($user){

                 return $user->following->count();

         });


        ///------///



        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }



    public function edit(User $user){ // no se necesario colocar \App\User completo ya que está en use

    	$this->authorize('update', $user->profile); //para proteger la vista y que solo puedan acceder a ella el usuario autenticado 


    	return view('profiles.edit', compact('user'));




    }


    public function update(User $user){

    	$this->authorize('update', $user->profile); //para proteger la vista y que solo puedan acceder a ella el usuario autenticado 


    	$data=request()->validate([

    		'title'=>'required',
    		'description'=>'required',
    		'url'=>'url',
    		'image'=>''


    	]);

    	
  
    	if(request('image')){

    	$imagePath= request('image')->store('profile','public'); //almacenando las imagenes a subir; se guarda en profile/app/public/uploads (crea profile)

		$image=Image::make(public_path("storage/$imagePath"))->fit(1000,1000); 
		$image->save();

		$imageArray=['image'=> $imagePath]; // para cuando no se suba una nueva imagen de perfil

    	} //si hay una nueva imagen de perfil


    	auth()->user()->profile->update(array_merge(

    		$data,
    		$imageArray ?? []

    	

    	)); //solo los autenticados pueden cambiar su propio perfil, reemplazando en el arreglo de $data el nuevo imagepath



    	return redirect("profile/{$user->id}");



    }








}
