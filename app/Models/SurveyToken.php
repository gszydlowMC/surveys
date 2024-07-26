<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SurveyToken extends Model
{
    use Sortable;

    public $timestamps = false;

    protected $table = 'survey_tokens';

    protected $fillable = [
        'token',
    ];

    protected $sortable = [
        'token',
    ];
}

