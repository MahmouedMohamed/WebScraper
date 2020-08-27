<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $guarded = [];
    public function articles(){
        return $this->hasMany(Article::class);
    }
    public function DOM(){
        return $this->hasOne(WebsiteDOM::class);
    }
}
