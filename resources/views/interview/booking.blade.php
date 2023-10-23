<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIRIHARE | 会議スケジュール</title>

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
            <a class="navbar-brand pe-5" href="/">
                <img src="{{ asset('/assets/img/logo01.png') }}" alt="">
            </a>
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
                    <div class="w-100 text-center m-0" style="padding-top: 7.88rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="189.859" height="189.859"
                            viewBox="0 0 189.859 189.859">
                            <g id="Icon_ionic-ios-checkmark-circle-outline"
                                data-name="Icon ionic-ios-checkmark-circle-outline"
                                transform="translate(-3.375 -3.375)">
                                <path id="Path_153" data-name="Path 153"
                                    d="M108.194,21.015l-8.032-8.261a1.727,1.727,0,0,0-1.278-.548h0a1.657,1.657,0,0,0-1.278.548L41.925,68.844,21.662,48.581a1.765,1.765,0,0,0-2.556,0L10.982,56.7a1.818,1.818,0,0,0,0,2.6L36.54,84.864a8.083,8.083,0,0,0,5.34,2.6c2.419,0,4.518-1.78,5.294-2.51h.046l61.02-61.339A1.951,1.951,0,0,0,108.194,21.015Z"
                                    transform="translate(38.762 48.492)" fill="#4ca7ee" />
                                <path id="Path_154" data-name="Path 154"
                                    d="M98.3,16.154A82.164,82.164,0,0,1,156.4,156.4a82.164,82.164,0,0,1-116.2-116.2A81.607,81.607,0,0,1,98.3,16.154m0-12.779a94.93,94.93,0,1,0,94.93,94.93A94.915,94.915,0,0,0,98.3,3.375Z"
                                    transform="translate(0 0)" fill="#4ca7ee" />
                            </g>
                        </svg>
                    </div>
                    <p class="text-center my-3" style="font-size: 16px">
                        募集トピック<br>
                        採用担当名</p>
                    <h2 class="text-center" style="font-size: 40px;color: #344D64;">すべて完了しました</h2>
                    <p class="text-center" style="font-size: 20px">今日のインタビューにご参加いただきありがとうございます。<br>
                        残りの一日をお楽しみください。👋</p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
                toastr.error('名前、Eメール、電話番号を正確に入力してください。');
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
                    toastr.error(xhr.responseJSON.message);
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
