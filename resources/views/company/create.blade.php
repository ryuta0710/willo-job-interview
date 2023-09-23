@extends('layouts.company')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/css/companyMana/create.css') }}">
    <main class="pt-5">
        <div class="container">
            <div class="row">
                <ul class="list-inline">
                    <li class="list-inline-item me-2">
                        <a class="u-link-v5" href="{{ route('company.index') }}">
                            <i class="fa-solid fa-play me-2"></i>会社
                        </a>
                    </li>
                    <li class="list-inline-item me-2">
                        <label class="u-link-v5 g-color-main" href="#">
                            <i class="fa fa-angle-right me-2"></i>会社の作成
                        </label>
                    </li>
                </ul>
            </div>
            <div class="row mt-5">
                <form action="{{ route('company.store') }}" enctype="multipart/form-data" method="post" class="col-lg-6 mx-auto">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label px-3">会社名</label>
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control rounded-pill"
                            id="name" placeholder="会社名を正しく入力してください。">
                        @error('name')
                            <span class="text-danger">
                                <strong>会社名を正しく入力してください</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label px-3">アドレス</label>
                        <input name="address" value="{{ old('address') }}" type="text" class="form-control rounded-pill"
                            id="address" placeholder="アドレスを入力してください">
                        @error('address')
                            <span class="text-danger">
                                <strong>アドレスを正しく入力してください</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="w-100 d-flex justify-content-between px-3">
                            <label for="website" class="form-label">Webサイト</label>
                            <span class="text-secondary">オプション</span>
                            {{-- <span>オプション</span> --}}
                        </div>
                        <input name="website" value="{{ old('website') }}" type="text" class="form-control rounded-pill"
                            id="website" placeholder="ウェブサイトを入力してください">
                        @error('website')
                            <span class="text-danger">
                                <strong>ウェブサイトを正しく入力してください</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="previewValue1" class="form-label px-3">ヘッダー/フッターの色</label>
                                    <div class="position-relative">
                                        <div class="form-control p-0 rounded-pill py-2 px-3"
                                            style="height: 40px; cursor: pointer;" onclick="togglePicker(1)">
                                            <div class="m-0 rounded" style="width: 25px; height: 25px;" id="selectedValue1">
                                            </div>
                                        </div>
                                        <div class="position-absolute w-100 py-3 bg-white top-100 px-2 rounded border mt-1 colorPicker"
                                            id="colorPicker1" style="z-index: 2;">
                                            <div class="w-100 d-flex flex-wrap gap-1">
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(1, 'FF6900')"
                                                    style="width: 35px; height: 35px; background-color: #FF6900;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(1, 'FCB900')"
                                                    style="width: 35px; height: 35px; background-color: #FCB900;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(1, '7BDCB5')"
                                                    style="width: 35px; height: 35px; background-color: #7BDCB5;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(1, '00D084')"
                                                    style="width: 35px; height: 35px; background-color: #00D084;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(1, '8ED1FC')"
                                                    style="width: 35px; height: 35px; background-color: #8ED1FC;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(1, '0693E3')"
                                                    style="width: 35px; height: 35px; background-color: #0693E3;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(1, 'ABB8C3')"
                                                    style="width: 35px; height: 35px; background-color: #ABB8C3;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(1, 'EB144C')"
                                                    style="width: 35px; height: 35px; background-color: #EB144C;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(1, 'F78DA7')"
                                                    style="width: 35px; height: 35px; background-color: #F78DA7;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(1, '9900EF')"
                                                    style="width: 35px; height: 35px; background-color: #9900EF;"></button>
                                                <input type="text"name="header_color" class="form-control m-0"
                                                    id="previewValue1" style="max-width: 155px; height: 35px;" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="previewValue2" class="form-label px-3">ボタンの色</label>
                                    <div class="position-relative">
                                        <div class="form-control p-0 rounded-pill py-2 px-3"
                                            style="height: 40px; cursor: pointer;" onclick="togglePicker(2)">
                                            <div class="m-0 rounded" style="width: 25px; height: 25px;"
                                                id="selectedValue2">
                                            </div>
                                        </div>
                                        <div class="position-absolute w-100 py-3 bg-white top-100 px-2 rounded border mt-1 colorPicker"
                                            id="colorPicker2" style="z-index: 2;">
                                            <div class="w-100 d-flex flex-wrap gap-1">
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(2, 'FF6900')"
                                                    style="width: 35px; height: 35px; background-color: #FF6900;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(2, 'FCB900')"
                                                    style="width: 35px; height: 35px; background-color: #FCB900;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(2, '7BDCB5')"
                                                    style="width: 35px; height: 35px; background-color: #7BDCB5;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(2, '00D084')"
                                                    style="width: 35px; height: 35px; background-color: #00D084;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(2, '8ED1FC')"
                                                    style="width: 35px; height: 35px; background-color: #8ED1FC;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(2, '0693E3')"
                                                    style="width: 35px; height: 35px; background-color: #0693E3;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(2, 'ABB8C3')"
                                                    style="width: 35px; height: 35px; background-color: #ABB8C3;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(2, 'EB144C')"
                                                    style="width: 35px; height: 35px; background-color: #EB144C;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(2, 'F78DA7')"
                                                    style="width: 35px; height: 35px; background-color: #F78DA7;"></button>
                                                <button class="rounded border-0" type="button"
                                                    onclick="changeColor(2, '9900EF')"
                                                    style="width: 35px; height: 35px; background-color: #9900EF;"></button>
                                                <input type="text" name="button_color" class="form-control m-0"
                                                    id="previewValue2" style="max-width: 155px; height: 35px;" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="logo" class="form-label px-3">ロゴ</label>
                                <div class="drop-zone">
                                    <span class="drop-zone__prompt text-active"><i
                                            class="fa fa-solid fa-plus text-active"></i><br>アップロ一ド</span>
                                    <input type="file" name="logo" id="logo"
                                        accept="image/jpeg, image/png, image/jpg" class="drop-zone__input">
                                </div>
                                @error('logo')
                                    <span class="text-danger">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="field" class="form-label px-3">業界 </label>
                        <select name="field" id="field" class="form-select rounded-pill" value="{{old('field')}}">
                            <option value="" selected class="display-none"></option>
                            <option value="企業">企業</option>
                            <option value="自動車">自動車</option>
                            <option value="自動化">自動化</option>
                            <option value="電子工業">電子工業</option>
                            <option value="電子工業">電子工業</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between px-3">
                            <p class="m-0"><i class="fa fa-solid fa-circle-info"></i> デフォルトの会社として使用</p>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="default" type="checkbox" id="flexSwitchCheckDefault">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-4">
                        <a href="{{ route('company.index') }}" type="reset"
                            class="btn btn-light border text-active rounded-pill px-4">キャンセル</a>
                        <button type="submit" class="btn btn-primary border rounded-pill px-4"
                            id="submit">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('/assets/js/company/create.js') }}"></script>
@endsection
