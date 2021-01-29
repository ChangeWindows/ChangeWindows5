<div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-g">
    <div class="card shadow border-0 h-100 overflow-hidden">
        <div class="p-3 text-white" style="{{ $channel->bg_color }}">
            <i class="fab fa-fw fa-windows"></i> {{ $channel->name }}
        </div>
        @can('edit_channel')
            <div class="d-flex justify-content-between align-items-center card-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.channels.edit', $channel) }}" class="btn btn-primary btn-sm"><i class="far fa-fw fa-pencil"></i> Edit</a>
                </div>
            </div>
        @endcan
    </div>
</div>
