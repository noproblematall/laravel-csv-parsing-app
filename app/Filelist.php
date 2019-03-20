<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filelist extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function mydataset(){
        return $this->belongsTo('App\Dataset','dataset');
    }
}
