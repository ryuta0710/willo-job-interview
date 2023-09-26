@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('/assets/css/top/job-list.css') }}">
<main class="pb-lg-5">
    <section class="main-visual w-100 p-0 vh-100 background-position-top">
        <div class="container d-flex justify-content-center align-items-end flex-column vh-100 pt-4 position-relative">
            <div class="col-lg-6 w-auto">
                <div class="w-auto mb-3 d-flex">
                    <h1 class="mb-0 fs-2 fw-bold bg-white px-4 py-2 text-active text-start">働く環境について</h1>
                </div>
                <div class="w-auto mb-3 d-flex">
                    <h1 class="mb-0 fs-2 fw-bold bg-white px-4 py-2 text-start">能力を最大限発揮できる</h1>
                </div>
                <div class="w-auto mb-3 d-flex">
                    <h1 class="mb-0 fs-2 fw-bold bg-white px-4 py-2 text-start">働きやすい環境を目指しています。</h1>
                </div>
            </div>

            <div class="position-absolute start-50 translate-middle-x w-100" style="bottom: 20vh;">
                <div class="row rounded-pill bg-white w-100 mb-3">
                    <form action="" method="get"
                        class="w-100 px-4 py-2 d-flex align-items-center justify-content-start w-100 position-relative pe-130">
                        @csrf
                        <div class="col-4 d-flex justify-content-between me-3">
                            <i class="fa fa-solid fa-search text-active me-3 fs-2"></i>
                            <div class="border-end h-100"></div>
                            <input type="text" name="search_key" id="search_key" value="{{ old('search_key') }}" class="form-control border">
                        </div>
                        {{-- <div class="col-4 d-flex justify-content-between me-3">
                            <i class="fa fa-solid fa-location-dot text-active me-3 fs-2"></i>
                            <select name="" id="" class="form-select border-1 me-2">
                                <option value="">asdasd</option>
                                <option value="">asdasd</option>
                                <option value="">asdasd</option>
                            </select>
                            <select name="" id="" class="form-select border-1">
                                <option value="">asdasd</option>
                                <option value="">asdasd</option>
                                <option value="">asdasd</option>
                            </select>
                        </div> --}}
                        <div class="col-auto me-3 ms-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="27" viewBox="0 0 45 27">
                                <path id="Icon_awesome-money-bill-alt" data-name="Icon awesome-money-bill-alt"
                                    d="M24.75,20.25H23.625V14.063a.562.562,0,0,0-.562-.562h-.955a1.685,1.685,0,0,0-.936.283l-1.078.719a.562.562,0,0,0-.156.78l.624.936a.562.562,0,0,0,.78.156l.033-.022v3.9H20.25a.562.562,0,0,0-.562.563v1.125a.562.562,0,0,0,.563.563h4.5a.562.562,0,0,0,.563-.562V20.813A.562.562,0,0,0,24.75,20.25Zm18-15.75H2.25A2.25,2.25,0,0,0,0,6.75v22.5A2.25,2.25,0,0,0,2.25,31.5h40.5A2.25,2.25,0,0,0,45,29.25V6.75A2.25,2.25,0,0,0,42.75,4.5ZM3.375,28.125v-4.5a4.5,4.5,0,0,1,4.5,4.5Zm0-15.75v-4.5h4.5A4.5,4.5,0,0,1,3.375,12.375ZM22.5,25.875c-3.728,0-6.75-3.526-6.75-7.875s3.022-7.875,6.75-7.875S29.25,13.65,29.25,18,26.227,25.875,22.5,25.875Zm19.125,2.25h-4.5a4.5,4.5,0,0,1,4.5-4.5Zm0-15.75a4.5,4.5,0,0,1-4.5-4.5h4.5Z"
                                    transform="translate(0 -4.5)" fill="#4ca7ee" />
                            </svg>
                            <p class="m-0 text-center text-active">給料</p>
                        </div>
                        <div class="col-4 d-flex justify-content-between me-3">
                            <select name="salary_min" id="salary_min" class="form-select border-1 me-3">
                                <option value="none" @if ( old('salary_min') == "none") selected @endif></option>
                                <option value="200000"  @if ( old('salary_min') == "200000") selected @endif>200000円</option>
                                <option value="300000"  @if ( old('salary_min') == "300000") selected @endif>300000円</option>
                                <option value="300000"  @if ( old('salary_min') == "300000") selected @endif>400000円</option>
                            </select>
                            <select name="salary_max" id="salary_max" class="form-select border-1">
                                <option value="none" @if ( old('salary_max') == "none") selected @endif></option>
                                <option value="200000" @if ( old('salary_max') == "200000") selected @endif>200000円</option>
                                <option value="300000" @if ( old('salary_max') == "300000") selected @endif>300000円</option>
                                <option value="300000" @if ( old('salary_max') == "300000") selected @endif>400000円</option>
                            </select>
                        </div>
                        <div class="" style="right: 24px;width: auto;position: absolute;">
                            <button class="btn btn-primary rounded-pill" id="submit">仕事を探す</button>
                        </div>
                        <input type="hidden" name="field_id" id="field_id">
                        <input type="number"  name="page_no" value="0" id="page_no" class="d-none">
                    </form>
                </div>
                <div class="row rounded-pill w-100 justify-content-between align-items-center" id="fields">
                    @foreach ($fields as $item)
                    <div class="col-auto">
                        <button class="btn btn-primary rounded-pill" data-id="{{$item['id']}}" onclick="select_field(this, {{$item['id']}})">
                            <i class="fa fa-solid fa-money-bill me-2"></i> {{$item['name']}}
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container pb-5">
            <h3 class="mb-5">{{count($jobs)}}件の職業が検索されました。</h3>
            <div id="job_list">
                @foreach ($jobs as $item)
                    <div class="row border-top pt-4 mb-5">
                        <div class="col-lg-5 mb-4 mb-lg-4">
                            <video controls crossorigin playsinline>
                                <source src="{{$item->video_url}}" type="video/mp4" size="576">
                                <a>Video</a>
                            </video>
                        </div>
                        <div class="col-lg-7">
                            <h4>{{$item->title}}</h4>
                            <div>{!!$item->description!!}   </div>
                            <div class="d-flex">
                                <strong>給料：</strong>
                                <p>{{$item->salary}}円</p>
                            </div>
                            <div class="d-flex">
                                <strong>住所：</strong>
                                <p>{{$item->address}}</p>
                            </div>
                            <div class="d-flex">
                                <strong>業界：</strong>
                                <p>{{$item->field}}</p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('getJobDetail', ['url' => $item->url]) }}" class="text-end">
                                    もっと見る <i class="fa fa-arrow-right text-active"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="paginate pb-5 d-flex justify-content-center">
                <div class="pagination py-5">
                    <ul class="m-0 p-0 list-unstyled">
                        <a href="#" class="text-active bg-transparent">
                            <li>
                                <i class="fa fa-solid fa-chevron-left" aria-hidden="true"></i>
                            </li>
                        </a>
                        <a class="is-active text-white" href="#">
                            <li> 1 </li>
                        </a>
                        <a href="#" class="text-active bg-transparent">
                            <li>
                                <i class="fa fa-solid fa-chevron-right" aria-hidden="true"></i>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="{{ asset('/assets/js/top/job-list.js') }}"></script>
