<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor | HealthMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleSidebar = document.getElementById('toggle-sidebar');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            
            // Toggle sidebar
            toggleSidebar.addEventListener('click', function() {
                const isCollapsed = sidebar.classList.contains('w-20');
                
                if (isCollapsed) {
                    // Expandir el sidebar
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');
                    mainContent.classList.remove('md:ml-20');
                    mainContent.classList.add('md:ml-64');
                } else {
                    // Colapsar el sidebar
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-20');
                    mainContent.classList.remove('md:ml-64');
                    mainContent.classList.add('md:ml-20');
                }
                
                // Toggle text in sidebar items
                sidebarTexts.forEach(text => {
                    text.classList.toggle('hidden');
                    text.classList.toggle('md:inline-block');
                });
                
                // Toggle icons position
                sidebarItems.forEach(item => {
                    item.classList.toggle('justify-center');
                    item.classList.toggle('px-6');
                });
            });
            
            // Close sidebar on mobile when clicking outside
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 768 && !sidebar.contains(event.target) && event.target !== toggleSidebar) {
                    sidebar.classList.add('hidden');
                    mainContent.classList.remove('md:ml-64');
                }
            });
        });
    </script>
</head>
<body class="bg-gray-100 overflow-hidden">
    <div class="w-[1440px] h-[900px] relative bg-sky-200 overflow-hidden">
  <div class="w-[755px] h-[512px] left-[578px] top-[180px] absolute bg-stone-300/30" />
  <div class="w-[755px] h-0 left-[578px] top-[285px] absolute outline outline-1 outline-offset-[-0.50px] outline-black"></div>
  <div class="left-[612px] top-[221px] absolute text-center justify-start text-black text-2xl font-bold font-['Roboto']">PROMOVIENDO LA SALUD</div>
  <div class="w-[564px] h-80 left-[680px] top-[320px] absolute justify-start"><span class="text-black text-lg font-medium font-['Roboto']"><br/></span><span class="text-black text-base font-medium font-['Roboto']">   <br/></span><span class="text-black text-4xl font-medium font-['Roboto']">En esta seccion el personal de salud podra compartir consejos para la promocion de la vida saludable</span></div>
  <img class="w-5 h-5 left-[1282px] top-[82px] absolute" src="https://placehold.co/20x20" />
  <div class="left-[241px] top-[82px] absolute text-center justify-start text-black text-xl font-normal font-['Baloo_Chettan']">CONSEJOS MEDICOS </div>
  <div class="w-8 h-0 left-[431px] top-[119px] absolute shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] outline outline-4 outline-offset-[-2px] outline-neutral-500"></div>
  <div class="w-[1309px] h-0 left-[65px] top-[138px] absolute outline outline-2 outline-offset-[-1px] outline-stone-400/90" />
  <div class="w-44 h-11 left-[1048px] top-[752px] absolute bg-teal-700 rounded-[10px]" />
  <div class="left-[1084px] top-[763px] absolute text-center justify-start text-white text-xl font-bold font-['Roboto']">SIGUIENTE</div>
  <div class="w-44 h-10 left-[228px] top-[752px] absolute bg-teal-700 rounded-[10px]" />
  <div class="left-[264px] top-[763px] absolute text-center justify-start text-white text-xl font-bold font-['Roboto']">ANTERIOR</div>
  <img class="w-[467px] h-[467px] left-[65px] top-[202px] absolute" src="https://placehold.co/467x467" />
  <img class="w-36 h-40 left-[224px] top-[355px] absolute rounded-[100px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]" src="https://placehold.co/150x161" />
</div>