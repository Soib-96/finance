<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
     
     public function user(){

        return $this->BelongsTo('App\User');
    }
}
