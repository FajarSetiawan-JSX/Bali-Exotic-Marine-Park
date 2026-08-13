<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>
</head>

<body
    style="
        margin:0;
        padding:0;
        background:#eef3f8;
        font-family:Arial,Helvetica,sans-serif;
    ">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 20px;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="
                        background:#ffffff;
                        border-radius:18px;
                        overflow:hidden;
                        box-shadow:0 10px 35px rgba(0,0,0,.08);
                    ">

                    <!-- Header -->
                    <tr>
                        <td align="center"
                            style="
                                background:linear-gradient(135deg,#0f172a,#0f766e);
                                padding:40px 30px;
                            ">

                            <h1
                                style="
                                    margin:0;
                                    color:#ffffff;
                                    font-size:30px;
                                    font-weight:bold;
                                ">
                                Bali Exotic Marine Park
                            </h1>

                            <p
                                style="
                                    margin-top:12px;
                                    color:rgba(255,255,255,.85);
                                    font-size:15px;
                                ">
                                Secure Account Verification
                            </p>

                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:45px;">

                            <h2
                                style="
                                    margin-top:0;
                                    color:#0f172a;
                                ">
                                Verification Code
                            </h2>

                            <p
                                style="
                                    color:#475569;
                                    line-height:1.8;
                                    font-size:15px;
                                ">
                                Hello,
                            </p>

                            <p
                                style="
                                    color:#475569;
                                    line-height:1.8;
                                    font-size:15px;
                                ">
                                We received a request to verify your identity.
                                Please enter the verification code below to continue.
                            </p>

                            <!-- OTP -->

                            <div
                                style="
                                    margin:40px 0;
                                    text-align:center;
                                ">

                                <div
                                    style="
                                        display:inline-block;
                                        padding:18px 42px;
                                        border-radius:14px;
                                        background:#f8fafc;
                                        border:2px dashed #0ea5e9;
                                        color:#0f172a;
                                        font-size:40px;
                                        font-weight:bold;
                                        letter-spacing:10px;
                                    ">
                                    {{ $otp }}
                                </div>

                            </div>

                            <!-- Notice -->

                            <div
                                style="
                                    background:#f8fafc;
                                    border-left:4px solid #0ea5e9;
                                    padding:18px;
                                    border-radius:8px;
                                ">

                                <p
                                    style="
                                        margin:0;
                                        color:#334155;
                                        line-height:1.8;
                                        font-size:14px;
                                    ">
                                    • This verification code is valid for
                                    <strong>5 minutes</strong>.
                                    <br><br>

                                    • This code can only be used
                                    <strong>once</strong>.
                                    <br><br>

                                    • Never share this code with anyone.
                                    Bali Exotic Marine Park will never ask for
                                    your verification code.
                                </p>

                            </div>

                            <p
                                style="
                                    margin-top:30px;
                                    color:#64748b;
                                    line-height:1.8;
                                    font-size:14px;
                                ">
                                If you did not request this verification code,
                                you can safely ignore this email.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->

                    <tr>
                        <td align="center"
                            style="
                                background:#f8fafc;
                                padding:30px;
                                border-top:1px solid #e2e8f0;
                            ">

                            <p
                                style="
                                    margin:0;
                                    color:#334155;
                                    font-size:14px;
                                    font-weight:600;
                                ">
                                Bali Exotic Marine Park
                            </p>

                            <p
                                style="
                                    margin-top:8px;
                                    color:#94a3b8;
                                    font-size:13px;
                                ">
                                This is an automated email. Please do not reply to this message.
                            </p>

                            <p
                                style="
                                    margin-top:18px;
                                    color:#cbd5e1;
                                    font-size:12px;
                                ">
                                © {{ date('Y') }} Bali Exotic Marine Park. All rights reserved.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
