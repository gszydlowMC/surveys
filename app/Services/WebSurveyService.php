<?php

namespace App\Services;

use App\Models\SurveyResult;
use Auth;
use Illuminate\Support\Facades\DB;

class WebSurveyService extends BaseService
{
    public function __construct()
    {

    }

    public function saveSurveyResult($tokenId, $questionId = null, $value = null, $isStart = false, $isEnd = false)
    {
        $surveyResult = SurveyResult::query()->newQuery()->newModelInstance();
        $data = [
            'survey_token_id' => $tokenId,
            'survey_question_id' => $questionId ?? null,
            'value' => $value ?? null,
            'is_start' => $isStart ?? null,
            'is_end' => $isEnd ?? null,
            'ip' => request()->ip(),
            'created_at' => now()->format('Y-m-d H:i:s'),
        ];

        $surveyResult->fill($data);
        $surveyResult->save();

    }
}
