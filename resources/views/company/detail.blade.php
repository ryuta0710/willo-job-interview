@extends('layouts.company')

@section('title', '会社概要')

@section('content')
    <link rel="stylesheet" href="/assets/css/collection/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <main>

        <div class="container pt-5">
            <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><i class="fa-solid fa-play"></i>&nbsp;&nbsp;<a
                            href="{{ route('company.index') }}">企業</a>&nbsp;&nbsp;&nbsp;</li>
                    <li class="breadcrumb-item active" aria-current="page"><i
                            class="fa-solid fa-angle-right fw-bold"></i>&nbsp;&nbsp;&nbsp;{{ $company->name }}</li>
                </ol>
            </nav>
        </div>
        <!-- DASHBOARD -->
        <section id="sec-dashboard">
            <div class="container pt-4">
                <div class="state px-3 d-flex justify-content-around justify-content-lg-between align-items-center mb-2">
                    <div class="value d-flex gap-5">
                        <div class="pe-2">
                            <span class="text-primary">開始</span>
                            <span class="all_count">{{ $all_count }}</span>人
                        </div>
                        <div class="pe-2">
                            <span class="text-primary">回答した</span>
                            <span class="response_count">{{ $responses_count }}</span>人(<span class="response_rate">
                                @if ($all_count != 0)
                                    {{ number_format(($responses_count / $all_count) * 100, 2) }}
                                @else
                                    0
                                @endif
                            </span>%)
                        </div>
                    </div>
                    <div class="w-auto">

                    </div>
                    <select type="text" class="form-select rounded-pill w-auto fs-6" id="period" placeholder="">
                        <option value="today">本日</option>
                        <option value="yesterday">昨日</option>
                        <option value="7days">過去7日</option>
                        <option value="30days">過去30日</option>
                        <option value="curMonth" selected>今月</option>
                        <option value="pastMonth">先月</option>
                    </select>
                </div>
                <div id="dashboard">
                    <canvas id="chart" style="width:100%; height: 300px;"></canvas>
                </div>
            </div>

        </section>
        <!-- END DASHBOARD -->
        <!-- CARD BOX -->
        <section id="sec-card-box">
            <div class="container pt-5">
                <div class="row">
                    @foreach ($jobs as $item)
                        <div class="col-12 col-lg-6">
                            <div class="card bg-white shadow m-auto mt-4 p-3" style="width: 400px; max-width: 500px;">
                                <div class="">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div><a
                                                href="{{ route('myjob.show', ['myjob' => $item->id]) }}">{{ $item->title }}</a>
                                        </div>
                                        <div>
                                            <div class="form-check form-switch">
                                                @if ($item->status == 'live')
                                                    <input class="form-check-input job-allow" checked type="checkbox" data-id="{{ $item->id }}">
                                                @endif
                                                @if ($item->status == 'closed')
                                                    <input class="form-check-input job-allow" type="checkbox" data-id="{{ $item->id }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text-secondary">スタート: </span>{{ $item['started'] }}人
                                        </div>
                                        <div class="col-6">
                                            <span class="text-secondary">開始日:
                                            </span>{{ date('Y/m/d', strtotime($item->created_at)) }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text-secondary">回答: </span>{{ $item['responsed'] }} 人
                                        </div>
                                        <div class="col-6">
                                            <span class="text-secondary">終了日: </span>
                                            @if ($item->limit_date)
                                                {{ date('Y/m/d', strtotime($item->limit_date)) }}
                                            @else
                                                制限なし
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </section>
        <!-- CARD BOX -->
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script>
        $(document).ready(function() {

            $("#chart").width($("#dashboard").width())
            const xValues = [
                @foreach ($candidates_data as $item)
                    "{{ $item['date'] }}",
                @endforeach
            ];
            $(".job-allow").change(function(e) {
                console.log('sadf')
                const job_id = $(this).attr("data-id");
                const val = e.target.checked ? "live" : "closed";
                $.ajax({
                    url: '/interview/'+job_id+'/status',
                    type: 'POST',
                    data: {
                        _token: $("meta[name=csrf-token]").attr("content"),
                        status: val,
                    },
                    success: function(response) {
                        // window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON.message == "Unauthenticated") {
                            window.location.reload();
                        }
toastr.error(xhr.responseJSON.message);
                    }
                });
            })

            new Chart("chart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        data: [
                            @foreach ($candidates_data as $item)
                                "{{ $item['count'] }}",
                            @endforeach
                        ],
                        borderColor: "#FF33FF",
                        fill: false
                    }, {
                        data: [
                            @foreach ($response_data as $item)
                                "{{ $item['count'] }}",
                            @endforeach
                        ],
                        borderColor: "#15D1F8",
                        fill: false
                    }]
                },
                options: {

                    responsive: true, // Adjust based on parent container size
                    maintainAspectRatio: false, // Chart will not take in aspect ratio, allowing full customisability.
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) {
                                    if (Number.isInteger(value)) {
                                        return value;
                                    }
                                },
                                stepSize: 1
                            },
                            gridLines: {
                                display: true,
                            }
                        }, ],
                        xAxes: [{
                            gridLines: {
                                display: false,
                                lineWidth: 1,
                                // color: red,
                            }
                        }],
                    }

                }
            });

            $("#period").change(function() {
                let period = $("#period").val();
                $.ajax({
                    url: '/company/{{ $company->id }}/fetch/' + period,
                    type: 'get',
                    data: {
                        _token: $("meta[name=csrf-token]").attr("content"),
                    },
                    success: function(response) {
                        let response_rate = 0;
                        if (response.all_count != 0) {
                            response_rate = response.responses_count / response.all_count * 100;
                            response_rate = response_rate.toFixed(2);
                        }
                        $(".response_rate").html(response_rate);
                        $(".all_count").html(response.all_count);
                        $(".response_count").html(response.responses_count);
                        const xValues = response.response_data.map(function(item) {
                            return item.date;
                        });
                        const response_count = response.response_data.map(function(item) {
                            return item.count;
                        });
                        const all_count = response.candidates_data.map(function(item) {
                            return item.count;
                        });

                        new Chart("chart", {
                            type: "line",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    data: all_count,
                                    borderColor: "#FF33FF",
                                    fill: false
                                }, {
                                    data: response_count,
                                    borderColor: "#15D1F8",
                                    fill: false
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                legend: {
                                    display: false
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            callback: function(value) {
                                                if (Number.isInteger(
                                                        value)) {
                                                    return value;
                                                }
                                            },
                                            stepSize: 1
                                        },
                                        gridLines: {
                                            display: true,
                                        }
                                    }, ],
                                    xAxes: [{
                                        gridLines: {
                                            display: false,
                                            lineWidth: 1,
                                            // color: red,
                                        }
                                    }],
                                }

                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON.message == "Unauthenticated") {
                            window.location.reload();
                        }
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            })
        })
    </script>
@endsection
