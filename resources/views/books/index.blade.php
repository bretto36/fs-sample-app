@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>List of books</h1>

        <p>
            <a class="btn btn-primary my-4 float-right" role="button" href="{{ route('books.create') }}">
                Create New Book
            </a>
        </p>

        @if ($paginatedBooks->total())
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paginatedBooks as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ ucwords($book->formatted_status) }}</td>
                            <td>
                                <form class="d-inline" action="{{ route('books.destroy', ['book' => $book->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $book->id }}">
                                    <button type="submit" class="border-0 text-secondary">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                <span class="mx-2">|</span>
                                <a role="button" class="text-secondary" href="{{ route('books.edit', ['book' => $book->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $paginatedBooks->links() }}
        @else
            <p class="text-muted">No books found.</p>
        @endif
    </div>
@endsection
