<?php

namespace App\Services;

use App\Models\File;
use App\Models\MenuItem;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserNotification;
use App\Strategies\Notifications\DailyNotifyStrategy;
use App\Strategies\Notifications\EveryChangeNotifyStrategy;
use App\Strategies\Notifications\NeverNotifyStrategy;
use App\Strategies\Notifications\NotificationStrategy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserService
{
    public function __construct()
    {

    }

    public function save($inputData, $id = null)
    {
        try {
            DB::beginTransaction();
            if ($id > 0) {
                $user = User::query()->findOrFail($id);
                $data = [
                    'updated_at' => now()->format('Y-m-d H:i:s')
                ];
                if ($inputData['reset_password'] ?? false) {
                    $setEmailPassword = true;
                }
            } else {
                $user = User::query()->newModelInstance();
                $data = [
                    'password' => Str::random(250),
                    'updated_at' => null,
                    'created_at' => now()->format('Y-m-d H:i:s'),
                ];
                $setEmailPassword = true;
            }

            $data = [
                    'user_group_id' => $inputData['user_group_id'],
                    'first_name' => $inputData['first_name'],
                    'last_name' => $inputData['last_name'],
                    'email' => $inputData['email'],
                    'phone' => $inputData['phone'] ?? null,
                    'active' => $inputData['status'] ?? 1,
                ] + $data;

            $user->fill($data);

            $user->save();

//            if ($setEmailPassword ?? false) {
//                $status = Password::sendResetLink(
//                    [
//                        'email' => $inputData['email'],
//                    ], function ($user, $token) use ($id) {
//                    return $user->sendPasswordResetNotification($token, ((empty($id)) ? true : false));
//                }
//                );
//
//                if ($status != Password::RESET_LINK_SENT) {
//                    throw new \Exception('Nie udało się wysłać maila z ustawieniem hasła');
//                }
//            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
