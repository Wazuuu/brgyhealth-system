<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Barangay Health System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; background:#f0f2f5; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
        .card { background:#fff; padding:30px 40px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1); width:100%; max-width:400px; }
        h2 { text-align:center; margin-bottom:20px; color:#4CAF50; }
        input[type="text"], input[type="email"], input[type="password"] { width:100%; padding:10px; margin:10px 0; border:1px solid #ccc; border-radius:5px; }
        button { width:100%; padding:10px; background:#4CAF50; color:white; border:none; border-radius:5px; cursor:pointer; margin-top:10px; font-size:1rem; }
        button:hover { background:#45a049; }
        .footer { text-align:center; margin-top:15px; }
        .footer a { color:#4CAF50; text-decoration:none; font-weight:bold; }
        .error { color:red; font-size:0.9rem; margin-top:5px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Sign Up</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

            <button type="submit">Sign Up</button>
        </form>
        <div class="footer">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</body>
</html>
