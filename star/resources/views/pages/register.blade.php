@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container" style="max-width:400px;margin:10px auto;padding:2rem;border:1px solid #ddd;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1)">
    <h2 style="text-align:center;margin-bottom:1rem;">Create Account</h2>
    {{-- <p style="text-align:center;color:#666;">Fill in the details to register.</p> --}}

    <form action="{{ route('register') }}" method="POST" style="margin-top:0.5rem;">
        @csrf

        <div style="margin-bottom:0.5rem;">
            <label for="name" style="display:block;margin-bottom:0.5rem;">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                style="width:100%;padding:0.5rem;border:1px solid #ccc;border-radius:4px;">
            @error('name')
                <p style="color:red;font-size:0.9rem;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:0.5rem;">
            <label for="email" style="display:block;margin-bottom:0.5rem;">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                style="width:100%;padding:0.5rem;border:1px solid #ccc;border-radius:4px;">
            @error('email')
                <p style="color:red;font-size:0.9rem;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:0.5rem;">
            <label for="password" style="display:block;margin-bottom:0.5rem;">Password</label>
            <input type="password" id="password" name="password" required
                style="width:100%;padding:0.5rem;border:1px solid #ccc;border-radius:4px;">
            @error('password')
                <p style="color:red;font-size:0.9rem;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:0.5rem;">
            <label for="password_confirmation" style="display:block;margin-bottom:0.5rem;">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                style="width:100%;padding:0.5rem;border:1px solid #ccc;border-radius:4px;">
        </div>

        <button type="submit" style="width:100%;padding:0.75rem;background-color:#28a745;color:#fff;border:none;border-radius:4px;font-weight:600;cursor:pointer;">
            Register
        </button>

        <p style="text-align:center;margin-top:1rem;">
            Already have an account?
            <a href="{{ route('login') }}" style="color:#007bff;text-decoration:none;">Login here</a>
        </p>
    </form>
</div>
@endsection
