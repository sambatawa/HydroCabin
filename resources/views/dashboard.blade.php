<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
  <link rel="apple-touch-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      position: fixed;
      top: 1rem;
      right: 1rem;
      z-index: 50;
      background: #fff;
      padding: 0.5rem;
      border-radius: 0.5rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 180px;
        border: none;
    }
    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #059e8a, #00add6);
        transition: all 0.3s ease;
    }
    .card-normal::before {
        background: linear-gradient(90deg, #059e8a, #00add6);
    }
    .card-warning::before {
        background: linear-gradient(90deg, #f59e0b, #fbbf24);
        animation: pulse 2s infinite;
    }
    .card-danger::before {
        background: linear-gradient(90deg, #ef4444, #ff6b6b);
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .card-header {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
        position: relative;
    }
    .card-icon {
        font-size: 1.75rem;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(5, 158, 138, 0.1), rgba(0, 173, 214, 0.1));
        color: #059e8a;
    }
    .card-title {
        color: #1f2937;
        font-weight: 600;
        font-size: 1rem;
        margin: 0;
        letter-spacing: -0.025em;
    }
    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0.5rem 0;
    }
    .card-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0.5rem 0;
        color: #059e8a;
        line-height: 1.2;
        letter-spacing: -0.025em;
    }
    .card-status {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .status-badge {
      padding: 0.25rem 0.75rem;
      border-radius: 9999px;
      font-weight: 600;
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .status-high {
      background-color: #FEE2E2;
      color: #ef4444;
      border: 1px solid #ef4444;
    }

    .status-low {
      background-color: #FEF3C7;
      color: #f59e0b;
      border: 1px solid #f59e0b;
    }

    .status-normal {
      background-color: rgba(5, 158, 138, 0.1);
      color: #059e8a;
    }
    /* Gaya Header */
    .header-underline {
      border-bottom: 3px solid #059e8a;
      padding-bottom: 0.5rem;
      margin-bottom: 1.5rem;
    }
    /* Notifikasi Peringatan */
    .alert-notification {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 1000;
      max-width: 400px;
    }
    /* Animasi */
    @keyframes pulse {
      0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
      70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
      100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
    }

    /* Responsive styles */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 1rem;
      }
      
      .card {
        min-height: 160px;
        padding: 1.25rem;
      }
      
      .card-icon {
        font-size: 1.5rem;
        width: 40px;
        height: 40px;
      }
      
      .card-value {
        font-size: 2rem;
      }
      
      .card-status {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
      }
    }

    /* Grid layout improvements */
    .cards {
        max-width: 1200px;
        margin: 0 auto 1.5rem auto;
        display: grid;
        grid-gap: 1.5rem;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        padding: 0.5rem;
    }

    /* Animation for warning status */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(245, 158, 11, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
        }
    }

    .status-warning .status-indicator {
        animation: pulse 2s infinite;
    }
  </style>
