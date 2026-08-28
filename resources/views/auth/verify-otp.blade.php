<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận mã OTP</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        h2 { margin-bottom: 15px; color: #333; }
        p { font-size: 0.9em; color: #666; margin-bottom: 20px; }
        input { width: 100%; padding: 10px; font-size: 1.2em; letter-spacing: 5px; text-align: center; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #2980b9; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1em; }
        button:hover { background: #2471a3; }
        .alert-success { color: green; font-size: 0.9em; margin-bottom: 15px; }
        .error { color: red; font-size: 0.9em; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="card">
    <h2>Xác thực OTP</h2>
    <p>Mã OTP đã được gửi đến Email của bạn. Vui lòng kiểm tra và nhập vào bên dưới:</p>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @error('otp')
        <div class="error">{{ $message }}</div>
    @enderror

    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        <input type="text" name="otp" maxlength="6" placeholder="123456" required autofocus>
        <button type="submit">Xác nhận tài khoản</button>
    </form>
</div>

</body>
</html>