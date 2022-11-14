<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\{StoreProductCover, StoreProductRequest, UpdateProductRequest};
use App\Http\Resources\Api\{ProductJson, ProductResource};
use Illuminate\Http\{Request, Response};

class ProductController extends Controller
{
    public function __construct(private readonly Product $product)
    {
    }

    /**
     * @param Request $request
     * @return ProductResource
     */
    public function index(Request $request): ProductResource
    {
        $perPage = $request->get('per_page');

        $products = $this->product->when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request->get('search')}%");
        })->paginate($perPage);

        return new ProductResource($products);
    }

    /**
     * @param StoreProductRequest $request
     * @return ProductJson
     */
    public function store(StoreProductRequest $request): ProductJson
    {
        $product = $this->product->create($request->validated());
        return new ProductJson($product);
    }

    /**
     * @param Product $product
     * @return ProductJson
     */
    public function show(Product $product): ProductJson
    {
        return new ProductJson($product);
    }

    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return ProductJson
     */
    public function update(UpdateProductRequest $request, Product $product): ProductJson
    {
        $product->update($request->validated());
        return new ProductJson($product);
    }

    /**
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product): Response
    {
        $product->delete();
        return response()->noContent();
    }

    /**
     * @param StoreProductCover $productCover
     * @return Response|Application|ResponseFactory
     */
    public function updateCover(StoreProductCover $productCover): Response|Application|ResponseFactory
    {
        $productCover = $productCover->validated();
        $product = $this->product->find($productCover['product_id']);

        if ($productCover['cover']->isValid()) {
            Storage::delete($product->cover ?? '');
            $file = $productCover['cover'];
            $path = $file->store('products');
            $product->update(['cover' => $path]);
        }

        return response([
            'data' => [
                'cover' => Storage::url($product->cover)
            ]
        ]);
    }

    /**
     * @param Product $product
     * @return Response|Application|ResponseFactory
     */
    public function destroyCover(Product $product): Response|Application|ResponseFactory
    {
        Storage::delete($product->cover ?? '');
        $product->update(['cover' => null]);

        return response()->noContent();
    }
}
