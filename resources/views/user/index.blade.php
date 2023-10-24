@extends('layouts.company')
@section('title', '招待')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('/a
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>ssets/css/top/profile.css') }}">
    <style>
        .display-none,
        .dis_role {
            display: none;
        }

        .display-none+.dis_role {
            display: block;
        }
        #invite {
            opacity: 1;
            right: 4px;
            top: 4px;
            z-index: 1000;
        }
    </style>
    <main>
        <section id="users">
            <div class="container m-1200 fs-14 mt-5 pt-5">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-between">
                        <span>Admin</span>
                        <span class="text-success">成長<i class="ms-2 fa-solid fa-check fs-18"></i></span>
                    </div>
                    <div class="col-md-6 offset-md-2 col-xl-4 offset-md-2 offset-xl-4">
                        <!-- input element -->
                        <div class="input-group mb-3 position-relative">
                            <input id="email" type="text" class="form-control py-2 rounded-5 "
                                placeholder="有効なメールアドレスを入力してください">
                            <button id="invite"
                                class="btn rounded-5 bg-secondary-subtle text-white py-1 position-absolute">
                                <i class="fa-regular fa-paper-plane text-white me-2 px-1"></i>招待</button>
                            <div class="invalid-feedback w-100">
                                有効なメールアドレスを入力してください
                            </div>
                        </div>

                        <!-- radio button -->
                        <div class="w-100 d-flex flex-wrap  ">
                            <div class="form-check w-auto me-3 pe-2">
                                <input class="form-check-input" type="radio" name="role" id="role_standard"
                                    value="standard" checked>
                                <label class="form-check-label" for="role_standard">
                                    スタンダード
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.33" height="13.33"
                                        viewBox="0 0 13.33 13.33">
                                        <g id="Icon_feather-info" data-name="Icon feather-info"
                                            transform="translate(-2.5 -2.5)">
                                            <path id="Path_93" data-name="Path 93"
                                                d="M15.33,9.165A6.165,6.165,0,1,1,9.165,3,6.165,6.165,0,0,1,15.33,9.165Z"
                                                fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1" />
                                            <path id="Path_94" data-name="Path 94" d="M18,20.466V18"
                                                transform="translate(-8.835 -8.835)" fill="none" stroke="#000"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_95" data-name="Path 95" d="M18,12h0"
                                                transform="translate(-8.835 -5.301)" fill="none" stroke="#000"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                        </g>
                                    </svg>
                                </label>
                            </div>
                            <div class="form-check w-auto">
                                <input class="form-check-input" type="radio" name="role" id="role_admin"
                                    value="admin">
                                <label class="form-check-label" for="role_admin">
                                    管理者
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.33" height="13.33"
                                        viewBox="0 0 13.33 13.33">
                                        <g id="Icon_feather-info" data-name="Icon feather-info"
                                            transform="translate(-2.5 -2.5)">
                                            <path id="Path_93" data-name="Path 93"
                                                d="M15.33,9.165A6.165,6.165,0,1,1,9.165,3,6.165,6.165,0,0,1,15.33,9.165Z"
                                                fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1" />
                                            <path id="Path_94" data-name="Path 94" d="M18,20.466V18"
                                                transform="translate(-8.835 -8.835)" fill="none" stroke="#000"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            <path id="Path_95" data-name="Path 95" d="M18,12h0"
                                                transform="translate(-8.835 -5.301)" fill="none" stroke="#000"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                        </g>
                                    </svg>
                                </label>
                            </div>
                        </div>
                        <!-- radio button -->
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <table class="table mt-4 text-center fw-normal">
                        <thead>
                            <tr class="table-sec fw-normal">
                                <th>フルネーム</th>
                                <th>メール</th>
                                <th>電話番号</th>
                                <th>役割</th>
                                <th>ステータス</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr class="bg-secondary">
                                <td class="border-start">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>オーナー</td>
                                <td>参加しました</td>
                                <td class="border-end" style="min-width: 115px;">
                                </td>
                            </tr>
                            @foreach ($display_users as $invited_user)
                                <tr class="bg-secondary" data-id="{{ $invited_user->id }}">
                                    <td class="border-start">{{ $invited_user->name }}</td>
                                    <td>{{ $invited_user->email }}</td>
                                    <td>{{ $invited_user->phone }}</td>
                                    <td><select class="display-none role_{{ $invited_user->id }} select_role display-none">
                                            <option value="admin">管理者</option>
                                            <option value="standard" selected>一般ユーザー</option>
                                        </select>
                                        <div class="dis_role">{{ $invited_user->role }}</div>
                                    </td>
                                    <td>{{ $invited_user->status }}</td>
                                    <td class="border-end">
                                        <a href="javascript:;" class="invited_user_edit han_btn"
                                            data-del-id="{{ $invited_user->id }}">
                                            <i class="fa fa-solid fa-edit me-3"></i>
                                        </a>
                                        <a href="javascript:;" class="invited_user_del han_btn"
                                            data-del-id="{{ $invited_user->id }}">
                                            <i class="fa fa-solid fa-trash"></i>
                                        </a>

                                        <a href="javascript:;" class="invited_user_ok display-none han_btn"
                                            data-del-id="{{ $invited_user->id }}">
                                            <i class="fa fa-solid fa-check me-3"></i>
                                        </a>
                                        <a href="javascript:;" class="invited_user_cancel display-none han_btn"
                                            data-del-id="{{ $invited_user->id }}">
                                            <i class="fa fa-solid fa-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>
    <script>
        $(document).ready(function() {
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            $("#email").keyup(function(e) {
                if (emailPattern.test(e.target.value.trim())) {
                    $("#invite").addClass("bg-primary").removeClass("bg-secondary-subtle").removeAttr(
                        "disabled");
                } else {
                    $("#invite").removeClass("bg-primary").addClass("bg-secondary-subtle").attr("disabled",
                        "");
                }
            });

            $("#invite").click(function() {
                var email = $("#email").val().trim();
                if (!emailPattern.test(email)) {
                    return;
                }
                var role = $("[name=role]:checked").val().trim();
                var token = $("meta[name=csrf-token]").attr("content");

                var postData = {
                    _token: token,
                    email,
                    role,
                }
                $.post(
                        "/user",
                        postData,
                        function(data, status) {
                            if (status == 'success') {
                                toastr.success('招待が成功しました。');
                                var save_data = data.data;
                                var role_text = role == "admin" ? "管理者" : "一般ユーザー";
                                var code = `<tr class="bg-secondary"  data-id="` + save_data.id + `">
                                <td class="border-start">` + save_data.name + `</td>
                                <td>` + email + `</td>
                                <td>` + save_data.phone + `</td>
                                <td>` + role_text + `<select class="display-none role_` + save_data.id + `"><option value="admin">管理者</option><option value="standard" selected="">一般ユーザー</option></select></td>
                                <td>参加しました</td>
                                <td class="border-end" style="width: 115px;">
                                    <a href="javascript:;" class="invited_user_edit han_btn" data-del-id="` + save_data
                                    .id + `">
                                        <i class="fa fa-solid fa-edit me-3"></i>
                                    </a>
                                    <a href="javascript:;" class="invited_user_del han_btn" data-del-id="` + save_data
                                    .id +
                                    `">
                                        <i class="fa fa-solid fa-trash"></i>
                                    </a>
                                    
                                    <a href="javascript:;" class="display-none invited_user_ok han_btn" data-del-id="` +
                                    save_data.id +
                                    `">
                                        <i class="fa fa-solid fa-check me-3"></i>
                                    </a>
                                    <a href="javascript:;" class="display-none invited_user_cancel han_btn" data-del-id="` +
                                    save_data
                                    .id + `">
                                        <i class="fa fa-solid fa-close"></i>
                                    </a>
                                </td>
                            </tr>`;

                                $("#tbody").append(code);
                                $("#email").val("");
                                handlers();
                            };
                        }
                    ).done(function(data) {

                    })
                    .fail(function(xhr, status, error) {
                        toastr.error('すでに招待されているユーザーです。');
                    });
            });

            function del(id) {
                $.ajax({
                    url: '/user/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $("meta[name=csrf-token]").attr("content"),
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON.message == "Unauthenticated") {
                            window.location.reload();
                        }
toastr.error(xhr.responseJSON.message);
                    }
                });
            }

            function change(id) {
                var change_role = $(".role_" + id).val();
                $.ajax({
                    url: '/user/' + id,
                    type: 'PUT',
                    data: {
                        _token: $("meta[name=csrf-token]").attr("content"),
                        role: change_role,
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON.message == "Unauthenticated") {
                            window.location.reload();
                        }
toastr.error(xhr.responseJSON.message);
                    }
                });
            }

            function handlers() {
                $(".invited_user_edit, .invited_user_cancel").click(function(e) {
                    $(e.currentTarget).parents("tr").find(".han_btn").toggleClass("display-none");
                    $(e.currentTarget).parents("tr").find(".dis_role, select").toggleClass("display-none");
                });

                $(".invited_user_ok").click(function(e) {
                    var id = $(e.currentTarget).attr("data-del-id");
                    change(id);
                });

                $(".invited_user_del").click(function(e) {
                    var id = $(e.currentTarget).attr("data-del-id");
                    del(id);
                });

            }

            handlers();

        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
