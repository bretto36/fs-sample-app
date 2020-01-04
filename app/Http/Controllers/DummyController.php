<?php

namespace App\Http\Controllers;

use App\Book;
use App\Enums\BookStatus;
use App\Helpers\CollectionHelper;
use App\Http\Requests\StoreBook;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DummyController extends Controller
{
    public function index()
    {
        $books = Book::all()->sortBy('title');
        $total = $books->count();
        $pageSize = 10;
        
        $paginatedBooks = CollectionHelper::paginate($books, $total, $pageSize);
        
        return view('books.index', compact('paginatedBooks'));
    }
    
    /**
     * Display form to create a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $bookStatuses = BookStatus::toSelectArray();
        $book = new Book();
        
        return view('books.create', compact('book', 'bookStatuses'));
    }
    
    /**
     * Insert a resource into database.
     *
     * @param StoreBook $request StoreBook instance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBook $request)
    {
        $book = Book::create($request->prepared());
        $bookStatuses = BookStatus::toSelectArray();
        
        return redirect()->route('books.edit', compact('book', 'bookStatuses'))->with('success', 'New book has been added.');
    }
    
    /**
     * Get the book data based on the book id
     *
     * @param int $id Book ID
     * @return string|array
     */
    public function show($id)
    {
        try {
            $book = Book::firstOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }
        
        return $book->toArray();
    }
    
    /**
     * Display a form with pre-filled values of a resource to edit
     *
     * @param int $id Book ID
     * @return string|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }
    
        $bookStatuses = BookStatus::toSelectArray();
        
        return view('books.edit', compact('book', 'bookStatuses'));
    }
    
    /**
     * Update an existing resource
     *
     * @param StoreBook $request StoreBook instance
     * @param int $id Book ID
     * @return string
     */
    public function update(StoreBook $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }
        
        $book->update($request->prepared());
        
        return redirect()->route('books.index')->with('success', 'Book has been updated');
    }
    
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }
        
        $book->delete();
        
        return redirect()->route('books.index')->with('success', sprintf('Book %s has been deleted', $book->title));
    }
    
    /**
     * Get the books based on status.
     *
     * @param string $status Status string
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchByStatus(string $status)
    {
        if (! $status) {
            return response()->json([
                'error' => 'Status cannot be empty'
            ]);
        }
        
        if (! array_key_exists($status, BookStatus::toArray())) {
            return response()->json([
                'error' => sprintf('Status: %s not found', $status)
            ], 404);
        }
        
        return Book::filterByStatus($status)->all();
    }
}
