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
        'created_by',
        'created_at',
    ];

    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class, 'survey_id', 'id');
    }


}

