<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;
use File;

class BookController extends Controller
{
    public function addBook(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'required|image|file|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
            'amount' => 'required',
            'file' => 'required|file|mimes:pdf|max:5120',
            'user_id' => '',
        ]);

        $book = new Book();
        $book->title = $validateData['title'];
        $book->category_id = $validateData['category_id'];

        if ($request->file('cover')) {
            $extFile = $request->cover->getClientOriginalExtension();
            $fileName = 'cover-' . time() . '.' . $extFile;
            $path = $request->cover->storeAs('cover', $fileName, 'public');
            $book->cover = 'storage/' . $path;
        }

        $book->description = $validateData['description'];
        $book->amount = $validateData['amount'];

        if ($request->file('file')) {
            $extFile = $request->file->getClientOriginalExtension();
            $fileName = 'file-' . time() . '.' . $extFile;
            $path = $request->file->storeAs('file', $fileName, 'public');
            $book->file = 'storage/' . $path;
        }

        if ($request->user_id) {
            $book->user_id = $validateData['user_id'];
        } else {
            $book->user_id = auth()->user()->id;
        }

        $book->save();

        $request->session()->flash('message', 'Buku berhasil ditambahkan!');

        return redirect('dashboard');
    }

    public function updateBook(Request $request, $id)
    {
        $validateData = $request->validate([
            'title' => 'max:255',
            'category_id' => 'exists:categories,id',
            'description' => '',
            'amount' => '',
            'cover' => 'image|file|mimes:jpeg,png,jpg|max:2048',
            'file' => 'file|mimes:pdf|max:10240',
        ]);

        $book = Book::findOrFail($id);

        if ($request->title) {
            $book->title = $validateData['title'];
        }

        if ($request->category_id) {
            $book->category_id = $validateData['category_id'];
        }

        if ($request->description) {
            $book->description = $validateData['description'];
        }

        if ($request->amount) {
            $book->amount = $validateData['amount'];
        }

        if ($request->file('cover')) {
            $extFile = $request->cover->getClientOriginalExtension();
            $fileName = 'cover-' . time() . '.' . $extFile;
            File::delete($book->cover);
            $path = $request->cover->storeAs('cover', $fileName, 'public');
            $book->cover = 'storage/' . $path;
        }

        if ($request->file('file')) {
            $extFile = $request->file->getClientOriginalExtension();
            $fileName = 'file-' . time() . '.' . $extFile;
            File::delete($book->file);
            $path = $request->file->storeAs('file', $fileName, 'public');
            $book->file = 'storage/' . $path;
        }

        $book->save();

        $request->session()->flash('message', 'Buku berhasil diubah!');

        return redirect('dashboard');
    }

    public function deleteBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        File::delete($book->cover);
        File::delete($book->file);

        $book->delete();

        $request->session()->flash('message', 'Buku berhasil dihapus!');

        return redirect('dashboard');
    }

    public function exportBook()
    {
        $fileName = 'books_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new BooksExport, $fileName);
    }
}
