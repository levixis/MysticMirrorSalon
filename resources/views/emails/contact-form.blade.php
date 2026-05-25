<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f0e8; color: #1a1a1a; }
        .wrapper { max-width: 600px; margin: 0 auto; padding: 20px; }
        .card { background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #1a1510, #2d2418); padding: 30px; text-align: center; }
        .header h1 { color: #c9a84c; font-size: 28px; font-weight: 300; letter-spacing: 2px; }
        .header p { color: #b0a890; font-size: 13px; margin-top: 6px; text-transform: uppercase; letter-spacing: 3px; }
        .badge { display: inline-block; background: rgba(201,168,76,0.15); border: 1px solid rgba(201,168,76,0.3); color: #c9a84c; padding: 6px 16px; border-radius: 50px; font-size: 12px; font-weight: 600; margin-top: 15px; letter-spacing: 1px; }
        .body { padding: 30px; }
        .info-row { display: flex; padding: 14px 0; border-bottom: 1px solid #f0ebe3; }
        .info-row:last-of-type { border-bottom: none; }
        .info-label { font-weight: 600; color: #888; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; width: 100px; flex-shrink: 0; padding-top: 2px; }
        .info-value { color: #1a1a1a; font-size: 15px; line-height: 1.5; }
        .message-box { background: #faf8f4; border: 1px solid #ede8df; border-radius: 10px; padding: 18px; margin-top: 12px; }
        .message-box p { color: #333; font-size: 14px; line-height: 1.8; white-space: pre-wrap; }
        .footer { text-align: center; padding: 20px 30px; background: #faf8f4; border-top: 1px solid #ede8df; }
        .footer p { color: #999; font-size: 12px; }
        .footer .brand { color: #c9a84c; font-weight: 600; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <div class="header">
                <h1>Mystic Mirror</h1>
                <p>Unisex Salon</p>
                <div class="badge">📩 New Contact Message</div>
            </div>
            <div class="body">
                <div class="info-row">
                    <span class="info-label">Name</span>
                    <span class="info-value">{{ $data['name'] }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value"><a href="mailto:{{ $data['email'] }}" style="color: #c9a84c; text-decoration: none;">{{ $data['email'] }}</a></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Phone</span>
                    <span class="info-value"><a href="tel:{{ $data['phone'] }}" style="color: #c9a84c; text-decoration: none;">{{ $data['phone'] }}</a></span>
                </div>
                <div class="info-row" style="flex-direction: column;">
                    <span class="info-label" style="margin-bottom: 8px;">Message</span>
                    <div class="message-box">
                        <p>{{ $data['message'] }}</p>
                    </div>
                </div>
            </div>
            <div class="footer">
                <p>This message was sent from the <span class="brand">Mystic Mirror</span> website contact form.</p>
                <p style="margin-top: 4px;">You can reply directly to this email to respond to the customer.</p>
            </div>
        </div>
    </div>
</body>
</html>
