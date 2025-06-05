<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parent')
                                ->orderBy('id')
                                ->get();
        
        return view('admin.categories.index', compact('categories'));

    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Category $category)
    // {
    //     return view('admin.categories.show', compact('category'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.form', ['categories' => $categories]);
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->where('id', '!=', $category->id)->get();
        return view('admin.categories.form', [
            'category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg,webp',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/categories', $filename, 'public');
            $validated['image'] = $path;
        }
        
        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->has('remove_image')) {
            Storage::delete('public/' . $category->image);
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            Storage::delete('public/' . $category->image);
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    /**
     * import CSV categories
     */
    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt,xlsx,xls|max:2048',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $rows = array_map('str_getcsv', file($path));
        $header = array_map('strtolower', array_shift($rows));
        

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            if (!empty($data['name'])) {
                Category::firstOrCreate(
                    ['name' => $data['name']],
                    [
                        'slug' => Str::slug($data['name']),
                        'description' => $data['description'] ?? null,
                        'is_active' => $data['is_active'] ?? true,
                    ]
                );
            }
        }

        return redirect()->route('categories.index')->with('success', 'Categories imported successfully.');
    }

    /**
     * Delete Categories CSV
     */
    public function deleteFromCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt,xlsx,xls|max:2048',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $rows = array_map('str_getcsv', file($path));
        $header = array_map('strtolower', array_shift($rows));

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            if (!empty($data['id'])) {
                Category::where('id', $data['id'])->delete();
            } elseif (!empty($data['name'])) {
                Category::where('name', $data['name'])->delete();
            }
        }

        return redirect()->route('categories.index')->with('success', 'Categories deleted successfully.');
    }
}
