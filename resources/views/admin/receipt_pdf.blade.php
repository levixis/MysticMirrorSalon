<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #1a1a1a;
            font-size: 13px;
            line-height: 1.5;
        }
        .receipt {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
        }
        /* Header */
        .header {
            text-align: center;
            border-bottom: 2px solid #c9a84c;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .salon-name {
            font-size: 28px;
            color: #c9a84c;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 2px;
        }
        .salon-subtitle {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 8px;
        }
        .salon-address {
            font-size: 11px;
            color: #888;
        }
        .receipt-title {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #333;
            margin-top: 15px;
        }

        /* Customer Info */
        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            font-weight: bold;
            color: #555;
            padding: 3px 15px 3px 0;
            width: 120px;
            font-size: 12px;
        }
        .info-value {
            display: table-cell;
            color: #1a1a1a;
            padding: 3px 0;
            font-size: 12px;
        }

        /* Services Table */
        .services-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .services-table th {
            background: #c9a84c;
            color: #fff;
            padding: 10px 12px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .services-table th:last-child {
            text-align: right;
        }
        .services-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
            font-size: 12px;
        }
        .services-table td:last-child {
            text-align: right;
            font-weight: bold;
        }
        .services-table tr:nth-child(even) td {
            background: #fafafa;
        }

        /* Total */
        .total-section {
            border-top: 2px solid #c9a84c;
            padding-top: 12px;
            margin-bottom: 30px;
        }
        .total-row {
            display: table;
            width: 100%;
        }
        .total-label {
            display: table-cell;
            text-align: right;
            padding-right: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .total-value {
            display: table-cell;
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            color: #c9a84c;
            width: 150px;
        }

        /* Footer */
        .footer {
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            color: #999;
            font-size: 11px;
        }
        .footer .thankyou {
            font-size: 14px;
            color: #c9a84c;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <!-- Header -->
        <div class="header">
            <div class="salon-name">MYSTIC MIRROR</div>
            <div class="salon-subtitle">Unisex Salon by Arjeena</div>
            <div class="salon-address">
                1st Floor, SCO-1, Puda Complex, Ladowali Road, Jalandhar - 144001<br>
                Phone: 7814748721
            </div>
            <div class="receipt-title">— Receipt —</div>
        </div>

        <!-- Customer Info -->
        <div class="info-section">
            <div class="info-row">
                <span class="info-label">Receipt No:</span>
                <span class="info-value">#{{ str_pad($receipt->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Date:</span>
                <span class="info-value">{{ $receipt->created_at->format('d M Y, h:i A') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Customer:</span>
                <span class="info-value">{{ $receipt->customer_name }}</span>
            </div>
            @if($receipt->phone)
            <div class="info-row">
                <span class="info-label">Phone:</span>
                <span class="info-value">{{ $receipt->phone }}</span>
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Payment:</span>
                <span class="info-value">{{ ucfirst($receipt->payment_method) }}</span>
            </div>
        </div>

        <!-- Services -->
        <table class="services-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($receipt->services as $index => $service)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $service['name'] }}</td>
                    <td>₹{{ number_format($service['price']) }}/-</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total -->
        <div class="total-section">
            @if($receipt->discount_percent > 0)
            <div class="total-row" style="margin-bottom: 8px;">
                <span class="total-label" style="font-size: 13px; color: #666;">Subtotal:</span>
                <span class="total-value" style="font-size: 14px; color: #333;">₹{{ number_format($receipt->subtotal) }}/-</span>
            </div>
            <div class="total-row" style="margin-bottom: 12px;">
                <span class="total-label" style="font-size: 13px; color: #22a55e;">Discount ({{ $receipt->discount_percent }}%):</span>
                <span class="total-value" style="font-size: 14px; color: #22a55e;">- ₹{{ number_format($receipt->subtotal - $receipt->total) }}</span>
            </div>
            @endif
            <div class="total-row">
                <span class="total-label">Grand Total:</span>
                <span class="total-value">₹{{ number_format($receipt->total) }}/-</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="thankyou">Thank you for visiting Mystic Mirror!</div>
            <p>We look forward to seeing you again.</p>
        </div>
    </div>
</body>
</html>
