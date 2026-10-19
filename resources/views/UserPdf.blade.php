<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lembar Data Karyawan - {{ $user['name'] }}</title>
</head>

<body
    style="margin:0; padding:0; font-family:Helvetica, Arial, sans-serif; font-size:9px; color:#1e293b; background:#ffffff;">
    <div style="padding:10px 14px;">
        {{-- ================= HEADER ================= --}}
        <table width="100%" cellspacing="0" cellpadding="0"
            style="border-bottom:2px solid #1e3a8a; padding-bottom:8px;">
            <tr>
                <td width="52" valign="top">
                    <img src="{{ public_path('BEMP.png') }}" alt="Logo-BEMP"
                        style="width:40px; height:40px; border-radius:8px; text-align:center; color:#ffffff; font-size:20px; font-weight:bold; line-height:40px;">
                </td>
                <td valign="top" style="padding-left:6px;">
                    <div style="font-size:15px; font-weight:bold; color:#1e3a8a; letter-spacing:0.5px;">BALI EXOTIC
                        MARINE PARK</div>
                    <div style="font-size:7.5px; color:#64748b; letter-spacing:1.5px; margin-top:1px;">LIFE WITH EXOTIC
                    </div>
                    <div style="font-size:7.5px; color:#64748b; margin-top:4px;">
                        Jalan Bali Exotik No. 8, Pedungan Denpasar City, Bali – 80222 | Telp: (0361) 723-999
                    </div>
                </td>
                <td width="150" valign="top" align="right">
                    <div style="font-size:7px; color:#94a3b8; letter-spacing:1px;">FORM HRD SISTEM</div>
                    <div style="font-size:9px; font-weight:bold; color:#1e3a8a; font-family:Courier, monospace;">
                        BEMP-ERP-SISTEM</div>
                </td>
            </tr>
        </table>

        {{-- ================= JUDUL ================= --}}
        <table width="100%" cellspacing="0" cellpadding="0"
            style="margin-top:10px; background:#f1f5f9; border-left:4px solid #1e3a8a;">
            <tr>
                <td style="padding:7px 10px;">
                    <div style="font-size:12px; font-weight:bold; color:#0f172a; letter-spacing:0.3px;">LEMBAR DATA
                        KARYAWAN &amp; RIWAYAT LENGKAP KONTRAK KERJA</div>
                    <div style="font-size:7.5px; color:#64748b; margin-top:2px;">Employee Master Record &amp; Historical
                        Contract Dossier</div>
                </td>
                <td align="right" valign="bottom" style="padding:7px 10px; font-size:7.5px; color:#475569;">
                    Tanggal Cetak: <b>{{ $tanggal }}</b> &nbsp;|&nbsp; Dicetak Oleh: <b>{{ $by }}</b>
                </td>
            </tr>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" style="margin-top:14px;">
            <tr>
                <td style="font-size:10px; font-weight:bold; color:#1e3a8a;">
                    <span style="color:#1e3a8a;"></span> 1. PROFIL &amp; INFORMASI POKOK KARYAWAN
                </td>
            </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="0" style="margin-top:5px; border:1px solid #cbd5e1;">
            {{-- Baris 1 --}}
            <tr>
                <td width="32%" valign="top"
                    style="padding:6px 8px; border-right:1px solid #e2e8f0; border-bottom:1px solid #e2e8f0;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">NAMA LENGKAP KARYAWAN</div>
                    <div style="font-size:11px; font-weight:bold; color:#0f172a; margin-top:2px;">{{ $user['name'] }}
                    </div>
                </td>
                <td width="20%" valign="top"
                    style="padding:6px 8px; border-right:1px solid #e2e8f0; border-bottom:1px solid #e2e8f0;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">JENIS KELAMIN</div>
                    <div style="font-size:9px; font-weight:bold; margin-top:2px;">{{ $user['jk'] }}</div>
                </td>
                <td width="14%" valign="top"
                    style="padding:6px 8px; border-right:1px solid #e2e8f0; border-bottom:1px solid #e2e8f0;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">AGAMA</div>
                    <div style="font-size:9px; font-weight:bold; margin-top:2px;">{{ $user['religion'] }}</div>
                </td>
                <td width="34%" valign="top" style="padding:6px 8px; border-bottom:1px solid #e2e8f0;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">KONTAK DARURAT (EMERGENCY
                        CONTACT)</div>
                    <div style="font-size:9px; font-weight:bold; margin-top:2px;">{{ $user['emergency'] }}</div>
                </td>
            </tr>
            {{-- Baris 2 --}}
            <tr>
                <td valign="top"
                    style="padding:6px 8px; border-right:1px solid #e2e8f0; border-bottom:1px solid #e2e8f0;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">NIK (KTP)</div>
                    <div style="font-size:8.5px; font-weight:bold; font-family:Courier, monospace; margin-top:2px;">
                        {{ $user['nik'] }}</div>
                </td>
                <td colspan="2" valign="top"
                    style="padding:6px 8px; border-right:1px solid #e2e8f0; border-bottom:1px solid #e2e8f0;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">ALAMAT DOMISILI</div>
                    <div style="font-size:8.5px; font-weight:bold; margin-top:2px;">{{ $user['address'] }}</div>
                </td>
                <td valign="top" style="padding:6px 8px; border-bottom:1px solid #e2e8f0;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">STATUS TK</div>
                    <div style="font-size:9px; font-weight:bold; margin-top:2px;">{{ $user['status'] }}</div>
                </td>
            </tr>
            {{-- Baris 3 --}}
            <tr>
                <td valign="top"
                    style="padding:6px 8px; border-right:1px solid #e2e8f0; border-bottom:1px solid #e2e8f0;">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="50%" valign="top">
                                <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">DIVISI / UNIT</div>
                                <div style="font-size:9px; font-weight:bold; margin-top:2px;">{{ $user['division'] }}
                                </div>
                            </td>
                            <td width="50%" valign="top">
                                <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">JABATAN</div>
                                <div style="font-size:9px; font-weight:bold; margin-top:2px;">{{ $user['position'] }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2" valign="top"
                    style="padding:6px 8px; border-right:1px solid #e2e8f0; border-bottom:1px solid #e2e8f0;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">NO. HANDPHONE / WHATSAPP</div>
                    <div style="font-size:8.5px; font-weight:bold; font-family:Courier, monospace; margin-top:2px;">
                        {{ $user['phone'] }}</div>
                </td>
                <td valign="top" style="padding:6px 8px; border-bottom:1px solid #e2e8f0;">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="50%" valign="top">
                                <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">BPJS KETENAGAKERJAAN
                                </div>
                                <div
                                    style="font-size:8.5px; font-weight:bold; font-family:Courier, monospace; margin-top:2px;">
                                    {{ $user['bpjsker'] }}</div>
                            </td>
                            <td width="50%" valign="top">
                                <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">BPJS KESEHATAN</div>
                                <div
                                    style="font-size:8.5px; font-weight:bold; font-family:Courier, monospace; margin-top:2px;">
                                    {{ $user['bpjskes'] }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            {{-- Baris 4 --}}
            <tr>
                <td valign="top" style="padding:6px 8px; border-right:1px solid #e2e8f0;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">TEMPAT, TANGGAL LAHIR
                    </div>
                    <div style="font-size:9px; font-weight:bold; margin-top:2px;">{{ $user['ttl'] }}</div>
                </td>
                <td colspan="2" valign="top" style="padding:6px 8px; border-right:1px solid #e2e8f0;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">EMAIL</div>
                    <div style="font-size:8.5px; font-weight:bold; margin-top:2px;">{{ $user['email'] }}</div>
                </td>
                <td valign="top" style="padding:6px 8px;">
                    <div style="font-size:6.5px; color:#94a3b8; letter-spacing:0.5px;">REKENING</div>
                    <div style="font-size:8.5px; font-weight:bold; margin-top:2px;"><span
                            style="font-family:Courier, monospace;">{{ $user['bank'] }}</span></div>
                </td>
            </tr>
        </table>

        {{-- ================= 2. RIWAYAT KONTRAK ================= --}}
        <table width="100%" cellspacing="0" cellpadding="0" style="margin-top:14px;">
            <tr>
                <td style="font-size:10px; font-weight:bold; color:#1e3a8a;">
                    <span style="color:#1e3a8a;"></span> 2. RIWAYAT &amp; REKAP LENGKAP KONTRAK KERJA (SEMUA
                    KONTRAK)
                </td>
            </tr>
            <tr>
                <td style="font-size:7px; color:#94a3b8; font-style:italic; padding-top:1px;">
                    Rekapitulasi riwayat perjanjian kerja dari awal bergabung hingga status penugasan terkini.
                </td>
            </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="0"
            style="margin-top:5px; border:1px solid #cbd5e1; border-collapse:collapse;">
            <thead>
                <tr style="background:#1e3a8a; color:#ffffff;">
                    <th width="4%"
                        style="padding:6px 3px; font-size:7px; text-align:center; border-right:1px solid #3b5bb5;">NO
                    </th>
                    <th width="22%"
                        style="padding:6px 5px; font-size:7px; text-align:left;   border-right:1px solid #3b5bb5;">
                        KONTRAK</th>
                    <th width="20%"
                        style="padding:6px 5px; font-size:7px; text-align:left;   border-right:1px solid #3b5bb5;">TIPE
                        &amp; JABATAN</th>
                    <th width="10%"
                        style="padding:6px 3px; font-size:7px; text-align:center; border-right:1px solid #3b5bb5;">
                        TANGGAL<br>IN</th>
                    <th width="10%"
                        style="padding:6px 3px; font-size:7px; text-align:center; border-right:1px solid #3b5bb5;">
                        TANGGAL<br>EXP</th>
                    <th width="8%"
                        style="padding:6px 3px; font-size:7px; text-align:center; border-right:1px solid #3b5bb5;">
                        DURASI</th>
                    <th width="14%"
                        style="padding:6px 3px; font-size:7px; text-align:center; border-right:1px solid #3b5bb5;">
                        STATUS<br>KONTRAK</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contracts as $index => $contract)
                    <tr style="background:#ffffff;">
                        <td align="center" valign="middle"
                            style="padding:7px 3px; border-bottom:1px solid #e2e8f0; border-right:1px solid #e2e8f0; font-weight:bold;">
                            {{ $index + 1 }}</td>
                        <td valign="middle"
                            style="padding:7px 5px; border-bottom:1px solid #e2e8f0; border-right:1px solid #e2e8f0;">
                            <div style="font-size:8px; font-weight:bold; font-family:Courier, monospace;">
                                {{ $contract['kontrak'] }}</div>
                        </td>
                        <td valign="middle"
                            style="padding:7px 5px; border-bottom:1px solid #e2e8f0; border-right:1px solid #e2e8f0;">
                            <div style="font-size:8.5px; font-weight:bold;">{{ $user['division'] }}</div>
                            <div style="font-size:6.5px; color:#64748b; margin-top:2px;">{{ $user['position'] }}</div>
                        </td>
                        <td align="center" valign="middle"
                            style="padding:7px 3px; border-bottom:1px solid #e2e8f0; border-right:1px solid #e2e8f0; font-family:Courier, monospace; font-size:8px; font-weight:bold;">
                            {{ $contract['in'] }}</td>
                        <td align="center" valign="middle"
                            style="padding:7px 3px; border-bottom:1px solid #e2e8f0; border-right:1px solid #e2e8f0; font-family:Courier, monospace; font-size:8px; font-weight:bold;">
                            {{ $contract['expired'] }}</td>
                        <td align="center" valign="middle"
                            style="padding:7px 3px; border-bottom:1px solid #e2e8f0; border-right:1px solid #e2e8f0; font-size:8px;">
                            {{ $contract['duration'] }}</td>
                        <td align="center" valign="middle"
                            style="padding:7px 3px; border-bottom:1px solid #e2e8f0; border-right:1px solid #e2e8f0;">
                            {{ $contract['status'] }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{-- ================= FOOTER ================= --}}
        <table width="100%" cellspacing="0" cellpadding="0"
            style="margin-top:14px; border-top:1px solid #cbd5e1;">
            <tr>
                <td style="padding-top:4px; font-size:6.5px; color:#94a3b8;">
                    BEMP-ERP-SISTEM &bull; DOC: HR-DOS/2026&bull; Dokumen rahasia, hanya untuk keperluan internal
                    perusahaan.
                </td>
                <td align="right" style="padding-top:4px; font-size:6.5px; color:#94a3b8;">
                    Dicetak: {{ $tanggal }}
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
