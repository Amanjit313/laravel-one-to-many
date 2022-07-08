@extends('layouts.app')

@section('content')

<h1>New Author Post Create</h1>

@if ($errors->any())
    <div class="alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.posts.store') }}" method="POST">

    @csrf

    <div class="col-3">
        <label for="name" class="form-label">Name</label>
        <input  type="text" id="name"
                name="name"
                value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Name...">
                @error('name')
                    <p class="error-msg text-danger">{{ $message }}</p>
                @enderror
    </div>

    <div class="col-3">
        <label for="location" class="form-label">Location</label>
        <input  type="text" id="location"
                name="location"
                value="{{ old('location') }}"
                class="form-control @error('location') is-invalid @enderror"
                placeholder="Location...">
                @error('location')
                    <p class="error-msg text-danger">{{ $message }}</p>
                @enderror
    </div>

    <div class="col-3">
        <label for="email" class="form-label">Email</label>
        <input  type="email" id="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Email...">
                @error('email')
                    <p class="error-msg text-danger">{{ $message }}</p>
                @enderror
    </div>

    <br>
    <button type="submit" class="btn btn-success">CREATE</button>
    <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">BACK</a>

  </form>

@endsection
