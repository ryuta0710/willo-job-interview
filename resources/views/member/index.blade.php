@extends('layouts.company')

@section('content')
<link rel="stylesheet" href="{{ asset('/assets/css/member-list/index.css') }}">

<!-- Select2 CSS -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
    .select2 {
        width: 100% !important;
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
</style>

<main class="pt-5">
    <div class="container px-4">
        <div class="row mb-3">
            <div class="col-auto">
                <input type="text" class="form-control rounded-pill" placeholder="タイトルで検索する" name="" id="" value="">
            </div>
        </div>
        <div class="row justify-content-between align-items-center mb-5">
            <div class="col-lg-2 mb-3 mb-lg-0">
                <button id="open-dropdown1" class="btn btn-primary p-2 select2-hidden-accessible">検索</button>
                <select name="" id="select1" class="form-select rounded-pill select2" data-no="1">
                    <option value="1">キリハレ株式会社</option>
                    <option value="button">button</option>
                </select>
                <!-- <div class="select2-buttons">
                    <button class="btn btn-primary" id="button1">Button 1</button>
                    <button class="btn btn-secondary" id="button2">Button 2</button>
                </div> -->
                <!-- <button id="open-dropdown2" class="btn btn-primary p-2 sselect2-hidden-accessible">リセット</button> -->
            </div>
            <div class="col-lg-2 mb-3 mb-lg-0">
                <select name="" id="select2" class="form-select rounded-pill select2" data-no="2">
                    <option value="">技術者募集</option>
                </select>
            </div>
            <div class="col-lg-2 mb-3 mb-lg-0">
                <select name="" id="select3" class="form-select rounded-pill select2" data-no="3">
                    <option value="">オーナー</option>
                </select>
            </div>
            <div class="col-lg-2 mb-3 mb-lg-0">
                <select name="" id="select4" class="form-select rounded-pill select2" data-no="4">
                    <!-- <option value="">ステータス</option> -->
                    <option value="">レビューする</option>
                </select>
            </div>
            <div class="col-lg-2 mb-3 mb-lg-0">
                <select name="" id="select5" class="form-select rounded-pill" data-no="5">
                    <option value="">評価</option>
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
                    <option value="">5</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-auto d-flex align-items-center gap-3 mb-4 flex-wrap">
                <p class="m-0">0 個のフィルターが選択されました</p>|
                <p class="m-0">すべてクリア</p>
            </div>
            <div class="col-12">
                <div class="table-responsive border rounded" style="min-height: 500px; overflow-y: auto;">
                    <table class="table" style="min-width: 992px; overflow-x: auto;">
                        <thead>
                            <tr class="bg-secondary-grey">
                                <th class="py-4 text-center">名前</th>
                                <th class="py-4">インタビュ-</th>
                                <th class="py-4">理出済み</th>
                                <th class="py-4">スターテス</th>
                                <th class="py-4">評価</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2 justify-content-center">
                                        <div class="col-auto">
                                            <img src="./assets/img/avatar/01.png" alt="" style="width: 40px; height: 40px;">
                                        </div>
                                        <div class="col-auto">
                                            <p class="m-0">募集項目名</p>
                                            <a href="mailto:abcd1234@gmail.com">abcd1234@gmail.com</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <p class="m-0">技術者募集</p>
                                        <p class="m-0">キリハレ株式会社</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <p class="m-0">2023/07/20</p>
                                        <p class="m-0">午後2時8分</p>
                                    </div>
                                </td>
                                <td>
                                    <h5><span class="badge rounded-pill bg-warning text-dark bg-light-warning py-1 px-3">レビューする</span>
                                    </h5>
                                </td>
                                <td>
                                    <div class="">
                                        <i class="fa fa-solid fa-star text-warning"></i>
                                        <i class="fa fa-solid fa-star text-warning"></i>
                                        <i class="fa fa-solid fa-star text-warning"></i>
                                        <i class="fa fa-solid fa-star text-warning"></i>
                                        <i class="fa fa-solid fa-star text-warning"></i>
                                        <span>(5.0)</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2 justify-content-center">
                                        <div class="col-auto">
                                            <img src="./assets/img/avatar/01.png" alt="" style="width: 40px; height: 40px;">
                                        </div>
                                        <div class="col-auto">
                                            <p class="m-0">募集項目名</p>
                                            <a href="mailto:abcd1234@gmail.com">abcd1234@gmail.com</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <p class="m-0">技術者募集</p>
                                        <p class="m-0">キリハレ株式会社</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <p class="m-0">2023/07/20</p>
                                        <p class="m-0">午後2時8分</p>
                                    </div>
                                </td>
                                <td>
                                    <h5><span class="badge rounded-pill bg-warning text-dark bg-light-warning py-1 px-3">レビューする</span>
                                    </h5>
                                </td>
                                <td>
                                    <div class="">
                                        <i class="fa fa-solid fa-star text-warning"></i>
                                        <i class="fa fa-solid fa-star text-warning"></i>
                                        <i class="fa fa-solid fa-star text-warning"></i>
                                        <i class="fa fa-solid fa-star text-warning"></i>
                                        <i class="fa fa-solid fa-star text-warning"></i>
                                        <span>(5.0)</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            templateResult: addButtonsToOptions,
            placeholder: "asdfas"
        });

        function addButtonsToOptions(option) {
            if (!option.id) {
                return option.text;
            }

            var $option = $('<span></span>');
            $option.text(option.text);

            if (option.element) {
                $option.addClass($(option.element).attr('class'));
            }
            if (option.id === 'button') {
                $option = $('<span><a href="./" class="btn btn-primary ms-1">確認</a><a href="" class="btn text-black border border-outline-primary ms-1 bg-hover-white text-hover-white">キャンセル</a></span>');
                // $option.
                $option.on('click', function(e) {
                    e.preventDefault()
                    console.log(e)
                    // alert("sadaf")
                    // // Perform action for Option 3 button
                    if ($('#select1').val() !== 'button') {
                        // $('#select1').val('button').trigger('1');
                        // let doms = document.getElementsByClassName("select2-results");
                        // doms.foreach(function(dom) {
                        //     dom.remove();
                        // })
                        // console.log(doms)
                    }
                });
            }

            return $option;
        }
    });
    $(".select2").change(function(e) {
        if ($(e.target).val() == "button") {
            $(e.target).val("1");
            let doms = document.getElementsByClassName("select2-container");
            console.log(doms)
            let len = doms.length;
            for(let i=0; i < len; i++){
                doms[i].remove();
            }
            // doms.map(function(dom) {
            //     dom.remove();
            // })
            // document.getElementsByClassName("select2-container")[0].remove();
            // document.getElementsByClassName("select2-container")[0].remove();
        }
    })
</script>
@endsection