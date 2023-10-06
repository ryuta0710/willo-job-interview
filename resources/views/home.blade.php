@extends('layouts.company')

@section('content')
    <link rel="stylesheet" href="./assets/css/collection/style.css">
    <main>
        <!-- CARD BOX -->
        <section id="card-box">
            <div class="container">
                <div class="card position-relativer mt-5">
                    <a class="close position-absolute fs-4" href="javascript:;"><i
                            class="fa-regular fa-plus cursor-pointer"></i></a>
                    <h4 class="mb-3">こんにちは、始めましょう...</h4>
                    <p class="mb-2">次の手順に従って 3 分以内に面接を開始するか、ビデオをご覧ください
                    </p>
                    <p class="mb-2">
                        <a href="{{ route('company.create') }}"><span class="text-primary fs-4 align-middle"><i
                                    class="fa-regular fa-circle-check"></i></span>
                            会社概要を設定しましょう</a>
                    </p>
                    <p class="mb-2">
                        <a href="{{ route('myjob.create') }}"><span class="text-primary fs-4 align-middle"><i
                                    class="fa-regular fa-circle-check"></i></span>
                            最初のインタビューを作成しましょう</a>
                    </p>
                    <p class="mb-2">
                        <a href="{{ route('user.index') }}"><span class="text-primary fs-4 align-middle"><i
                                    class="fa-regular fa-circle-check"></i></span>
                            インタビューに人々を招待しましょう</a>
                        {{-- <a href="{{ route('invite-people') }}"><span class="text-primary fs-4 align-middle"><i class="fa-regular fa-circle-check"></i></span>
                            インタビューに人々を招待しましょう</a> --}}
                    </p>
                </div>
            </div>

        </section>
        <!-- END CARD BOX -->
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
                            <span class="response_count">{{ $responses_count }}</span>人(<span class="response_rate">@if ($all_count != 0)
                                {{ number_format(($responses_count / $all_count) * 100, 2) }}
                            @else
                                0
                            @endif</span>%)
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
                <div class="d-flex justify-content-around justify-content-xxl-between gap-2 fs-14 flex-wrap">
                    <div class="card w-25">
                        <p class="mb-4">すべてのアクティブなインタビュー</p>
                        <p class="fs-4">{{ $live_jobs_count }}</p>
                        <p class="mt-4 pt-3">
                            <a href="{{ route('myjob.index') }}">アクティブなインタビューを見る</a>
                        </p>
                        <p>
                            <a href="{{ route('myjob.index') }}">新しいインタビューをリストする</a>
                        </p>
                    </div>
                    <div class="card w-25">
                        <p class="mb-4">回答率</p>
                        <p class="fs-4">
                            <span class="response_rate">@if ($all_count != 0)
                                {{ number_format(($responses_count / $all_count) * 100, 2) }}
                            @else
                                0
                            @endif <span>%
                        </p>
                    </div>
                    <div class="card w-25">
                        <p class="mb-4">現在の計画</p>
                        <p class="fs-4">成長</p>
                        <p class="mt-4 pt-3">反応</p>
                        <div class="mb-2 d-flex align-items-center gap-2">
                            <div>{{ $responses_count }}</div>
                            <div class="flex-grow-1 bg-secondary-subtle">
                                <div class="progress-bar bg-primary h-5" role="progressbar"
                                    style="width: @if ($all_count != 0) {{ ($responses_count / $all_count) * 100 }}% @else 0% @endif"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card w-25">
                        <p class="mb-4">質問がありますか?</p>
                        <p class="fs-4"></p>
                        <p class="mt-4 pt-3"> </p>
                        <a href="/contact" class="btn mt-5 mx-4 text-center px-4 rounded-5 text-white fw-bold fs-14"
                            id="job_add">
                            サポート問い合わせ先
                        </a>
                    </div>
                </div>
            </div>
            </div>

        </section>
        <!-- CARD BOX -->
    </main>
    {{-- {{ $candidates_data }} --}}
    <script src="./assets/js/collection/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script>
        $(document).ready(function() {

            $("#chart").width($("#dashboard").width())
            const xValues = [
                @foreach ($candidates_data as $item)
                    "{{ $item['date'] }}",
                @endforeach
            ];

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
                    url: '/fetch/' + period,
                    type: 'get',
                    data: {
                        _token: $("meta[name=csrf-token]").attr("content"),
                    },
                    success: function(response) {
                        let response_rate = 0;
                        if(response.all_count != 0){
                            response_rate = response.responses_count/response.all_count * 100;
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
                        alert(xhr.responseJSON.message);
                    }
                });
            })
        })
    </script>
@endsection