</head>
<body class="flex bg-[#AFE1AF] font-sans min-h-screen relative">
  <!-- Mobile Menu -->
  <button class="mobile-menu-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars text-xl"></i>
  </button>
  <div class="mobile-overlay" onclick="toggleSidebar()"></div>

  <!-- Sidebar -->
  <aside class="sidebar bg-gradient-to-b from-emerald-800 to-brown-200 text-white w-64 min-h-screen">
    @include('layouts.sidebar')
  </aside>

  <!-- Konten Utama -->
  <main class="flex-1 p-6 overflow-y-auto">
    <div id="alertNotification" class="alert-notification hidden">
      <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg">
        <div class="flex justify-between items-start">
          <div>
            <strong class="font-bold">Peringatan Sensor!</strong>
            <div id="alertMessage" class="mt-2"></div>
          </div>
          <button onclick="dismissAlert()" class="ml-4 text-red-700 hover:text-red-900">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl md:text-2xl font-bold text-gray-800">Dashboard Monitoring</h2>
    </div>
    <!-- card tampilan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div id="tempCard" class="card card-normal">
        <div class="card-header">
          <div class="card-icon">
            <i class="fas fa-thermometer-half"></i>
          </div>
          <p class="card-title">SUHU</p>
        </div>
        <div class="card-body">
          <h3 class="card-value"><span id="temp">--</span> °C</h3>
          <div id="tempStatus" class="card-status status-normal">Memuat...</div>
        </div>
      </div>
      <div id="humCard" class="card card-normal">
        <div class="card-header">
          <div class="card-icon">
            <i class="fas fa-tint"></i>
          </div>
          <p class="card-title">KELEMBABAN</p>
        </div>
        <div class="card-body">
          <h3 class="card-value"><span id="hum">--</span> %</h3>
          <div id="humStatus" class="card-status status-normal">Memuat...</div>
        </div>
      </div>
      <div id="presCard" class="card card-normal">
        <div class="card-header">
          <div class="card-icon">
            <i class="fas fa-angle-double-down"></i>
          </div>
          <p class="card-title">TEKANAN</p>
        </div>
        <div class="card-body">
          <h3 class="card-value"><span id="pres">--</span> hPa</h3>
          <div id="presStatus" class="card-status status-normal">Memuat...</div>
      </div>
      </div>
    </div>

    <!-- Grafik Individual -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div class="bg-white rounded-lg shadow-lg p-4">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Suhu</h2>
        <div style="height: 300px;">
          <canvas id="tempChart"></canvas>
        </div>
      </div>
      <div class="bg-white rounded-lg shadow-lg p-4">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Kelembaban</h2>
        <div style="height: 300px;">
          <canvas id="humChart"></canvas>
        </div>
      </div>
      <div class="bg-white rounded-lg shadow-lg p-4">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Tekanan</h2>
        <div style="height: 300px;">
          <canvas id="pressChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Grafik Gabungan -->
    <div class="grid grid-cols-1 gap-4 mb-6">
      <div class="bg-white rounded-lg shadow-lg p-4">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Sensor</h2>
        <div style="height: 400px;">
          <canvas id="sensorChart"></canvas>
        </div>
      </div>
    </div>

  <script>
    //ngegerakin sidebar
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

    //chartnya disesuaikan
    Chart.defaults.font.size = window.innerWidth < 768 ? 10 : 12;
    Chart.defaults.responsive = true;
    Chart.defaults.maintainAspectRatio = false;

    function dismissAlert() {
      const alertNotification = document.getElementById('alertNotification');
      if (alertNotification) {
        alertNotification.classList.add('hidden');
        alertNotification.style.display = 'none';
      }
    }

    const firebaseConfig = {
      apiKey: "{{ config('services.firebase.api_key') }}",
      authDomain: "{{ config('services.firebase.auth_domain') }}",
      databaseURL: "{{ config('services.firebase.database_url') }}",
      projectId: "{{ config('services.firebase.project_id') }}",
      storageBucket: "{{ config('services.firebase.storage_bucket') }}",
      messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
      appId: "{{ config('services.firebase.app_id') }}"
    };

      if (!firebase.apps.length) {
    firebase.initializeApp(firebaseConfig);
      }
      const database = firebase.database();
      const readingsRef = database.ref('SensorData/ZnZH95MCGvdfxPVwgfoRo3TdBnb2/readings');
      const settingsRef = database.ref('SensorData/ZnZH95MCGvdfxPVwgfoRo3TdBnb2/settings');

      const tempEl = document.getElementById('temp');
      const humEl = document.getElementById('hum');
      const presEl = document.getElementById('pres');
      const tempCard = document.getElementById('tempCard');
      const humCard = document.getElementById('humCard');
      const presCard = document.getElementById('presCard');
      const tempStatus = document.getElementById('tempStatus');
      const humStatus = document.getElementById('humStatus');
      const presStatus = document.getElementById('presStatus');
      const alertNotification = document.getElementById('alertNotification');
      const alertMessage = document.getElementById('alertMessage');

      // Variabel untuk chart
      let tempChart, humChart, pressChart, sensorChart;
      function createChart(canvasId, label, borderColor, backgroundColor) {
        const ctx = document.getElementById(canvasId).getContext('2d');
        return new Chart(ctx, {
          type: 'line',
          data: {
            labels: [],
            datasets: [{
              label: label,
              data: [],
              borderColor: borderColor,
              backgroundColor: backgroundColor,
              tension: 0.4,
              fill: true
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false
              },
              tooltip: {
                mode: 'index',
                intersect: false
              }
            },
            scales: {
              x: {
                grid: {
                  display: false
                },
                ticks: {
                  maxRotation: 45,
                  minRotation: 45
                }
              },
              y: {
                beginAtZero: false,
                grid: {
                  color: 'rgba(0, 0, 0, 0.1)'
                }
              }
            }
          }
        });
      }

      //update chart
      function updateChart(chart, labels, data) {
        if (!chart) return;
        
        chart.data.labels = labels;
        chart.data.datasets[0].data = data;
        chart.update();
      }

      let telegramConfig = {
        botToken: '',
        chatId: '',
        enabled: false
      };
      let alertsEnabled = true;

      function loadSettings() {
        console.log('Loading settings...');
        settingsRef.once('value').then(snapshot => {
          const settings = snapshot.val();
          console.log('Firebase settings loaded:', settings);
          if (settings) {
            if (settings.thresholds) {
              currentThresholds = settings.thresholds;
              console.log('Loaded thresholds:', currentThresholds);
            }
            
            // Alert settings
            alertsEnabled = settings.alertsEnabled !== undefined ? settings.alertsEnabled : true;
            console.log('Alerts enabled:', alertsEnabled);
            
            // Telegram settings
            if (settings.telegramConfig) {
              telegramConfig = {
                botToken: settings.telegramConfig.botToken || '',
                chatId: settings.telegramConfig.chatId || '',
                enabled: settings.telegramConfig.enabled !== undefined ? settings.telegramConfig.enabled : true
              };
              console.log('Loaded Telegram config:', {
                botToken: telegramConfig.botToken ? '***' : 'not set',
                chatId: telegramConfig.chatId ? '***' : 'not set',
                enabled: telegramConfig.enabled
              });
            } else {
              console.log('No Telegram config found in settings');
            }
          } else {
            console.log('No settings found in Firebase');
          }
          
          isInitialLoad = false;
        }).catch(error => {
          console.error('Error loading settings:', error);
          isInitialLoad = false;
        });
      }

    // nilai batasan normal
    let currentThresholds = {
      temperature: { min: 18, max: 30 },
      humidity: { min: 45, max: 60 },
      pressure: { min: 500, max: 1013 }
    };

    let lastAlertTime = 0;
    let alertCooldown = 10000; // diem dulu 10 detik
    let isInitialLoad = true;
    let lastSensorValues = {};
    function checkSensorConditions(sensorData) {
      if (!sensorData) return [];
      const alerts = [];
      //suhu
      if (sensorData.temperature !== undefined) {
        if (sensorData.temperature < currentThresholds.temperature.min) {
          alerts.push({
            type: 'temperature',
            value: sensorData.temperature,
            status: 'low',
            threshold: currentThresholds.temperature.min
          });
        } else if (sensorData.temperature > currentThresholds.temperature.max) {
          alerts.push({
            type: 'temperature',
            value: sensorData.temperature,
            status: 'high',
            threshold: currentThresholds.temperature.max
          });
        }
      }
      
      //kelembaban
      if (sensorData.humidity !== undefined) {
        if (sensorData.humidity < currentThresholds.humidity.min) {
          alerts.push({
            type: 'humidity',
            value: sensorData.humidity,
            status: 'low',
            threshold: currentThresholds.humidity.min
          });
        } else if (sensorData.humidity > currentThresholds.humidity.max) {
          alerts.push({
            type: 'humidity',
            value: sensorData.humidity,
            status: 'high',
            threshold: currentThresholds.humidity.max
          });
        }
      }
      
      // tekanan
      if (sensorData.pressure !== undefined) {
        if (sensorData.pressure < currentThresholds.pressure.min) {
          alerts.push({
            type: 'pressure',
            value: sensorData.pressure,
            status: 'low',
            threshold: currentThresholds.pressure.min
          });
        } else if (sensorData.pressure > currentThresholds.pressure.max) {
          alerts.push({
            type: 'pressure',
            value: sensorData.pressure,
            status: 'high',
            threshold: currentThresholds.pressure.max
          });
        }
      }
      
      return alerts;
    }

    // update card nilainya
    function updateSensorCard(cardElement, statusElement, alerts, sensorType) {
      if (!cardElement || !statusElement) return;
      const sensorAlert = alerts.find(alert => alert.type === sensorType);
      if (sensorAlert) {
        cardElement.classList.remove('card-normal', 'card-warning');
        cardElement.classList.add('card-danger');
        
        // ini teksnya
        const statusText = sensorAlert.status === 'high' 
          ? `HIGH (${sensorAlert.threshold})` 
          : `LOW (${sensorAlert.threshold})`;
        const statusClass = sensorAlert.status === 'high' ? 'status-high' : 'status-low';
        statusElement.innerHTML = `<span class="status-badge ${statusClass}">${statusText}</span>`;
      } else {
        cardElement.classList.remove('card-warning', 'card-danger');
        cardElement.classList.add('card-normal');
        statusElement.innerHTML = '<span class="status-badge status-normal">NORMAL</span>';
      }
    }

    //notifikasi alert 
    function showAlertNotification(alerts) {
      if (!alerts || alerts.length === 0 || !alertsEnabled) return;
      const now = Date.now(); //cooldown
      if (now - lastAlertTime < alertCooldown) return;
      lastAlertTime = now;
      
      //Format pesan
      const message = alerts.map(alert => {
        const sensorNames = {
          temperature: 'Suhu',
          humidity: 'Kelembaban',
          pressure: 'Tekanan'
        };
        const units = {
          temperature: '°C',
          humidity: '%',
          pressure: 'hPa'
        };
        const statusClass = alert.status === 'high' ? 'status-high' : 'status-low';
        return `<div class="mb-2">
          <strong>${sensorNames[alert.type]}:</strong> 
          ${alert.value.toFixed(2)}${units[alert.type]} 
          <span class="status-badge ${statusClass} text-sm">${alert.status === 'high' ? 'HIGH' : 'LOW'}: ${alert.threshold}${units[alert.type]}</span>
        </div>`;
      }).join('');

      // notifikasi floating
      const alertNotification = document.getElementById('alertNotification');
      const alertMessage = document.getElementById('alertMessage');
      if (alertNotification && alertMessage) {
        alertMessage.innerHTML = message;
        alertNotification.classList.remove('hidden');
        alertNotification.style.display = 'block';
        if (window._alertTimeout) clearTimeout(window._alertTimeout); //cooldown
        window._alertTimeout = setTimeout(() => {
          alertNotification.classList.add('hidden');
          alertNotification.style.display = 'none';
        }, 10000);
      }

      // Tpop up template SweetAlert
      Swal.fire({
        icon: 'warning',
        title: 'Peringatan Sensor!',
        html: `<div class="text-left">${message}</div>`,
        confirmButtonText: 'Mengerti',
        confirmButtonColor: '#ef4444',
        backdrop: true,
        allowOutsideClick: false,
        timer: 10000 // 10 detik untuk auto-close SweetAlert
      });

      // notifikasi telegram aktif
      if (telegramConfig && telegramConfig.enabled && telegramConfig.botToken && telegramConfig.chatId) {
        sendTelegramAlert(alerts);
      }
    }

    // notifikasi telegram mulai kirim pesan
    async function sendTelegramAlert(alerts) {
      console.log('Checking Telegram config:', telegramConfig);
      
      if (!telegramConfig.enabled) {
        console.log('Telegram notifications are disabled');
        return;
      }
      
      if (!telegramConfig.botToken || !telegramConfig.chatId) {
        console.error('Missing Telegram configuration:', {
          botToken: !!telegramConfig.botToken,
          chatId: !!telegramConfig.chatId
        });
        return;
      }

      const currentTime = new Date().toLocaleString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
      });
      
      const message = `⚠️ <b>PERINGATAN!!!</b> ⚠️\n` +
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
          return `<b>${sensorNames[alert.type]}</b>\n` +
                 ` Nilai Saat Ini: <b>${alert.value.toFixed(2)} ${units[alert.type]}</b>\n` +
                 ` Status: <b>${statusEmoji}</b>\n` +
                 ` Batas ${alert.status === 'high' ? 'Maksimal' : 'Minimal'}: <b>${alert.threshold} ${units[alert.type]}</b>`;
        }).join('\n\n')}\n\n` +
        `ℹ️ <i>Mohon segera periksa kondisi Hidroponik anda.</i>\n`;

      console.log('Sending Telegram message:', message);

      try {
        const response = await fetch(`https://api.telegram.org/bot${telegramConfig.botToken}/sendMessage`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            chat_id: telegramConfig.chatId,
            text: message,
            parse_mode: 'HTML'
          })
        });

        const result = await response.json();
        console.log('Telegram API response:', result);

        if (!response.ok) {
          throw new Error(`Telegram API error: ${result.description || 'Unknown error'}`);
        }
        console.log('Telegram message sent successfully');
      } catch (error) {
        console.error('Gagal mengirim notifikasi Telegram:', error);
        
        // nampilin error kalau gagal adain notifikasi
        Swal.fire({
          icon: 'error',
          title: 'Gagal Mengirim Notifikasi',
          text: `Error: ${error.message}`,
          confirmButtonColor: '#ef4444'
        });
      }
    }

    // status sensor diadain
    function checkAndUpdateSensorStatus(sensorData) {
      if (!sensorData) return;
      lastSensorValues = {
        temperature: Number(sensorData.temperature) || 0,
        humidity: Number(sensorData.humidity) || 0,
        pressure: Number(sensorData.pressure) || 0
      };
      
      const alerts = checkSensorConditions(lastSensorValues);//cek data sensor terakhir
      // Update card
      updateSensorCard(tempCard, tempStatus, alerts, 'temperature');
      updateSensorCard(humCard, humStatus, alerts, 'humidity');
      updateSensorCard(presCard, presStatus, alerts, 'pressure');
      
      //telegram dan alert terhubung
      if (alerts.length > 0 && alertsEnabled && !isInitialLoad) {
        showAlertNotification(alerts);
        const now = Date.now(); //cooldown
        if (now - lastAlertTime > alertCooldown) {
          lastAlertTime = now;
          sendTelegramAlert(alerts);
        }
      }
    }

    readingsRef.on('value', (snapshot) => {
      const rawData = snapshot.val();
      if (!rawData) {
        console.log('Tidak ada data sensor');
        tempEl.innerText = '--';
        humEl.innerText = '--';
        presEl.innerText = '--';
        updateChart(tempChart, [], []);
        updateChart(humChart, [], []);
        updateChart(pressChart, [], []);
        if(sensorChart) {
          sensorChart.data.labels = [];
          sensorChart.data.datasets.forEach(dataset => dataset.data = []);
          sensorChart.update();
        }
        return;
      }

      // dimapping ngurut data
      const dataArray = Object.entries(rawData)
        .map(([key, value]) => ({
          ...value,
          timestamp: value.timestamp || Number(key)
        }))
        .sort((a, b) => a.timestamp - b.timestamp);

      // Ambil data 5 menit terakhir
      const fiveMinutesAgo = Date.now() / 1000 - 300;
      const recentData = dataArray.filter(d => d.timestamp >= fiveMinutesAgo);

      // Siapkan array untuk chart
      const labels = [];
      const temps = [], hums = [], presses = [];

      recentData.forEach(d => {
        labels.push(formatTime(d.timestamp));
        temps.push(Number(d.suhu || d.temperature) || 0);
        hums.push(Number(d.kelembaban || d.humidity) || 0);
        presses.push(Number(d.tekanan || d.pressure) || 0);
      });

      if (recentData.length > 0) {
        const lastData = recentData[recentData.length - 1];// Update nilai card dan status
        const temp = Number(lastData.suhu || lastData.temperature) || 0;
        const hum = Number(lastData.kelembaban || lastData.humidity) || 0;
        const pres = Number(lastData.tekanan || lastData.pressure) || 0;
        tempEl.innerText = temp.toFixed(2);
        humEl.innerText = hum.toFixed(2);
        presEl.innerText = pres.toFixed(2);
        checkAndUpdateSensorStatus({
          temperature: temp,
          humidity: hum,
          pressure: pres
        });
      }

      // Update chart individual
      updateChart(tempChart, labels, temps);
      updateChart(humChart, labels, hums);
      updateChart(pressChart, labels, presses);

      // Update chart gabungan
      if(sensorChart) {
        sensorChart.data.labels = labels;
        sensorChart.data.datasets[0].data = temps;
        sensorChart.data.datasets[1].data = hums;
        sensorChart.data.datasets[2].data = presses;
        sensorChart.update();
      }
    });
    
    function formatTime(timestamp) {
      const date = new Date(timestamp * 1000);
      return date.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      });
    }

    // Inisialisasi saat DOM siap
    function initializeDashboard() {
      console.log('Inisialisasi dashboard...'); 
      
      // Inisialisasi chart
      tempChart = createChart("tempChart", "Suhu (°C)", "#059e8a", "rgba(5,158,138,0.2)");
      humChart = createChart("humChart", "Kelembaban (%)", "#00add6", "rgba(0,173,214,0.2)");
      pressChart = createChart("pressChart", "Tekanan (hPa)", "#e1e437", "rgba(225,228,55,0.2)");
      sensorChart = createCombinedChart("sensorChart");
      loadSettings();
      //status sebelum ada data
      tempStatus.textContent = "Menunggu data...";
      humStatus.textContent = "Menunggu data...";
      presStatus.textContent = "Menunggu data...";
      console.log('Dashboard diinisialisasi'); 
    }

    // Pastikan DOM sudah sepenuhnya dimuat sebelum inisialisasi
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
      setTimeout(initializeDashboard, 1);
    } else {
      document.addEventListener('DOMContentLoaded', initializeDashboard);
    }

    function createCombinedChart(canvasId) {
      const ctx = document.getElementById(canvasId).getContext('2d');
      return new Chart(ctx, {
        type: 'line',
        data: {
          labels: [],
          datasets: [
            {
              label: 'Suhu (°C)',
              data: [],
              borderColor: '#059e8a',
              backgroundColor: 'rgba(5,158,138,0.1)',
              yAxisID: 'y1',
              tension: 0.4
            },
            {
              label: 'Kelembaban (%)',
              data: [],
              borderColor: '#00add6',
              backgroundColor: 'rgba(0,173,214,0.1)',
              yAxisID: 'y2',
              tension: 0.4
            },
            {
              label: 'Tekanan (hPa)',
              data: [],
              borderColor: '#e1e437',
              backgroundColor: 'rgba(225,228,55,0.1)',
              yAxisID: 'y3',
              tension: 0.4
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          interaction: {
            mode: 'index',
            intersect: false
          },
          plugins: {
            legend: {
              position: 'top',
              labels: {
                usePointStyle: true,
                padding: 20
              }
            },
            tooltip: {
              mode: 'index',
              intersect: false
            }
          },
          scales: {
            x: {
              grid: {
                display: false
              },
              ticks: {
                maxRotation: 45,
                minRotation: 45
              }
            },
            y1: {
              type: 'linear',
              display: true,
              position: 'left',
              title: {
                display: true,
                text: 'Suhu (°C)'
              }
            },
            y2: {
              type: 'linear',
              display: true,
              position: 'right',
              title: {
                display: true,
                text: 'Kelembaban (%)'
              },
              grid: {
                drawOnChartArea: false
              }
            },
            y3: {
              type: 'linear',
              display: true,
              position: 'right',
              title: {
                display: true,
                text: 'Tekanan (hPa)'
              },
              grid: {
                drawOnChartArea: false
              }
            }
          }
        }
      });
    }
  </script>
  </main>
</body>
</html>