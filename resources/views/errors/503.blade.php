@extends('errors.layout')

@section('code', '503')
@section('title', 'Service unavailable')

@section('image')
    <div style="background-image: url({{ asset('/svg/503.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', $exception->getMessage() ?: 'Sorry, we are doing some maintenance. Please check back soon.')
