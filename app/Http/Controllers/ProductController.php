<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('name', 'asc')->get();

        return view('product.product', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.product-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:products',
            'category' => 'required',
            'supplier' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'note' => 'max:1000',
        ]);

        $product = Product::create($request->all());

        Alert::success('Success', 'Product has been saved !');
        return redirect('/product');
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
        $product = Product::findOrFail($id_product);

        return view('product.product-edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_product)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:barangs,name,' . $id_product . ',id_product',
            'category' => 'required',
            'supplier' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'note' => 'max:1000',
        ]);

        $product = Product::findOrFail($id_product);
        $product->update($validated);

        Alert::info('Success', 'product has been updated !');
        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_product)
    {
        try {
            $deletedproduct = Product::findOrFail($id_product);

            $deletedproduct->delete();

            Alert::error('Success', 'product has been deleted !');
            return redirect('/product');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Cant deleted, product already used !');
            return redirect('/product');
        }
    }
}
