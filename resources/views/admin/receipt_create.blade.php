<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Receipt - Mystic Mirror Salon</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a;
            color: #f5f0e8;
            min-height: 100vh;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(201,168,76,0.03) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(201,168,76,0.02) 0%, transparent 50%);
            pointer-events: none;
        }
        .admin-nav {
            background: rgba(17,17,17,0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(201,168,76,0.3);
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .admin-nav-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
        }
        .admin-nav .brand {
            font-family: 'Great Vibes', cursive;
            font-size: 1.6rem;
            color: #c9a84c;
            text-decoration: none;
        }
        .admin-nav .brand span {
            font-family: 'Inter', sans-serif;
            font-size: 0.75rem;
            color: #b0a890;
            margin-left: 0.5rem;
            background: rgba(201,168,76,0.15);
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .back-link {
            color: #b0a890;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s;
        }
        .back-link:hover { color: #c9a84c; }

        .admin-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: #c9a84c;
            margin-bottom: 0.5rem;
        }
        .page-subtitle {
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .form-card {
            background: #1a1a1a;
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 1.5rem;
        }
        .form-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: #c9a84c;
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid rgba(201,168,76,0.15);
        }
        .form-group {
            margin-bottom: 1.2rem;
        }
        .form-group label {
            display: block;
            color: #b0a890;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background: #111;
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: 8px;
            color: #f5f0e8;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #c9a84c;
            box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
        }
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23c9a84c' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* Services Checkboxes */
        .services-section h3 {
            color: #c9a84c;
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            margin-bottom: 0.8rem;
        }
        .service-checkbox {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 1rem;
            border: 1px solid rgba(201,168,76,0.1);
            border-radius: 8px;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        .service-checkbox:hover {
            border-color: rgba(201,168,76,0.3);
            background: rgba(201,168,76,0.05);
        }
        .service-checkbox.selected {
            border-color: #c9a84c;
            background: rgba(201,168,76,0.1);
        }
        .service-checkbox input[type="checkbox"] {
            display: none;
        }
        .service-checkbox .service-info {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        .service-checkbox .check-box {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(201,168,76,0.3);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            flex-shrink: 0;
        }
        .service-checkbox.selected .check-box {
            background: #c9a84c;
            border-color: #c9a84c;
        }
        .service-checkbox .check-box i {
            color: #0a0a0a;
            font-size: 0.7rem;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .service-checkbox.selected .check-box i {
            opacity: 1;
        }
        .service-checkbox .service-name {
            color: #e8e0d0;
            font-size: 0.9rem;
        }
        .service-checkbox .service-price {
            color: #c9a84c;
            font-weight: 700;
            font-size: 0.95rem;
        }
        .gender-label {
            color: #888;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 1rem 0 0.5rem;
            padding-left: 0.5rem;
        }

        /* Total Display */
        .total-display {
            background: rgba(201,168,76,0.1);
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }
        .total-label {
            font-size: 1rem;
            font-weight: 600;
            color: #b0a890;
        }
        .total-amount {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: #c9a84c;
        }

        /* Submit */
        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #c9a84c, #9e7b2a);
            color: #0a0a0a;
            border: none;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1.5rem;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(201,168,76,0.3);
        }

        .error-text {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
            .admin-content { padding: 1rem; }
        }
    </style>
</head>
<body>
    <nav class="admin-nav">
        <div class="admin-nav-inner">
            <a href="{{ route('admin.dashboard') }}" class="brand">
                Mystic Mirror <span>Admin</span>
            </a>
            <a href="{{ route('admin.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </nav>

    <div class="admin-content">
        <h1 class="page-title"><i class="fas fa-receipt"></i> Generate Receipt</h1>
        <p class="page-subtitle">Select services and enter customer details to generate a PDF receipt</p>

        @if($errors->any())
            <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #ef4444; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem;">
                <i class="fas fa-exclamation-circle"></i>
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.receipt.store') }}" method="POST" id="receiptForm">
            @csrf

            <!-- Customer Details -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-user"></i> Customer Details</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Customer Name *</label>
                        <input type="text" name="customer_name" class="form-control" placeholder="Enter customer name" value="{{ old('customer_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Payment Method *</label>
                    <select name="payment_method" class="form-control" required>
                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>💵 Cash</option>
                        <option value="upi" {{ old('payment_method') == 'upi' ? 'selected' : '' }}>📱 UPI</option>
                        <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>💳 Card</option>
                    </select>
                </div>
            </div>

            <!-- Select Services -->
            <div class="form-card">
                <div class="form-card-title"><i class="fas fa-scissors"></i> Select Services</div>

                <!-- Search Bar -->
                <div class="form-group" style="position: relative; margin-bottom: 1rem;">
                    <div style="position: relative;">
                        <i class="fas fa-search" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #888; font-size: 0.85rem;"></i>
                        <input type="text" id="serviceSearch" class="form-control" placeholder="Search services... e.g. Haircut, Facial, Spa"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;" autocomplete="off">
                        <button type="button" id="clearSearch" onclick="clearServiceSearch()" 
                            style="position: absolute; right: 0.8rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #888; cursor: pointer; font-size: 1rem; display: none;">&times;</button>
                    </div>
                    <div id="searchCount" style="color: #888; font-size: 0.75rem; margin-top: 0.4rem; display: none;"></div>
                </div>

                @php
                    $menServices = $services->where('gender', 'men');
                    $womenServices = $services->where('gender', 'women');
                @endphp

                <div id="noResults" style="text-align: center; color: #888; padding: 2rem 0; display: none;">
                    <i class="fas fa-search" style="font-size: 1.5rem; color: #555; display: block; margin-bottom: 0.5rem;"></i>
                    No services found. Try a different search term.
                </div>

                @if($menServices->count())
                    <div class="gender-label" data-gender-label="men"><i class="fas fa-male"></i> Men's Services</div>
                    @foreach($menServices as $service)
                        <label class="service-checkbox" onclick="toggleService(this)" data-service-name="{{ strtolower($service->name) }}" data-gender="men">
                            <div class="service-info">
                                <div class="check-box"><i class="fas fa-check"></i></div>
                                <span class="service-name">{{ $service->name }}</span>
                            </div>
                            <span class="service-price">₹{{ number_format($service->price) }}/-</span>
                            <input type="checkbox" name="service_ids[]" value="{{ $service->id }}" data-price="{{ $service->price }}"
                                {{ is_array(old('service_ids')) && in_array($service->id, old('service_ids')) ? 'checked' : '' }}>
                        </label>
                    @endforeach
                @endif

                @if($womenServices->count())
                    <div class="gender-label" data-gender-label="women"><i class="fas fa-female"></i> Women's Services</div>
                    @foreach($womenServices as $service)
                        <label class="service-checkbox" onclick="toggleService(this)" data-service-name="{{ strtolower($service->name) }}" data-gender="women">
                            <div class="service-info">
                                <div class="check-box"><i class="fas fa-check"></i></div>
                                <span class="service-name">{{ $service->name }}</span>
                            </div>
                            <span class="service-price">₹{{ number_format($service->price) }}/-</span>
                            <input type="checkbox" name="service_ids[]" value="{{ $service->id }}" data-price="{{ $service->price }}"
                                {{ is_array(old('service_ids')) && in_array($service->id, old('service_ids')) ? 'checked' : '' }}>
                        </label>
                    @endforeach
                @endif

                <!-- Discount -->
                <div class="form-card" style="margin-top: 1rem; padding: 1.5rem; border-radius: 10px;">
                    <div class="form-card-title"><i class="fas fa-percent"></i> Discount</div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Discount Percentage</label>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <input type="number" name="discount_percent" id="discountPercent" class="form-control" value="{{ old('discount_percent', 0) }}" min="0" max="100" step="1" style="max-width: 120px;" oninput="updateTotal()">
                            <span style="color: #c9a84c; font-weight: 600; font-size: 1.1rem;">%</span>
                            <input type="range" id="discountSlider" min="0" max="100" value="{{ old('discount_percent', 0) }}" oninput="document.getElementById('discountPercent').value=this.value; updateTotal();" style="flex: 1; accent-color: #c9a84c;">
                        </div>
                    </div>
                </div>

                <!-- Totals -->
                <div class="total-display" style="flex-direction: column; gap: 0.8rem; align-items: stretch;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="total-label">Subtotal</span>
                        <span style="font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 600; color: #b0a890;" id="subtotalAmount">₹0/-</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;" id="discountRow" hidden>
                        <span class="total-label" style="color: #22c55e;">Discount (<span id="discountLabel">0</span>%)</span>
                        <span style="font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 600; color: #22c55e;" id="discountAmount">- ₹0</span>
                    </div>
                    <div style="border-top: 1px solid rgba(201,168,76,0.3); padding-top: 0.8rem; display: flex; justify-content: space-between; align-items: center;">
                        <span class="total-label" style="font-size: 1.1rem;">Grand Total</span>
                        <span class="total-amount" id="totalAmount">₹0/-</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-file-pdf"></i> Generate Receipt & Download PDF
            </button>
        </form>
    </div>

    <script>
        function toggleService(el) {
            const checkbox = el.querySelector('input[type="checkbox"]');
            setTimeout(() => {
                if (checkbox.checked) {
                    el.classList.add('selected');
                } else {
                    el.classList.remove('selected');
                }
                updateTotal();
            }, 10);
        }

        function updateTotal() {
            let subtotal = 0;
            document.querySelectorAll('input[name="service_ids[]"]:checked').forEach(cb => {
                subtotal += parseInt(cb.dataset.price);
            });
            const discountPercent = parseInt(document.getElementById('discountPercent').value) || 0;
            document.getElementById('discountSlider').value = discountPercent;
            const discountAmt = Math.round(subtotal * discountPercent / 100);
            const total = subtotal - discountAmt;

            document.getElementById('subtotalAmount').textContent = '₹' + subtotal.toLocaleString('en-IN') + '/-';
            document.getElementById('discountLabel').textContent = discountPercent;
            document.getElementById('discountAmount').textContent = '- ₹' + discountAmt.toLocaleString('en-IN');
            document.getElementById('discountRow').hidden = discountPercent === 0;
            document.getElementById('totalAmount').textContent = '₹' + total.toLocaleString('en-IN') + '/-';
        }

        // Live Search
        const searchInput = document.getElementById('serviceSearch');
        const clearBtn = document.getElementById('clearSearch');
        const searchCount = document.getElementById('searchCount');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            clearBtn.style.display = query ? 'block' : 'none';

            const allServices = document.querySelectorAll('.service-checkbox');
            let visibleCount = 0;
            let visibleByGender = { men: 0, women: 0 };

            allServices.forEach(el => {
                const name = el.dataset.serviceName || '';
                const gender = el.dataset.gender || '';
                const matches = !query || name.includes(query);

                el.style.display = matches ? 'flex' : 'none';
                if (matches) {
                    visibleCount++;
                    if (gender) visibleByGender[gender]++;
                }
            });

            // Toggle gender labels
            document.querySelectorAll('[data-gender-label]').forEach(label => {
                const gender = label.dataset.genderLabel;
                label.style.display = visibleByGender[gender] > 0 ? 'block' : 'none';
            });

            // Show/hide no results
            noResults.style.display = visibleCount === 0 && query ? 'block' : 'none';

            // Show match count while searching
            if (query) {
                searchCount.style.display = 'block';
                searchCount.textContent = visibleCount + ' service' + (visibleCount !== 1 ? 's' : '') + ' found';
            } else {
                searchCount.style.display = 'none';
            }
        });

        function clearServiceSearch() {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            searchInput.focus();
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[name="service_ids[]"]:checked').forEach(cb => {
                cb.closest('.service-checkbox').classList.add('selected');
            });
            updateTotal();
        });
    </script>
</body>
</html>
