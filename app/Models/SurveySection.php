<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SurveySection extends Model
{
    use Sortable;

    protected $table = 'survey_sections';

    protected $fillable = [
        'survey_id',
        'before_question_id',
        'title',
        'description',
    ];

    protected $sortable = [
    ];

}

