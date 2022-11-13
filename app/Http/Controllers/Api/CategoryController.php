<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Resources\Api\CategoryJson;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function __construct(private readonly Category $category)
    {
    }

    public function index(Request $request): CategoryResource
    {
        $perPage = $request->get('per_page');
        $categories = $this->category->paginate($perPage);

        return new CategoryResource($categories);
    }

    public function store(CategoryRequest $request): CategoryJson
    {
        $category = $this->category->create($request->validated());
        return new CategoryJson($category);
    }

    public function show(Category $category): CategoryJson
    {
        return new CategoryJson($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return CategoryJson
     */
    public function update(CategoryRequest $request, Category $category): CategoryJson
    {
        $category->update($request->validated());
        return new CategoryJson($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category): Response
    {
        $category->delete();
        return response()->noContent();
    }
}
