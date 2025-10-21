@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container" style="max-width:300px;margin:20px auto;padding:2rem;border:1px solid #ddd;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1)">
    <h1 style="text-align:center;margin-bottom:1rem;">Login</h1>
    <p style="text-align:center;color:#666;">Please enter your credentials to log in.</p>

    <form action="{{ route('login') }}" method="POST" style="margin-top:1.5rem;">
        @csrf

        <div style="margin-bottom:1rem;">
            <label for="email" style="display:block;margin-bottom:0.5rem;">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                placeholder="Enter your email"
                value="{{ old('email') }}"
                required
                style="width:95%;padding:0.5rem;border:1px solid #ccc;border-radius:4px;"
            >
            @error('email')
                <p style="color:red;font-size:0.9rem;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom:1rem;">
            <label for="password" style="display:block;margin-bottom:0.5rem;">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                placeholder="Enter your password"
                required
                style="width:95%;padding:0.5rem;border:1px solid #ccc;border-radius:4px;"
            >
            @error('password')
                <p style="color:red;font-size:0.9rem;">{{ $message }}</p>
            @enderror
        </div>


        {{-- Display global login error --}}
        @if($errors->has('login_error'))
            <p style="color:red;font-size:0.9rem;margin-bottom:1rem;">
                {{ $errors->first('login_error') }}
            </p>
        @endif

        <br>

        <button
            type="submit"
            style="width:100%;padding:0.5rem;background-color:#da2128;color:#fff;border:none;border-radius:4px;font-weight:600;cursor:pointer;"
        >
            Login
        </button>
    </form>

</div>
@endsection
