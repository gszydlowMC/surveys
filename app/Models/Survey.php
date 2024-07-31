<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Survey extends Model
{
    use Sortable;

    protected $table = 'surveys';

    public $fillable = [
        'name',
        'description',
        'logo_path',
        'banner_path',
        'created_by',
        'created_at',
    ];

    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class, 'survey_id', 'id');
    }

    //sekcje ktore dodane zostaly na koncu i nie sa da zadnego pytania
    public function sections()
    {
        return $this->hasMany(SurveySection::class, 'survey_id', 'id')->whereNull('before_question_id');
    }


}

