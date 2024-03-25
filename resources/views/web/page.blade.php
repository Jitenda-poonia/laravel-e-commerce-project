@extends('layouts.web')
@section('title')
    <title>MultiShop | {{$pages->title }}</title>
@endsection
@section('content')
    <style>
        img {
            width: 90%;
        }

        .image.image-style-side {
            width: 30%;
            float: right;
        }
    </style>

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{'/'}}">Home</a>
                    <span class="breadcrumb-item active">{{$pages->title }}</span>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                class="bg-secondary pr-3">{{$pages->heading}}</span></h2>
    </div>

    {{-- banner image --}}
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <img src="{{$pages->getFirstMediaUrl('image') }}">
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                {!!$pages->description !!}
            </div>
        </div>
    </div>


@endsection