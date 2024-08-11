<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class BooksExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $books = Book::with('category', 'user')->get();
        $data = collect();

        if (auth()->user()->role === 'admin') {
            foreach ($books as $book) {
                $data->push([
                    'ID' => $book->id,
                    'Judul' => $book->title,
                    'Kategori' => $book->category->name,
                    'Cover' => url($book->cover),
                    'Deskripsi' => $book->description,
                    'Jumlah' => $book->amount,
                    'File' => url($book->file),
                    'Di-upload oleh' => $book->user->name,
                    'Dibuat pada' => $book->created_at->format('Y-m-d H:i:s'),
                    'Di-update pada' => $book->updated_at->format('Y-m-d H:i:s')
                ]);
            }

            return $data;
        }

        $books = $books->where('user_id', auth()->user()->id);

        foreach ($books as $book) {
            $data->push([
                'ID' => $book->id,
                'Judul' => $book->title,
                'Kategori' => $book->category->name,
                'Cover' => url($book->cover),
                'Deskripsi' => $book->description,
                'Jumlah' => $book->amount,
                'File' => url($book->file),
                'Dibuat pada' => $book->created_at->format('Y-m-d H:i:s'),
                'Di-update pada' => $book->updated_at->format('Y-m-d H:i:s')
            ]);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        if (auth()->user()->role === 'admin') {
            return [
                'ID',
                'Judul',
                'Kategori',
                'Cover',
                'Deskripsi',
                'Jumlah',
                'File',
                'Di-upload oleh',
                'Dibuat pada',
                'Di-update pada',
            ];
        }

        return [
            'ID',
            'Judul',
            'Kategori',
            'Cover',
            'Deskripsi',
            'Jumlah',
            'File',
            'Dibuat pada',
            'Di-update pada',
        ];
    }
}

