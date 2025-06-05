<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Flasher\Prime\FlasherInterface;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('categories')
                                ->orderBy('id')
                                ->get();

        return view('admin.products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.form', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'stock_quantity' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg,webp',
            'is_active' => 'boolean',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . Str::slug($validated['name']) . '.' . $request->file('image')->getClientOriginalExtension();
            $validated['image'] = $request->file('image')->storeAs('uploads/products', $filename, 'public');
        }

        $product = Product::create($validated);

        if (isset($validated['categories'])) {
            $product->categories()->attach($validated['categories']);
        }

        // flash()->success('Your product has been created successfully!');
        return redirect()->route('products.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $productCategories = $product->categories->pluck('id')->toArray();

        return view('admin.products.form', [
            'product' => $product,
            'categories' => $categories,
            'productCategories' => $productCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'stock_quantity' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg,webp',
            'is_active' => 'boolean',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->has('remove_image')) {
            Storage::delete('public/' . $product->image);
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            Storage::delete('public/' . $product->image);
            $filename = time() . '_' . Str::slug($validated['name']) . '.' . $request->file('image')->getClientOriginalExtension();
            $validated['image'] = $request->file('image')->storeAs('uploads/products', $filename, 'public');
        }

        $product->update($validated);

        $product->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
