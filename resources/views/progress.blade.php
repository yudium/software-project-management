@extends('template.master')
@section('title', 'Progress Proyek')

@section('css')
<style>
ul {
    list-style: none;
}
.separator-left {
    border-left: 1px solid #ddd;
}
.avatar {
    background: purple;
    color: white;
}

ul#task li {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
ul#task li:hover {
    overflow: visible;
}
ul#task li:hover > span.anticipate-long-text {
    position: relative;
    z-index: 9;
    background-color: #2b52e0;
    box-shadow: 0 0 12px 3px blue;
    color: white;
}
</style>

@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Progress Tracker
        </h1>
    </div>

    <div class="row">
        <div class="col-7 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center mb-6">
                        <div class="col-auto">
                            <div class="avatar avatar-lg rounded d-block">
                                <i class="fe fe-activity"></i>
                            </div>
                        </div>
                        <div class="col">
                            <div class="h3 m-0 font-weight-normal">{{ $project->name }}</div>
                        </div>
                    </div>

                    <div class="row" id="fixed-font-size">
                        <div class="col">
                            <h5 class="mb-1">Jumlah Task</h5>
                            <div class="text-muted-dark">{{ $number_of_task }}</div>
                        </div>
                        <div class="col">
                            <h5 class="mb-1">Task Selesai</h5>
                            <div class="text-muted-dark">{{ $number_of_task_complete }}</div>
                        </div>
                        <div class="col">
                            <h5 class="mb-1">Progress Terbaru</h5>
                            <div class="text-muted-dark">
                                @if ($last_complete_task)
                                    {{ Carbon::now()->diffInHours(Carbon::parse($last_complete_task['date'])) }} jam yang lalu
                                @else
                                    --
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <h5 class="mb-1">Deadline</h5>
                            <div class="text-muted-dark">{{ date('d M Y', strtotime($project->endtime)) }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="display-4 font-weight-bold mb-4">{{ number_format($progress_percent, 0) }}%</div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-red" style="width: {{ $progress_percent}}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <h5>Daftar Task</h5>
                            <ul id="task">
                            @foreach (getTrelloList($board_id, ['fields' => 'name'], $auth) as $list)
                                <li>
                                    <b>{{ $loop->iteration }}. {{ $list['name'] }} <span class="text-muted">(list)</span></b>
                                    <ul>
                                        @foreach (getTrelloCard($list['id'], ['fields' => 'name'], $auth) as $card)
                                            <li>
                                                <b>{{ $card['name'] }} <span class="text-muted">(card)</span></b>
                                                <ul>
                                                    @foreach (getTrelloChecklist($card['id'], ['fields' => 'name'], $auth) as $checklist)
                                                        <li>
                                                            <b>{{ $checklist['name'] }} <span class="text-muted">(checklist)</span></b>
                                                            <ul>
                                                                @foreach ($checklist['checkItems'] as $checkItem)
                                                                    <li>
                                                                        <span class="anticipate-long-text">
                                                                            @if ($checkItem['state'] == 'complete')
                                                                                <i class="fe fe-check-circle text-green"></i>
                                                                            @elseif ($checkItem['state'] == 'incomplete')
                                                                                <i class="fe fe-arrow-right-circle"></i>
                                                                            @endif
                                                                            {{ $checkItem['name'] }}
                                                                        </span>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                        <div class="col-5 separator-left">
                            <h5 class="mb-1">Riwayat Progress</h5>
                            {{-- It seems trello API return action sorted by recent action.
                                We will depend on this situation, otherwise we will have work to sort
                                json by "date" key --}}
                            <ul class="list-unstyled mt-4">
                            @php
                            $counter = 0;
                            @endphp
                            @foreach (getTrelloAction($board_id, null, $auth) as $action)
                                @if ($action['type'] === 'updateCheckItemStateOnCard')
                                    @php
                                    $counter++;
                                    if ($counter > 8) break;
                                    @endphp
                                    <li>
                                        @if (($state = $action['data']['checkItem']['state']) === 'complete')
                                            <div>
                                                <b><i class="fe fe-check-square text-green mr-2"></i>{{ $action['data']['checkItem']['name'] }}</b>
                                                <div class="small text-muted ml-5">
                                                    Selesai {{ Carbon::now()->diffInHours(Carbon::parse($action['date'])) }} jam yang lalu
                                                </div>
                                            </div>
                                        @elseif ($state === 'incomplete')
                                            <div>
                                                <b><i class="fe fe-delete text-red mr-2"></i>{{ $action['data']['checkItem']['name'] }}</b>
                                                <div class="small text-muted ml-5">
                                                    {{ Carbon::now()->diffInHours(Carbon::parse($action['date'])) }} jam yang lalu
                                                </div>
                                            </div>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
