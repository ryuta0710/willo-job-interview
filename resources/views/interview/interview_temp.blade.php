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

    </style>
</head>

<body>
    <header>
        <div class="container max-1200">
            <a href="/" class="fs-1 text-black">会社ロゴ</a>
        </div>
    </header>
    <main class="message">
        <div class="container max-1200 d-none" id="test">
            <div class="test-flow">
                <div class="no-group">
                    <a class="no active d-flex justify-content-center align-items-center" data-tab="tab-1"
                        href="#tab-1">
                        1
                    </a>
                    @for ($i = 1; $i < $count; $i++)
                        <a class="no d-flex justify-content-center align-items-center"
                            data-tab="tab-{{ $i + 1 }}" href="#tab-{{ $i + 1 }}">
                            {{ $i + 1 }}
                        </a>
                    @endfor
                </div>
            </div>
            <div class="test-content text-start">

                @foreach ($questions as $question)
                    @if ($question->type == 'video')
                        <!-- VIDEO -->
                        <div class="test-video tab-content" id="tab-{{ $question->question_no }}">
                            <div class="row">

                                <div class="col-sm-12 col-md-12 col-lg-6">
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
                                        @if ($question->thinking_hour && $question->thinking_hour)
                                            <div class="flex-grow-1">
                                                <p>この質問には @if ($question->thinking_hour)
                                                        <span>{{ $question->thinking_hour }}</span>時
                                                    @endif
                                                    <span>{{ $question->thinking_minute }}</span>分 秒以内に回答することをお勧めします。
                                                    あなたのタイム: <span class="show_count">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <span class="dis_minute">0</span>分 <span
                                                            class="dis_second">0</span>秒</span>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="test-problem">
                                        {{ $question->content }}
                                    </div>
                                    <div class="test-button">
                                        <button class="video-recoding" id="videoRecord{{ $question->question_no }}"
                                            onclick="video_record({{ $question->question_no }})">
                                            <i class="fa-solid fa-video text-white"></i>&nbsp;&nbsp;&nbsp;
                                            今すぐ録音する</button>
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
                                    <video id="videoLive{{ $question->question_no }}" class="w-100 videoLive" autoplay
                                        muted style="background-color: #a2aab7;"></video>
                                    <div class="camera_not_connected text-danger d-none rounded-3 p-4">
                                        カメラまたはマイクへのアクセスは現在ブロックされています。
                                        ブラウザのアドレスバーにあるカメラがブロックされているアイコンをクリックして、このページを更新してください。</div>
                                    <video id="videoRecorded{{ $question->question_no }}"
                                        class="w-100 videoRecorded d-none" controls>
                                    </video>
                                    <!-- <img class="w-100" src="./assets/img/application/camera-screen.svg" alt="camera_screen"> -->
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($question->type == 'audio')
                        <!-- VOICE -->
                        <div class="test-voice tab-content" id="tab-{{ $question->question_no }}">
                            <div class="row">

                                <div class="col-sm-12 col-md-12 col-lg-6">
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

                                        @if ($question->thinking_hour && $question->thinking_hour)
                                            <div class="flex-grow-1">
                                                <p>この質問には @if ($question->thinking_hour)
                                                        <span>{{ $question->thinking_hour }}</span>時
                                                    @endif
                                                    <span>{{ $question->thinking_minute }}</span>分 秒以内に回答することをお勧めします。
                                                    あなたのタイム: <span class="show_count">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <span class="dis_minute">0</span>分 <span
                                                            class="dis_second">0</span>秒</span>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="test-problem">
                                        {{ $question->content }}
                                    </div>
                                    <div class="test-button">
                                        <button class="video-recoding" id="videoRecord{{ $question->question_no }}"
                                            onclick="video_record({{ $question->question_no }})"><i
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
                                    <video id="videoLive{{ $question->question_no }}" class="w-100 videoLive"
                                        autoplay muted style="background-color: #a2aab7;"></video>
                                    <div class="camera_not_connected text-danger d-none rounded-3 p-4">
                                        カメラまたはマイクへのアクセスは現在ブロックされています。
                                        ブラウザのアドレスバーにあるカメラがブロックされているアイコンをクリックして、このページを更新してください。
                                    </div>
                                    <video id="videoRecorded{{ $question->question_no }}"
                                        class="w-100 videoRecorded d-none" controls>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($question->type == 'text')
                        <!-- WRITE -->
                        <div class="test-writing w-100 tab-content" id="tab-{{ $question->question_no }}">
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

                                @if ($question->thinking_hour && $question->thinking_hour)
                                    <div class="flex-grow-1">
                                        <p>この質問には @if ($question->thinking_hour)
                                                <span>{{ $question->thinking_hour }}</span>時
                                            @endif
                                            <span>{{ $question->thinking_minute }}</span>分 秒以内に回答することをお勧めします。
                                            あなたのタイム: <span class="show_count">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span class="dis_minute">0</span>分 <span
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
                                            文字
                                        @else 文章@endif数制限: {{ $question->max }}
                                    </span>
                                </div>
                                {{-- <div class="card card-custom"> --}}

                                <!-- EDITOR -->
                                <div name="" class="text-editor" id="editor{{ $question->question_no }}">
                                    <input type="hidden" name="content{{ $question->question_no }}">
                                </div>
                            </div>
                            <div
                                class="w-100 d-flex justify-content-center align-items-baseline text-center mb-3 save_continue">
                                <button class="btn rounded-5 bg-secondary" disabled
                                    id="save_continue{{ $question->question_no }}"
                                    onclick="save_text({{ $question->question_no }})">保存して続行</button>
                            </div>

                        </div>
                    @endif
                    @if ($question->type == 'file')
                        <!-- FILE -->
                        <div class="test-file tab-content " id="tab-{{ $question->question_no }}">
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

                                    <div class="test-descrtion">
                                        <div>
                                            <i class="fa-solid fa-hourglass-start"></i>
                                        </div>
                                        @if ($question->thinking_hour && $question->thinking_hour)
                                            <div class="flex-grow-1">
                                                <p>この質問には @if ($question->thinking_hour)
                                                        <span>{{ $question->thinking_hour }}</span>時
                                                    @endif
                                                    <span>{{ $question->thinking_minute }}</span>分 秒以内に回答することをお勧めします。
                                                    あなたのタイム: <span class="show_count">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <span class="dis_minute">0</span>分 <span
                                                            class="dis_second">0</span>秒</span>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
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
                                    </div>

                                </div>
                                <div class="col-12 col-md-6">

                                    <section class="bg-diffrent">
                                        <div class="w-100 text-center">
                                            <div class="col-xl-12">

                                                <div class="file-upload-contain">
                                                    <div class="file-drop-zone clickable" tabindex="-1">
                                                        <div class="file-drop-zone-title">
                                                            <div class="upload-area">
                                                                <p class="file_preview">ここにファイルをドラッグアンドドロップします<br>
                                                                    または</p>
                                                                <div> <button class="btn_upload"
                                                                        onclick="select_file({{ $question->question_no }})">ブラウズ</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input class="fileupload"
                                                        id="fileupload{{ $question->question_no }}" type="file"
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
                        <div class="test-ai tab-content " id="tab-{{ $question->question_no }}">
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
                                        @if ($question->thinking_hour && $question->thinking_hour)
                                            <div class="flex-grow-1">
                                                <p>この質問には @if ($question->thinking_hour)
                                                        <span>{{ $question->thinking_hour }}</span>時
                                                    @endif
                                                    <span>{{ $question->thinking_minute }}</span>分 秒以内に回答することをお勧めします。
                                                    あなたのタイム: <span class="show_count">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <span class="dis_minute">0</span>分 <span
                                                            class="dis_second">0</span>秒</span>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
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
                                    </div>

                                    <div class="chat-box w-100 w-lg-50">
                                        <div class="header">
                                            <div class="avatar-wrapper avatar-big">
                                                <img src="{{ asset('/assets/img/avatar/bot.png') }}"
                                                    alt="avatar" />
                                            </div>
                                            <span class="name">AIチャット</span>
                                            <span class="options">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </span>
                                        </div>
                                        <div class="chat-room">
                                            <div class="message message-left">
                                                <div class="avatar-wrapper avatar-small">
                                                    <img src="{{ asset('/assets/img/avatar/bot.png') }}"
                                                        alt="avatar" />
                                                </div>
                                                <div class="bubble bubble-light">
                                                    こんにちは。
                                                </div>
                                            </div>
                                            <div class="message message-right">
                                                <div class="avatar-wrapper avatar-small">
                                                    <img src="{{ asset('/assets/img/avatar/01.png') }}"
                                                        alt="avatar" />
                                                </div>
                                                <div class="bubble bubble-dark">
                                                    お世話になっております。
                                                </div>
                                            </div>
                                        </div>
                                        <div class="type-area">
                                            <div class="input-wrapper">
                                                <input type="text" id="inputText"
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
                                                    <span class="image-button">
                                                        <i class="far fa-image"></i>
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-paperclip"></i>
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
                                <button class="btn rounded-5 text-white align-self-center mb-5"
                                    id="test_finish"><span>テスト完了</span></button>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- CONTENT CONFIRM -->
            <div class="test-complete d-none">
                <h1 class="text-center">ほぼ完了しました</h1>
                <p class="text-center">回答を注意深く確認し、満足していることを確認してください。</p>
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
                                質問2

                            </span>
                        </div>
                        <div class="w-100 pl-md-0 pl-lg-73">
                            <div class="test-title">
                                <p>自己紹介</p>
                            </div>
                            <div id="test-preview" class="w-100 mb-4">
                                <video class="rounded-4 w-100 h-100" crossorigin=""
                                    playsinlineposter="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                                    <source src="{{ asset('./assets/video/interview01.mp4') }}" type="video/mp4"
                                        size="300">
                                    <a>Video Oynatılamıyor</a>
                                </video>
                            </div>
                        </div>
                        <div class="w-100 text-center mb-4">
                            <button id="restart_test" class="bg-white rounded-5 bg-red" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
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
                            </button>
                        </div>
                    </div>

                    <div class="answer-list">
                        <p class="ps-3">回答2/8</p>
                        <!-- BOX LIST -->
                        <div
                            class="list-box card rounded-2 px-2 m-auto d-flex flex-column py-2  align-items-center shadow gap-2 w-100">
                            <!--WRITING BOX -->
                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="writing"
                                data-content="さささ">
                                <!-- HEADER -->
                                <div class="answer-type text-center rounded-2 d-none d-sm-block">
                                    <i class="fa-solid fa-align-center"></i>
                                    <div class="mt-3">
                                        <span>ワード数: 1</span>
                                    </div>
                                </div>
                                <!-- END HEADER -->
                                <!-- CONTENT -->
                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                    <div class="w-100 pt-3 pb-2">
                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                            alt="chat">
                                        &nbsp;&nbsp;&nbsp;質問1
                                    </div>
                                    <p>
                                        さささ
                                    </p>
                                </div>
                                <!-- END CONTENT -->
                            </div>
                            <!-- END BOX -->
                            <!-- VIDEO BOX -->
                            <div class="answer-item p-1 rounded-3 d-flex gap-4 active" data-type="video"
                                data-content="{{ asset('./assets/video/interview01.mp4') }}">
                                <!-- HEADER -->
                                <div class="answer-type text-center pt-0 rounded d-none d-sm-block">
                                    <video class="rounded-4 w-100 h-100" crossorigin=""
                                        playsinlineposter="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                                        <source src="{{ asset('./assets/video/interview01.mp4') }}" type="video/mp4"
                                            size="300">
                                        <a>Video Oynatılamıyor</a>
                                    </video>
                                </div>
                                <!-- CONTENT -->
                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                    <div class="w-100 pt-3 pb-2">
                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                            alt="chat">
                                        &nbsp;&nbsp;&nbsp;質問1
                                    </div>
                                    <p>
                                        さささ
                                    </p>
                                </div>
                            </div>
                            <!-- END BOX -->
                            <!-- VOICE BOX -->
                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="voice"
                                data-content="{{ asset('/assets/video/voice.wav.png') }}">
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
                                        &nbsp;&nbsp;&nbsp;質問1
                                    </div>
                                    <p>
                                        さささ
                                    </p>
                                </div>
                            </div>
                            <!-- END BOX -->
                            <!-- FILE UPLOAD BOX -->
                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="file"
                                data-content="./assets/video/wordpress.rar">
                                <!-- HEADER -->
                                <div class="answer-type text-center rounded-2 d-none d-sm-block">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                    <div class="mt-3">
                                        <span>mt.chilbo.webp</span>
                                    </div>
                                </div>
                                <!-- CONTENT -->
                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                    <div class="w-100 pt-3 pb-2">
                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                            alt="chat">
                                        &nbsp;&nbsp;&nbsp;質問1
                                    </div>
                                    <p>
                                        さささ
                                    </p>
                                </div>
                            </div>
                            <!-- END BOX -->
                            <!--WRITING BOX -->
                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="writing"
                                data-content="さささ">
                                <!-- HEADER -->
                                <div class="answer-type text-center rounded-2 d-none d-sm-block">
                                    <i class="fa-solid fa-align-center"></i>
                                    <div class="mt-3">
                                        <span>ワード数: 1</span>
                                    </div>
                                </div>
                                <!-- CONTENT -->
                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                    <div class="w-100 pt-3 pb-2">
                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                            alt="chat">
                                        &nbsp;&nbsp;&nbsp;質問1
                                    </div>
                                    <p>
                                        さささ
                                    </p>
                                </div>
                            </div>
                            <!-- END BOX -->
                            <!-- VIDEO BOX -->
                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="video"
                                data-content="{{ asset('./assets/video/interview01.mp4') }}">
                                <!-- HEADER -->
                                <div class="answer-type text-center pt-0 rounded d-none d-sm-block">
                                    <img src="{{ asset('./assets/img/application/answer-video.png') }}"
                                        alt="">
                                </div>
                                <!-- CONTENT -->
                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                    <div class="w-100 pt-3 pb-2">
                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                            alt="chat">
                                        &nbsp;&nbsp;&nbsp;質問1
                                    </div>
                                    <p>
                                        さささ
                                    </p>
                                </div>
                            </div>
                            <!-- END BOX -->
                            <!-- VOICE BOX -->
                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="voice"
                                data-content="./assets/video/voice.wav">
                                <!-- HEADER -->
                                <div class="answer-type text-center pt-0 rounded d-none d-sm-block">
                                    <img src="{{ asset('/assets/img/application/answer-voice.png') }}"
                                        alt="">
                                </div>
                                <!-- CONTENT -->
                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                    <div class="w-100 pt-3 pb-2">
                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                            alt="chat">
                                        &nbsp;&nbsp;&nbsp;質問1
                                    </div>
                                    <p>
                                        さささ
                                    </p>
                                </div>
                            </div>
                            <!-- END BOX -->
                            <!-- FILE UPLOAD BOX -->
                            <div class="answer-item p-1 rounded-3 d-flex gap-4" data-type="file"
                                data-content="./assets/video/wordpress.rar">
                                <!-- HEADER -->
                                <div class="answer-type text-center rounded-2 d-none d-sm-block">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                    <div class="mt-3">
                                        <span>wordpress.rar</span>
                                    </div>
                                </div>
                                <!-- CONTENT -->
                                <div class="answer-content text-start flex-grow-1 overflow-hidden">
                                    <div class="w-100 pt-3 pb-2">
                                        <img src="{{ asset('/assets/img/application/chat-right.png') }}"
                                            alt="chat">
                                        &nbsp;&nbsp;&nbsp;質問1
                                    </div>
                                    <p>
                                        さささ
                                    </p>
                                </div>
                            </div>
                            <!-- END BOX -->

                        </div>
                        <!-- END LIST -->
                    </div>
                </div>
                <div class="w-100 text-center">
                    <button class="text-white rounded-5 mb-5" id="answer_confirm">次に</button>
                </div>

            </div>
            <!-- END CONTENT CONFIRM -->

            <!-- MEETING BOOXING -->
            <div class="meeting-book d-none">
                <h1 class="text-center mb-0">あなたの空き状況</h1>
                <p class="">今後数日間、フォローアップの会話にいつ対応できるかを知っておくと便利です。空き枠を 3 つ以上選択してください。このセクションはオプションです。</p>
                <div class="w-100 pt-3">
                    <table id="booking_table" class="table table-hover table-bordered w-100 text-white text-center">
                        <thead>
                            <tr class="text-white">
                                <th class="p-0"><i class="fa-solid fa-clock text-white"></i></th>
                                <th class="text-white">木曜日</th>
                                <th class="text-white">金曜日</th>
                                <th class="text-white">月曜日</th>
                                <th class="text-white">火曜日</th>
                                <th class="text-white">水曜日</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>午前8:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午前8:30</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午前9:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午前9:30</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午前10:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午前10:30</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午前11:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午前11:30</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午前12:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後12:30</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後1:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後1:30</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後2:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後2:30</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後3:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後3:30</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後4:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後4:30</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後5:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後5:30</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr>
                                <td>午後6:00</td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                                <td><i class="fa-regular fa-circle-check"></i></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="w-100 text-center">
                    <button class="text-white rounded-5 mb-5 " data-bs-toggle="modal"
                        data-bs-target="#form_info">確認</button>
                    <button class="rounded-5 mb-5 bg-white " id="meeting_book_skip1">スキップ</button>
                </div>
            </div>
            <!-- END MEETING BOOKING -->
            <!-- CONGRATULATION -->
            <div class="congratulation d-none">
                <div class="container">
                    <div class="w-100 text-center">
                        <img src="{{ asset('/assets/img/application/congratulation.png') }}" alt="ok">
                    </div>
                    <div class="w-100 text-center mt-5 pb-5">
                        <!-- <button class="bg-white rounded-5">あなたの経験を評価してください</button> -->
                        <button class="bg-white rounded-5" onclick="window.location.href='/'">トップとして</button>
                    </div>
                </div>
            </div>
            <!-- END CONGRATULATION -->
        </div>
        <div class="container py-5 d-flex justify-content-center" id="welcome_message">
            <div class="card rounded-5 shadow ">
                <div class="title">
                    <h3>{!! $message->title !!}</h3>
                </div>
                <div class="content">
                    {!! $message->content !!}

                </div>
                <div class="button-group">
                    <button class="btn  rounded-5 bg-secondary" id="go_interview"
                        onclick="show_next(0)">面接に行く</button>
                </div>
                <div class="content">
                    <p>
                        {interview_name}、{company_name} のポジションにご興味をお持ちいただきありがとうございます。
                        短い一方通行のビデオインタビューであなたのことをもっと知りたいと思っています。
                        <br><br>
                        面接は、カメラとマイクを使用して答える一連の質問で構成されます。 パソコンにアクセスできない場合は、スマートフォンやタブレットを使用して面接を完了することもできます。
                        <br><br>
                        仕組み: 一方通行の面接に慣れていない方のために説明すると、一方通行の面接は、事前に作成された質問による単純な面接であり、都合の良いときにビデオ回答を録画します。
                        次の質問に進む前に、各質問に回答する必要があります。
                        <br><br>
                        このインタビューを完了すると、電話やビデオ通話よりも早くあなたのことを知ることができ、いつでもどこでも完了できます。
                        <br><br>
                        開始する前に、面接ガイドをお読みください: 素晴らしい面接への 5 つの簡単なステップ
                        <br><br>
                        ありがとう、{interview_owner_name}
                    </p>
                </div>

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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="{{ asset('/assets/js/application/application.js') }}"></script>

    <script>
        @foreach ($questions as $question)
            @if ($question->type == 'text')
                quill{{ $question->question_no }} = new Quill('#editor{{ $question->question_no }}', {
                    theme: 'snow'
                });

                quill{{ $question->question_no }}.on('text-change', function(delta, oldDelta, source) {
                    if (source == 'api') {

                    } else if (source == 'user') {
                        $("[name=content{{ $question->question_no }}]").val = quill{{ $question->question_no }}
                            .root.innerHTML;
                        if (new String(quill{{ $question->question_no }}.getContents().ops[0].insert) == '\n') {
                            $("#save_continue{{ $question->question_no }}").removeClass("active");
                            $("#save_continue{{ $question->question_no }}").attr("disabled", " ");
                            $("#save_continue{{ $question->question_no }}").removeClass("active").attr("disabled",
                                "");
                        } else {
                            $("#save_continue{{ $question->question_no }}").addClass("active");
                            $("#save_continue{{ $question->question_no }}").removeAttr("disabled");
                            $("#save_continue{{ $question->question_no }}").addClass("active").removeAttr(
                                "disabled");
                        }
                    }
                });
            @endif
        @endforeach
        navigator.mediaDevices.enumerateDevices()
            .then(function(devices) {
                var hasCamera = devices.some(function(device) {
                    return device.kind === 'videoinput';
                });

                if (hasCamera) {
                    console.log('Camera is connected.');
                } else {
                    $(".camera_not_connected").removeClass("d-none");
                    $(".video-recoding").attr("disabled", "").addClass("bg-secondary-subtle");
                }
            })
            .catch(function(err) {
                console.error('Error accessing media devices: ', err);
            });
        let recording = false;

        async function video_record(question_no) {
            const videoLive = document.querySelector('#videoLive' + question_no)
            const videoRecorded = document.querySelector('#videoRecorded' + question_no)
            let stream;


            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                await navigator.mediaDevices.getUserMedia({ // <1>
                    video: true,
                    audio: true,
                }).then(function(sss) {
                    stream = sss;

                    videoLive.srcObject = stream

                    if (!MediaRecorder.isTypeSupported('video/webm')) { // <2>
                        console.warn('video/webm is not supported')
                    }

                    const mediaRecorder = new MediaRecorder(stream, { // <3>
                        mimeType: 'video/webm',
                    })

                    mediaRecorder.start()
                    recording = true;
                    $("#record").html('録音を停止')


                    $("#record").click(function() {

                        if (!recording) {
                            mediaRecorder.start() // <4>
                            $("#record").html('録音を停止')
                            $(videoLive).toggleClass("d-none");
                            $(videoRecorded).toggleClass("d-none");

                        } else {
                            mediaRecorder.stop()
                            $("#record").html('録音を閧始')
                            $(videoLive).toggleClass("d-none");
                            $(videoRecorded).toggleClass("d-none");

                        }
                        recording = !recording;
                    })


                    mediaRecorder.addEventListener('dataavailable', event => {
                        videoRecorded.src = URL.createObjectURL(event.data) // <6>
                    })
                }).catch(function(res) {
                    console.log(res);
                    // alert("カメラを接続してください。")
                })
            } else {
                console.error('getUserMedia()はサポートされていません。\n httpsで接続してください。');
            }


        }
        let flag = true;
        const questions = {!! $questions !!};
        const last_no = questions.length;
        let interval = 0;

        let count = 0;

        function start_time(q_no) {
            if (interval != 0) {
                clearInterval(interval);
                interval = 0;
                count = 0;
            }
            q_no = parseInt(q_no);
            if (isNaN(q_no)) {
                return;
            }
            console.log($("#tab-" + q_no + " .dis_minute"));
            const interval = setInterval(function(e) {
                let minute = parseInt(count / 60);
                let second = parseInt(count % 60);
                count++;
                $("#tab-" + q_no + " .dis_minute").html(minute);
                $("#tab-" + q_no + " .dis_second").html(second);
                let thinking_hour = parseInt([q_no].thinking_hour);
                let thinking_minute = parseInt([q_no].thinking_minute);
                if (isNaN(thinking_hour)) {
                    thinking_hour = 0;
                }
                if (isNaN(thinking_minute)) {
                    thinking_minute = 0;
                }
                if (thinking_hour * 60 + thinking_minute < minute) {
                    $("#tab-" + q_no + " .show_count").addClass("text-danger");
                }
            }, 1000);
        }

        function make_answer(q_no) {
            q_no = parseInt(q_no);
            if (!isNaN(q_no)) {
                alert("The question is incorrect.");
                return;
            }
            if () {

                return;
            }
            if (questions[q_no].type == 'video') {

            }

        }

        function show_next(q_no) {
            if (q_no == 0) {
                $(".test-content .tab-content:first-child").addClass("active");
            }

            if (last_no >= q_no) {
                $("#tab-" + q_no).
                return;
            }
        }

        function save_text(q_no) {
            q_no = parseInt(q_no);
            let token = $("meta[name=csrf-token]").attr("content");
            let content = $("[name=content" + q_no + "]").val();

            let postData = {
                _token: token,
                content: content,
                count: count,
                q_no: q_no,
                url: {{ $url }},
            };

            $.ajax({
                url: "{{ route('interview.save_text', ['url' => $url]) }}",
                type: 'POST',
                data: postData,
                success: function(response) {

                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message == "Unauthenticated") {
                        window.location.reload();
                    }
                    alert(xhr.responseJSON.message);
                }
            });
        }
        //     var header = document.querySelector(".header");
        //     var chatRoom = document.querySelector(".chat-room");
        //     var typeArea = document.querySelector(".type-area");
        //     var btnAdd = document.querySelector(".button-add");
        //     var others = document.querySelector(".others");
        //     var emojiBox = document.querySelector(".emoji-button .emoji-box");
        //     var emojiButton = document.querySelector(".others .emoji-button");
        //     var emojis = document.querySelectorAll(".emoji-box span");
        //     var inputText = document.querySelector("#inputText");
        //     var btnSend = document.querySelector(".button-send");
        //     var messageArea = document.querySelector(".message.message-right");
        //     //Header onclick event
        //     header.addEventListener("click", function (e)  {
        //         if (typeArea.classList.contains("d-none")) {
        //             header.style.borderRadius = "20px 20px 0 0";
        //         } else {
        //             header.style.borderRadius = "20px";
        //         }
        //         typeArea.classList.toggle("d-none");
        //         chatRoom.classList.toggle("d-none");
        //     });
        //     //Button Add onclick event
        //     btnAdd.addEventListener("click", function (e)  {
        //         others.classList.add("others-show");
        //     });
        //     //Emoji onclick event
        //     emojiButton.addEventListener("click", function (e)  {
        //         emojiBox.classList.add("emoji-show");
        //     });
        //     //Button Send onclick event
        //     btnSend.addEventListener("click", function (e)  {
        //         var mess = inputText.value;
        //         var bubble = document.createElement('div');
        //         bubble.className += " bubble bubble-dark";
        //         bubble.textContent = mess;
        //         messageArea.appendChild(bubble);
        //         inputText.value = "";
        //     });
        //     for (var emoji of emojis) {
        //         emoji.addEventListener("click", function (e)  {
        //             e.stopPropagation();
        //             emojiBox.classList.remove("emoji-show");
        //             others.classList.remove("others-show");
        //             inputText.value += e.target.textContent;
        //         });
        //     }
    </script>

</body>

</html>
