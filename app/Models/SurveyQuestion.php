<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SurveyQuestion extends Model
{
    use Sortable;

    public $timestamps = false;

    protected $table = 'survey_questions';

    protected $fillable = [
        'survey_id',
        'field_type',
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

    public function options()
    {
        return $this->hasMany(SurveyQuestionOption::class, 'survey_question_id', 'id');
    }

    public function sectionsBefore()
    {
        return $this->hasMany(SurveySection::class, 'before_question_id', 'id');
    }
}

