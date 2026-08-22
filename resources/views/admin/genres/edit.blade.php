@extends('layouts.admin')
@section('page-title', 'Edit Genre')

@section('content')

<form method="POST" action="{{ route('admin.genres.update', $genre) }}"
      class="max-w-lg bg-white border border-stone-200 rounded-lg shadow-sm p-6 space-y-5">
    @csrf
    @method('PUT')
    @include('admin.genres._form', ['genre' => $genre])

    <div class="flex items-center gap-3 pt-1">
        <button type="submit" class="btn-admin-primary">Update Genre</button>
        <a href="{{ route('admin.genres.index') }}"
           class="text-sm text-stone-400 hover:text-stone-600 transition duration-150">Cancel</a>
    </div>
</form>

@endsection
