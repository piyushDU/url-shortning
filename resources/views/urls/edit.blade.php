@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h1>Edit URL</h1>

        <form action="{{ route('urls.update', $url->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="original_url">Original URL</label>
                <input type="text" name="original_url" id="original_url" class="form-control" value="{{ $url->original_url }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update URL</button>
        </form>
    </div>
</body>
@endsection
