<?php

namespace App\Http\Controllers;


use App\Post;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image; //despues de descargar intervention/images

use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{

	public function __construct(){

			$this->middleware('auth');

	} //colocado para que cada una de las rutas usadas por el controller, requieran authentification



	///---INDEX---///

	public function index(){

		$users= auth()->user()->following()->pluck('profiles.user_id'); //returns the user_id following



		$posts=Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5); //get all the posts of the users Im following, latest is for showing from the last post, showing first 5



		return view('posts.index', compact('posts'));


	} //show all of the posts of the profiles that we are following



	///---RECENT---///

	public function recent(){

		

		$recents=Post::latest()->paginate(5); //get all the posts  

		return view('posts.recent', compact('recents'));


	} //show all of the posts, most recent



	///---CREATE---///
	public function create(){
    	return view('posts/create'); //puede ser tambien post.create
	}


	///---STORE---///
	public function store(){

		$data= request()->validate([

			'caption'=> 'required',
			'image'=> ['required', 'image']

		]); //validacion requerida de caption y de image y que sea una imagen. 



		$imagePath= request('image')->store('uploads','public'); //almacenando las imagenes a subir; se guarda en storage/app/public/uploads (crea uploads)

		$image=Image::make(public_path("storage/$imagePath"))->fit(1200,1200); 
		$image->save();
		//todo proveniente de intervention image


		auth()->user()->posts()->create([

			'caption'=> $data['caption'],
			'image'=> $imagePath,

		]); //usa el usuario autenticado y crea el post, indicando a cual usuario pertenece (user_id) 

		
		return redirect('/profile/' .auth()->user()->id); //redireccionando al perfi una vez guardado
	}

	///---SHOW---///
	public function show(\App\Post $post){ //si se coloca de esta manera se recibe toda la data del post (modelo)


		return view('posts.show', compact('post') );


	}



}
