@extends('layouts.company')
@section('title', 'テンプレート編集')

@section('content')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/template-list/create.css') }}">

    <main class="pt-5">
        <div class="container">
            <div class="row">
                <ul class="list-inline">
                    <li class="list-inline-item me-2">
                        <a class="u-link-v5" href="/">
                            <i class="fa-solid fa-play me-2"></i>ライブラリ
                        </a>
                    </li>
                    <li class="list-inline-item me-2">
                        <label class="u-link-v5 g-color-main" href="#">
                            <i class="fa fa-angle-right me-2"></i>テンプレートの作成
                        </label>
                    </li>
                </ul>
            </div>
            <div class="row mt-5">
                <form class="col-lg-10 mx-auto">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="title" class="form-label px-3">テンプレートのタイトル</label>
                            <input type="text" value="{{ $message->title }}" class="form-control rounded-pill"
                                id="title" placeholder="テンプレートのタイトル">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="type" class="form-label px-3">テンプレートの種類</label>
                            <select name="type" id="type" class="form-select rounded-pill">
                                <option value="email" @if ($message->type == 'email') selected @endif>E メール</option>
                                <option value="sms" @if ($message->type == 'sms') selected @endif>SMS</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="trigger" class="form-label px-3">テンプレートトリガー</label>
                            <select name="trigger" id="trigger" class="form-select rounded-pill">
                                <option value="invite" @if ($message->type == 'invite')  @endif>招待時</option>
                                <option value="success" @if ($message->type == 'success')  @endif>回答返送時</option>
                                <option value="reminder" @if ($message->type == 'reminder')  @endif>リマインダー</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-between align-items-center px-3">
                            <p class="m-0">テンプレートの内容</p>
                            <a href="javascript:;" id="showModal">
                                <i class="fa fa-solid fa-eye"></i> プレビュー
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="ql-toolbar ql-snow" id="toolbar"><span class="ql-formats"><button type="button"
                                    class="ql-bold"><svg viewBox="0 0 18 18">
                                        <path class="ql-stroke"
                                            d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z">
                                        </path>
                                        <path class="ql-stroke"
                                            d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z">
                                        </path>
                                    </svg></button><button type="button" class="ql-italic"><svg viewBox="0 0 18 18">
                                        <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4">
                                        </line>
                                        <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14">
                                        </line>
                                        <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4">
                                        </line>
                                    </svg></button><button type="button" class="ql-underline"><svg viewBox="0 0 18 18">
                                        <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3">
                                        </path>
                                        <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12"
                                            x="3" y="15"></rect>
                                    </svg></button><button type="button" class="ql-strike"><svg viewBox="0 0 18 18">
                                        <line class="ql-stroke ql-thin" x1="15.5" x2="2.5" y1="8.5"
                                            y2="9.5"></line>
                                        <path class="ql-fill"
                                            d="M9.007,8C6.542,7.791,6,7.519,6,6.5,6,5.792,7.283,5,9,5c1.571,0,2.765.679,2.969,1.309a1,1,0,0,0,1.9-.617C13.356,4.106,11.354,3,9,3,6.2,3,4,4.538,4,6.5a3.2,3.2,0,0,0,.5,1.843Z">
                                        </path>
                                        <path class="ql-fill"
                                            d="M8.984,10C11.457,10.208,12,10.479,12,11.5c0,0.708-1.283,1.5-3,1.5-1.571,0-2.765-.679-2.969-1.309a1,1,0,1,0-1.9.617C4.644,13.894,6.646,15,9,15c2.8,0,5-1.538,5-3.5a3.2,3.2,0,0,0-.5-1.843Z">
                                        </path>
                                    </svg></button></span><span class="ql-formats"><button type="button"
                                    class="ql-header" value="1"><svg viewBox="0 0 18 18">
                                        <path class="ql-fill"
                                            d="M10,4V14a1,1,0,0,1-2,0V10H3v4a1,1,0,0,1-2,0V4A1,1,0,0,1,3,4V8H8V4a1,1,0,0,1,2,0Zm6.06787,9.209H14.98975V7.59863a.54085.54085,0,0,0-.605-.60547h-.62744a1.01119,1.01119,0,0,0-.748.29688L11.645,8.56641a.5435.5435,0,0,0-.022.8584l.28613.30762a.53861.53861,0,0,0,.84717.0332l.09912-.08789a1.2137,1.2137,0,0,0,.2417-.35254h.02246s-.01123.30859-.01123.60547V13.209H12.041a.54085.54085,0,0,0-.605.60547v.43945a.54085.54085,0,0,0,.605.60547h4.02686a.54085.54085,0,0,0,.605-.60547v-.43945A.54085.54085,0,0,0,16.06787,13.209Z">
                                        </path>
                                    </svg></button><button type="button" class="ql-header" value="2"><svg
                                        viewBox="0 0 18 18">
                                        <path class="ql-fill"
                                            d="M16.73975,13.81445v.43945a.54085.54085,0,0,1-.605.60547H11.855a.58392.58392,0,0,1-.64893-.60547V14.0127c0-2.90527,3.39941-3.42187,3.39941-4.55469a.77675.77675,0,0,0-.84717-.78125,1.17684,1.17684,0,0,0-.83594.38477c-.2749.26367-.561.374-.85791.13184l-.4292-.34082c-.30811-.24219-.38525-.51758-.1543-.81445a2.97155,2.97155,0,0,1,2.45361-1.17676,2.45393,2.45393,0,0,1,2.68408,2.40918c0,2.45312-3.1792,2.92676-3.27832,3.93848h2.79443A.54085.54085,0,0,1,16.73975,13.81445ZM9,3A.99974.99974,0,0,0,8,4V8H3V4A1,1,0,0,0,1,4V14a1,1,0,0,0,2,0V10H8v4a1,1,0,0,0,2,0V4A.99974.99974,0,0,0,9,3Z">
                                        </path>
                                    </svg></button></span><span class="ql-formats"><button type="button" class="ql-list"
                                    value="ordered"><svg viewBox="0 0 18 18">
                                        <line class="ql-stroke" x1="7" x2="15" y1="4"
                                            y2="4"></line>
                                        <line class="ql-stroke" x1="7" x2="15" y1="9"
                                            y2="9"></line>
                                        <line class="ql-stroke" x1="7" x2="15" y1="14"
                                            y2="14"></line>
                                        <line class="ql-stroke ql-thin" x1="2.5" x2="4.5" y1="5.5"
                                            y2="5.5"></line>
                                        <path class="ql-fill"
                                            d="M3.5,6A0.5,0.5,0,0,1,3,5.5V3.085l-0.276.138A0.5,0.5,0,0,1,2.053,3c-0.124-.247-0.023-0.324.224-0.447l1-.5A0.5,0.5,0,0,1,4,2.5v3A0.5,0.5,0,0,1,3.5,6Z">
                                        </path>
                                        <path class="ql-stroke ql-thin"
                                            d="M4.5,10.5h-2c0-.234,1.85-1.076,1.85-2.234A0.959,0.959,0,0,0,2.5,8.156">
                                        </path>
                                        <path class="ql-stroke ql-thin"
                                            d="M2.5,14.846a0.959,0.959,0,0,0,1.85-.109A0.7,0.7,0,0,0,3.75,14a0.688,0.688,0,0,0,.6-0.736,0.959,0.959,0,0,0-1.85-.109">
                                        </path>
                                    </svg></button><button type="button" class="ql-list" value="bullet"><svg
                                        viewBox="0 0 18 18">
                                        <line class="ql-stroke" x1="6" x2="15" y1="4"
                                            y2="4"></line>
                                        <line class="ql-stroke" x1="6" x2="15" y1="9"
                                            y2="9"></line>
                                        <line class="ql-stroke" x1="6" x2="15" y1="14"
                                            y2="14"></line>
                                        <line class="ql-stroke" x1="3" x2="3" y1="4"
                                            y2="4"></line>
                                        <line class="ql-stroke" x1="3" x2="3" y1="9"
                                            y2="9"></line>
                                        <line class="ql-stroke" x1="3" x2="3" y1="14"
                                            y2="14"></line>
                                    </svg></button></span><span class="ql-formats"><button type="button"
                                    class="ql-indent" value="-1"><svg viewBox="0 0 18 18">
                                        <line class="ql-stroke" x1="3" x2="15" y1="14"
                                            y2="14"></line>
                                        <line class="ql-stroke" x1="3" x2="15" y1="4"
                                            y2="4"></line>
                                        <line class="ql-stroke" x1="9" x2="15" y1="9"
                                            y2="9"></line>
                                        <polyline class="ql-stroke" points="5 7 5 11 3 9 5 7"></polyline>
                                    </svg></button><button type="button" class="ql-indent" value="+1"><svg
                                        viewBox="0 0 18 18">
                                        <line class="ql-stroke" x1="3" x2="15" y1="14"
                                            y2="14"></line>
                                        <line class="ql-stroke" x1="3" x2="15" y1="4"
                                            y2="4"></line>
                                        <line class="ql-stroke" x1="9" x2="15" y1="9"
                                            y2="9"></line>
                                        <polyline class="ql-fill ql-stroke" points="3 7 3 11 5 9 3 7"></polyline>
                                    </svg></button></span>
                            <span class="ql-formats">
                                <select class="ql-header">
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                    <option value="4"></option>
                                    <option value="5"></option>
                                    <option value="6"></option>
                                    <option selected="selected"></option>
                                </select>
                            </span>
                            <span class="ql-formats">
                                <select class="ql-align">
                                    <option selected="selected"></option>
                                    <option value="center"></option>
                                    <option value="right"></option>
                                    <option value="justify"></option>
                                </select>
                            </span>
                            <span class="ql-formats">
                                <select id="insert_var" class="form-select d-inline">
                                    <option selected="selected" disabled hidden selected>変数を挿入</option>
                                    <option value="candidate_name">候補者の名前</option>
                                    <option value="limit_date">締切日</option>
                                    <option value="interview_title">インタビュー名</option>
                                    <option value="interview_owner">インタビューオーナー名</option>
                                    <option value="company_name">会社名</option>
                                </select>
                            </span>
                        </div>
                        <div id="editor">

                        </div>
                        <input type="hidden" name="content" id="content">
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary rounded-pill" type="submit" id="save">保 存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <div class="modal fade modal-preview" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content rounded-5">
                <div class="modal-header">
                    <div></div>
                    <h5 class="modal-title text-center"></h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="body-header text-center">
                        <img src="{{ asset('/assets/img/success.jpg') }}" alt="success icon" style="margin-left: 44px;">
                    </div>
                    <div class="message-content">

                    </div>
                    <div class="body-footer mt-5">
                        <hr>
                        <p class="text-center">
                            この面接を完了したことを {recruiter_name} に知らせました。
                            <br><br>
                            <span class="text-success">このインタビューでは、従来のインタビューよりも排出量が 93% 削減されました。
                                対面インタビュー。</span>
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
                    <h5 class="modal-title text-center"></h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="message-content">

                    </div>
                    <div class="body-footer mt-4 text-center">
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary px-4 py-3rounded-pill"
                                data-bs-dismiss="modal">面接に行く</button>
                        </div>
                        <hr class="mb-4 mt-4">
                        <h6 class="fw-bold">始める前に 💡</h6>
                        <p>面接を完了するまでに十分な時間をとってください。 安定した高速インターネット接続上で、シークレット モードで最新バージョンの Google Chrome または Firefox
                            ブラウザを使用することをお勧めします。
                            リラックスして最高の自分を前面に出して、何度でも練習できます。
                            快適。
                        </p>
                        <h6 class="fw-bold">技術的な質問または問題がありますか?</h6>
                        <p>年中無休のサポート ポータルにアクセスするか、support@willo.video にメールでお問い合わせください。
                            <br><br>
                            このメールは、{interview_owner_name} に代わってお送りしました。
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
                    <h5 class="modal-title text-center"></h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="message-content">

                    </div>
                    <div class="body-footer mt-4 text-center">
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary px-4 py-3 rounded-pill"
                                data-bs-dismiss="modal">面接に行く</button>
                        </div>
                        <hr>
                        <p class="text-center mt-4">Willo は {recruiter_name} に代わってこのメールを送信しました。
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
                    <h5 class="modal-title text-center"></h5>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            var quill = new Quill('#editor', {
                theme: 'snow',
                placeholder: 'ここに書いてください。',
                formarts: ['cus'],
                modules: {
                    toolbar: {
                        container: '#toolbar',
                    },
                }
            });
            quill.on('text-change', function(delta, oldDelta, source) {
                if (source == 'api') {
                    console.log("An API call triggered this change.");
                } else if (source == 'user') {
                    let content = new String(quill.getContents().ops[0].insert);
                    if (content == '\n') {
                        $("#submit").removeClass("btn-primary").addClass("btn-secondary").attr("disabled",
                            "");
                        $("#content").val("");

                    } else {
                        $("#submit").addClass("btn-primary").removeClass("btn-secondary").removeAttr(
                            "disabled");
                        $("#content").val(quill.root.innerHTML);
                    }
                }
            });
            @if ($message->content)
                @php
                    $content = $message->content;
                    $preprocessedContent = str_replace("'", '\'', $content);
                    $preprocessedContent = str_replace('"', '\"', $preprocessedContent);
                @endphp
                quill.root.innerHTML = `{!! $message->content !!}`;
                $("#content").val(`{!! $preprocessedContent !!}`);
            @endif

            $("#save").click(function(e) {
                e.preventDefault();
                message_add();
            })

            function message_add() {
                let title = $("#title").val().trim();
                let type = $("#type").val().trim();
                let trigger = $("#trigger").val().trim();
                let content = $("#content").val().trim();
                let token = $("meta[name=csrf-token]").attr("content");
                if (title == "" || type == "" || trigger == "" || content == "") {
                    toastr.error('内容を正確に入力してください。');
                    return;
                }
                if (type == "sms") {
                    content = new String(quill.getContents().ops[0].insert);
                }

                let postData = {
                    _token: token,
                    title,
                    type,
                    trigger,
                    content,
                }
                // $.post(
                //     "{{ route('template.update', ['template' => $message->id]) }}",
                //     postData,
                //     function(data, status) {
                //         console.log(data, status);
                //         if (status == 'success') {
                //             window.location.href = "{{ route('template.index') }}";
                //         }
                //     }
                // )
                $.ajax({
                    url: "{{ route('template.update', ['template' => $message->id]) }}",
                    type: 'put',
                    data: postData,
                    success: function(response) {
                        location.href = "{{ route('template.index') }}";
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseJSON.message);
                    }
                });
            }

            $("#type").change(function(e) {
                if (e.target.value == "sms") {
                    $("#trigger option:nth-child(2)").hide();
                } else {
                    $("#trigger option:nth-child(2)").show();
                }
            })

            $("select#insert_var").change(function(e) {
                var selection = quill.getSelection(true);
                quill.insertText(selection.index, `{${e.target.value}}`);
                console.log()
            });

            $("#showModal").click(function() {
                const type = $("#type").val();
                const trigger = $("#trigger").val();
                if (type == "email" && trigger == "success") {
                    const myModal = new bootstrap.Modal(document.getElementById('successModal'), {});
                    $("#successModal .message-content").html(quill.root.innerHTML);
                    $("#successModal .modal-title").html($("#title").val());
                    myModal.show();
                } else if (type == "email" && trigger == "invite") {
                    const myModal = new bootstrap.Modal(document.getElementById('inviteModal'), {});
                    $("#inviteModal .message-content").html(quill.root.innerHTML);
                    $("#inviteModal .modal-title").html($("#title").val());
                    myModal.show();
                } else if (type == "email" && trigger == "reminder") {
                    const myModal = new bootstrap.Modal(document.getElementById('reminderModal'), {});
                    $("#reminderModal .message-content").html(quill.root.innerHTML);
                    $("#reminderModal .modal-title").html($("#title").val());
                    myModal.show();
                } else if (type == "sms") {
                    const myModal = new bootstrap.Modal(document.getElementById('smsModal'), {});
                    $("#smsModal .message-content").html(quill.root.innerHTML);
                    $("#reminderModal .modal-title").html($("#title").val());
                    myModal.show();
                }
            });
        })
    </script>
@endsection
