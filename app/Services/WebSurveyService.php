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

    public function saveSurveyResult($tokenId, $questionPosition = null, $value = null, $isStart = false, $isEnd = false)
    {
        $surveyResult = SurveyResult::query()->newQuery()->newModelInstance();
        $data = [
            'survey_token_id' => $tokenId,
            'survey_question_position' => $questionPosition ?? null,
            'value' => $value ?? null,
            'is_start' => $is_start ?? null,
            'is_end' => $is_end ?? null,
            'ip' => request()->ip(),
            'created_at' => now()->format('Y-m-d H:i:s'),
        ];

        $surveyResult->fill($data);
        $surveyResult->save();

    }
}
