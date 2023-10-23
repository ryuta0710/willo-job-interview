<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIRIHARE | インタビュー開始</title>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/plyr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/css/application/fileupload.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/application/application.css') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #go_interview:hover {
            background-color: #1c91df !important;
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
        <div class="container py-5 d-flex justify-content-center" id="welcome_message">
            <div class="card rounded-5 shadow text-secondary-subtle">
                <div class="title">
                    <h3 class="mb-5">素晴らしいビデオを録画する方法</h3>
                </div>
                <div class="content text-start">
                    <ol>
                        <li>デバイスに高品質のカメラまたは Web カメラが接続されていることを確認します。</li>
                        <li>照明が十分にあり、明るい場所を見つけます。通常、自然光が最良の選択肢です。</li>
                        <li>カメラの前に位置し、適切にフレームに収めます。</li>
                        <li>自分の背景に注意を払います。清潔で気を散らすものがないことを確認してください。</li>
                        <li>オーディオ設定を確認し、マイクが適切に機能していることを確認します。</li>
                        <li>ビデオ内で言いたいことややりたいことを準備します。プレゼンテーション、デモンストレーション、またはその他の紹介したいものであれば何でも構いません。</li>
                        <li>いくつかの練習ショットを撮り、すべての見た目とサウンドが適切であることを確認します。</li>
                        <li>準備ができたら、録画ボタンを押してビデオの録画を開始します。</li>
                        </ul>
                </div>
                <div class="button-group mt-3 mb-4">
                    <button class="btn rounded-5 bg-hover-primary"
                        style="background-color: var(--bs-primary);color:white;" id="go_interview"
                        onclick="make_answer(1)">面接に行く</button>
                </div>
                <div class="content text-start">
                    <ol style="list-style: 1;">
                        <li>静かで気を散らすものがない場所にいることを確認してください。</li>
                        <li>デバイスに十分な充電があり、データ接続が良好であることを確認します。</li>
                        <li>プロセスを快適に行えるように練習します。</li>
                        <li>可能な限りカメラと目を合わせてください。</li>
                        <li>プロセスの最後に、送信する前にすべての回答を確認する機会が与えられます。</li>
                        <li>要求された場合は、カメラとマイクへのアクセスを忘れずに許可してください。</li>
                        </ul>
                </div>

            </div>
        </div>

    </main>
    <footer>
        <div class="container-fluid">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="">
                    <a href="/">
                        <img src="{{ asset('/assets/img/logo01.png') }}" alt="">
                    </a>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{route('contact')}}" class="text-secondary">サポート</a>
                    <a href="{{route('privacy')}}" class="text-secondary">プライバシーポリシー</a>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <span>Copyright © PROS Co., Ltd. All Rights Reserved.</span>
        </div>
    </footer>
    <script src="{{ asset('/assets/js/common/jquery-3.7.0.min.js') }}"></script>
    <!-- Include the Quill library -->


    <script>
        function make_answer(q_no) {
            q_no = parseInt(q_no);
            if (!isNaN(q_no) && q_no <= 0) {
                toastr.error('エラーが発生しました。');
                return;
            }
            create(0);
        }

        function create(q_no) {
            let token = $("meta[name=csrf-token]").attr("content");

            let postData = {
                _token: token,
                q_no: 1,
            };

            $.ajax({
                url: "{{ route('interview.create_answer', ['url' => $url]) }}",
                type: 'POST',
                data: postData,
                success: function(response) {
                    location.href = response.url;
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message == "Unauthenticated") {
                        window.location.reload();
                    }
                    toastr.error(xhr.responseJSON.message);
                }
            });
        }
    </script>

</body>

</html>
