<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Sortable;

    protected $fillable = [
        'company_name',
        'first_name',
        'email',
        'password',
        'user_group_id',
        'concession_id',
        'last_name',
        'phone',
        'password_valid',
        'password_last_changed',
        'token',
        'token_time',
        'last_login',
        'active',
        'is_reportable',
        'updated_at',
        'created_at'
    ];

    protected $sortable = [
        'id',
        'company_name',
        'first_name',
        'email',
        'password',
        'user_group_id',
        'concession_id',
        'last_name',
        'phone',
        'password_valid',
        'password_last_changed',
        'token',
        'token_time',
        'last_login',
        'active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function group()
    {
        return $this->belongsTo(UserGroup::class, 'user_group_id');
    }

    public function isAdmin(): bool
    {
        return $this->group->is_admin == 1;
    }

    public function isSuperAdmin(): bool
    {
        if ($this->group->is_admin == 1 && $this->is_superadmin) {
            return true;
        }
        return false;
    }
    public function isActive(): bool
    {
        return $this->active == 1;
    }

    public function sendPasswordResetNotification($token, $setPassword = false)
    {
        $this->notify(new PasswordReset($token, $setPassword));
    }
}
