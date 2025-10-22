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
    <div class="w-[1440px] h-[900px] relative bg-white overflow-hidden">
  <div class="w-[1440px] h-[900px] left-0 top-0 absolute bg-slate-300" />
  <div class="w-[1086px] h-96 left-[354px] top-0 absolute bg-sky-500" />
  <div class="w-96 h-[900px] left-0 top-[-2px] absolute bg-sky-200 shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]" />
  <div class="w-72 h-20 left-[38px] top-[39px] absolute bg-sky-500" />
  <img class="w-6 h-6 left-[107px] top-[337px] absolute" src="https://placehold.co/25x25" />
  <img class="w-6 h-6 left-[107px] top-[438px] absolute" src="https://placehold.co/25x25" />
  <div class="left-[149px] top-[283px] absolute justify-start text-black text-xl font-bold font-['Roboto']">Paciente</div>
  <div class="left-[149px] top-[339px] absolute justify-start text-stone-900 text-xl font-bold font-['Roboto']">Consultas</div>
  <div class="w-40 left-[130px] top-[376px] absolute text-center justify-start text-stone-900 text-xl font-bold font-['Roboto']">Historial De Signos Vitales</div>
  <div class="left-[149px] top-[494px] absolute justify-start text-stone-900 text-xl font-bold font-['Roboto']">Medicaciones</div>
  <div class="left-[149px] top-[435px] absolute text-center justify-start text-stone-900 text-xl font-bold font-['Roboto']">Estadistica De <br/>Consultas</div>
  <div class="w-72 h-0 left-[27px] top-[584px] absolute shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <img class="w-6 h-6 left-[107px] top-[281px] absolute" src="https://placehold.co/25x25" />
  <div class="w-8 h-0 left-[69px] top-[278px] absolute origin-top-left rotate-90 shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] outline outline-4 outline-offset-[-2px] outline-neutral-500"></div>
  <div class="w-[1024px] h-[703px] left-[384px] top-[142px] absolute bg-white rounded-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]" />
  <div class="w-80 h-9 left-[894px] top-[43px] absolute rounded-[20px] border border-white" />
  <div class="w-24 h-6 left-[939px] top-[50px] absolute justify-start text-white text-base font-normal font-['Roboto']">Buscar</div>
  <div class="w-24 h-6 left-[1320px] top-[50px] absolute justify-start text-white text-base font-normal font-['Roboto']">Usuario</div>
  <div class="w-12 h-12 left-[1251px] top-[36px] absolute bg-stone-300 rounded-full" />
  <div class="left-[393px] top-[47px] absolute justify-start text-white text-2xl font-bold font-['Roboto']">PACIENTE</div>
  <div class="left-[413px] top-[171px] absolute justify-start text-black/70 text-2xl font-bold font-['Roboto']">Presion Arterial</div>
  <div class="w-[1024px] h-16 left-[385px] top-[238px] absolute bg-slate-300 shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)]" />
  <div class="left-[588px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">PACIENTE</div>
  <div class="left-[502px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">ID</div>
  <div class="left-[670px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">FECHA DE CITA</div>
  <div class="left-[811px] top-[252px] absolute text-center justify-start text-neutral-500/90 text-base font-black font-['Roboto']">CONTACTO<br/> EMERGENCIA</div>
  <div class="left-[959px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">EMAIL</div>
  <div class="left-[1066px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">TELÉFONO</div>
  <div class="left-[1161px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">SIGNOS VITALES </div>
  <div class="left-[1305px] top-[255px] absolute text-center justify-start text-neutral-500/90 text-base font-black font-['Roboto']">HISTORIAL<br/> CLINICO</div>
  <div class="left-[432px] top-[264px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">#</div>
  <div class="left-[571px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis Gonzales</div>
  <div class="left-[488px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0100</div>
  <div class="left-[693px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">10-02-2025</div>
  <div class="left-[822px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div class="left-[926px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div class="left-[1064px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div class="left-[433px] top-[314px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">1</div>
  <div class="w-[1025px] h-0 left-[385px] top-[367.01px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div class="left-[570px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Juan Perez</div>
  <div class="left-[487px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0101</div>
  <div class="left-[692px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">11-02-2025</div>
  <div class="left-[821px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div class="left-[925px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div class="left-[1063px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div class="left-[432px] top-[385px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">2</div>
  <div class="w-[1025px] h-0 left-[384px] top-[438.01px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div class="left-[567px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Octavio Lopez</div>
  <div class="left-[484px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0102</div>
  <div class="left-[689px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">12-02-2025</div>
  <div class="left-[818px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div class="left-[922px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div class="left-[1060px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div class="left-[429px] top-[449px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">3</div>
  <div class="w-[1025px] h-0 left-[381px] top-[502.01px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div class="left-[572px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Ignacio Flores</div>
  <div class="left-[489px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0103</div>
  <div class="left-[694px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">15-02-2025</div>
  <div class="left-[823px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div class="left-[927px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div class="left-[1065px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div class="left-[434px] top-[636px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">6</div>
  <div class="w-[1025px] h-0 left-[386px] top-[689.01px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div class="left-[571px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Margarita Rios</div>
  <div class="left-[488px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0103</div>
  <div class="left-[693px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">13-02-2025</div>
  <div class="left-[822px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div class="left-[926px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div class="left-[1064px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div class="left-[433px] top-[510px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">4</div>
  <div class="w-[1025px] h-0 left-[385px] top-[563.01px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div class="w-24 h-4 left-[572px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Naomi Juarez</div>
  <div class="w-11 h-4 left-[489px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">R0103</div>
  <div class="w-20 h-4 left-[694px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">14-02-2025</div>
  <div class="w-20 h-4 left-[823px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Km 40 Lurin</div>
  <div class="w-28 h-4 left-[927px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Luis@gmail.com</div>
  <div class="w-20 h-4 left-[1065px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">987686546</div>
  <div class="w-2 h-4 left-[434px] top-[569.72px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">5</div>
  <div class="w-[1025px] h-0 left-[386px] top-[619px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <img class="w-8 h-8 left-[103px] top-[385px] absolute" src="https://placehold.co/33x33" />
  <img class="w-10 h-10 left-[1256px] top-[38px] absolute" src="https://placehold.co/39x39" />
  <img class="w-7 h-6 left-[107px] top-[489px] absolute" src="https://placehold.co/29x26" />
  <img class="w-10 h-10 left-[1207px] top-[313px] absolute" src="https://placehold.co/39x39" />
  <img class="w-10 h-10 left-[1207px] top-[630px] absolute" src="https://placehold.co/39x39" />
  <img class="w-10 h-10 left-[1207px] top-[571px] absolute" src="https://placehold.co/39x39" />
  <img class="w-10 h-10 left-[1207px] top-[513px] absolute" src="https://placehold.co/39x39" />
  <img class="w-10 h-10 left-[1207px] top-[447px] absolute" src="https://placehold.co/39x39" />
  <img class="w-10 h-10 left-[1207px] top-[381px] absolute" src="https://placehold.co/39x39" />
  <div class="w-[845px] h-[721px] left-[471px] top-[128px] absolute bg-white rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] border border-black" />
  <div class="w-36 h-36 left-[520px] top-[171px] absolute bg-stone-300 rounded-full border border-black" />
  <div class="w-[512px] h-96 left-[748px] top-[370px] absolute bg-white rounded-[10px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] border border-black" />
  <div class="left-[962px] top-[379px] absolute justify-start text-black text-xl font-bold font-['Roboto']">Servicios</div>
  <div class="w-28 h-9 left-[815px] top-[472px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Hipertension</div>
  <div class="w-32 h-12 left-[968px] top-[462px] absolute text-center justify-start text-zinc-700 text-xs font-medium font-['Roboto']">El px presenta hipertencion tras toma de S.V.</div>
  <div class="w-32 h-8 left-[1128px] top-[470px] absolute text-center justify-start text-zinc-700 text-xs font-medium font-['Roboto']">Checar P.A una vez al dia durante 7 dias</div>
  <div class="w-28 h-10 left-[1127px] top-[517px] absolute text-center justify-start text-zinc-700 text-xs font-medium font-['Roboto']">Loratadina 1 c/24 hrs por 3 dias. Paracetamol 1 c/8 hrs</div>
  <div class="w-1.5 h-3 left-[775.66px] top-[480.86px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">1</div>
  <div class="w-[509.01px] h-0 left-[747px] top-[515.13px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div class="w-[512px] h-11 left-[748px] top-[410px] absolute bg-slate-300 shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] border border-black" />
  <div class="w-24 h-6 left-[984px] top-[426px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">DESCRIPCION</div>
  <div class="w-1.5 h-3.5 left-[776px] top-[422.89px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">#</div>
  <div class="w-20 h-5 left-[822px] top-[420px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">Diagnostico</div>
  <div class="w-28 h-5 left-[1142px] top-[424px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">TRATAMIENTO</div>
  <div class="w-20 h-5 left-[819px] top-[531px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">Amigdalitis</div>
  <div class="w-40 h-9 left-[968px] top-[522px] absolute text-center justify-start text-zinc-700 text-xs font-medium font-['Roboto']">Px con febricula e inflamacion en garganta</div>
  <div class="w-1.5 h-3 left-[776.66px] top-[530.86px] absolute justify-start text-zinc-700 text-base font-medium font-['Roboto']">2</div>
  <div class="w-[512.03px] h-0 left-[747.99px] top-[563.61px] absolute outline outline-1 outline-offset-[-0.50px] outline-zinc-400"></div>
  <div class="w-28 h-8 left-[789px] top-[291px] absolute bg-white rounded-[10px] border border-black" />
  <div class="w-28 h-8 left-[968px] top-[291px] absolute bg-white rounded-[10px] border border-black" />
  <div class="w-24 h-6 left-[746px] top-[242px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">CÓDIGO:</div>
  <div class="w-28 h-8 left-[1128px] top-[293px] absolute bg-white rounded-[10px] border border-black" />
  <div class="left-[1142px] top-[299px] absolute justify-start text-black text-base font-black font-['Roboto']">25-10-2020</div>
  <div class="w-24 h-6 left-[919px] top-[234px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">CHECK IN:</div>
  <div class="w-24 h-6 left-[1075px] top-[227px] absolute justify-start text-neutral-500/90 text-base font-black font-['Roboto']">CHECK OUT:</div>
  <div class="left-[530px] top-[379px] absolute justify-start text-black text-xl font-bold font-['Roboto']">Luis Gonzalez</div>
  <div class="left-[495px] top-[426px] absolute justify-start text-black text-base font-black font-['Roboto']">DUEÑO</div>
  <div class="left-[495px] top-[469px] absolute justify-start text-black text-base font-black font-['Roboto']">DIRECCION</div>
  <div class="left-[489px] top-[514px] absolute justify-start text-black text-base font-black font-['Roboto']">TELÉFONO</div>
  <div class="left-[499px] top-[562px] absolute justify-start text-black text-base font-black font-['Roboto']">EMAIL</div>
  <div class="left-[566px] top-[424px] absolute justify-start text-zinc-700 text-base font-black font-['Roboto']">Jhon Delgado</div>
  <div class="left-[598px] top-[461px] absolute justify-start text-zinc-700 text-base font-black font-['Roboto']">Chorillos</div>
  <div class="left-[595px] top-[512px] absolute justify-start text-zinc-700 text-base font-black font-['Roboto']">987687657</div>
  <div class="left-[560px] top-[557px] absolute justify-start text-zinc-700 text-base font-black font-['Roboto']">jhontlv@gmail.com</div>
  <div class="left-[892px] top-[175px] absolute justify-start text-black text-2xl font-bold font-['Roboto']">Historial Clinico</div>
  <div class="left-[815px] top-[299px] absolute justify-start text-black text-base font-black font-['Roboto']">R0101</div>
  <div class="left-[979px] top-[299px] absolute justify-start text-black text-base font-black font-['Roboto']">20-10-2020</div>
  <div class="w-44 h-10 left-[909px] top-[773px] absolute bg-teal-700 rounded-[10px]" />
  <div class="left-[968px] top-[782px] absolute justify-start text-white text-xl font-bold font-['Roboto']">Cerrar</div>
</div>