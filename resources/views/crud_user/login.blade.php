@extends('dashboard')

@section('content')


<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class="card p-4 shadow-sm" style="width: 400px;">
        <h4 class="card-title text-center mb-3">Màn hình đăng nhập</h4>

        <form method="POST" action="{{ route('user.authUser') }}">
            @csrf

            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" placeholder="Mật khẩu" name="password" required>
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Ghi nhớ đăng nhập
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>

            <div class="text-center mt-3">
                <a href="{{ route('user.createUser') }}">Chưa có tài khoản?</a>

            </div>
        </form>
    </div>
</div>
@endsection