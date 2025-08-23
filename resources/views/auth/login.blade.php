<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Login</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #065f46 0%, #047857 100%);
      position: relative;
      min-height: 100vh;
    }
    .logo {
      font-size: 27px;
      font-weight: 700;
      color: var(--primary-color);
      text-decoration: none;
      background: linear-gradient(90deg, #059669 0%, #047857 100%);
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .logo i {
      font-size: 35px;
      color: #10B981; 
      margin-right: 10px;
      transition: transform 0.3s ease;
    }
    .auth-card {
      position: relative;
      backdrop-filter: blur(8px);
      background: rgba(255, 255, 255, 0.95);
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      border-radius: 12px;
      overflow: hidden;
    }
    .auth-card:hover {
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .brand-logo {
      font-size: 40px;
      background: linear-gradient(90deg, #059669 0%, #047857 100%);
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .input-field {
      transition: all 0.3s ease;
      border: 1px solid #e5e7eb;
      background-color: #f9fafb;
    }
    .input-field:focus {
      border-color: #059669;
      box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.2);
      background-color: white;
    }
    .btn-primary {
      transition: all 0.3s ease;
      letter-spacing: 0.5px;
      background: linear-gradient(90deg, #059669 0%, #047857 100%);
      border: none;
      font-weight: 500;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 6px rgba(5, 150, 105, 0.3);
    }
    .divider {
      display: flex;
      align-items: center;
      text-align: center;
      color: #6b7280;
      margin: 1.5rem 0;
    }
    .divider::before, .divider::after {
      content: "";
      flex: 1;
      border-bottom: 1px solid #e5e7eb;
    }
    .divider::before {
      margin-right: 1rem;
    }
    .divider::after {
      margin-left: 1rem;
    }
    .btn-google {
      transition: all 0.3s ease;
      border: 1px solid #e5e7eb;
      font-weight: 500;
    }
    .btn-google:hover {
      background-color: #f9fafb;
      transform: translateY(-2px);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    .form-header {
      position: relative;
      padding-bottom: 1rem;
      margin-bottom: 1.5rem;
    }
  </style>
</head>
<body class="h-screen w-full flex items-center justify-center p-4">
  <div class="w-[500px]">
    <div class="auth-card p-8">
      <div class="text-center mb-8">
        <div class="logo"><i class="fas fa-leaf"></i>HydroCabin</div>
        <p class="form-header text-gray-600 text-sm">Login to Dashboard</p>
      </div>
      @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 text-sm rounded relative" role="alert">
          <strong>Error:</strong> {{ $errors->first() }}
          <button onclick="this.parentElement.style.display='none'" class="absolute inset-y-0 right-0 px-4 py-2 text-2xl text-red-700 hover:text-red-900">×</button>
        </div>
      @endif
      @if (session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 text-sm rounded relative" role="alert">
          <strong>Error:</strong> {{ session('error') }}
          <button onclick="this.parentElement.style.display='none'"
                  class="absolute inset-y-0 right-0 px-4 py-2 text-red-700 hover:text-red-900">×
          </button>
        </div>
      @endif
      @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 text-sm rounded relative" role="alert">
          <strong>Success:</strong> {{ session('success') }}
          <button onclick="this.parentElement.style.display='none'"
                  class="absolute inset-y-0 right-0 px-4 py-2 text-green-700 hover:text-green-900">×
          </button>
        </div>
      @endif
      <form method="POST" action="{{ route('login') }}" class="mb-6">
        @csrf
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex text-gray-400 items-center pointer-events-none"><i class="fa-solid fa-envelope"></i></div>
            <input type="email" id="email" name="email" required placeholder="Your Email" class="w-full pl-10 pr-4 py-2.5 rounded-lg input-field focus:outline-none focus:ring-1 focus:ring-emerald-500"/>
          </div>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex text-gray-400 items-center pointer-events-none"><i class="fa-solid fa-lock"></i></div>
            <input type="password" id="password" name="password" required placeholder="••••••" class="w-full pl-10 pr-4 py-2.5 rounded-lg input-field focus:outline-none focus:ring-1 focus:ring-emerald-500"/>
          </div>
        </div>
        <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg btn-primary font-medium">Login
        </button>
      </form>
      <p class="text-center text-sm text-gray-600 mt-8">
        Don't have Account?
        <a href="{{ route('register.form') }}" class="text-emerald-600 font-medium hover:text-emerald-800 transition-colors">Register</a>
      </p>
    </div>
  </div>
  <script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-app.js";
    import { getDatabase } from "https://www.gstatic.com/firebasejs/11.6.0/firebase-database.js";

    const firebaseConfig = {
      apiKey:    "{{ config('services.firebase.api_key') }}",
      authDomain:"{{ config('services.firebase.auth_domain') }}",
      databaseURL:"{{ config('services.firebase.database_url') }}",
      projectId: "{{ config('services.firebase.project_id') }}",
      storageBucket:"{{ config('services.firebase.storage_bucket') }}",
      messagingSenderId:"{{ config('services.firebase.messaging_sender_id') }}",
      appId:     "{{ config('services.firebase.app_id') }}"
    };
    const app = initializeApp(firebaseConfig);
    const database = getDatabase(app);
  </script>
</body>
</html>