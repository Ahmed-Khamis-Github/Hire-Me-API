<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Paddle\Billable;



class Company   extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,   Billable ;
    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'password',
        'email',
        'email_verified_at',
        'password',
        'title',
        'logo',
        'location',
        'about',
        'quantity',
        'linkedin_account',
		'mobile_number',


    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function jobs(){
        return $this->hasMany(Job::class) ;
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'reviews')->withPivot(['rating', 'title', 'comment', 'user_id', 'created_at']);
    }

    public function routeNotificationForVonage($notification)
    {
        return $this->mobile_number ;
    }

    public function socials()
    {
        return $this->hasMany(Social::class, 'company_id') ;
    }
	public function followers(){
        return $this->belongsToMany(Company::class,'followers');
    }
    public function isFollowed()
	{
		// Check if the authenticated user has bookmarked this job
		return $this->followers()->where('user_id', auth()->id())->exists();
	}
}
