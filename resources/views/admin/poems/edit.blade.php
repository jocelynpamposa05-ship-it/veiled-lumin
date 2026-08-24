@extends('layouts.admin')
@section('page-title', 'Edit Poem')

@section('content')

<form method="POST" action="{{ route('admin.poems.update', $poem) }}"
      enctype="multipart/form-data"
      class="w-full max-w-2xl bg-white border border-stone-200 rounded-lg shadow-sm p-4 sm:p-6 space-y-5">
    @csrf
    @method('PUT')
    @include('admin.poems._form', ['poem' => $poem])

    <div class="flex items-center gap-3 pt-2 border-t border-stone-100">
        <button type="submit" class="btn-admin-primary">Update Poem</button>
        <a href="{{ route('admin.poems.index') }}"
           class="text-sm text-stone-400 hover:text-stone-600 transition duration-150">Cancel</a>
    </div>
</form>

@stack('scripts')
@endsection
