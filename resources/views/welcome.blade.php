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
                padding: 20px;
                border-radius: 0;
                min-height: 100vh;
                max-width: 100%;
                margin: 0;
                box-shadow: none;
            }

            body {
                padding: 0;
                background: white;
            }

            .radio-group {
                flex-direction: column;
                gap: 10px;
            }

            .radio-option {
                min-width: 100%;
                padding: 12px;
            }

            .step-title {
                font-size: 1.6rem;
            }

            .step-subtitle {
                font-size: 0.9rem;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="form-card">
        <h2 class="step-title">পূণর্মিলনী রেজিষ্ট্রেশন </h2>
        <p class="step-subtitle">দয়া করে রেজিষ্ট্রেশন ফরম পূরণ করুন</p>

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
                    <label for="name">সম্পূর্ণ নাম </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="আপনার সম্পূর্ণ নাম দিন" required>
                </div>

                {{-- 2. PHONE NUMBER --}}
                <div class="input-group">
                    <label for="phone">মোবাইল নাম্বার</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        placeholder="01XXXXXXXXX" required>
                </div>

                {{-- 3. GENDER --}}
                <div class="input-group">
                    <label>লিঙ্গ</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="gender_male" name="gender" value="male"
                                {{ old('gender') == 'male' ? 'checked' : '' }} required>
                            <label for="gender_male">পুরুষ</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="gender_female" name="gender" value="female"
                                {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label for="gender_female">মহিলা</label>
                        </div>
                        <!-- <div class="radio-option">
                            <input type="radio" id="gender_other" name="gender" value="other"
                                {{ old('gender') == 'other' ? 'checked' : '' }}>
                            <label for="gender_other">Other</label>
                        </div> -->
                    </div>
                </div>



                {{-- 4. MEMBER TYPE --}}
                <div class="input-group">
                    <label>ছাত্র/ছাত্রীর ধরন (রেজিষ্ট্রেশন ফি ১০২০ টাকা)</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="type_ex" name="member_type" value="ex_student"
                                {{ old('member_type') == 'ex_student' ? 'checked' : '' }} required>
                            <label for="type_ex">প্রাক্তন ছাত্র</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="type_running" name="member_type" value="running_student"
                                {{ old('member_type') == 'running_student' ? 'checked' : '' }}>
                            <label for="type_running">বর্তমান ছাত্র</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="type_guest" name="member_type" value="guest"
                                {{ old('member_type') == 'guest' ? 'checked' : '' }}>
                            <label for="type_guest">অতিথি</label>
                        </div>
                    </div>
                </div>

                {{-- 5. PASSING YEAR --}}
                <div class="input-group">
                    <label for="graduation_year">পাশের সাল</label>
                    <select id="graduation_year" name="graduation_year" required>
                        <option value="" disabled {{ old('graduation_year') ? '' : 'selected' }}>পাশের বছর
                            নির্বাচন করুন
                        </option>
                        @for ($year = 2025; $year >= 1995; $year--)
                            <option value="{{ $year }}"
                                {{ old('graduation_year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>
                {{-- NEW: SPOUSE SELECTION --}}
                <div class="input-group">
                    <label>আপনার সাথে আগত অতিথিরবিবরণ (জনপ্রতি ৩০৫ টাকা)</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="spouse_none" name="spouse_type" value="none"
                                {{ old('spouse_type', 'none') == 'none' ? 'checked' : '' }}>
                            <label for="spouse_none">কোনও না</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="spouse_husband" name="spouse_type" value="husband"
                                {{ old('spouse_type') == 'husband' ? 'checked' : '' }}>
                            <label for="spouse_husband">স্বামী</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="spouse_wife" name="spouse_type" value="wife"
                                {{ old('spouse_type') == 'wife' ? 'checked' : '' }}>
                            <label for="spouse_wife">স্ত্রী</label>
                        </div>
                    </div>
                </div>

                {{-- 6. HOW MANY CHILDREN --}}
                <div class="input-group">
                    <label for="number_of_children">আপনার সাথে আগত বাচ্চার সংখ্যা (জনপ্রতি ৩০৫ টাকা)</label>
                    <input type="number" id="number_of_children" name="number_of_children"
                        value="{{ old('number_of_children', 0) }}" min="0" placeholder="Number of children"
                        required>
                </div>

                {{-- 7. PAYMENT GETWAY --}}
                <div class="input-group">
                    <label>পেমেন্ট মাধ্যম</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="pay_bkash" name="payment_method" value="bKash"
                                {{ old('payment_method') == 'bKash' ? 'checked' : '' }} required>
                            <label for="pay_bkash">বিকাশ </label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="pay_nagad" name="payment_method" value="Nagad"
                                {{ old('payment_method') == 'Nagad' ? 'checked' : '' }}>
                            <label for="pay_nagad">নাগদ</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="pay_bank" name="payment_method" value="Bank"
                                {{ old('payment_method') == 'Bank' ? 'checked' : '' }}>
                            <label for="pay_bank">ব্যাংক বিবরণ</label>
                        </div>
                    </div>
                </div>

                <div id="payment_info" class="alert alert-success"
                    style="display: none; margin-top: 15px; border-left: 5px solid var(--primary); background: rgba(99, 102, 241, 0.1); color: var(--text-main);">
                    <div id="mobile_payment_div">
                        <p style="margin: 0; font-weight: 600;">Send Money to this number:</p>
                        <p id="payment_number"
                            style="font-size: 1.25rem; margin: 5px 0 0; color: var(--primary); font-weight: 800; letter-spacing: 1px;">
                        </p>
                    </div>
                    <div id="bank_payment_div" style="display: none;">
                        <p style="margin: 0; font-weight: 600;">Bank Account Details:</p>
                        <div style="margin-top: 10px; font-size: 1rem; line-height: 1.6; color: var(--text-main);">
                            <p style="margin: 0;"><strong>Account Name:</strong> <span id="bank_acc_name"></span></p>
                            <p style="margin: 0;"><strong>Account No:</strong> <span id="bank_acc_no"></span></p>
                            <p style="margin: 0;"><strong>Bank Name:</strong> <span id="bank_name"></span></p>
                            <p style="margin: 0;"><strong>Branch:</strong> <span id="bank_branch"></span></p>
                        </div>
                    </div>
                    <p style="margin: 5px 0 0; font-size: 0.85rem; color: var(--text-muted);">(Please include your name
                        in the reference/description)</p>
                </div>

                {{-- 8. DONATION AMOUNT --}}
                <div class="input-group">
                    <label for="donation_amount">নূন্যতম পূনর্মিলনী ফি</label>
                    <input type="number" id="donation_amount" name="donation_amount"
                        value="{{ old('donation_amount') }}" placeholder="Amount in BDT" required>
                </div>

                {{-- 9. TNXID/PHONE NUMBER --}}
                <div class="input-group">
                    <label for="transaction_number">মোবাইল নাম্বার/ ট্রানজেকশন আইডি</label>
                    <input type="text" id="transaction_number" name="transaction_number"
                        value="{{ old('transaction_number') }}" placeholder="Enter TrxID or Sender Phone" required>
                </div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">Complete Registration</button>
        </form>
    </div>

    <script>
        const paymentInfo = document.getElementById('payment_info');
        const paymentNumber = document.getElementById('payment_number');

        const paymentNumbers = {
            'bKash': '01720-007927 (Personal)',
            'Nagad': '01401499696 (Personal)'
        };

        const bankDetails = {
            'name': 'B-tech Solution',
            'no': '2811100010367',
            'bank': 'Dutch Bangla Bank Ltd.',
            'branch': 'Seedstore Branch, Mymensingh'
        };

        function updatePaymentNumber() {
            const selected = document.querySelector('input[name="payment_method"]:checked');
            const mobileDiv = document.getElementById('mobile_payment_div');
            const bankDiv = document.getElementById('bank_payment_div');

            if (selected) {
                paymentInfo.style.display = 'block';
                if (selected.value === 'Bank') {
                    mobileDiv.style.display = 'none';
                    bankDiv.style.display = 'block';
                    document.getElementById('bank_acc_name').textContent = bankDetails.name;
                    document.getElementById('bank_acc_no').textContent = bankDetails.no;
                    document.getElementById('bank_name').textContent = bankDetails.bank;
                    document.getElementById('bank_branch').textContent = bankDetails.branch;
                } else {
                    mobileDiv.style.display = 'block';
                    bankDiv.style.display = 'none';
                    paymentNumber.textContent = paymentNumbers[selected.value];
                }
            } else {
                paymentInfo.style.display = 'none';
            }
        }

        function calculateDonation() {
            try {
                let total = 0;

                // Member Type Calculation
                const memberType = document.querySelector('input[name="member_type"]:checked');
                if (memberType) {
                    total += 1020;
                }

                // Spouse Calculation
                const spouseType = document.querySelector('input[name="spouse_type"]:checked');
                if (spouseType && spouseType.value !== 'none') {
                    total += 305;
                }

                // Children Calculation
                const childrenInput = document.getElementById('number_of_children');
                if (childrenInput) {
                    const childrenCount = parseInt(childrenInput.value) || 0;
                    total += (childrenCount * 305);
                }

                // Update field
                const donationField = document.getElementById('donation_amount');
                if (donationField) {
                    donationField.value = total;
                }
            } catch (e) {
                console.error("Calculation Error:", e);
            }
        }

        // Attach event listeners
        document.querySelectorAll('input[name="payment_method"]').forEach(input => {
            input.addEventListener('change', updatePaymentNumber);
        });

        document.querySelectorAll('input[name="member_type"], input[name="spouse_type"]').forEach(input => {
            input.addEventListener('change', calculateDonation);
        });

        const childrenInput = document.getElementById('number_of_children');
        if (childrenInput) {
            childrenInput.addEventListener('input', calculateDonation);
        }

        // Form Submit Debugging
        const regForm = document.getElementById('registrationForm');
        if (regForm) {
            regForm.addEventListener('submit', function() {
                const btn = document.getElementById('submitBtn');
                if (btn) {
                    btn.innerText = "Processing...";
                    btn.style.opacity = "0.7";
                    btn.disabled = true;
                }
            });
        }

        // Initialize
        updatePaymentNumber();
        calculateDonation();
    </script>
</body>

</html>
