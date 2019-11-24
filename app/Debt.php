<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = ['type','name','sum','description','purse_id','user_id'];

    public function user(){

        return $this->BelongsTo('App\User');
    }

    public function purse(){

        return $this->BelongsTo('App\Purse');
    }

}
