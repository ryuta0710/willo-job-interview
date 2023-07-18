@extends('layouts.company')

@section('content')
<link rel="stylesheet" href="{{ asset('/assets/css/template-list/create.css') }}">

<main class="pt-5">
    <div class="container">
        <div class="row">
            <ul class="list-inline">
                <li class="list-inline-item me-2">
                    <a class="u-link-v5" href="/">
                        <i class="fa-solid fa-play me-2"></i>図書館
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
            <form action="" method="post" class="col-lg-10 mx-auto">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="companyName" class="form-label px-3">テンプレートのタイトル</label>
                        <input type="email" class="form-control rounded-pill" id="companyName"
                            placeholder="テンプレートのタイトル">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="companyName" class="form-label px-3">テンプレートの種類</label>
                        <select name="" id="" class="form-select rounded-pill">
                            <option value="">E メール</option>
                        </select>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="companyName" class="form-label px-3">テンプレートトリガー</label>
                        <select name="" id="" class="form-select rounded-pill">
                            <option value="">招待</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-between align-items-center px-3">
                        <p class="m-0">テンプレートの内容</p>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-solid fa-eye"></i> プレビュー
                        </a>
                    </div>
                </div>
                <div class="row mb-3">
                    <textarea class="form-control w-100" id="editor" name="editor"></textarea>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button class="btn btn-secondary rounded-pill" type="submit">保 存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="{{ asset('/assets/js/ckeditor/ckeditor.js') }}"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection