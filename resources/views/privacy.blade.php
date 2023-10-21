<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/common/bootstrap.css') }}">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('/assets/css/companyMana/list.css') }}">

    <title>KIRIHARE | プライバシー</title>
</head>
<body>
    
    <header class="bg-light py-1 position-sticky w-100 top-0" style="z-index: 2">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand pe-5" href="{{ route('home') }}">
                    <img src="{{ asset('/assets/img/logo01.png') }}" alt="">
                </a>
            </nav>
        </div>
    </header>
    <main class="pt-5" style="max-width: 900px; margin: auto;">
        <h1 class="text-center">プライバシーポリシー</h1>
        <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
    </main>
    
    <footer class="pt-5" style="margin-top: 11px;"> 
        <div class="py-3 bg-secondary-grey">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('/assets/img/logo01.png') }}" alt="">
                    </a>
                </div>
                <div class="d-flex gap-3">
                    <a href="">サポート</a>
                    <a href="">プライバシーポリシー</a>
                </div>
            </div>
        </div>
        <div class="bg-dark">
            <div class="container py-3">
                <p class="text-center text-white m-0">Copyright © PROS Co., Ltd. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>