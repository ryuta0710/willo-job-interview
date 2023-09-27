@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('/assets/css/top/job-detail.css') }}">
<main class="pb-lg-5">
    <section class="pt-md-5 pb-5">
        <div class="container pt-md-5 pb-5 mb-5">
            <div class="col-12 d-flex justify-content-start align-items-center">
                <div class="company-logo mb-4" style="width: 150px;">
                    <img src="./assets/img/logos/01.png" alt="">
                </div>
                <h1 class="company-name">会社名</h1>
            </div>
            <div class="card rounded p-4 border-0 shadow mb-5">
                <div class="row mb-5">
                    <video controls crossorigin playsinline>
                        <source src="{{$job->video_url}}" type="video/mp4" size="576">
                        <a>Video</a>
                    </video>
                </div>
                <div class="row px-0 px-md-4">
                    <h1 class="mb-4">{{$job->title}}</h1>
                    <div>
                        {!!$job->description!!}
                    </div>
                    <hr class="my-4 bg-active">
                    <div class="d-flex justify-content-start align-items-center gap-2 gap-lg-4 mb-3">
                        <i class="fa fa-solid fa-user"></i>
                        <strong>業界：</strong>
                        <p class="m-0">{{$job->field}}</p>
                    </div>
                    <div class="d-flex justify-content-start align-items-center gap-2 gap-lg-4 mb-3">
                        <i class="fa fa-solid fa-yen"></i>
                        <strong>給料：</strong>
                        <p class="m-0">{{$job->salary}}円</p>
                    </div>
                    <div class="d-flex justify-content-start align-items-center gap-2 gap-lg-4 mb-3">
                        <i class="fa fa-solid fa-map"></i>
                        <strong>住所：</strong>
                        <p class="m-0">{{$job->address}}</p>
                    </div>
                    <div class="d-flex justify-content-start align-items-center gap-2 gap-lg-4">
                        <i class="fa fa-solid fa-earth"></i>
                        <strong>WebサイトURL：</strong>
                        <a href="{{$job->website}}" target="_blank" class="text-active">{{$job->website}}</a>
                    </div>
                    <hr class="my-4 bg-active">
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <a href="{{route('redirect-interview', ['url' => $job->url ])}}" class="btn btn-primary px-5">応募する</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="{{ asset('/assets/js/top/job-detail.js') }}"></script>
@endsection