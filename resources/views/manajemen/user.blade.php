<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path fill='%23059e8a' d='M272 96c-78.6 0-145.1 51.5-167.7 122.5c33.6-17 71.5-26.5 111.7-26.5h88c8.8 0 16 7.2 16 16s-7.2 16-16 16h-88c-16.6 0-32.7 1.9-48.3 5.4c-25.9 5.9-49.9 16.4-71.4 30.7c0 0 0 0 0 0C38.3 298.8 0 364.9 0 440v16c0 13.3 10.7 24 24 24s24-10.7 24-24v-16c0-48.7 20.7-92.5 53.8-123.2C121.6 392.3 190.3 448 272 448l1 0c132.1-.7 239-130.9 239-291.4c0-42.6-7.5-83.1-21.1-119.6c-2.6-6.9-12.7-6.6-16.2-.1C455.9 72.1 418.7 96 376 96L272 96z'/></svg>" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
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
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: all 0.3s ease;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        th {
            background: #f3f4f6;
            color: #374151;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.75rem;
        }
        td {
            padding: 1rem;
            color: #1f2937;
            font-size: 0.875rem;
        }
        tr {
            transition: background-color 0.2s ease;
        }
        tbody tr:hover {
            background-color: #f9fafb;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-primary {
            background-color: #059669;
            color: white;
        }
        .btn-primary:hover {
            background-color: #047857;
            transform: translateY(-1px);
        }
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        .toggle-switch input {
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
            border-radius: 24px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #059669;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        .modal {
            transition: opacity 0.3s ease;
        }
        .modal-content {
            transform: scale(0.95);
            opacity: 0;
            transition: all 0.3s ease;
        }
        .modal.active .modal-content {
            transform: scale(1);
            opacity: 1;
        }
        .form-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: #059669;
            box-shadow: 0 0 0 2px rgba(5, 150, 105, 0.1);
        }
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .password-strength {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 0.5rem;
        }
        #password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="flex bg-[#AFE1AF] font-sans min-h-screen relative ">
    <button class="mobile-menu-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars text-xl text-gray-600"></i>
    </button>
    <div class="mobile-overlay" onclick="toggleSidebar()"></div>
    <aside id="sidebar" class="sidebar bg-gradient-to-b from-emerald-800 to-brown-200 text-white w-64 min-h-screen">
        @include('layouts.sidebar')
    </aside>

    <main class="flex-1 p-6 py-[50px] mx-[50px]">
        <div class="container ">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-emerald-800">Manajemen User</h2>
                <button onclick="openAddUserModal()" class="btn btn-primary text-sm">
                    <i class="fas fa-plus mr-2"></i>Tambah User
                </button>
            </div>
            
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="w-20 px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Profile</th>
                                <th class="w-1/4 px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Nama</th>
                                <th class="w-1/3 px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Email</th>
                                <th class="w-28 px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Role</th>
                                <th class="w-40 px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Akses Login</th>
                                <th class="w-28 px-6 py-4 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody" class="bg-white divide-y divide-gray-200">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div id="addUserModal" class="fixed inset-0 w-[100vw] h-[100vh] bg-black bg-opacity-40 items-center justify-center hidden flex z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4 flex-col flex">
            <h3 class="text-xl font-semibold mb-6">Tambah User Baru</h3>
            <form id="addUserForm">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" id="newName" name="name" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="newEmail" name="email" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="newPassword" name="password" class="w-full border rounded-md px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" id="newPasswordConfirmation" name="password_confirmation" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select id="newRole" name="role" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            <option value="">Pilih Role</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeAddUserModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
            <h3 class="text-xl font-semibold mb-6">Edit User</h3>
            <form id="editUserForm">
                <input type="hidden" id="editUserId">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" id="editName" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="editEmail" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select id="editRole" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">Simpan</button>
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
        console.log('Firebase Config:', firebaseConfig);
        firebase.initializeApp(firebaseConfig);
        console.log('Firebase initialized');

        const auth = firebase.auth();
        const usersRef = firebase.database().ref('Users');
        const userTableBody = document.getElementById('userTableBody');

        console.log('Users reference:', usersRef);

        function renderUserTable(users) {
            console.log('Rendering users:', users);
            userTableBody.innerHTML = '';
            
            if (!users) {
                console.log('No users data available');
                return;
            }

            window.userDataMap = window.userDataMap || {};
            Object.entries(users).forEach(([userId, userData]) => {
                console.log('Processing user:', userId, userData);
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors';
                
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center justify-center">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-user text-sm text-emerald-600"></i>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${userData.name || '-'}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${userData.email || '-'}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 text-xs font-medium rounded-full ${userData.role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800'}">
                            ${userData.role || 'user'}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center justify-center">
                            <div class="flex items-center space-x-2 bg-gray-50 px-3 py-1.5 rounded-lg">
                                <label class="toggle-switch">
                                    <input type="checkbox" ${userData.hasAccess ? 'checked' : ''} 
                                        onchange="toggleUserAccess('${userId}', this.checked)">
                                    <span class="slider"></span>
                                </label>
                                <span class="text-xs font-medium min-w-[60px] ${userData.hasAccess ? 'text-green-600' : 'text-red-600'}">
                                    ${userData.hasAccess ? 'Diizinkan' : 'Diblokir'}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex justify-center items-center space-x-3">
                            <button 
                                onclick="openEditModal('${userId}', window.userDataMap['${userId}'])"
                                class="text-sm text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteUser('${userId}')" 
                                class="text-sm text-red-600 hover:text-red-800 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                userTableBody.appendChild(row);
                window.userDataMap[userId] = userData;
            });
        }

        usersRef.on('value', (snapshot) => {
            console.log('Firebase data changed');
            const users = snapshot.val();
            console.log('Users data:', users);
            renderUserTable(users);
        }, (error) => {
            console.error('Error fetching users:', error);
        });

        function openAddUserModal() {
            document.getElementById('addUserModal').classList.remove('hidden');
        }

        function closeAddUserModal() {
            document.getElementById('addUserModal').classList.add('hidden');
            document.getElementById('addUserForm').reset();
        }

        function toggleUserAccess(userId, hasAccess) {
            usersRef.child(userId).update({ hasAccess })
                .then(() => {
                    showNotification('Akses user berhasil diperbarui', 'success');
                })
                .catch(error => {
                    showNotification('Gagal memperbarui akses user', 'error');
                    console.error('Error updating user access:', error);
                });
        }

        function openEditModal(userId, userData) {
            console.log('openEditModal called', userId, userData);
            const modal = document.getElementById('editUserModal');
            const form = document.getElementById('editUserForm');
            document.getElementById('editUserId').value = userId;
            document.getElementById('editName').value = userData.name || '';
            document.getElementById('editEmail').value = userData.email || '';
            document.getElementById('editRole').value = userData.role || 'user';
            modal.classList.remove('hidden');
        }

        function closeEditModal() {
            const modal = document.getElementById('editUserModal');
            const form = document.getElementById('editUserForm');
            modal.classList.add('hidden');
            form.reset();
        }

        function deleteUser(userId) {
            if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                usersRef.child(userId).remove()
                    .then(() => {
                        showNotification('User berhasil dihapus', 'success');
                    })
                    .catch(error => {
                        showNotification('Gagal menghapus user', 'error');
                        console.error('Error deleting user:', error);
                    });
            }
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-4 py-2 rounded-md text-white ${
                type === 'success' ? 'bg-green-600' : 'bg-red-600'
            }`;
            notification.textContent = message;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }

        document.getElementById('addUserForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = {
                name: document.getElementById('newName').value,
                email: document.getElementById('newEmail').value,
                password: document.getElementById('newPassword').value,
                password_confirmation: document.getElementById('newPasswordConfirmation').value,
                role: document.getElementById('newRole').value
            };

            try {
                const response = await fetch('/manajemen/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (response.ok) {
                    alert(data.message);
                    closeAddUserModal();
                    location.reload();
                } else {
                    alert(data.message || 'Terjadi kesalahan saat menambahkan user');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menambahkan user');
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
                closeAddUserModal();
            }
        });

        document.getElementById('editUserModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.mobile-overlay');
            const body = document.body;
            if (sidebar && overlay) {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            }
        }

        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.mobile-overlay');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            
            if (sidebar && overlay && mobileMenuBtn) {
                if (sidebar.classList.contains('active') && 
                    !sidebar.contains(event.target) && 
                    !mobileMenuBtn.contains(event.target)) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
        });
    </script>
</body>
</html>