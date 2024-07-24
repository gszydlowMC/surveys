<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class UserGroup extends Model
{
    use Sortable;

    protected $table = 'user_groups';

    protected $fillable = [
        'name'
    ];

    protected $sortable = [
        'name'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'user_group_id');
    }
}

