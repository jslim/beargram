<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

		protected $guarded=[];


	public function profileImage(){

		$imagePath=($this->image) ? $this->image : 'profile/hLgXueUmVgmo6jzb3LItaa9kQlhqJdXsApr3yjS8.png';

		return '/storage/' . $imagePath;

	} //si hay imagen de perfil, la retorne, si no hay imagen de perfil (perfil recien creado) mande la imagen de no disponible


	public function followers(){

            return $this->belongsToMany(User::class);
        }



    public function user (){
    	return $this->belongsTo(User::class);
    } //a profile belongs to a user (a user has a profile)
}
