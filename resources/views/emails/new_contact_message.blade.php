<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru - JADISATU</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #1f2937;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f3f4f6; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table width="100%" max-width="600" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.06); border: 1px solid #e5e7eb;">
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #1B2B5E; padding: 28px 32px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 22px; font-weight: 800; letter-spacing: 0.5px;">JADISATU</h1>
                            <p style="color: #cbd5e1; margin: 4px 0 0 0; font-size: 13px;">Notifikasi Pesan Konsultasi Masuk</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 32px;">
                            <p style="font-size: 15px; line-height: 1.5; color: #374151; margin-top: 0;">
                                Halo Tim <b>JADISATU</b>,
                            </p>
                            <p style="font-size: 14px; line-height: 1.6; color: #4b5563;">
                                Ada pesan/konsultasi baru yang dikirimkan melalui formulir kontak website resmi JADISATU. Berikut adalah detail lengkapnya:
                            </p>

                            <!-- Information Box -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; margin: 24px 0; overflow: hidden;">
                                <tr>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: bold; color: #64748b; width: 35%;">Nama Pengirim:</td>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 14px; font-weight: bold; color: #1e293b;">{{ $contactMessage->name }}</td>
                                </tr>
                                @if($contactMessage->company)
                                <tr>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: bold; color: #64748b;">Perusahaan / Instansi:</td>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 14px; color: #334155;">{{ $contactMessage->company }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: bold; color: #64748b;">Email:</td>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 14px; color: #1B2B5E; font-weight: bold;">
                                        <a href="mailto:{{ $contactMessage->email }}" style="color: #1B2B5E; text-decoration: none;">{{ $contactMessage->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: bold; color: #64748b;">Nomor WhatsApp / HP:</td>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 14px; color: #334155;">
                                        {{ $contactMessage->phone ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: bold; color: #64748b;">Jenis Event:</td>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: bold; color: #4338ca;">
                                        {{ $contactMessage->event_type ?? 'Konsultasi Umum' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 14px 18px; font-size: 13px; font-weight: bold; color: #64748b;">Waktu Pengiriman:</td>
                                    <td style="padding: 14px 18px; font-size: 13px; color: #64748b;">
                                        {{ $contactMessage->created_at ? $contactMessage->created_at->translatedFormat('l, d F Y, H:i') : '-' }} WIB
                                    </td>
                                </tr>
                            </table>

                            <!-- Message Content -->
                            <div style="margin-bottom: 28px;">
                                <p style="font-size: 13px; font-weight: bold; color: #64748b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Isi Kebutuhan Event:</p>
                                <div style="background-color: #f8fafc; border-left: 4px solid #FF6B35; padding: 16px 20px; border-radius: 0 10px 10px 0; font-size: 14px; line-height: 1.7; color: #1e293b; white-space: pre-line;">{{ $contactMessage->message }}</div>
                            </div>

                            <!-- CTA Buttons -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 24px;">
                                <tr>
                                    <td align="center">
                                        <a href="https://jadisatukreatif.com:2096/" target="_blank" style="display: inline-block; background-color: #1B2B5E; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 10px; font-size: 14px; font-weight: bold; margin-right: 8px;">
                                            Buka Webmail cPanel &rarr;
                                        </a>
                                        <a href="{{ route('admin.messages.show', $contactMessage->id) }}" target="_blank" style="display: inline-block; background-color: #f1f5f9; color: #1e293b; text-decoration: none; padding: 12px 24px; border-radius: 10px; font-size: 14px; font-weight: bold; border: 1px solid #cbd5e1;">
                                            Buka di Admin Panel &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 20px; text-align: center; border-top: 1px solid #e2e8f0; font-size: 12px; color: #94a3b8;">
                            Email ini dikirimkan secara otomatis dari sistem website <b>JADISATU</b>.<br>
                            &copy; {{ date('Y') }} JADISATU. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
