<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserMeta;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('meta')->get();
        $users = UserResource::collection($users);
        return Inertia::render('users/index', [
            'users' => $users->toArray(request()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('users/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $metas = $request->all();
        foreach ($metas as $key => $value) {
            if (in_array($key, config('app_config.user_meta_keys',[]))) {
                continue;
            }
            UserMeta::updateOrCreate([
                'user_id' => $user->id,
                'meta_key' => $key,
            ], [
                'meta_value' => $value,
            ]);
        }

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('meta')->find($id);
        $user = new UserResource($user);
        return Inertia::render('users/edit', [
            'user' => $user->toArray(request()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $metas = $request->all();

        foreach ($metas as $key => $value) {
            if (in_array($key, config('app_config.user_meta_keys',[]))) {
                UserMeta::updateOrCreate([
                    'user_id' => $user->id,
                    'meta_key' => $key,
                ], [
                    'meta_value' => $value,
                ]);
            }
        }

        return redirect()->route('users.index');
    }

    /**
     * Update the status of the specified resource in storage.
     */
    public function updateStatus(string $id){
        $user = User::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
