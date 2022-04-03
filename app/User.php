<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\LinkType;
use App\Content;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function vcards(){
        return $this->hasMany('App\Vcard', 'user_id');
    }

    public function singleVcard(){
        $data = $this->vcards;
        if(count($data) > 0){
            return $data[0];
        }else{
            return null;
        }
    }

    public function linkTypes(){
        return $this->belongsToMany(LinkType::class, 'content', 'id_user', 'link_type_id')->withPivot('total_clicked');
    }

    public function contents(){
        return $this->hasMany(Content::class, "id_user");
    }
}
