@extends('errors.layout')

@section('code', '503')
@section('title', 'Service unavailable')

@section('message', $exception->getMessage() ?: 'Sorry, we are doing some maintenance. Please check back soon.')
