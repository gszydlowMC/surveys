<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Models\UserGroup;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends BaseController
{
    public function __construct(protected UserRepository $repository, protected UserService $userService)
    {

    }

    public function index(Request $request)
    {
        $search = $request->search ?? '';
        $query = User::query()
            ->join('user_groups', 'users.user_group_id', 'user_groups.id')
            ->select(
                [
                    'users.id',
                    'users.first_name',
                    'users.last_name',
                    'users.email',
                    'user_groups.name as group_name',
                    'users.created_at',
                ]
            );
        if(!empty($search)){
            $query->whereRaw("LOWER(concat(first_name, ' ', last_name, ' ', email)) like ? ", '%' . mb_strtolower($search, 'utf-8') . '%');
        }

        $users = $query->sortable(['id' => 'desc'])
            ->paginate(500);

        $enableSearch = true;

        return view('admin.users.index', compact('users', 'enableSearch'));
    }

    public function create()
    {
        $userGroups = UserGroup::all();
        return view('admin.users.form', compact('userGroups'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $userGroups = UserGroup::all();
        return view('admin.users.form', compact('userGroups', 'user'));
    }

    public function store(AdminUserRequest $request)
    {
        $status = $this->userService->save($request->all(), null);
        return $this->handleSaveResponse($status,
            'Pomyślnie dodano użytkownika z panelu administracyjnego.',
            'Nie udało się dodać nowego użytkownika z panelu administracyjnego.',
            route('admin.users.index')
        );
    }

    public function update(AdminUserRequest $request, $id)
    {
        $status = $this->userService->save($request->all(), $id);
        return $this->handleSaveResponse($status,
            'Pomyślnie edytowano użytkownika z panelu administracyjnego.',
            'Nie udało się edytować użytkownika z panelu administracyjnego.',
            route('admin.users.index')

        );
    }

}
