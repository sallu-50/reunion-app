<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Alumni Reunion - Reconnect & Relive</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --text-light: #ffffff;
            --text-dark: #1e293b;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
            background-color: #f8fafc;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
            box-sizing: border-box;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .nav-stats {
            display: flex;
            gap: 20px;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .stat-badge {
            background: #f1f5f9;
            padding: 5px 12px;
            border-radius: 99px;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #e2e8f0;
            color: #475569;
        }

        .stat-badge span {
            color: var(--primary);
            font-weight: 800;
        }

        .nav-contact {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            padding: 8px 20px;
            border: 2px solid var(--text-dark);
            border-radius: 50px;
            transition: all 0.3s;
        }

        .nav-contact:hover {
            background: var(--text-dark);
            color: white;
        }

        .announcement-bar {
            position: fixed;
            top: 71px;
            /* Just below the navbar */
            left: 0;
            width: 100%;
            background: #4f46e5;
            /* Primary Indigo */
            color: white;
            padding: 10px 0;
            z-index: 999;
            overflow: hidden;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .ticker-wrapper {
            display: inline-flex;
            white-space: nowrap;
            animation: ticker 40s linear infinite;
        }

        .ticker-item {
            padding: 0 50px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ticker-item::after {
            content: '•';
            margin-left: 50px;
            color: rgba(255, 255, 255, 0.5);
        }

        @keyframes ticker {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .hero {
            position: relative;
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('/reunion_banner.png') center/cover no-repeat;
            color: var(--text-light);
            text-align: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 800px;
            padding: 0 20px;
            animation: fadeInUp 1s ease-out;
            margin-top: 100px;
            /* Offset for navbar + announcement bar */
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 5rem;
            font-weight: 800;
            margin-bottom: 24px;
            line-height: 1.1;
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            letter-spacing: -1px;
        }

        .hero h1 .highlight {
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 48px;
            opacity: 0.9;
            font-weight: 400;
            line-height: 1.6;
            color: #e2e8f0;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(99, 102, 241, 0.2);
            color: #818cf8;
            padding: 8px 20px;
            border-radius: 99px;
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            border: 1px solid rgba(99, 102, 241, 0.3);
            margin-bottom: 24px;
        }

        .cta-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .cta-sub {
            font-size: 0.85rem;
            color: #94a3b8;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cta-button {
            display: inline-block;
            padding: 20px 50px;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            background-color: var(--primary);
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .cta-button:hover {
            background-color: var(--primary-hover);
            transform: scale(1.05) translateY(-3px);
            box-shadow: 0 20px 30px -10px rgba(99, 102, 241, 0.6);
        }

        .footer {
            padding: 40px 20px;
            text-align: center;
            background: #ffffff;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }

        .footer p {
            margin: 5px 0;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 10px 20px;
                flex-direction: column;
                gap: 10px;
            }

            .announcement-bar {
                top: 110px;
                /* Adjust for stacked navbar height */
            }

            .hero-content {
                margin-top: 150px;
            }

            .nav-stats {
                font-size: 0.8rem;
                gap: 10px;
            }

            .nav-contact {
                font-size: 0.75rem;
                padding: 6px 15px;
            }

            .hero h1 {
                font-size: 2.8rem;
                letter-spacing: 0;
            }

            .hero p {
                font-size: 1rem;
                margin-bottom: 30px;
                padding: 0 10px;
            }

            .hero-badge {
                font-size: 0.75rem;
                padding: 6px 16px;
                margin-bottom: 16px;
            }

            .cta-button {
                padding: 14px 28px;
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="nav-stats">
            <div class="stat-badge">
                Applied: <span>{{ $totalApplied }}</span>
            </div>
            <div class="stat-badge">
                Approved: <span>{{ $totalApproved }}</span>
            </div>
        </div>
        <a href="tel:+880123456789" class="nav-contact">+880 123 456 789</a>
    </nav>

    <div class="announcement-bar">
        <div class="ticker-wrapper">
            <div class="ticker-item">রেজিষ্ট্রেশনের শেষ তারিখ: ২০/০৫/২৬ ইং ।</div>
            <div class="ticker-item">স্থান: মেদিলা আদর্শ উচ্চ বিদ্যালয় মাঠ।</div>
            <div class="ticker-item">তারিখ: ২ ৩০/০৫/২৬ ইং ।</div>
            <div class="ticker-item">রোজ শনিবার ।</div>
            {{-- Duplicate for seamless loop --}}
            <div class="ticker-item">রেজিষ্ট্রেশনের শেষ তারিখ: ২০/০৫/২৬ ইং ।</div>
            <div class="ticker-item">স্থান: মেদিলা আদর্শ উচ্চ বিদ্যালয় মাঠ।</div>
            <div class="ticker-item">তারিখ: ২ ৩০/০৫/২৬ ইং ।</div>
            <div class="ticker-item">রোজ শনিবার ।</div>
        </div>
    </div>

    <section class="hero">
        <div class="hero-content">
            <span class="hero-badge">৪০ বছর পূর্তি উপলক্ষে</span>
            <h2>প্রাক্তন-বর্তমান ছাত্র-ছাত্রীদের <span class="highlight">পুণর্মিলনী</span> অনুষ্ঠান-২০২৬ ইং</h2>
            <p style="margin-bottom: 20px;">মেদিলা আদর্শ উচ্চ বিদ্যালয়-এর অবসর প্রাপ্ত শিক্ষক-শিক্ষিকা বৃন্দের বিদায়
                সম্বর্ধনা।</p>
            <p style="font-size: 1.1rem; opacity: 0.8;">স্থান: মেদিলা আদর্শ উচ্চ বিদ্যালয় মাঠ | তারিখ: ৩০/০৫/২৬ ইং
                (শনিবার)</p>
            <div class="cta-wrapper">
                <a href="{{ url('/apply') }}" class="cta-button">রেজিষ্ট্রেশন করুন</a>
                <p class="cta-sub">রেজিষ্ট্রেশনের শেষ তারিখ: ২০ মে ২০২৬</p>
            </div>
        </div>
    </section>

    <footer class="footer" id="contact">
        <p>Questions? Contact us at: <strong>alumni@reunion.com</strong> or call <strong>+880 123 456 789</strong></p>
        <p>&copy; {{ date('Y') }} Grand Reunion. All rights reserved.</p>
    </footer>
</body>

</html>
