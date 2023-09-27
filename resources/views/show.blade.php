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
            <!-- CONTENT CONFIRM -->
            <div class="test-complete">
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
                        $("[name=content{{ $question->question_no }}]").val=quill{{ $question->question_no }}.root.innerHTML;
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
                url: {{$url}},
            };

            $.ajax({
                url: "{{route('interview.save_text', ['url' => $url])}}",
                type: 'POST',
                data: postData,
                success: function(response) {
                    
                },
                error: function(xhr, status, error) {
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
