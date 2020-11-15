<div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-g">
    <div class="card shadow border-0 h-100 overflow-hidden">
        <div class="p-3 text-white" style="{{ $milestone->bg_color }}">
            <i class="fab fa-fw fa-windows"></i> {{ $milestone->osname }} version {{ $milestone->version }}
        </div>
        <div class="card-body d-flex flex-column">
            <div class="d-flex flex-row">
                <div class="flex-grow-1">
                    <h3 class="card-title h6 mb-0">{{ $milestone->osname }} version {{ $milestone->version }}</h3>
                    <p class="text-muted m-0"><small>{{ $milestone->name }}</small></p>
                </div>
            </div>
            <div class="flex-grow-1"></div>
        </div>
        @can('edit_milestone')
            <div class="d-flex justify-content-between align-items-center card-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.milestones.edit', $milestone) }}" class="btn btn-primary btn-sm"><i class="far fa-fw fa-pencil"></i> Edit</a>
                </div>
            </div>
        @endcan
    </div>
</div>
