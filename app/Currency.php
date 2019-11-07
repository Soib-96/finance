<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';
    protected $fillable = ['name','icon'];

    public function purses(){

        return $this->hasMany('App\Purse');
    }

}
