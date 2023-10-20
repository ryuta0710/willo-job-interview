@extends('layouts.company')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/common/plyr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/slick/slick-theme.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/css/application/fileupload.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/collection/applicant.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/collection/timeline.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        .show-answer-text {
            height: 350px !important;
            max-width: 600px;
        }

        .slick-prev:before,
        .slick-next:before {
            display: none !important;
        }

        .slick-next.slick-arrow,
        .slick-prev.slick-arrow {
            display: none !important;
        }

        .reject-active {
            border-bottom: 3px solid #4cadee;
        }

        #booking_table td:not(.active, :first-child) * {
            visibility: hidden;
        }

        #booking_table td:first-child {
            line-height: 43px;
        }

        .show-answer-text {
            height: 350px !important;
            max-width: 600px;
        }

        .avatar-big img {
            width: 35px !important;
        }

        .avatar-small img {
            width: 25px !important;
        }
    </style>
    <main>
        <section id="sec_applicant">
            <div class="container max-1200">
                <div class="row">
                    <button class="col-1 pt-5 btn border-0" id="slider_before" @disabled($prev == 0)>
                        <svg xmlns="http://www.w3.org/2000/svg" width="23.44" height="39.881" viewBox="0 0 23.44 39.881">
                            <path id="left" d="M2024.4-6367.952l-9.369,9.369-5.621,5.622,14.99,14.99"
                                transform="translate(-2005.912 6372.901)" fill="none" stroke="#707070"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="7" />
                        </svg>
                    </button>
                    <div class="col-10 row slider-for">
                        <div class="container">
                            <div class="row" style="user-select: text">
                                <div class="col-12 col-lg-7">
                                    <div class="d-flex flex-column flex-md-row">
                                        <!-- avatar -->
                                        <div class="me-4 pt-2 text-center text-md-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                                viewBox="0 0 100 100">
                                                <g id="avatar-default" transform="translate(-431 -163)">
                                                    <circle id="Ellipse_37" data-name="Ellipse 37" cx="50"
                                                        cy="50" r="50" transform="translate(431 163)"
                                                        fill="#6e6e6e" />
                                                    <path id="Icon_awesome-user-alt" data-name="Icon awesome-user-alt"
                                                        d="M23.841,26.822A13.411,13.411,0,1,0,10.431,13.411,13.414,13.414,0,0,0,23.841,26.822ZM35.762,29.8H30.631a16.212,16.212,0,0,1-13.578,0H11.921A11.92,11.92,0,0,0,0,41.723v1.49a4.471,4.471,0,0,0,4.47,4.47H43.213a4.471,4.471,0,0,0,4.47-4.47v-1.49A11.92,11.92,0,0,0,35.762,29.8Z"
                                                        transform="translate(457.158 189.159)" fill="#fff" />
                                                </g>
                                            </svg>
                                        </div>
                                        <!-- end avatar -->
                                        <div class="px-3  text-center text-md-left">
                                            <p class="fs-4">{{ $candidate->name }}</p>

                                            <div class="rounded-4 bg-white border-gray text-yellow" id="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($candidate->review >= $i)
                                                        <i class="fa-solid fa-star" data-val="{{ $i }}"></i>
                                                    @else
                                                        <i class="fa-regular fa-star" data-val="{{ $i }}"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p class="pt-3">
                                                @if ($candidate->status == 'responsed')
                                                    レビュー中
                                                @endif
                                                @if ($candidate->status == 'accepted')
                                                    承認済み
                                                @endif
                                                @if ($candidate->status == 'rejected')
                                                    拒否されました
                                                @endif
                                            </p>
                                            <p class="mb-0">
                                                <a href="{{ route('myjob.show', ['myjob' => $candidate->job_id]) }}"
                                                    class="text-decoration-underline">{{ $job->title }}</a>
                                                &nbsp;&nbsp; の&nbsp;&nbsp;
                                                <a href="{{ route('company.detail', ['id' => $candidate->company_id]) }}"
                                                    class="text-decoration-underline">{{ $job->company_name }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5 ps-1 text-secondary border-start ps-4 border-5">
                                    <div class="d-flex flex-wrap pt-2">
                                        <div class="fs-4  min-30 text-center pe-2">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <div class="ps-1 pt-1 col-11 col-sm-10 col-md-11 col-lg-10">
                                            <span>{{ $candidate->tel }}</span>
                                        </div>
                                        <div class="fs-4 min-30 text-center pe-2">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <div class="ps-1 pt-1 col-11 col-sm-10 col-md-11 c col-lg-10">
                                            <span>{{ $candidate->email }}</span>
                                        </div>
                                        <div class="fs-4 min-30 text-center pe-2">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="ps-1 pt-1 col-11 col-sm-10 col-md-11 c col-lg-10">
                                            <span>日本</span>
                                        </div>
                                        <div class="fs-4 min-30 text-center pe-2">
                                            <i class="fa-solid fa-clock"></i>
                                        </div>
                                        <div class="ps-1 pt-1 col-11 col-sm-10 col-md-11 c col-lg-10">
                                            <span>現地時間:{{ date('H時 i分') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <button class="col-1 pt-5 btn  border-0" id="slider_next" @disabled($next == 0)>
                        <svg xmlns="http://www.w3.org/2000/svg" width="23.44" height="39.881" viewBox="0 0 23.44 39.881">
                            <path id="Path_162" data-name="Path 162"
                                d="M2009.412-6367.952l9.369,9.369,5.621,5.622-14.99,14.99"
                                transform="translate(-2004.462 6372.901)" fill="none" stroke="#707070"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="7" />
                        </svg>
                    </button>
                </div>
                <div class="row mt-5 d-flex flex-column flex-md-row align-items-center gap-4 ms-0 ms-185">
                    <button
                        class="btn-normal border border-success w-auto @if ($candidate->status == 'accepted') bg-white  text-success @else bg-green-strong text-white @endif"
                        onclick="accept(this,{{ $candidate->id }})">
                        <i class="fa-solid fa-check"></i>&nbsp;&nbsp;&nbsp;@if ($candidate->status == 'accepted')
                            受け入れた@else受け入れる
                        @endif
                    </button>
                    <button
                        class="btn-normal border border-danger bg-red-strong w-auto @if ($candidate->status == 'rejected') bg-white text-danger @else text-white bg-warning-strong @endif"
                        data-bs-toggle="modal" data-bs-target="#refuseModal">
                        <i class="fa-solid fa-check"></i>&nbsp;&nbsp;&nbsp;@if ($candidate->status == 'rejected')
                            拒否されました@else拒絶
                        @endif
                    </button>
                    <button class="btn-normal w-auto" data-bs-toggle="modal" data-bs-target="#shareModal">
                        <i class="fa-solid fa-share-nodes"></i>&nbsp;&nbsp;&nbsp;共有</button>
                </div>
            </div>
            <div class="container max-1200 px-70 pt-3">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">インタビュー</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">可用性</a>
                    </li>
                </ul><!-- Tab panes -->
                <div class="tab-content">
                    <!-- TAB 1 -->
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">

                        <div id="test-confirm"
                            class="test-confirm w-100 d-flex flex-wrap flex-lg-nowrap justify-content-center gap-3">
                            <div class="flex-grow-1">
                                <div class="test-problem-no ms-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chat-left-dots-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                    </svg>
                                    &nbsp;&nbsp;
                                    <span>
                                        質問<span class="question_no">1</span>

                                    </span>
                                </div>
                                <div class="w-100 pl-md-0 pl-lg-73">
                                    <div class="test-title ms-4 fs-4">
                                        {{ $answers[0]->question_content }}
                                    </div>
                                    <div id="test-preview" class="w-100 mb-4" style="min-height: 350px;">
                                        @if ($questions[0]->type == 'video')
                                            <video class="rounded-4 w-100 h-100" crossorigin=""
                                                playsinlineposter="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                                                <source src="{{ $questions[0]->rc_url }}" type="video/mp4"
                                                    size="300">
                                                <a>Video</a>
                                            </video>
                                        @endif
                                        @if ($questions[0]->type == 'audio')
                                            <video class="rounded-4 w-100 h-100" crossorigin=""
                                                playsinlineposter="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                                                <source src="{{ $questions[0]->rc_url }}" type="video/mp4"
                                                    size="300">
                                                <a>Video</a>
                                            </video>
                                        @endif
                                        @if ($questions[0]->type == 'text')
                                            <div class="rounded-4 bg-secondary-subtle show-answer-text p-4">
                                                {{ $questions[0]->content }}
                                            </div>
                                        @endif
                                        @if ($questions[0]->type == 'file')
                                            <div class="file-upload-contain" style="min-height: 350px;max-width: 600px;">
                                                <div class="file-drop-zone clickable" style="min-height: 350px;">
                                                    <div class="file-drop-zone-title">
                                                        <div class="upload-area">
                                                            <p class="file_preview">$questions[0]->content</p>
                                                            <div> ダウンロードするには<a class="btn_upload"
                                                                    href="{{ $questions[0]->re_url }}">こちら</a>をクリック。
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($answers[0]->question_type == 'ai')
                                            <div class="chat-box w-100 w-lg-50">
                                                <div class="header">
                                                    <div class="avatar-wrapper avatar-big d-inline-block">
                                                        <img src="{{ asset('/assets/img/avatar/bot.png') }}"
                                                            alt="avatar" />
                                                    </div>
                                                    <span class="name">AIチャット</span>
                                                    <span class="options">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </span>
                                                </div>
                                                <div class="chat-room">
                                                    @php
                                                        $messages = json_decode($answers[0]->content, true);
                                                    @endphp
                                                    @foreach ($messages as $item)
                                                        @if ($item['sender'] == 'bot')
                                                            <div class="message message-left">
                                                                <div class="avatar-wrapper avatar-small">
                                                                    <img src="{{ asset('/assets/img/avatar/bot.png') }}"
                                                                        alt="avatar" />
                                                                </div>
                                                                <div class="bubble bubble-light">
                                                                    {{ $item['message'] }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($item['sender'] == 'person')
                                                            <div class="message message-right">
                                                                <div class="avatar-wrapper avatar-small">
                                                                    <img src="{{ asset('/assets/img/avatar/01.png') }}"
                                                                        alt="avatar" />
                                                                </div>
                                                                <div class="bubble bubble-dark">
                                                                    {{ $item['message'] }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="answer-list">
                                <p class="ps-3">回答<span class="question_no">1</span>/{{ $count }}</p>
                                <!-- BOX LIST -->
                                <div
                                    class="list-box card rounded-2 px-2 m-auto d-flex flex-column py-2  align-items-center shadow gap-2 w-100">
                                    @for ($i = 0; $i < $count; $i++)
                                        @if ($answers[$i]->question_type == 'video')
                                            <!-- VIDEO BOX -->
                                            <div class="answer-item p-1 rounded-3 d-flex gap-4 active" data-type="video"
                                                data-content="{{ $answers[$i]->rc_url }}" data-no="{{ $i }}"
                                                data-bs-toggle="modal" data-bs-target="#video_preview">
                                                <!-- HEADER -->
                                                <div class="answer-type text-center pt-0 rounded d-none d-sm-block">
                                                    <video class="rounded-4 w-100 h-100" crossorigin=""
                                                        playsinlineposter="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                                                        <source src="{{ asset('./assets/video/interview01.mp4') }}"
                                                            type="video/mp4" size="300">
                                                        <a>Video Oynatılamıyor</a>
                                                    </video>
                                                </div>
                                                <!-- CONTENT -->
                                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                                    <div class="w-100 pt-3 pb-2">
                                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                                            alt="chat">
                                                        &nbsp;&nbsp;&nbsp;質問{{ $i + 1 }}
                                                    </div>
                                                    <p>{!! $answers[$i]->question_content !!}</p>
                                                </div>
                                            </div>
                                            <!-- END VIDEO BOX -->
                                        @endif
                                        @if ($answers[$i]->question_type == 'audio')
                                            <!-- VOICE BOX -->
                                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="voice"
                                                data-content="{{ $answers[$i]->rc_url }}" data-no="{{ $i }}">
                                                <!-- HEADER -->
                                                <div class="answer-type text-center pt-0 rounded d-none d-sm-block">
                                                    <img src="{{ asset('/assets/img/application/answer-voice.png') }}"
                                                        alt="">
                                                </div>
                                                <!-- CONTENT -->
                                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                                    <div class="w-  100 pt-3 pb-2">
                                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                                            alt="chat">
                                                        &nbsp;&nbsp;&nbsp;質問{{ $i + 1 }}
                                                    </div>
                                                    <p>{!! $answers[$i]->question_content !!}</p>

                                                </div>
                                            </div>
                                            <!-- END BOX -->
                                        @endif
                                        @if ($answers[$i]->question_type == 'text')
                                            <!--WRITING BOX -->
                                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="writing"
                                                data-no="{{ $i }}">
                                                <input type="hidden" name="" value="{!! $answers[$i]->content !!}">
                                                <!-- HEADER -->
                                                <div class="answer-type text-center rounded-2 d-none d-sm-block">
                                                    <i class="fa-solid fa-align-center"></i>
                                                    <div class="mt-3">
                                                        <span>ワード数:{{ strlen($answers[$i]->content) }} </span>
                                                    </div>
                                                </div>
                                                <!-- END HEADER -->
                                                <!-- CONTENT -->
                                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                                    <div class="w-100 pt-3 pb-2">
                                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                                            alt="chat">
                                                        &nbsp;&nbsp;&nbsp;質問{{ $i + 1 }}
                                                    </div>
                                                    <p>{!! $answers[$i]->question_content !!}</p>

                                                </div>
                                                <!-- END CONTENT -->
                                            </div>
                                            <!-- END BOX -->
                                        @endif
                                        @if ($answers[$i]->question_type == 'file')
                                            <!-- FILE UPLOAD BOX -->
                                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="file"
                                                data-no="{{ $i }}">
                                                <!-- HEADER -->
                                                <div class="answer-type text-center rounded-2 d-none d-sm-block">
                                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                                    <div class="mt-3">
                                                        <span>{{ $answers[$i]->content }}</span>
                                                    </div>
                                                </div>
                                                <!-- CONTENT -->
                                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                                    <div class="w-100 pt-3 pb-2">
                                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                                            alt="chat">
                                                        &nbsp;&nbsp;&nbsp;質問{{ $i + 1 }}
                                                    </div>
                                                    {{ $answers[$i]->question_content }}
                                                </div>
                                            </div>
                                            <!-- END BOX -->
                                        @endif
                                        @if ($answers[$i]->question_type == 'ai')
                                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="ai"
                                                data-no="{{ $i }}">
                                                <!-- HEADER -->
                                                <div class="answer-type text-center rounded-2 d-none d-sm-block pt-3">
                                                    <img src="{{ asset('/assets/img/avatar/icon-bot.png') }}"
                                                        alt="" style="width: 60px;">
                                                    <div class="mt-2">
                                                        <span>AIチャット</span>
                                                    </div>
                                                </div>
                                                <!-- CONTENT -->
                                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                                    <div class="w-100 pt-3 pb-2">
                                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                                            alt="chat">
                                                        &nbsp;&nbsp;&nbsp;質問{{ $i + 1 }}
                                                    </div>
                                                    {{ $answers[$i]->question_content }}
                                                </div>
                                            </div>
                                        @endif
                                    @endfor
                                    <!-- END BOX -->

                                </div>
                                <!-- END LIST -->
                            </div>
                        </div>
                        <div class="container mt-5">
                            <div class="max-590">
                                <div class="form-group">
                                    <input type="text" class="form-control rounded-5 px-4" placeholder="メモを書いてください..."
                                        name="note" id="note">
                                </div>
                                <div
                                    class="w-100 d-flex flex-wrap vertial-center aling-items-center justify-content-between">
                                    <p class="pt-4 mt-1 ms-5 text-md-nowrap">メモは組織内のユーザーのみに表示されます</p>
                                    <button class="btn-normal bg-secondary-subtle mt-4 mx-auto mb-3 pointer"
                                        id="add_note" disabled>メモを追加</button>
                                </div>
                                <p>アクティビティ</p>
                                <div class="w-100" id="timeline">
                                    <div class="timeline-container" style="width: 100%;">
                                        <ul class="tl" style="width: 100%;">
                                            @foreach ($activities as $item)
                                                <li>
                                                    <div class="item-icon">
                                                        @switch($item->type)
                                                            @case('visit_interview_page')
                                                                <i class="fa-solid fa-eye" style="color: #4ca7ee"></i>
                                                            @break

                                                            @case('mail')
                                                                <svg id="Group_2359" data-name="Group 2359"
                                                                    xmlns="http://www.w3.org/2000/svg" width="25"
                                                                    height="25" viewBox="0 0 25 25">
                                                                    <path id="Path_164" data-name="Path 164"
                                                                        d="M26.917,7.292A7.292,7.292,0,1,1,19.625,0,7.293,7.293,0,0,1,26.917,7.292ZM23.484,4.474a1.028,1.028,0,0,0-1.469,0L18.583,7.9,17.234,6.557a1.039,1.039,0,0,0-1.469,1.469l2.083,2.083a1.028,1.028,0,0,0,1.469,0l4.167-4.167A1.028,1.028,0,0,0,23.484,4.474ZM19.625,16.667A9.339,9.339,0,0,0,24.8,15.109a4.17,4.17,0,0,1-4.135,3.641H15.776l-5.99,3.99a1.042,1.042,0,0,1-1.62-.865V18.75A4.166,4.166,0,0,1,4,14.583V6.25A4.166,4.166,0,0,1,8.167,2.083h3.661a9.377,9.377,0,0,0,7.8,14.583Z"
                                                                        transform="translate(-1.917)" fill="#4ca7ee" />
                                                                    <path id="Path_165" data-name="Path 165" d="M0,0H25V25H0Z"
                                                                        fill="none" />
                                                                </svg>
                                                            @break

                                                            @case('mail_failed')
                                                                <svg id="Group_2359" data-name="Group 2359"
                                                                    xmlns="http://www.w3.org/2000/svg" width="25"
                                                                    height="25" viewBox="0 0 25 25">
                                                                    <path id="Path_164" data-name="Path 164"
                                                                        d="M26.917,7.292A7.292,7.292,0,1,1,19.625,0,7.293,7.293,0,0,1,26.917,7.292ZM23.663,3.7ZM19.625,16.667A9.339,9.339,0,0,0,24.8,15.109a4.17,4.17,0,0,1-4.135,3.641H15.776l-5.99,3.99a1.042,1.042,0,0,1-1.62-.865V18.75A4.166,4.166,0,0,1,4,14.583V6.25A4.166,4.166,0,0,1,8.167,2.083h3.661a9.377,9.377,0,0,0,7.8,14.583Z"
                                                                        transform="translate(-1.917)" fill="#F37E7E" />
                                                                    <path id="Path_165" data-name="Path 165" d="M0,0H25V25H0Z"
                                                                        fill="none" />
                                                                    <g id="Rectangle_359" data-name="Rectangle 359"
                                                                        transform="translate(14.069 2.91) rotate(45)"
                                                                        fill="#fff" stroke="#fff" stroke-width="1">
                                                                        <rect width="11" height="2" rx="1"
                                                                            stroke="none" />
                                                                        <rect x="0.5" y="0.5" width="10" height="1"
                                                                            rx="0.5" fill="none" />
                                                                    </g>
                                                                    <g id="Rectangle_360" data-name="Rectangle 360"
                                                                        transform="translate(20.433 2.91) rotate(45)"
                                                                        fill="#fff" stroke="#fff" stroke-width="1">
                                                                        <rect width="2" height="11" rx="1"
                                                                            stroke="none" />
                                                                        <rect x="0.5" y="0.5" width="1" height="10"
                                                                            rx="0.5" fill="none" />
                                                                    </g>
                                                                </svg>
                                                            @break

                                                            @case('note')
                                                                <i class="fa-solid fa-comment" style="color: #4ca7ee;"></i>
                                                            @break

                                                            @case('vote')
                                                                <i class="fa-solid fa-star" style="color: #4ca7ee;"></i>
                                                            @break

                                                            @case('accept')
                                                                <i class="fa-solid fa-check" style="color: #4ca7ee;"></i>
                                                            @break

                                                            @case('reject')
                                                                <i class="fa-solid fa-xmark" style="color: #F37E7E"></i>
                                                            @break

                                                            @case('response')
                                                                <i class="fa-solid fa-camera" style="color: #4ca7ee"></i>
                                                            @break

                                                            @default
                                                        @endswitch
                                                    </div>
                                                    <div class="item-text">
                                                        <div class="item-title">{{ $item->content }}</div>
                                                        <div class="item-detail">
                                                            {{ date('Y', strtotime($item->created_at)) }}年
                                                            {{ date('m', strtotime($item->created_at)) }}月
                                                            {{ date('d', strtotime($item->created_at)) }}日 @if (date('a', strtotime($item->created_at)) == 'am')
                                                                午前
                                                            @else
                                                                午後
                                                            @endif
                                                            {{ date('h:i:s', strtotime($item->created_at)) }}</div>
                                                    </div>
                                                    {{-- <div class="item-timestamp">
                                                        3rd March 2015<br> 19:00
                                                    </div> --}}
                                                </li>
                                            @endforeach

                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="w-100 mt-5 d-flex gap-5 justify-content-around">
                                <p>ライフサイクル ポリシーに基づいて、
                                    このメディアは 6 か月 ({{ date('Y/m/d', $candidate->created_at->addMonth(6)->timestamp) }})
                                    後に自動的に削除されます。</p>
                                <button class="btn-normal text-white align-self-center"
                                    id="delete"><span>消去</span></button>
                            </div>
                        </div>
                    </div>
                    <!-- END TAB 1 -->
                    <!-- TAB 2 -->
                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                        <!-- MEETING BOOXING -->
                        <div class="meeting-book">
                            <div class="w-100 pt-3">
                                <table id="booking_table"
                                    class="table table-hover table-bordered w-100 text-white text-center">
                                    <thead>
                                        <tr class="text-white">
                                            <th class="p-0"><i class="fa-solid fa-clock text-white"></i></th>
                                            {{-- <th class="text-white">木曜日</th>
                                            <th class="text-white">金曜日</th>
                                            <th class="text-white">月曜日</th>
                                            <th class="text-white">火曜日</th>
                                            <th class="text-white">水曜日</th> --}}
                                            @php
                                                use Carbon\Carbon;

                                                $currentDate = Carbon::createFromTimestamp(strtotime($candidate->response_at));
                                                $weekdaysCount = 0;
                                            @endphp

                                            @while ($weekdaysCount < 5)
                                                @if ($currentDate->isWeekday())
                                                    <th class="text-white">
                                                        @if ($currentDate->format('D') == 'Mon')
                                                            月曜日<br>{{ $currentDate->format('d') }}
                                                        @endif
                                                        @if ($currentDate->format('D') == 'Tue')
                                                            火曜日<br>{{ $currentDate->format('d') }}
                                                        @endif
                                                        @if ($currentDate->format('D') == 'Wed')
                                                            水曜日<br>{{ $currentDate->format('d') }}
                                                        @endif
                                                        @if ($currentDate->format('D') == 'Thu')
                                                            木曜日<br>{{ $currentDate->format('d') }}
                                                        @endif
                                                        @if ($currentDate->format('D') == 'Fri')
                                                            金曜日<br>{{ $currentDate->format('d') }}
                                                        @endif
                                                    </th>
                                                    @php $weekdaysCount++; @endphp
                                                @endif
                                                @php $currentDate->addDay(); @endphp
                                            @endwhile
                                        </tr>
                                    </thead>
                                    <tbody class="text-white">
                                        @php
                                            $timeslots = ['8:00', '8:30', '9:00', '9:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '17:30', '17:30', '18:00'];
                                        @endphp

                                        @foreach ($timeslots as $timeslot)
                                            <tr>
                                                <td>@php
                                                    $time = Carbon::createFromFormat('H:i', $timeslot);
                                                    $str = $time->format('a') === 'am' ? '午前' : '午後';
                                                @endphp
                                                    {{ $time->format('g:i') . ' ' . $str }}</td>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @php
                                                        $filteredBookings = $bookings->filter(function ($item) use ($i, $timeslot) {
                                                            return $item->day == $i && $item->time == $timeslot;
                                                        });
                                                        $val1 = Carbon::createFromTimestamp(strtotime($candidate->response_at . ' ' . $timeslot))->format('Ymd\THis\Z');
                                                        $val2 = Carbon::createFromTimestamp(
                                                            strtotime(
                                                                $candidate->response_at .
                                                                    ' ' .
                                                                    Carbon::createFromFormat('H:i', $timeslot)
                                                                        ->addMinutes(30)
                                                                        ->format('H:i'),
                                                            ),
                                                        )->format('Ymd\THis\Z');
                                                    @endphp
                                                    <td @if (count($filteredBookings)) class="active" @endif
                                                        style="position: relative;">
                                                        <div class="dropdown position-absolute"
                                                            style="width: 100%;padding-right: 8px;">
                                                            <a class="dropdown-toggle text-white d-block text-wrap"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                会議のスケジュールを設定する
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" target="blank"
                                                                        href="https://calendar.google.com/calendar/render?action=TEMPLATE&dates={{ $val1 }}/{{ $val2 }}&location=&text={{ $job->company_name }}, {{ $job->title }}- {{ $candidate->name }}&details=&add={{ $candidate->email }}.com">Google</a>
                                                                </li>
                                                                <li><a class="dropdown-item"
                                                                        href='{{ route('myjob.create_ics', ['candidate_id' => $candidate->id, 'date1' => $val1, 'date2' => $val2]) }}'>iCal</a>
                                                                </li>
                                                                <li><a class="dropdown-item"
                                                                        href='{{ route('myjob.create_ics', ['candidate_id' => $candidate->id, 'date1' => $val1, 'date2' => $val2]) }}'>Outlook</a>
                                                                </li>
                                                                <li><a target="blank" class="dropdown-item"
                                                                        href='https://calendar.yahoo.com/?v=60&view=d&type=20&title={{ $job->company_name }}, {{ $job->title }}- {{ $candidate->name }}&st={{ $val1 }}&dur=0005&desc=&in_loc=&inv_list={{ $candidate->email }}'>Yahoo</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-100 text-end">
                                <span>上記の時間帯のどれも当てはまりませんか？&nbsp;&nbsp;&nbsp;;&nbsp;</span>
                                <div class="dropdown d-inline-block">
                                    <a class="btn dropdown-toggle text-white rounded-5 btn-primary p-3" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                        id="meeting_book_ok">
                                        会議を作成する
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" target="blank"
                                                href="https://calendar.google.com/calendar/render?action=TEMPLATE&dates={{ $date1 }}/{{ $date2 }}&location=&text={{ $job->company_name }}, {{ $job->title }}- {{ $candidate->name }}&details=&add={{ $candidate->email }}.com">Google</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href='{{ route('myjob.create_ics', ['candidate_id' => $candidate->id, 'date1' => $date1, 'date2' => $date2]) }}'>iCal</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href='{{ route('myjob.create_ics', ['candidate_id' => $candidate->id, 'date1' => $date1, 'date2' => $date2]) }}'>Outlook</a>
                                        </li>
                                        <li><a target="blank" class="dropdown-item"
                                                href='https://calendar.yahoo.com/?v=60&view=d&type=20&title={{ $job->company_name }}, {{ $job->title }}- {{ $candidate->name }}&st={{ $date1 }}&dur=0005&desc=&in_loc=&inv_list={{ $candidate->email }}'>Yahoo</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END MEETING BOOKING -->
                    </div>
                    <!-- END TAB 2 -->
                </div>
            </div>
        </section>

    </main>


    <div class="modal fade" id="refuseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="py-3">
                        <div class="row justify-content-center mb-3">
                            <div class="col-6 text-center reject-active" id="reject_tab_1">拒絶
                            </div>
                            <div class="col-6 text-center" id="reject_tab_2">出金
                            </div>
                        </div>
                        <div class="row px-5 gap-3 mb-3 reject_tab_1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="社風に合わなかった"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    社風に合わなかった
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason"
                                    value="希望する資格を満たしていない" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    希望する資格を満たしていない
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="最低条件を満たしていない"
                                    id="flexRadioDefault3">
                                <label class="form-check-label" for="flexRadioDefault3">
                                    最低条件を満たしていない
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="審査要件を満たしていない"
                                    id="flexRadioDefault4">
                                <label class="form-check-label" for="flexRadioDefault4">
                                    審査要件を満たしていない
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="不完全なアプリケーション"
                                    id="flexRadioDefault5">
                                <label class="form-check-label" for="flexRadioDefault5">
                                    不完全なアプリケーション
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="場所で働く資格がない"
                                    id="flexRadioDefault6">
                                <label class="form-check-label" for="flexRadioDefault6">
                                    場所で働く資格がない
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="誤って伝えられた資格"
                                    id="flexRadioDefault7">
                                <label class="form-check-label" for="flexRadioDefault7">
                                    誤って伝えられた資格
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason"
                                    value="より適格な候補者が選択されました" id="flexRadioDefault8">
                                <label class="form-check-label" for="flexRadioDefault8">
                                    より適格な候補者が選択されました
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="無反応"
                                    id="flexRadioDefault9">
                                <label class="form-check-label" for="flexRadioDefault9">
                                    無反応
                                </label>
                            </div>
                        </div>
                        <div class="row px-5 gap-3 mb-3 reject_tab_2" style="display: none;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="別の仕事に就いた"
                                    id="flexRadioDefault111">
                                <label class="form-check-label" for="flexRadioDefault111">
                                    別の仕事に就いた
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="補償"
                                    id="flexRadioDefault211">
                                <label class="form-check-label" for="flexRadioDefault211">
                                    補償
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="個人的な理由"
                                    id="flexRadioDefault311">
                                <label class="form-check-label" for="flexRadioDefault311">
                                    個人的な理由
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="通勤"
                                    id="flexRadioDefault411">
                                <label class="form-check-label" for="flexRadioDefault411">
                                    通勤
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="文化的適合"
                                    id="flexRadioDefault511">
                                <label class="form-check-label" for="flexRadioDefault511">
                                    文化的適合
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="採用担当者のフォロー不足"
                                    id="flexRadioDefault611">
                                <label class="form-check-label" for="flexRadioDefault611">
                                    採用担当者のフォロー不足
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="紛らわしい職務内容"
                                    id="flexRadioDefault711">
                                <label class="form-check-label" for="flexRadioDefault711">
                                    紛らわしい職務内容
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="今の会社に残ります"
                                    id="flexRadioDefault811">
                                <label class="form-check-label" for="flexRadioDefault811">
                                    今の会社に残ります
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reject_reason" value="そもそも興味がない"
                                    id="flexRadioDefault911">
                                <label class="form-check-label" for="flexRadioDefault911">
                                    そもそも興味がない
                                </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button class="btn bg-secondary-subtle" id="reject_button" disabled>保 存</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">のリンクを共有</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">他のユーザーと共有できるリンクを生成します。サインインは必要ありません。</p>
                    <div class="row mb-3 px-4">
                        <div class="col-9">
                            <input type="text" name="" id="invite_url" class="form-control w-100"
                                placeholder="{{ route('publicCandidate', ['candidate_id' => $candidate->id]) }}"
                                value="{{ route('publicCandidate', ['candidate_id' => $candidate->share_link]) }}">
                        </div>
                        <div class="col-3 position-relative">
                            <div id="copy_tip"
                                class="position-absolute muted bg-dark text-white rounded text-center fs-12 my-tooltip"
                                style="display:none;padding:8px ;bottom: 40px; width: 200px; right: -44px; font-size: 12px;z-index: 1000;">
                                <span>リンクがコピーされました。</span>
                            </div>
                            <button class="btn btn-primary w-100" onclick="url_copy()" id="url_copy">コピー</button>
                        </div>
                    </div>
                    <div class="row mb-3 px-4">
                        <div class="col-6 d-flex justify-content-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="share_allow"
                                    @if ($candidate->share_allow == 1) checked @endif>
                                <label class="form-check-label" for="share_allow">リンク有効</label>
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-center align-items-center">
                            <i class="fa fa-eye me-3"></i> 0 ビュー
                        </div>
                    </div>
                    @foreach ($questions as $item)
                        <div class="row justify-content-between align-items-center px-4">
                            <div class="col-auto">
                                <i class="fa fa-message me-2"></i>質問{{ $item->question_no }}
                                <p class="ms-4">{{ $item->content }}</p>
                            </div>
                            <div class="col-auto">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="question{{ $item->id }}"
                                        checked>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row justify-content-between align-items-center px-4">
                        <p class="text-center">コンテンツは、このリンクを知っている人なら誰でも公關されます。 このリンクは、信頼できる人とのみ共有してください。</p>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="video_preview" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-4" id="exampleModalToggleLabel">ビデオ回答</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="px-5">ビデオ</h5>
                            <div class="pre-content border border-primary rounded-4 p-4">
                                <video controls crossorigin playsinline style="width: 100%; height: 100%;">
                                    <source src="{{ asset('/assets/video/interview01.mp4') }}" type="video/mp4"
                                        size="100">
                                    <a>Video Oynatılamıyor</a>
                                </video>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="px-5">評価内容</h5>
                            <div class="eval-content border border-primary rounded-4 p-4">
                                <p>評価内容評価内容評価内容評価内容評価内容</p>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <h5 class="px-5">回答内容</h5>
                            <div class="text-content border border-primary rounded-4 p-4">
                                <p>回答内容回答内容回答内容回答内容</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#video_preview" data-bs-toggle="modal">確認 </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="chat_preview" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-4" id="exampleModalToggleLabel">AIチャット回答</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="px-5">チャットメッセージ</h5>
                            <div class="pre-content border border-primary rounded-4 p-4">
                                <p>チャットメッセージチャットメッセージチャットメッセージチャットメッセージ</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5 class="px-5">設問分</h5>
                            <div class="eval-content border border-primary rounded-4 p-4">
                                <p>評価内容評価内容評価内容評価内容評価内容</p>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <h5 class="px-5">評価（テキスト）</h5>
                            <div class="text-content border border-primary rounded-4 p-4">
                                <p>回答内容回答内容回答内容回答内容</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#chatpreview" data-bs-toggle="modal">確認 </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/assets/js/common/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('/assets/js/common/plyr.min.js') }}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('/assets/js/slick/slick.js') }}"></script>
    <!-- Include the Quill library -->

    <script src="{{ asset('/assets/js/collection/applicant.js') }}"></script>
    <script>
        var plaryer = new Plyr('video', {
            muted: false,
            volume: 1,
            controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume',
                'fullscreen'
            ],
        });
        $("#note").keydown(function(e) {
            let note = $("#note").val().trim();
            console.log(note)
            if (note != "") {
                $("#add_note").addClass("bg-primary text-white").removeClass("bg-secondary-subtle").removeAttr(
                    "disabled");
            } else {
                $("#add_note").removeClass("bg-primary text-white").addClass("bg-secondary-subtle").attr("disabled",
                    "");
            }
        });
        @if ($prev)
            $("#slider_before").click(function() {
                location.href =
                    '{{ route('myjob.person', ['myjob' => $candidate->job_id, 'candidate_id' => $prev]) }}'
            })
        @endif
        @if ($next)
            $("#slider_next").click(function() {
                location.href =
                    '{{ route('myjob.person', ['myjob' => $candidate->job_id, 'candidate_id' => $next]) }}'
            })
        @endif
        $("#add_note").click(function() {
            $.ajax({
                url: '{{ route('myjob.add_note', ['candidate_id' => $candidate->id]) }}',
                type: 'post',
                data: {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    note: $("#note").val(),
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message == "Unauthenticated") {
                        window.location.reload();
                    }
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });

        function init_rate() {
            $("#rating i").click(function() {
                let rate = parseInt($(this).attr("data-val"));
                if (isNaN(rate)) {
                    return;
                }

                $.ajax({
                    url: '{{ route('myjob.candidate_review_change', ['candidate_id' => $candidate->id]) }}',
                    type: 'post',
                    data: {
                        _token: $("meta[name=csrf-token]").attr("content"),
                        review: rate,
                    },
                    success: function(response) {
                        let dis = "";
                        for (let i = 0; i < 5; i++) {
                            if (rate > i) {
                                dis +=
                                    `<i class="fa-solid fa-star" style="width: 21.5px" data-val="${i+1}"></i>`;
                            } else {
                                dis +=
                                    `<i class="fa-regular fa-star" style="width: 21.5px" data-val="${i+1}"></i>`;
                            }
                        }
                        $("#rating").html(dis);
                        init_rate();
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON.message == "Unauthenticated") {
                            window.location.reload();
                        }
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            })
        }
        init_rate();

        let answers = {!! $answers !!};
        $(".answer-item").click(function() {
            $(".answer-item").removeClass("active");
            $(this).addClass("active");
            let q_no = parseInt($(this).attr("data-no"));
            if (isNaN(q_no)) {
                return;
            }
            $(".question_no").html(q_no + 1);
            let privewEle = document.getElementById("test-preview")

            let type = $(this).attr("data-type");
            if (type == "writing") {
                let data = `
                <div class="rounded-4 bg-secondary-subtle show-answer-text p-4">
                    ${answers[q_no].content}
                </div>
                `
                privewEle.innerHTML = data;
            } else if (type == "video") {
                let data = $(this).attr("data-content");
                let ele =
                    '<video controls class="rounded-4 w-100 h-100" crossorigin >' +
                    '<source src="' + answers[q_no].rc_url + '" type="video/mp4" size="300">' +
                    '<a>Video</a>' +
                    '</video>';

                privewEle.innerHTML = ele;
                var plaryer = new Plyr('video', {
                    muted: false,
                    volume: 1,
                    controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume',
                        'fullscreen'
                    ],
                });
            } else if (type == "voice") {
                let data = $(this).attr("data-content");
                let ele =
                    '<video controls class="rounded-4 w-100 h-100" crossorigin >' +
                    '<source src="' + answers[q_no].rc_url + '" type="video/mp4" size="300">' +
                    '<a>Video</a>' +
                    '</video>';

                privewEle.innerHTML = ele;
                var plaryer = new Plyr('video', {
                    muted: false,
                    volume: 1,
                    controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume',
                        'fullscreen'
                    ],
                });
            } else if (type == "file") {
                privewEle.innerHTML = `
                    <div class="file-upload-contain" style="min-height: 350px;max-width: 600px;margin:0px;">
                        <div class="file-drop-zone clickable" tabindex="-1" style="min-height: 350px;max-width: 600px;">
                            <div class="file-drop-zone-title">
                                <div class="upload-area text-center fs-5">
                                    <p class="file_preview fs-4">${answers[q_no].content}</p>
                                    <div> ダウンロードするには<a class="btn_upload"
                                            href="${ answers[q_no].rc_url }" download>こちら</a>をクリック。
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
            } else if (type == "ai") {
                let messages = JSON.parse(answers[q_no].content);
                let chatHistory = "";
                messages.forEach(mes => {
                    if (mes.sender == "bot") {
                        chatHistory += `
                            <div class="message message-left">
                                <div class="avatar-wrapper avatar-small">
                                    <img src="{{ asset('/assets/img/avatar/bot.png') }}"
                                        alt="avatar" />
                                </div>
                                <div class="bubble bubble-light">
                                    ${mes.message}
                                </div>
                            </div>`;
                    }
                    if (mes.sender == "person") {
                        chatHistory += `
                            <div class="message message-right">
                                <div class="avatar-wrapper avatar-small">
                                    <img src="{{ asset('/assets/img/avatar/01.png') }}"
                                        alt="avatar" />
                                </div>
                                <div class="bubble bubble-dark">
                                    ${mes.message}
                                </div>
                            </div>`;

                    }
                });
                privewEle.innerHTML = `
                <div class="chat-box w-100 w-lg-50">
                    <div class="header">
                        <div class="avatar-wrapper avatar-big d-inline-block">
                            <img src="{{ asset('/assets/img/avatar/bot.png') }}" alt="avatar" />
                        </div>
                        <span class="name">AIチャット</span>
                        <span class="options">
                            <i class="fas fa-ellipsis-h"></i>
                        </span>
                    </div>
                    <div class="chat-room">
                        ${chatHistory}
                    </div>
                </div>`;
            }
        });

        function accept(id) {
            $.ajax({
                url: '{{ route('myjob.candidate_status_change', ['candidate_id' => $candidate->id]) }}',
                type: 'post',
                data: {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    status: "accepted",
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message == "Unauthenticated") {
                        window.location.reload();
                    }
                    toastr.error(xhr.responseJSON.message);
                }
            });
        }
        $("#reject_button").click(function() {
            const reason = $('[name=reject_reason]').val();
            if (!reason) {
                return;
            }
            $.ajax({
                url: '{{ route('member.reject', ['candidate_id' => $candidate->id]) }}',
                type: 'post',
                data: {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    status: "reject",
                    reason,
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message == "Unauthenticated") {
                        window.location.reload();
                    }
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });

        $('[name=reject_reason]').change(function(e) {
            $("#reject_button").removeAttr("disabled").addClass("btn-primary").removeClass("bg-secondary-subtle");
        })

        $("#reject_tab_1").click(function() {
            $("#reject_tab_1").addClass("reject-active");
            $("#reject_tab_2").removeClass("reject-active");
            $(".reject_tab_1").show()
            $(".reject_tab_2").hide();
            // $("#reject_button").attr("disabled" ,'').removeClass("btn-primary").addClass("bg-secondary-subtle");
        })
        $("#reject_tab_2").click(function() {
            $("#reject_tab_1").removeClass("reject-active");
            $("#reject_tab_2").addClass("reject-active");
            $(".reject_tab_1").hide();
            $(".reject_tab_2").show();
            // $("#reject_button").attr("disabled" ,'').removeClass("btn-primary").addClass("bg-secondary-subtle");
        })

        function url_copy() {
            navigator.clipboard.writeText(document.getElementById('invite_url').value);
            $("#copy_tip").show();
            setTimeout(() => {
                $("#copy_tip").fadeOut();
            }, 3000);
        }

        $("#share_allow").change(function(e) {
            $.ajax({
                url: '{{ route('member.candidate_share', ['candidate_id' => $candidate->id]) }}',
                type: 'post',
                data: {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    flag: $(this).is(":checked"),
                },
                success: function(response) {
                    // location.reload();
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message == "Unauthenticated") {
                        window.location.reload();
                    }
                    toastr.error(xhr.responseJSON.message);
                }
            });
        })
        $("#delete").click(function() {
            if (confirm("本当に削除しますか？")) {
                $.ajax({
                    url: '{{ route('interview.candidate_remove', ['candidate_id' => $candidate->id]) }}',
                    type: 'delete',
                    data: {
                        _token: $("meta[name=csrf-token]").attr("content"),
                    },
                    success: function(response) {
                        location.href = "{{ route('myjob.show', ['myjob' => $candidate->job_id]) }}";
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON.message == "Unauthenticated") {
                            window.location.reload();
                        }
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            }
        })
    </script>
@endsection
