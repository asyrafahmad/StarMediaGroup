@extends('layouts.app')

@section('title','Home')

@section('content')
  <h1>Welcome to the Home Page</h1>
  <p>Overview content...</p>

    {{-- Example of displaying consent value --}}
    @if(isset($consent))
        <p>User consent: {{ json_encode($consent) }}</p>
    @else
        <p>No consent cookie found.</p>
    @endif
@endsection


