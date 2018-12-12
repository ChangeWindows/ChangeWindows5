@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Changelogs</a></li>
                <li class="breadcrumb-item"><a href="#">PC</a></li>
                <li class="breadcrumb-item active">18290</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <a class="btn btn-primary" href="{{ route('createChangelogs') }}"><i class="fal fa-fw fa-plus"></i> Add changelog</a>
    </div>
    <div class="col-12">
        @foreach ($changelogs as $changelog)
            <p>{{ $changelog->build }}.{{ $changelog->delta }} {{ $changelog->platform }}</p>
        @endforeach
    </div>
    <div class="col-12">
        {{ $changelogs->links() }}
    </div>
</div>
@endsection