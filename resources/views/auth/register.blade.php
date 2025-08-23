<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Register</title>
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
      border-radius: 16px;
      overflow: hidden;
    }
    .auth-card:hover {
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .brand-logo {
      font-weight: 700;
      font-size: 1.75rem;
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
    .form-header {
      position: relative;
      padding-bottom: 1rem;
      margin-bottom: 1.5rem;
    }
    .password-strength {
      height: 4px;
      margin-top: 0.5rem;
      background: #e5e7eb;
      border-radius: 2px;
      overflow: hidden;
    }
    .password-strength-bar {
      height: 100%;
      width: 0%;
      transition: width 0.3s ease, background-color 0.3s ease;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
  <div class="w-[500px]">
    <div class="auth-card p-8">
      <div class="text-center mb-8">
        <div class="logo"><i class="fas fa-leaf"></i>HydroCabin</div>
        <div class="form-header">
          <p class="text-gray-600 text-sm">Create a new account</p>
        </div>
      </div>
      @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 text-sm rounded relative" role="alert">
          <strong>Success:</strong> {{ session('success') }}
          <button onclick="this.parentElement.style.display='none'"
                  class="absolute inset-y-0 right-0 px-4 py-2 text-green-700 hover:text-green-900">×
          </button>
        </div>
      @endif
      @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-lg mb-6 text-sm">
          <div class="mb-1 font-semibold">Terdapat kesalahan:</div>
          <ul class="list-disc list-inside pl-5">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fa-solid fa-user text-gray-400"></i>
            </div>
            <input type="text" name="name" class="w-full pl-10 pr-4 py-2.5 rounded-lg input-field focus:outline-none focus:ring-1 focus:ring-emerald-500" placeholder="Name" required>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fa-solid fa-envelope text-gray-400"></i>
            </div>
            <input type="email" name="email" class="w-full pl-10 pr-4 py-2.5 rounded-lg input-field focus:outline-none focus:ring-1 focus:ring-emerald-500" placeholder="Email" required >
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fa-solid fa-lock text-gray-400"></i>
            </div>
            <input type="password" name="password" id="password" class="w-full pl-10 pr-4 py-2.5 rounded-lg input-field focus:outline-none focus:ring-1 focus:ring-emerald-500" placeholder="••••••" required >
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Password Confirmation</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fa-solid fa-lock text-gray-400"></i>
            </div>
            <input type="password" name="password_confirmation" class="w-full pl-10 pr-4 py-2.5 rounded-lg input-field focus:outline-none focus:ring-1 focus:ring-emerald-500" placeholder="••••••" required>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fa-solid fa-users text-gray-400"></i>
            </div>
            <select name="role" class="w-full pl-10 pr-4 py-3 rounded-lg text-gray-400 input-field focus:outline-none focus:ring-1 focus:ring-emerald-500 appearance-none" required>
              <option value="" class="hidden">Choose your role</option>
              <option value="user" class="text-emerald-700 rounded font-semibold">User</option>
              <option value="admin" class="text-emerald-700 font-semibold">Admin</option>
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
              <i class="fa-solid fa-chevron-down text-gray-400"></i>
            </div>
          </div>
        </div>
        <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg btn-primary font-medium">
          Register
        </button>
      </form>
      <p class="text-center text-sm text-gray-600 mt-8">
        Have any Account?
        <a href="{{ route('login.form') }}" class="text-emerald-600 font-medium hover:text-emerald-800 transition-colors">Login</a>
      </p>
    </div>
  </div>

  <script>
    function checkPasswordStrength(password) {
      const strengthBar = document.getElementById('password-strength-bar');
      let strength = 0;
      if (password.length >= 6) strength += 1;
      if (password.length >= 8) strength += 1;
      if (password.match(/([0-9])/)) strength += 1;
      
      const isNumeric = /^\d+$/.test(password);
      if (!isNumeric) {
        strengthBar.style.width = '0%';
        strengthBar.style.backgroundColor = '#ef4444';
        return;
      }
      switch(strength) {
        case 0:
          strengthBar.style.width = '0%';
          strengthBar.style.backgroundColor = '#ef4444';
          break;
        case 1:
          strengthBar.style.width = '33%';
          strengthBar.style.backgroundColor = '#ef4444';
          break;
        case 2:
          strengthBar.style.width = '66%';
          strengthBar.style.backgroundColor = '#f59e0b';
          break;
        case 3:
          strengthBar.style.width = '100%';
          strengthBar.style.backgroundColor = '#059669';
          break;
      }
    }
  </script>
</body>
</html>