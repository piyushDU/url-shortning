@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add URL</h5>
            <form id="shortenForm">
                @csrf
                <div class="form-group">
                    <label for="original_url">Original URL</label>
                    <input type="text" name="original_url" id="original_url" class="form-control" placeholder="Enter URL to shorten" required>
                </div>
                <button type="submit" class="btn btn-primary">Shorten URL</button>
                <a href="{{ route('urls.list') }}" class="btn btn-secondary">View All URLs</a>
            </form>
        </div>
    </div>
</div>

<div id="shortenedURL"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // AJAX request for URL shortening
    $('#shortenForm').submit(function(event) {
        event.preventDefault();
        
        $.ajax({
            url: '{{ route('shorten.url') }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#shortenedURL').html('<p>Shortened URL: <a href="' + response.shortened_url + '">' + response.shortened_url + '</a></p>');
            },
            error: function(xhr) {
                var errors = xhr.responseJSON;
                if (errors && errors.error) {
                    alert(errors.error);
                }
            }
        });
    });
</script>  
@endsection
