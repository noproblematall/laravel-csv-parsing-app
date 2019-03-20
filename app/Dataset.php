<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    public function filelists(){
        return $this->hasMany('App\Filelist');
    }
}
