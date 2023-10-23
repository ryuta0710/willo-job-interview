<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIRIHARE | インタビュー確認</title>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/plyr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/css/application/fileupload.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/application/application.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .show-answer-text {
            height: 350px !important;
            max-width: 600px;
        }

        .chat-box img {
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <div class="container max-1200">
            <a class="navbar-brand pe-5" href="/">
                <img src="{{ asset('/assets/img/logo01.png') }}" alt="">
            </a>
        </div>
    </header>
    <main class="message">
        <div class="container max-1200" id="test">

            <!-- CONTENT CONFIRM -->
            <div class="test-complete">
                <h1 class="text-center">ほぼ完了しました</h1>
                <p class="text-center">回答を注意深く確認し、満足していることを確認してください。</p>
                <div id="test-confirm"
                    class="test-confirm w-100 d-flex flex-wrap flex-lg-nowrap justify-content-center gap-3">
                    <div class="flex-grow-1">
                        <div class="test-problem-no ms-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chat-left-dots-fill" viewBox="0 0 16 16">
                                <path
                                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            </svg>
                            &nbsp;&nbsp;
                            <span>
                                質問<span class="question_no">1</span>

                            </span>
                        </div>
                        <div class="w-100 pl-md-0 pl-lg-73">
                            <div class="test-title fs-16 mb-3">
                                {{ $answers[0]->question_content }}
                            </div>
                            <div id="test-preview" class="w-100 mb-4">
                                @if ($answers[0]->question_type == 'video')
                                    <video class="rounded-4 w-100 h-100" crossorigin=""
                                        playsinlineposter="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                                        <source src="{{ $answers[0]->rc_url }}" type="video/mp4" size="300">
                                        <a>Video</a>
                                    </video>
                                @endif
                                @if ($answers[0]->question_type == 'audio')
                                    <video class="rounded-4 w-100 h-100" crossorigin=""
                                        playsinlineposter="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                                        <source src="{{ $answers[0]->rc_url }}" type="video/mp4" size="300">
                                        <a>Video</a>
                                    </video>
                                @endif
                                @if ($answers[0]->question_type == 'text')
                                    <div class="rounded-4 bg-secondary-subtle show-answer-text p-4">
                                        {!! $answers[0]->content !!}
                                    </div>
                                @endif
                                @if ($answers[0]->question_type == 'file')
                                    <div class="file-upload-contain">
                                        <div class="file-drop-zone clickable" tabindex="-1">
                                            <div class="file-drop-zone-title">
                                                <div class="upload-area text-center">
                                                    <p class="file_preview">{{ $answers[0]->content }}</p>
                                                    <div> ダウンロードするには<a class="btn_upload" download
                                                            href="{{ $answers[0]->rc_url }}">こちら</a>をクリック。
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
                                                <img src="{{ asset('/assets/img/avatar/bot.png') }}" alt="avatar" />
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
                        <div class="w-100 text-center mb-4">
                            <a href="{{ route('interview.index', ['url' => $url]) }}" id="restart_test"
                                class="bg-white rounded-5 bg-red text-hover-white">
                                <svg id="Group_2290" data-name="Group 2290" xmlns="http://www.w3.org/2000/svg"
                                    width="18.5" height="18.5" viewBox="0 0 18.5 18.5">
                                    <g id="Group_2289" data-name="Group 2289" opacity="0">
                                        <path id="Path_132" data-name="Path 132" d="M18.5,0H0V18.5H18.5Z"
                                            fill="#4ca7ee" />
                                    </g>
                                    <path id="Path_133" data-name="Path 133"
                                        d="M6.571,14.005a.768.768,0,0,1,.964.5,5.561,5.561,0,0,0,10.83-1.6,5.471,5.471,0,0,0-5.535-5.4A5.578,5.578,0,0,0,9.246,8.795l1.673-.278a.773.773,0,0,1,.578.135.762.762,0,0,1,.308.5.773.773,0,0,1-.135.578.762.762,0,0,1-.5.308l-3.268.54H7.766a.767.767,0,0,1-.262-.046.315.315,0,0,1-.077-.046.6.6,0,0,1-.154-.085L7.2,10.321c0-.039-.069-.069-.1-.116s0-.077-.039-.108a1.03,1.03,0,0,1-.054-.139L6.432,6.875a.785.785,0,0,1,1.542-.293L8.182,7.7A7.1,7.1,0,0,1,12.83,5.966,7.012,7.012,0,0,1,19.906,12.9a7.012,7.012,0,0,1-7.076,6.938,7.033,7.033,0,0,1-6.8-4.872.788.788,0,0,1,.066-.6A.779.779,0,0,1,6.571,14.005Z"
                                        transform="translate(-3.719 -3.653)" fill="#4ca7ee" />
                                    <path id="Path_134" data-name="Path 134" d="M18.5,0H0V18.5H18.5Z"
                                        fill="none" />
                                </svg>
                                再受験
                            </a>
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
                                        data-content="{{ $answers[$i]->rc_url }}" data-no="{{ $i }}">
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
                                            <div>{!! $answers[$i]->question_content !!}</div>
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
                                    <!-- FILE UPLOAD BOX -->
                                    <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="ai"
                                        data-no="{{ $i }}">
                                        <!-- HEADER -->
                                        <div class="answer-type text-center rounded-2 d-none d-sm-block pt-3">
                                            <img src="{{asset("/assets/img/avatar/icon-bot.png")}}" alt="" style="width: 60px;">
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
                                    <!-- END BOX -->
                                @endif
                            @endfor
                            <!-- END BOX -->

                        </div>
                        <!-- END LIST -->
                    </div>
                </div>
                <div class="w-100 text-center" style="padding: 30px;">
                    <a href="{{ route('interview.booking', ['url' => $url]) }}" class="text-white rounded-5 mb-5"
                        id="answer_confirm">次に</a>
                </div>

            </div>
            <!-- END CONTENT CONFIRM -->

        </div>

    </main>
    <footer>
        <div class="container-fluid">
            <div
                class="container  max-1200 d-flex flex-column flex-sm-column flex-md-column flex-lg-row align-items-center align-items-sm-center align-items-md-center align-items-xs-center justify-content-lg-between">
                <a href="/">
                    <img src="{{ asset('/assets/img/logo01.png') }}" class="display-block w-auto" alt="logo">
                </a>
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="collapse navbar-collapse show" id="navbarNavAltMarkup">
                        <div
                            class="navbar-nav gap-sm-1 align-items-xs-center align-items-center align-items-sm-center justify-content-sm-center gap-md-0">
                            <a href="{{route('contact')}}" class="text-secondary">サポート</a>
                            <a href="{{route('privacy')}}" class="text-secondary">プライバシーポリシー</a>
                        </div>
                    </div>
                </nav>
            </div>

        </div>
        <div class="container-fluid">
            <span>Copyright © PROS Co., Ltd. All Rights Reserved.</span>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('/assets/js/common/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('/assets/js/application/fileupload.js') }}"></script>
    <script src="{{ asset('/assets/js/common/plyr.min.js') }}"></script>
    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="{{ asset('/assets/js/application/application.js') }}"></script>

    <script>
        var plaryer = new Plyr('video', {
            muted: false,
            volume: 1,
            controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume',
                'fullscreen'
            ],
        });
        let answers = {!! $answers !!};
        $(".answer-item").click(function() {
            $(".answer-item").removeClass("active");
            $(this).addClass("active");
            let q_no = parseInt($(this).attr("data-no"));
            if (isNaN(q_no)) {
                return;
            }
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
                    <div class="file-upload-contain">
                        <div class="file-drop-zone clickable" tabindex="-1">
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
                    if(mes.sender == "bot"){
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
                    if(mes.sender == "person"){
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
        })
    </script>

</body>

</html>
