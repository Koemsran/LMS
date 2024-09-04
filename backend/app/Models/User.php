<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'leave_balance'
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
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public static function store($request, $id = null)
    {
        // Extract user data from the request
        $data = $request->only('name', 'email', 'password', 'leave_balance');

        // Hash the password if it is present in the request
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Handle profile image upload if present
        if ($request->hasFile('profile')) {
            $imageName = time() . '.' . $request->file('profile')->extension();
            $request->file('profile')->storeAs('public/images', $imageName);
            $data['profile'] = 'images/' . $imageName;
        }

        // Use updateOrCreate to either update existing record or create a new one
        $user = self::updateOrCreate(['id' => $id], $data);

        // Assign roles to the user if 'roles' are present in the request
        if ($request->has('roles')) {
            $roleIds = $request->input('roles');

            // Detach existing roles and assign new roles
            $user->roles()->sync($roleIds);
        }

        return $user;
    }
}
