@extends('errors.layout')

@section('code', '404')
@section('title', 'Not found')

@section('image')
    <div style="background-image: url({{ asset('/svg/404.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', 'We can\'t find what you\'re looking for... Try again later.')
