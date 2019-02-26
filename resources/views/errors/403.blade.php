@extends('errors.layout')

@section('code', '403')
@section('title', 'Forbidden')

@section('message', $exception->getMessage() ?: 'Sorry, you are forbidden from accessing this page.')
