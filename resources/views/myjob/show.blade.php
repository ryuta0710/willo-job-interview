@extends('layouts.company')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/collection/style.css') }}">
    <main>
        <section id="" class="mt-5">
            <div class="container px-3">
                <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><i class="fa-solid fa-play"></i>&nbsp;&nbsp;<a
                                href="#">インタビュー</a>&nbsp;&nbsp;&nbsp;</li>
                        <li class="breadcrumb-item active" aria-current="page"><i
                                class="fa-solid fa-angle-right fw-bold"></i>&nbsp;&nbsp;&nbsp;{{ $job->title }}</li>
                    </ol>
                </nav>
                <div class="w-100 d-flex justify-content-center justify-content-md-between flex-wrap flex-lg-nowrap">
                    <div class="d-flex gap-5">
                        <div class="d-flex gap-5">
                            <h4>{{ $job->title }}</h4>
                        </div>
                        @if ($job->status == 'draft')
                            <div class="cs-state pb-2 bt-2 bg-secondary-subtle h-85">草案</div>
                        @endif
                        @if ($job->status == 'live')
                            <div class="cs-state pb-2 bt-2 text-black h-85">募集中</div>
                        @endif
                        @if ($job->status == 'finish')
                            <div class="cs-state pb-2 bt-2 bg-danger-subtle h-85">募集完了</div>
                        @endif
                        @if ($job->status == 'closed')
                            <div class="cs-state pb-2 bt-2 bg-warning-subtle h-85">クローズド</div>
                        @endif
                    </div>
                    <div class="d-flex gap-5">
                        <div>募集中</div>
                        <div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                    @if ($job->status == 'live') checked @endif>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="pt-1">{{ $company->name }}</p>
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column flex-md-row flex-wrap gap-3 px-2 fs-14">
                        <a class="cs-state bg-primary text-white px-4 w-auto"
                            href="{{ route('invite-people', ['myjob' => $job->id]) }}">
                            <i class="fa-solid fa-share-nodes"></i>
                            招待
                        </a>
                        <a class="cs-state border-gray bg-white text-black px-4 w-auto"
                            href="{{ route('myjob.edit', ['myjob' => $job->id]) }}">
                            <i class="fa-regular fa-edit"></i>
                            編集
                        </a>
                        <a class="cs-state border-gray bg-white text-black px-4 w-auto"
                            href="{{ route('getJobDetail', ['url' => $job->url]) }}">
                            <i class="fa-solid fa-eye"></i>
                            プレビュー
                        </a>
                    </div>
                    <div class="d-flex">
                        <div class="" style="width:36px;">
                            <img src="{{ asset('/assets/img/avatar/01.png') }}" style="width:44px;height: 44px;"
                                class="rounded-circle border border-1 border-white" alt="">
                        </div>
                        <div class="" style="width:36px;">
                            <img src="{{ asset('/assets/img/avatar/01.png') }}" style="width:44px;height: 44px;"
                                class="rounded-circle border border-1 border-white" alt="">
                        </div>
                        <div class="">
                            <a href="{{ route('invite-people', ['myjob' => $job_id]) }}">
                                <img src="{{ asset('/assets/img/avatar/user-plus.png') }}" style="width:44px;height: 44px;"
                                    class="rounded-circle border border-1 border-white" alt="">
                            </a>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="card-box w-100 d-flex flex-wrap gap-3 px-2 fs-14">
                    <div class="card rounded-4 p-3">
                        <div class="row mt-3">
                            <div class="col-4">
                                <span>招待者:</span>
                            </div>
                            <div class="col-8 row">
                                <div class="col-10">
                                    <div class="progress h-5 mt-2">
                                        <div class="progress-bar bg-success h-5" role="progressbar"
                                            style="width: {{ $per1 }}%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-2">0</div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <span>レビューする:</span>
                            </div>
                            <div class="col-8 row">
                                <div class="col-10">
                                    <div class="progress h-5 mt-2">
                                        <div class="progress-bar bg-info h-5" role="progressbar"
                                            style="width: {{ $per2 }}%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>

                                </div>
                                <div class="col-2">{{ count($reviews) }}</div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4 pe-0">
                                <span>受け入れられました:</span>
                            </div>
                            <div class="col-8 row">
                                <div class="col-10">
                                    <div class="progress h-5 mt-2">
                                        <div class="progress-bar bg-warning h-5" role="progressbar"
                                            style="width: {{ $per3 }}%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>

                                </div>
                                <div class="col-2">{{ count($accepts) }}</div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <span>拒否されました:</span>
                            </div>
                            <div class="col-8 row">
                                <div class="col-10">
                                    <div class="progress h-5 mt-2">
                                        <div class="progress-bar bg-danger h-5" role="progressbar"
                                            style="width: {{ $per4 }}%" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>

                                </div>
                                <div class="col-2">{{ count($rejects) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-4 p-3">
                        <div class="row mt-3">
                            <div class="col-4">
                                開始:
                            </div>
                            <div class="col-8">
                                {{ $all_count }}人
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                回答:
                            </div>
                            <div class="col-8">
                                {{ $all_responded }}名（{{ number_format($per5, 2) }}％）
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-4">
                                始める:
                            </div>
                            <div class="col-8">
                                {{ date('Y', strtotime($job->created_at)) }}年
                                {{ date('m', strtotime($job->created_at)) }}月
                                {{ date('d', strtotime($job->created_at)) }}日
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                終わり:
                            </div>
                            <div class="col-8">
                                @if (!$job->limit_date)
                                    終了日なし
                                    @else{{ explode('/', $job->limit_date)[0] }}年 {{ explode('/', $job->limit_date)[1] }}月
                                    {{ explode('/', $job->limit_date)[2] }}日
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div
                    class="w-100 px-3 d-flex flex-column flex-md-row flex-wrap gap-3 align-items-center text-warning justify-content-evenly">
                    <input type="text" class="form-control rounded-5 fs-14 max-w-285 lh-lg order-3 order-xl-0"
                        placeholder="名前で検索する" value="" id="search_keyword">
                    <div class="lh-lg text-black">
                        <span>ランキング</span>
                    </div>
                    <div class="rating rounded-4 bg-white border-gray text-yellow px-3 py-1" data-value="1"
                        role="button">
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <div class="rating rounded-4 bg-white border-gray text-yellow px-3 py-1" data-value="2"
                        role="button">
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <div class="rating rounded-4 bg-white border-gray text-yellow px-3 py-1" data-value="3"
                        role="button">
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <div class="rating rounded-4 bg-white border-gray text-yellow px-3 py-1" data-value="4"
                        role="button">
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <div class="rating rounded-4 bg-white border-gray text-yellow px-3 py-1" data-value="5"
                        role="button">
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <button
                        class="cs-state border-gray bg-white text-black px-4 w-auto rounded-5 fs-14 max-w-158 ms-auto lh-lg order-4"
                        id="clear">すべてクリア</button>

                </div>
                <div class="w-100 d-flex row-cols-1 row-cols-sm-2 row-cols-lg-4 flex-wrap px-4 pt-4 pb-5">
                    <div class="col1 d-flex flex-column gap-4 px-2 mb-4">
                        <div class=" position-relative">招待されました&nbsp;&nbsp;&nbsp;
                            <span class="badge rounded-pill px-3 bg-1">0</span>
                        </div>
                        {{-- <!-- INTERVIEW ITEM -->
                    <div class="bg-5 border-start border-5 border-secondary rounded-end-4 d-flex gap-3 p-2 px-3 pt-3dp">
                        <div class="avatar">
                            <img src="{{ asset('/assets/img/company/avatar.png') }}" alt="avatar">
                        </div>
                        <div class="content">
                            <p class="fs-14 mb-1">
                                <a href="{{ route('myjob.person', ['myjob' => 1, 'user_id' => 1]) }}">応募者名</a>
                            </p>
                            <p class="fs-10 mb-1">2023 年 6 月 29 日</p>
                        </div>

                    </div>
                    <!-- END INTERVIEW TIEM --> --}}

                    </div>
                    <div class="col2 d-flex flex-column px-2 gap-4  mb-4" id="review_list">
                        <div class="position-relative">レビューする&nbsp;&nbsp;&nbsp;
                            <span class="badge rounded-pill px-3 bg-2 review_count">{{ count($reviews) }}</span>
                        </div>
                        @foreach ($reviews as $item)
                            <!-- INTERVIEW ITEM -->
                            <div
                                class="bg-5 border-start border-5 border-primary rounded-end-4 d-flex gap-3 p-2 px-3 pt-3">
                                <div class="avatar">
                                    <img src="{{ asset('/assets/img/company/avatar.png') }}" alt="avatar">
                                </div>
                                <div class="content">
                                    <p class="fs-14 mb-1"><a
                                            href="{{ route('myjob.person', ['myjob' => $job_id, 'candidate_id' => $item->id]) }}">{{ $item->name }}</a>
                                    </p>
                                    <p class="fs-10 mb-1">{{ date('Y', strtotime($item->response_at)) }}年
                                        {{ date('m', strtotime($item->response_at)) }}月
                                        {{ date('d', strtotime($item->response_at)) }}日</p>
                                </div>

                            </div>
                            <!-- END INTERVIEW TIEM -->
                        @endforeach

                    </div>
                    <div class="col3 d-flex flex-column gap-4 px-2" id="accepted_list">
                        <div class=" position-relative">承認されました&nbsp;&nbsp;&nbsp;
                            <span class="badge rounded-pill px-3 bg-3 accepted_count">{{ count($accepts) }}</span>
                        </div>
                        @foreach ($accepts as $item)
                            <div
                                class="bg-5 border-start border-5 border-success rounded-end-4 d-flex gap-3 p-2 px-3 pt-3">
                                <div class="avatar">
                                    <img src="{{ asset('/assets/img/company/avatar.png') }}" alt="avatar">
                                </div>
                                <div class="content">
                                    <p class="fs-14 mb-1"><a
                                            href="{{ route('myjob.person', ['myjob' => $job_id, 'candidate_id' => $item->id]) }}">{{ $item->name }}</a>
                                    </p>
                                    <p class="fs-10 mb-1">{{ date('Y', strtotime($item->response_at)) }}年
                                        {{ date('m', strtotime($item->response_at)) }}月
                                        {{ date('d', strtotime($item->response_at)) }}日</p>
                                    <p class="fs-10 text-warning mb-1">
                                        @if ($item->review > 0)
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $item->review)
                                                    <i class="fa-solid fa-star"></i>
                                                @else
                                                    <i class="fa-regular fa-star"></i>
                                                @endif
                                            @endfor
                                            &nbsp;&nbsp;
                                            <span class="text-black">({{ $item->review }})</span>
                                        @endif
                                    </p>
                                </div>

                            </div>
                        @endforeach

                    </div>
                    <div class="col4 d-flex flex-column gap-4 px-2" id="rejected_list">
                        <div class=" position-relative">拒否されました&nbsp;&nbsp;&nbsp;
                            <span class="badge rounded-pill px-3 bg-4 rejected_count">{{ count($rejects) }}</span>
                        </div>
                        @foreach ($rejects as $item)
                            <div
                                class="bg-5 border-start border-5 border-primary rounded-end-4 d-flex gap-3 p-2 px-3 pt-3">
                                <div class="avatar">
                                    <img src="{{ asset('/assets/img/company/avatar.png') }}" alt="avatar">
                                </div>
                                <div class="content">
                                    <p class="fs-14 mb-1"><a
                                            href="{{ route('myjob.person', ['myjob' => $job_id, 'candidate_id' => $item->id]) }}">{{ $item->name }}</a>
                                    </p>
                                    <p class="fs-10 mb-1">{{ date('Y', strtotime($item->response_at)) }}年
                                        {{ date('m', strtotime($item->response_at)) }}月
                                        {{ date('d', strtotime($item->response_at)) }}日</p>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </section>


    </main>
    <script>
        let rate = null;
        $(".rating").click(function() {
            $(".rating i").removeClass("fa-solid").addClass("fa-regular");
            $(this).find("i").addClass("fa-solid").removeClass("fa-regular");
            var ranking = parseInt($(this).attr("data-value"));
            if (ranking) {
                rate = ranking;
                search_candidates();
            }
        });
        $("#search_keyword").change(function() {
            search_candidates();
        });
        $("#clear").click(function() {
            window.location.reload();
        })
        $("#flexSwitchCheckChecked").change(function(e) {
            const val = e.target.checked ? "live" : "closed";
            $.ajax({
                url: '{{ route('interview.status', ['id' => $job->id]) }}',
                type: 'POST',
                data: {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    status: val,
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message == "Unauthenticated") {
                        window.location.reload();
                    }
                    alert(xhr.responseJSON.message);
                }
            });
        });

        function search_candidates() {
            const keyword = $("#search_keyword").val().trim();
            $.ajax({
                url: '{{ route('interview.search', ['id' => $job->id]) }}',
                type: 'POST',
                data: {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    rate: rate,
                    keyword: keyword
                },
                success: function(response) {
                    const reviews = response.review;
                    const accepted = response.accepted;
                    const rejected = response.rejected;
                    $(".review_count").text(reviews.length);
                    $(".accepted_count").text(accepted.length);
                    $(".rejected_count").text(rejected.length);
                    let dis = "";
                    reviews.forEach(ele => {

                        dis += `<div
                                class="bg-5 border-start border-5 border-primary rounded-end-4 d-flex gap-3 p-2 px-3 pt-3">
                                <div class="avatar">
                                    <img src="{{ asset('/assets/img/company/avatar.png') }}" alt="avatar">
                                </div>
                                <div class="content">
                                    <p class="fs-14 mb-1"><a
                                            href="/myjob/{{ $job->id }}/${ele.id}/person">${ele.name}</a>
                                    </p>
                                    <p class="fs-10 mb-1">${toStringDate(ele.response_at)}</p>
                                </div>

                            </div>`;
                    });
                    $("#review_list > div:not(.position-relative)").remove();
                    $("#review_list").append(dis);
                    dis = "";
                    accepted.forEach(ele => {

                        let rate_dis = "";
                        for (let i = 0; i < 5; i++) {
                            if (ele.review > i) {
                                rate_dis +=
                                    `<i class="fa-solid fa-star" style="width: 11.5px" data-val="${i+1}"></i> `;
                            } else {
                                rate_dis +=
                                    `<i class="fa-regular fa-star" style="width: 11.5px" data-val="${i+1}"></i> `;
                            }
                        }
                        dis += `<div
                                class="bg-5 border-start border-5 border-success rounded-end-4 d-flex gap-3 p-2 px-3 pt-3">
                                <div class="avatar">
                                    <img src="{{ asset('/assets/img/company/avatar.png') }}" alt="avatar">
                                </div>
                                <div class="content">
                                    <p class="fs-14 mb-1"><a
                                            href="/myjob/{{ $job->id }}/${ele.id}/person">${ele.name}</a>
                                    </p>
                                    <p class="fs-10 mb-1">${toStringDate(ele.response_at)}</p>
                                    <p class="fs-10 text-warning mb-1 rate_dis">
                                        ${rate_dis}<span class="text-black ms-1"> (${ele.review})</span>
                                    </p>
                                </div>

                            </div>`;
                    });
                    $("#accepted_list > div:not(.position-relative)").remove();
                    $("#accepted_list").append(dis);
                    dis = "";
                    rejected.forEach(ele => {

                        dis += `<div
                                class="bg-5 border-start border-5 border-primary rounded-end-4 d-flex gap-3 p-2 px-3 pt-3">
                                <div class="avatar">
                                    <img src="{{ asset('/assets/img/company/avatar.png') }}" alt="avatar">
                                </div>
                                <div class="content">
                                    <p class="fs-14 mb-1"><a
                                            href="/myjob/{{ $job->id }}/${ele.id}/person">${ele.name}</a>
                                    </p>
                                    <p class="fs-10 mb-1">${toStringDate(ele.response_at)}</p>
                                </div>

                            </div>`;
                    });
                    $("#rejected_list > div:not(.position-relative)").remove();
                    $("#rejected_list").append(dis);
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message == "Unauthenticated") {
                        window.location.reload();
                    }
                    alert(xhr.responseJSON.message);
                }
            });
        }

        function toStringDate(str) {
            let arr = str.split('/');
            return arr[0] + "年 " + arr[1] + "月 " + arr[2] + "日";
        }
    </script>
@endsection
