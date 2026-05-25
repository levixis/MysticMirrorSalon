<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #0a0a0a; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #0a0a0a; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #1a1a1a; border: 1px solid rgba(201,168,76,0.3); border-radius: 16px; overflow: hidden;">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1a1505, #0a0a0a); padding: 40px 30px; text-align: center; border-bottom: 2px solid #c9a84c;">
                            <h1 style="font-family: 'Georgia', serif; font-size: 32px; color: #c9a84c; margin: 0 0 5px; letter-spacing: 1px;">
                                🔑 Mystic Mirror
                            </h1>
                            <p style="color: #b0a890; font-size: 14px; margin: 0; letter-spacing: 3px; text-transform: uppercase;">
                                Password Reset
                            </p>
                        </td>
                    </tr>

                    <!-- Message -->
                    <tr>
                        <td style="padding: 30px 30px 10px;">
                            <h2 style="color: #f5f0e8; font-size: 20px; margin: 0 0 15px;">Reset Your Admin Password</h2>
                            <p style="color: #b0a890; font-size: 15px; line-height: 1.6; margin: 0;">
                                You requested a password reset for the Mystic Mirror admin panel. Click the button below to set a new password.
                            </p>
                        </td>
                    </tr>

                    <!-- CTA Button -->
                    <tr>
                        <td style="padding: 20px 30px 30px; text-align: center;">
                            <a href="{{ $resetUrl }}" style="display: inline-block; background: linear-gradient(135deg, #c9a84c, #a08630); color: #0a0a0a; padding: 14px 40px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 15px;">
                                Reset Password
                            </a>
                            <p style="color: #666; font-size: 12px; margin-top: 20px;">
                                This link expires in <strong style="color: #c9a84c;">30 minutes</strong>. If you didn't request this, ignore this email.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background: #111; padding: 20px 30px; text-align: center; border-top: 1px solid rgba(201,168,76,0.15);">
                            <p style="color: #666; font-size: 12px; margin: 0;">
                                Mystic Mirror Salon ✨
                            </p>
                            <p style="color: #444; font-size: 11px; margin: 8px 0 0;">
                                &copy; {{ date('Y') }} Mystic Mirror Salon. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
