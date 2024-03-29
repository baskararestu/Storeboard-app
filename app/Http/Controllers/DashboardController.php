<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::count();

        return view('dashboard.dashboard', [
            'product' => $product,
        ]);
    }
}
