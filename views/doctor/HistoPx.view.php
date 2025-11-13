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
    <div className="w-[1440px] h-[900px] relative bg-white overflow-hidden">
  <div className="w-[1440px] h-[900px] left-0 top-0 absolute bg-slate-300" />
  <div className="w-[1086px] h-96 left-[354px] top-0 absolute bg-sky-500" />
  <div className="w-96 h-[900px] left-0 top-[-2px] absolute bg-sky-200 shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]" />
  <div className="w-72 h-20 left-[38px] top-[39px] absolute bg-sky-500" />
  <img className="w-6 h-6 left-[107px] top-[337px] absolute" src="https://placehold.co/25x25" />
  <img className="w-6 h-6 left-[107px] top-[438px] absolute" src="https://placehold.co/25x25" />
  <div className="left-[149px] top-[283px] absolute justify-start text-black text-xl font-bold font-['Roboto']">Paciente</div>
  <div className="left-[149px] top-[339px] absolute justify-start text-stone-900 text-xl font-bold font-['Roboto']">Consultas</div>
  <div className="w-40 left-[130px] top-[376px] absolute text-center justify-start text-stone-900 text-xl font-bold font-['Roboto']">Historial De Signos Vitales</div>
  <div className="left-[149px] top-[494px] absolute justify-start text-stone-900 text-xl font-bold font-['Roboto']">Medicaciones</div>
  <div className="left-[149px] top-[435px] absolute text-center justify-start text-stone-900 text-xl font-bold font-['Roboto']">Estadistica De <br/>Consultas</div>
  <div className="w-72 h-0 left-[27px] top-[584px] absolute shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <img className="w-6 h-6 left-[107px] top-[281px] absolute" src="https://placehold.co/25x25" />
  <div className="w-8 h-0 left-[69px] top-[278px] absolute origin-top-left rotate-90 shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] outline outline-4 outline-offset-[-2px] outline-neutral-500"></div>
  <div className="w-[1024px] h-[703px] left-[384px] top-[142px] absolute bg-white rounded-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]" />
  <div className="w-80 h-9 left-[894px] top-[43px] absolute rounded-[20px] border border-white" />
  <div className="w-24 h-6 left-[939px] top-[50px] absolute justify-start text-white text-base font-normal font-['Roboto']">Buscar</div>
  <div className="w-24 h-6 left-[1320px] top-[50px] absolute justify-start text-white text-base font-normal font-['Roboto']">Usuario</div>
  <div className="w-12 h-12 left-[1251px] top-[36px] absolute bg-stone-300 rounded-full" />
  <div className="left-[393px] top-[47px] absolute justify-start text-white text-2xl font-bold font-['Roboto']">PACIENTE</div>
  <div className="left-[413px] top-[171px] absolute justify-start text-black/70 text-2xl font-bold font-['Roboto']">Pacientes </div>
  <div className="w-[1024px] h-16 left-[385px] top-[238px] absolute bg-slate-300 shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]" />
  <div className="left-[588px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">PACIENTE</div>
  <div className="left-[502px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">ID</div>
  <div className="left-[670px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">FECHA DE CITA</div>
  <div className="left-[811px] top-[252px] absolute text-center justify-start text-neutral-500/90 text-base font-black font-['Roboto']">CONTACTO<br/> EMERGENCIA</div>
  <div className="left-[959px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">EMAIL</div>
  <div className="left-[1066px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">TELÉFONO</div>
  <div className="left-[1161px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">SIGNOS VITALES </div>
  <div className="left-[1305px] top-[255px] absolute text-center justify-start text-neutral-500/90 text-base font-black font-['Roboto']">HISTORIAL<br/> CLINICO</div>
  <div className="left-[432px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">#</div>
  <div className="left-[571px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis Gonzales</div>
  <div className="left-[488px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0100</div>
  <div className="left-[693px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">10-02-2025</div>
  <div className="left-[822px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div className="left-[926px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div className="left-[1064px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div className="left-[433px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">1</div>
  <div className="w-[1025px] h-0 left-[385px] top-[367.01px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div className="left-[570px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Juan Perez</div>
  <div className="left-[487px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0101</div>
  <div className="left-[692px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">11-02-2025</div>
  <div className="left-[821px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div className="left-[925px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div className="left-[1063px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div className="left-[432px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">2</div>
  <div className="w-[1025px] h-0 left-[384px] top-[438.01px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div className="left-[567px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Octavio Lopez</div>
  <div className="left-[484px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0102</div>
  <div className="left-[689px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">12-02-2025</div>
  <div className="left-[818px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div className="left-[922px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div className="left-[1060px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div className="left-[429px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">3</div>
  <div className="w-[1025px] h-0 left-[381px] top-[502.01px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div className="left-[572px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Ignacio Flores</div>
  <div className="left-[489px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0103</div>
  <div className="left-[694px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">15-02-2025</div>
  <div className="left-[823px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div className="left-[927px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div className="left-[1065px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div className="left-[434px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">6</div>
  <div className="w-[1025px] h-0 left-[386px] top-[689.01px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div className="left-[571px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Margarita Rios</div>
  <div className="left-[488px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0103</div>
  <div className="left-[693px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">13-02-2025</div>
  <div className="left-[822px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div className="left-[926px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div className="left-[1064px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div className="left-[433px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">4</div>
  <div className="w-[1025px] h-0 left-[385px] top-[563.01px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div className="w-24 h-4 left-[572px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Naomi Juarez</div>
  <div className="w-11 h-4 left-[489px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0103</div>
  <div className="w-20 h-4 left-[694px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">14-02-2025</div>
  <div className="w-20 h-4 left-[823px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div className="w-28 h-4 left-[927px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div className="w-20 h-4 left-[1065px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div className="w-2 h-4 left-[434px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">5</div>
  <div className="w-[1025px] h-0 left-[386px] top-[619px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <img className="w-8 h-8 left-[103px] top-[385px] absolute" src="https://placehold.co/33x33" />
  <img className="w-10 h-10 left-[1256px] top-[38px] absolute" src="https://placehold.co/39x39" />
  <img className="w-7 h-6 left-[107px] top-[489px] absolute" src="https://placehold.co/29x26" />
  <img className="w-10 h-10 left-[1207px] top-[313px] absolute" src="https://placehold.co/39x39" />
  <img className="w-10 h-10 left-[1207px] top-[630px] absolute" src="https://placehold.co/39x39" />
  <img className="w-10 h-10 left-[1207px] top-[571px] absolute" src="https://placehold.co/39x39" />
  <img className="w-10 h-10 left-[1207px] top-[513px] absolute" src="https://placehold.co/39x39" />
  <img className="w-10 h-10 left-[1207px] top-[447px] absolute" src="https://placehold.co/39x39" />
  <img className="w-10 h-10 left-[1207px] top-[381px] absolute" src="https://placehold.co/39x39" />
  <img className="w-9 h-9 left-[1326px] top-[316px] absolute" src="https://placehold.co/36x36" />
  <img className="w-9 h-9 left-[1326px] top-[385px] absolute" src="https://placehold.co/36x36" />
  <img className="w-9 h-9 left-[1326px] top-[449px] absolute" src="https://placehold.co/36x36" />
  <img className="w-9 h-9 left-[1326px] top-[513px] absolute" src="https://placehold.co/36x36" />
  <img className="w-9 h-9 left-[1326px] top-[573px] absolute" src="https://placehold.co/36x36" />
  <img className="w-9 h-9 left-[1326px] top-[636px] absolute" src="https://placehold.co/36x36" />
</div>