<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 350px; }
        h2 { margin-bottom: 20px; color: #333; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #27ae60; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1em; }
        button:hover { background: #219150; }
        .error { color: red; font-size: 0.85em; margin-top: 5px; }
        .link { text-align: center; margin-top: 15px; font-size: 0.9em; }
        .link a { color: #3498db; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <h2>Đăng ký</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Họ và tên</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Email (Gmail)</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" required>
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit">Đăng ký & Nhận mã OTP</button>
    </form>

    <div class="link">
        Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
    </div>
</div>

</body>
</html>