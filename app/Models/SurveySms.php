<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SurveySms extends Model
{
    use Sortable;

    protected $table = 'survey_sms';

    protected $fillable = [
        'survey_token_id',
        'to',
        'content',
        'sent_at',
        'response',
        'deleted_at',
        'created_by',
        'created_at',
        'updated_at',
    ];
}

