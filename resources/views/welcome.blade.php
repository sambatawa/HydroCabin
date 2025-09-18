<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HydroCabin</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        :root {
            --primary-color: #059e8a;
            --secondary-color: #047857;
            --accent-color: #00add6;
            --text-color: #0F795B;
            --light-bg: #AFE1AF;
            --white: #FFFFFF;
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }
        html, body {
            max-width: 100vw;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }
        html{
            scroll-behavior: smooth;
            scroll-padding-top: 80px; 
        }
        body {
            line-height: 1.6;
            color: var(--text-color);
            background-color: #0F795B;
            position: relative;
            overflow-x: hidden;
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
        .header {
            background-color: var(--white);
            padding: 20px 100px;
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
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 27px;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(90deg, #059669 0%, #047857 100%);
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .logo i {
            font-size: 35px;
            color: #10B981; 
            transition: transform 0.3s ease;
        }
        .nav-menu {
            display: flex;
            gap: 5px;
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
            padding: 10px 30px;
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
        .nav-link.active {
            color: var(--primary-color);
            font-weight: 600;
        }
        .nav-link.active::before {
            width: 80%;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(5, 158, 138, 0.1), rgba(4, 120, 87, 0.1));
            border-radius: var(--border-radius);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .nav-link.active::after {
            opacity: 1;
        }
        .contact{
            align-items: center;
            gap: 10px;
            color: #FFFFFF;
            font-weight: 500;
            text-decoration: none;
            padding: 10px 40px;
            border-radius: 8px;
            background: linear-gradient(90deg, #5CB684 0%, #059E8A 100%);
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .contact:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .contact:active {
            background: linear-gradient(90deg, #059E8A 0%, #5CB684 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .hero {
            height: 100vh;
            color: var(--white);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }
        .hero-bg{
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg, rgba(5, 158, 138, 0.6) 0%, rgba(4, 120, 87, 0.98) 100%);
            flex-direction: column;
            align-items: center;
            padding: 10% 0;
        }
        .hero-container {
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: left;
            justify-content: center;
            text-align: left;
        }
        .hero-content {
            width: 50%;
            padding-right: 100px;
        }
        .hero-showcase {
            width: 50%;
            align-self: center;
        }
        .hero-content::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: rotate 10s linear infinite;
            pointer-events: none;
        }
        @keyframes rotate {
            100% {
                transform: rotate(360deg);
            }
        }
        .hero-content h1 {
            font-size: 58px !important;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 20px;
            position: relative;
            background: linear-gradient(to right, #ffffff 20%, #e0e0e0 30%, #ffffff 70%,#e0e0e0 80%);
            background-clip: text;
                -webkit-text-fill-color: transparent;
            background-size: 200% auto;
            animation: shine 3s linear infinite;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
            letter-spacing: -1px;
        }
        @keyframes shine {
            to {
                background-position: 200% center;
            }
        }
        .hero-content h2 {
            font-size: 26px !important;
            margin-bottom: 1.5rem;
            color: transparent;
                -webkit-text-stroke: 1px rgba(255, 255, 255, 0.5);
            position: relative;
            display: inline-block;
            font-weight: 500;
            letter-spacing: -1px;
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
        @keyframes typing {
            0%, 90%, 100% {
                width: 0;
            }
            30%, 60% {
                width: 100%;
            }
        }
        .hero-content p {
            font-size: 20px;
            margin-bottom: 40px;
            color: rgba(255, 255, 255, 0.9);
            position: relative;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
            animation: fadeInUp 0.8s ease forwards;
            opacity: 0;
            transform: translateY(20px);
            animation-delay: 0.5s;
            font-weight: 300;
            letter-spacing: 0.2px;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .hero a{
            font-size: 20px;
            padding: 15px 60px;
        }
        .market {
            padding: 70px 150px; 
            position: relative;
            animation: fadeInUp 0.8s ease forwards;
            transform: translateY(20px);
            opacity: 0;
            animation-delay: 0.5s;
        }
        .market::before {
            content: "";
            position: absolute;
            inset: 40px 150px; 
            background: rgba(211, 211, 211, 0.3);
            z-index: 0;
        }
        .market * {
            position: relative;
            z-index: 1; 
        }
        .hero-showcase {
            position: relative;
            perspective: 2000px;
            width: 600px;
            height: 400px;
            align-items: center;
            justify-content: center;
        }
        .showcase-card{
            position: relative;
            aspect-ratio: 16/9;   
            background: rgba(255, 255, 255, 0.1); 
            border-radius: 20px;   
            overflow: hidden;
            padding: 20px;
            transform: rotateY(-5deg) rotateX(5deg); 
            transition: transform 0.5s ease;  
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2), inset 0 0 0 1px rgba(255, 255, 255, 0.1);            
        }
        .showcase-card:hover {
            transform: rotateY(-5deg) rotateX(2deg) scale(1.02);
        }
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: 300px;          
            gap: 1.5rem;
            max-width: 100%;
            box-sizing: border-box;
        }
        .metric-card {
            width: 100%;
            padding: 20px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-sizing: border-box;
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.8s;
        }
        .metric-card:hover {
            transform: translateY(-5px) scale(1.02);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .metric-card:hover::before {
            left: 100%;
            transition: 0.8s;
        }
        .metric-card i {
            font-size: 40px;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%);
                -webkit-background-clip: text;
            background-clip: text;
                -webkit-text-fill-color: transparent;
            opacity: 0.9;
            animation: iconPulse 2s infinite;
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
        .metric-value {
            font-size: 30px !important;
            font-weight: 500;
            font-style: italic;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%);
                -webkit-background-clip: text;
            background-clip: text;
                -webkit-text-fill-color: transparent;
            position: relative;
            animation: valueLoad 2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
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
        .metric-label {
            font-size: 20px !important;
            font-weight: 600;
            text-transform: uppercase;
            opacity: 0;
            animation: labelAppear 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            animation-delay: 0.8s;
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
        .features{
            width: 100vw;
            height: auto;
            position: relative;
            background: #0F795B;
        }
        .features-container{ 
            padding: 100px 150px;
        }
        .about{
            height: 50vh;
            display: flex;
            flex-direction: row;
            gap: 20px;
        }
        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .img-about {
            position: relative;
            width: 50%;
            height: 100%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 5px -7px 5px rgba(211, 211, 211, 0.2);
            animation: fadeInUp 0.8s ease forwards;
            transform: translateY(20px);
            animation-delay: 0.5s;
        }
        .img-about::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(211,211,211,0.4);
            box-shadow: inset 5px -7px 60px rgba(0, 0, 0, 0.5); 
        }
        .text-about {
            width: 50%;
            height: 100%;
            height: auto;
            padding: 0 40px;
            flex-direction: column;
        }
        .text-about p, .text-about div {
            margin-top: 20px;
        }
        .text-about h2 {
            font-size: 40px;
            font-weight: 500;
            line-height: 1.2;
            color: rgba(255, 255, 255, 1);
            opacity: 0; 
            animation: slideLeft 0.8s ease forwards;
            animation-delay: 0.5s;
        }
        .text-about p {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
            text-align: justify;
            opacity: 0; 
            animation: slideLeft 0.8s ease forwards;
            animation-delay: 0.8s;
        }
        .text-about div {
            width: fit-content;
            padding: 10px 50px;
            font-size: 18px;
            border: 2px solid var(--white);
            background: transparent;
            color: rgba(255, 255, 255, 0.8);
            opacity: 0;
            animation: slideLeft 0.8s ease forwards;
            animation-delay: 0.8s;
            transition: all 0.3s ease;
        }
        @keyframes slideLeft {
            from {
                transform: translateX(50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .feature{
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 100px;
            padding: 80px 20px;
            border-radius: 0 0 300px 300px;
            background: linear-gradient(to top, rgba(211, 211, 211, 0.3), rgba(211, 211, 211, 0.1), rgba(211, 211, 211, 0) );            
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            animation: labelAppear 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            animation-delay: 0.8s;
        }
        .feature-system{
            width: 100%;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 50px 0;
        }
        .feature:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .feature-system h2 {
            position: relative;
            display: inline-block;
        }
        .text-stroke {
            position: absolute;
            top: 0;
            left: 0;
            font-size: 35px;;
            color: transparent;
                -webkit-text-stroke: 5px #059885; 
            z-index: 999;
            pointer-events: none;
        }
        .text-fill {
            position: relative;
            font-size: 35px;
            color: white;
            z-index: 1000;
        }
        .text-stroke,
        .text-fill {
            font-weight: 600;
        }
        .feature-system p{
            font-size: 20px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-top: 10px;
        }
        .feature-system-content {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 300px;
            color: rgba(255, 255, 255, 0.8);
            gap: 50px;
            margin-top: 40px;
            z-index: 1000;
        }
        .feature-system-content div{
            width: 400px;
            height: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .circle-container {
            position: relative;
            width: 500px;
            height: 500px;
            margin: 50px
        }
        .center-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120px;
            height: 120px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .center-logo img {
            width: 60%;
            height: auto;
        }
        .tech-icon {
            position: absolute;
            width: 150px;
            height: 150px;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .tech-icon img {
            width: 40%;
            height: auto;
        }
        .tech1 { top: 10%; left: 32%; transform: translate(-50%, -50%); }
        .tech2 { top: 10%; left: 68%; transform: translate(-50%, -50%); }
        .tech3 { top: 39%; left: 90%; transform: translate(-50%, -50%); }
        .tech4 { top: 73%; left: 86%; transform: translate(-50%, -50%); }
        .tech5 { top: 88%; left: 52%; transform: translate(-50%, -50%); }
        .tech6 { top: 75%; left: 18%; transform: translate(-50%, -50%); }
        .tech7 { top: 39%; left: 10%; transform: translate(-50%, -50%); }
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        .icon-ring {
            position: relative;
            width: 100%;
            height: 100%;
            transform: translate(-50%, -50%);
            animation: spin 20s linear infinite;
        }
        .us{
            width: 100vw;
            height: auto;
            background: linear-gradient(180deg, #0F795B 0%, #5CB684 100%); 
            position: relative;
            overflow: hidden;                   
        }
        .us-container {
            max-width: 90vw;
            height: auto;
            margin: 100px auto;
            padding: 0 20px;
            background: transparent;
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
            transform: translateY(-20px);
            animation-delay: 1s;        }
        .us-text {
            text-align: center;
            margin-bottom: 3rem;
        }
        .us-text h2 {
            font-size: 2.5rem;
            color: rgba(255, 255, 255, 1);
            margin-bottom: 1rem;
            font-weight: 600;
            letter-spacing: -0.5px;
        }
        .us-text p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            font-weight: 300;
            letter-spacing: 0.2px;
        }
        .faq {
            width: 100vw;
            height: 100vh;
            background: linear-gradient(180deg, #5CB684 0%, #0F795B 100%);
            padding: 50px 0 100px 0;
            position: relative;
            overflow: hidden;
        }
        .faq-container {
            width: 100%;
            height: 100%;
            background: transparent;
            display: flex;
            flex-direction: row;
        }
        .faq-content {
            width: 40%;
            border-radius: 0 100px 100px 0;
            background: #BBE3DD;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
            box-shadow: 10px 4px 4px #047857;
            padding: 13vh 0;
            opacity: 0;
            animation: slideRight 0.8s ease forwards;
            animation-delay: 0.8s;
        }
        @keyframes slideRight {
            from {
                transform: translateX(-50px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .faq-content h2 {
            font-size: 30px;
            font-weight: 600;
            letter-spacing: -0.5px;
            text-align: center;
        }
        .faq-list{
            padding: 20px 40px 0 40px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .faq-item {
            overflow: hidden;
            transition: all 0.5s ease;
            gap: 50px;
        }
        .faq-question{
            text-align: left;
            align-items: center;
            cursor: pointer;
        }
        .faq-question i{
            padding: 5px;
            border-radius: 20px;
            background: #047857;
            color: yellowgreen;
            font-size: 20px;
        }
        .faq-answer{
            padding: 0 30px 5px;
            display: none;
            animation: fadeIn 1s ease-in-out;
        }
        .faq-item.active .faq-answer{
            display:block;
        }
        .contact-content{
            width: 60%;
            padding: 0 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            opacity: 0;
            animation: slideLeft 0.8s ease forwards;
            animation-delay: 0.8s;
        }
        .contact-content h2{
            color: #FFFFFF;
            width: 100%;
            font-size: 27px;
            font-weight: 700;
            text-align: center;
        }
        .contact-content span{
            background: #FFFFFF;
            color: var(--primary-color);
            flex-direction: row;
            padding: 5px 30px; 
            border-radius: 20px;          
        }
        .contact-content i {
            font-size: 35px;
            color: var(--primary-color); 
            transition: transform 0.3s ease;
        }
        .contact-sos {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            text-align: center;
            margin-top: 20px;
            gap: 30px;
            border-bottom: 4px solid #AFE1AF;
            padding-bottom: 40px;           
        }
        .github, .linkedin, .instagram {
            display: flex;
            flex-direction: column;
        }
        .github i, .linkedin i, .instagram i{
            color: #FFFFFF;
            font-size: 20px;
        }
        .github span, .linkedin span, .instagram span{
            color: #FFFFFF;
            font-size: 10px;
            background: transparent;
            box-shadow: -10px 0px 2px rgba(255,255,255,0.2);
        }
        .contact-list {
            margin-top: 20px;
            padding: 20px 0;
            width: 100%;
        }
        form {
            width: 100%;
            margin: 0 auto;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .form-group.full {
            width: 100%;
        }
        label {
            margin-bottom: 6px;
            font-weight: 500;
            color: #fff;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            padding: 12px 16px !important;
            border: none;
            border-radius: 8px;
            background: white;
            
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            font-size: 18px;
            resize: none;
        }
        textarea {
            min-height: 150px;
        }
        .contact-btn {
            background-color: #0f795b;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 20px;
            align-self: flex-end;
            cursor: pointer;
            box-shadow: 3px 3px 10px rgba(0,0,0,0.2);
            transition: background 0.3s ease;
            display: block;
            margin: 20px auto 0;
        }
        .contact-btn:hover {
            background-color: #0c664d;
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
            background: linear-gradient(to right, transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
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
            background: #BBE3DD;
            width: 100vw;
            height: 40vh;
        }
        .footer-content {
            height: 100%;
            display: flex;
            padding: 70px 150px;
            flex-direction: row;
            justify-content: left; 
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
            animation-delay: 1s;
        }
        .footer-info-1 {
            width: 60vw;
            display: flex;
            flex-direction: column;
            padding-right: 120px;
            gap: 15px; 
        }
        .footer-bottom {
            text-align: start;
            padding-top: 16px;
            color: var(--gray);
        }
        .footer-bottom h3, .footer-info-2 span, .footer-info-3 span {
            font-weight: 600;
        }
        .footer-info-2 {
            width: 20vw;
            padding-top: 20px;
            flex-direction: column;
            display: flex;
            gap: 10px;
        }
        .footer-info-3 {
            width: 20vw;
            flex-direction: column;
            display: flex;
            padding-top: 20px;
            gap: 10px;
        }
        .info-content {
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        .footer-info h3 {
            font-size: 1.5rem;
            background: linear-gradient(90deg, #059669 0%, #047857 100%);
                -webkit-background-clip: text;
            background-clip: text;
                -webkit-text-fill-color: transparent;
            margin-bottom: 16px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }
        .team-slider-wrapper {
            position: relative;
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
        }
        .team-slider {
            display: flex;
            padding: 10px 0;
            transition: transform 0.5s ease-in-out;
            gap: 2rem;
        }
        .team-card {
            border-radius: 20px !important;
            overflow: hidden;
            width: 90vw;
            margin: 0 auto 2rem auto;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            background: var(--white);
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0;
            transition: box-shadow 0.3s, transform 0.3s;
            will-change: box-shadow, transform;
        }
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
        .team-card:hover::after{
            bottom: 0;
            background: linear-gradient(0deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.0) 100%);
        }
        .team-card-content {
            width: 80%;
            background: rgba(255,255,255,0.25);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
            border-radius: 0px 0px 50px 50px !important;
            margin: 0 auto 1.5rem auto;
            padding: 50px;
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
        .team-card{
            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: local;
        }
        .achlis {
            background-image: url('{{ asset("assets/achlis.jpg") }}');
        }
        .inas {
            background-image: url('{{ asset("assets/inas.jpg") }}');
        }
        .aqil {
            background-image: url('{{ asset("assets/aqil.jpg") }}');
        }
        @media (max-width: 1080px) {
            .team-slider-btn,
            .slider-indicators {
                display: none;
            }
            .hero {
                height: auto;
            }
            .hero-container {
                text-align: center;
                flex-direction: column;
                align-items: center;
                gap: 7px;
            }
            .hero-content { 
                width: 100%;
                margin: 0;
                padding: 0 100px;

            }
            .hero-content h1, .hero-content h2, .hero-content p, .hero-content a {
                margin: 5px;
            }
            .hero-showcase{
                height: 250px;
                margin: 0 auto;
            }
            .showcase-card {
                height: 100%;
                transform: none;
                margin: 0 auto;
            }
            .showcase-card:hover {
                transform: none;
            }
            .metric-card {
                max-height: 210px !important;
                padding: 5px !important;
            }
            .metric-card i{
                font-size: 30px !important;
            }
            .metric-value {
                font-size: 20px !important;
            }
            .metric-label {
                font-size: 15px !important;
            }
            .market::before {
                inset: 40px 100px !important;
            }
            .features-container {
                padding: 70px 100px;
            }
            .about {
                flex-direction: column;
                height: auto;
            }
            .img-about{
                width: 100%;
                height: 540px;
            }
            .text-about {
                width: 100%;
                padding: 0;
                text-align: center;
            }
            .feature {
                height: auto;
                border-radius: 0 0 100px 100px;
            }
            .feature-system-content {
                gap: 20px;
            }
            .feature-system-content div{
                width: 200px;
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
                height: 100%;
            }
            .team-card h3 {
                font-size: 1.15rem;
            }
            .team-card h4 {
                font-size: 1.05rem;
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
            .contact-content {
                padding: 0 100px;
            }
        }
    </style>
</head>
<body>
    <div class="scroll-indicator"></div>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <i class="fas fa-leaf"></i>
                HydroCabin
            </div>
            <div class="nav-menu">
                <a href="#hero" class="nav-link active">Home</a>
                <a href="#features" class="nav-link">Features</a>
                <a href="#us" class="nav-link">Us</a>
                <a href="#faq" class="nav-link">FAQ</a>
            </div>
            <a href="#faq" class="contact">
                Hubungi
            </a>
        </nav>
    </header>
    <section id="hero" class="hero bg-[url('/assets/latar.jpg')] h-screen w-full bg-cover bg-center">
        <div class="hero-bg">
            <div class="hero-container">
                <div class="hero-content">
                    <h1>Smart Hydroponic Environment Monitoring System</h1>
                    <h2>by HydroCabin</h2>
                    <p>Keep your plants thriving with automated tracking of temperature, humidity, and pressure. Access data anytime through a remote web dashboard and get instant Telegram alerts when conditions go beyond the ideal range.</p>
                    <a href="{{ route('login.form') }}" class="btn btn-primary">Start Monitoring</a>
                </div>
                <div class="hero-showcase">
                    <div class="showcase-card">
                        <div class="metrics-grid">
                            <div class="metric-card">
                                <i class="fas fa-temperature-high"></i>
                                <div class="metric-value">25°C</div>
                                <div class="metric-label">Temperature</div>
                            </div>
                            <div class="metric-card">
                                <i class="fas fa-tint"></i>
                                <div class="metric-value">60%</div>
                                <div class="metric-label">Humidity</div>
                            </div>
                            <div class="metric-card">
                                <i class="fas fa-compress-alt"></i>
                                <div class="metric-value">1013 hPa</div>
                                <div class="metric-label">Pressure</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="market grid grid-cols-3 text-center">
                <div class="user px-4 flex flex-row items-center justify-center gap-5 border-r-2 border-white">
                    <h3 class="text-5xl font-extrabold">5+</h3>
                    <p class="text-2xl lg:text-xl font-medium">Active User</p>
                </div>
                <div class="user px-4 flex flex-row items-center justify-center gap-5 border-r-2 border-white">
                    <h3 class="text-5xl font-extrabold">5+</h3>
                    <p class="text-2xl lg:text-xl font-medium">Available User</p>
                </div>
                <div class="user px-4 flex flex-row items-center justify-center gap-5">
                    <h3 class="text-5xl font-extrabold">10+</h3>
                    <p class="text-2xl lg:text-xl font-medium">Download</p>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="features">
        <div class="features-container">
            <div class="about">
                <div class="img-about">
                        <video autoplay muted loop playsinline preload="auto" class="video-background">
                            <source src="/assets/video.mp4" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                </div>
                <div class="text-about">
                    <h2>Lets Changes! <br>Your <span class="text-[#6fddc1]">Monitor</span> Hidroponic</h2>
                    <p>Real-time hydroponic monitoring technology brings precision and convenience to modern farming by automatically measuring critical parameters such as temperature, humidity, and pressure. This smart system ensures that plant growth conditions always remain at their optimal level, minimizing risks and maximizing productivity. The collected data is instantly visualized through a remote-accessible web dashboard, allowing growers to monitor and adjust their systems anytime, anywhere with Telegram notifications, providing instant alerts whenever exceed ideal thresholds, ensuring quick action and healthier, more consistent yields.</p>
                    <div><a href="#feature">Learn More</a></div>
                </div>
            </div>
            <div id="feature" class="feature">
                <div class="feature-tools">
                    <div class="circle-container">
                        <div class="center-logo">
                            <img src="/assets/firebase.png" alt="Firebase" />
                        </div>
                        <div class="icon-ring">
                            <div class="tech-icon tech1"><img src="/assets/LED.png" alt="LED"></div>
                            <div class="tech-icon tech2"><img src="/assets/bme.png" alt="Sensor"></div>
                            <div class="tech-icon tech3"><img src="/assets/php.png" alt="PHP"></div>
                            <div class="tech-icon tech4"><img src="/assets/tailwindcss.png" alt="Tailwind"></div>
                            <div class="tech-icon tech5"><img src="/assets/logotele.png" alt="Telegram"></div>
                            <div class="tech-icon tech6"><img src="/assets/laravel.png" alt="Laravel"></div>
                            <div class="tech-icon tech7"><img src="/assets/esp82.png" alt="ESP8266"></div>
                        </div>
                    </div>                    
                </div>
                <div class="feature-system">
                    <h2>
                        <span class="text-stroke">How systems works?</span>
                        <span class="text-fill">How systems works?</span>
                    </h2>                    
                    <p>Our system helps monitor hydroponic environments easily and efficiently.</p>
                    <div class="feature-system-content">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="us" class="us">
        <div class="us-container">
            <div class="us-text">
                <h2>Meet the Minds Behind the System</h2>
                <p>Building this hydroponic monitoring system wasn't always smooth sailing, but every challenge shaped us just like our first big dreams as a team.</p>
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

    <section id="faq" class="faq">
        <div class="faq-container">
            <div class="faq-content lg:px-[10px]">
                <h2>Frequently Asked Questions</h2>
                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question">
                            <i class="fa-solid fa-plus"></i>
                            What is HydroCabin?
                        </button>
                        <div class="faq-answer">HydroCabin is a smart hydroponic environment monitoring system that tracks temperature, humidity, and pressure in real-time.</div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <i class="fa-solid fa-plus"></i>
                            How does it work?
                        </button>
                        <div class="faq-answer">The system uses sensors to collect data, which is then displayed on a web dashboard and sent to users via Telegram notifications.</div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <i class="fa-solid fa-plus"></i>
                            Can I access the data remotely?
                        </button>
                        <div class="faq-answer">Yes, you can access the monitoring data from anywhere through our web dashboard.</div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <i class="fa-solid fa-plus"></i>
                            Is it easy to set up?
                        </button>
                        <div class="faq-answer">You will receive instant notifications via Telegram, allowing you to take immediate action to protect your plants.</div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <i class="fa-solid fa-plus"></i>
                            What if the conditions go beyond the ideal range?
                        </button>
                        <div class="faq-answer">Yes, HydroCabin is designed for easy installation and setup, making it accessible for both beginners and experienced hydroponic growers.</div>
                    </div> 
                    <div class="faq-item">
                        <button class="faq-question">
                            <i class="fa-solid fa-plus"></i>
                            What technologies are used in HydroCabin?
                        </button>
                        <div class="faq-answer">HydroCabin utilizes a combination of IoT sensors, web technologies, and cloud services to provide real-time monitoring and notifications.</div>
                    </div> 
                    <div class="faq-item">
                        <button class="faq-question">
                            <i class="fa-solid fa-plus"></i>
                            How can I get started?
                        </button>
                        <div class="faq-answer">You can start by signing up on our website and following the setup instructions to connect your hydroponic system.</div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <i class="fa-solid fa-plus"></i>
                            Is there a community or support available?
                        </button>
                        <div class="faq-answer">Yes, we have an active community and support team ready to help you with any questions or issues you may encounter.</div>
                    </div>
                    <p>If you have any questions or need assistance, feel free to reach out to us with <a href="mailto:ok4481067@gmail.com" class="text-yellow-400">THIS</a></p>
                </div>
            </div>
            <div class="contact-content">
                <h2>Partner with <span><i class="fas fa-leaf"></i> HydroCabin</span></h2>
                <div class="contact-sos">
                    <div class="github">
                        <a href="https://github.com/sambatawa"><i class="fa-brands fa-github"></i></a>
                        <span>sambatawa</span>
                    </div>
                    <div class="linkedin">
                        <a href="https://www.linkedin.com/in/inas-samara-taqia"><i class="fa-brands fa-linkedin-in"></i></a>
                        <span>Inas Samara Taqia</span>
                    </div>
                    <div class="instagram">
                        <a href="https://www.instagram.com/sambatawa_/profilecard/?igsh=MTdzdmlpZmtsa3BrbQ=="><i class="fa-brands fa-instagram"></i></a>
                        <span>@sambatawa_</span>
                    </div>
                </div>
                <div class="contact-list">
                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="nama" placeholder="Your name can our call" required>
                            </div>
                            <div class="form-group">
                                <label>Purpose</label>
                                <input type="text" name="tujuan" placeholder="Your purpose for us" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label>No. Telepon (optional)</label>
                                <input type="text" name="telepon" placeholder="+.../0...">
                            </div>
                        </div>
                        <div class="form-group full">
                            <label>Description</label>
                            <textarea name="pesan" rows="4" placeholder="Description" required></textarea>
                        </div>
                        <button class="contact-btn" type="submit">Send Massage</button>
                    </form>               
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content lg:px-[100px]">
            <div class="footer-info-1">
                <div class="logo">
                    <i class="fas fa-leaf"></i>
                    HydroCabin
                </div>                
                <div>Keep your plants thriving with automated tracking of temperature, humidity, and pressure. Access data anytime through a remote web dashboard and get instant Telegram alerts when conditions go beyond the ideal range.</div>
                <div class="footer-bottom">
                    <h3>Copyright</h3>
                    <p>&copy; {{ date('Y') }} HydroCabin. Website project by Group 11.</p>
                </div>                    
            </div>
            <div class="footer-info-2">
                <span>Quick Links</span>
                <div class="info-content">
                    <a href="#hero">Home</a>
                    <a href="#features">About</a>
                    <a href="#feature">Features</a>
                    <a href="#us">Us</a>
                    <a href="#faq">Contact</a>
                    <a href="#faq">FAQ</a>
                </div>
            </div>
            <div class="footer-info-3">
                <span>Contact Us</span>
                <div class="info-content">
                    <a href="">+62...</a>
                    <a href="">ok4481067@gmail.com</a>
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
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const icon = question.querySelector('i');
            question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            faqItems.forEach(i => {
                i.classList.remove('active');
                if (icon) {
                    icon.classList.remove('fa-minus')
                    icon.classList.add('fa-plus')
                }
            });
            if (!isActive) {
                item.classList.add('active');
                if (icon) {
                    icon.classList.remove('fa-plus')
                    icon.classList.add('fa-minus')
                }
            }
        });
    });
    </script>
</body>
</html>