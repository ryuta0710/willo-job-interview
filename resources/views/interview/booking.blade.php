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
        <div class="container max-1200" id="test">

            <!-- MEETING BOOkING -->
            <div class="meeting-book">
                <h1 class="text-center mb-0">あなたの空き状況</h1>
                <p class="">今後数日間、フォローアップの会話にいつ対応できるかを知っておくと便利です。空き枠を 3 つ以上選択してください。このセクションはオプションです。</p>
                <div class="w-100 pt-3">
                    <table id="booking_table" class="table table-hover table-bordered w-100 text-white text-center">
                        <thead>
                            <tr class="text-white">
                                <th class="p-0"><i class="fa-solid fa-clock text-white"></i></th>
                                @php
                                    $currentDate = now()->addDay(); // Get tomorrow's date
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
                        <tbody>
                            <tr data-time="8:00">
                                <td>午前8:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="8:30">
                                <td>午前8:30</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="9:00">
                                <td>午前9:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="9:30">
                                <td>午前9:30</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="10:00">
                                <td>午前10:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="10:30">
                                <td>午前10:30</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="11:00">
                                <td>午前11:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="11:30">
                                <td>午前11:30</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="12:00">
                                <td>午前12:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="12:30">
                                <td>午後12:30</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="13:00">
                                <td>午後1:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="13:30">
                                <td>午後1:30</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="14:00">
                                <td>午後2:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="14:30">
                                <td>午後2:30</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="15:00">
                                <td>午後3:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="15:30">
                                <td>午後3:30</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="16:00">
                                <td>午後4:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="16:30">
                                <td>午後4:30</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="17:00">
                                <td>午後5:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="17:30">
                                <td>午後5:30</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>
                            <tr data-time="18:00">
                                <td>午後6:00</td>
                                <td data-no="1"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="2"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="3"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="4"><i class="fa-regular fa-circle-check"></i></td>
                                <td data-no="5"><i class="fa-regular fa-circle-check"></i></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="w-100 text-center">
                    <button class="text-white rounded-5 mb-5 bg-secondary-subtle border-secondary-subtle"
                        data-bs-toggle="modal" data-bs-target="#form_info" onclick="ok()" id="ok"
                        disabled>確認</button>
                    <button class="rounded-5 mb-5 bg-white " data-bs-toggle="modal" data-bs-target="#form_info"
                        id="meeting_book_skip1" onclick="skip()" id="skip">スキップ</button>
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
                            <label for="info_phone" pattern="+[0-9+]" class="form-label ms-3">電話番号</label>
                            <input type="text" class="form-control rounded-pill" id="info_phone"
                                placeholder="電話番号入力">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="button" class="btn btn-primary" id="meeting_book_ok">確認</button>
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
    <script>
        let is_skip = false;

        $("#meeting_book_ok").click(function(e) {
            let name = $("#info_name").val().trim();
            let email = $("#info_mail").val().trim();
            let tel = $("#info_phone").val().trim();
            if (name == "" || email == "" || tel == "" || !validateEmail(email)) {
                e.preventDefault();
                alert("名前、Eメール、電話番号を正確に入力してください。");
                return;
            }
            let postData = {
                _token: $("meta[name=csrf-token]").attr("content"),
                name,
                email,
                tel,
                date,
                is_book: is_skip || false,
                schedules: schedules || [],
            };

            $.ajax({
                url: "{{ route('interview.save_booking', ['url' => $url]) }}",
                type: 'POST',
                data: postData,
                success: function(response) {
                    $('#form_info').modal('hide');
                    $(".meeting-book").removeClass("d-block").addClass("d-none");
                    $(".congratulation").removeClass("d-none").addClass("d-block");
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message == "Unauthenticated") {
                        window.location.reload();
                    }
                    alert(xhr.responseJSON.message);
                }
            });
        })
        let schedules = [];

        $(".meeting-book td").click(function() {
            $(this).toggleClass("active");
            var val = $(this).attr("data-no");
            if (val) {
                var time = $(this).parent().attr("data-time");
                if ($(this).hasClass("active")) {
                    schedules.push({
                        day: val,
                        time: time
                    });
                } else {
                    schedules = schedules.filter(function(item) {
                        return item.day != val || item.time != time;
                    })
                }
                if (schedules.length > 2) {
                    $("#ok").removeClass("bg-secondary-subtle").removeClass("border-secondary-subtle").removeAttr(
                        "disabled");
                } else {
                    $("#ok").addClass("bg-secondary-subtle").addClass("border-secondary-subtle").attr("disabled",
                        "");
                }
            }
        })

        function skip() {
            is_skip = false;
        }

        function ok() {
            is_skip = true;
        }
        let date = new Date("{{ now() }}");

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>

</body>

</html>
