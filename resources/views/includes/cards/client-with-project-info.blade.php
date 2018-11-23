<div class="card">
<div class="card-body d-flex flex-column">
    <div class="d-flex align-items-center pt-2 mt-auto">
        @if ($client->photo)
            <div class="avatar avatar-md mr-3" style="background-image: url({{ asset("storage/clientImage/{$client->photo}") }})"></div>
        @else
            <div class="avatar avatar-placeholder d-block mr-3"></div>
        @endif
        <div>
            <!-- TODO: link to client detail -->
            <a href="./profile.html" class="text-default">{{ $project->client->name }}</a>
            <div class="d-block text-muted">
                <span class="badge badge-success">{{ ucfirst($project->client->type->name) }}</span>
                <span class="badge badge-info">{{ ucfirst($project->client->status_text) }}</span>
            </div>
        </div>
        <div class="ml-auto">
            <a href="#" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-eye mr-1"></i></a>
        </div>
    </div>

    <div class="separator"></div>
    <h5 class="mt-3">{{ $project->name }}</h5>
    <p><i class="icon-box text-center mr-2"><i class="fa {{ $project->project_type->icon }}"></i></i> {{ $project->project_type->name }}</p>
</div>
</div>
