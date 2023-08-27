@extends('layouts.company')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/template-list/index.css') }}">

    <main class="pt-5">
        <div class="container px-4">
            <div class="row justify-content-between align-items-center mb-5">
                <div class="col-lg-3 mb-3 mb-lg-0">
                    <input type="text" class="form-control rounded-pill" placeholder="タイトルで検索する">
                </div>
                <div class="col-lg-3 mb-3 mb-lg-0">
                    <select name="" id="" class="form-select rounded-pill">
                        <option value="email">Eメール</option>
                        <option value="SMS">SMS</option>
                    </select>
                </div>
                <div class="col-lg-3 mb-3 mb-lg-0 d-flex justify-content-end">
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
                            <tbody>
                                <tr>
                                    <td>
                                        <i class="fa fa-solid fa-envelope me-2"></i> 募集項目名
                                    </td>
                                    <td>
                                        27/06/23
                                    </td>
                                    <td>
                                        2023/07/20
                                    </td>
                                    <td>
                                        <div>
                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                <i class="fa fa-solid fa-eye me-3"></i>
                                            </a>
                                            <a href="{{ route('template.edit', ['template' => 1]) }}">
                                                <i class="fa fa-solid fa-edit me-3"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-solid fa-copy me-3"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
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
                                <a href="{{ route('template.edit', ['template' => 1]) }}">
                                    <i class="fa fa-solid fa-edit me-3"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-solid fa-copy me-3"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-solid fa-trash"></i>
                                </a>
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

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div></div>
                    <h5 class="modal-title text-center">Default Invite Email</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">Hi {candidate_full_name},</h6>
                    <div class="text-center">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div></div>
                    <h5 class="modal-title text-center">Default Invite Email</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">Hi {candidate_full_name},</h6>
                    <div class="content">
                        <div style="font-family: inherit; text-align: center;"><br></div>
                        <div style="font-family: inherit; text-align: center;"><span
                                style="box-sizing: border-box; padding: 0px; margin: 0px; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; border: 0px; text-align: center; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: pre-wrap; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: transparent; text-decoration-style: initial; text-decoration-color: initial; font-family: arial, helvetica, sans-serif; font-size: 24px; color: rgb(101, 100, 100);"><strong>You're
                                    all done!</strong></span></div>
                        <div style="font-family: inherit; text-align: center;"><br></div>
                        <div style="font-family: inherit; text-align: center;"><span
                                style="box-sizing: border-box; padding: 0px; margin: 0px; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; border: 0px; text-align: center; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: pre-wrap; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: transparent; text-decoration-style: initial; text-decoration-color: initial; font-family: arial, helvetica, sans-serif; font-size: 18px; color: rgb(101, 100, 100);">This
                                email confirms that your answers have been received:</span></div>
                        <div style="font-family: inherit; text-align: center;"><span
                                style="box-sizing: border-box; padding: 0px; margin: 0px; font-style: inherit; font-variant-ligatures: inherit; font-variant-caps: inherit; font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: inherit; font-stretch: inherit; line-height: inherit; vertical-align: baseline; border: 0px; text-align: center; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: pre-wrap; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: transparent; text-decoration-style: initial; text-decoration-color: initial; font-family: arial, helvetica, sans-serif; font-size: 18px; color: rgb(101, 100, 100);">{interview_name},
                                {company_name}</span></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reminderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div></div>
                    <h5 class="modal-title text-center">Default Invite Email</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">Hi {candidate_full_name},</h6>
                    <div class="text-center">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="smsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div></div>
                    <h5 class="modal-title text-center">Default Invite Email</h5>
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">Hi {candidate_full_name},</h6>
                    <div class="text-center">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/assets/js/template/index.js') }}"></script>
@endsection
