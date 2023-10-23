@extends('layouts.company')
@section('title', 'テンプレート一覧')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/template-list/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/modal-preview.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <main class="pt-5">
        <div class="container px-4">
            <div class="row justify-content-between align-items-center mb-5">
                <div class="col-lg-3 mb-3 mb-lg-0">
                    <input type="text" class="form-control rounded-pill" placeholder="タイトルで検索する" id="search_content">
                </div>
                <div class="col-lg-3 mb-3 mb-lg-0">
                    <select name="" id="search_type" class="form-select rounded-pill">
                        <option value="" disabled selected hidden>タイプで検索</option>
                        <option value="email">Eメール</option>
                        <option value="SMS">SMS</option>
                    </select>
                </div>
                <div class="col-lg-auto mb-3 mb-lg-0 d-flex justify-content-end">
                    <span class="m-0 align-self-center me-4" id="filter_clear"><a href="javascript:;">すべてクリア</a></span>
                    <a class="btn btn-primary px-4" href="{{ route('template.create') }}"><i
                            class="fa fa-solid fa-plus"></i> 作成</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive border rounded" style="min-height: 500px; overflow-y: auto;">
                        <table id="messages_table" class="table" style="min-width: 1200px; overflow-x: auto;">
                            <thead>
                                <tr class="bg-secondary-grey">
                                    <th class="py-4 text-center">タイ卜ル</th>
                                    <th class="py-4">更新しました-</th>
                                    <th class="py-4">プレビュー</th>
                                    <th class="py-4">アクション</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>
                                            @if ($message->type == 'email')
                                                <i class="fa fa-solid fa-envelope me-2"></i>
                                            @else
                                                <i class="fa fa-solid fa-comment me-2"></i>
                                            @endif{{ $message->title }}
                                        </td>
                                        <td>{{ $message->updated_at }}</td>
                                        <td>{!! $message->content !!}</td>
                                        <td>
                                            <div>
                                                <a href="javascript:;" data-bs-toggle="modal" data-id="{{ $message->id }}"
                                                    @if ($message->type == 'sms') data-bs-target="#smsModal"
													@else @if ($message->type == 'email' && $message->trigger == 'invite')
														data-bs-target="#inviteModal"
													@else @if ($message->type == 'email' && $message->trigger == 'success')
														data-bs-target="#successModal"
													@else @if ($message->type == 'email' && $message->trigger == 'reminder')
														data-bs-target="#reminderModal" @endif
                                                    @endif
                                                    @endif
                                                    @endif
                                                    data-id = {{ $message->id }}>
                                                    <i class="fa fa-solid fa-eye me-3"></i>
                                                    </a>
                                                    @if ($message->editable == 1)
                                                        <a href="{{ route('template.edit', ['template' => $message->id]) }}">
                                                            <i class="fa fa-solid fa-edit me-3"></i>
                                                        </a>
                                                    @else
                                                        <div style="display: inline-block;width: 32px;"></div>
                                                    @endif
                                                    <a href="javascript:;" onclick="copy('{{ $message->id }}')">
                                                        <i class="fa fa-solid fa-copy me-3"></i>
                                                    </a>
                                                    @if ($message->editable == 1)
                                                        <a href="javascript:;" onclick="del('{{ $message->id }}')">
                                                            <i class="fa fa-solid fa-trash"></i>
                                                        </a>
                                                    @else
                                                        <div style="display: inline-block;width: 14px;height: 1rem;"></div>
                                                    @endif
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
                    <div class="body-header">
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
                        <p>面接を完了するまでに十分な時間をとってください。 安定した高速インターネット接続上で、シークレット モードで最新バージョンの Google Chrome または Firefox ブラウザを使用することをお勧めします。
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

    <script src="{{ asset('/assets/js/template/index.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
