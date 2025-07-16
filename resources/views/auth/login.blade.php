<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Login</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
  <link rel="apple-touch-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #065f46 0%, #047857 100%);
      position: relative;
      min-height: 100vh;
    }
    .auth-container {
      background: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
      background-size: cover;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .auth-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(6, 95, 70, 0.85);
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
      font-weight: 700;
      font-size: 1.75rem;
      background: linear-gradient(90deg, #059669 0%, #047857 100%);
      -webkit-background-clip: text;
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
<body class="min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md">
    <div class="auth-card p-8">
      <div class="text-center mb-8">
        <h1 class="brand-logo text-3xl mb-1">HydroCabin</h1>
        <div class="form-header">
          <p class="text-gray-600 text-sm">Login ke Dashboard</p>
        </div>
      </div>

      @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-lg mb-6 text-sm flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
          </svg>
          {{ session('error') }}
        </div>
      @endif
      @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-600 p-3 rounded-lg mb-6 text-sm flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          {{ session('success') }}
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}" class="mb-6">
        @csrf
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
              </svg>
            </div>
            <input type="email" id="email" name="email" required placeholder="Masukkan email Anda"
                   class="w-full pl-10 pr-4 py-2.5 rounded-lg input-field focus:outline-none focus:ring-1 focus:ring-emerald-500"/>
          </div>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
              </svg>
            </div>
            <input type="password" id="password" name="password" required placeholder="••••••"
                   class="w-full pl-10 pr-4 py-2.5 rounded-lg input-field focus:outline-none focus:ring-1 focus:ring-emerald-500"/>
          </div>
        </div>
        <button type="submit"
                class="w-full bg-emerald-600 text-white py-3 rounded-lg btn-primary font-medium">
          Login
        </button>
      </form>

      <p class="text-center text-sm text-gray-600 mt-8">
        Belum memiliki akun?
        <a href="{{ route('register.form') }}" class="text-emerald-600 font-medium hover:text-emerald-800 transition-colors">Register</a>
      </p>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const database = getDatabase(app);
  </script>
</body>
</html>