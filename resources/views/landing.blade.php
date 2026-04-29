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

        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
            background-color: #f8fafc;
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
            background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 800px;
            padding: 0 20px;
            animation: fadeInUp 1s ease-out;
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
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.1;
            text-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.4rem;
            margin-bottom: 40px;
            opacity: 0.9;
            font-weight: 300;
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
            .hero h1 {
                font-size: 2.8rem;
            }
            .hero p {
                font-size: 1.1rem;
            }
            .cta-button {
                padding: 16px 35px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <section class="hero">
        <div class="hero-content">
            <h1>Grand Alumni Reunion</h1>
            <p>Reconnect with old friends, relive cherished memories, and celebrate the journey together. We can't wait to see you back on campus!</p>
            <a href="{{ url('/apply') }}" class="cta-button">REGISTRATION KORUN</a>
        </div>
    </section>

    <footer class="footer">
        <p>Questions? Contact us at: <strong>alumni@reunion.com</strong> or call <strong>+880 123 456 789</strong></p>
        <p>&copy; {{ date('Y') }} Grand Reunion. All rights reserved.</p>
    </footer>
</body>

</html>
