<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class) ;
    }

    public function category()
    {
        return $this->belongsTo(Category::class) ;
    }

    public function Apply()
    {
        return $this->belongsToMany(User::class,
        'job_user' ,
        'job_id' ,
        'user_id' ,
        'id' ,
        'id'
        ) ;

    }


    public function users(){
        return $this->belongsToMany(User::class,'bookmarks') ;
    }

    
    
}