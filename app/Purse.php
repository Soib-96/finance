<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purse extends Model
{
    protected $fillable = ['name','sum','currency'];

	public function user(){

        return $this->BelongsTo('App\User');
    }


    public function incomes(){

        return $this->hasMany('App\Income');
    }

}
