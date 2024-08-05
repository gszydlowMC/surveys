<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SurveyResult extends Model
{
    use Sortable;

    public $timestamps = false;

    protected $table = 'survey_results';

    protected $fillable = [
        'survey_token_id',
        'survey_question_id',
        'value',
        'is_start',
        'is_end',
        'ip',
        'created_at',
        'updated_at',
    ];

    protected $sortable = [

    ];

    public function surveyToken()
    {
        return $this->belongsTo(SurveyToken::class, 'survey_token_id');
    }

    public function question()
    {
        return $this->belongsTo(SurveyQuestion::class, 'survey_question_id');
    }
}

