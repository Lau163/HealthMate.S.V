<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Gráficas - Dashboard | HealthMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
            max-height: 400px;
        }

        @media (min-width: 768px) {
            .chart-container {
                height: 350px;
                max-height: 450px;
            }
        }

        @media (min-width: 1024px) {
            .chart-container {
                height: 400px;
                max-height: 500px;
            }
        }

        .metric-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen w-full">
    <div class="w-full min-h-screen bg-gradient-to-br from-sky-200 via-sky-100 to-purple-100 overflow-x-hidden">
        
        <?php include('navbar.view.php') ?>
        
        <!-- Contenido principal -->
        <main class="container mx-auto px-3 sm:px-4 py-4 md:py-6 lg:px-8 max-w-7xl">
            
            <!-- Header con usuario -->
            <div class="bg-gradient-to-r from-violet-700 to-indigo-950 rounded-xl md:rounded-2xl p-4 sm:p-6 mb-4 md:mb-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-white">
                        <i class="fas fa-chart-bar mr-2"></i> Dashboard
                    </h1>
                    <div class="text-white text-sm md:text-base">
                        <i class="fas fa-user-circle mr-2"></i> @say.valente
                    </div>
                </div>
            </div>
            
            <!-- Grid de estadísticas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6">

                <!-- Card 1: Frecuencia Cardíaca -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 metric-card">
                    <div class="flex items-center justify-between mb-3">
                        <div class="bg-teal-100 p-3 rounded-lg">
                            <i class="fas fa-heartbeat text-2xl text-teal-600"></i>
                        </div>
                        <span class="text-2xl md:text-3xl font-bold text-gray-800" id="hr-value">72</span>
                    </div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-600">Frecuencia Cardíaca</h3>
                    <p class="text-xs text-gray-500 mt-1">bpm</p>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                        <div class="bg-emerald-600 h-2 rounded-full transition-all duration-300" id="hr-bar" style="width: 60%"></div>
                    </div>
                </div>

                <!-- Card 2: Saturación O2 -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 metric-card">
                    <div class="flex items-center justify-between mb-3">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-lungs text-2xl text-blue-600"></i>
                        </div>
                        <span class="text-2xl md:text-3xl font-bold text-gray-800" id="spo2-value">98%</span>
                    </div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-600">Saturación O2</h3>
                    <p class="text-xs text-gray-500 mt-1">SpO2</p>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" id="spo2-bar" style="width: 98%"></div>
                    </div>
                </div>

                <!-- Card 3: Temperatura -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 metric-card">
                    <div class="flex items-center justify-between mb-3">
                        <div class="bg-red-100 p-3 rounded-lg">
                            <i class="fas fa-thermometer-half text-2xl text-red-600"></i>
                        </div>
                        <span class="text-2xl md:text-3xl font-bold text-gray-800" id="temp-value">36.5°</span>
                    </div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-600">Temperatura</h3>
                    <p class="text-xs text-gray-500 mt-1">Celsius</p>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                        <div class="bg-green-600 h-2 rounded-full transition-all duration-300" id="temp-bar" style="width: 73%"></div>
                    </div>
                </div>

            </div>
            
            <!-- Gráficas principales -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 mb-6">

                <!-- Gráfica grande - Tendencia de signos vitales -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4">
                        <i class="fas fa-chart-line mr-2 text-teal-600"></i> Tendencia Semanal de Signos Vitales
                    </h3>
                    <div class="chart-container">
                        <canvas id="weeklyChart"></canvas>
                    </div>
                </div>

                <!-- Gráfica circular - Distribución por categorías -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-4">
                        <i class="fas fa-chart-pie mr-2 text-purple-600"></i> Estado de Salud
                    </h3>
                    <div class="chart-container">
                        <canvas id="healthStatusChart"></canvas>
                    </div>
                </div>

            </div>

            <!-- Gráficas inferiores -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">

                <!-- Gráfica de Presión Arterial -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-base md:text-lg font-bold text-gray-800 mb-4">
                        <i class="fas fa-heartbeat mr-2 text-blue-600"></i> Evolución de Presión Arterial
                    </h3>
                    <div class="chart-container">
                        <canvas id="bloodPressureChart"></canvas>
                    </div>
                </div>

                <!-- Gráfica de Frecuencia Respiratoria -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-base md:text-lg font-bold text-gray-800 mb-4">
                        <i class="fas fa-wind mr-2 text-blue-600"></i> Frecuencia Respiratoria
                    </h3>
                    <div class="chart-container">
                        <canvas id="respiratoryChart"></canvas>
                    </div>
                </div>

            </div>

            <!-- Nueva fila para gráficas adicionales -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 mb-6">

                <!-- Gráfica de Temperatura -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-base md:text-lg font-bold text-gray-800 mb-4">
                        <i class="fas fa-thermometer-half mr-2 text-orange-600"></i> Registro de Temperatura
                    </h3>
                    <div class="chart-container">
                        <canvas id="temperatureChart"></canvas>
                    </div>
                </div>

                <!-- Gráfica de comparación -->
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                    <h3 class="text-base md:text-lg font-bold text-gray-800 mb-4">
                        <i class="fas fa-chart-bar mr-2 text-green-600"></i> Comparación Mensual
                    </h3>
                    <div class="chart-container">
                        <canvas id="comparisonChart"></canvas>
                    </div>
                </div>

            </div>
            
            <!-- Menú lateral simulado -->
            <div class="fixed bottom-4 right-4 lg:bottom-8 lg:right-8 flex flex-col space-y-3">
                <button class="bg-violet-700 hover:bg-violet-800 text-white p-3 md:p-4 rounded-full shadow-lg transition-all">
                    <i class="fas fa-home text-lg md:text-xl"></i>
                </button>
                <button class="bg-gray-700 hover:bg-gray-800 text-white p-3 md:p-4 rounded-full shadow-lg transition-all">
                    <i class="fas fa-chart-bar text-lg md:text-xl"></i>
                </button>
                <button class="bg-gray-700 hover:bg-gray-800 text-white p-3 md:p-4 rounded-full shadow-lg transition-all">
                    <i class="fas fa-bell text-lg md:text-xl"></i>
                </button>
                <button class="bg-gray-700 hover:bg-gray-800 text-white p-3 md:p-4 rounded-full shadow-lg transition-all">
                    <i class="fas fa-cog text-lg md:text-xl"></i>
                </button>
            </div>
            
        </main>

        <script>
            // Datos simulados para demostración
            const vitalSignsData = {
                labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                heartRate: [72, 75, 73, 78, 76, 74, 71],
                spo2: [98, 97, 99, 96, 98, 97, 98],
                temperature: [36.5, 36.7, 36.4, 36.8, 36.6, 36.5, 36.7],
                bloodPressure: {
                    systolic: [120, 118, 122, 125, 119, 121, 120],
                    diastolic: [80, 78, 82, 85, 79, 81, 80]
                },
                respiratory: [16, 18, 15, 17, 16, 18, 15]
            };

            // Inicializar gráficas cuando el DOM esté listo
            document.addEventListener('DOMContentLoaded', function() {
                initializeCharts();
                updateMetrics();
            });

            // Función para inicializar todas las gráficas
            function initializeCharts() {
                // Configuración común para todas las gráficas
                const commonOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                padding: 10,
                                usePointStyle: true,
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                };

                // Gráfica semanal de tendencias
                const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
                new Chart(weeklyCtx, {
                    type: 'line',
                    data: {
                        labels: vitalSignsData.labels,
                        datasets: [
                            {
                                label: 'Frecuencia Cardíaca (bpm)',
                                data: vitalSignsData.heartRate,
                                borderColor: '#059669',
                                backgroundColor: 'rgba(5, 150, 105, 0.1)',
                                tension: 0.4,
                                fill: true,
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                pointBackgroundColor: '#059669',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2
                            },
                            {
                                label: 'Saturación O2 (%)',
                                data: vitalSignsData.spo2,
                                borderColor: '#2563eb',
                                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                                tension: 0.4,
                                fill: true,
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                pointBackgroundColor: '#2563eb',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2
                            }
                        ]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            ...commonOptions.plugins,
                            title: {
                                display: true,
                                text: 'Tendencias de la Semana',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                padding: 10
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                grid: {
                                    display: true,
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });

                // Gráfica de estado de salud (circular)
                const healthCtx = document.getElementById('healthStatusChart').getContext('2d');
                new Chart(healthCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Óptimo', 'Bueno', 'Regular', 'Atención'],
                        datasets: [{
                            data: [65, 25, 8, 2],
                            backgroundColor: [
                                '#059669',
                                '#2563eb',
                                '#f59e0b',
                                '#dc2626'
                            ],
                            borderWidth: 0,
                            cutout: '60%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    usePointStyle: true,
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        }
                    }
                });

                // Gráfica de presión arterial
                const bpCtx = document.getElementById('bloodPressureChart').getContext('2d');
                new Chart(bpCtx, {
                    type: 'bar',
                    data: {
                        labels: vitalSignsData.labels,
                        datasets: [
                            {
                                label: 'Sistólica',
                                data: vitalSignsData.bloodPressure.systolic,
                                backgroundColor: '#059669',
                                borderColor: '#047857',
                                borderWidth: 1,
                                borderRadius: 4
                            },
                            {
                                label: 'Diastólica',
                                data: vitalSignsData.bloodPressure.diastolic,
                                backgroundColor: '#2563eb',
                                borderColor: '#1d4ed8',
                                borderWidth: 1,
                                borderRadius: 4
                            }
                        ]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            ...commonOptions.plugins,
                            title: {
                                display: true,
                                text: 'Presión Arterial',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                max: 140,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });

                // Gráfica de frecuencia respiratoria
                const respCtx = document.getElementById('respiratoryChart').getContext('2d');
                new Chart(respCtx, {
                    type: 'line',
                    data: {
                        labels: vitalSignsData.labels,
                        datasets: [{
                            label: 'Respiraciones por minuto',
                            data: vitalSignsData.respiratory,
                            borderColor: '#2563eb',
                            backgroundColor: 'rgba(37, 99, 235, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor: '#2563eb',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2
                        }]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            ...commonOptions.plugins,
                            title: {
                                display: true,
                                text: 'Frecuencia Respiratoria',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });

                // Gráfica de temperatura
                const tempCtx = document.getElementById('temperatureChart').getContext('2d');
                new Chart(tempCtx, {
                    type: 'line',
                    data: {
                        labels: vitalSignsData.labels,
                        datasets: [{
                            label: 'Temperatura (°C)',
                            data: vitalSignsData.temperature,
                            borderColor: '#16a34a',
                            backgroundColor: 'rgba(22, 163, 74, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor: '#16a34a',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2
                        }]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            ...commonOptions.plugins,
                            title: {
                                display: true,
                                text: 'Registro de Temperatura',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 35,
                                max: 38,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });

                // Gráfica de comparación mensual
                const compCtx = document.getElementById('comparisonChart').getContext('2d');
                new Chart(compCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Ene', 'Feb', 'Mar', 'Abr'],
                        datasets: [
                            {
                                label: 'Frecuencia Cardíaca Promedio',
                                data: [74, 72, 75, 73],
                                backgroundColor: '#059669',
                                borderRadius: 4
                            },
                            {
                                label: 'Presión Arterial Promedio',
                                data: [125, 122, 128, 124],
                                backgroundColor: '#2563eb',
                                borderRadius: 4
                            }
                        ]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            ...commonOptions.plugins,
                            title: {
                                display: true,
                                text: 'Comparación Mensual',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // Función para actualizar métricas en tiempo real
            function updateMetrics() {
                // Simular cambios en los valores (en producción vendrían de la base de datos)
                setInterval(() => {
                    const hrValue = document.getElementById('hr-value');
                    const hrBar = document.getElementById('hr-bar');
                    const spo2Value = document.getElementById('spo2-value');
                    const spo2Bar = document.getElementById('spo2-bar');
                    const tempValue = document.getElementById('temp-value');
                    const tempBar = document.getElementById('temp-bar');

                    // Actualizar frecuencia cardíaca
                    const newHR = Math.floor(Math.random() * 20) + 60;
                    hrValue.textContent = newHR;
                    hrBar.style.width = Math.min((newHR / 120) * 100, 100) + '%';

                    // Actualizar saturación
                    const newSpo2 = Math.floor(Math.random() * 5) + 95;
                    spo2Value.textContent = newSpo2 + '%';
                    spo2Bar.style.width = newSpo2 + '%';

                    // Actualizar temperatura
                    const newTemp = (Math.random() * 1.5 + 35.5).toFixed(1);
                    tempValue.textContent = newTemp + '°';
                    tempBar.style.width = ((newTemp - 35) / 3) * 100 + '%';

                }, 3000); // Actualizar cada 3 segundos
            }
        </script>
    </body>
</html>
