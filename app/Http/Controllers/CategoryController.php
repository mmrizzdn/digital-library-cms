<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use File;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255'
        ]);

        $category = new Category();
        $category->name = $validateData['name'];

        $category->save();
        $request->session()->flash('message', 'Kategori berhasil ditambahkan!');

        return redirect('dashboard');
    }

    public function updateCategory(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required',
            'name' => 'required|max:255'
        ]);

        $category = Category::findOrFail($validateData['id']);

        if ($request->name) {
            $category->name = $validateData['name'];
        }

        $category->save();

        $request->session()->flash('message', 'Buku berhasil diubah!');

        return redirect('dashboard');
    }

    public function deleteCategory(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required',
        ]);

        $category = Category::findOrFail($validateData['id']);
        $books = Book::where('category_id', $category->id)->get();

        foreach ($books as $book) {
            File::delete($book->cover);
            File::delete($book->file);
            $book->delete();
        }

        $request->session()->flash('message', 'Kategori berhasil dihapus!');
        $category->delete();

        return redirect('dashboard');
    }
}
