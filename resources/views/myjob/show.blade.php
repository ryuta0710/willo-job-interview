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
                                class="fa-solid fa-angle-right fw-bold"></i>&nbsp;&nbsp;&nbsp;募集トピック</li>
                    </ol>
                </nav>
                <div class="w-100 d-flex justify-content-center justify-content-md-between flex-wrap flex-lg-nowrap">
                    <div class="d-flex gap-5">
                        <div class="d-flex gap-5">
                            <h4>募集トピック</h4>
                        </div>
                        <div class="cs-state pb-2 bt-2 text-black h-85">ライブ</div>

                    </div>
                    <div class="d-flex gap-5">
                        <div>ライブ</div>
                        <div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                            </div>
                        </div>

                    </div>
                </div>
                <p class="pt-1">採用担当名</p>
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column flex-md-row flex-wrap gap-3 px-2 fs-14">
                        <a class="cs-state bg-primary text-white px-4 w-auto" href="">
                            <i class="fa-solid fa-share-nodes"></i>
                            招待
                        </a>
                        <a class="cs-state border-gray bg-white text-black px-4 w-auto" href="">
                            <i class="fa-regular fa-edit"></i>
                            編集
                        </a>
                        <a class="cs-state border-gray bg-white text-black px-4 w-auto" href="">
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
                                {{ $all_responded }}名（{{ $per5 }}％）
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
                        placeholder="名前で検索する" value="">
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
                            <p class="fs-14">
                                <a href="{{ route('myjob.person', ['myjob' => 1, 'user_id' => 1]) }}">応募者名</a>
                            </p>
                            <p class="fs-10">2023 年 6 月 29 日</p>
                        </div>

                    </div>
                    <!-- END INTERVIEW TIEM --> --}}

                    </div>
                    <div class="col2 d-flex flex-column px-2 gap-4  mb-4">
                        <div class=" position-relative">レビューする&nbsp;&nbsp;&nbsp;
                            <span class="badge rounded-pill px-3 bg-2">{{ count($reviews) }}</span>
                        </div>
                        @foreach ($reviews as $item)
                            <!-- INTERVIEW ITEM -->
                            <div
                                class="bg-5 border-start border-5 border-primary rounded-end-4 d-flex gap-3 p-2 px-3 pt-3">
                                <div class="avatar">
                                    <img src="{{ asset('/assets/img/company/avatar.png') }}" alt="avatar">
                                </div>
                                <div class="content">
                                    <p class="fs-14"><a
                                            href="{{ route('myjob.person', ['myjob' => $job_id, 'candidate_id' => $item->id]) }}">{{ $item->name }}</a>
                                    </p>
                                    <p class="fs-10">{{ date('Y', strtotime($item->updated_at)) }}年
                                        {{ date('m', strtotime($item->response_at)) }}月
                                        {{ date('d', strtotime($item->response_at)) }}日</p>
                                </div>

                            </div>
                            <!-- END INTERVIEW TIEM -->
                        @endforeach

                    </div>
                    <div class="col3 d-flex flex-column gap-4 px-2">
                        <div class=" position-relative">承認されました&nbsp;&nbsp;&nbsp;
                            <span class="badge rounded-pill px-3 bg-2">{{ count($accepts) }}</span>
                        </div>
                        @foreach ($accepts as $item)
                            <!-- INTERVIEW ITEM -->
                            <div
                                class="bg-5 border-start border-5 border-success rounded-end-4 d-flex gap-3 p-2 px-3 pt-3">
                                <div class="avatar">
                                    <img src="{{ asset('/assets/img/company/avatar.png') }}" alt="avatar">
                                </div>
                                <div class="content">
                                    <p class="fs-14"><a
                                            href="{{ route('myjob.person', ['myjob' => $job_id, 'candidate_id' => $item->id]) }}">{{ $item->name }}</a>
                                    </p>
                                    <p class="fs-10">{{ date('Y', strtotime($item->updated_at)) }}年
                                        {{ date('m', strtotime($item->response_at)) }}月
                                        {{ date('d', strtotime($item->response_at)) }}日</p>
                                    <p class="fs-10 text-warning">
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
                        <!-- END INTERVIEW TIEM -->

                    </div>
                    <div class="col4 d-flex flex-column gap-4 px-2">
                        <div class=" position-relative">拒否されました&nbsp;&nbsp;&nbsp;
                            <span class="badge rounded-pill px-3 bg-4">{{ count($rejects) }}</span>
                        </div>
                        @foreach ($rejects as $item)
                            <!-- INTERVIEW ITEM -->
                            <div
                                class="bg-5 border-start border-5 border-primary rounded-end-4 d-flex gap-3 p-2 px-3 pt-3">
                                <div class="avatar">
                                    <img src="{{ asset('/assets/img/company/avatar.png') }}" alt="avatar">
                                </div>
                                <div class="content">
                                    <p class="fs-14"><a
                                            href="{{ route('myjob.person', ['myjob' => $job_id, 'candidate_id' => $item->id]) }}">{{ $item->name }}</a>
                                    </p>
                                    <p class="fs-10">{{ date('Y', strtotime($item->updated_at)) }}年
                                        {{ date('m', strtotime($item->response_at)) }}月
                                        {{ date('d', strtotime($item->response_at)) }}日</p>
                                </div>

                            </div>
                            <!-- END INTERVIEW TIEM -->
                        @endforeach

                    </div>
                </div>

            </div>
        </section>


    </main>
    <script>
        let search_ranking = [];
        $(".rating").click(function() {
            $(this).find("i").toggleClass("fa-solid").toggleClass("fa-regular");
            var ranking = parseInt($(this).attr("data-value"));
            if (ranking) {
                search_ranking = search_ranking.filter(function(val) {
                    return val != ranking
                });
                if ($(this).find("i").hasClass("fa-solid")) {
                    search_ranking.push(ranking);
                }
            }
        });
        $("#clear").click(function() {
            $(".rating .fa-solid").toggleClass("fa-solid").toggleClass("fa-regular");
        })
    </script>
@endsection
