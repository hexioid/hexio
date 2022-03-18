<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $primaryKey = "id";
    protected $table = "content";


    public function contentType(){
        return $this->belongsTo('App\ContentType');
    }
    
    public function linkType(){
        return $this->belongsTo('App\LinkType');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
