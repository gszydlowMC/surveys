<?php

namespace App\Services;


use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubscriberService
{
    public function __construct()
    {

    }

    public function save($inputData, $id = null)
    {
        try {
            DB::beginTransaction();
            if ($id > 0) {
                $user = Subscriber::query()->findOrFail($id);
                $data = [
                    'updated_at' => now()->format('Y-m-d H:i:s')
                ];
            } else {
                $user = Subscriber::query()->newModelInstance();
                $data = [
                    'updated_at' => null,
                    'created_at' => now()->format('Y-m-d H:i:s'),
                ];
            }

            $data = [
                    'subscriber_group_name' => $inputData['subscriber_group_name'] ?? null,
                    'first_name' => $inputData['first_name'],
                    'last_name' => $inputData['last_name'],
                    'email' => $inputData['email'],
                    'phone' => $inputData['phone'] ?? null,
                ] + $data;

            $user->fill($data);

            $user->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
