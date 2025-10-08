<!-- Navbar responsive -->
<nav class="bg-white border-b-2 border-stone-400/90 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            
            <!-- Logo/Brand -->
            <div class="flex items-center">
                <h2 class="text-xl md:text-2xl font-bold text-teal-700 font-['Baloo_Chettan']">HealthMate</h2>
            </div>
            
            <!-- Mobile menu button -->
            <button id="mobile-menu-button" class="lg:hidden text-black focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-6">
                <a href="<?= constant("URL") ?>paciente/" 
                   class="text-black hover:text-teal-700 text-lg font-normal font-['Baloo_Chettan'] transition-colors">
                    Home
                </a>
                <a href="<?= constant("URL") ?>paciente/ParametrosSV" 
                   class="text-black hover:text-teal-700 text-lg font-normal font-['Baloo_Chettan'] transition-colors">
                    Signos Vitales
                </a>
                <a href="<?= constant("URL") ?>paciente/servicios" 
                   class="text-black hover:text-teal-700 text-lg font-normal font-['Baloo_Chettan'] transition-colors">
                    Servicios
                </a>
                <a href="<?= constant("URL") ?>paciente/Graficas" 
                   class="text-black hover:text-teal-700 text-lg font-normal font-['Baloo_Chettan'] transition-colors">
                    Gráficas
                </a>
                <a href="<?= constant("URL") ?>paciente/Archivo" 
                   class="text-black hover:text-teal-700 text-lg font-normal font-['Baloo_Chettan'] transition-colors">
                    Archivo
                </a>
                <a href="<?= constant("URL") ?>paciente/PaginasConsejos" 
                   class="text-black hover:text-teal-700 text-lg font-normal font-['Baloo_Chettan'] transition-colors">
                    Consejos
                </a>
                <a href="<?= constant("URL") ?>paciente/Perfil" 
                   class="text-black hover:text-teal-700 text-lg font-normal font-['Baloo_Chettan'] transition-colors">
                    Perfil
                </a>
            </div>
            
            <!-- User icons (Desktop) -->
            <div class="hidden lg:flex items-center space-x-4">
                <button class="w-5 h-5">
                    <i class="fas fa-bell text-gray-600 hover:text-teal-700"></i>
                </button>
                <button class="w-5 h-5">
                    <i class="fas fa-envelope text-gray-600 hover:text-teal-700"></i>
                </button>
                <button class="w-5 h-5">
                    <i class="fas fa-user text-gray-600 hover:text-teal-700"></i>
                </button>
            </div>
            
        </div>
        
        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden lg:hidden pb-4">
            <div class="flex flex-col space-y-3">
                <a href="<?= constant("URL") ?>paciente/" 
                   class="text-black hover:text-teal-700 text-base font-normal font-['Baloo_Chettan'] py-2 border-b border-gray-200">
                    Home
                </a>
                <a href="<?= constant("URL") ?>paciente/ParametrosSV" 
                   class="text-black hover:text-teal-700 text-base font-normal font-['Baloo_Chettan'] py-2 border-b border-gray-200">
                    Signos Vitales
                </a>
                <a href="<?= constant("URL") ?>paciente/servicios" 
                   class="text-black hover:text-teal-700 text-base font-normal font-['Baloo_Chettan'] py-2 border-b border-gray-200">
                    Servicios
                </a>
                <a href="<?= constant("URL") ?>paciente/Graficas" 
                   class="text-black hover:text-teal-700 text-base font-normal font-['Baloo_Chettan'] py-2 border-b border-gray-200">
                    Gráficas
                </a>
                <a href="<?= constant("URL") ?>paciente/Archivo" 
                   class="text-black hover:text-teal-700 text-base font-normal font-['Baloo_Chettan'] py-2 border-b border-gray-200">
                    Archivo
                </a>
                <a href="<?= constant("URL") ?>paciente/PaginasConsejos" 
                   class="text-black hover:text-teal-700 text-base font-normal font-['Baloo_Chettan'] py-2 border-b border-gray-200">
                    Consejos
                </a>
                <a href="<?= constant("URL") ?>paciente/Perfil" 
                   class="text-black hover:text-teal-700 text-base font-normal font-['Baloo_Chettan'] py-2 border-b border-gray-200">
                    Perfil
                </a>
            </div>
        </div>
        
    </div>
</nav>

<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>
