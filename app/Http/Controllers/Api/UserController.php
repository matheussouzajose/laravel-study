<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\Api\{CategoryJson, UserJson, UserResource};
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

        $categories = $this->user->when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request->get('search')}%");
        })->paginate($perPage);

        return new UserResource($categories);
    }

    /**
     * @param StoreUserRequest $request
     * @return CategoryJson
     */
    public function store(StoreUserRequest $request): CategoryJson
    {
        $user = $request->validated();
        $user['role'] = $this->user::ROLE_ADMIN;
        return new CategoryJson($this->user->create($user));
    }

    /**
     * @param User $user
     * @return UserJson
     */
    public function show(User $user): UserJson
    {
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
