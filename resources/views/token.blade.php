<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>

<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;background:#f3f4f6;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.08);">

                    <tr>
                        <td style="background:linear-gradient(90deg,#6366F1,#A855F7);padding:30px;text-align:center;">
                            <h1 style="margin:0;color:#ffffff;font-size:28px;">
                                🔐 Password Reset
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:40px;color:#374151;">

                            <h2 style="margin-top:0;">
                                Hello!
                            </h2>

                            <p style="line-height:1.8;">
                                We received a request to reset your account password.
                                Click the button below to create a new password.
                            </p>

                            <div style="text-align:center;margin:40px 0;">

                                <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}"
                                    style="
                                    display:inline-block;
                                    background:#6366F1;
                                    color:#ffffff;
                                    text-decoration:none;
                                    padding:15px 40px;
                                    border-radius:10px;
                                    font-weight:bold;
                                    font-size:16px;">
                                    Reset Password
                                </a>

                            </div>

                            <p style="line-height:1.8;">
                                This link will expire in
                                <strong>5 minutes</strong>.
                            </p>

                            <p style="line-height:1.8;">
                                If you did not request a password reset,
                                you can safely ignore this email.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#f9fafb;padding:20px;text-align:center;font-size:12px;color:#9ca3af;">
                            © {{ date('Y') }} Bali Exotic Marine Park. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
