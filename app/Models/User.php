<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $appends = ['tasks'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function scopeActive($qry)  {
        $qry->where('status',true);
    }

    public function UserRoles()
    {
        return $this->hasMany(UserRole::class);
    }
    public function Tasks()
    {
       return $this->hasMany(Task::class);
    }
    public function Roles()
    {
        return $this->hasManyThrough(Role::class,
                                     UserRole::class,
                                    'user_id',
                                     'id',
                                    'id',
                                     'id');
    }
    protected function getTasksAttribute()
    {
        return $this->with('Tasks');
    }
}
