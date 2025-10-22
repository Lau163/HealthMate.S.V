<?php require_once "config/config.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Servicios - Signos Vitales | HealthMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        
        html, body {
            overflow-x: hidden;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        
        body {
            position: relative;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen w-full">
    <div class="w-full min-h-screen bg-white overflow-x-hidden">
        
        <?php include('navbar.view.php') ?>
        
        <!-- Contenido principal -->
        <main class="container mx-auto px-3 sm:px-4 py-4 md:py-6 lg:px-8 max-w-7xl">
            
            <!-- Banner de título -->
            <div class="bg-emerald-300/80 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-4 md:mb-6 lg:mb-8 mt-2 md:mt-4">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-black text-center">
                    SIGNOS VITALES
                </h1>
            </div>
            
            <!-- Layout con sidebar y contenido -->
            <div class="flex flex-col lg:flex-row gap-4 md:gap-6">
                
                <!-- Sidebar - Filtro -->
                <aside class="w-full lg:w-1/4 flex-shrink-0">
                    <div class="bg-white rounded-lg shadow-md border border-black p-4 md:p-6">
                        <div class="mb-4">
                            <p class="text-teal-700 text-base md:text-lg font-bold text-center mb-4">Categoría</p>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-5 h-5 border-2 border-black" />
                                <label class="text-stone-500/90 text-base md:text-lg font-bold">REGISTRO</label>
                            </div>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="w-5 h-5 border-2 border-black" />
                                <label class="text-stone-500/90 text-base md:text-lg font-bold">DATOS</label>
                            </div>
                        </div>
                    </div>
                </aside>
                
                <!-- Contenido principal - Grid de servicios -->
                <div class="flex-1 w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6">
                        
                        <!-- Card 1: Temperatura Corporal -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-36 h-36 sm:w-40 sm:h-40 md:w-44 md:h-44 object-contain mb-3 md:mb-4" 
                                 src="<?= URL ?>public/img/PX/E.png" 
                                 alt="Temperatura Corporal" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    TEMPERATURA CORPORAL
                                </p>
                            </div>
                            <button onclick="openModal('temperatura')"
                                    class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                        <!-- Card 2: Saturación Sanguínea -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-36 h-36 sm:w-40 sm:h-40 md:w-44 md:h-44 object-contain mb-3 md:mb-4" 
                                 src="<?= URL ?>public/img/PX/PA.png" 
                                 alt="Saturación Sanguínea" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    SATURACIÓN SANGUÍNEA
                                </p>
                            </div>
                            <button onclick="openModal('saturacion')"
                                    class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                        <!-- Card 3: Frecuencia Cardíaca -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-40 h-40 sm:w-44 sm:h-44 md:w-48 md:h-48 object-contain mb-3 md:mb-4" 
                                 src="<?= URL ?>public/img/PX/B.png" 
                                 alt="Frecuencia Cardíaca" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    FRECUENCIA CARDÍACA
                                </p>
                            </div>
                            <button onclick="openModal('frecuencia')"
                                    class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                        <!-- Card 4: Presión Arterial -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-32 h-32 sm:w-36 sm:h-36 md:w-40 md:h-40 object-contain mb-3 md:mb-4" 
                                 src="<?= URL ?>public/img/PX/T.png" 
                                 alt="Presión Arterial" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    PRESIÓN ARTERIAL
                                </p>
                            </div>
                            <button onclick="openModal('presion')"
                                    class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                        <!-- Card 5: Frecuencia Respiratoria -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-40 h-40 sm:w-44 sm:h-44 md:w-48 md:h-48 object-contain mb-3 md:mb-4" 
                                 src="<?= URL ?>public/img/PX/C.png" 
                                 alt="Frecuencia Respiratoria" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    FRECUENCIA RESPIRATORIA
                                </p>
                            </div>
                            <button onclick="openModal('respiratoria')"
                                    class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                        <!-- Card 6: Pulso -->
                        <div class="bg-stone-300/30 rounded-lg p-4 md:p-6 flex flex-col items-center justify-between min-h-[300px] md:min-h-[350px]">
                            <img class="w-36 h-36 sm:w-40 sm:h-40 md:w-44 md:h-44 object-contain mb-3 md:mb-4" 
                                 src="<?= URL ?>public/img/PX/P.png" 
                                 alt="Pulso" />
                            <div class="text-center mb-3 md:mb-4">
                                <p class="text-zinc-700 text-sm md:text-base lg:text-lg font-bold">
                                    PULSO
                                </p>
                            </div>
                            <button onclick="openModal('pulso')"
                                    class="bg-teal-700 hover:bg-teal-800 active:bg-teal-900 text-white text-base md:text-lg lg:text-xl font-bold py-2 md:py-3 px-6 md:px-8 rounded-2xl transition-colors w-full">
                                REGISTRAR
                            </button>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
        </main>

        <!-- Modals para cada servicio -->
        <div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div id="modal-container" class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
                    <!-- Header del modal -->
                    <div class="bg-teal-600 text-white p-4 rounded-t-lg">
                        <div class="flex justify-between items-center">
                            <h3 id="modal-title" class="text-lg font-bold"></h3>
                            <button onclick="closeModal()" class="text-white hover:text-gray-200 text-xl">&times;</button>
                        </div>
                    </div>

                    <!-- Contenido del modal -->
                    <div class="p-6">
                        <form id="vital-signs-form">
                            <!-- Campos que se mostrarán según el tipo de signo vital -->
                            <div id="form-fields">
                                <!-- Los campos se insertarán dinámicamente aquí -->
                            </div>

                            <!-- Botones -->
                            <div class="flex gap-3 mt-6">
                                <button type="button" onclick="closeModal()"
                                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-lg transition-colors">
                                    Cancelar
                                </button>
                                <button type="submit"
                                        class="flex-1 bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg transition-colors">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Función para abrir modal
            function openModal(type) {
                const overlay = document.getElementById('modal-overlay');
                const title = document.getElementById('modal-title');
                const fields = document.getElementById('form-fields');

                // Configurar título según el tipo
                const titles = {
                    'temperatura': 'Registrar Temperatura Corporal',
                    'saturacion': 'Registrar Saturación Sanguínea',
                    'frecuencia': 'Registrar Frecuencia Cardíaca',
                    'presion': 'Registrar Presión Arterial',
                    'respiratoria': 'Registrar Frecuencia Respiratoria',
                    'pulso': 'Registrar Pulso'
                };

                title.textContent = titles[type] || 'Registrar Signo Vital';

                // Configurar campos según el tipo
                fields.innerHTML = getFormFields(type);

                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            // Función para cerrar modal
            function closeModal() {
                const overlay = document.getElementById('modal-overlay');
                overlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            // Función para obtener campos del formulario según el tipo
            function getFormFields(type) {
                const fieldConfigs = {
                    'temperatura': [
                        { label: 'Temperatura (°C)', name: 'temperatura', type: 'number', step: '0.1', placeholder: '36.5' }
                    ],
                    'saturacion': [
                        { label: 'Saturación de Oxígeno (%)', name: 'saturacion', type: 'number', placeholder: '98' }
                    ],
                    'frecuencia': [
                        { label: 'Frecuencia Cardíaca (lpm)', name: 'frecuencia', type: 'number', placeholder: '72' }
                    ],
                    'presion': [
                        { label: 'Presión Sistólica (mmHg)', name: 'sistolica', type: 'number', placeholder: '120' },
                        { label: 'Presión Diastólica (mmHg)', name: 'diastolica', type: 'number', placeholder: '80' }
                    ],
                    'respiratoria': [
                        { label: 'Frecuencia Respiratoria (rpm)', name: 'respiratoria', type: 'number', placeholder: '16' }
                    ],
                    'pulso': [
                        { label: 'Pulso (lpm)', name: 'pulso', type: 'number', placeholder: '72' }
                    ]
                };

                const config = fieldConfigs[type] || [];
                let fields = '';

                // Agregar campos visibles
                config.forEach(field => {
                    fields += `
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="${field.name}">
                                ${field.label}
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   id="${field.name}" name="${field.name}" type="${field.type}" step="${field.step || ''}" placeholder="${field.placeholder}" required>
                        </div>`;
                });

                // Agregar campo oculto para el tipo
                fields += `
                    <input type="hidden" name="tipo" value="${type}">`;

                // Agregar campo de observaciones opcional
                fields += `
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="observaciones">
                            Observaciones (opcional)
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                  id="observaciones" name="observaciones" rows="3" placeholder="Agregue cualquier observación adicional..."></textarea>
                    </div>`;

                return fields;
            }

            // Manejar envío del formulario
            document.getElementById('vital-signs-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const tipo = formData.get('tipo') || document.querySelector('input[name="tipo"]')?.value;
                const observaciones = formData.get('observaciones');

                // Preparar datos según el tipo
                let datos = {
                    tipo: tipo,
                    observaciones: observaciones
                };

                // Para presión arterial, necesitamos dos valores
                if (tipo === 'presion') {
                    datos.sistolica = formData.get('sistolica');
                    datos.diastolica = formData.get('diastolica');
                    datos.valor = formData.get('sistolica'); // Para compatibilidad
                } else {
                    datos.valor = formData.get(tipo);
                }

                // Validar que los campos requeridos no estén vacíos
                if (tipo === 'presion') {
                    if (!datos.sistolica || !datos.diastolica) {
                        alert('Por favor complete todos los campos requeridos.');
                        return;
                    }
                } else {
                    if (!datos.valor) {
                        alert('Por favor complete todos los campos requeridos.');
                        return;
                    }
                }

                // Mostrar loading
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Guardando...';
                submitBtn.disabled = true;

                // Hacer petición AJAX
                fetch('<?= URL ?>servicios/registrarPorTipo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new URLSearchParams(datos)
                })
                .then(response => {
                    // Verificar si la respuesta es JSON
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.indexOf('application/json') !== -1) {
                        return response.json();
                    } else {
                        // Si no es JSON, probablemente es una redirección
                        throw new Error('Respuesta no JSON - posible redirección de autenticación');
                    }
                })
                .then(data => {
                    // Restaurar botón
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;

                    if (data.status === 'success') {
                        alert('¡' + data.message + '!');
                        closeModal();
                        // Opcional: recargar la página o actualizar alguna lista
                        // location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    // Restaurar botón
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;

                    console.error('Error:', error);
                    if (error.message.includes('Respuesta no JSON')) {
                        alert('Error de autenticación. Por favor, inicia sesión nuevamente.');
                        window.location.href = '<?= URL ?>auth/login';
                    } else {
                        alert('Error de conexión. Por favor intente nuevamente.');
                    }
                });
            });

            // Cerrar modal al hacer clic fuera de él
            document.getElementById('modal-overlay').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
        </script>
    </body>
</html>
