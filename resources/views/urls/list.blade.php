@extends('layouts.app')
<!DOCTYPE html>
@section('content')
    <div class="container mt-4">
        <h1>Shortened URLs</h1>

        <table class="table">
            <a href="{{route('dashboard')}}" class="btn btn-success" style="float: right;margin-bottom: 8px;">ADD NEW URL</a>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Original URL</th>
                    <th scope="col">Short URL</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($urls) > 0)
                    @foreach($urls as $url)
                    <tr>
                        <td>{{ $url->original_url }}</td>
                        <td>
                            @if(!$url->active)
                                <a href="{{$url->short_url}}">{{ $url->short_url }}</a>
                            @else
                                <a href="javscipt::void(0)"> PLEASE ACTIVATE TO ACCESS URL</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('urls.edit', $url->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            
                            <form action="{{ route('urls.delete', $url->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            
                            @if ($url->active)
                                <form action="{{ route('urls.deactivate', ['id' => $url->id, 'isActive' => '0']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm">Deactivate</button>
                                </form>
                            @else
                                <form action="{{ route('urls.deactivate', ['id' => $url->id, 'isActive' => '1']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr><td>No Data Found</td></tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection