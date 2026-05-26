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
                                ✨ Mystic Mirror
                            </h1>
                            <p style="color: #b0a890; font-size: 14px; margin: 0; letter-spacing: 3px; text-transform: uppercase;">
                                Unisex Salon
                            </p>
                        </td>
                    </tr>

                    <!-- Success Badge -->
                    <tr>
                        <td style="padding: 30px 30px 10px; text-align: center;">
                            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); border-radius: 50px; display: inline-block; padding: 8px 24px;">
                                <span style="color: #22c55e; font-size: 14px; font-weight: 600;">✅ APPOINTMENT APPROVED</span>
                            </div>
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td style="padding: 20px 30px 10px;">
                            <h2 style="color: #f5f0e8; font-size: 22px; margin: 0;">
                                Hello, {{ $appointment->customer_name }}! 👋
                            </h2>
                            <p style="color: #b0a890; font-size: 15px; line-height: 1.6; margin-top: 10px;">
                                Great news! Your appointment at Mystic Mirror Salon has been <strong style="color: #22c55e;">approved</strong>. We're excited to see you!
                            </p>
                        </td>
                    </tr>

                    <!-- Appointment Details -->
                    <tr>
                        <td style="padding: 10px 30px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background: rgba(201,168,76,0.05); border: 1px solid rgba(201,168,76,0.2); border-radius: 12px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 20px 24px; border-bottom: 1px solid rgba(201,168,76,0.1);">
                                        <p style="color: #888; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 5px;">Service</p>
                                        <p style="color: #c9a84c; font-size: 16px; font-weight: 600; margin: 0;">
                                            {{ $appointment->service->name }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 24px; border-bottom: 1px solid rgba(201,168,76,0.1);">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="50%">
                                                    <p style="color: #888; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 5px;">📅 Date</p>
                                                    <p style="color: #f5f0e8; font-size: 15px; margin: 0;">
                                                        {{ $appointment->appointment_date->format('d M Y') }}
                                                    </p>
                                                </td>
                                                <td width="50%">
                                                    <p style="color: #888; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 5px;">⏰ Time</p>
                                                    <p style="color: #f5f0e8; font-size: 15px; margin: 0;">
                                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 24px;">
                                        <p style="color: #888; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 5px;">💰 Price</p>
                                        <p style="color: #c9a84c; font-size: 20px; font-weight: 700; margin: 0;">
                                            ₹{{ $appointment->service->price }}/-
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Location -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background: #111; border-radius: 10px; padding: 16px;">
                                <tr>
                                    <td style="padding: 16px;">
                                        <p style="color: #c9a84c; font-size: 13px; font-weight: 600; margin: 0 0 5px;">📍 Location</p>
                                        <p style="color: #b0a890; font-size: 14px; margin: 0; line-height: 1.5;">
                                            1st Floor, SCO-1, Puda Complex,<br>
                                            Ladowali Road, Jalandhar, 144001
                                        </p>
                                        <p style="color: #c9a84c; font-size: 14px; margin: 10px 0 0;">
                                            📞 8558999480
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background: #111; padding: 20px 30px; text-align: center; border-top: 1px solid rgba(201,168,76,0.15);">
                            <p style="color: #666; font-size: 12px; margin: 0;">
                                Thank you for choosing Mystic Mirror Salon ✨
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
