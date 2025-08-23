<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manajemen Sistem</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        left: -100%;
        top: 0;
        bottom: 0;
        z-index: 40;
        transition: 0.3s;
        width: 80%;
        max-width: 300px;
      }
      .sidebar.active {
        left: 0;
      }
      .mobile-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 30;
      }
      .mobile-overlay.active {
        display: block;
      }
      .mobile-menu-btn {
        display: block !important;
        position: fixed;
        top: 1rem;
        right: 1rem;
        z-index: 50;
        background: #fff;
        padding: 0.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      }
      main {
        padding: 1rem !important;
      }
      .card {
        min-height: 140px !important;
      }
      .card-value {
        font-size: 1.75rem !important;
      }
      .chart-container {
        height: 250px !important;
      }
    }
    .cards {
      max-width: 1200px;
      margin: 0 auto;
      margin-bottom: 10px;
      display: grid;
      grid-gap: 1rem;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    .mobile-menu-btn {
      display: none;
    }
    .card {
      background: white;
      padding: 1.5rem;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
    }
    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .plant-bg {
      position: absolute;
      width: 100%;
      height: 100%;
      background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 20C30 20 20 40 20 50C20 60 30 80 50 80C70 80 80 60 80 50C80 40 70 20 50 20ZM50 30C60 30 65 40 65 50C65 60 60 70 50 70C40 70 35 60 35 50C35 40 40 30 50 30Z' fill='%23059e8a' fill-opacity='0.1'/%3E%3C/svg%3E");
      background-size: 100px 100px;
      animation: Float 20s linear infinite;
    }
    @keyframes Float {
      0% {
        background-position: 0 0;
      }
      100% {
        background-position: 100px 100px;
      }
    }
    .header-underline { 
      border-bottom: 3px solid #059e8a; 
      padding-bottom: 0.5rem; 
      margin-bottom: 1rem; 
    }
    th, td { 
      text-align: center; 
    }
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    .switch input { 
      opacity: 0; 
      width: 0; 
      height: 0; 
    }
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 34px;
    }
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }
    input:checked + .slider { background-color: #059e8a; }
    input:checked + .slider:before { transform: translateX(26px); }
    .sensor-alert {
      display: flex;
      align-items: center;
      margin-bottom: 8px;
    }
    .sensor-icon {
      width: 24px;
      height: 24px;
      margin-right: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background-color: #f87171;
      color: white;
    }
    .alert-detail {
      flex: 1;
    }
    .alert-history-entry {
      padding: 8px;
      border-bottom: 1px solid #e5e7eb;
      transition: background-color 0.2s;
    }
    .alert-history-entry:hover {
      background-color: #f3f4f6;
    }
    #telegramTestResult {
      min-height: 20px;
    }
  </style>
