<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    
    public function user()
    //自分で決めた関数名を指定する
    {
        
        return $this->belongsTo('App\Models\User');

    }
}
