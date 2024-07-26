<?php

namespace App\Repositories;

use App\Models\Subscriber;

class SubscriberRepository extends BaseRepository
{
    protected $model = Subscriber::class;

    public function getSubscribersQuery()
    {
        $search = request()->search ?? '';
        $query = Subscriber::query()
            ->select(
                [
                    'subscribers.id',
                    'subscribers.subscriber_group_name',
                    'subscribers.first_name',
                    'subscribers.last_name',
                    'subscribers.email',
                    'subscribers.phone',
                    'subscribers.created_at',
                ]
            );
        $query->whereNull('deleted_at');

        if(!empty($search)){
            $query->whereRaw("LOWER(concat(first_name, ' ', last_name, ' ', email)) like ? ", '%' . mb_strtolower($search, 'utf-8') . '%');
        }

        return $query;
    }
}
