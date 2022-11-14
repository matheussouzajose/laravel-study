<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCategoryRequest;
use App\Models\User;
use App\Http\Resources\Api\{CategoryJson, CategoryResource};
use Illuminate\Http\{Request, Response};

class UserController extends Controller
{
    public function __construct(private readonly User $user)
    {
    }

    public function index(Request $request): CategoryResource
    {
        $perPage = $request->get('per_page');

        $categories = $this->user->when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request->get('search')}%");
        })->paginate($perPage);

        return new CategoryResource($categories);
    }

    public function store(StoreCategoryRequest $request): CategoryJson
    {
        $user = $this->user->create($request->validated());
        return new CategoryJson($user);
    }

    /**
     * @param Category $user
     * @return CategoryJson
     */
    public function show(Category $user): CategoryJson
    {
        return new CategoryJson($user);
    }

    /**
     * @param StoreCategoryRequest $request
     * @param Category $user
     * @return CategoryJson
     */
    public function update(StoreCategoryRequest $request, Category $user): CategoryJson
    {
        $user->update($request->validated());
        return new CategoryJson($user);
    }

    /**
     * @param Category $user
     * @return Response
     */
    public function destroy(Category $user): Response
    {
        $user->delete();
        return response()->noContent();
    }
}
