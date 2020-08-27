<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteDOM extends Model
{
    protected $table = 'websitedoms';
    public function website(){
        return $this->belongsTo(Website::class);
    }
}
