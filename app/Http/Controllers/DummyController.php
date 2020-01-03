<?php

namespace App\Http\Controllers;

use App\Book;
use App\Enums\BookStatus;
use App\Http\Requests\StoreBook;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

class DummyController extends Controller
{
    public function index()
    {
        $books = Book::all();
        
        return view('books.index', compact('books'));
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
        
        return redirect()->route('books.edit', compact('book', 'bookStatuses'));
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
            return sprintf("%d: %s", $e->getCode(), $e->getMessage());
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
            return sprintf("%d: %s", $e->getCode(), $e->getMessage());
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
            return sprintf("%d: %s", $e->getCode(), $e->getMessage());
        }
        
        $book->update($request->prepared());
        
        return '';
    }
    
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return sprintf("%d: %s", $e->getCode(), $e->getMessage());
        }
        
        $book->delete();
        
        return redirect()->route('books.index');
    }
    
    public function searchByStatus(string $status)
    {
        if (! $status) {
            throw new InvalidArgumentException("Status cannot be empty");
        }
        
        return Book::filterByStatus($status)->all();
    }
}
