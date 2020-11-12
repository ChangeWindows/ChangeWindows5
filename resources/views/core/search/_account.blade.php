<div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-g">
    <div class="card shadow border-0 h-100">
        <div style="background-image: url({{ $account->avatar }})" class="card-img-top"></div>
        <div class="card-body d-flex flex-column">
            <div class="d-flex flex-row">
                <div class="flex-grow-1">
                    <h3 class="card-title h6 mb-0">{{ $account->name }}</h3>
                </div>
            </div>
            <div class="flex-grow-1"></div>
            @can('edit_user')
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="btn-group">
                        <a href="{{ route('admin.accounts.edit', $account) }}" class="btn btn-primary btn-sm"><i class="far fa-fw fa-pencil"></i> Bewerk</a>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</div>
