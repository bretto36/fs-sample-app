@if($action === 'create')
    <form action="{{ route('books.store') }}" method="post">
@else
    <form action="{{ route('books.update', ['book' => $book->id]) }}" method="post">
        @method('PUT')
@endif
    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required />
    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input class="form-control" type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required />
    </div>

    <div class="form-group">
        <label for="blurb">Blurb</label>
        <input class="form-control" type="text" id="blurb" name="blurb" value="{{ old('blurb', $book->blurb) }}" />
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" name="status" id="status" required>
            <option value="">Select a status</option>
            @foreach($bookStatuses as $label => $value)
                <option value="{{ $label }}"{{ old('status', $book->status) === $label ? ' selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="{{ $action === 'create' ? 'Create new book' : 'Update book' }}" />
        <a href="{{ route('books.index') }}">Cancel and return</a>
    </div>
</form>
