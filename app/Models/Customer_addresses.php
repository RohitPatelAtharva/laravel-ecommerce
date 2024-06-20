<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_addresses extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id','first_name','last_name','email','mobile','countries_id','address','apartment','state','city','zip'];
}
