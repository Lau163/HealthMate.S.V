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
<div class="w-[1440px] h-[1300px] relative bg-white overflow-hidden">
  <div class="w-[907px] h-32 left-[431px] top-[164px] absolute bg-emerald-300/80 rounded-[20px]" />
  <div class="w-[652px] h-16 left-[567px] top-[189px] absolute text-center justify-start text-black text-4xl font-bold font-['Roboto']">Bienvenido A Health Mate</div>
  <div class="w-72 h-96 left-[449px] top-[340px] absolute bg-stone-300/30 rounded-[10px]" />
  <div class="w-44 h-10 left-[502px] top-[671px] absolute bg-teal-700 rounded-2xl" />
  <div class="w-36 left-[526px] top-[680px] absolute text-center justify-start text-white text-base font-bold font-['Roboto']">CONSEJOS</div>
  <div class="w-48 h-48 left-[490px] top-[382px] absolute" />
  <div class="w-72 h-96 left-[449px] top-[783px] absolute bg-stone-300/30 rounded-[10px]" />
  <div class="w-44 h-10 left-[502px] top-[1114px] absolute bg-teal-700 rounded-2xl" />
  <div class="w-72 h-96 left-[741px] top-[783px] absolute bg-stone-300/30 rounded-[10px]" />
  <div class="w-44 h-10 left-[794px] top-[1114px] absolute bg-teal-700 rounded-2xl" />
  <div class="w-32 left-[819px] top-[1119px] absolute text-center justify-start text-white text-base font-bold font-['Roboto']">ESTADISTICA DE CONSULTAS</div>
  <div class="w-11 h-1.5 left-[691px] top-[1125px] absolute text-center justify-start text-white text-base font-bold font-['Roboto']">MEDICAMENTOS</div>
  <div class="w-48 h-48 left-[782px] top-[825px] absolute" />
  <div class="w-72 h-96 left-[1034px] top-[783px] absolute bg-stone-300/30 rounded-[10px]" />
  <div class="w-44 h-10 left-[1087px] top-[1114px] absolute bg-teal-700 rounded-2xl" />
  <div class="w-28 left-[1122px] top-[1124px] absolute text-center justify-start text-white text-base font-bold font-['Roboto']">RECETAS</div>
  <div class="w-44 left-[504px] top-[1126px] absolute text-center justify-start text-white text-base font-bold font-['Roboto']">MEDICAMENTOS</div>
  <div class="w-72 h-96 left-[741px] top-[340px] absolute bg-stone-300/30 rounded-[10px]" />
  <div class="w-44 h-10 left-[794px] top-[671px] absolute bg-teal-700 rounded-2xl" />
  <div class="left-[829px] top-[680px] absolute text-center justify-start text-white text-xl font-bold font-['Roboto']">PACIENTES</div>
  <div class="w-72 h-96 left-[1034px] top-[340px] absolute bg-stone-300/30 rounded-[10px]" />
  <div class="w-44 h-10 left-[1087px] top-[671px] absolute bg-teal-700 rounded-2xl" />
  <div class="left-[1135px] top-[680px] absolute text-center justify-start text-white text-xl font-bold font-['Roboto']">AGENDA</div>
  <div class="w-48 h-48 left-[1075px] top-[382px] absolute" />
  <div class="w-64 h-80 left-[86px] top-[337px] absolute bg-stone-300/0 rounded-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] border border-black" />
  <div class="left-[139px] top-[292px] absolute text-center justify-start text-black text-xl font-bold font-['Roboto']">FILTRADO POR</div>
  <div class="w-28 h-5 left-[149px] top-[347px] absolute text-center justify-start text-teal-700 text-xl font-bold font-['Roboto']">Categoría</div>
  <div class="left-[174px] top-[410px] absolute text-center justify-start text-stone-500/90 text-xl font-bold font-['Roboto']">REGISTRO</div>
  <div class="left-[169px] top-[474px] absolute text-center justify-start text-stone-500/90 text-xl font-bold font-['Roboto']">DATOS</div>
  <div class="w-6 h-6 left-[124px] top-[409px] absolute bg-stone-300 border border-black" />
  <div class="w-6 h-6 left-[124px] top-[471px] absolute bg-stone-300 border border-black" />
  <img class="w-5 h-5 left-[1168px] top-[70px] absolute" src="https://placehold.co/20x20" />
  <div class="left-[192px] top-[63px] absolute text-center justify-start"><span class="text-black text-xl font-normal font-['Baloo_Chettan']">I</span><span class="text-black text-xl font-normal font-['Baloo_Chettan']">NICIO</span></div>
  <div class="left-[398px] top-[63px] absolute text-center justify-start text-black text-xl font-normal font-['Baloo_Chettan']">Servicios</div>
  <div class="left-[525px] top-[65px] absolute text-center justify-start text-black text-xl font-normal font-['Baloo_Chettan']">Página</div>
  <div class="w-8 h-0 left-[425px] top-[100px] absolute shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] outline outline-4 outline-offset-[-2px] outline-neutral-500"></div>
  <div class="w-[1309px] h-0 left-[59px] top-[119px] absolute outline outline-2 outline-offset-[-1px] outline-stone-400/90" />
  <img class="w-56 h-56 left-[784px] top-[410px] absolute" src="https://placehold.co/218x218" />
  <img class="w-52 h-64 left-[489px] top-[382px] absolute" src="https://placehold.co/211x262" />
  <img class="w-60 h-60 left-[1058px] top-[396px] absolute" src="https://placehold.co/233x233" />
  <img class="w-52 h-48 left-[491px] top-[834px] absolute" src="https://placehold.co/203x190" />
  <img class="w-52 h-52 left-[782px] top-[832px] absolute" src="https://placehold.co/205x205" />
  <img class="w-56 h-56 left-[1061px] top-[834px] absolute" src="https://placehold.co/228x228" />
</div>