@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-4 offset-md-4">
            <h1>Create new book</h1>

            @include('books.form', [
                'action' => 'create',
                'book' => $book,
                'bookStatuses' => $bookStatuses
            ])
        </div>
    </div>
@endsection
