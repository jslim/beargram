<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\Mail; //mandatory for sending mails

use App\Mail\NewUserWelcomeMail;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected static function boot(){

     parent::boot();

     static::created(function ($user){

        $user->profile()->create([

            'title'=> $user->username,

        ]); //dentro del create saldrá el titulo igual al username, el resto estará en blanco
            //para cuando se bootee el sistema (php artisan migrate:fresh), no lance errores porque el usuario aun no atributos de profile


            ///---SENDING MAIL WHEN USER IS CREATED---///

                Mail::to($user->email)->send(new NewUserWelcomeMail());


     });  

     


    } 



        public function posts (){
       return $this->hasMany(Post::class)->orderBy('created_at', 'DESC'); //para ordenar por orden en que fue creado
    } //a user has many posts



        public function following(){

            return $this->belongsToMany(Profile::class);
        }




        public function profile (){
       return $this->hasOne(Profile::class);
    } //a user has a profile


}
