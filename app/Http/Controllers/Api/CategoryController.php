<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCategoryRequest;
use App\Http\Resources\Api\{CategoryJson, CategoryResource};
use Illuminate\Http\{Request, Response};

class CategoryController extends Controller
{
    public function __construct(private readonly Category $category)
    {
    }

    /**
     * @param Request $request
     * @return CategoryResource
     */
    public function index(Request $request): CategoryResource
    {
        $perPage = $request->get('per_page');

        $categories = $this->category->when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request->get('search')}%");
        })->paginate($perPage);

        return new CategoryResource($categories);
    }

    /**
     * @param StoreCategoryRequest $request
     * @return CategoryJson
     */
    public function store(StoreCategoryRequest $request): CategoryJson
    {
        $category = $this->category->create($request->validated());
        return new CategoryJson($category);
    }

    /**
     * @param Category $category
     * @return CategoryJson
     */
    public function show(Category $category): CategoryJson
    {
        return new CategoryJson($category);
    }

    /**
     * @param StoreCategoryRequest $request
     * @param Category $category
     * @return CategoryJson
     */
    public function update(StoreCategoryRequest $request, Category $category): CategoryJson
    {
        $category->update($request->validated());
        return new CategoryJson($category);
    }

    /**
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category): Response
    {
        $category->delete();
        return response()->noContent();
    }
}
