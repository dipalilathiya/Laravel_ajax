<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbladmin extends Model
{
      public $table ='tbladmin';    
      public $fillable = ["name" ,"contact","email","password"];
}
