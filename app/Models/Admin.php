<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\{
    SoftDeletes
};
use Spatie\Activitylog\{
    Traits\LogsActivity,
    LogOptions
};


class Admin extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, SoftDeletes;

    use LogsActivity;

    use HasRoles;

    public static function boot()
    {
        parent::boot();
        // dd();
        static::saving(function ($model) {
            /*
             // remove any previous roles
             $model->syncRoles([]);
             // add new role
             $model->assignRole($model->role);

             // get all permissions for the new role
             $permissions = Role::where('name', $model->role)->first()->permissions;
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

    public function canAccessPanel(Panel $panel): bool
    {
        return true;//000 str_ends_with($this->email, '@start.com') && $this->hasVerifiedEmail();
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
}
