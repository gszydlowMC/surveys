<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SurveyEmail extends Model
{
    use Sortable;

    protected $table = 'survey_emails';

    protected $fillable = [
        'survey_token_id',
        'view_blade_path',
        'to',
        'subject',
        'content',
        'input_data',
        'sent_at',
        'deleted_at',
        'created_by',
        'created_at',
        'updated_at',
    ];

    protected $sortable = [
    ];

    protected $casts = [
        'input_data' => 'array'
    ];


}

