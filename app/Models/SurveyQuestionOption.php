<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SurveyQuestionOption extends Model
{
    use Sortable;

    public $timestamps = false;

    protected $table = 'survey_question_options';

    protected $fillable = [
        'survey_question_id',
        'value',
        'label',
        'is_default',
        'position',
    ];

    protected $sortable = [
    ];

}

