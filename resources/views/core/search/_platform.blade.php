<div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-g">
    <div class="card shadow border-0 h-100 d-flex flex-column">
        <div class="group-icon text-white px-3 py-4 text-center rounded-top" style="background-color: {{ $platform->color }}">
            <span class="fa-2x">{!! $platform->plain_icon !!}</span>
        </div>
        <div class="card-body d-flex flex-column">
            <div class="d-flex flex-row">
                <div class="flex-grow-1 text-break">
                    <h3 class="card-title h6 mb-1">{{ $platform->name }}</h3>
                    <p class="text-muted m-0"><small>{{ $platform->channelPlatforms->count() }} channels</small></p>
                </div>
            </div>
            <div class="flex-grow-1"></div>
            @can('edit_platform')
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('admin.platforms.edit', $platform) }}" class="btn btn-primary btn-sm"><i class="far fa-fw fa-pencil"></i> Edit</a>
                </div>
            @endcan
        </div>
    </div>
</div>
