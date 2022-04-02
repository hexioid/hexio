<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Vcard extends Model
{
    protected $primaryKey = "id";
    protected $table = "vcards";

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
