<!-- Navbar -->
<nav class="sticky top-0 z-50 bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 border-b border-white/10 shadow-lg transition-colors duration-500">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      <!-- Logo -->
      <a href="{{ route('form') }}" class="flex items-center space-x-3 group">
        <div class="p-1 rounded-lg group-hover:bg-white/10 transition-colors duration-300">
          <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
          </svg>
        </div>
        <span class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-blue-400 bg-clip-text text-transparent">SentimenAI</span>
      </a>

      <!-- Hamburger -->
      <div class="md:hidden">
        <button id="menu-toggle" class="text-white focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

      <!-- Menu Desktop -->
      <div class="hidden md:flex items-center space-x-8">
        <a href="{{ route('form') }}" class="relative group text-slate-300 hover:text-white font-medium transition">
          Home
          <span class="absolute left-0 -bottom-1 h-0.5 bg-gradient-to-r from-cyan-400 to-blue-400 transition-all duration-300 w-0 group-hover:w-full"></span>
        </a>
        <a href="{{ route('about') }}" class="relative group text-slate-300 hover:text-white font-medium transition">
          About
          <span class="absolute left-0 -bottom-1 h-0.5 bg-gradient-to-r from-cyan-400 to-blue-400 transition-all duration-300 w-0 group-hover:w-full"></span>
        </a>
        <button id="theme-toggle" class="p-2 rounded-full text-slate-300 hover:bg-white/10 transition">
          <svg id="icon-dark" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
          </svg>
          <svg id="icon-light" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden hidden mt-2 space-y-2 pb-4">
      <a href="{{ route('form') }}" class="block px-4 py-2 text-slate-300 hover:bg-white/10 rounded transition">Home</a>
      <a href="{{ route('about') }}" class="block px-4 py-2 text-slate-300 hover:bg-white/10 rounded transition">About</a>
      <button id="theme-toggle-mobile" class="flex items-center px-4 py-2 text-slate-300 hover:bg-white/10 rounded transition">
        <svg id="icon-dark-mobile" class="w-5 h-5 hidden mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
        </svg>
        <svg id="icon-light-mobile" class="w-5 h-5 hidden mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <span>Toggle Theme</span>
      </button>
    </div>
  </div>
</nav>


<script>
  const toggle = document.getElementById('theme-toggle');
  const toggleMobile = document.getElementById('theme-toggle-mobile');
  const iconDark = document.getElementById('icon-dark');
  const iconLight = document.getElementById('icon-light');
  const iconDarkMobile = document.getElementById('icon-dark-mobile');
  const iconLightMobile = document.getElementById('icon-light-mobile');

  const applyTheme = (theme) => {
    const isDark = theme === 'dark';
    document.documentElement.classList.toggle('dark', isDark);
    iconDark.classList.toggle('hidden', isDark);
    iconLight.classList.toggle('hidden', !isDark);
    iconDarkMobile.classList.toggle('hidden', isDark);
    iconLightMobile.classList.toggle('hidden', !isDark);
    localStorage.theme = theme;
  };

  // Set theme on load
  const currentTheme = localStorage.theme || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
  applyTheme(currentTheme);

  toggle.addEventListener('click', () => applyTheme(document.documentElement.classList.contains('dark') ? 'light' : 'dark'));
  toggleMobile.addEventListener('click', () => applyTheme(document.documentElement.classList.contains('dark') ? 'light' : 'dark'));

  // Hamburger toggle
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  menuToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>