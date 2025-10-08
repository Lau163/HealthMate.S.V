<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes | HealthMate</title>
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
 <div class="w-[1440px] h-[900px] relative bg-white overflow-hidden">

 <?php include('navbar.view.php') ?>
  <div class="w-8 h-0 left-[396px] top-[115px] absolute shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] outline outline-4 outline-offset-[-2px] outline-neutral-500"></div>
  <div class="w-[1309px] h-0 left-[30px] top-[134px] absolute outline outline-2 outline-offset-[-1px] outline-stone-400/90"></div>
  <div class="left-[97px] top-[321px] absolute text-center justify-start text-black text-xl font-bold font-['Roboto']">FILTRO SELECCIONADO</div>
  <div class="w-28 h-5 left-[109px] top-[422px] absolute text-center justify-start text-teal-700 text-xl font-bold font-['Roboto']">Categoría</div>
  <div class="w-64 h-80 left-[84px] top-[379px] absolute bg-stone-300/0 rounded-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] border border-black"></div>
  <div class="w-56 h-36 left-[107px] top-[507px] absolute text-center justify-start text-stone-500/90 text-xl font-bold font-['Roboto']">Este sistema esta diseñado para que puedas llevar el control de tus signoss vitales</div>
  <div class="w-[907px] h-32 left-[396px] top-[172px] absolute bg-emerald-300/80 rounded-[20px]"></div>
  <div class="w-[464px] h-16 left-[613px] top-[208px] absolute text-center justify-start text-black text-4xl font-bold font-['Roboto']">Bienvenido a Healt Mate</div>
  <div class="w-72 h-96 left-[1008px] top-[337px] absolute bg-stone-300/30 rounded-[10px]"></div>
  <div class="w-44 h-10 left-[1061px] top-[668px] absolute bg-teal-700 rounded-2xl"></div>
  <div class="left-[1129px] top-[677px] absolute text-center justify-start text-white text-xl font-bold font-['Roboto']">VER</div>
  <div class="w-36 left-[1081px] top-[604px] absolute text-center justify-start text-zinc-700 text-lg font-bold font-['Roboto']">Alimentate Sanamente</div>
  <div class="w-52 h-16 left-[747px] top-[659px] absolute bg-teal-700 rounded-2xl"></div>
  <div class="w-48 left-[758px] top-[668px] absolute text-center justify-start text-white text-xl font-bold font-['Roboto']">Parametros De Los Signos Vitales</div>
  <div class="w-72 h-96 left-[412px] top-[337px] absolute bg-stone-300/30 rounded-[10px]"></div>
  <div class="w-52 h-14 left-[452px] top-[665px] absolute bg-teal-700 rounded-2xl"></div>
  <div class="w-36 left-[478px] top-[679px] absolute text-center justify-start text-white text-xl font-bold font-['Roboto']">ALIMENTACION</div>
  <img class="w-48 h-48 left-[460px] top-[422px] absolute" src="<?= constant("URL") ?>public/img/PX/BA.png" />
  <img class="w-52 h-52 left-[758px] top-[379px] absolute" src="<?= constant("URL") ?>public/img/PX/S1.png" />
  <img class="w-48 h-48 left-[1056px] top-[375px] absolute" src="<?= constant("URL") ?>public/img/PX/S3.png" />
  <div class="w-24 h-0 left-[1259px] top-[830px] absolute border-[14px] border-black"></div>
</div>