@extends('layouts.app')

@section('hero')
<a class="hero" href="{{ route('viv') }}">
    <span class="text">
        <span class="h2">viv Preview</span>
        <span class="h5">The ChangeWindows 5 Preview is here, let us walk you through it</span>
    </span>
</a>
@endsection

@section('content')
@foreach ($releases as $release)
    <p>{{ $release->build }}.{{ $release->delta }} &middot; {{ $release->flight }} &middot; {{ $release->device }}</p>
@endforeach

{{ $releases->links() }}
@endsection