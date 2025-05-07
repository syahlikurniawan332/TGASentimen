<nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      <!-- Logo dengan animasi hover -->
      <a href="{{ route('form') }}" class="flex items-center space-x-3 group">
        <div class="p-1 rounded-lg group-hover:bg-blue-100 dark:group-hover:bg-blue-900 transition-colors duration-300">
          <img src="https://flowbite.com/docs/images/logo.svg" alt="Logo" class="h-8 w-8">
        </div>
        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent dark:from-blue-400 dark:to-purple-400">Sentimen</span>
      </a>

      <!-- Right menu -->
      <div class="flex items-center space-x-6">
        <!-- Nav links dengan animasi underline -->
        <div class="hidden md:flex space-x-8">
          <a href="{{ route('form') }}" class="relative text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 font-medium">
            Home
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 dark:bg-blue-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
          <a href="{{ route('about') }}" class="relative text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 font-medium">
            About
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 dark:bg-blue-400 transition-all duration-300 group-hover:w-full"></span>
          </a>
        </div>

        <!-- Dark mode toggle dengan animasi -->
        <button id="theme-toggle" class="p-2 rounded-full text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <svg id="icon-dark" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
          </svg>
          <svg id="icon-light" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0z"/>
          </svg>
        </button>
    </div>
  </div>
</nav>

<script>
  const toggle = document.getElementById('theme-toggle');
  const iconDark = document.getElementById('icon-dark');
  const iconLight = document.getElementById('icon-light');

  // Set theme on load
  if (localStorage.theme === 'dark' || (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
    iconLight.classList.remove('hidden');
  } else {
    document.documentElement.classList.remove('dark');
    iconDark.classList.remove('hidden');
  }

  toggle.addEventListener('click', () => {
    iconDark.classList.toggle('hidden');
    iconLight.classList.toggle('hidden');

    if (document.documentElement.classList.contains('dark')) {
      document.documentElement.classList.remove('dark');
      localStorage.theme = 'light';
    } else {
      document.documentElement.classList.add('dark');
      localStorage.theme = 'dark';
    }
  });
</script>