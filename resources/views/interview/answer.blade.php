<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIRIHARE | インタビュー</title>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/plyr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/css/application/fileupload.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/application/application.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/loader.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #videoSave {
            color: #4cadee !important;
            border: 1px solid #4cadee !important;
        }

        #videoSave:hover,
        #videoRecordAgain:hover {
            color: white !important;
            border: 1px solid #4cadee !important;
            background-color: #3aa8f1 !important;
        }
    </style>


</head>

<body>
    <div class="loading d-none">
        <div class="snippet" data-title="dot-pulse">
            <div class="stage">
                <div class="dot-pulse"></div>
            </div>
        </div>
    </div>
    <header>
        <div class="container max-1200">
            <a class="navbar-brand pe-5" href="/">
                <img src="{{ asset('/assets/img/logo01.png') }}" alt="">
            </a>
        </div>
    </header>
    <main class="message">
        <div class="container max-1200" id="test">
            <div class="test-flow">
                <div class="no-group">
                    <a class="no active d-flex justify-content-center align-items-center" href="javascript:;">
                        1
                    </a>
                    @for ($i = 1; $i < $count; $i++)
                        <a class="no d-flex justify-content-center align-items-center @if ($i <= $question->question_no) active @endif"
                            href="javascript:;">
                            {{ $i + 1 }}
                        </a>
                    @endfor
                </div>
            </div>
            <div class="test-content text-start">

                @if ($question->type == 'video')
                    <!-- VIDEO -->
                    <div class="test-video">
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="test-title">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chat-left-dots-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-grow-1">
                                        質問{{ $question->question_no }}
                                    </div>
                                </div>

                                <div class="test-descrtion">
                                    <div>
                                        <i class="fa-solid fa-hourglass-start"></i>
                                    </div>
                                    @if ($question->thinking_hour || $question->thinking_minute)
                                        <div class="flex-grow-1">
                                            <p>この質問には @if ($question->thinking_hour)
                                                    <span>{{ $question->thinking_hour }}</span>時
                                                @endif
                                                <span>{{ $question->thinking_minute }}</span>分
                                                秒以内に回答することをお勧めします。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                あなたのタイム: <span class="show_count"> <span class="dis_minute">0</span>分
                                                    <span class="dis_second">0</span>秒</span>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                                <div class="test-problem">
                                    {{ $question->content }}
                                </div>
                                <div class="test-button d-flex gap-4">
                                    <button class="video-recoding" id="videoRecord" onclick="record_start()"><i
                                            class="fa-solid fa-video text-white"></i>&nbsp;&nbsp;&nbsp;今すぐ録音する</button>
                                    <button class="video-recoding bg-white d-none" id="videoSave"
                                        onclick="makeLink()"><i
                                            class="fa-solid fa-save"></i>&nbsp;&nbsp;&nbsp;保存して続行</button>
                                    <button class="video-recoding d-none" id="videoRecordAgain"
                                        onclick="record_start()"><i
                                            class="fa-solid fa-video text-white"></i>&nbsp;&nbsp;&nbsp;再録音</button>
                                </div>
                                <div class="test-state d-flex justify-content-between">
                                    <div>
                                        @if ($question->answer_time)
                                            <span>
                                                <i class="fa-solid fa-stopwatch"></i>
                                                &nbsp;
                                                応答時間 {{ $question->answer_time }}:00
                                            </span>
                                        @endif
                                    </div>
                                    <div>
                                        <span>
                                            <i class="fa-solid fa-video text-white"></i>
                                            &nbsp;
                                            <span
                                                class="dis_retake">{{ $question->retake }}</span>/{{ $question->retake }}をリテイク</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 position-relative">
                                <video id="videoLive" class="w-100 videoLive" autoplay muted
                                    style="background-color: #a2aab7;"></video>
                                <div class="camera_not_connected text-danger d-none rounded-3 p-4">
                                    カメラまたはマイクへのアクセスは現在ブロックされています。
                                    ブラウザのアドレスバーにあるカメラがブロックされているアイコンをクリックして、このページを更新してください。</div>
                                <video id="videoRecorded" class="w-100 videoRecorded d-none" controls>
                                </video>
                                <div class="position-absolute counter bg-secondary-subtle d-flex justify-content-center align-items-center d-none"
                                    id="counter">
                                    <div class="counter-no rounded-pill text-center">1</div>
                                </div>
                                <!-- <img class="w-100" src="./assets/img/application/camera-screen.svg" alt="camera_screen"> -->
                            </div>
                        </div>
                    </div>
                @endif
                @if ($question->type == 'audio')
                    <!-- VOICE -->
                    <div class="test-voice" id="tab">
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="test-title">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chat-left-dots-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                        </svg>
                                    </div>

                                    <div class="flex-grow-1">
                                        質問{{ $question->question_no }}
                                    </div>
                                </div>

                                <div class="test-descrtion">
                                    <div>
                                        <i class="fa-solid fa-hourglass-start"></i>
                                    </div>

                                    @if ($question->thinking_hour || $question->thinking_minute)
                                        <div class="flex-grow-1">
                                            <p>この質問には @if ($question->thinking_hour)
                                                    <span>{{ $question->thinking_hour }}</span>時
                                                @endif
                                                <span>{{ $question->thinking_minute }}</span>分
                                                秒以内に回答することをお勧めします。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;あなたのタイム: <span
                                                    class="show_count"><span class="dis_minute">0</span>分 <span
                                                        class="dis_second">0</span>秒</span>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                                <div class="test-problem">
                                    {{ $question->content }}
                                </div>
                                <div class="test-button">
                                    <button class="video-recoding" id="videoRecord" onclick="video_record()"><i
                                            class="fa-solid fa-microphone"></i>&nbsp;&nbsp;&nbsp;今すぐ録音する</button>
                                </div>
                                <div class="test-state d-flex justify-content-between">
                                    <div>
                                        @if ($question->answer_time)
                                            <span>
                                                <i class="fa-solid fa-stopwatch"></i>
                                                &nbsp;
                                                応答時間 {{ $question->answer_time }}:00
                                            </span>
                                        @endif
                                    </div>
                                    <div>
                                        <span>
                                            <i class="fa-solid fa-video text-white"></i>
                                            &nbsp;
                                            <span
                                                class="dis_retake">{{ $question->retake }}</span>/{{ $question->retake }}をリテイク</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 position-relative">
                                <video id="videoLive" class="w-100 videoLive" autoplay muted
                                    style="background-color: #a2aab7;"></video>
                                <div class="camera_not_connected text-danger d-none rounded-3 p-4">
                                    カメラまたはマイクへのアクセスは現在ブロックされています。
                                    ブラウザのアドレスバーにあるカメラがブロックされているアイコンをクリックして、このページを更新してください。
                                </div>
                                <video id="videoRecorded" class="w-100 videoRecorded d-none" controls>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($question->type == 'text')
                    <!-- WRITE -->
                    <div class="test-writing w-100">
                        <!-- NO -->
                        <div class="test-title">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-chat-left-dots-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>
                            </div>

                            <div class="flex-grow-1">
                                質問{{ $question->question_no }}
                            </div>
                        </div>
                        <!-- DESCRIPTION -->
                        <div class="test-descrtion">
                            <div>
                                <i class="fa-solid fa-hourglass-start"></i>
                            </div>
                            @if ($question->thinking_hour || $question->thinking_minute)
                                <div class="flex-grow-1">
                                    <p>この質問には @if ($question->thinking_hour)
                                            <span>{{ $question->thinking_hour }}</span>時
                                        @endif
                                        <span>{{ $question->thinking_minute }}</span>分秒以内に回答することをお勧めします。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;あなたのタイム:
                                        <span class="show_count"><span class="dis_minute">0</span>分 <span
                                                class="dis_second">0</span>秒</span>
                                    </p>
                                </div>
                            @endif
                        </div>
                        <div class="test-problem">
                            {{ $question->content }}
                        </div>
                        <div class="input-box w-100">
                            <div class="w-100 d-flex justify-content-between px-18">
                                <span class="d-block">答え</span>
                                <span class="d-block">
                                    @if ($question->limit_type == 'characters')
                                        文字数制限:
                                    @else
                                        文章数制限:
                                    @endif {{ $question->max }}
                                </span>
                            </div>
                            {{-- <div class="card card-custom"> --}}

                            <!-- EDITOR -->
                            <div name="" class="text-editor" id="editor">
                            </div>
                            <input type="hidden" name="content" id="text_content">
                        </div>
                        <div
                            class="w-100 d-flex justify-content-center align-items-baseline text-center mb-3 save_continue">
                            <button class="btn rounded-5 bg-secondary" disabled id="save_continue"
                                onclick="save_text()">保存して続行</button>
                        </div>

                    </div>
                @endif
                @if ($question->type == 'file')
                    <!-- FILE -->
                    <div class="test-file">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="test-title">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chat-left-dots-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                        </svg>
                                    </div>

                                    <div class="flex-grow-1">
                                        質問{{ $question->question_no }}
                                    </div>
                                </div>

                                @if ($question->thinking_hour || $question->thinking_minute)
                                    <div class="test-descrtion">
                                        <div>
                                            <i class="fa-solid fa-hourglass-start"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p>この質問には @if ($question->thinking_hour)
                                                    <span>{{ $question->thinking_hour }}</span>時
                                                @endif
                                                <span>{{ $question->thinking_minute }}</span>分
                                                秒以内に回答することをお勧めします。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; あなたのタイム: <span
                                                    class="show_count"><span class="dis_minute">0</span>分 <span
                                                        class="dis_second">0</span>秒</span>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                <div class="test-problem">
                                    {{ $question->content }}
                                </div>

                                <div class="test-state d-flex justify-content-between mb-3">
                                    <div>
                                        @if ($question->answer_time)
                                            <span>
                                                <i class="fa-solid fa-stopwatch"></i>
                                                &nbsp;
                                                応答時間 {{ $question->answer_time }}:00
                                            </span>
                                        @endif
                                    </div>
                                    <div
                                        class="w-100 d-flex justify-content-center align-items-baseline text-center mb-3 save_continue">
                                        <button class="btn rounded-5 bg-secondary" disabled id="save_continue"
                                            onclick="save_file()">保存して続行</button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-md-6">

                                <section class="bg-diffrent">
                                    <div class="w-100 text-center">
                                        <div class="col-xl-12">

                                            <div class="file-upload-contain">
                                                <div class="file-drop-zone clickable" tabindex="-1">
                                                    <div class="file-drop-zone-title">
                                                        <div class="upload-area" id="uploadArea">
                                                            <p class="file_preview">ここにファイルをドラッグアンドドロップします<br>
                                                                または</p>
                                                            <div> <button class="btn_upload"
                                                                    onclick="select_file()">ブラウズ</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input class="fileupload" id="fileupload" type="file"
                                                    accept="*.* " multiple=false />
                                            </div>
                                        </div>
                                    </div>
                                </section>

                            </div>
                        </div>

                    </div>
                @endif
                @if ($question->type == 'ai')
                    <!-- AI -->
                    <div class="test-ai ">
                        <div class="w-100">
                            <div class="m-auto">
                                <div class="test-title">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-chat-left-dots-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-grow-1">
                                        質問{{ $question->question_no }}
                                    </div>
                                </div>

                                <div class="test-descrtion">
                                    <div>
                                        <i class="fa-solid fa-hourglass-start"></i>
                                    </div>
                                    @if ($question->thinking_hour || $question->thinking_minute)
                                        <div class="flex-grow-1">
                                            <p>この質問には @if ($question->thinking_hour)
                                                    <span>{{ $question->thinking_hour }}</span>時
                                                @endif
                                                <span>{{ $question->thinking_minute }}</span>分
                                                秒以内に回答することをお勧めします。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; あなたのタイム: <span
                                                    class="show_count"><span class="dis_minute">0</span>分 <span
                                                        class="dis_second">0</span>秒</span>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                                <div class="test-problem">
                                    {{ $question->content }}
                                </div>

                                @if ($question->answer_time)
                                    <div class="test-state d-flex justify-content-between mb-3">
                                        <div>
                                            <span>
                                                <i class="fa-solid fa-stopwatch"></i>
                                                &nbsp;
                                                応答時間 {{ $question->answer_time }}:00
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                <div class="chat-box w-100 w-lg-50">
                                    <div class="header">
                                        <div class="avatar-wrapper avatar-big">
                                            <img src="{{ asset('/assets/img/avatar/bot.png') }}" alt="avatar" />
                                        </div>
                                        <span class="name">AIチャット</span>
                                        <span class="options">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <div class="chat-room" id="chat_room">
                                        <div class="message message-left">
                                            <div class="avatar-wrapper avatar-small">
                                                <img src="{{ asset('/assets/img/avatar/bot.png') }}"
                                                    alt="avatar" />
                                            </div>
                                            <div class="bubble bubble-light">
                                                こんにちは。面接にお越しいただき、ありがとうございます。
                                            </div>
                                        </div>

                                    </div>
                                    <div class="type-area border border-primary-subtle">
                                        <div class="input-wrapper">
                                            <input type="text" id="inputText" class="form-input "
                                                placeholder="ここにメッセージを入力してください..." />
                                        </div>
                                        <span class="button-add">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="others">
                                                <span class="emoji-button">
                                                    <i class="far fa-laugh"></i>
                                                    <div class="emoji-box">
                                                        <span>&#x1f604;</span>
                                                        <span>😀</span>
                                                        <span>😂</span>
                                                        <span>😭</span>
                                                        <span>😍</span>
                                                        <span>🤮</span>
                                                        <span>🤑</span>
                                                        <span>😖</span>
                                                        <span>😷</span>
                                                    </div>
                                                </span>
                                            </div>
                                        </span>
                                        <button class="button-send">送信</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- FINISH BUTTON -->
                        <div class="w-100 d-flex align-items-center justify-content-center">
                            <button class="btn rounded-5 text-white align-self-center mb-5 mt-4" id="test_finish"
                                onclick="save_ai()"><span>保存して続行</span></button>
                        </div>
                    </div>
                @endif
            </div>

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
                            <a href="{{ route('contact') }}" class="text-secondary">サポート</a>
                            <a href="{{ route('privacy') }}" class="text-secondary">プライバシーポリシー</a>
                        </div>
                    </div>
                </nav>
            </div>

        </div>
        <div class="container-fluid">
            <span>Copyright © PROS Co., Ltd. All Rights Reserved.</span>
        </div>
    </footer>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">試験再起動</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    テストを再開しますか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        onclick="window.location.href='/test'">確認</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="form_info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="staticBackdropLabel">入力</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        <div class="mb-3">
                            <label for="info_name" class="form-label ms-3">名前</label>
                            <input type="text" class="form-control rounded-pill" id="info_name"
                                placeholder="名前入力">
                        </div>
                        <div class="mb-3">
                            <label for="info_mail" class="form-label ms-3">メールアドレス</label>
                            <input type="email" class="form-control rounded-pill" id="info_mail"
                                placeholder="メールアドレス入力">
                        </div>
                        <div class="mb-3">
                            <label for="info_phone" class="form-label ms-3">電話番号</label>
                            <input type="text" class="form-control rounded-pill" id="info_phone"
                                placeholder="電話番号入力">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        id="meeting_book_ok">確認</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('/assets/js/common/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('/assets/js/application/fileupload.js') }}"></script>
    <script src="{{ asset('/assets/js/common/plyr.min.js') }}"></script>
    <!-- Include the Quill library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    {{-- <script src="{{ asset('/assets/js/application/application.js') }}"></script> --}}

    <script>
        let count = 0;
        let counterTimer = 0;
        @if ($question->type == 'text')
            quill = new Quill('#editor', {
                theme: 'snow'
            });
            let limit_type = "{{ $question['limit_type'] }}";
            let max = parseInt("{{ $question['max'] }}");

            quill.on('text-change', function(delta, oldDelta, source) {
                if (source == 'api') {

                } else if (source == 'user') {
                    $("[name=content]").val(quill.root.innerHTML);
                    let text = quill.getText();
                    let len = text.length;
                    if (len == 1) {
                        $("#save_continue").removeClass("active");
                        $("#save_continue").attr("disabled", " ");
                        $("#save_continue").removeClass("active").attr("disabled",
                            "");
                        return;
                    }
                    if (limit_type == "characters" && len - 1 > max) {
                        $("#save_continue").removeClass("active");
                        $("#save_continue").attr("disabled", " ");
                        $("#save_continue").removeClass("active").attr("disabled",
                            "");
                        return;
                    }
                    if (limit_type == "sentences") {
                        let arr = text.split("\n");
                        if (arr.length - 1 > max) {
                            $("#save_continue").removeClass("active");
                            $("#save_continue").attr("disabled", " ");
                            $("#save_continue").removeClass("active").attr("disabled",
                                "");
                            return;
                        }
                    }
                    $("#save_continue").addClass("active");
                    $("#save_continue").removeAttr("disabled");
                    $("#save_continue").addClass("active").removeAttr(
                        "disabled");
                }
            });
        @endif
        @if ($question->type == 'video')
            try {
                navigator.mediaDevices.enumerateDevices()
                    .then(function(devices) {
                        var hasCamera = devices.some(function(device) {
                            return device.kind === 'videoinput';
                        });

                        if (hasCamera) {
                            console.log('Camera is connected.');
                        } else {
                            screen_disable();
                        }
                    })
                    .catch(function(err) {
                        console.error('Error accessing media devices: ', err);
                        screen_disable();
                    });
            } catch (error) {
                screen_disable();
            }
            const q_retake = {{ $question->retake }};
            let retake = q_retake;

            function screen_disable() {
                $(".camera_not_connected").removeClass("d-none");
                $(".video-recoding").attr("disabled", "").addClass("bg-secondary-subtle");
            }
            let recording = false;
            let recorded = false;
            const videoLive = document.querySelector('#videoLive')
            const videoRecorded = document.querySelector('#videoRecorded')
            let stream;
			let chunks=[];
            let blob

            function record_start() {
                if (!recording) {
                    if (!retake && q_retake) {
                        toastr.error("再録音できません。 最大録音回数を超えました。");
                        return;
                    }
                    $("#videoRecord").html('<i class="fa-solid fa-stop text-white"></i>&nbsp;&nbsp;&nbsp;録音を停止');
                    $(videoLive).removeClass("d-none");
                    $(videoRecorded).addClass("d-none");
                    counter();
                    setTimeout(video_record, 3000);
                    recording = true;
                    if (q_retake) {
                        retake--;
                        $(".dis_retake").html(retake);
                    }
                    $("#videoRecord").removeClass("d-none");
                    $("#videoRecordAgain").addClass("d-none");
                    $("#videoSave").addClass("d-none");
                } else {
                    // $("#videoRecord").html('<i class="fa-solid fa-video text-white"></i>&nbsp;&nbsp;&nbsp;再録音')
                    $(videoLive).addClass("d-none");
                    $(videoRecorded).removeClass("d-none");
                    recording = false;
                    $("#videoRecord").addClass("d-none");
                    $("#videoRecordAgain").removeClass("d-none");
                    $("#videoSave").removeClass("d-none");
                }
            }

            async function video_record() {
				chunks = [];
                
                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    await navigator.mediaDevices.getUserMedia({ // <1>
                        video: true,
                        audio: true,
                    }).then(function(sss) {
                        stream = sss;

                        videoLive.srcObject = stream

                        if (!MediaRecorder.isTypeSupported('video/webm')) {
                            console.warn('video/webm is not supported')
                        }

                        const mediaRecorder = new MediaRecorder(stream, {
                            mimeType: 'video/webm',
                        })

                        mediaRecorder.start()
                        recording = true;
                        recorded = true;
                        $("#videoRecord").click(function() {
							mediaRecorder.stop();
                        })

                        mediaRecorder.addEventListener('dataavailable', event => {
							chunks.push(event.data);
                            videoRecorded.src = URL.createObjectURL(event.data)
                        })
                    }).catch(function(res) {
                        console.log(res);
                    })
                } else {
                    console.error('getUserMedia()はサポートされていません。\n httpsで接続してください。');
                }
            }

            function counter() {
                let s = 3;
                $("#videoRecord").attr("disabled", "").addClass("bg-secondary-subtle");
                $("#counter").removeClass("d-none");
                $("#counter .counter-no").html(3);
                const timer = setInterval(() => {
                    s--;
                    $("#counter .counter-no").html(s);
                    if (s == 0) {
                        clearInterval(timer);
                        $("#counter").addClass("d-none");
                        $("#videoRecord").removeAttr("disabled").removeClass("bg-secondary-subtle");;
                    }
                }, 1000);
            }

            function makeLink() {
				console.log(chunks);
                blob = new Blob(chunks,{"type":"video/webm"});
                var formData = new FormData();
                let token = $("meta[name=csrf-token]").attr("content");
                formData.append('_token', token);
                formData.append('count', count);
                formData.append('q_no', q_no);
                formData.append('video', blob);

                $.ajax({
                    url: "{{ route('interview.save_video', ['url' => $answer_url]) }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        @if ($is_last)
                            location.href = "{{ route('interview.confirm', ['url' => $candidate_url]) }}";
                        @else
                            create();
                        @endif
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            }
        @endif
        let flag = true;
        const q_no = parseInt({{ $question->question_no }});
        let thinking_hour = parseInt({{ $question->thinking_hour }});
        let thinking_minute = parseInt({{ $question->thinking_minute }});
        if (isNaN(thinking_hour)) {
            thinking_hour = 0;
        }
        if (isNaN(thinking_minute)) {
            thinking_minute = 0;
        }
        const thinking_time = thinking_hour * 60 + thinking_minute;


        function start_time() {

            counterTimer = setInterval(function(e) {
                let minute = parseInt(count / 60);
                let second = parseInt(count % 60);
                count++;
                $(".dis_minute").html(minute);
                $(".dis_second").html(second);
                if (thinking_time < minute) {
                    $(".show_count").addClass("text-danger");
                    $(".dis_second").addClass("text-danger");
                    $(".dis_minute").addClass("text-danger");
                }
            }, 1000);
        }

        function save_text() {
            let token = $("meta[name=csrf-token]").attr("content");
            let content = $("#text_content").val().trim();
            if (content == "")
                return;
            let postData = {
                _token: token,
                content: content,
                count: count,
                q_no: {{ $question->question_no }},
            };

            $.ajax({
                url: "{{ route('interview.save_text', ['url' => $answer_url]) }}",
                type: 'POST',
                data: postData,
                success: function(response) {
                    @if ($is_last)
                        location.href = "{{ route('interview.confirm', ['url' => $candidate_url]) }}";
                    @else
                        create();
                    @endif
                },
                error: function(xhr, status, error) {
                    toastr.error(xhr.responseJSON.message);
                }
            });
        }
        @if ($question->type == 'file')
            const uploadArea = document.getElementById('uploadArea');
            const fileInput = document.getElementById('fileupload');

            // Prevent default behavior for drag events
            uploadArea.addEventListener('dragenter', (e) => {
                e.preventDefault();
            });

            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
            });

            uploadArea.addEventListener('dragleave', (e) => {
                e.preventDefault();
            });

            // Handle file drop event
            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                $('#fileupload')[0].files = e.dataTransfer.files;
                $(".file_preview").html(e.target.value);
                $("#fileupload").change();
            });

            function save_file() {
                let token = $("meta[name=csrf-token]").attr("content");
                let file_name = $("#fileupload").val();
                if (!file_name) {
                    toastr.error('ファイルを選択してください。');
                    return;
                }
                var formData = new FormData();
                var file = $('#fileupload')[0].files[0];
                formData.append('file', file);
                formData.append('_token', token);
                formData.append('count', count);
                formData.append('q_no', q_no);

                $.ajax({
                    url: "{{ route('interview.save_file', ['url' => $answer_url]) }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        @if ($is_last)
                            location.href = "{{ route('interview.confirm', ['url' => $candidate_url]) }}";
                        @else
                            // create();
                        @endif
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            }
        @endif


        function create() {
            let token = $("meta[name=csrf-token]").attr("content");

            let postData = {
                _token: token,
                q_no: {{ $next_no }},
            };

            $.ajax({
                url: "{{ route('interview.create_answer', ['url' => $candidate_url]) }}",
                type: 'POST',
                data: postData,
                success: function(response) {
                    location.href = response.url;
                },
                error: function(xhr, status, error) {
                    toastr.error(xhr.responseJSON.message);
                }
            });
        }

        function select_file() {
            $("#fileupload").click();
        }

        $("#fileupload").change(function(e) {
            $(".file_preview").html(e.target.value);
            $("#save_continue").removeAttr("disabled").addClass("active").removeClass(" bg-secondary");
        })
        @if ($question->type == 'ai')
            let messages = [{
                sender: "bot",
                "message": "こんにちは。面接にお越しいただき、ありがとうございます。"
            }];
            var header = document.querySelector(".header");
            var chatRoom = document.querySelector(".chat-room");
            var typeArea = document.querySelector(".type-area");
            var btnAdd = document.querySelector(".button-add");
            var others = document.querySelector(".others");
            var emojiBox = document.querySelector(".emoji-button .emoji-box");
            var emojiButton = document.querySelector(".others .emoji-button");
            var emojis = document.querySelectorAll(".emoji-box span");
            var inputText = document.querySelector("#inputText");
            var btnSend = document.querySelector(".button-send");
            var messageArea = document.querySelector(".message.message-right");

            btnAdd.addEventListener("click", function(e) {
                others.classList.add("others-show");
            });
            //Emoji onclick event
            emojiButton.addEventListener("click", function(e) {
                emojiBox.classList.add("emoji-show");
            });
            $("#inputText").keyup(function() {
                if (event.key === "Enter") {
                    send_message();
                }
            });
            //Button Send onclick event
            btnSend.addEventListener("click", send_message);

            function send_message() {
                var mess = inputText.value.trim();
                if (mess == "") {
                    return;
                }
                const res = {
                    sender: "person",
                    message: mess
                };
                $(inputText).val("");
                messages.push(res);
                show_man(mess);
                $(inputText).attr("disabled", "");
                $(btnSend).attr("disabled", "");

                let conservation = "";
                messages.forEach(msg => {
                    if (msg.sender == "bot") {
                        conservation += "面接官: " + msg.message + "\n";
                    } else {
                        conservation += "候補者: " + msg.message + "\n";
                    }
                });
                const prompt = `
###次は職業説明です。

{{ $job->description }}

###知っておきたい基本的なことは次のとおりです。

{{ $question->content }}

###以下は会話です。
${conservation}
面接官:
`;
                //ai
                let token = $("meta[name=csrf-token]").attr("content");
                let postData = {
                    _token: token,
                    prompt: prompt,
                };
                loading(true);
                $.ajax({
                    url: "{{ route('openai') }}",
                    type: 'POST',
                    data: postData,
                    success: function(response) {
                        const mes = response.result.choices[0].message.content

                        const res = {
                            sender: "bot",
                            message: mes,
                        };
                        messages.push(res);
                        $(inputText).removeAttr("disabled");
                        $(btnSend).removeAttr("disabled");
                        show_bot(mes);
                        loading(false);
                    },
                    error: function(xhr, status, error) {

                        loading(false);
                    }
                });
            }

            for (var emoji of emojis) {
                emoji.addEventListener("click", function(e) {
                    e.stopPropagation();
                    emojiBox.classList.remove("emoji-show");
                    others.classList.remove("others-show");
                    inputText.value += e.target.textContent;
                });
            }

            function show_man(mess) {
                let man_mes = `<div class="message message-right">
        <div class="avatar-wrapper avatar-small">
            <img src="{{ asset('/assets/img/avatar/01.png') }}"
                alt="avatar" />
        </div>
        <div class="bubble bubble-dark">
            ${mess}
        </div>
    </div>`;
                $("#chat_room").append(man_mes);
                chatRoom.scrollTop = chatRoom.scrollHeight;
            }

            function show_bot(mes) {
                let bot_mes = `
                <div class="message message-left">
                    <div class="avatar-wrapper avatar-small">
                        <img src="{{ asset('/assets/img/avatar/bot.png') }}"
                            alt="avatar" />
                    </div>
                    <div class="bubble bubble-light">
                        ${mes}
                    </div>
                </div>`;
                $("#chat_room").append(bot_mes);
                chatRoom.scrollTop = chatRoom.scrollHeight;
            }

            function save_ai() {

                let token = $("meta[name=csrf-token]").attr("content");
                if (messages.length < 3) {
                    toastr.error('答えを入力してください。');
                    return;
                }
                let postData = {
                    _token: token,
                    messages: messages,
                    count: count,
                    q_no: {{ $question->question_no }},
                };

                $.ajax({
                    url: "{{ route('interview.save_ai', ['url' => $answer_url]) }}",
                    type: 'POST',
                    data: postData,
                    success: function(response) {
                        @if ($is_last)
                            location.href = "{{ route('interview.confirm', ['url' => $candidate_url]) }}";
                        @else
                            create();
                        @endif

                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            }

            function finish_ai() {

            }
        @endif
        start_time();

        function loading(is_loading) {
            if (is_loading) {
                $(".loading").removeClass("d-none");
            } else {
                $(".loading").addClass("d-none");
            }
        }
    </script>

</body>

</html>
