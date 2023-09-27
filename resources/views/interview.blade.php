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

    <!-- CSRF Token -->
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
        <div class="container py-5 d-flex justify-content-center" id="welcome_message">
            <div class="card rounded-5 shadow ">
                <div class="title">
                    <h3>Default Invite Email</h3>
                </div>
                <div class="content">
                    {!! $message->content !!}
                    
                </div>
                <div class="button-group">
                    <button class="btn  rounded-5 bg-secondary" id="go_interview" onclick="make_answer(1)">Go to
                        interview</button>
                </div>
                <div class="content">
                    <p>
                        Thanks for your interest in the {interview_name}, {company_name} position. I'd like to get
                        to
                        know you
                        better with a short one-way video interview.
                        <br><br>
                        Your interview will consist of a set of questions for you to answer using your camera and
                        microphone. If you
                        don't have access to a computer you can also complete your interview using any smartphone or
                        tablet.
                        <br><br>
                        How it works:
                        If you're unfamiliar with one-way interviews, they are simply interviews with pre-written
                        questions where
                        you record a video response, at your convenience. Each question should be answered before
                        you
                        move on to the
                        next one.
                        <br><br>
                        Completing this interview will allow us to get to know you more quickly than a phone or
                        video
                        call, and you
                        can complete it anywhere, any time.
                        <br><br>
                        Please read this guide to your interview before starting:
                        5 Easy steps to a great interview
                        <br><br>
                        Thanks,
                        {interview_owner_name}
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

        function make_answer(q_no) {
            q_no = parseInt(q_no);
            if (!isNaN(q_no) && q_no <= 0) {
                alert("The question is incorrect.");
                return;
            }
            create(0);
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

        function create(q_no) {
            let token = $("meta[name=csrf-token]").attr("content");

            let postData = {
                _token: token,
                q_no: 1,
            };

            $.ajax({
                url: "{{route('interview.create_answer', ['url' => $url])}}",
                type: 'POST',
                data: postData,
                success: function(response) {
                    location.href = response.url;
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseJSON.message);
                }
            });
        }
    </script>

</body>

</html>
