<?php

namespace App\Repositories;

use App\Models\SurveyEmail;
use App\Models\SurveySms;
use DB;

class SurveyNotificationRepository extends BaseRepository
{
    protected $model = SurveyEmail::class;

    public function getEmailsQuery()
    {
        $search = request()->search ?? '';
        $query = SurveyEmail::query()
            ->select(
                [
                    'se.*',
                    'subscribers.subscriber_group_name',
                    'subscribers.first_name',
                    'subscribers.last_name',
                ]
            );
        $query->from(DB::Raw('survey_emails as se'));
        $query->join('survey_tokens', 'survey_tokens.id', '=', 'se.survey_token_id');
        $query->join('subscribers', 'subscribers.id', '=', 'survey_tokens.subscriber_id');

        $query->whereNull('se.deleted_at');

        return $query;
    }

    public function getSmsQuery()
    {
        $search = request()->search ?? '';
        $query = SurveyEmail::query()
            ->select(
                [
                    'se.*',
                    'subscribers.subscriber_group_name',
                    'subscribers.first_name',
                    'subscribers.last_name',
                ]
            );
        $query->from(DB::Raw('survey_sms as ss'));
        $query->join('survey_tokens', 'survey_tokens.id', '=', 'ss.survey_token_id');
        $query->join('subscribers', 'subscribers.id', '=', 'survey_tokens.subscriber_id');

        $query->whereNull('ss.deleted_at');

        return $query;
    }
}
