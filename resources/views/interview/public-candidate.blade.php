<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会社ロゴ</title>

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
    </style>
</head>

<body>
    <header>
        <div class="container max-1200">
            <a href="/" class="fs-1 text-black">会社ロゴ</a>
        </div>
    </header>
    <main class="message">
        <div class="container max-1200" id="test">

            <!-- CONTENT CONFIRM -->
            <div class="test-complete">
                <h1 class="text-center"> </h1>
                @if (count($answers))
                <div class="me-4 pt-2 text-center text-md-left mb-5">
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
                    <span>{{$candidate->name}}</span>
                </div>
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
                            <div class="test-title">
                                {{ $answers[0]->question_content }}
                            </div>
                            <div id="test-preview" class="w-100 mb-4">
                                @if ($questions[0]->type == 'video')
                                    <video class="rounded-4 w-100 h-100" crossorigin=""
                                        playsinlineposter="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                                        <source src="{{ $questions[0]->rc_url }}" type="video/mp4" size="300">
                                        <a>Video</a>
                                    </video>
                                @endif
                                @if ($questions[0]->type == 'audio')
                                    <video class="rounded-4 w-100 h-100" crossorigin=""
                                        playsinlineposter="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                                        <source src="{{ $questions[0]->rc_url }}" type="video/mp4" size="300">
                                        <a>Video</a>
                                    </video>
                                @endif
                                @if ($questions[0]->type == 'text')
                                    <div class="rounded-4 bg-secondary-subtle show-answer-text p-4">
                                        {{ $questions[0]->content }}
                                    </div>
                                @endif
                                @if ($questions[0]->type == 'file')
                                <div class="file-upload-contain">
                                    <div class="file-drop-zone clickable" tabindex="-1">
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
                                        data-content="{{ $answers[$i]->rc_url }}" data-no="{{$i}}">
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
                                                &nbsp;&nbsp;&nbsp;質問{{ $i }}
                                            </div>
                                            <p>{!! $answers[$i]->question_content !!}</p>
                                        </div>
                                    </div>
                                    <!-- END VIDEO BOX -->
                                @endif
                                @if ($answers[$i]->question_type == 'audio')
                                    <!-- VOICE BOX -->
                                    <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="voice"
                                        data-content="{{ $answers[$i]->rc_url }}" data-no="{{$i}}">
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
                                                &nbsp;&nbsp;&nbsp;質問{{ $i }}
                                            </div>
                                            <p>{!! $answers[$i]->question_content !!}</p>

                                        </div>
                                    </div>
                                    <!-- END BOX -->
                                @endif
                                @if ($answers[$i]->question_type == 'text')
                                    <!--WRITING BOX -->
                                    <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="writing" data-no="{{$i}}">
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
                                                &nbsp;&nbsp;&nbsp;質問{{ $i }}
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
                                    data-no="{{$i}}">
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
                                                &nbsp;&nbsp;&nbsp;質問{{ $i }}
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
                @else
                <h3 class="text-center">おっと、このリンクは期限切れです。
                    新しいものをリクエストするには、{{$email}} までご連絡ください。 </h3>
                @endif

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
                            <a class="nav-link" aria-current="page" href="#">サポート</a>
                            <a class="nav-link" href="#">プライバシーポリシー</a>
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
@if (count($answers))
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

            $(".question_no").html(q_no+1);

            if(isNaN(q_no) ){
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
            }
        })
    </script>
    
@endif

</body>

</html>
