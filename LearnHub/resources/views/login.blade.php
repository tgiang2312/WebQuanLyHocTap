<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="container">
        @if(session('success'))
            <div style="color: green; text-align:center; margin-bottom:1em;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="color: red; text-align:center; margin-bottom:1em;">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div style="color: red; margin-bottom: 1em;">
                <ul style="margin:0; padding-left:1.2em;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="wrapper">
            <div class="card-switch-login">
                <label class="switch-login">
                    <input type="checkbox" class="toggle">
                    <span class="slider"></span>
                    <span class="card-side"></span>
                    <div class="flip-card__inner">
                        <div class="flip-card__front">
                            <div class="title">Đăng nhập</div>
                            <form class="flip-card__form" action="{{ route('login') }}" method="POST">
                                @csrf
                                <input class="flip-card__input" name="email" placeholder="Email" type="email" required>
                                <input class="flip-card__input" name="password" placeholder="Mật khẩu" type="password"
                                    required>
                                <button class="flip-card__btn">Đăng nhập</button>
                                @if($errors->has('email'))
                                <div style="color:red;">{{ $errors->first('email') }}</div>
                                @endif
                            </form>
                        </div>
                        <div class="flip-card__back">
                            <div class="title">Đăng ký</div>
                            <form class="flip-card__form" action="{{ route('register') }}" method="POST">
                                @csrf
                                <input class="flip-card__input" name="name" placeholder="Họ và tên" type="text" required>
                                <input class="flip-card__input" name="email" placeholder="Email" type="email" required>
                                <input class="flip-card__input" name="password" placeholder="Mật khẩu" type="password"
                                    required>
                                <input class="flip-card__input" name="password_confirmation" placeholder="Xác nhận mật khẩu"
                                    type="password" required>
                                <div style="display: flex; align-items: center; gap: 0.5em; margin: 1em 0;">
                                    <span style="font-size: 0.95em;">Học sinh</span>
                                    <label class="toggle-switch-role"
                                        style="margin: 0 0.5em; position: relative; top: 2px;">
                                        <input type="checkbox" name="role" value="teacher">
                                        <span class="slider-role"></span>
                                    </label>
                                    <span style="font-size: 0.95em;">Giáo viên</span>
                                </div>
                                <button class="flip-card__btn">Đăng ký</button>
                            </form>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>
</body>

</html>
