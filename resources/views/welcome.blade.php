<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroCabin</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
    <link rel="apple-touch-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
    <meta name="msapplication-TileColor" content="#059e8a">
    <meta name="theme-color" content="#059e8a">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }
        :root {
            --primary-color: #059e8a;
            --secondary-color: #047857;
            --accent-color: #00add6;
            --text-color: #1f2937;
            --light-bg: #AFE1AF;
            --white: #FFFFFF;
            --gray: #6b7280;
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }
        body {
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-bg);
            position: relative;
            overflow-x: hidden;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .header {
            background-color: var(--white);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
            background-color: rgba(255, 255, 255, 0.98);
        }
        .header.scrolled {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.95);
        }
        .scroll-indicator {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            z-index: 1001;
            transition: width 0.3s ease;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(90deg, #059669 0%, #047857 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .logo img {
            height: 32px;
        }
        .logo i {
            font-size: 1.5rem;
            margin-right: 0.5rem;
            color: #10B981; 
            transition: transform 0.3s ease;
        }
        .nav-menu {
            display: flex;
            gap: 2rem;
            align-items: center;
            position: relative;
        }
        .nav-menu.active {
            display: flex;
            flex-direction: column;
        }
        .nav-link {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            padding: 0.75rem 1.25rem;
            border-radius: var(--border-radius);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        .nav-link:hover::before,
        .nav-link.active::before {
            width: 80%;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, 
                rgba(5, 158, 138, 0.1),
                rgba(4, 120, 87, 0.1)
            );
            border-radius: var(--border-radius);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .nav-link:hover::after,
        .nav-link.active::after {
            opacity: 1;
        }
        .nav-link:hover {
            color: var(--primary-color);
            transform: translateY(-2px);
        }
        .nav-link.active {
            color: var(--primary-color);
            font-weight: 600;
        }
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(5, 158, 138, 0.98) 0%, rgba(4, 120, 87, 0.98) 100%);
            color: var(--white);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding-top: 110px;
            padding-bottom: 50px;
        }
        .hero-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr;
            align-items: center;
            text-align: center;
            gap: 3rem;
        }
        .hero-content {
            max-width: 600px;
        }
        .hero-content::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(
                circle at center,
                rgba(255, 255, 255, 0.1) 0%,
                transparent 50%
            );
            animation: rotate 10s linear infinite;
            pointer-events: none;
        }
        .hero-content h1 {
            font-size: 3rem !important;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            position: relative;
            background: linear-gradient(
                to right, #ffffff 20%, #e0e0e0 30%, #ffffff 70%,#e0e0e0 80%
            );
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% auto;
            animation: shine 3s linear infinite;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
            font-weight: 600;
            letter-spacing: -1px;
        }
        .hero-content h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.5);
            position: relative;
            display: inline-block;
            font-weight: 500;
            letter-spacing: -0.5px;
        }
        .hero-content h2::after {
            content: 'by HydroCabin';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            color: #fff;
            -webkit-text-stroke: 0px;
            border-right: 2px solid #fff;
            animation: typing 3s steps(12) infinite;
            white-space: nowrap;
            overflow: hidden;
        }
        
        .hero-content p {
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            color: rgba(255, 255, 255, 0.9);
            position: relative;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
            transform: translateY(20px);
            animation-delay: 0.5s;
            font-weight: 300;
            letter-spacing: 0.2px;
        }
        .hero-showcase {
            position: relative;
            perspective: 1000px;
        }
        .showcase-card {
            position: relative;
            width: 100%;
            padding: 1rem;
            aspect-ratio: 16/9;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            transform: rotateY(-5deg) rotateX(5deg);
            transition: transform 0.5s ease;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.2),
                inset 0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        .showcase-card:hover {
            transform: rotateY(-5deg) rotateX(2deg) scale(1.02);
        }
        .showcase-content {
            position: absolute;
            inset: 0;
            padding: 2rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            opacity: 0.9;
        }
        .metrics-grid {
            display: grid !important;
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 1.5rem !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
        }
        .metric-card {
            width: 100% !important;
            padding: 1.5rem !important;
            min-height: 120px !important;
            border-radius: 12px !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            text-align: center !important;
            background: rgba(255,255,255,0.1) !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-sizing: border-box !important;
        }
        .metric-card:nth-child(1) { animation-delay: 0.2s; }
        .metric-card:nth-child(2) { animation-delay: 0.4s; }
        .metric-card:nth-child(3) { animation-delay: 0.6s; }
        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }
        .metric-card:hover {
            transform: translateY(-5px) scale(1.02);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .metric-card:hover::before {
            left: 100%;
            transition: 0.5s;
        }
        .metric-icon {
            font-size: 2.5rem !important;
            margin-bottom: 1rem !important;
            background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%) !important;
            -webkit-background-clip: text !important;
            background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            opacity: 0.9 !important;
            animation: iconPulse 2s infinite !important;
        }
        .metric-value {
            font-size: 2rem !important;
            font-weight: 600 !important;
            margin-bottom: 0.5rem !important;
            font-family: 'Poppins', sans-serif !important;
            background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%) !important;
            -webkit-background-clip: text !important;
            background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            position: relative !important;
            animation: valueLoad 2s cubic-bezier(0.4, 0, 0.2, 1) infinite !important;
        }
        .metric-label {
            font-size: 1rem !important;
            color: #e0e0e0 !important;
            font-weight: 500 !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            opacity: 0 !important;
            animation: labelAppear 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
            animation-delay: 0.8s !important;
        }
        @keyframes cardAppear {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes iconPulse {
            0% {
                transform: scale(1);
                opacity: 0.9;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 0.9;
            }
        }
        @keyframes valueLoad {
            0% {
                opacity: 0.7;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0.7;
            }
        }
        @keyframes labelAppear {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        html, body {
            max-width: 100vw;
            overflow-x: hidden;
        }
        .features {
            padding: 5rem 0;
            background-color: var(--white);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem 0;
        }
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        .section-title h2 {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-weight: 600;
            letter-spacing: -0.5px;
        }
        .section-title p {
            color: var(--gray);
            font-size: 1.1rem;
            font-weight: 300;
            letter-spacing: 0.2px;
        }
        .feature-card {
            background: var(--white);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            border: 1px solid rgba(5, 158, 138, 0.1);
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(5, 158, 138, 0.2);
            border-color: var(--primary-color);
        }
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
            font-weight: 500;
            letter-spacing: -0.3px;
        }
        .feature-card p {
            color: var(--gray);
        }
        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            letter-spacing: 0.5px;
        }
        .btn-primary {
            background: linear-gradient(90deg, #059669 0%, #047857 100%);
            color: var(--white);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
            transform: translateY(20px);
            animation-delay: 0.7s;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #047857 0%, #059669 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
        }
        .btn-primary:active {
            transform: scale(0.98);
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.4);
            background: linear-gradient(90deg, #065f46 0%, #047857 100%);
        }
        @keyframes buttonShine {
            0% {
                transform: translateX(-100%);
            }
            50%, 100% {
                transform: translateX(100%);
            }
        }
        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                to right,
                transparent 0%,
                rgba(255, 255, 255, 0.2) 50%,
                transparent 100%
            );
            transform: translateX(-100%);
        }
        .btn-primary:hover::after {
            animation: buttonShine 1s ease-in-out;
        }
        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--white);
            color: var(--white);
        }
        .btn-outline:hover {
            background-color: var(--white);
            color: var(--primary-color);
            transform: translateY(-2px);
        }
        .footer {
            background-color: var(--white);
            padding: 4rem 0 2rem;
        }
        .footer-content {
            display: grid;
            grid-template-columns: 2fr 3fr;
            gap: 4rem;
            margin-bottom: 2rem;
        }
        .footer-info h3 {
            font-size: 1.5rem;
            background: linear-gradient(90deg, #059669 0%, #047857 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
            font-weight: 600;
            letter-spacing: -0.5px;
        }
        .footer-info p {
            color: var(--gray);
            margin-bottom: 1rem;
        }
        .footer-links {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        .footer-links h4 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-weight: 500;
            letter-spacing: -0.3px;
        }
        .footer-links ul {
            list-style: none;
        }
        .footer-links a {
            color: var(--gray);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: var(--transition);
        }
        .footer-links a:hover {
            color: var(--primary-color);
        }
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
            color: var(--gray);
        }
        .about {
            padding: 5rem 0;
            background-color: var(--white);
            position: relative;
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.92);
        }
        .about {
            background-color: rgba(255, 255, 255, 0.85);
            position: relative;
            overflow: hidden;
        }
        @keyframes falling-leaves {
            0% {
                transform: translateY(-50px) rotate(0deg) scale(1);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            45% {
                transform: translateY(45vh) rotate(120deg) scale(0.9) translateX(100px);
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(100vh) rotate(240deg) scale(0.8) translateX(-100px);
                opacity: 0;
            }
        }
        .demo-section {
            padding: 8rem 0;
            background: linear-gradient(135deg, rgba(5, 158, 138, 0.98) 0%, rgba(4, 120, 87, 0.98) 100%);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        .demo-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
        }
        .demo-content {
            position: relative;
            z-index: 2;
        }
        .demo-content h2 {
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: linear-gradient(to right, #ffffff, #e0e0e0);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .demo-content p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            color: #e0e0e0;
        }
        .demo-showcase {
            position: relative;
            perspective: 1000px;
            transform-style: preserve-3d;
        }
        .floating-dots {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0.5;
        }
        .dot {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float 3s infinite;
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        .demo-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        @keyframes shine {
            to {
                background-position: 200% center;
            }
        }
        @keyframes typing {
            0%, 90%, 100% {
                width: 0;
            }
            30%, 60% {
                width: 100%;
            }
        }
        @keyframes rotate {
            100% {
                transform: rotate(360deg);
            }
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px; 
        }
        .team-slider-wrapper {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            overflow: hidden;
        }
        .team-slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            gap: 2rem;
        }
        .team-card {
            border-radius: 20px !important;
            overflow: hidden;
            min-width: 420px;
            max-width: 640px;
            width: 90vw;
            margin: 0 auto 2rem auto;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            background: var(--white);
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0;
            transition: box-shadow 0.3s, transform 0.3s;
            will-change: box-shadow, transform;
        }
        .team-card:active, 
        .team-card:focus-within, 
        .team-card:hover {
            box-shadow: 0 16px 32px rgba(0,0,0,0.18);
            transform: translateY(-6px) scale(1.02);
        }
        .team-card::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -60%;
            width: 100%;
            height: 60%;
            background: linear-gradient(0deg, rgba(255,255,255,0.7) 0%, rgba(255,255,255,0.0) 100%);
            transition: bottom 0.5s cubic-bezier(0.4,0,0.2,1), background 0.5s, height 0.5s;
            z-index: 2;
            pointer-events: none;
        }
        .team-card:hover::after,
        .team-card:focus-within::after,
        .team-card:active::after {
            bottom: 0;
            background: linear-gradient(0deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.0) 100%);
        }
        .team-card-content {
            background: rgba(255,255,255,0.25);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
            border-radius: 0px 0px 20px 20px !important;
            margin: 0 auto 1.5rem auto;
            width: 90%;
            top: 0;
            position: relative;
            z-index: 4;
            padding: 1.2rem;
        }
        .team-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 1.5rem auto 1rem auto;
            overflow: hidden;
            border: 4px solid var(--primary-color);
            position: relative;
        }
        .team-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .team-card h3 {
            font-size: 1.15rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .team-card .nim {
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        .team-card h4 {
            color: var(--secondary-color);
            font-size: 1rem;
            font-weight: 500;
        }
        .team-slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-color);
            color: var(--white);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(5, 158, 138, 0.3);
            border: 2px solid var(--white);
        }
        .team-slider-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 6px 20px rgba(5, 158, 138, 0.4);
        }
        .team-slider-btn:active {
            transform: translateY(-50%) scale(0.95);
        }
        .team-slider-btn.prev {
            left: 10px;
        }
        .team-slider-btn.next {
            right: 10px;
        }
        .team-slider-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: translateY(-50%) scale(1);
            background: #ccc;
        }
        .team-slider-btn:disabled:hover {
            background: #ccc;
            transform: translateY(-50%) scale(1);
            box-shadow: 0 4px 15px rgba(5, 158, 138, 0.3);
        }
        .slider-indicators {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .slider-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(5, 158, 138, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-indicator.active {
            background: var(--primary-color);
            transform: scale(1.2);
        }
        .team-card.achlis {
            background-image: url('{{ asset("assets/achlis.jpg") }}');
            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: local;
        }
        .team-card.inas {
            background-image: url('{{ asset("assets/inas.jpg") }}');
            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: local;
        }
        .team-card.aqil {
            background-image: url('{{ asset("assets/aqil.jpg") }}');
            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: local;
        }
        @media (min-width: 1000px) {
            .team-slider-btn,
            .slider-indicators {
                display: none !important;
            }
            .team-slider {
                transform: none !important;
                display: flex !important;
                gap: 2rem;
                overflow: visible !important;
            }
            .container {
                padding: 0 8px;
            }
            .hero-container {
                grid-template-columns: 1fr 1fr !important;
                text-align: left !important;
                gap: 4rem !important;
                align-items: center !important;
            }
            .hero-content { 
                max-width: 100%;
            }
            .hero-content h1 {
                font-size: 2.5rem;
            }
            .hero-content h2 {
                font-size: 1.5rem;
            }
            .showcase-card {
                transform: none;
                max-width: 600px;
                margin: 0 auto;
            }
            .showcase-card:hover {
                transform: none;
            }
            .metric-card {
                padding: 1.1rem;
                min-height: 90px;
            }
            .metric-icon { font-size: 1.7rem; }
            .metric-value { font-size: 1.2rem; }
            .metric-label { font-size: 0.85rem; }
            .team-card {
                min-width: 200px;
                border-radius: 20px;
                overflow: hidden;
            }
            .team-image {
                width: 150px;
                height: 180px;
            }
            .team-card-content {
                width: 90%;
            }
            .team-card h3 {
                font-size: 1.15rem;
            }
            .team-card h4 {
                font-size: 1.05rem;
            }
        }
        @media (min-width: 700px) {
            .feature-card {
                padding: 1.2rem;
            }
            .team-slider-wrapper {
                padding: 0 10px;
            }
            .team-card-content {
                width: 90%;
                padding: 1.2rem;
                border-radius: 20px;
            }
            .section-title h2 {
                font-size: 1.3rem;
            }
            .section-title p {
                font-size: 0.95rem;
            }
            .features,
            .about,
            .footer {
                padding: 2.5rem 0;
            }
            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 1rem;
            }
            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .footer-links {
                grid-template-columns: repeat(2, 1fr);
            }
            .demo-container {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            .demo-content {
                text-align: center;
            }
            .showcase-card {
                transform: none;
                margin-top: 2rem;
            }
            .showcase-card:hover {
                transform: scale(1.02);
            }
            .showcase-content {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .metric-card {
                padding: 0.7rem;
                min-height: 60px;
            }
            .metric-icon { font-size: 1.1rem; }
            .metric-value { font-size: 0.85rem; }
            .metric-label { font-size: 0.7rem; }
            .team-slider-wrapper {
                max-width: 100%;
                padding: 0 60px;
            }
            .team-grid {
                flex-direction: column;
                gap: 1px;
                background: linear-gradient(to bottom, 
                    transparent, 
                    rgba(5, 158, 138, 0.2), 
                    transparent
                );
            }            
            .team-card {
                min-width: 200px;
                border-radius: 20px;
                overflow: hidden;
            }
            .team-image {
                width: 150px;
                height: 180px;
            }
            .team-card-content {
                width: 90%;
            }
            .team-card h3 {
                font-size: 1rem;
            }
            .team-card h4 {
                font-size: 0.9rem;
            }
            .team-card:not(:last-child)::after {
                display: none;
            }
            .team-card:first-child {
                border-radius: 20px 20px 0 0;
            }
            .team-card:last-child {
                border-radius: 0 0 20px 20px;
            }    
        }
        @media (min-width: 400px) {
            .hero-content h1 {
                font-size: 1.2rem;
            }
            .hero-content h2 {
                font-size: 1rem;
            }
            .footer-content {
                gap: 1rem;
            }
            .metric-card {
                padding: 0.3rem !important;
                min-height: 40px !important;
            }
            .metric-icon {
                font-size: 0.7rem !important;
            }
            .metric-value {
                font-size: 0.5rem;
            }
            .metric-label {
                font-size: 0.4rem;
            }
            .team-card::after {
                height: 80%;
                bottom: -80%;
            }
            .team-slider-wrapper {
                padding: 0 50px;
            }
            .team-card {
                min-width: 200px;
                border-radius: 20px;
                overflow: hidden;
            }
            .team-image {
                width: 100px;
                height: 120px;
            }
            .team-card-content {
                width: 90%;
            }
            .team-card h3 {
                font-size: 0.95rem;
            }
            .team-card h4 {
                font-size: 0.8rem;
            }          
        }
    </style>
</head>
<body>
    <div class="scroll-indicator"></div>
    <header class="header">
        <nav class="navbar container">
            <a href="#" class="logo">
                <i class="fas fa-leaf text-2xl text-emerald-300"></i>
                HydroCabin
            </a>
            <div class="nav-menu">
                <a href="#hero" class="nav-link active">Home</a>
                <a href="#features" class="nav-link">Fitur</a>
                <a href="#about" class="nav-link">Kami</a>
            </div>
        </nav>
    </header>
    <section id="hero" class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Sistem Monitoring Lingkungan Hidroponik</h1>
                <h2>by HydroCabin</h2>
                <p>Gunakan teknologi pemantauan hidroponik real-time untuk menjaga lingkungan tumbuh tetap ideal setiap saat.</p>
                <a href="{{ route('login.form') }}" class="btn btn-primary">Start Monitoring</a>
            </div>
            <div class="hero-showcase">
                <div class="showcase-card">
                    <div class="metrics-grid">
                        <div class="metric-card">
                            <i class="fas fa-temperature-high metric-icon"></i>
                            <div class="metric-value">25°C</div>
                            <div class="metric-label">Temperature</div>
                        </div>
                        <div class="metric-card">
                            <i class="fas fa-tint metric-icon"></i>
                            <div class="metric-value">60%</div>
                            <div class="metric-label">Humidity</div>
                        </div>
                        <div class="metric-card">
                            <i class="fas fa-compress-alt metric-icon"></i>
                            <div class="metric-value">1013 hPa</div>
                            <div class="metric-label">Pressure</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="features">
        <div class="container">
            <div class="section-title">
                <h2>Introduce Our Systems to Anyone!</h2>
                <p>Sistem kami membantu Anda untuk memantau lingkungan hidroponik Anda dengan mudah dan efisien.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Real-time Monitoring</h3>
                    <p>Pantau suhu, kelembaban, dan tekanan secara real-time dengan sensor BME280 melalui Firebase.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔔</div>
                    <h3>Notifikasi Monitoring</h3>
                    <p>Dapatkan notifikasi instan melalui web dan Telegram ketika parameter diluar ambang batas.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Mobile Access</h3>
                    <p>Pantau sistem dari mana saja dengan perangkat mobile.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <div class="section-title">
                <h2>Hydrocabin Team</h2>
                <p>Mengembangkan sistem monitoring lingkungan hidroponik ini dengan duka yang mendalam. Sama hanya denga terbentuknya ekspektasi awal dari anggota team</p>
            </div>
            <div class="team-slider-wrapper">
                <button class="team-slider-btn prev" aria-label="Sebelumnya">&#10094;</button>
                <div class="team-slider">
                    <div class="team-card achlis">
                        <div class="team-card-content">
                            <div class="team-image">
                                <img src="{{ asset('assets/achlis.jpg') }}" alt="achlis">
                            </div>
                            <h3>Achlis Muhammad Yusuf</h3>
                            <p class="nim">J-080</p>
                            <h4>UI Design</h4>
                        </div>
                    </div>
                    <div class="team-card inas">
                        <div class="team-card-content">
                            <div class="team-image">
                                <img src="{{ asset('assets/inas.jpg') }}" alt="inas">
                            </div>
                            <h3>Inas Samara Taqia</h3>
                            <p class="nim">J-167</p>
                            <h4>IoT and Web Developer </h4>
                        </div>
                    </div>
                    <div class="team-card aqil">
                        <div class="team-card-content">
                            <div class="team-image">
                                <img src="{{ asset('assets/aqil.jpg') }}" alt="aqil">
                            </div>
                            <h3>Muhammad Aqil Fazli Yulianto</h3>
                            <p class="nim">J-147</p>
                            <h4>Prototype Casing and Conseptor</h4>
                        </div>
                    </div>
                </div>
                <button class="team-slider-btn next" aria-label="Berikutnya">&#10095;</button>
            </div>
            <div class="slider-indicators">
                <div class="slider-indicator active" data-slide="0"></div>
                <div class="slider-indicator" data-slide="1"></div>
                <div class="slider-indicator" data-slide="2"></div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <h3>HydroCabin</h3>
                    <p>Sistem monitoring lingkungan hidroponik. Membuat monitoring hidroponik lebih cerdas dan mudah diakses oleh semua orang.</p>
                </div>

                <div class="footer-bottom">
                    <p>&copy; {{ date('Y') }} HydroCabin. Website project by Group 11.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('section');
            const header = document.querySelector('.header');
            const headerHeight = header.offsetHeight;
            function smoothScroll(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                if (targetSection) {
                    const targetPosition = targetSection.offsetTop - headerHeight;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }
            function updateActiveState() {
                const scrollPosition = window.scrollY + headerHeight + 100;
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    const sectionId = section.getAttribute('id');
                    if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                        navLinks.forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href') === `#${sectionId}`) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
                if (window.scrollY < 100) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === '#hero') {
                            link.classList.add('active');
                        }
                    });
                }
            }
            navLinks.forEach(link => {
                link.addEventListener('click', smoothScroll);
            });
            window.addEventListener('scroll', updateActiveState);
            updateActiveState();
            const logo = document.querySelector('.logo');
            logo.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            const scrollIndicator = document.querySelector('.scroll-indicator');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                if (scrollIndicator) {
                    scrollIndicator.style.width = scrolled + '%';
                }
            });
            const slider = document.querySelector('.team-slider');
            const cards = document.querySelectorAll('.team-card');
            const prevBtn = document.querySelector('.team-slider-btn.prev');
            const nextBtn = document.querySelector('.team-slider-btn.next');
            const indicators = document.querySelectorAll('.slider-indicator');
            let currentSlide = 0;
            const totalSlides = cards.length;
            function getCardWidth() {
                const card = slider ? slider.querySelector('.team-card') : null;
                if (!card) return 0;
                const style = window.getComputedStyle(card);
                const marginRight = parseInt(style.marginRight) || 0;
                const marginLeft = parseInt(style.marginLeft) || 0;
                return card.offsetWidth + marginLeft + marginRight + 32; 
            }
            function updateSlider() {
                const cardWidth = getCardWidth();
                const translateX = -currentSlide * cardWidth;
                if (slider) {
                    slider.style.transform = `translateX(${translateX}px)`;
                }
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === currentSlide);
                });
                prevBtn.disabled = currentSlide === 0;
                nextBtn.disabled = currentSlide === indicators.length - 1;
            }
            function nextSlide() {
                if (currentSlide < indicators.length - 1) {
                    currentSlide++;
                    updateSlider();
                }
            }
            function prevSlide() {
                if (currentSlide > 0) {
                    currentSlide--;
                    updateSlider();
                }
            }
            function goToSlide(slideIndex) {
                currentSlide = slideIndex;
                updateSlider();
            }
            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => goToSlide(index));
            });
            let startX = 0;
            let endX = 0;
            slider.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            });
            slider.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].clientX;
                handleSwipe();
            });
            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = startX - endX;
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }
                }
            }
            function adjustSliderForScreenSize() {
                updateSlider();
            }
            window.addEventListener('resize', adjustSliderForScreenSize);
            updateSlider();
        });
    </script>
</body>
</html>