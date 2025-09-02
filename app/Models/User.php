<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    use SoftDeletes;
    use LogsActivity;

    // use HasPanelShield;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            /*
            // remove any previous roles
            $model->syncRoles([]);
            // add new role
            $model->assignRole($model->role);

            // get all permissions for the new role
            $permissions = Role::findByName($model->role)->permissions;
            // assign the new permissions to the user
            $model->syncPermissions([]);
            if ($permissions->isNotEmpty())
                $model->syncPermissions($permissions);

            // Check if password is present and not empty
            if (is_null($model->password)) {
                // Unset password so it won't be updated
                unset($model->password);
            }
            */

        });

    }

    /**
     * Allow user to comment
     * @return bool
     */
    public function canComment(): bool
    {
        // your conditional logic here
        return true;
    }

    /**
     * This function will make sure to log all fields in this model
     * @return \Spatie\Activitylog\LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }
}
