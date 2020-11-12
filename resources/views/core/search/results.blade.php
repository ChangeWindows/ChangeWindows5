@extends('core.layouts.app')
@section('title') Zoeken @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Zoekresultaten</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.search') }}">Zoeken</a></li>
        <li class="breadcrumb-item active">Zoekresultaten</li>
    </ol>
</div>
<div class="content-box">
    @if ($search_results->count() === 0)
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h3 class="mt-5 mb-0">We konden niks vinden...</h3>
                <p>Probeer eens te zoeken op een andere term.</p>
            </div>
            <div class="col-12 col-sm-10 col-md-9 col-lg-7 col-xl-6 col-xxl-5 mb-5">
                <form class="d-flex shadow rounded" action="{{ route('admin.search.find') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input class="form-control form-control-lg border-0" type="search" name="search" placeholder="Zoeken..." aria-label="Zoeken..." accesskey="s">
                        <button class="btn btn-primary btn-lg" type="submit"><i class="far fa-fw fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <h3 class="h5 title">{{ $search_results->count() }} resultaten voor "{{ request('search') }}"</h3>
            </div>
            <div class="col-12 card-set">
                <div class="row">
                    @foreach($search_results->groupByType() as $type => $model)
                        <div class="col-12 h6 text-primary mb-3">{{ ucfirst($type) }}</div>
                        @foreach($model as $search_result)
                            @includeWhen(get_class($search_result->searchable) === 'App\Activity', 'core.search._activity', ['activity' => $search_result->searchable])
                            @includeWhen(get_class($search_result->searchable) === 'App\Camp', 'core.search._camp', ['camp' => $search_result->searchable])
                            @includeWhen(get_class($search_result->searchable) === 'App\Challenge', 'core.search._challenge', ['challenge' => $search_result->searchable])
                            @includeWhen(get_class($search_result->searchable) === 'App\Event', 'core.search._event', ['event' => $search_result->searchable])
                            @includeWhen(get_class($search_result->searchable) === 'App\Group', 'core.search._group', ['group' => $search_result->searchable])
                            @includeWhen(get_class($search_result->searchable) === 'App\Member', 'core.search._member', ['member' => $search_result->searchable])
                            @includeWhen(get_class($search_result->searchable) === 'App\Task', 'core.search._task', ['task' => $search_result->searchable])
                            @includeWhen(get_class($search_result->searchable) === 'App\Theme', 'core.search._theme', ['theme' => $search_result->searchable])
                            @includeWhen(get_class($search_result->searchable) === 'App\User', 'core.search._account', ['account' => $search_result->searchable])
                            @includeWhen(get_class($search_result->searchable) === 'App\Highlight', 'core.search._highlight', ['highlight' => $search_result->searchable])
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
