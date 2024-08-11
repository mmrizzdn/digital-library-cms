<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $users = User::all();
        $query = Book::query();

        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());

        }

        $books = $query->get();

        return view('dashboard', [
            'title' => 'DIgital Library | Dashboard',
            'sideBar' => 'Ammar Digital Library',
            'categories' => $categories,
            'books' => $books,
            'users' => $users
        ]);
    }
}
