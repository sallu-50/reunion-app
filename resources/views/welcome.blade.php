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

        .progress-container {
            margin-bottom: 40px;
        }

        .progress-bar {
            height: 6px;
            background: #e5e7eb;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--primary);
            width: 25%;
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .steps-label {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .step-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .step-subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            margin-bottom: 30px;
        }

        .form-section {
            display: none;
            animation: slideIn 0.4s ease-out;
        }

        .form-section.active {
            display: block;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
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
        input[type="email"],
        input[type="number"],
        input[type="tel"],
        textarea,
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
        textarea:focus,
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

        .file-input-wrapper {
            position: relative;
            width: 100%;
        }

        .file-input-wrapper input {
            padding: 10px;
            background: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            cursor: pointer;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            gap: 15px;
        }

        button {
            padding: 14px 28px;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .btn-next,
        .btn-submit {
            background: var(--primary);
            color: white;
            flex: 2;
        }

        .btn-next:hover,
        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }

        .btn-prev {
            background: #f3f4f6;
            color: var(--text-main);
            flex: 1;
        }

        .btn-prev:hover {
            background: #e5e7eb;
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
        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill"></div>
            </div>
            <div class="steps-label">
                <span>Personal</span>
                <span>Contact</span>
                <span>Performance</span>
                <span>Donation</span>
            </div>
        </div>

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

        <form action="{{ route('apply.submit') }}" method="POST" enctype="multipart/form-data" id="multiStepForm">
            @csrf

            <!-- Step 1: Personal Information -->
            <div class="form-section active" data-step="1">
                <h2 class="step-title">Personal Details</h2>
                <p class="step-subtitle">Let's start with some basic information about you.</p>

                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="example@mail.com" required>
                </div>

                <div class="input-group">
                    <label for="name">Full Name (English)</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Enter your full name" required>
                </div>

                <div class="input-group">
                    <label>Member Type</label>
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

                <div class="input-group">
                    <label for="graduation_year">Passing Year</label>
                    <input type="number" id="graduation_year" name="graduation_year"
                        value="{{ old('graduation_year') }}" min="1900" max="{{ date('Y') }}" placeholder="YYYY"
                        required>
                </div>

                <div class="input-group">
                    <label>Gender</label>
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
            </div>

            <!-- Step 2: Contact & Photo -->
            <div class="form-section" data-step="2">
                <h2 class="step-title">Contact & Media</h2>
                <p class="step-subtitle">How can we reach you and identify you?</p>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        placeholder="+8801234567890">
                </div>

                <div class="input-group">
                    <label for="present_address">Present Address</label>
                    <textarea id="present_address" name="present_address" placeholder="Where do you live now?">{{ old('present_address') }}</textarea>
                </div>

                <div class="input-group">
                    <label for="permanent_address">Permanent Address</label>
                    <textarea id="permanent_address" name="permanent_address" placeholder="Your home address">{{ old('permanent_address') }}</textarea>
                </div>

                <div class="input-group">
                    <label for="photo">Upload Your Photo</label>
                    <div class="file-input-wrapper">
                        <input type="file" id="photo" name="photo" accept="image/*">
                    </div>
                </div>
            </div>

            <!-- Step 3: Event Details -->
            <div class="form-section" data-step="3">
                <h2 class="step-title">Event Participation</h2>
                <p class="step-subtitle">Tell us about your plans for the reunion.</p>

                <div class="input-group">
                    <label for="number_of_guests">How many guests will attend with you?</label>
                    <input type="number" id="number_of_guests" name="number_of_guests"
                        value="{{ old('number_of_guests', 0) }}" min="0">
                </div>

                <div class="input-group">
                    <label>Do you want to perform in the cultural segment?</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="perform_yes" name="wants_to_perform" value="1"
                                {{ old('wants_to_perform') == '1' ? 'checked' : '' }}>
                            <label for="perform_yes">Yes, I'd love to!</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="perform_no" name="wants_to_perform" value="0"
                                {{ old('wants_to_perform', '0') == '0' ? 'checked' : '' }}>
                            <label for="perform_no">No, thank you.</label>
                        </div>
                    </div>
                </div>

                <div class="input-group" id="performanceTypeGroup" style="display: none;">
                    <label for="performance_type">Performance Type (Song, Dance, Speech, etc.)</label>
                    <input type="text" id="performance_type" name="performance_type"
                        value="{{ old('performance_type') }}" placeholder="What will you perform?">
                </div>

                <div class="input-group">
                    <label for="message_to_teachers">Message to Teachers</label>
                    <textarea id="message_to_teachers" name="message_to_teachers" placeholder="Any words for our beloved teachers?">{{ old('message_to_teachers') }}</textarea>
                </div>

                <div class="input-group">
                    <label for="video">Any video for our teachers? (Optional)</label>
                    <div class="file-input-wrapper">
                        <input type="file" id="video" name="video" accept="video/*">
                    </div>
                </div>
            </div>

            <!-- Step 4: Donation & Payment -->
            <div class="form-section" data-step="4">
                <h2 class="step-title">Final Step: Contribution</h2>
                <p class="step-subtitle">Support our reunion and complete your registration.</p>

                <div class="input-group">
                    <label for="donation_amount">Donation Amount (BDT)</label>
                    <input type="number" id="donation_amount" name="donation_amount"
                        value="{{ old('donation_amount') }}" placeholder="Amount in Taka" required>
                </div>

                <div class="input-group">
                    <label>Payment Method</label>
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

                <div class="input-group">
                    <label for="transaction_number">Transaction ID</label>
                    <input type="text" id="transaction_number" name="transaction_number"
                        value="{{ old('transaction_number') }}" placeholder="Enter TrxID" required>
                </div>

                <div class="input-group">
                    <label for="donation_message">Any message regarding donation?</label>
                    <textarea id="donation_message" name="donation_message" placeholder="Optional message">{{ old('donation_message') }}</textarea>
                </div>

                <div class="input-group">
                    <label for="message">Any Question?</label>
                    <textarea id="message" name="message" placeholder="Ask us anything">{{ old('message') }}</textarea>
                </div>
            </div>

            <div class="navigation-buttons">
                <button type="button" class="btn-prev" id="prevBtn" style="display: none;">Previous</button>
                <button type="button" class="btn-next" id="nextBtn">Next</button>
                <button type="submit" class="btn-submit" id="submitBtn" style="display: none;">Complete
                    Registration</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('multiStepForm');
        const sections = document.querySelectorAll('.form-section');
        const progressFill = document.getElementById('progressFill');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const performYes = document.getElementById('perform_yes');
        const performNo = document.getElementById('perform_no');
        const performanceTypeGroup = document.getElementById('performanceTypeGroup');
        const payBkash = document.getElementById('pay_bkash');
        const payNagad = document.getElementById('pay_nagad');
        const paymentInfo = document.getElementById('payment_info');
        const paymentNumber = document.getElementById('payment_number');

        const paymentNumbers = {
            'bKash': '017XXXXXXXX (Personal)',
            'Nagad': '019XXXXXXXX (Personal)'
        };

        let currentStep = 1;

        function updateStep() {
            sections.forEach(section => {
                section.classList.remove('active');
                if (parseInt(section.dataset.step) === currentStep) {
                    section.classList.add('active');
                }
            });

            // Update Progress
            const progress = (currentStep / sections.length) * 100;
            progressFill.style.width = `${progress}%`;

            // Update Buttons
            prevBtn.style.display = currentStep === 1 ? 'none' : 'block';

            if (currentStep === sections.length) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'block';
            } else {
                nextBtn.style.display = 'block';
                submitBtn.style.display = 'none';
            }

            // Scroll to top of card
            document.querySelector('.form-card').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        nextBtn.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                currentStep++;
                updateStep();
            }
        });

        prevBtn.addEventListener('click', () => {
            currentStep--;
            updateStep();
        });

        function validateStep(step) {
            const currentSection = document.querySelector(`.form-section[data-step="${step}"]`);
            const requiredInputs = currentSection.querySelectorAll('[required]');
            let valid = true;

            requiredInputs.forEach(input => {
                if (!input.value || (input.type === 'radio' && !document.querySelector(
                        `input[name="${input.name}"]:checked`))) {
                    input.style.borderColor = 'var(--error)';
                    valid = false;
                } else {
                    input.style.borderColor = '#e5e7eb';
                }
            });

            if (!valid) {
                alert('Please fill all required fields before proceeding.');
            }

            return valid;
        }

        // Show/Hide Performance Type
        function togglePerformanceType() {
            if (performYes.checked) {
                performanceTypeGroup.style.display = 'block';
            } else {
                performanceTypeGroup.style.display = 'none';
            }
        }

        function updatePaymentNumber() {
            const selected = document.querySelector('input[name="payment_method"]:checked');
            if (selected) {
                paymentInfo.style.display = 'block';
                paymentNumber.textContent = paymentNumbers[selected.value];
            } else {
                paymentInfo.style.display = 'none';
            }
        }

        performYes.addEventListener('change', togglePerformanceType);
        performNo.addEventListener('change', togglePerformanceType);
        payBkash.addEventListener('change', updatePaymentNumber);
        payNagad.addEventListener('change', updatePaymentNumber);

        // Initialize
        togglePerformanceType();
        updatePaymentNumber();
    </script>
</body>

</html>
