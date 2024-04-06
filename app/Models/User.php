<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'base_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'base_user_roles', 'role_id', 'user_id');
    }

    public function canAccess(string $routeName)
    {
        $routes = $this->routes();
        $matches = array_filter($routes, function($pattern) use ($routeName) {
            return fnmatch($pattern, $routeName);
        });

        return !empty($matches);
    }

    public function menus()
    {
        return $this->hasManyThrough(Menu::class, Role::class);
    }

    public function routes()
    {
        return DB::table('base_role_routes')
            ->select('base_role_routes.route_name')
            ->join('base_roles', 'base_roles.id','=','base_role_routes.role_id')
            ->join('base_user_roles','base_user_roles.role_id','=','base_roles.id')
            ->where('base_user_roles.user_id', $this->id)
            ->get()
            ->pluck('route_name')->toArray()
        ;
    }
}
