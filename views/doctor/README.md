# HealthMate - Vistas del Doctor

## Mejoras implementadas

### 1. Estandarización de la sintaxis HTML
- ✅ Cambiado `className` por `class` en todos los archivos
- ✅ Unificación de Tailwind CSS v3 en todos los archivos

### 2. Componente Sidebar reutilizable
- ✅ `sidebar.js`: Componente JavaScript para el sidebar colapsable
- ✅ Funcionalidad completa: expandir/colapsar, menú móvil, etc.

### 3. Layout base reutilizable
- ✅ `layout.php`: Plantilla base con sidebar, header y estructura responsive
- ✅ Variables configurables: `$title`, `$pageTitle`, `$content`

### 4. Vistas refactorizadas
- ✅ `historial_clinico.php`: Versión dinámica del historial médico
- ✅ `dashboard.php`: Dashboard moderno con KPIs y acciones rápidas
- ✅ `estadisticas.php`: Gráficos y métricas con datos dinámicos
- ✅ `consejos.php`: Sistema de consejos médicos interactivo
- ✅ `dar_consejos.php`: Formulario para crear y publicar consejos

## Estructura de archivos

```
views/doctor/
├── layout.php              # Layout base reutilizable
├── sidebar.js              # Componente JavaScript del sidebar
├── helpers.php             # Funciones helper
├── dashboard.php           # Dashboard principal mejorado
├── historial_clinico.php   # Historial médico dinámico
├── estadisticas.php        # Gráficos y estadísticas
├── consejos.php            # Sistema de consejos médicos
├── dar_consejos.php        # Formulario para crear consejos
├── index.view.php          # Vista principal (por mantener)
└── ... otros archivos originales
```

## Nuevas funcionalidades implementadas

### 📊 **Estadísticas y Gráficos**
- **KPIs dinámicos**: Pacientes, citas, ingresos, satisfacción
- **Gráficos interactivos**: Citas mensuales y por especialidad
- **Exportación**: PDF y Excel de reportes
- **Métricas en tiempo real**: Estado de citas y agenda

### 💬 **Sistema de Consejos**
- **Consejos categorizados**: Alimentación, ejercicio, bienestar mental, etc.
- **Interfaz de navegación**: Anterior/Siguiente con indicadores
- **Creación de contenido**: Formulario completo para publicar consejos
- **Gestión de borradores**: Guardar y continuar edición
- **Etiquetas y filtros**: Organización por categorías

### 🎨 **UI/UX Mejorada**
- **Responsive design**: Funciona en móvil, tablet y desktop
- **Animaciones suaves**: Transiciones y hover effects
- **Estados interactivos**: Loading, success, error states
- **Accesibilidad**: Navegación por teclado y screen readers

## Cómo usar el layout base

### En el controlador:
```php
public function algunaAccion() {
    // Datos para la vista
    $data = [
        'title' => 'Título de la página',
        'pageTitle' => 'Título que aparece en el header',
        'estadisticas' => $this->getEstadisticas(),
        'consejos' => $this->getConsejos(),
        // ... otros datos
    ];

    // Renderizar con layout
    $content = $this->renderPartial('doctor/nueva_vista');
    echo $this->renderWithLayout($content, $data);
}
```

### En la vista (ejemplo):
```php
<?php
// Configurar variables para el layout
$title = 'Estadísticas - HealthMate';
$pageTitle = 'ESTADÍSTICAS';
?>

<!-- Contenido de la página -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Mis Estadísticas</h1>
    <!-- Tu contenido aquí -->
</div>
```

## Características del nuevo sistema
- ✅ Datos dinámicos desde el controlador
- ✅ Manejo de errores y estados vacíos
- ✅ UI moderna y consistente
- ✅ Accesibilidad mejorada

## Funcionalidades por vista

### 🏠 **Dashboard** (`dashboard.php`)
- KPIs principales con métricas
- Acciones rápidas para tareas comunes
- Pacientes recientes con información resumida
- Centro de ayuda integrado

### 📋 **Historial Clínico** (`historial_clinico.php`)
- Información completa del paciente
- Historial médico detallado
- Información del doctor tratante
- Contacto de emergencia

### 📊 **Estadísticas** (`estadisticas.php`)
- Gráficos de citas mensuales
- Distribución por especialidades
- Métricas de rendimiento
- Exportación de reportes

### 💡 **Consejos** (`consejos.php`)
- Navegación por consejos médicos
- Categorización por temas de salud
- Información de autores y fechas
- Interacciones sociales

### ✍️ **Dar Consejos** (`dar_consejos.php`)
- Formulario completo para crear consejos
- Categorización y etiquetado
- Programación de publicaciones
- Gestión de borradores

## Próximos pasos
1. Actualizar el controlador para usar el nuevo layout
2. Implementar el manejo de datos dinámicos en el controlador
3. Agregar más funcionalidades según necesites
4. Optimizar el rendimiento con lazy loading

## Mantenimiento
- ✅ Archivos originales conservados como backup
- ✅ Código modular y reutilizable
- ✅ Documentación actualizada
- ✅ Estructura escalable para nuevas funcionalidades
