<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];
    public $timestamps=false;
    public function website(){
        return $this->belongsTo(Website::class);
    }
    public function path(){
        return route('articles.show',$this);
    }
}
