<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $guarded=[]; //con esto se le dice a laravel que no guard; en el postControler ya se están requeriendo los campos


    public function user (){
    	return $this->belongsTo(User::class);
    } //a post belongs to a user (a user has many posts)
}
