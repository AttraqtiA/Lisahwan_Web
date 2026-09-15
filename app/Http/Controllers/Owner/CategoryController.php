<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories', [
            "TabTitle" => "Daftar Kategori",
            "active_category" => "text-yellow-500", // We will use this in sidebar
            "categories" => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50|unique:categories,name'
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.string' => 'Nama kategori wajib berupa teks!',
            'name.max' => 'Nama kategori maksimal 50 karakter!',
            'name.unique' => 'Kategori ini sudah ada!',
        ]);

        Category::create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
        ]);

        return back()->with('addCategory_success', "Kategori {$validatedData['name']} berhasil ditambahkan!");
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name_edit' => 'required|string|max:50|unique:categories,name,' . $id
        ], [
            'name_edit.required' => 'Nama kategori wajib diisi!',
            'name_edit.string' => 'Nama kategori wajib berupa teks!',
            'name_edit.max' => 'Nama kategori maksimal 50 karakter!',
            'name_edit.unique' => 'Kategori ini sudah ada!',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $validatedData['name_edit'],
            'slug' => Str::slug($validatedData['name_edit']),
        ]);

        return back()->with('updateCategory_success', "Kategori berhasil diperbarui!");
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category_name = $category->name;
        $category->delete();

        return back()->with('deleteCategory_success', "Kategori {$category_name} berhasil dihapus!");
    }
}
