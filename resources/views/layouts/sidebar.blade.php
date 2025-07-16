<!-- Sidebar -->
<div class="flex flex-col h-full">
  <div class="flex items-center justify-between px-6 py-4 border-b border-emerald-600">
    <div class="flex items-center space-x-2">
      <i class="fas fa-leaf text-2xl text-emerald-300"></i>
      <span class="text-xl font-bold">HydroCabin</span>
    </div>
    <button class="mobile-menu-btn md:hidden" onclick="toggleSidebar()">
      <i class="fas fa-times text-xl"></i>
    </button>
  </div>

  <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto relative z-10">
    <a href="{{ route('dashboard') }}" class="menu-link group flex items-center px-3 py-3 text-sm font-medium rounded-md hover:bg-emerald-600 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-emerald-600' : '' }}">
      <span class="mr-3 text-emerald-200 group-hover:text-white">
        <i class="fas fa-home"></i>
      </span>
      <span>Dashboard</span>
    </a>
    <a href="{{ route('riwayat') }}" class="menu-link group flex items-center px-3 py-3 text-sm font-medium rounded-md hover:bg-emerald-600 transition-colors duration-200 {{ request()->routeIs('riwayat') ? 'bg-emerald-600' : '' }}">
      <span class="mr-3 text-emerald-200 group-hover:text-white">
        <i class="fas fa-history"></i>
      </span>
      <span>Riwayat Data</span>
    </a>
    @if(Session::get('user.role') === 'admin')
    <div class="space-y-1">
      <button type="button" class="w-full menu-link group flex items-center justify-between px-3 py-3 text-sm font-medium rounded-md hover:bg-emerald-600 transition-colors duration-200" onclick="toggleSubmenu('settingsSubmenu')">
        <div class="flex items-center">
          <span class="mr-3 text-emerald-200 group-hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
            </svg>
          </span>
          <span>Pengaturan</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-200" id="settingsArrow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <div id="settingsSubmenu" class="hidden pl-4 space-y-1">
        <a href="{{ route('manajemen') }}" class="menu-link group flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-emerald-600 transition-colors duration-200 {{ request()->routeIs('manajemen') ? 'bg-emerald-600' : '' }}">
          <span class="mr-3 text-emerald-200 group-hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
              <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
            </svg>
          </span>
          <span>Manajemen Sistem</span>
        </a>
        <a href="{{ route('user') }}" class="menu-link group flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-emerald-600 transition-colors duration-200 {{ request()->routeIs('user') ? 'bg-emerald-600' : '' }}">
          <span class="mr-3 text-emerald-200 group-hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
              <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
            </svg>
          </span>
          <span>Manajemen User</span>
        </a>
      </div>
    </div>
    @endif
  </nav>

  <div class="px-4 py-4 border-t border-emerald-600">
    <div class="flex items-center space-x-3 mb-4">
      <div class="flex-shrink-0">
        <div class="h-10 w-10 rounded-full bg-emerald-400 flex items-center justify-center text-lg font-semibold">
          {{ strtoupper(substr(Session::get('user.name'), 0, 1)) }}
        </div>
      </div>
      <div class="flex-1 min-w-0">
        <p class="text-sm font-medium truncate">{{ Session::get('user.name') }}</p>
        <p class="text-xs text-emerald-700 truncate">{{ Session::get('user.email') }}</p>
      </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="w-full">
      @csrf
      <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-md hover:bg-emerald-500 transition-colors duration-200">
        <i class="fas fa-sign-out-alt mr-2"></i>
        Logout
      </button>
    </form>
  </div>
</div>

<script>
  function toggleSubmenu(id) {
    const submenu = document.getElementById(id);
    const arrow = document.getElementById('settingsArrow');
    
    if (submenu.classList.contains('hidden')) {
      submenu.classList.remove('hidden');
      arrow.classList.add('rotate-180');
    } else {
      submenu.classList.add('hidden');
      arrow.classList.remove('rotate-180');
    }
  }
</script>

<style>
@media (max-width: 768px) {
  .menu-link {
    padding: 1rem;
    font-size: 1rem;
  }
  
  .menu-link i {
    font-size: 1.25rem;
  }
}
</style>