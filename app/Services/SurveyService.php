<?php

namespace App\Services;

use App\Enums\DiskTypeEnum;
use App\Enums\SurveyQuestionTypeEnum;
use App\Models\Subscriber;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionOption;
use App\Models\SurveySection;
use Auth;
use Illuminate\Support\Facades\DB;

class SurveyService extends BaseService
{
    public function __construct()
    {

    }

    public function save($inputData, $id = null)
    {
        try {
            DB::beginTransaction();
            if ($id > 0) {
                $survey = Survey::query()->newQuery()->with(['sections', 'questions.options'])->findOrFail($id);
                $data = [
                    'updated_at' => now()->format('Y-m-d H:i:s')
                ];
            } else {
                $survey = Survey::query()->newQuery()->newModelInstance();
                $data = [
                    'updated_at' => null,
                    'created_at' => now()->format('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->id,
                ];
            }

            $data = [
                    'name' => $inputData['name'],
                    'description' => $inputData['description'],
                ] + $data;

            $survey->fill($data);
            $survey->save();

            if (!empty($inputData['logo_file'])) {
                $uploadedFile = $inputData['logo_file'];
                $filename = uniqid('survey_logo_').'.' . $uploadedFile->getClientOriginalExtension();
                $directory = '/' . $survey->id;
                $filePath = $uploadedFile->storeAs($directory, $filename, ['disk' => DiskTypeEnum::PUBLIC]);
                $survey->fill(['logo_path' => $filePath])->save();
            }

            if (!empty($inputData['banner_file'])) {
                $uploadedFile = $inputData['banner_file'];
                $filename = uniqid('banner_logo_').'.' . $uploadedFile->getClientOriginalExtension();
                $directory = '/' . $survey->id;
                $filePath = $uploadedFile->storeAs($directory, $filename, ['disk' => DiskTypeEnum::PUBLIC]);
                $survey->fill(['banner_path' => $filePath])->save();
            }

            if ($id > 0) {
                if ($survey->sections->isNotEmpty()) {
                    $survey->sections()->delete();
                }
                if ($survey->questions->isNotEmpty()) {
                    foreach ($survey->questions as $question) {
                        $question->options()->delete();
                        $question->sectionsBefore()->delete();
                        $question->delete();
                    }
                }
            }

            if (!empty($inputData['question']['name'])) {
                $questions = [];
                foreach ($inputData['question']['name'] as $k => $name) {
                    $questionData = [
                        'survey_id' => $survey->id,
                        'field_type' => $inputData['question']['type'][$k],
                        'label' => $inputData['question']['name'][$k],
                        'position' => $k,
                        'is_required' => isset($inputData['question']['is_required'][$k]) ? true : false,
                        'created_at' => now()->format('Y-m-d H:i:s'),
                    ];

                    $questionModel = SurveyQuestion::query()->newQuery()->newModelInstance();
                    $questionModel->fill($questionData);
                    $questionModel->save();

                    if (!in_array($inputData['question']['type'][$k], [SurveyQuestionTypeEnum::ONCE_LIST, SurveyQuestionTypeEnum::MULTI_LIST, SurveyQuestionTypeEnum::SELECT])) {
                        continue;
                    }

                    foreach ($inputData['option']['question_' . $k] as $i => $optionLabel) {
                        $optionData = [
                            'survey_question_id' => $questionModel->id,
                            'value' => $optionLabel,
                            'label' => $optionLabel,
                            'position' => $i,
                            'is_radio' => ($inputData['question']['type'][$k] === SurveyQuestionTypeEnum::ONCE_LIST) ? true : false,
                            'is_checkbox' => ($inputData['question']['type'][$k] === SurveyQuestionTypeEnum::MULTI_LIST) ? true : false,
                            'is_select' => ($inputData['question']['type'][$k] === SurveyQuestionTypeEnum::SELECT) ? true : false,
                            'created_at' => now()->format('Y-m-d H:i:s'),
                        ];

                        $optionModel = SurveyQuestionOption::query()->newQuery()->newModelInstance();
                        $optionModel->fill($optionData);
                        $optionModel->save();
                    }

                    $questions[$k] = $questionModel;
                }
            }

            if (!empty($inputData['section']['name'])) {
                foreach ($inputData['section']['name'] as $k => $name) {
                    $sectionData = [
                        'survey_id' => $survey->id,
                        'before_question_id' => $questions[($inputData['section']['before_question_index'][$k] ?? -1) - 1]?->id ?? null,
                        'title' => $name,
                        'description' => $inputData['section']['description'][$k] ?? null,
                    ];
                    $sectionModel = SurveySection::query()->newQuery()->newModelInstance();
                    $sectionModel->fill($sectionData);
                    $sectionModel->save();
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return false;
        }
    }

}
