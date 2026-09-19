<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin — {{ $profil->nama_sekolah ?? 'SMK Negeri 1 Cijati' }}</title>
<style>
  *{ box-sizing:border-box; margin:0; padding:0; }
  body{
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f5f8;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:16px;
  }
  .panel{
    max-width:380px;
    width:100%;
    background:#ffffff;
    border-radius:14px;
    padding:28px;
    box-shadow:0 6px 20px rgba(15,21,28,0.10);
  }
  .panel h3{
    color:#1c2733;
    font-size:18px;
    margin-bottom:18px;
  }
  .alert-success{
    background:rgba(20,140,110,0.08);
    border:1px solid rgba(20,140,110,0.25);
    color:#0e7c6c;
    padding:10px 14px;
    border-radius:8px;
    font-size:13px;
    margin-bottom:16px;
    word-break:break-all;
  }
  .alert-error{
    background:rgba(220,60,60,0.08);
    border:1px solid rgba(220,60,60,0.25);
    color:#b3261e;
    padding:10px 14px;
    border-radius:8px;
    font-size:13px;
    margin-bottom:16px;
  }
  .field{
    display:flex;
    flex-direction:column;
    gap:6px;
    margin-bottom:16px;
  }
  .field label{
    font-size:13px;
    font-weight:600;
    color:#3a4552;
  }
  .field input{
    padding:10px 12px;
    border:1px solid #dfe3e8;
    border-radius:8px;
    font-size:14px;
    outline:none;
  }
  .field input:focus{
    border-color:#0e7c7b;
  }
  .btn{
    width:100%;
    padding:11px;
    background:#0e7c7b;
    color:#ffffff;
    border:none;
    border-radius:8px;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
  }
  .btn:hover{
    background:#0a5c5c;
  }
</style>
</head>
<body>

  <div class="panel">
    <h3>Login Admin lewat Email</h3>

    @if(session('status'))
      <div class="alert-success">{{ session('status') }}</div>
    @endif

  @if (session('debug_url'))
    <div class="mt-3 text-sm break-all">
        <a href="{{ session('debug_url') }}">{{ session('debug_url') }}</a>
    </div>
@endif

    @if($errors->any())
      <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.magic-login.send') }}">
      @csrf
      <div class="field">
        <label>Email Admin</label>
        <input type="email" name="email" required autofocus placeholder="admin@smkn1cijati.id">
      </div>
      <button type="submit" class="btn">Kirim Tautan Login</button>
    </form>
  </div>

</body>
</html>