<script>
    
$("#submit").click(function(e){
    e.preventDefault();
    let search_key = $("#search_key").val();
    let salary_min = $("#salary_min").val();
    let salary_max = $("#salary_max").val();
    let field_id = $("#field_id").val();
    let page_no = $("#page_no").val();
    $.ajax({
        url: "{{route('fetchJobs')}}",
        type: 'post',
        data: {
            _token : $("meta[name=csrf-token]").attr("content"),
            search_key,
            salary_min,
            salary_max,
            field_id,
            page_no,
        },
        success: function(response) {
            let data = response.data;
            let length = data.length;
            let dis_html = "";
            data.forEach(function(job){
                let address = job.address || "";
                dis_html += `<div class="row border-top pt-4 mb-5">
                    <div class="col-lg-5 mb-4 mb-lg-4">
                        <video controls crossorigin playsinline>
                            <source src="${job.video_url}" type="video/mp4" size="576">
                            <a>Video</a>
                        </video>
                    </div>
                    <div class="col-lg-7">
                        <h4>${job.title}</h4>
                        <div>${job.description}</div>
                        <div class="d-flex">
                            <strong>給料：</strong>
                            <p>${job.salary}円</p>
                        </div>
                        <div class="d-flex">
                            <strong>住所：</strong>
                            <p>${address}</p>
                        </div>
                        <div class="d-flex">
                            <strong>業界：</strong>
                            <p>${job.field}</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="/getJobDetail/${job.url}" class="text-end">
                                もっと見る <i class="fa fa-arrow-right text-active"></i>
                            </a>
                        </div>
                    </div>
                </div>`;
                $("#job_list").html(dis_html);
            });
        },
        error: function(xhr, status, error) {
            alert(xhr.responseJSON.message);
        }
    });
})
</script>
@endsection