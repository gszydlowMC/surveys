<?php

namespace App\Repositories;

use App\Models\Survey;
use App\Models\SurveyEmail;

class SurveyRepository extends BaseRepository
{
    protected $model = Survey::class;

    public function getSurveysQuery()
    {
        $search = $request->search ?? '';
        $query = Survey::query()
            ->select(
                [
                    '*'
                ]
            );

        $query->whereNull('deleted_at');

        return $query;
    }
}
