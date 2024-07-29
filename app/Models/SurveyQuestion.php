<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SurveyQuestion extends Model
{
    use Sortable;

    protected $table = 'survey_questions';

    protected $fillable = [
        'survey_id',
        'filed_type',
        'label',
        'is_required',
        'is_last_on_site',
        'min_length',
        'max_length',
        'custom_rules',
        'default_value',
        'position',
    ];

    protected $sortable = [
    ];

}

