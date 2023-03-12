<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json([
            "status" => "success",
            "length" => count($products),
            "data" =>new ProductCollection($products),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->all());

        return response()->json([
            "status" => "success",
            "message" => "product created successfully",
            "data" => $product,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        $product->category;
        return response()->json([
            "status" => "success",
            "data" => new ProductResource($product),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->all());

        return response()->json([
            "status" => "success",
            "message" => "product updated successfully",
            "data" => $product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            "status" => "success",
            "message" => "product deleted successfully",
            "data" => $product,
        ]);
    }
}