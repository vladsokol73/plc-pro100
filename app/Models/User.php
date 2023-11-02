<?php

namespace App\Models;

//use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Database\Eloquent\Builder;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "slug",
        'email',
        "name",
        'password',
        "role",
        'on_home_page',
        'sorting'
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

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeHomePage(Builder $query) {
        $query->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(6);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (User $user) {
            $user->slug = $user->slug ?? str($user->email)->slug();
        });
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

//    public function sendPasswordResetNotification($token) {
//        $notification = new ResetPassword($token);
//        $notification->createUrlUsing(function ($user, $token) {
//            return url(route('user.password.reset', [
//                'token' => $token,
//                'email' => $user->email
//            ]));
//        });
//        $this->notify($notification);
//    }
}
