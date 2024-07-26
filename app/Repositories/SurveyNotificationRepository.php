<?php

namespace App\Repositories;

use App\Models\SurveyEmail;
use App\Models\SurveySms;

class SurveyNotificationRepository extends BaseRepository
{
    protected $model = SurveyEmail::class;

    public function getEmailsQuery()
    {
        $search = $request->search ?? '';
        $query = SurveyEmail::query()
            ->select(
                [
                    '*'
                ]
            );

        $query->whereNull('deleted_at');

        return $query;
    }

    public function getSmsQuery()
    {
        $search = $request->search ?? '';
        $query = SurveySms::query()
            ->select(
                [
                    '*'
                ]
            );

        $query->whereNull('deleted_at');

        return $query;
    }
}
