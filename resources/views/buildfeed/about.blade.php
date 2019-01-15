@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="mb-4"><i class="fal fa-fw fa-rss"></i> BuildFeed data</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('buildfeed') }}">
                    Buildfeed
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ URL::to('buildfeed/about') }}">
                    About
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h4>*Gasp* Are you starting Bui-</h4>
        <p><b>No.</b> We are only hosting this data as an archive of the original <a href="https://buildfeed.com">BuildFeed</a>. We have no intend to continue expanding on it. Its only purpose here is for it to be readable online in a "not-a-12-MB-JSON-file"-way. This data is the BuildFeed data, unchanged, as it was. If you're looking for the latest and greatest buildstrings from internal builds from Microsoft (or public builds, for that matter), this is not the page you want to be on.</p>
        <h4>Can we at least have some filters prety please?</h4>
        <p>We are still building this new version of ChangeWindows, much still has to come and while we won't be expanding on this data, we will eventually make it look nice and make it filter-able.</p>
    </div>
</div>
@endsection

@section('modals')

@endsection