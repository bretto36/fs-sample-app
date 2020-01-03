@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>List of books</h1>

        <a class="btn btn-primary my-4 float-right" role="button" href="{{ route('books.create') }}">Create New Book</a>

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
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ ucwords($book->formatted_status) }}</td>
                        <td>
                            <a href="{{ route('books.destroy', ['book' => $book->id]) }}"><i class="fa fa-trash"></i></a>
                            <span class="mx-2">|</span>
                            <a href="{{ route('books.edit', ['book' => $book->id]) }}"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
