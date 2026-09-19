<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tautan Login Admin</title>
</head>
<body style="margin:0;padding:0;background:#f4f5f8;font-family:Arial, Helvetica, sans-serif;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f5f8;padding:32px 16px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:480px;background:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 6px 20px rgba(15,21,28,0.08);">

          <tr>
            <td style="background:#0f2a4a;padding:22px 28px;">
              <div style="color:#ffffff;font-size:16px;font-weight:700;">
                {{ $profil->nama_sekolah ?? config('app.name') }}
              </div>
              <div style="color:#e8a33d;font-size:11px;letter-spacing:.05em;text-transform:uppercase;margin-top:2px;">
                Panel Admin
              </div>
            </td>
          </tr>

          <tr>
            <td style="padding:28px;">
              <p style="font-size:14px;color:#1c2733;line-height:1.6;margin:0 0 14px;">
                Halo <strong>{{ $user->name }}</strong>,
              </p>

              <p style="font-size:14px;color:#3a4552;line-height:1.7;margin:0 0 22px;">
                Klik tombol di bawah ini untuk login ke Panel Admin {{ config('app.name') }}.
                Tautan ini hanya berlaku selama <strong>15 menit</strong> sejak email ini dikirim,
                dan hanya bisa digunakan satu kali.
              </p>

              <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto 22px;">
                <tr>
                  <td style="border-radius:999px;background:#e8a33d;">
                    <a href="{{ $url }}"
                       style="display:inline-block;padding:13px 28px;font-size:13.5px;font-weight:700;color:#ffffff;text-decoration:none;border-radius:999px;">
                      Login ke Panel Admin
                    </a>
                  </td>
                </tr>
              </table>

              <p style="font-size:12px;color:#8892a0;line-height:1.6;margin:0 0 6px;">
                Atau salin dan tempel tautan berikut ke browser Anda:
              </p>
              <p style="font-size:12px;color:#0f6fd1;word-break:break-all;margin:0 0 22px;">
                <a href="{{ $url }}" style="color:#0f6fd1;text-decoration:none;">{{ $url }}</a>
              </p>

              <hr style="border:none;border-top:1px solid #eef0f3;margin:0 0 18px;">

              <p style="font-size:12px;color:#8892a0;line-height:1.6;margin:0;">
                Jika Anda tidak meminta tautan login ini, abaikan saja email ini —
                tidak ada tindakan yang perlu dilakukan.
              </p>
            </td>
          </tr>

          <tr>
            <td style="background:#f8f9fb;padding:16px 28px;text-align:center;">
              <p style="font-size:11px;color:#a0aab5;margin:0;">
                &copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? config('app.name') }}. Email ini dikirim otomatis, mohon tidak membalas.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>