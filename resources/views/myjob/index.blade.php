@extends('layouts.company')
@section('title', 'インタビュー一覧')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/collection/style.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <style>
        .cus-option input[type=checkbox] {
            min-width: 24px !important;
        }
        td{
            border-collapse: collapse;
        }
        th {
            border-color: inherit;
        }
    </style>

    <main style="min-height: calc(100vh - 251px);">
        <section id="sec_condistions">
            <div class="container px-5">
                <div class="row flex-column flex-md-row justify-content-between gap-4 flex-wrap flex-xl-nowrap">
                    <div class="col-lg-2">
                        <input class="form-control rounded-5 fs-14 h-100" type="text" placeholder="タイトルで検索する"
                            id="search_title">
                    </div>
                    <div class="col-lg-2 position-relative">
                        <input name="" id="search_company" class="form-select select2 w-100 rounded-pill"
                            placeholder="会社名による検索">
                        <div class="select-cus position-absolute card p-3 shadow rounded-4">
                            <div class="cus-search">
                                <input type="text" name="search" class="form-control select-search" placeholder="検索...">
                            </div>
                            <div class="cus-options py-2">
                                <div class="cus-notfound"><span>見つかりません</span></div>
                                @foreach ($companies as $item)
                                    <div class="cus-option"><input type="checkbox" name="company_name"
                                            value="{{ $item->id }}" id="{{ $item->id }}"><label
                                            for="{{ $item->id }}"><span>{{ $item->name }}</span></label></div>
                                @endforeach
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-primary rounded-2 ok" data-for="company">申し込み</button>
                                <button class="btn btn-outline-primary ms-3 rounded-2 cancel" data-for="company">リセット
                                </button>
                            </div>
                            <div class="cus-bg position-fixed">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 position-relative">
                        <input name="" id="search_owner" class="form-select select2 w-100 rounded-pill"
                            placeholder="所有者名による検索">
                        <div class="select-cus position-absolute card p-3 shadow rounded-4">
                            <div class="cus-search">
                                <input type="text" name="search" class="form-control select-search" placeholder="検索...">
                            </div>
                            <div class="cus-options py-2">
                                <div class="cus-notfound"><span>見つかりません</span></div>
                                <div class="cus-option"><input type="checkbox" name="owner" value="{{ $user->id }}"
                                        id="admin"><label for="admin"><span>{{ $user->name }}</span></label></div>
                                @foreach ($owners as $item)
                                    <div class="cus-option"><input type="checkbox" name="owner"
                                            value="{{ $item->user_id }}" id="{{ $item->id }}"><label
                                            for="{{ $item->id }}"><span>{{ $item->name }}</span></label></div>
                                @endforeach
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-primary rounded-2 ok" data-for="owner">申し込み</button>
                                <button class="btn btn-outline-primary ms-3 rounded-2 cancel" data-for="owner">リセット
                                </button>
                            </div>
                            <div class="cus-bg position-fixed">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 position-relative">
                        <input name="" id="search_status" class="form-select select2 w-100 rounded-pill"
                            placeholder="ステータスによる検索">
                        <div class="select-cus position-absolute card p-3 shadow rounded-4">
                            <div class="cus-search">
                                <input type="text" name="search" class="form-control select-search" placeholder="検索...">
                            </div>
                            <div class="cus-options py-2">
                                <div class="cus-notfound"><span>見つかりません</span></div>
                                <div class="cus-option"><input type="checkbox" name="status" value="draft"
                                        id="draft"><label for="draft"><span>草案</span></label></div>
                                <div class="cus-option"><input type="checkbox" name="status" value="live"
                                        id="live"><label for="live"><span>募集中</span></label></div>
                                <div class="cus-option"><input type="checkbox" name="status" value="finish"
                                        id="finish"><label for="finish"><span>募集完了</span></label></div>
                                <div class="cus-option"><input type="checkbox" name="status" value="closed"
                                        id="closed"><label for="closed"><span>クローズド</span></label></div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-primary rounded-2 ok" data-for="status">申し込み</button>
                                <button class="btn btn-outline-primary ms-3 rounded-2 cancel" data-for="status">リセット
                                </button>
                            </div>
                            <div class="cus-bg position-fixed">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <a class="btn text-center px-4 px-xl-5 rounded-5 text-white fw-bold" id="job_add"
                            href="{{ route('myjob.create') }}">
                            <i class="fa-regular fa-plus me-2"></i> 作成
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section id="sec_jobs_table" class=" px-2 px-md-0">
            <div class="container pt-4">
                <table class="table table-bordered mt-3 mt-xl-5">
                    <thead>
                        <tr class="border-top-0">
                            <th class="border text-center border-2 fw-bold">募集項目名</th>
                            <th class="py-2 text-center border-2">所有者名</th>
                            <th class="py-2 text-center border-2">募集終了日</th>
                            <th class="py-2 text-center border-2">現在の応募者数</th>
                            <th class="py-2 text-center border-2">募集中/募集終了</th>
                            <th class=""></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($jobs as $item)
                            <tr>
                                <td>
                                    <div>{{ $item['title'] }}</div>
                                    <div>{{ $item['company_name'] }}</div>
                                </td>
                                <td>
                                    <div>{{ $item['user_name'] }}</div>
                                    <div>{{ $item['email'] }}</div>
                                </td>
                                <td>
                                    @if (!is_null($item['limit_date']))
                                        {{ $item['limit_date'] }}
                                    @endif
                                </td>
                                <td><a
                                        href="{{ route('myjob.show', ['myjob' => $item['id']]) }}">{{ $item['responses_count'] }}</a>
                                </td>
                                <td>
                                    @if ($item['status'] == 'draft')
                                        <div class="cs-state bg-secondary-subtle text-black">草案</div>
                                    @endif
                                    @if ($item['status'] == 'live')
                                        <div class="cs-state">募集中</div>
                                    @endif
                                    @if ($item['status'] == 'finish')
                                        <div class="cs-state bg-red-subscribe text-black">募集終了</div>
                                    @endif
                                    @if ($item['status'] == 'closed')
                                        <div class="cs-state bg-warning-subtle text-black">クローズド</div>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="@if ($item['status'] == 'live') {{ route('getJobDetail', ['url' => $item['url']]) }}@else javascript:; @endif"
                                        @if ($item['status'] != 'live') style="visibility: hidden; cursor: pointer;" @endif
                                        class="me-3">
                                        <i class="fa-solid fa-link"></i>
                                    </a>
                                    <a href="{{ route('myjob.edit', ['myjob' => $item['id']]) }}" class="me-3">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="me-3" data-id="{{ $item['id'] }}">
                                        <i class="fa-solid fa-copy"></i>
                                    </a>
                                    <a href="javascript:;" data-id="{{ $item['id'] }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <script>
        $('table').DataTable({
            ordering: true, // Enable sorting
            searching: false, // Disable searching
            paging: false, // Disable pagination
            info: false, // Disable information display
            columnDefs: [{
                    targets: -1,
                    orderable: false
                } // -1 represents the last column
            ],
        });

        function copy() {
            let doms = document.getElementsByClassName("fa-copy");
            let len = doms.length;
            for (let i = 0; i < len; i++) {
                doms[i].onclick = copy_set;
            }
        }

        function copy_set(e) {

            const jobId = $(e.target.parentElement).attr('data-id');
            $.ajax({
                url: '/myjob/' + jobId + "/copy",
                type: 'get',
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

        function del() {
            let doms = document.getElementsByClassName("fa-trash");
            let len = doms.length;
            for (let i = 0; i < len; i++) {
                doms[i].onclick = delete_set;
            }
        }

        function delete_set(e) {
            const jobId = $(e.target.parentElement).attr('data-id');
            $.ajax({
                url: '/myjob/' + jobId,
                type: 'Delete',
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
        copy();
        del()

        $(".select2").focus(function(e) {
            $(".select2 + .select-cus").hide();
            $(this).next().show();
            $(this).blur();
            $(".cus-bg").show();
        })

        // $(".select-cus .cus-option").click(function(e) {
        //     $(this).parent().parent().hide();
        //     $(this).parent().parent().prev().val(e.target.textContent);
        //     search_job();
        // })
        let companies = [];
        let owners = [];
        let statuses = [];

        $(".select-cus .ok").click(function(e) {
            $(this).parent().parent().hide();
            const type = $(this).attr('data-for');
            if (type === "company") {
                companies = [];
                $(this).parent().parent().find('input:checked').each(function(ele) {
                    companies.push($(this).val());
                });
                if (companies.length) $(this).parent().parent().parent().find('input.select2').val(companies
                    .length + " 件が選択");
                else $(this).parent().parent().parent().find('input.select2').val("0 件が選択");
            } else if (type === "owner") {
                owners = [];
                $(this).parent().parent().find('input:checked').each(function(ele) {
                    owners.push($(this).val());
                });
                if (owners.length) $(this).parent().parent().parent().find('input.select2').val(owners.length +
                    " 件が選択");
                else $(this).parent().parent().parent().find('input.select2').val("0 件が選択");
            } else if (type === "status") {
                statuses = [];
                $(this).parent().parent().find('input:checked').each(function(ele) {
                    statuses.push($(this).val());
                });
                if (statuses.length) $(this).parent().parent().parent().find('input.select2').val(statuses.length +
                    " 件が選択");
                else $(this).parent().parent().parent().find('input.select2').val("0 件が選択");
            }
            search_job();
        })

        $(".select-cus .cancel").click(function(e) {
            $(this).parent().parent().hide();
            $(this).parent().parent().prev().val("");
            const type = $(this).attr('data-for');
            $(this).parent().parent().find('input:checked').each(function(ele) {
                $(this).prop("checked", false);
            });
            switch (type) {
                case "company":
                    companies = [];
                    break;
                case "owner":
                    owners = [];
                    break;
                case "status":
                    statuses = [];
                    break;
            }
            search_job();
        })

        $(".cus-bg").click(function(e) {
            $(this).parent().hide();
        })

        $(".select-search").keyup(function(e) {

            let listDom = e.target.parentElement.nextElementSibling.getElementsByTagName("DIV");
            let val = e.target.value.trim();
            let listData = [];
            let len = listDom.length;
            let nooptionsdom = e.target.parentElement.nextElementSibling.firstElementChild;
            nooptionsdom.style.display = "block"

            for (let i = 1; i < len; i++) {
                if (val.length == 0) {
                    listDom[i].style.display = "block";
                    nooptionsdom.style.display = "none"
                } else {
                    if (listDom[i].textContent.indexOf(val) != -1) {
                        listDom[i].style.display = "block";
                        nooptionsdom.style.display = "none"
                    } else {
                        listDom[i].style.display = "none";
                    }
                }
            }

        });

        $("#search_title").keyup(function() {
            search_job();
        })

        function search_job() {
            const title = $("#search_title").val().trim();
            $.ajax({
                url: '{{ route('myjob.search') }}',
                type: 'POST',
                data: {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    title,
                    companies,
                    owners,
                    statuses,
                },
                success: function(response) {
                    let dis = "";
                    response.forEach(ele => {
                        let status = "";
                        let jobDetail =
                            `<a href="javascript:;" style="visibility: hidden; cursor: pointer;" class="me-3"><i class="fa-solid fa-link"></i></a>`;
                        switch (ele.status) {
                            case 'draft':
                                status =
                                    `<div class="cs-state bg-secondary-subtle text-black">草案</div>`;
                                break;
                            case 'live':
                                status = `<div class="cs-state">募集中</div>`;
                                jobDetail =
                                    `<a href="getJobDetail/${ele.url}" class="me-3"><i class="fa-solid fa-link"></i></a>`;
                                break;
                            case 'finish':
                                status = `<div class="cs-state bg-red-subscribe text-black">募集終了</div>`;
                                break;
                            case 'closed':
                                status =
                                    `<div class="cs-state bg-warning-subtle text-black">クローズド</div>`;
                                break;
                        }
                        let limit_date = "";
                        if (ele.limit_date != null) {
                            limit_date = ele.limit_date;
                        }
                        dis += `
                            <tr>
                                <td>
                                    <div>${ele.title}</div>
                                    <div>${ele.company_name}</div>
                                </td>
                                <td>
                                    <div>${ele.user_name}</div>
                                    <div>${ele.email}</div>
                                </td>
                                <td>
                                    ${limit_date}
                                </td>
                                <td><a href="/myjob/${ele.id}">${ele.responses_count}</a>
                                </td>
                                <td>${status}
                                </td>
                                <td class="text-right">
                                    ${jobDetail}
                                    <a href="/myjob/${ele.id}/edit" class="me-3">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <a href="javascript:;" class="me-3" data-id="${ele.id}">
                                        <i class="fa-solid fa-copy"></i>
                                    </a>
                                    <a href="javascript:;" data-id="${ele.id}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        `
                    });
                    $("#tbody").html(dis);
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
@endsection
