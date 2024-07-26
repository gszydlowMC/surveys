<?php

namespace App\Services;

use App\Models\Subscriber;
use App\Models\SurveyEmail;
use App\Models\SurveySms;
use App\Models\SurveyToken;
use Auth;
use DB;
use Str;

class SurveyNotificationService extends BaseService
{
    public function __construct()
    {

    }

    public function sendMultiple($surveyId, $subscribers = [])
    {
        try {
            DB::beginTransaction();
            if (!empty($subscribers)) {
                foreach ($subscribers as $subscriberId) {
                    $tokenModel = $this->saveSurveyToken($surveyId, $subscriberId);
                    $subscriber = Subscriber::query()->find($subscriberId);
                    $this->saveEmail($subscriber, $tokenModel);
                }
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e);
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function sendMessage(int $surveyId, int $subscriberId, bool $sendEmail = true, bool $sendSms = false)
    {
        try {
            DB::beginTransaction();
            $tokenModel = $this->saveSurveyToken($surveyId, $subscriberId);
            $subscriber = Subscriber::query()->findOrFail($subscriberId);
            $this->saveEmail($subscriber, $tokenModel);
            if ($sendSms) {
                $this->saveSms($subscriber, $tokenModel);
            }

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function saveEmail($subscriberModel, $tokenModel)
    {
        $surveyEmailModel = SurveyEmail::query()->newModelInstance();
        $surveyEmailModel->fill([
            'survey_token_id' => $tokenModel->id,
            'view_blade_path' => '',
            'to' => $subscriberModel->email,
            'subject' => __('Zaproszenie do udziału w ankiecie'),
            'content' => '',
            'input_data' => '',
            'created_by' => Auth::user()->id,
            'created_at' => now()->format('Y-m-d H:i:s'),
        ]);

        $surveyEmailModel->save();
        return true;
    }

    public function saveSms($subscriberModel, $tokenModel)
    {
        $surveyEmailModel = SurveySms::query()->newModelInstance();
        $surveyEmailModel->fill([
            'survey_token_id' => $tokenModel->id,
            'to' => $subscriberModel->email,
            'content' => '',
            'created_by' => Auth::user()->id,
            'created_at' => now()->format('Y-m-d H:i:s'),
        ]);

        $surveyEmailModel->save();
        return true;
    }

    public function saveSurveyToken($surveyId, $subscriberId)
    {
        return SurveyToken::query()->createOrFirst([
            'survey_id' => $surveyId,
            'subscriber_id' => $subscriberId,
            'token' => Str::random(60) . microtime(),
            'created_by' => Auth::user()->id,
            'created_at' => now()->format('Y-m-d H:i:s'),

        ]);
    }

}
