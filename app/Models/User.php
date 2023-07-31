<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'birthday',
        'img',
        'phone',
        'is_revisor',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birthday' => 'datetime',
    ];

    public function announcements() {
        return $this->hasMany(Announcement::class);
    }

    public function announcements_liked() {
        return $this->belongsToMany(Announcement::class);
    }

    public function announcementCount() {
        return Announcement::where('user_id', $this->id)->where('is_accepted', true)->count();
    }

    public static function toBeRevisionedCount(){
        return Announcement::where('is_accepted', null)->where('user_id', '!=', Auth::user()->id)->count();
    }
}
