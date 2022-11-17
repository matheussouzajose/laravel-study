<?php

namespace App\Http\Controllers\Api;

use Algolia\AlgoliaSearch\SearchIndex;
use App\Mail\StockGreatherMax;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\{StoreProductCover, StoreProductRequest, StoreProductStock, UpdateProductRequest};
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

        $products = $this->product->when($request->has('query'), function ($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request->get('query')}%");
        })->paginate($perPage);

//        $products = $this->product->search($request->get('query'))
//            ->paginate($perPage);

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

    /**
     * @param StoreProductStock $productStock
     * @return Response|Application|ResponseFactory
     */
    public function stockEntries(StoreProductStock $productStock): Response|Application|ResponseFactory
    {
        $productStock = $productStock->validated();
        $product = $this->product->find($productStock['product_id']);

        $product->stock = $product->stock + $productStock['stock'];;
        $product->save();

        return response([
            'data' => [
                'stock' => $product->stock
            ]
        ]);
    }

    /**
     * @param StoreProductStock $productStock
     * @return Response|Application|ResponseFactory
     */
    public function stockOutPuts(StoreProductStock $productStock): Response|Application|ResponseFactory
    {
        $productStock = $productStock->validated();
        $product = $this->product->find($productStock['product_id']);

        $sumStock = $product->stock - $productStock['stock'];

        if ($sumStock < 0) {
            return response([
                'message' => "Valor total do estoque não pode ser negativo. Estoque atual: {$product->stock}"
            ], 422);
        }

        $product->stock = $sumStock;
        $product->save();

        return response([
            'data' => [
                'stock' => $product->stock
            ]
        ]);
    }
}