</head>
<body class="flex bg-[#AFE1AF] font-sans min-h-screen relative">
  <button class="mobile-menu-btn" onclick="toggleSidebar()"><i class="fas fa-bars text-xl text-gray-600"></i></button>
  <div class="mobile-overlay" onclick="toggleSidebar()"></div>
  <aside id="sidebar" class="sidebar bg-gradient-to-b from-emerald-800 to-brown-200 text-white w-64 h-screen">
    @include('layouts.sidebar')
  </aside>
  <main class="flex-1 p-6 py-[50px] mx-[50px]">
    <div class="flex justify-between items-center mb-4 ">
      <h2 class="text-2xl font-bold text-emerald-800">Manajemen Sistem</h2>
    </div>
    <div id="notification" class="hidden mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
      <div class="flex justify-between items-start">
        <div>
          <strong class="font-bold">⚠️ Peringatan Sensor!</strong>
          <div id="alertText" class="mt-2"></div>
        </div>
        <button onclick="this.parentElement.parentElement.classList.add('hidden')" class="text-red-700 hover:text-red-900">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>
    <div id="messageNotification" class="hidden mb-4 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded">
      <div class="flex justify-between items-start">
        <div>
          <strong class="font-bold">📨 Pesan Peringatan</strong>
          <div id="messageText" class="mt-2"></div>
        </div>
        <button onclick="this.parentElement.parentElement.classList.add('hidden')" class="text-blue-700 hover:text-blue-900">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>
    <div id="telegramNotification" class="hidden mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
      <div class="flex justify-between items-start">
        <div>
          <strong class="font-bold">📱 Status Telegram</strong>
          <div id="telegramText" class="mt-2"></div>
        </div>
        <button onclick="this.parentElement.parentElement.classList.add('hidden')" class="text-green-700 hover:text-green-900">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow mb-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-gradient-to-br from-teal-50 to-blue-50 p-6 rounded-xl shadow-sm">
          <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-teal-100 rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
              </svg>
            </div>
            <h4 class="text-xl font-semibold text-teal-700">Informasi Batasan Normal</h4>
          </div>
          <div class="space-y-4">
            <div class="bg-white p-4 rounded-lg shadow-sm w-full">
              <div class="flex items-center gap-2 mb-3">
                <div class="w-8 h-8 flex items-center justify-center bg-red-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                </svg>
                </div>
                <h5 class="font-semibold text-gray-700">Suhu (°C)</h5>
              </div>
              <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg px-4 py-3 text-center">
                  <span class="block text-xs text-gray-500 mb-1">Minimum</span>
                  <span class="font-bold text-lg text-gray-700">18</span>
                </div>
                <div class="bg-gray-50 rounded-lg px-4 py-3 text-center">
                  <span class="block text-xs text-gray-500 mb-1">Maksimum</span>
                  <span class="font-bold text-lg text-gray-700">25</span>
                </div>
              </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm w-full">
              <div class="flex items-center gap-2 mb-3">
                <div class="w-8 h-8 flex items-center justify-center bg-blue-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                </div>
                <h5 class="font-semibold text-gray-700">Kelembaban (%)</h5>
              </div>
              <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg px-4 py-3 text-center">
                  <span class="block text-xs text-gray-500 mb-1">Minimum</span>
                  <span class="font-bold text-lg text-gray-700">40</span>
                </div>
                <div class="bg-gray-50 rounded-lg px-4 py-3 text-center">
                  <span class="block text-xs text-gray-500 mb-1">Maksimum</span>
                  <span class="font-bold text-lg text-gray-700">60</span>
                </div>
              </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-sm w-full">
              <div class="flex items-center gap-2 mb-3">
                <div class="w-8 h-8 flex items-center justify-center bg-purple-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd" />
                </svg>
                </div>
                <h5 class="font-semibold text-gray-700">Tekanan (hPa)</h5>
              </div>
              <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-lg px-4 py-3 text-center">
                  <span class="block text-xs text-gray-500 mb-1">Minimum</span>
                  <span class="font-bold text-lg text-gray-700">500</span>
                </div>
                <div class="bg-gray-50 rounded-lg px-4 py-3 text-center">
                  <span class="block text-xs text-gray-500 mb-1">Maksimum</span>
                  <span class="font-bold text-lg text-gray-700">1013</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl shadow-sm">
          <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-green-100 rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
            </div>
            <h4 class="text-xl font-semibold text-green-700">Pengaturan Notifikasi</h4>
          </div>
          <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <h5 class="font-semibold text-gray-700 mb-4">Notifikasi Telegram</h5>
            <div class="space-y-4">
              <div>
                <label class="block text-sm text-gray-600 mb-1">Token Bot Telegram</label>
                <input type="text" id="telegramToken" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Masukkan token bot">
              </div>
              <div>
                <label class="block text-sm text-gray-600 mb-1">Chat ID</label>
                <input type="text" id="telegramChatId" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Masukkan chat ID">
              </div>
              <div class="flex items-center gap-3">
                <label class="switch">
                  <input type="checkbox" id="toggleTelegram" checked>
                  <span class="slider round"></span>
                </label>
                <span class="text-sm text-gray-600">Aktifkan Notifikasi Telegram</span>
              </div>
            </div>
          </div>
          <div class="bg-white p-4 rounded-lg shadow-sm">
            <h5 class="font-semibold text-gray-700 mb-4">Pengaturan Umum</h5>
            <div class="flex items-center gap-3">
              <label class="switch">
                <input type="checkbox" id="toggleAlerts" checked>
                <span class="slider round"></span>
              </label>
              <span class="text-sm text-gray-600">Aktifkan Notifikasi Peringatan</span>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-8 flex justify-end">
        <button onclick="saveSettings()" class="bg-gradient-to-r from-teal-500 to-green-500 text-white px-8 py-3 rounded-lg font-medium hover:from-teal-600 hover:to-green-600 transition-all duration-200 shadow-md">
          Simpan Pengaturan
        </button>
      </div>
    </div>
  </main>

  <script>
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      const overlay = document.querySelector('.mobile-overlay');
      sidebar.classList.toggle('active');
      overlay.classList.toggle('active');
    }
    document.addEventListener('click', function(event) {
      const sidebar = document.querySelector('.sidebar');
      const overlay = document.querySelector('.mobile-overlay');
      const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
      
      if (sidebar.classList.contains('active') && 
          !sidebar.contains(event.target) && 
          !mobileMenuBtn.contains(event.target)) {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
      }
    });
    const firebaseConfig = {
      apiKey: "{{ config('services.firebase.api_key') }}",
      authDomain: "{{ config('services.firebase.auth_domain') }}",
      databaseURL: "{{ config('services.firebase.database_url') }}",
      projectId: "{{ config('services.firebase.project_id') }}",
      storageBucket: "{{ config('services.firebase.storage_bucket') }}",
      messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
      appId: "{{ config('services.firebase.app_id') }}"
    };
    firebase.initializeApp(firebaseConfig);
    const userId = "0iY5iE17GQOxdQ524YFCEWRthwe2";
    let currentThresholds = {
      temperature: { min: 18, max: 25 },
      humidity: { min: 40, max: 60 },
      pressure: { min: 500, max: 1013 }
    };
    let telegramConfig = {
      botToken: '',
      chatId: '',
      enabled: true
    };
    let isInitialLoad = true;
    let alertsEnabled = true;
    let lastWebAlertTime = 0;
    let lastTelegramAlertTime = 0;
    let telegramTestLock = false;
    let lastSensorValues = {};
    let activeAlerts = [];
    let alertTimers = {};
    let lastAlertSent = {};
    let lastAlertDismissed = {};
    const alertCooldown = 10000; 

    const pathVariations = [
      `SensorData/${userId}/sensor_readings`,
      `SensorData/${userId}/readings`,
      `UsersData/${userId}/readings`,
      `UsersData/${userId}/sensor_readings`
    ];
    let sensorRef;
    let settingsRef;
    let alertHistoryRef;
    async function findCorrectPath() {
      console.log('Checking possible database paths...');
      for (const path of pathVariations) {
        console.log(`Checking path: ${path}`);
        try {
          const snapshot = await firebase.database().ref(path).once('value');
          if (snapshot.exists()) {
            console.log(`Found data at path: ${path}`);
            console.log('Data sample:', snapshot.val());
            return path;
          } else {
            console.log(`No data at path: ${path}`);
          }
        } catch (error) {
          console.error(`Error checking path ${path}:`, error);
        }
      }
      
      console.log('No data found in any of the checked paths');
      return pathVariations[0];
    }

    findCorrectPath().then(correctPath => {
      console.log('Using database path:', correctPath);
      sensorRef = firebase.database().ref(correctPath);
      settingsRef = firebase.database().ref(`${correctPath.split('/').slice(0, -1).join('/')}/settings`);
      alertHistoryRef = firebase.database().ref(`${correctPath.split('/').slice(0, -1).join('/')}/alertHistory`);
      initializeApp();
    }).catch(error => {
      console.error('Error during path initialization:', error);
      Swal.fire({
        icon: 'error',
        title: 'Error Koneksi',
        text: 'Gagal menginisialisasi koneksi database: ' + error.message
      });
    });
    
    let currentSettings = {
      alertsEnabled: true,
      telegramConfig: {
        ...telegramConfig
      },
      thresholds: currentThresholds
    };
    function formatSensorValue(value, type) {
      const numValue = Number(value);
      if (isNaN(numValue)) return '--';
      
      switch(type) {
        case 'temperature':
          return `${numValue.toFixed(1)}°C`;
        case 'humidity':
          return `${numValue.toFixed(1)}%`;
        case 'pressure':
          return `${numValue.toFixed(1)}hPa`;
        default:
          return numValue.toFixed(1);
      }
    }
    function checkSensorConditions(sensorData) {
      if (!sensorData || typeof sensorData !== 'object') {
        console.log('Invalid sensor data:', sensorData);
        return [];
      }
      const alerts = [];
      const temp = Number(sensorData.temperature);
      const hum = Number(sensorData.humidity);
      const pres = Number(sensorData.pressure);
      console.log('Checking sensor values:', { temp, hum, pres });
      console.log('Against thresholds:', currentThresholds);
      if (!isNaN(temp)) {
        if (temp < currentThresholds.temperature.min) {
          alerts.push({
            type: 'temperature',
            name: 'Suhu',
            value: temp,
            status: 'low',
            threshold: currentThresholds.temperature.min,
            unit: '°C'
          });
        } else if (temp > currentThresholds.temperature.max) {
          alerts.push({
            type: 'temperature',
            name: 'Suhu',
            value: temp,
            status: 'high',
            threshold: currentThresholds.temperature.max,
            unit: '°C'
          });
        }
      }
      if (!isNaN(hum)) {
        if (hum < currentThresholds.humidity.min) {
          alerts.push({
            type: 'humidity',
            name: 'Kelembaban',
            value: hum,
            status: 'low',
            threshold: currentThresholds.humidity.min,
            unit: '%'
          });
        } else if (hum > currentThresholds.humidity.max) {
          alerts.push({
            type: 'humidity',
            name: 'Kelembaban',
            value: hum,
            status: 'high',
            threshold: currentThresholds.humidity.max,
            unit: '%'
          });
        }
      }
      if (!isNaN(pres)) {
        if (pres < currentThresholds.pressure.min) {
          alerts.push({
            type: 'pressure',
            name: 'Tekanan',
            value: pres,
            status: 'low',
            threshold: currentThresholds.pressure.min,
            unit: 'hPa'
          });
        } else if (pres > currentThresholds.pressure.max) {
          alerts.push({
            type: 'pressure',
            name: 'Tekanan',
            value: pres,
            status: 'high',
            threshold: currentThresholds.pressure.max,
            unit: 'hPa'
          });
        }
      }

      return alerts;
    }

    async function sendSensorStatus(sensorData, isAlert = false) {
      try {
        if (!sensorData || !currentSettings.telegramConfig.enabled || !currentSettings.alertsEnabled) {
          return;
        }
        const { temperature, humidity, pressure } = sensorData;
        const { thresholds } = currentSettings.thresholds;
        let message = isAlert ? `🚨 <b>PERINGATAN SENSOR!</b>\n\n` : `📊 <b>STATUS SENSOR TERKINI</b>\n\n`;
        message += `🌡️ Suhu: ${formatSensorValue(temperature, 'temperature')} (Normal: ${thresholds.temperature.min}-${thresholds.temperature.max}°C)\n`;
        message += `💧 Kelembaban: ${formatSensorValue(humidity, 'humidity')} (Normal: ${thresholds.humidity.min}-${thresholds.humidity.max}%)\n`;
        message += `🌪️ Tekanan: ${formatSensorValue(pressure, 'pressure')} (Normal: ${thresholds.pressure.min}-${thresholds.pressure.max}hPa)\n\n`;
        const alerts = checkSensorConditions(sensorData);
        if (alerts.length > 0) {
          message += `⚠️ <b>PERINGATAN:</b>\n${alerts.map(alert => `- ${alert.name}: ${alert.value} ${alert.unit} (${alert.status === 'low' ? 'di bawah' : 'di atas'} batas ${alert.threshold} ${alert.unit})`).join('\n')}\n\n`;
        } else {
          message += `✅ Semua sensor dalam kondisi normal\n\n`;
        }
        message += `🕒 Update: ${new Date().toLocaleString('id-ID')}`;
        await sendTelegramNotification(message);
      } catch (error) {
        console.error('Error sending sensor status:', error);
      }
    }

    function loadSettings() {
      settingsRef.once('value').then(async snapshot => {
        const settings = snapshot.val() || {};
        console.log('Memuat pengaturan dari Firebase:', settings);
        
        currentSettings = {
          ...currentSettings,
          ...settings,
          telegramConfig: {
            ...currentSettings.telegramConfig,
            ...(settings.telegramConfig || {})
          }
        };
        document.getElementById('telegramToken').value = currentSettings.telegramConfig.botToken || '';
        document.getElementById('telegramChatId').value = currentSettings.telegramConfig.chatId || '';
        document.getElementById('toggleTelegram').checked = currentSettings.telegramConfig.enabled;
        document.getElementById('toggleAlerts').checked = currentSettings.alertsEnabled;
        if (currentSettings.telegramConfig.enabled && currentSettings.alertsEnabled) {
          console.log('Menunggu 10 detik sebelum cek status sensor...');
          setTimeout(async () => {
            try {
              console.log('Mengambil data sensor terbaru...');
              const sensorSnapshot = await sensorRef.orderByKey().limitToLast(1).once('value');
              const sensorData = sensorSnapshot.val();
              if (sensorData) {
                console.log('Data sensor ditemukan:', sensorData);
                const latestData = Object.values(sensorData)[0];
                console.log('Data terbaru:', latestData);
                await sendSensorStatus(latestData, true); 
        } else {
                console.log('Tidak ada data sensor tersedia');
                await sendTelegramNotification('⚠️ <b>PERINGATAN:</b> Tidak ada data sensor tersedia.');
              }
            } catch (error) {
              console.error('Error saat mengambil status sensor:', error);
              await sendTelegramNotification('❌ <b>ERROR:</b> Gagal mengambil data sensor.');
            }
          }, 10000);
        }
      }).catch(error => {
        console.error('Error loading settings:', error);
        showNotification('Error memuat pengaturan: ' + error.message, 'error');
      });
    }

    async function saveSettings() {
      try {
        Swal.fire({
          title: 'Menyimpan Pengaturan',
          text: 'Mohon tunggu...',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });
        const newSettings = {
          alertsEnabled: document.getElementById('toggleAlerts').checked,
          telegramConfig: {
          botToken: document.getElementById('telegramToken').value.trim(),
          chatId: document.getElementById('telegramChatId').value.trim(),
          enabled: document.getElementById('toggleTelegram').checked
          },
          thresholds: currentSettings.thresholds
        };
        if (newSettings.telegramConfig.enabled) {
          if (!newSettings.telegramConfig.botToken || !newSettings.telegramConfig.chatId) {
            throw new Error('Bot Token dan Chat ID harus diisi jika notifikasi Telegram diaktifkan');
          }
        }
        await settingsRef.update(newSettings);
        currentSettings = newSettings;
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: 'Pengaturan telah disimpan dan notifikasi telah diaktifkan',
          timer: 2000,
          showConfirmButton: false
        });
      } catch (error) {
        console.error('Error saving settings:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: error.message || 'Gagal menyimpan pengaturan',
          confirmButtonText: 'OK'
        });
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      loadSettings();
      document.getElementById('toggleTelegram').addEventListener('change', function() {
        const fields = document.querySelectorAll('#telegramToken, #telegramChatId');
        fields.forEach(field => {
          field.disabled = !this.checked;
          if (!this.checked) {
            field.classList.add('bg-gray-100');
          } else {
            field.classList.remove('bg-gray-100');
          }
        });
      });
      document.querySelector('button[onclick="saveSettings()"]').addEventListener('click', saveSettings);
    });

    function showNotification(message, type = 'info') {
      const notification = document.getElementById('notification');
      const alertText = document.getElementById('alertText');
      if (notification && alertText) {
        alertText.textContent = message;
        notification.classList.remove('hidden');
        notification.className = 'mb-4 p-4 rounded border';
        switch (type) {
          case 'success':
            notification.classList.add('bg-green-100', 'border-green-400', 'text-green-700');
            break;
          case 'error':
            notification.classList.add('bg-red-100', 'border-red-400', 'text-red-700');
            break;
          default:
            notification.classList.add('bg-blue-100', 'border-blue-400', 'text-blue-700');
        }
        setTimeout(() => {
          notification.classList.add('hidden');
        }, 5000);
      }
    }

    async function sendTelegramNotification(message) {
      try {
        const { botToken, chatId, enabled } = currentSettings.telegramConfig;
        console.log('Mencoba mengirim notifikasi Telegram:', {
          enabled,
          hasToken: !!botToken,
          hasChatId: !!chatId,
          message
        });
        if (!enabled) {
          console.log('Notifikasi Telegram tidak diaktifkan');
          return;
        }
        if (!botToken || !chatId) {
          console.error('Bot Token atau Chat ID tidak tersedia');
          return;
        }

        const telegramUrl = `https://api.telegram.org/bot${botToken}/sendMessage`;
        console.log('Mengirim ke URL:', telegramUrl);
        const response = await fetch(telegramUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            chat_id: chatId,
            text: message,
            parse_mode: 'HTML'
          })
        });

        const result = await response.json();
        console.log('Hasil response Telegram:', result);
        if (!result.ok) {
          throw new Error(result.description || 'Gagal mengirim notifikasi');
        }
        showNotification('Notifikasi Telegram berhasil dikirim', 'success');
      } catch (error) {
        console.error('Error sending Telegram notification:', error);
        showNotification('Gagal mengirim notifikasi Telegram: ' + error.message, 'error');
      }
    }

    firebase.database().ref('.info/connected').on('value', function(snapshot) {
      const connected = snapshot.val();
      console.log('Firebase connection state:', connected);
    });
    console.log('Monitoring sensor path:', `SensorData/${userId}/sensor_readings`);
    
    function handleSensorData(snapshot) {
      try {
        console.log('Raw snapshot:', snapshot.val());
        
        const data = snapshot.val();
        if (!data) {
          console.log('No data in snapshot');
          return;
        }
        let latestData = data;
        if (typeof data === 'object' && !Array.isArray(data)) {
          const entries = Object.entries(data);
          if (entries.length > 0) {
            latestData = entries[entries.length - 1][1];
            console.log('Latest data entry:', latestData);
          }
        }
        const sensorData = {
          temperature: Number(latestData.temperature) || 0,
          humidity: Number(latestData.humidity) || 0,
          pressure: Number(latestData.pressure) || 0,
          timestamp: latestData.timestamp || Date.now()
        };
        console.log('Processed sensor data:', sensorData);

        const tbody = document.getElementById('tbody');
        if (tbody) {
          tbody.innerHTML = `
            <tr>
              <td class="px-4 py-2">${formatDate(sensorData.timestamp)}</td>
              <td class="px-4 py-2">${formatSensorValue(sensorData.temperature, 'temperature')}</td>
              <td class="px-4 py-2">${formatSensorValue(sensorData.humidity, 'humidity')}</td>
              <td class="px-4 py-2">${formatSensorValue(sensorData.pressure, 'pressure')}</td>
            </tr>
          `;
        }
        lastSensorValues = sensorData;
        if (isInitialLoad) {
          const alertNotif = document.getElementById('alertNotification');
          if (alertNotif) alertNotif.classList.add('hidden');
          isInitialLoad = false;
          return;
        }
        if (alertsEnabled) {
          const alerts = checkSensorConditions(sensorData);
          console.log('Alert check result:', alerts);
          if (alerts.length > 0) {
            showAlertNotification(alerts);
          } else {
            const alertNotif = document.getElementById('alertNotification');
            if (alertNotif) alertNotif.classList.add('hidden');
          }
        }
      } catch (error) {
        console.error('Error handling sensor data:', error);
      }
    }

    function initializeApp() {
      console.log('Initializing app...');
      console.log('User ID:', userId);
      console.log('Sensor path:', `SensorData/${userId}/sensor_readings`);
      firebase.database().ref('.info/connected').on('value', function(snapshot) {
        console.log('Firebase connection state:', snapshot.val());
      });
      loadSettings();
      loadAlertHistory();
      console.log('Starting sensor listener...');
      sensorRef
        .orderByKey()
        .limitToLast(1)
        .on('value', handleSensorData, function(error) {
          console.error('Error in sensor listener:', error);
          Swal.fire({
            icon: 'error',
            title: 'Error Koneksi Sensor',
            text: 'Terjadi kesalahan saat membaca data sensor: ' + error.message
          });
        });
      
      document.getElementById('toggleAlerts').addEventListener('change', function() {
        alertsEnabled = this.checked;
        settingsRef.update({ alertsEnabled: this.checked })
          .catch(err => console.error("Error updating alerts status:", err));
      });
      
      document.getElementById('toggleTelegram').addEventListener('change', function() {
        telegramConfig.enabled = this.checked;
      });
      console.log('Testing direct data read...');
      sensorRef.once('value')
        .then(snapshot => {
          console.log('Direct read result:', snapshot.val());
          if (!snapshot.exists()) {
            console.log('No data exists at path');
          }
        })
        .catch(error => {
          console.error('Direct read error:', error);
        });

      console.log('App initialized');
    }

    function loadAlertHistory() {
      if (!alertHistoryRef) {
        console.log('Alert history reference not initialized');
        return;
      }
      alertHistoryRef.orderByChild('timestamp').limitToLast(50).on('value', snapshot => {
        const alertHistory = document.getElementById('alertHistory');
        if (!alertHistory) {
          console.log('Alert history element not found');
          return;
        }
        alertHistory.innerHTML = '';
        
        if (snapshot.exists()) {
          const alerts = [];
          snapshot.forEach(childSnapshot => {
            alerts.push(childSnapshot.val());
          });
          alerts.sort((a, b) => b.timestamp - a.timestamp);
          alerts.forEach(alert => {
            const alertEntry = document.createElement('div');
            alertEntry.className = 'alert-history-entry';
            alertEntry.innerHTML = `
              <div class="font-medium text-gray-700">${formatDate(alert.timestamp)}</div>
              <div class="mt-1 text-sm">${alert.message}</div>
            `;
            alertHistory.appendChild(alertEntry);
          });
        } else {
          alertHistory.innerHTML = '<div class="p-4 text-center text-gray-500">Belum ada riwayat peringatan</div>';
        }
      }, error => {
        console.error('Error loading alert history:', error);
      });
    }

    function showAlertNotification(alerts) {
      if (!alerts || alerts.length === 0) {
        document.getElementById('notification')?.classList.add('hidden');
        document.getElementById('messageNotification')?.classList.add('hidden');
        document.getElementById('telegramNotification')?.classList.add('hidden');
        return;
      }
      const notification = document.getElementById('notification');
      const alertText = document.getElementById('alertText');
      const messageNotification = document.getElementById('messageNotification');
      const messageText = document.getElementById('messageText');
      const telegramNotification = document.getElementById('telegramNotification');
      const telegramText = document.getElementById('telegramText');
      if (!notification || !alertText) {
        console.error('Notification elements not found');
        return;
      }
      let alertMessage = '<div class="space-y-2">';
      alerts.forEach(alert => {
        const statusText = alert.status === 'low' ? 'terlalu rendah' : 'terlalu tinggi';
        const icon = alert.status === 'low' ? '↓' : '↑';
        alertMessage += `
          <div class="flex items-start space-x-2">
            <span class="text-lg">${icon}</span>
            <div>
              <span class="font-medium">${alert.name}</span>
              <span> ${statusText}: ${alert.value}${alert.unit}</span>
              <span class="text-sm text-gray-600"> (batas ${alert.status === 'low' ? 'min' : 'max'}: ${alert.threshold}${alert.unit})</span>
            </div>
          </div>
        `;
      });
      alertMessage += '</div>';
      alertText.innerHTML = alertMessage;
      notification.classList.remove('hidden');

      if (messageNotification && messageText) {
        const currentTime = formatDate(Date.now());
        messageText.innerHTML = `
          <div class="flex items-center space-x-2">
            <div>
              <div>Pesan peringatan telah dibuat</div>
              <div class="text-sm text-gray-600">Waktu: ${currentTime}</div>
              <div class="text-sm mt-1">
                ${alerts.map(alert => 
                  `• ${alert.name}: ${alert.value}${alert.unit}`
                ).join('<br>')}
              </div>
            </div>
          </div>
        `;
        messageNotification.classList.remove('hidden');
      }

      if (typeof alertHistoryRef !== 'undefined') {
        const alertEntry = {
          timestamp: Date.now(),
          alerts: alerts,
          message: alerts.map(alert => 
            `${alert.name} ${alert.status === 'low' ? 'terlalu rendah' : 'terlalu tinggi'}: ${alert.value}${alert.unit}`
          ).join(', ')
        };
        alertHistoryRef.push(alertEntry)
          .catch(error => console.error('Error saving alert history:', error));
      }
      if (currentSettings?.telegramConfig?.enabled) {
        const currentTime = new Date().toLocaleString('id-ID', {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric',
          hour: '2-digit',
          minute: '2-digit',
          second: '2-digit'
        });
        const telegramMessage = `⚠️ <b>PERINGATAN!!!</b> ⚠️\n` +
          `━━━━━━━━━━━━━━━━━━━━━\n\n` +
          `📅 <b>Waktu:</b> ${currentTime}\n\n` +
          `${alerts.map(alert => {
            const sensorNames = {
              temperature: '🌡️ Suhu',
              humidity: '💧 Kelembaban',
              pressure: '⚖️ Tekanan'
            };
            const units = {
              temperature: '°C',
              humidity: '%',
              pressure: 'hPa'
            };
            const statusEmoji = alert.status === 'high' ? '📈 Terlalu Tinggi' : '📉 Terlalu Rendah';
            const sensorName = sensorNames[alert.type] || alert.name;
            return `<b>${sensorName}</b>\n` +
                   ` Nilai Saat Ini: <b>${alert.value.toFixed(2)} ${units[alert.type] || alert.unit}</b>\n` +
                   ` Status: <b>${statusEmoji}</b>\n` +
                   ` Batas ${alert.status === 'high' ? 'Maksimal' : 'Minimal'}: <b>${alert.threshold} ${units[alert.type] || alert.unit}</b>`;
          }).join('\n\n')}\n\n` +
          `ℹ️ <i>Mohon segera periksa kondisi Hidroponik anda.</i>\n`;
        
        if (telegramNotification && telegramText) {
          telegramText.innerHTML = `
            <div class="flex items-center space-x-2">
              <svg class="animate-spin h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <div>
                <div>Mengirim notifikasi ke Telegram...</div>
                <div class="text-sm text-gray-600">Mohon tunggu</div>
              </div>
            </div>
          `;
          telegramNotification.classList.remove('hidden');
        }
        sendTelegramNotification(telegramMessage)
          .then(() => {
            if (telegramNotification && telegramText) {
              const sentTime = formatDate(Date.now());
              telegramText.innerHTML = `
                <div class="flex items-center space-x-2">
                  <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <div>
                    <div>Notifikasi berhasil dikirim ke Telegram</div>
                    <div class="text-sm text-gray-600">Waktu: ${sentTime}</div>
                  </div>
                </div>
              `;
            }
          })
          .catch(error => {
            console.error('Error sending Telegram notification:', error);
            if (telegramNotification && telegramText) {
              telegramText.innerHTML = `
                <div class="flex items-center space-x-2">
                  <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
                  <div>
                    <div>Gagal mengirim notifikasi ke Telegram</div>
                    <div class="text-sm text-red-600">${error.message}</div>
                  </div>
                </div>
              `;
            }
          });
      }
    }
    function formatDate(timestamp) {
      const date = new Date(timestamp);
      return date.toLocaleString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
      });
    }
    loadSettings().then(() => {
      if (currentSettings?.telegramConfig?.enabled) {
        console.log('Telegram notifications enabled');
      }
    });
  </script>
</body>
</html>