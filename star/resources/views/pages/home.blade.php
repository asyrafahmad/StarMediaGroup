@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container" style="max-width: 600px; margin: 2rem auto; text-align: center;">
    <h1 style="margin-bottom: 1rem;">Welcome to the Home Page</h1>

    {{-- Display consent data if available --}}
    @if(isset($consent))
        @php
            $consentData = is_string($consent) ? json_decode($consent, true) : $consent;
        @endphp

        <h3>User Consent Details</h3>
        <table style="margin: 1rem auto; border-collapse: collapse; width: 100%; max-width: 500px;">
            <thead>
                <tr style="background: #f4f4f4;">
                    <th style="padding: 8px; border: 1px solid #ddd;">Key</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consentData as $key => $value)
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $key }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">
                            @if($key === 'accepted_at' && !empty($value))
                                {{ \Carbon\Carbon::parse($value)->format('d M Y, h:i A') }}
                            @else
                                {{ is_array($value) ? json_encode($value) : $value }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p><em>No consent cookie found.</em></p>

        <p>Inspiration comes in many forms.
Understanding this, Star Media Group strives to inspire beyond just the printed word by offering a variety of rich content through various touchpoints. Through our offerings, we are able to connect with our audiences across different interests.</p>

        <p>From news and current affairs to lifestyle, entertainment, sports, business, technology, health and wellness, we bring you closer to the things that matter to you.</p>
        <p>Discover more about us on our <a href="{{ route('about') }}" style="color:#da2128;text-decoration:none;">About / Contact</a> page.</p>

    @endif
</div>
@endsection
