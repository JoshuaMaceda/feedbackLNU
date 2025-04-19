@extends('layouts.app')
@section('content')
  <div class="max-w-md mx-auto p-6 bg-white shadow">
    <h1 class="text-xl mb-4">Evaluate {{ $teacher->name }}</h1>
    @if(session('message'))
      <div class="bg-green-200 p-2 mb-4">{{ session('message') }}</div>
    @endif
    <form action="{{ route('evaluation.store',$teacher) }}" method="POST">
      @csrf
      @foreach($questions as $q)
        <label>{{ ucfirst($q) }} (1–5)</label>
        <input type="number" name="scores[{{ $q }}]" min="1" max="5" required class="border p-1 w-full mb-2">
        @error("scores.$q") <div class="text-red-600">{{ $message }}</div> @enderror
      @endforeach

      <label>Comments</label>
      <textarea name="comments" class="border p-1 w-full mb-2"></textarea>
      @error('comments') <div class="text-red-600">{{ $message }}</div> @enderror

      <button type="submit" class="bg-blue-600 text-white px-4 py-2">Submit</button>
    </form>
  </div>
@endsection
