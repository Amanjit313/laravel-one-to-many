@extends('layouts.app')

@section('content')

<a class="btn btn-success" href="{{ route('admin.posts.create') }}">CREATE NEW POST</a>

<br>
<br>

<table class="table">
    <thead>
        <tr>
            <th class="col-1">ID</th>
            <th class="col-3">NAME</th>
            <th class="col-3">LOCATION</th>
            <th class="col-3">EMAIL</th>
            <th class="col-3">ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <th>
                <p>{{ $post->id }}</p>
            </th>
            <td>
                <p>{{ $post->name }}</p>
            </td>
            <td>
                <p>{{ $post->location }}</p>
            </td>
            <td>
                <p>{{ $post->email }}</p>
            </td>
            <td class="d-flex">
                <a class="btn btn-success mr-2" href="{{ route('admin.posts.show', $post) }}">SHOW</a>
                <a class="btn btn-primary mr-2" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>

                <form action="{{ route('admin.posts.destroy', $post) }}"
                      method="POST"
                      onsubmit="return confirm('Vuoi eliminare il post di {{ $post->name }}?')">
                      @csrf
                      @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>

</table>

<hr>
<div class="d-flex justify-content-center">
    {{ $posts->links() }}
</div>

@endsection
