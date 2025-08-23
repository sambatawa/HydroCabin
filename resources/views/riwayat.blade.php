<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Data</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
      .action-buttons {
        flex-direction: column;
        gap: 0.5rem;
      }
      .table-container {
        margin-top: 1rem;
      }
      .header-actions {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch !important;
      }
      #timeFilter {
        width: 100%;
      }
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
    .header-underline {
      border-bottom: 3px solid #059e8a;
      padding-bottom: 0.5rem;
      margin-bottom: 1.5rem;
    }
    .table-container {
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      overflow: hidden;
    }
    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
    }
    th {
      background-color: #f3f4f6;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      padding: 1rem;
      text-align: center;
      border-bottom: 2px solid #e5e7eb;
    }
    td {
      padding: 1rem;
      text-align: center;
      vertical-align: middle;
      border-bottom: 1px solid #e5e7eb;
    }
    tr:hover {
      background-color: #f9fafb;
    }
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-weight: 500;
      transition: all 0.2s;
    }
    .btn-primary {
      background-color: #059e8a;
      color: white;
    }
    .btn-primary:hover {
      background-color: #048271;
    }
    .btn-danger {
      background-color: #dc2626;
      color: white;
    }
    .btn-danger:hover {
      background-color: #b91c1c;
    }
    .btn-warning {
      background-color: #d97706;
      color: white;
    }
    .btn-warning:hover {
      background-color: #b45309;
    }
    #timeFilter {
      border: 1px solid #e5e7eb;
      border-radius: 0.375rem;
      padding: 0.5rem 2rem 0.5rem 1rem;
      background-color: white;
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
      background-position: right 0.5rem center;
      background-repeat: no-repeat;
      background-size: 1.5em 1.5em;
    }
    .pagination-container {
      background-color: white;
      padding: 1rem;
      border-radius: 0.5rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      margin-top: 1rem;
    }
    .pagination-button {
      padding: 0.5rem 1rem;
      border: 1px solid #e5e7eb;
      border-radius: 0.375rem;
      background-color: white;
      color: #374151;
      font-weight: 500;
      transition: all 0.2s;
    }
    .pagination-button:hover:not(:disabled) {
      background-color: #f3f4f6;
    }
    .pagination-button:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
  </style>
