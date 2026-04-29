<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reunion Registration - Premium Application</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --glass-bg: rgba(255, 255, 255, 0.9);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --error: #ef4444;
            --success: #10b981;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .form-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 650px;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .step-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
            text-align: center;
        }

        .step-subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-section {
            margin-bottom: 20px;
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .input-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 12px 16px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            color: var(--text-main);
            transition: all 0.2s;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .radio-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .radio-option {
            flex: 1;
            min-width: 120px;
        }

        .radio-option input {
            display: none;
        }

        .radio-option label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 0;
        }

        .radio-option input:checked+label {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            width: 100%;
            padding: 14px 28px;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            margin-top: 20px;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }

        .alert {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 0.95rem;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @media (max-width: 640px) {
            .form-card {
                padding: 24px;
                border-radius: 0;
                height: 100%;
                max-width: 100%;
            }

            body {
                padding: 0;
            }

            .radio-option {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="form-card">
        <h2 class="step-title">Reunion Registration</h2>
        <p class="step-subtitle">Please fill in the details below to register.</p>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('apply.submit') }}" method="POST" id="registrationForm">
            @csrf

            <div class="form-section">
                {{-- 1. FULL NAME --}}
                <div class="input-group">
                    <label for="name">FULL NAME</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Enter your full name" required>
                </div>

                {{-- 2. PHONE NUMBER --}}
                <div class="input-group">
                    <label for="phone">PHONE NUMBER</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        placeholder="01XXXXXXXXX" required>
                </div>

                {{-- 3. GENDER --}}
                <div class="input-group">
                    <label>GENDER</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="gender_male" name="gender" value="male"
                                {{ old('gender') == 'male' ? 'checked' : '' }} required>
                            <label for="gender_male">Male</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="gender_female" name="gender" value="female"
                                {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label for="gender_female">Female</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="gender_other" name="gender" value="other"
                                {{ old('gender') == 'other' ? 'checked' : '' }}>
                            <label for="gender_other">Other</label>
                        </div>
                    </div>
                </div>

                {{-- 4. MEMBER TYPE --}}
                <div class="input-group">
                    <label>MEMBER TYPE</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="type_ex" name="member_type" value="ex_student"
                                {{ old('member_type') == 'ex_student' ? 'checked' : '' }} required>
                            <label for="type_ex">EX-Student</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="type_running" name="member_type" value="running_student"
                                {{ old('member_type') == 'running_student' ? 'checked' : '' }}>
                            <label for="type_running">Running Student</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="type_guest" name="member_type" value="guest"
                                {{ old('member_type') == 'guest' ? 'checked' : '' }}>
                            <label for="type_guest">Guest</label>
                        </div>
                    </div>
                </div>

                {{-- 5. PASSING YEAR --}}
                <div class="input-group">
                    <label for="graduation_year">PASSING YEAR</label>
                    <input type="number" id="graduation_year" name="graduation_year"
                        value="{{ old('graduation_year') }}" min="1900" max="{{ date('Y') }}" placeholder="YYYY"
                        required>
                </div>

                {{-- 6. HOW MANY GUEST --}}
                <div class="input-group">
                    <label for="number_of_guests">HOW MANY GUEST</label>
                    <input type="number" id="number_of_guests" name="number_of_guests"
                        value="{{ old('number_of_guests', 0) }}" min="0" required>
                </div>

                {{-- 7. PAYMENT GETWAY --}}
                <div class="input-group">
                    <label>PAYMENT GETWAY</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="pay_bkash" name="payment_method" value="bKash"
                                {{ old('payment_method') == 'bKash' ? 'checked' : '' }} required>
                            <label for="pay_bkash">bKash</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="pay_nagad" name="payment_method" value="Nagad"
                                {{ old('payment_method') == 'Nagad' ? 'checked' : '' }}>
                            <label for="pay_nagad">Nagad</label>
                        </div>
                    </div>
                </div>

                <div id="payment_info" class="alert alert-success"
                    style="display: none; margin-top: 15px; border-left: 5px solid var(--primary); background: rgba(99, 102, 241, 0.1); color: var(--text-main);">
                    <p style="margin: 0; font-weight: 600;">Send Money to this number:</p>
                    <p id="payment_number"
                        style="font-size: 1.25rem; margin: 5px 0 0; color: var(--primary); font-weight: 800; letter-spacing: 1px;">
                    </p>
                    <p style="margin: 5px 0 0; font-size: 0.85rem; color: var(--text-muted);">(Please include your name
                        in the reference)</p>
                </div>

                {{-- 8. DONATION AMOUNT --}}
                <div class="input-group">
                    <label for="donation_amount">DONATION AMOUNT</label>
                    <input type="number" id="donation_amount" name="donation_amount"
                        value="{{ old('donation_amount') }}" placeholder="Amount in BDT" required>
                </div>

                {{-- 9. TNXID/PHONE NUMBER --}}
                <div class="input-group">
                    <label for="transaction_number">TNXID/PHONE NUMBER</label>
                    <input type="text" id="transaction_number" name="transaction_number"
                        value="{{ old('transaction_number') }}" placeholder="Enter TrxID or Sender Phone" required>
                </div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">Complete Registration</button>
        </form>
    </div>

    <script>
        const payBkash = document.getElementById('pay_bkash');
        const payNagad = document.getElementById('pay_nagad');
        const paymentInfo = document.getElementById('payment_info');
        const paymentNumber = document.getElementById('payment_number');

        const paymentNumbers = {
            'bKash': '017XXXXXXXX (Personal)',
            'Nagad': '019XXXXXXXX (Personal)'
        };

        function updatePaymentNumber() {
            const selected = document.querySelector('input[name="payment_method"]:checked');
            if (selected) {
                paymentInfo.style.display = 'block';
                paymentNumber.textContent = paymentNumbers[selected.value];
            } else {
                paymentInfo.style.display = 'none';
            }
        }

        payBkash.addEventListener('change', updatePaymentNumber);
        payNagad.addEventListener('change', updatePaymentNumber);

        // Initialize
        updatePaymentNumber();
    </script>
</body>

</html>
