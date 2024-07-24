<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Subscriber extends Model
{
    use Sortable;

    protected $table = 'subscribers';

    protected $fillable = [
        'subscriber_group_name',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    protected $sortable = [
        'subscriber_group_name',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];
}

