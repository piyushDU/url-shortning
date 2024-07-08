<form id="shortenForm">
    @csrf
    <input type="text" name="original_url" placeholder="Enter URL to shorten">
    <button type="submit">Shorten URL</button>
    <a href="{{ route('urls.list') }}" class="">View all Urls</a>

</form>

<div id="shortenedURL"></div>

<script>
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