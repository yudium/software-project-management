<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Client</h3>
        @if ($ganti_button)
        <div class="card-options">
            <a href="{{ route('create-project-step1') }}" class="btn btn-primary btn-sm">Ganti</a>
        </div>
        @endif
    </div>
    <div class="card-body d-flex flex-column">
        <div class="d-flex align-items-center pt-2 mt-auto">
            <div class="avatar avatar-md mr-3" style="background-image: url(./demo/faces/female/18.jpg)"></div>
            <div>
                <a href="./profile.html" class="text-default">{{ $client->name }}</a>
                <div class="d-block text-muted">
                    <span class="badge badge-success">{{ ucfirst($client->type->name) }}</span>
                    <span class="badge badge-info">{{ ucfirst($client->status_text) }}</span>
                </div>
            </div>
            <div class="ml-auto">
                <a href="#" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-eye mr-1"></i></a>
            </div>
        </div>
    </div>
</div>
