@extends('layouts.company')

@section('title', '応募者一覧')

@section('content')
<link rel="stylesheet" href="{{ asset('/assets/css/member-list/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Select2 CSS -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
    .select2 {
        /* width: auto !important; */
        min-width: 200px;
        /* force fluid responsive */
    }

    .select2-container .select2-selection--single {
        height: 40px;
        border-radius: 20px;
        position: relative;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
    }

    .select2-container .select2-selection--single .select2-selection__arrow {
        top: 8px;
        right: 8px;
    }

    .select2-container .select2-selection--single .select2-container--default .select2-results>.select2-results__options {
        -webkit-overflow-scrolling: touch;
    }

    .select2-button {
        /* color: red; */
        background-color: #337ab7;
        padding: 5px 10px;
        cursor: pointer;
    }

    .select2-dropdown {
        /* width: 200px!important; */
        /* border-radius: 1rem; */
        /* background-color: ; */
    }


    span a {
        font-size: 12px !important;
    }

    .select-cus button {
        font-size: 13px !important;
    }

    .cus-option:hover {
        background-color: #f2f2f2;
    }

    .cus-option input[type=checkbox] {
        min-width: 24px !important;
    }
</style>

<main class="pt-5">
    <div class="container px-4">
        <div class="row mb-3">
            <div class="col-auto">
                <input type="text" class="form-control rounded-pill" placeholder="応募者氏名 " name="" id="search_name" value="">
            </div>
        </div>
        <div class="row justify-content-between align-items-center mb-5">
            <div class="col-lg-2 mb-3 mb-lg-0 position-relative">
                <input name="" id="search_company" class="form-select select2 w-100 rounded-pill" placeholder="募集した会社">
                <div class="select-cus position-absolute card p-3 shadow rounded-4">
                    <div class="cus-search">
                        <input type="text" name="search" class="form-control select-search" placeholder="検索...">
                    </div>
                    <div class="cus-options py-2">
                        <div class="cus-notfound"><span>見つかりません</span></div>
                        @foreach ($companies as $item)
                        <div class="cus-option"><input type="checkbox" name="company_name" value="{{ $item->id }}" id="{{ $item->id }}"><label for="{{ $item->id }}"><span>{{ $item->name }}</span></label></div>
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
            <div class="col-lg-2 mb-3 mb-lg-0 position-relative">
                <input name="" id="search_job" class="form-select select2 w-100 rounded-pill" placeholder="募集のタイトル">
                <div class="select-cus position-absolute card p-3 shadow rounded-4">
                    <div class="cus-search">
                        <input type="text" name="search" class="form-control select-search" placeholder="検索...">
                    </div>
                    <div class="cus-options py-2">
                        <div class="cus-notfound"><span>見つかりません</span></div>
                        @foreach ($jobs as $item)
                        <div class="cus-option"><input type="checkbox" name="company_name" value="{{ $item->id }}" id="company_{{ $item->id }}"><label for="company_{{ $item->id }}"><span>{{ $item->title }}</span></label></div>
                        @endforeach
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-primary rounded-2 ok" data-for="job">申し込み</button>
                        <button class="btn btn-outline-primary ms-3 rounded-2 cancel" data-for="job">リセット
                        </button>
                    </div>
                    <div class="cus-bg position-fixed">

                    </div>
                </div>
            </div>
            <div class="col-lg-2 mb-3 mb-lg-0 position-relative">
                <input name="" id="search_owner" class="form-select select2 w-100 rounded-pill" placeholder="応募先">
                <div class="select-cus position-absolute card p-3 shadow rounded-4">
                    <div class="cus-search">
                        <input type="text" name="search" class="form-control select-search" placeholder="検索...">
                    </div>
                    <div class="cus-options py-2">
                        <div class="cus-notfound"><span>見つかりません</span></div>
                        <div class="cus-option"><input type="checkbox" name="owner" value="{{ $user->id }}" id="user_{{ $user->id }}"><label for="user_{{ $user->id }}"><span>{{ $user->name }}</span></label></div>
                        @foreach ($owners as $item)
                        <div class="cus-option"><input type="checkbox" name="owner" value="{{ $item->id }}" id="user_{{ $item->id }}"><label for="user_{{ $item->id }}"><span>{{ $item->name }}</span></label></div>
                        @endforeach
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-primary rounded-2 ok" data-for="owner">申し込み</button>
                        <button class="btn btn-outline-primary ms-3 rounded-2 cancel" data-for="owner">リセット</button>
                    </div>
                    <div class="cus-bg position-fixed">

                    </div>
                </div>

            </div>
            <div class="col-lg-2 mb-3 mb-lg-0 position-relative">
                <input name="" id="search_status" class="form-select rounded-pill select2" data-no="4" placeholder="現時点の評価">
                <div class="select-cus position-absolute card p-3 shadow rounded-4">
                    <div class="cus-search">
                        <input type="text" name="search-company" class="form-control select-search" placeholder="検索…">
                    </div>
                    <div class="cus-options py-2">
                        <div class="cus-notfound"><span>見つかりません</span></div>
                        <div class="cus-option"><input type="checkbox" name="status" value="responsed" id="responsed"><label for="responsed"><span>レビュー中</span></label></div>
                        <div class="cus-option"><input type="checkbox" name="status" value="accepted" id="accepted"><label for="accepted"><span>承認済み</span></label></div>
                        <div class="cus-option"><input type="checkbox" name="status" value="rejected" id="rejected"><label for="rejected"><span>却下</span></label></div>
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
            <div class="col-lg-2 mb-3 mb-lg-0 position-relative">
                <input name="" id="search_rate" class="form-select rounded-pill select2" data-no="5" placeholder="評価点">
                <div class="select-cus position-absolute card p-3 shadow rounded-4">
                    <div class="cus-search">
                        <input type="text" name="search-compayny" class="form-control select-search" placeholder="検索...">
                    </div>
                    <div class="cus-options py-2">
                        <div class="cus-notfound"><span>見つかりません</span></div>
                        <div class="cus-option"><input type="checkbox" name="rate_5" value="5" id="rate_5"><label style="width: 150px;" for="rate_5"><span>5</span></label></div>
                        <div class="cus-option"><input type="checkbox" name="rate_4" value="4" id="rate_4"><label style="width: 150px;" for="rate_4"><span>4</span></label></div>
                        <div class="cus-option"><input type="checkbox" name="rate_3" value="3" id="rate_3"><label style="width: 150px;" for="rate_3"><span>3</span></label></div>
                        <div class="cus-option"><input type="checkbox" name="rate_2" value="2" id="rate_2"><label style="width: 150px;" for="rate_2"><span>2</span></label></div>
                        <div class="cus-option"><input type="checkbox" name="rate_1" value="1" id="rate_1"><label style="width: 150px;" for="rate_1"><span>1</span></label></div>
                        <div class="cus-option"><input type="checkbox" name="rate_0" value="0" id="rate_0"><label style="width: 150px;" for="rate_0"><span>0</span></label></div>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-primary rounded-2 ok" data-for="rate">申し込み</button>
                        <button class="btn btn-outline-primary ms-3 rounded-2 cancel" data-for="rate">リセット
                        </button>
                    </div>
                    <div class="cus-bg position-fixed">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-auto d-flex align-items-center gap-3 mb-4 flex-wrap">
                <p class="m-0"><span class="filter_count">0</span>個のフィルターが選択されました</p>|
                <p class="m-0" id="filter_clear"><a href="javascript:;">すべてクリア</a></p>
            </div>
            <div class="col-12">
                <div class="table-responsive border rounded" style="min-height: 500px; overflow-y: auto;">
                    <table class="table m-0" style="min-width: 992px; overflow-x: auto; margin: 0px !important;">
                        <thead>
                            <tr class="bg-secondary-grey">
                                <th class="py-2 text-center border-2">名前</th>
                                <th class="py-2 text-center border-2">募集タイトル</th>
                                <th class="py-2 text-center border-2">提出日</th>
                                <th class="py-2 text-center border-2">ステータス</th>
                                <th class="py-2 text-center border-2">評価点</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($candidates as $item)
                            <tr class="align-middle">
                                <td class="px-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="col-auto">
                                            <img src="{{ asset('/assets/img/avatar/person.png') }}" style="max-width: 50px;" alt="">
                                        </div>
                                        <div class="col-auto">
                                            <a class="m-0" href="{{ route('myjob.person', ['myjob' => $item->job_id, 'candidate_id' => $item->id]) }}">{{ $item->name }}</a><br>
                                            <a class="text-secondary" href="{{ route('myjob.person', ['myjob' => $item->job->id, 'candidate_id' => $item->id]) }}">{{ $item->email }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <p class="m-0">{{ $item->job_title }}</p>
                                        <p class="m-0 text-secondary">{{ $item->company_name }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <p class="m-0">
                                            @if ($item->response_at != null)
                                            {{ $item->response_at }}
                                            @endif
                                        </p>
                                        <p class="m-0">
                                            @if (date('a', strtotime($item->time)) == 'pm')
                                            午後
                                            @else
                                            午前
                                            @endif
                                            {{ date('h:i', strtotime($item->time)) }}
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <h5>
                                        @if ($item->status == 'responsed')
                                        <span class="badge rounded-pill bg-warning text-dark bg-light-warning py-1 px-3">レビュー中</span>
                                        @endif
                                        @if ($item->status == 'accepted')
                                        <span class="badge rounded-pill text-dark bg-light-success py-1 px-3">承認済み</span>
                                        @endif
                                        @if ($item->status == 'rejected')
                                        <span class="badge rounded-pill text-dark bg-danger-subtle py-1 px-3">却下</span>
                                        @endif
                                        </span>
                                    </h5>
                                </td>
                                <td>
                                    <div class="">
                                        @for ($i = 1; $i <= 5; $i++) @if ($item->review >= $i)
                                            <i class="fa-solid fa-star text-warning" data-val="{{ $i }}"></i>
                                            @else
                                            <i class="fa-regular fa-star text-warning" data-val="{{ $i }}"></i>
                                            @endif
                                            @endfor
                                            <span>({{ $item->review }})</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $('table').DataTable({
        ordering: true, 
        searching: false,
        paging: false,
        info: false,
        language: {
            infoEmpty: 'データはありません。',
        }
    });
    $(".select2").focus(function(e) {
        $(".select2 + .select-cus").hide();
        $(this).next().show();
        $(this).blur();
        $(".cus-bg").show();
    })
    let companies = [];
    let owners = [];
    let statuses = [];
    let jobs = [];
    let rates = [];

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
        } else if (type === "job") {
            jobs = [];
            $(this).parent().parent().find('input:checked').each(function(ele) {
                jobs.push($(this).val());
            });
            if (jobs.length) $(this).parent().parent().parent().find('input.select2').val(jobs.length +
                " 件が選択");
            else $(this).parent().parent().parent().find('input.select2').val("0 件が選択");
        } else if (type === "rate") {
            rates = [];
            $(this).parent().parent().find('input:checked').each(function(ele) {
                rates.push($(this).val());
            });
            if (rates.length) $(this).parent().parent().parent().find('input.select2').val(rates.length +
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
            case "rate":
                rates = [];
                break;
            case "job":
                jobs = [];
                break;
        }
        search_job();
    })

    $(".cus-bg").click(function(e) {
        $(this).parent().hide();
    })

    $(".select-search").keyup(function(e) {

        let listDom = e.target.parentElement.nextElementSibling.getElementsByTagName("div");
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

    function search_job() {
        let filter_count = 0;
        const name = $("#search_name").val().trim();
        const company = $("#search_company").val().trim();
        const job = $("#search_job").val().trim();
        const owner = $("#search_owner").val().trim();
        const rate = $("#search_rate").val().trim();
        let status = $("#search_status").val().trim();
        if (name != "") {
            filter_count++;
        }
        if (company != "") {
            filter_count++;
        }
        if (job != "") {
            filter_count++;
        }
        if (owner != "") {
            filter_count++;
        }
        if (rate != "") {
            filter_count++;
        }
        if (status != "") {
            filter_count++;
        }

        $(".filter_count").html(filter_count);
        $.ajax({
            url: '/member/search',
            type: 'POST',
            data: {
                _token: $("meta[name=csrf-token]").attr("content"),
                name,
                companies,
                jobs,
                owners,
                statuses,
                rates,
            },
            success: function(response) {
                let dis = "";
                response.forEach(ele => {
                    let status = "";
                    switch (ele.status) {
                        case 'responsed':
                            status =
                                `<span class="badge rounded-pill bg-warning text-dark bg-light-warning py-1 px-3">レビュー中</span>`;
                            break;
                        case 'accepted':
                            status =
                                `<span class="badge rounded-pill text-dark  bg-light-success py-1 px-3">承認済み</span>`;
                            break;
                        case 'rejected':
                            status =
                                `<span class="badge rounded-pill text-dark bg-danger-subtle py-1 px-3">却下</span>`;
                            break;
                    }
                    let rate = "";
                    let review = Number(ele.review) || 0;
                    for (let i = 1; i <= 5; i++) {
                        if (i <= ele.review) {
                            rate += `<i class="fa-solid fa-star text-warning"></i>`;
                        } else {
                            rate += `<i class="fa-regular fa-star text-warning"></i>`;
                        }
                    }
                    const now = new Date();
                    const options = {
                        hour: 'numeric',
                        minute: 'numeric',
                        second: 'numeric',
                        hour12: true
                    };
                    const formattedTime = now.toLocaleTimeString('ja-JP', options);
                    dis += `
                        <tr class="align-middle">
                            <td class="px-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="col-auto">
                                        <img src="{{ asset('/assets/img/avatar/person.png') }}"
                                            style="max-width: 50px;" alt="">
                                    </div>
                                    <div class="col-auto">
                                        <a class="m-0"
                                            href="/myjob/${ele.job_id}/${ele.id}/edit">${ele.name}</a><br>
                                        <a class="text-secondary" href="/myjob/${ele.job_id}/${ele.id}/edit">${ele.email}</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <p class="m-0">${ele.job_title}</p>
                                    <p class="m-0 text-secondary">${ele.company_name}</p>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <p class="m-0">
                                        ${ele.response_at}
                                    </p>
                                    <p class="m-0">
                                        ${formattedTime}
                                    </p>
                                </div>
                            </td>
                            <td>
                                <h5>
                                    ${status}
                                </h5>
                            </td>
                            <td>
                                <div class="">
                                ${rate}
                                    <span>(${ele.review})</span>
                                </div>
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

    $("#filter_clear").click(function() {
        window.location.reload();
    });

    $("#search_name").keyup(function() {
        search_job();
    })
</script>
@endsection