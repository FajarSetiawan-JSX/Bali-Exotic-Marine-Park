<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page {
            size: A4 landscape;
            margin: 8mm 10mm;
        }
    </style>
    <title>Document</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 6px; color: #172033; margin: 0;">

    {{-- HEADER --}}
    <div
        style="
        display: table;
        width: 100%;
        border-bottom: 1px solid #cbd5e1;
        padding-bottom: 7px;
        margin-bottom: 8px;
    ">

        {{-- KIRI --}}
        <div
            style="
            display: table-cell;
            width: 65%;
            vertical-align: middle;
        ">

            <img src="{{ public_path('BEMP.png') }}" alt="Logo-BEMP"
                style="
                    width: 40px;
                    height: 40px;
                    float: left;
                    margin-right: 10px;
                ">

            <div
                style="
                font-size: 15px;
                font-weight: bold;
                color: #09294b;
            ">
                BALI EXOTIC MARINE PARK
            </div>

            <div
                style="
                font-size: 6.5px;
                font-weight: bold;
                letter-spacing: 0.4px;
                color: #1685bd;
                margin-top: 2px;
            ">
                LIFE WITH EXOTIC
            </div>

            <div
                style="
                font-size: 5.5px;
                color: #64748b;
                margin-top: 2px;
            ">
                Jalan Bali Eksotik No.8, Pedungan Denpasar City, Bali – 80222
            </div>

        </div>


        {{-- KANAN --}}
        <div
            style="
            display: table-cell;
            width: 35%;
            text-align: right;
            vertical-align: middle;
        ">

            <div
                style="
                font-size: 6px;
                color: #475569;
                font-weight: bold;
            ">
                FORM: BEMP-ERP-SISTEM
            </div>

            <div
                style="
                font-size: 9px;
                font-weight: bold;
                color: #09294b;
                margin-top: 4px;
            ">
                ALL DATA USERS
            </div>

        </div>

    </div>


    {{-- INFO --}}
    <div
        style="
        width: 100%;
        border: 1px solid #dbe3ec;
        background: #f8fafc;
        margin-bottom: 8px;
        padding: 6px 8px;
    ">

        <table style="
            width: 100%;
            border-collapse: collapse;
        ">

            <tr>

                <td
                    style="
                    width: 25%;
                    padding-right: 10px;
                    vertical-align: top;
                ">
                    <div
                        style="
                        font-size: 5.5px;
                        color: #64748b;
                        margin-bottom: 2px;
                    ">
                        Tanggal Cetak:
                    </div>

                    <div
                        style="
                        font-size: 6px;
                        font-weight: bold;
                        color: #0f172a;
                    ">
                        {{ $tanggal }}
                    </div>
                </td>


                <td
                    style="
                    width: 25%;
                    padding-right: 10px;
                    vertical-align: top;
                ">
                    <div
                        style="
                        font-size: 5.5px;
                        color: #64748b;
                        margin-bottom: 2px;
                    ">
                        Dicetak Oleh:
                    </div>

                    <div
                        style="
                        font-size: 6px;
                        font-weight: bold;
                        color: #0f172a;
                    ">
                        {{ $by }}
                    </div>
                </td>


                <td
                    style="
                    width: 25%;
                    padding-right: 10px;
                    vertical-align: top;
                ">
                    <div
                        style="
                        font-size: 5.5px;
                        color: #64748b;
                        margin-bottom: 2px;
                    ">
                        Division
                    </div>

                    <div
                        style="
                        font-size: 6px;
                        font-weight: bold;
                        color: #0f172a;
                    ">
                        All Division
                    </div>
                </td>


                <td style="
                    width: 25%;
                    vertical-align: top;
                ">
                    <div
                        style="
                        font-size: 5.5px;
                        color: #64748b;
                        margin-bottom: 2px;
                    ">
                        Total Users
                    </div>

                    <div
                        style="
                        font-size: 6px;
                        font-weight: bold;
                        color: #047857;
                    ">
                        {{ $total }} Users
                    </div>
                </td>

            </tr>

        </table>

    </div>


    {{-- DATA --}}
    <table style="
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    ">

        <thead>

            <tr>

                <th
                    style="
                    width: 3%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                    text-align: center;
                ">
                    NO
                </th>

                <th
                    style="
                    width: 5%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    NIK
                </th>

                <th
                    style="
                    width: 6%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    NAMA<br>LENGKAP
                </th>

                <th
                    style="
                    width: 5%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    DIVISI
                </th>

                <th
                    style="
                    width: 6%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    JABATAN
                </th>

                <th
                    style="
                    width: 5%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    TTL
                </th>

                <th
                    style="
                    width: 3%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    AGAMA
                </th>

                <th
                    style="
                    width: 2.5%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                    text-align: center;
                ">
                    JK
                </th>

                <th
                    style="
                    width: 7%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    ALAMAT<br>DOMISILI
                </th>

                <th
                    style="
                    width: 3.5%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                    text-align: center;
                ">
                    STATUS<br>TK
                </th>

                <th
                    style="
                    width: 4%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    NO.<br>HP / WA
                </th>

                <th
                    style="
                    width: 8%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    EMAIL
                </th>

                <th
                    style="
                    width: 8%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    KONTAK<br>DARURAT
                </th>

                <th
                    style="
                    width: 7%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    NO.<br>REKENING
                </th>

                <th
                    style="
                    width: 6%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    BPJS KES.
                </th>

                <th
                    style="
                    width: 6%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    BPJS TK
                </th>

                <th
                    style="
                    width: 4.5%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    TANGGAL<br>IN
                </th>

                <th
                    style="
                    width: 4.5%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    KONTRAK<br>IN
                </th>

                <th
                    style="
                    width: 5%;
                    background: #09294b;
                    color: white;
                    border: 1px solid #cbd5e1;
                    padding: 5px 3px;
                    font-size: 5.2px;
                ">
                    KONTRAK<br>EXP
                </th>

            </tr>

        </thead>


        <tbody>
            @foreach ($users as $index => $item)
                <tr>
                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px; text-align: center;">
                        {{ $index + 1 }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['nik'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['name'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['division'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['position'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['ttl'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['religion'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px; text-align: center;">
                        {{ $item['jk'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['address'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px; text-align: center;">
                        {{ $item['status'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['phone'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['email'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['emergency'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['bank'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['bpjskes'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px;">
                        {{ $item['bpjsker'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px; text-align: center;">
                        {{ $item['in'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px; text-align: center;">
                        {{ $item['kontrak_in'] }}
                    </td>

                    <td style="border: 1px solid #cbd5e1; padding: 3px; font-size: 5.2px; text-align: center;">
                        {{ $item['kontrak_exp'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</body>

</html>
