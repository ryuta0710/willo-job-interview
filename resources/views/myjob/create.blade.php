@extends('layouts.company')

@section('content')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/create-interview/index.css') }}">

    <main class="pt-5">
        <form action="{{ route('myjob.store') }}" enctype="multipart/form-data" method="post">
            @csrf
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
                            <div class="rounded-circle p-3 bg-secondary-white d-flex justify-content-center align-items-center mb-2"
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
                            <div class="rounded-circle p-3 bg-secondary-white d-flex justify-content-center align-items-center mb-2"
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
                            <div class="rounded-circle p-3 bg-secondary-white d-flex justify-content-center align-items-center mb-2"
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
                                                transform="translate(-1107.317 -1082.595)" fill="#fff"
                                                stroke="#4ca7ee" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-miterlimit="10" stroke-width="1" />
                                            <ellipse id="Ellipse_29" data-name="Ellipse 29" cx="1.95"
                                                cy="1.854" rx="1.95" ry="1.854"
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

            <!-- DESCRIPTION -->
            <div class="container" id="description">
                <!-- FORM GROUP -->
                <div class="w-100 pt-5 px-5 fs-14">
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="mb-3">
                                <label for="title" class="form-label px-4 mb-2 pb-1">募集職種</label>
                                <input name="title" type="text" class="form-control px-4 rounded-5" id="title"
                                    placeholder="募集職種の入力" value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="mb-3 pb-2">
                                <div class="d-flex justify-content-between px-4 pb-1">
                                    <label for="salary" class="form-label">給料</label>
                                    <div class="text-secondary">オプション</div>
                                </div>
                                <input name="salary" id="salary" type="number" class="form-control px-4 rounded-5"
                                    placeholder="給料の入力" value="{{ old('salary') }}">
                                @error('salary')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="mb-3">
                                <label for="company_id" class="form-label px-4 mb-2 pb-1">会社名</label>
                                <select class="form-control px-4 rounded-5" name="company_id" id="company_id">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"> {{ $company->name }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="mb-3 pb-2">
                                <div class="d-flex justify-content-between px-4 pb-1">
                                    <label for="state_toggle" class="form-label">ビデオの紹介 &nbsp;<svg
                                            xmlns="http://www.w3.org/2000/svg" width="13.33" height="13.33"
                                            viewBox="0 0 13.33 13.33">
                                            <g id="Icon_feather-info" data-name="Icon feather-info"
                                                transform="translate(-2.5 -2.5)">
                                                <path id="Path_93" data-name="Path 93"
                                                    d="M15.33,9.165A6.165,6.165,0,1,1,9.165,3,6.165,6.165,0,0,1,15.33,9.165Z"
                                                    fill="none" stroke="#a1a1a1" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1" />
                                                <path id="Path_94" data-name="Path 94" d="M18,20.466V18"
                                                    transform="translate(-8.835 -8.835)" fill="none" stroke="#a1a1a1"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                                <path id="Path_95" data-name="Path 95" d="M18,12h0"
                                                    transform="translate(-8.835 -5.301)" fill="none" stroke="#a1a1a1"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                            </g>
                                        </svg>
                                    </label>
                                    <div class="text-secondary d-flex gap-3">
                                        <span>
                                            自分の記録
                                        </span>
                                        <div class="form-check form-switch">
                                            <input name="state_toggle" class="form-check-input" type="checkbox"
                                                role="switch" id="state_toggle" @error('video') checked @enderror>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" name="video_url" class="form-control px-4 rounded-5"
                                    id="video_url" placeholder="YouTubeビデオのリンクを入力してください" value="{{ old('video_url') }}">
                                @error('video_url')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- END ROW -->
                </div>
                <!-- END FORM GROUP -->
                <!-- INTRODUCE CONTENT -->
                <div class="w-100">
                    <div class="px-5 pb-3">
                        <a href="{{ route('company.create') }}" class="text-active">会社を追加</a>
                    </div>
                    <!-- VIDEO -->
                    <div class="w-100 px-5" id="description_video">
                        <div class="row card rounded-4 p-4 flex-row flex-wrap">
                            <div class="col-12 col-xl-7 text-center" id="preview">
                                <input type="file" name="video" accept="video/*" class="d-none" id="file_upload">
                                <video class="w-100" autoplay muted playsinline id="videoLive"
                                    style="background-color: #747474;"></video>
                                <video class="none w-100" controls playsinline id="videoRecorded"></video>
                            </div>
                            <div class="col-12 col-xl-5 text-center">
                                <p class="pt-3">個人的な紹介ビデオをする</p>
                                <p class="pt-1 pb-4">回答率の向上•次のステップを説明する機会•ブランド を商単に伝える•視聴者との信頼関係を築く</p>
                                <button id="record"
                                    class="btn-normal text-white bg-active mb-2 w-100 max-300">録音を閧始</button>
                                <!-- <button id="stop" class="btn-normal text-white bg-active mb-2 w-100 max-300">stop</button> -->
                                <p class="pt-1 pb-1">また</p>
                                <button id="btn_upload"
                                    class="btn-normal w-100 bg-white border border-primary bg-hover-primary max-300">アップロード&nbsp;&nbsp;<i
                                        class="fa-solid fa-cloud-arrow-up"></i>
                                </button>
                                <p>
                                    @error('video')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                            </div>
                        </div>

                    </div>
                    <!-- END VIDEO -->
                    <div class="px-5 pt-4 pb-2 d-flex justify-content-between">
                        <div>説明</div>
                        <div class="text-secondary">オプション</div>
                    </div>
                    <!-- TEXT EDITOR -->
                    <div class="w-100 mx-0 mx-md-4">
                        <div class="" id="editor"></div>
                        <input type="hidden" name="description" id="content">
                    </div>
                    <!-- END TEXTEDITOR -->
                </div>
                <!-- END INTRODUCE CONTENT -->

            </div>
            <!-- END DESCRIPTION -->
            <div class="container">
                <div class="w-100 d-flex justify-content-center align-items-baseline text-center mt-4 mb-5">
                    <button class="none btn  btn-normal rounded-5 bg-white border border-primary me-4"
                        id="before">戻る</button>
                    <button class="btn bg-secondary-subtle btn-normal rounded-5" disabled id="next">次に</button>
                    
                </div>

            </div>
        </form>
    </main>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ asset('/assets/js/create-interview/create.js') }}"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        quill.on('text-change', function(delta, oldDelta, source) {
            if (source == 'api') {
                console.log("An API call triggered this change.");
            } else if (source == 'user') {
                let content = new String(quill.getContents().ops[0].insert);
                if (content == '\n') {
                    $("#next").removeClass("active").addClass("bg-secondary-subtle").attr("disabled", "");
                    $("#content").val("");

                } else {
                    $("#next").addClass("active").removeClass("bg-secondary-subtle").removeAttr("disabled");
                    $("#content").val(quill.root.innerHTML);
                }
            }
        });
        // quill.setContents("{{ old('description') }}");
        // quill.root.innerHTML = "{{ old('description') }}"
        // .setContents()
    </script>
@endsection
