<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    public function package(){
        return $this->belongsTo('App\Pricing','pricing_id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