</head>
<body class="flex bg-[#AFE1AF] font-sans min-h-screen relative">
  <button class="mobile-menu-btn" onclick="toggleSidebar()"><i class="fas fa-bars text-xl"></i></button>
  <div class="mobile-overlay" onclick="toggleSidebar()"></div>
  <aside class="sidebar bg-gradient-to-b from-emerald-800 to-brown-200 text-white w-64 min-h-screen">
    @include('layouts.sidebar')
  </aside>

  <main class="flex-1 p-6 overflow-y-auto">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0 header-actions">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
          Riwayat Data Sensor
        </h2>
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
          <select id="timeFilter" class="focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            <option value="all">Semua Data</option>
            <option value="15">15 Menit Terakhir</option>
            <option value="30">30 Menit Terakhir</option>
            <option value="60">1 Jam Terakhir</option>
            <option value="1440">24 Jam Terakhir</option>
          </select>
          <div class="flex gap-2">
            <button onclick="downloadPDF()" class="btn btn-primary flex-1 md:flex-none"><i class="fas fa-download mr-2"></i> Download PDF</button>
            <button onclick="deleteAllData()" class="btn btn-danger flex-1 md:flex-none"><i class="fas fa-trash mr-2"></i> Hapus Semua</button>
          </div>
        </div>
      </div>
    </div>
    <div class="table-container">
      <div class="overflow-x-auto">
        <table>
          <thead>
            <tr>
              <th>Waktu</th>
              <th>Suhu (°C)</th>
              <th>Kelembaban (%)</th>
              <th>Tekanan (hPa)</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tbody"></tbody>
        </table>
      </div>
    </div>
    <div class="pagination-container flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <button id="prevPage" onclick="changePage(-1)" class="pagination-button">
          <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
        </button>
        <span id="pagination-info" class="text-sm text-gray-600 font-medium"></span>
        <button id="nextPage" onclick="changePage(1)" class="pagination-button">
          Berikutnya <i class="fas fa-chevron-right ml-1"></i>
        </button>
      </div>
    </div>
  </main>
  <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-semibold text-gray-800">
          <i class="fas fa-edit text-emerald-600 mr-2"></i>
          Edit Data Sensor
        </h3>
        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <form id="editForm" class="space-y-4">
        <input type="hidden" id="editKey">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Suhu (°C)</label>
          <input type="text" id="editTemperature" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Kelembaban (%)</label>
          <input type="text" id="editHumidity" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tekanan (hPa)</label>
          <input type="text" id="editPressure" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
          <button type="button" onclick="closeModal()" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
            Batal
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-2"></i>
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
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
    const ref = firebase.database().ref(`SensorData/${userId}/readings`);
    const tbody = document.getElementById('tbody');

    let allData = [];
    let filteredData = [];
    let currentPage = 1;
    const rowsPerPage = 10;
    let currentFilter = 'all';

    function closeModal() {
      document.getElementById("editModal").classList.add("hidden");
    }

    function openModal(key, data) {
      document.getElementById("editKey").value = key;
      document.getElementById("editTemperature").value = data.temperature;
      document.getElementById("editHumidity").value = data.humidity;
      document.getElementById("editPressure").value = data.pressure;
      document.getElementById("editModal").classList.remove("hidden");
    }
    document.getElementById("editForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const key = document.getElementById("editKey").value;
      const updatedData = {
        temperature: parseFloat(document.getElementById("editTemperature").value.replace(',', '.')),
        humidity: parseFloat(document.getElementById("editHumidity").value.replace(',', '.')),
        pressure: parseFloat(document.getElementById("editPressure").value.replace(',', '.')),
        distance: parseFloat(document.getElementById("editDistance").value.replace(',', '.')),
      };
      ref.child(key).update(updatedData).then(() => {
        closeModal();
      });
    });

    function deleteData(key) {
      if (confirm("Yakin ingin menghapus data ini?")) {
        ref.child(key).remove();
      }
    }

    function deleteAllData() {
      if (confirm("Yakin ingin menghapus semua data?")) {
        ref.remove();
      }
    }

    function applyTimeFilter() {
      const filterValue = document.getElementById('timeFilter').value;
      currentFilter = filterValue;
      if (filterValue === 'all') {
        filteredData = [...allData];
        renderTable(1);
        return;
      }
      
      const minutes = parseInt(filterValue);
      const now = new Date();
      const timeThreshold = now.getTime() - (minutes * 60 * 1000);
      filteredData = allData.filter(({ data }) => {
        if (!data.timestamp) return false;
        
        const timestamp = data.timestamp * 1000;
        return timestamp >= timeThreshold;
      });
      currentPage = 1;
      renderTable(1);
    }

    function renderTable(page = 1) {
      tbody.innerHTML = "";
      const start = (page - 1) * rowsPerPage;
      const end = start + rowsPerPage;
      const paginatedItems = filteredData.slice(start, end);
      if (paginatedItems.length === 0) {
        tbody.innerHTML = `
          <tr>
            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
              <div class="flex flex-col items-center justify-center py-8">
                <i class="fas fa-database text-4xl text-gray-400 mb-2"></i>
                <p>Tidak ada data tersedia</p>
              </div>
            </td>
          </tr>
        `;
        return;
      }

      const rows = paginatedItems.map(({ key, data }) => {
        const temperature = data.temperature ? parseFloat(data.temperature) : '-';
        const humidity = data.humidity ? parseFloat(data.humidity) : '-';
        const pressure = data.pressure ? parseFloat(data.pressure) : '-';
        return `
          <tr class="hover:bg-gray-50">
            <td class="w-1/4 px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
              ${data.timestamp ? formatDate(data.timestamp * 1000) : '-'}
            </td>
            <td class="w-1/5 px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
              ${temperature !== '-' ? temperature.toFixed(2) : '-'}
            </td>
            <td class="w-1/5 px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
              ${humidity !== '-' ? humidity.toFixed(2) : '-'}
            </td>
            <td class="w-1/5 px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
              ${pressure !== '-' ? pressure.toFixed(2) : '-'}
            </td>
            <td class="w-32 px-4 py-4 whitespace-nowrap text-sm text-center">
              <div class="flex items-center justify-center space-x-2">
                <button onclick='deleteData("${key}")' 
                  class="btn-danger text-white px-3 py-1 rounded-lg text-xs flex items-center">
                  <i class="fas fa-trash mr-1"></i> Hapus
                </button>
              </div>
            </td>
          </tr>
        `;
      });

      tbody.innerHTML = rows.join('');
      updatePaginationControls();
    }

    function updatePaginationControls() {
      const totalPages = Math.ceil(filteredData.length / rowsPerPage);
      document.getElementById("pagination-info").textContent = `Halaman ${currentPage} dari ${totalPages || 1}`;
      document.getElementById("prevPage").disabled = currentPage === 1;
      document.getElementById("nextPage").disabled = currentPage === totalPages || totalPages === 0;
    }

    function changePage(delta) {
      const newPage = currentPage + delta;
      const totalPages = Math.ceil(filteredData.length / rowsPerPage);
      
      if (newPage > 0 && newPage <= totalPages) {
        currentPage = newPage;
        renderTable(currentPage);
      }
    }

    function formatDate(timestamp) {
      const date = new Date(timestamp);
      if (isNaN(date)) {
        return '-';
      }
      const pad = (n) => n.toString().padStart(2, '0');
      const day = pad(date.getDate());
      const month = pad(date.getMonth() + 1);
      const year = date.getFullYear();
      const hours = pad(date.getHours());
      const minutes = pad(date.getMinutes());
      const seconds = pad(date.getSeconds());
      return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    }

    ref.orderByChild('timestamp').on('value', snapshot => {
      allData = [];
      snapshot.forEach(childSnap => {
        allData.push({
          key: childSnap.key,
          data: childSnap.val()
        });
      });
      allData.reverse(); 

      if (currentFilter === 'all') {
        filteredData = [...allData];
      } else {
        const minutes = parseInt(currentFilter);
        const now = new Date();
        const timeThreshold = now.getTime() - (minutes * 60 * 1000);
        
        filteredData = allData.filter(({ data }) => {
          if (!data.timestamp) return false;
          const timestamp = data.timestamp * 1000;
          return timestamp >= timeThreshold;
        });
      }
      renderTable(currentPage);
    });
    document.getElementById('timeFilter').addEventListener('change', applyTimeFilter);
    function downloadPDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
      doc.setFontSize(16);
      doc.text('Riwayat Data Sensor', 14, 15);
      doc.setFontSize(10);
      const now = new Date();
      doc.text(`Dicetak pada: ${formatDate(now.getTime())}`, 14, 22);
      const filterValue = document.getElementById('timeFilter').value;
      let filterText = 'Semua Data';
      if (filterValue !== 'all') {
        const minutes = parseInt(filterValue);
        if (minutes === 1440) {
          filterText = '24 Jam Terakhir';
        } else if (minutes === 60) {
          filterText = '1 Jam Terakhir';
        } else {
          filterText = `${minutes} Menit Terakhir`;
        }
      }
      doc.text(`Filter: ${filterText}`, 14, 28);

      const tableData = filteredData.map(({ data }) => [
        data.timestamp ? formatDate(data.timestamp * 1000) : '-',
        data.temperature ? parseFloat(data.temperature).toFixed(2) : '-',
        data.humidity ? parseFloat(data.humidity).toFixed(2) : '-',
        data.pressure ? parseFloat(data.pressure).toFixed(2) : '-'
      ]);
      doc.autoTable({
        head: [['Waktu', 'Suhu (°C)', 'Kelembaban (%)', 'Tekanan (hPa)']],
        body: tableData,
        startY: 35,
        theme: 'grid',
        styles: {
          fontSize: 8,
          cellPadding: 2,
        },
        headStyles: {
          fillColor: [5, 158, 138],
          textColor: 255,
          fontSize: 9,
          fontStyle: 'bold',
        },
        alternateRowStyles: {
          fillColor: [240, 240, 240],
        },
        margin: { top: 35 }
      });
      doc.save(`riwayat_data_${formatDate(now.getTime()).replace(/[\/\s:]/g, '_')}.pdf`);
    }

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
  </script>
</body>
</html>