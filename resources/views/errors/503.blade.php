@extends('layouts.web')

@section('content')
<div style="align-items: center; justify-content: center; text-align: center; background-color: #f8f9fa; padding: 20px;">
    <h1 style="font-size: 3.5rem; color: #343a40; margin-bottom: 1rem;">503</h1>
    <p style="font-size: 1.2rem; color: #6c757d; margin-bottom: 1.5rem;">Service Unavailable</p>
    <p style="font-size: 1rem; color: #6c757d; margin-bottom: 2rem;">
        Our service is temporarily down. Please try again later.
    </p>
    <a href="{{ url('/') }}" style="padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">
        Back to Home
    </a>
</div>
@endsection
