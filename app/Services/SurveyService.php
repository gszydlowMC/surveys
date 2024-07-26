<?php

namespace App\Services;

use App\Models\Subscriber;
use App\Models\Survey;
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
                $survey = Survey::query()->findOrFail($id);
                $data = [
                    'updated_at' => now()->format('Y-m-d H:i:s')
                ];
            } else {
                $survey = Survey::query()->newModelInstance();
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

            DB::commit();
            return true;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return false;
        }
    }

}
