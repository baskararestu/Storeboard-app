<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with("user")
            ->orderBy("name", "asc")
            ->get();

        return view("product.product", [
            "product" => $product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("product.product-add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                "name" => "required|max:100|unique:products",
                "category" => "required",
                "supplier" => "required",
                "stock" => "required",
                "price" => "required",
                "note" => "max:1000",
            ]);

            $userId = auth()->id();
            $product = Product::create(
                array_merge($request->all(), ["user_id" => $userId]),
            );

            DB::commit();
            Alert::success("Success", "Product has been saved !");
            return redirect("/product");
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error("Error", "Failed to save the product.");
            return redirect("/product/create");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_product)
    {
        $product = Product::where("user_id", Auth::id())->findOrFail(
            $id_product,
        );
        return view("product.product-edit", [
            "product" => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_product)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                "name" =>
                    "required|max:100|unique:barangs,name," .
                    $id_product .
                    ",id_product",
                "category" => "required",
                "supplier" => "required",
                "stock" => "required",
                "price" => "required",
                "note" => "max:1000",
            ]);

            $product = Product::where("user_id", Auth::id())->findOrFail(
                $id_product,
            );
            $product->update($validated);

            DB::commit();
            Alert::info("Success", "product has been updated !");
            return redirect("/product");
        } catch (\Exception $e) {
            DB::rollBack();

            Alert::warning("Error", "Failed to update the product.");
            return redirect("/product");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_product)
    {
        try {
            DB::beginTransaction();
            $deletedproduct = Product::where("user_id", Auth::id())->findOrFail(
                $id_product,
            );
            $deletedproduct->delete();

            DB::commit();
            Alert::error("Success", "product has been deleted !");
            return redirect("/product");
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::warning(
                "Error",
                "Failed to delete the product. It may have already been deleted or does not exist.",
            );
            return redirect("/product");
        }
    }
}
