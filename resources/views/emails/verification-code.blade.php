<!DOCTYPE html>
<html>
<head>
    <title>Kode Verifikasi Reset Password</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .code { 
            font-size: 24px; 
            font-weight: bold; 
            letter-spacing: 2px; 
            color: #2d3748;
            margin: 20px 0;
            padding: 10px;
            background: #f7fafc;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password Kinaara Resort</h2>
        <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>
        
        <p>Gunakan kode verifikasi berikut untuk reset password:</p>
        
        <div class="code">{{ $verificationCode }}</div>
        
        <p>Kode ini akan kadaluarsa dalam 15 menit.</p>
        
        <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        
        <p>Terima kasih,<br>Tim Kinaara Resort</p>
    </div>
</body>
</html>