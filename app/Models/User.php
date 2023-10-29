<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
        'avatar',
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

    /*public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn() => 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' . $this->name
        );
    }*/

}
