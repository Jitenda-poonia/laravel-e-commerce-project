@extends('layouts.web')
@section('content')
<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 70vh; text-align: center; background-color: #f8f9fa; padding: 20px;">
    <h1 style="font-size: 3.5rem; color: #343a40; margin-bottom: 1rem;">404</h1>
    <p style="font-size: 1.2rem; color: #6c757d; margin-bottom: 1.5rem;">Oops! The page you're looking for doesn't exist.</p>
    <a href="{{ url('/') }}" style="padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">
        Back to Home
    </a>
</div>
@endsection
