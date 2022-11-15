<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Resources\Api\{UserJson, UserResource};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\{Request, Response};

class UserController extends Controller
{
    public function __construct(private readonly User $user)
    {
    }

    /**
     * @param Request $request
     * @return UserResource
     */
    public function index(Request $request): UserResource
    {
        $perPage = $request->get('per_page');

        $users = $this->user->when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request->get('search')}%");
        })->paginate($perPage);

        return new UserResource($users);
    }

    /**
     * @param User $user
     * @return UserJson
     * public function store(StoreUserRequest $request): UserJson
     * $user = $request->validated();
     * $user['role'] = $this->user::ROLE_ADMIN;
     * return new UserJson->user->create($user));
     * }
     *
     * /**
     */
    public function show(User $user): UserJson
    {
        return new UserJson($user);
    }

    /**
     * @param StoreUserRequest $registerUserRequest
     * @return UserJson
     */
    public function store(StoreUserRequest $registerUserRequest): UserJson
    {
        $user = $this->user->create($registerUserRequest->validated());
        return new UserJson($user);
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return UserJson
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return new UserJson($user);
    }

    /**
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        $user->delete();
        return response()->noContent();
    }

    /**
     * @return UserJson
     */
    public function me()
    {
        return new UserJson(Auth::user());
    }
}
