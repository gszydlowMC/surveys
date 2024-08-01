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
        'survey_id',
        'subscriber_id',
        'user_id',
        'token',
        'created_by',
        'created_at',
    ];

    protected $sortable = [
        'token',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function results()
    {
        return $this->hasMany(SurveyResult::class);
    }

    public function lastResult()
    {
        return $this->hasOne(SurveyResult::class)->orderByDesc('created_at')->limit(1);
    }
}

