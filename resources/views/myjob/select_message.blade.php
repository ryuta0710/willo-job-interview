@extends('layouts.company')

@section('content')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/modal-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/create-interview/index.css') }}">

    <main class="pt-5">
        <div class="container mb-5">
            <!-- nav link -->
            <div class="row">
                <ul class="list-inline">
                    <li class="list-inline-item me-2">
                        <a class="u-link-v5" href="{{ route('myjob.index') }}">
                            <i class="fa-solid fa-play me-2"></i>インタビュー
                        </a>
                    </li>
                    <li class="list-inline-item me-2">
                        <label class="u-link-v5 g-color-main" href="#">
                            <i class="fa fa-angle-right me-2"></i>インタビュー作成
                        </label>
                    </li>
                </ul>
            </div>
            <!-- end nav link -->
            <!-- steps -->
            <div class="row mt-4">
                <div id="steps" class="col-12 d-flex justify-content-center align-items-center smaller">
                    <div class="d-flex flex-column align-items-center">
                        <div class="rounded-circle bg-secondary-white p-3 d-flex justify-content-center align-items-center mb-2 bg-active"
                            style="width: 55px; height: 55px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22.498" height="25.468"
                                viewBox="0 0 22.498 25.468">
                                <path id="Icon_open-document" data-name="Icon open-document"
                                    d="M0,0V23.761H20.791V11.881H8.91V0ZM11.881,0V8.91h8.91ZM2.97,5.94H5.94V8.91H2.97Zm0,5.94H5.94v2.97H2.97Zm0,5.94H14.851v2.97H2.97Z"
                                    transform="translate(0.5 1.207)" fill="#fff" stroke="#4ca7ee" stroke-width="1" />
                            </svg>
                        </div>
                        <label>セットアップ</label>
                    </div>
                    <div class="mb-5 fs-2 ms-1 me-3">
                        <span>------</span>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <div class="rounded-circle p-3 bg-secondary-white d-flex justify-content-center align-items-center mb-2 bg-active"
                            style="width: 55px; height: 55px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g id="Group_2215" data-name="Group 2215" transform="translate(-872 -254)">
                                    <g id="Group_2212" data-name="Group 2212" transform="translate(872 254)">
                                        <path id="Path_81" data-name="Path 81"
                                            d="M5.6,18.39h.8v-.8H5.6Zm0,4.8H4.8a.8.8,0,0,0,.44.715.809.809,0,0,0,.84-.075Zm6.4-4.8v-.8h-.265l-.215.16ZM7.2,6.395H6.4v1.6h.8Zm9.6,1.6h.8v-1.6h-.8Zm-9.6,3.2H6.4v1.6h.8Zm6.4,1.6h.8v-1.6h-.8ZM4.8,18.39v4.8H6.4v-4.8Zm1.28,5.435,6.4-4.8-.96-1.28-6.4,4.8ZM12,19.19h9.6v-1.6H12Zm9.6,0a2.4,2.4,0,0,0,2.4-2.4H22.4a.8.8,0,0,1-.8.8Zm2.4-2.4V2.4H22.4V16.79ZM24,2.4A2.4,2.4,0,0,0,21.6,0V1.6a.8.8,0,0,1,.8.8ZM21.6,0H2.4V1.6H21.6ZM2.4,0A2.4,2.4,0,0,0,0,2.4H1.6a.8.8,0,0,1,.8-.8ZM0,2.4V16.79H1.6V2.4ZM0,16.79a2.4,2.4,0,0,0,2.4,2.4v-1.6a.8.8,0,0,1-.8-.8Zm2.4,2.4H5.6v-1.6H2.4Zm4.8-11.2h9.6v-1.6H7.2Zm0,4.8h6.4v-1.6H7.2Z"
                                            fill="#fff" />
                                        <path id="Path_82" data-name="Path 82" d="M0,0H24V24H0Z" fill="none" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <label>質問</label>
                    </div>
                    <div class="mb-5 fs-2 ms-3 me-1">
                        <span>------</span>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <div class="rounded-circle p-3 bg-secondary-white d-flex justify-content-center align-items-center mb-2 bg-active"
                            style="width: 55px; height: 55px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                                <g id="Group_2216" data-name="Group 2216" transform="translate(-1026 -252)">
                                    <path id="Path_92" data-name="Path 92"
                                        d="M10,0c5.523,0,10,4.029,10,9s-4.477,9-10,9a10.772,10.772,0,0,1-6.442-2.151l-2.195.7.86-1.89A8.252,8.252,0,0,1,0,9C0,4.029,4.477,0,10,0Z"
                                        transform="translate(1029 256)" fill="#fff" />
                                    <g id="Group_2211" data-name="Group 2211" transform="translate(1026 252)">
                                        <path id="Path_79" data-name="Path 79"
                                            d="M6,25.314l1.408-4.225A8.038,8.038,0,0,1,9.683,9.849a10.681,10.681,0,0,1,12.832.52,7.977,7.977,0,0,1,1.116,11.375,10.549,10.549,0,0,1-12.54,2.486L6,25.314"
                                            transform="translate(-2.75 -3.647)" fill="none" stroke="#4ca7ee"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        <path id="Path_80" data-name="Path 80" d="M0,0H26V26H0Z" fill="none" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <label>テンプレート</label>
                    </div>
                    <div class="mb-5 fs-2 ms-1 me-3">
                        <span>------</span>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <div class="rounded-circle p-3 bg-secondary-white d-flex justify-content-center align-items-center mb-2 bg-active"
                            style="width: 55px; height: 55px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30.063" height="27.422"
                                viewBox="0 0 30.063 27.422">
                                <g id="Layer_1" transform="translate(0.552 0.899)">
                                    <g id="Group_2213" data-name="Group 2213" transform="translate(0 12.011)">
                                        <path id="Path_83" data-name="Path 83"
                                            d="M482.8,975.862a4.532,4.532,0,0,1,4.391-3.951,3.9,3.9,0,0,1,.849.093,5.141,5.141,0,0,1,.03-.538,5.584,5.584,0,0,1,5.409-4.866,4.268,4.268,0,0,1,4.323,4.866"
                                            transform="translate(-482.8 -966.6)" fill="none" stroke="#4ca7ee"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                            stroke-width="1" />
                                        <path id="Path_84" data-name="Path 84"
                                            d="M1044.819,990.562a3.465,3.465,0,0,0-3.509-3.951,4.168,4.168,0,0,0-.868.093c.038-.177.068-.355.09-.538a4.268,4.268,0,0,0-4.323-4.866,5.584,5.584,0,0,0-5.409,4.866"
                                            transform="translate(-1015.836 -980.899)" fill="none" stroke="#4ca7ee"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                            stroke-width="1" />
                                    </g>
                                    <g id="Group_2214" data-name="Group 2214"
                                        transform="matrix(0.999, -0.035, 0.035, 0.999, 8.379, 0.03)">
                                        <path id="Path_85" data-name="Path 85"
                                            d="M876.924,546.538a16.522,16.522,0,0,0,1.892-.156c8.3-13.555,1.065-18.636-.582-19.573a.67.67,0,0,0-.65,0c-1.742.934-9.478,6.016-2.537,19.573A15.432,15.432,0,0,0,876.924,546.538Z"
                                            transform="translate(-871.25 -526.725)" fill="#fff" stroke="#4ca7ee"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                            stroke-width="1" />
                                        <path id="Path_86" data-name="Path 86"
                                            d="M839.256,1098.2h0a4.409,4.409,0,0,0-1.868,4.88l.6,1.884,3.012-2.709Z"
                                            transform="translate(-837.203 -1082.595)" fill="#fff" stroke="#4ca7ee"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                            stroke-width="1" />
                                        <path id="Path_87" data-name="Path 87"
                                            d="M1117.049,1098.2h0a4.088,4.088,0,0,1,1.382,4.88l-.789,1.884-2.742-2.709Z"
                                            transform="translate(-1107.317 -1082.595)" fill="#fff" stroke="#4ca7ee"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                            stroke-width="1" />
                                        <ellipse id="Ellipse_29" data-name="Ellipse 29" cx="1.95" cy="1.854"
                                            rx="1.95" ry="1.854"
                                            transform="translate(3.634 6.831) rotate(-44.283)" fill="#fff"
                                            stroke="#4ca7ee" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-miterlimit="10" stroke-width="1" />
                                        <path id="Path_88" data-name="Path 88"
                                            d="M945.6,1167a33.32,33.32,0,0,0,5.573,0"
                                            transform="translate(-942.64 -1149.517)" fill="none" stroke="#4ca7ee"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                            stroke-width="1" />
                                    </g>
                                    <line id="Line_25" data-name="Line 25" y1="3.004" x2="1.775"
                                        transform="translate(11.701 22.385)" fill="#fff" stroke="#4ca7ee"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                        stroke-width="1" />
                                    <line id="Line_26" data-name="Line 26" y1="2.935" x2="0.137"
                                        transform="translate(15.27 23.065)" fill="#fff" stroke="#4ca7ee"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                        stroke-width="1" />
                                    <line id="Line_27" data-name="Line 27" x1="1.578" y1="3.02"
                                        transform="translate(17.342 22.369)" fill="#fff" stroke="#4ca7ee"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                        stroke-width="1" />
                                </g>
                            </svg>
                        </div>
                        <label>公開する</label>
                    </div>
                </div>
            </div>
            <!-- end steps -->
        </div>

        <!-- NOTIFICATION MESSAGE -->
        <div class="container" id="notification">
            <div class="w-100 pt-5 px-5 fs-14">
                <div class="row">
                    <div class="col-12 pb-3 pt-3">
                        <div class="col-12 ps-4 fs-6">招待</div>
                    </div>
                    <div class="col-12 col-xl-6 mb-3 pt-1 ">
                        <div class="d-flex justify-content-between pb-1 px-4">
                            <label for="input1" class="form-label"><i
                                    class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;メールテンプレート</label>
                            <a class="text-active modal-show" data-bs-target="#inviteModal" data-bs-toggle="modal"
                                type="mail" trigger="invite" data-tar="#mail_invite" href="javascript:;"><i
                                    class="fa-solid fa-eye me-2"></i>プレビュー</a>
                        </div>
                        <select type="text" class="form-select rounded-5" id="mail_invite">
                            @foreach ($mail_invites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-xl-6 mb-3 py ">
                        <div class="d-flex justify-content-between pb-1 px-4">
                            <label for="input1" class="form-label"><i
                                    class="fa-solid fa-comment"></i>&nbsp;&nbsp;&nbsp;SMS
                                テンプレート</label>
                            <a class="text-active modal-show" data-bs-target="#smsModal" data-bs-toggle="modal"
                                type="sms" trigger="invite" data-tar="#sms_invite" href="javascript:;"><i
                                    class="fa-solid fa-eye me-2"></i>プレビュー</a>
                        </div>
                        <select type="text" class="form-select rounded-5" id="sms_invite">
                            @foreach ($sms_invites as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 pb-3 pt-3">
                        <div class="col-12 ps-4 fs-6">不完全なリマインダー</div>
                    </div>
                    <div class="col-12 col-xl-6 mb-3 pt-1 ">
                        <div class="d-flex justify-content-between pb-1 px-4">
                            <label for="input1" class="form-label"><i
                                    class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;メールテンプレート</label>
                            <a class="text-active modal-show" data-bs-target="#reminderModal" data-bs-toggle="modal"
                                type="mail" trigger="reminder" data-tar="#mail_reminder" href="javascript:;"><i
                                    class="fa-solid fa-eye me-2"></i>プレビュー</a>
                        </div>
                        <select type="text" class="form-select rounded-5" id="mail_reminder">
                            @foreach ($mail_reminder as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-xl-6 mb-3 py ">
                        <div class="d-flex justify-content-between pb-1 px-4">
                            <label for="input1" class="form-label"><i
                                    class="fa-solid fa-comment"></i>&nbsp;&nbsp;&nbsp;SMS
                                テンプレート</label>
                            <a class="text-active modal-show" data-bs-target="#smsModal" data-bs-toggle="modal"
                                type="sms" trigger="reminder" data-tar="#sms_reminder" href="javascript:;"><i
                                    class="fa-solid fa-eye me-2"></i>プレビュー</a>
                        </div>
                        <select type="text" class="form-select rounded-5" id="sms_reminder">
                            @foreach ($sms_reminders as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 pb-3 pt-3">
                        <div class="col-12 ps-4 fs-6">面接終了通知</div>
                    </div>
                    <div class="col-12 col-xl-6 mb-3 pt-1 ">
                        <div class="d-flex justify-content-between pb-1 px-4">
                            <label for="input1" class="form-label"><i
                                    class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;メールテンプレート</label>
                            <a class="text-active modal-show" data-bs-target="#successModal" data-bs-toggle="modal"
                                data-tar="#mail_success" type="mail" trigger="success" href="javascript:;"><i
                                    class="fa-solid fa-eye me-2"></i>プレビュー</a>
                        </div>
                        <select type="text" class="form-select rounded-5" id="mail_success">
                            @foreach ($mail_success as $item)
                                <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- END ROW -->
            </div>
        </div>
        <!-- END NOTIFICATION MESSAGE -->
        <div class="container">
            <div class="w-100 d-flex justify-content-center align-items-baseline text-center mt-4 mb-5">
                <a class="btn  btn-normal rounded-5 bg-white border border-primary me-4"
                    href="{{ route('myjob.create_questions', ['myjob' => $myjob]) }}" id="before">戻る</a>
                <button class="btn  btn-normal rounded-5 active" id="next">次に</button>
            </div>

        </div>
    </main>

    <div class="modal fade modal-preview" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content rounded-5">
                <div class="modal-header">
                    <div></div>
                    <h5 class="modal-title text-center">Default Invite Email</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="body-header">
                        <img src="{{ asset('/assets/img/success.jpg') }}" alt="success icon">
                    </div>
                    <div class="message-content">

                    </div>
                    <div class="body-footer mt-5">
                        <hr>
                        <p class="text-center">
                            We've let {recruiter_name} know you've completed this interview.
                            <br><br>
                            <span class="text-success">This interview produced 93% fewer emissions than a traditional
                                face-to-face interview.</span>
                            <br>👋
                        </p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="/" class="text-center">
                        <img src="{{ asset('/assets/img/logo01.png') }}" style="width: 150px;" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-preview" id="inviteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content rounded-5">
                <div class="modal-header">
                    <div></div>
                    <h5 class="modal-title text-center">Default Invite Email</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="message-content">

                    </div>
                    <div class="body-footer mt-4 text-center">
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary px-4 py-3 rounded-pill"
                                data-bs-dismiss="modal">Go to the interview</button>
                        </div>
                        <hr class="mb-4 mt-4">
                        <h6>Before you get started 💡</h6>
                        <p>Please allow sufficient time to complete the interview. We recommend using the latest version of
                            Google Chrome or Firefox browser in Incognito mode, on a stable and fast internet connection.
                            Relax and put your best self forward, you can practice as many times as you like to feel
                            comfortable.
                        </p>
                        <h6>Technical question or issue?
                        </h6>
                        <p>Please visit the 24/7 support portal or email support@willo.video.
                            <br><br>
                            We sent you this email on behalf of {interview_owner_name}.
                            {{-- <a href="/ ">Report abuse here.</a> --}}
                        </p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="/" class="text-center">
                        <img src="{{ asset('/assets/img/logo01.png') }}" style="width: 150px;" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-preview" id="reminderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content rounded-5">
                <div class="modal-header">
                    <div></div>
                    <h5 class="modal-title text-center">Default Invite Email</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="message-content">

                    </div>
                    <div class="body-footer mt-4 text-center">
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary px-4 py-3 rounded-pill"
                                data-bs-dismiss="modal">Go to the interview</button>
                        </div>
                        <hr>
                        <p class="text-center mt-4">Willo sent you this email on behalf of {recruiter_name}.
                            {{-- <a href=""> Report abuse.</a> --}}
                        </p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="/" class="text-center">
                        <img src="{{ asset('/assets/img/logo01.png') }}" style="width: 150px;" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-preview" id="smsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content rounded-5">
                <div class="modal-header">
                    <div></div>
                    <h5 class="modal-title text-center">Default Invite Email</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="message-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        $(".modal-show").click(function(e) {
            const type = $(e.currentTarget).attr("type");
            const tar = $(e.currentTarget).attr("data-tar");
            const message_id = $(tar).val();
            const modal_name = $(e.currentTarget).attr("data-bs-target");

            $.get(
                "/template/" + message_id,
                function(data, status) {
                    if (status == "success") {
                        $(modal_name + " .message-content").html(data.content);
                        $(modal_name + " .modal-title").html(data.title);
                    } else {

                    }
                }
            )
        });

        $("#next").click(function() {
            const mail_invite_id = $("#mail_invite").val();
            const mail_success_id = $("#mail_reminder").val();
            const mail_reminder_id = $("#mail_success").val();
            const sms_invite_id = $("#sms_invite").val();
            const sms_reminder_id = $("#sms_reminder").val();

            $.ajax({
                url: "{{ route('myjob.store_messages', ['myjob' => $myjob]) }}",
                type: 'post',
                data: {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    mail_invite_id,
                    mail_success_id,
                    mail_reminder_id,
                    sms_invite_id,
                    sms_reminder_id,
                },
                success: function(response) {
                    location.href = "{{ route('myjob.publish', ['myjob' => $myjob]) }}";
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message == "Unauthenticated") {
                        window.location.reload();
                    }
                    alert(xhr.responseJSON.message);
                }
            });
        });
    </script>
@endsection
