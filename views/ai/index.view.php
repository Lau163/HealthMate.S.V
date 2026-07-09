<?php
$titulo = 'Vitali - Asistente de IA | HealthMate';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <!-- Tarjeta del Chat con Glassmorphism -->
        <div class="vitali-card">
            <!-- Encabezado del Asistente -->
            <div class="vitali-header">
                <div class="d-flex align-items-center">
                    <div class="vitali-avatar">
                        <i class="fas fa-robot text-white"></i>
                        <span class="online-indicator"></span>
                    </div>
                    <div class="ms-3">
                        <h4 class="mb-0 fw-bold text-white text-start">Vitali</h4>
                        <small class="text-white-50">Asistente de Salud Inteligente</small>
                    </div>
                </div>
                <button id="clearChatBtn" class="btn btn-outline-light btn-sm rounded-pill px-3" title="Reiniciar chat">
                    <i class="fas fa-trash-alt me-1"></i> Reiniciar
                </button>
            </div>

            <!-- Cuerpo del Chat (Mensajes) -->
            <div id="chatBody" class="vitali-body">
                <!-- Estado Vacío (Mensaje de bienvenida) -->
                <div id="emptyState" class="empty-state">
                    <div class="empty-icon-wrapper">
                        <i class="fas fa-heartbeat text-teal-600"></i>
                    </div>
                    <h5 class="fw-bold text-teal-800 mt-3">¡Hola! Soy Vitali</h5>
                    <p class="text-muted text-center px-4">
                        Tu asistente virtual en HealthMate. Puedo ayudarte con información sobre hábitos saludables, alimentación, consejos de ejercicio, orientación sobre signos vitales o cómo usar el sistema.
                    </p>
                    
                    <div class="suggest-chips mt-4">
                        <span class="chip-title mb-2 d-block text-muted small fw-bold">Prueba preguntándome:</span>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button class="suggest-chip" onclick="sendSuggestion('¿Cómo controlo mis signos vitales?')">
                                ¿Cómo controlo mis signos vitales?
                            </button>
                            <button class="suggest-chip" onclick="sendSuggestion('Dame consejos para mejorar mi alimentación')">
                                Consejos de alimentación
                            </button>
                            <button class="suggest-chip" onclick="sendSuggestion('¿Cómo puedo mejorar la calidad de mi sueño?')">
                                Hábitos de sueño saludable
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Historial de mensajes cargado desde la sesión de PHP -->
                <?php if (isset($_SESSION['ai_chat_history']) && !empty($_SESSION['ai_chat_history'])): ?>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            document.getElementById('emptyState').classList.add('d-none');
                        });
                    </script>
                    <?php foreach ($_SESSION['ai_chat_history'] as $msg): ?>
                        <div class="message-wrapper <?= $msg['role'] === 'user' ? 'user' : 'assistant' ?>">
                            <div class="message-bubble">
                                <?= htmlspecialchars($msg['content']) // Se formateará en JS al cargar para renderizar Markdown ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Indicador de Escritura (Oculto por defecto) -->
                <div id="typingIndicator" class="message-wrapper assistant d-none">
                    <div class="message-bubble typing">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            </div>

            <!-- Entrada de Texto y Envío -->
            <div class="vitali-footer">
                <form id="chatForm" class="w-full">
                    <div class="input-group">
                        <input type="text" id="userInput" class="form-control chat-input" 
                               placeholder="Escribe tu mensaje aquí..." autocomplete="off" required>
                        <button type="submit" id="sendBtn" class="btn btn-teal-submit" title="Enviar mensaje">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Descargo de Responsabilidad -->
        <div class="text-center mt-3 px-3">
            <small class="text-muted">
                <i class="fas fa-info-circle me-1"></i>
                <strong>Descargo de responsabilidad:</strong> Vitali proporciona información y consejos de bienestar general. No emite diagnósticos médicos ni sustituye la consulta médica profesional. En caso de emergencia, llama inmediatamente al 911 o acude al centro médico más cercano.
            </small>
        </div>
    </div>
</div>

<!-- Estilos CSS Premium Personalizados -->
<style>
    /* Variables de Diseño */
    :root {
        --teal-main: #0d9488;
        --teal-dark: #0f766e;
        --teal-light: #f0fdfa;
        --teal-hover: #115e59;
        --bg-glass: rgba(255, 255, 255, 0.85);
        --border-glass: rgba(13, 148, 136, 0.15);
        --shadow-premium: 0 15px 35px rgba(13, 148, 136, 0.1);
        --text-dark: #1f2937;
    }

    /* Estructura Principal */
    .vitali-card {
        background: var(--bg-glass);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--border-glass);
        border-radius: 20px;
        box-shadow: var(--shadow-premium);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 600px;
        margin-top: 10px;
        transition: transform 0.3s ease;
    }

    /* Encabezado */
    .vitali-header {
        background: linear-gradient(135deg, var(--teal-main), var(--teal-dark));
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .vitali-avatar {
        position: relative;
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        border: 2px solid rgba(255, 255, 255, 0.4);
    }

    .online-indicator {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 12px;
        height: 12px;
        background-color: #10b981;
        border: 2px solid var(--teal-main);
        border-radius: 50%;
        animation: pulseIndicator 2s infinite;
    }

    @keyframes pulseIndicator {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.2); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }

    /* Cuerpo del Chat */
    .vitali-body {
        flex: 1;
        padding: 1.5rem;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        background: radial-gradient(circle at top right, rgba(204, 251, 241, 0.2), transparent 60%);
    }

    /* Estado Vacío */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        margin: auto 0;
    }

    .empty-icon-wrapper {
        width: 70px;
        height: 70px;
        background: var(--teal-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        box-shadow: 0 8px 20px rgba(13, 148, 136, 0.08);
        animation: bounceIcon 3s infinite ease-in-out;
    }

    @keyframes bounceIcon {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    .suggest-chips .suggest-chip {
        background: white;
        color: var(--teal-dark);
        border: 1px solid rgba(13, 148, 136, 0.2);
        padding: 0.5rem 1rem;
        border-radius: 30px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }

    .suggest-chips .suggest-chip:hover {
        background: var(--teal-main);
        color: white;
        border-color: var(--teal-main);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(13, 148, 136, 0.15);
    }

    /* Burbujas de Mensaje */
    .message-wrapper {
        display: flex;
        width: 100%;
        animation: slideInMessage 0.3s ease-out;
    }

    @keyframes slideInMessage {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .message-wrapper.user {
        justify-content: flex-end;
    }

    .message-wrapper.assistant {
        justify-content: flex-start;
    }

    .message-bubble {
        max-width: 75%;
        padding: 0.85rem 1.2rem;
        border-radius: 18px;
        font-size: 0.95rem;
        line-height: 1.5;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        word-wrap: break-word;
        text-align: left;
    }

    .message-wrapper.user .message-bubble {
        background: linear-gradient(135deg, var(--teal-main), var(--teal-dark));
        color: white;
        border-bottom-right-radius: 4px;
        box-shadow: 0 4px 12px rgba(13, 148, 136, 0.2);
    }

    .message-wrapper.assistant .message-bubble {
        background: white;
        color: var(--text-dark);
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-bottom-left-radius: 4px;
    }

    /* Markdown en burbujas */
    .message-bubble strong {
        font-weight: 700;
        color: inherit;
    }
    
    .message-bubble li {
        margin-top: 0.25rem;
        margin-bottom: 0.25rem;
    }

    /* Indicador de Escritura */
    .typing .dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        background-color: var(--teal-main);
        border-radius: 50%;
        margin-right: 4px;
        animation: typingDot 1.4s infinite ease-in-out both;
    }

    .typing .dot:nth-child(1) { animation-delay: -0.32s; }
    .typing .dot:nth-child(2) { animation-delay: -0.16s; }

    @keyframes typingDot {
        0%, 80%, 100% { transform: scale(0); opacity: 0.4; }
        40% { transform: scale(1); opacity: 1; }
    }

    /* Pie del Chat (Entrada de texto) */
    .vitali-footer {
        padding: 1.25rem 1.5rem;
        background: white;
        border-top: 1px solid rgba(0,0,0,0.06);
    }

    .chat-input {
        border: 1px solid rgba(13, 148, 136, 0.2);
        padding: 0.75rem 1.2rem;
        border-radius: 30px !important;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .chat-input:focus {
        border-color: var(--teal-main);
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
        outline: none;
    }

    .btn-teal-submit {
        background: var(--teal-main);
        color: white;
        border-radius: 50% !important;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 10px;
        border: none;
        transition: all 0.2s ease;
        box-shadow: 0 4px 10px rgba(13, 148, 136, 0.25);
    }

    .btn-teal-submit:hover {
        background: var(--teal-hover);
        color: white;
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(13, 148, 136, 0.35);
    }

    .btn-teal-submit:active {
        transform: scale(0.95);
    }
</style>

<!-- Lógica JavaScript del Chat con Vitali -->
<script>
    // Formateador simple de Markdown a HTML seguro en el Frontend
    function formatMarkdown(text) {
        // Sanitizar HTML básico para evitar inyecciones XSS
        let escaped = text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;");

        // Convertir negritas (**texto**)
        escaped = escaped.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

        // Convertir listas con viñetas (- elemento o * elemento)
        escaped = escaped.replace(/(?:^|\n)[*-]\s+(.+)/g, '<li class="ms-3">$1</li>');

        // Convertir saltos de línea a <br>
        escaped = escaped.replace(/\n/g, '<br>');

        return escaped;
    }

    document.addEventListener("DOMContentLoaded", function() {
        const chatForm = document.getElementById("chatForm");
        const userInput = document.getElementById("userInput");
        const sendBtn = document.getElementById("sendBtn");
        const chatBody = document.getElementById("chatBody");
        const typingIndicator = document.getElementById("typingIndicator");
        const emptyState = document.getElementById("emptyState");
        const clearChatBtn = document.getElementById("clearChatBtn");

        // Formatear mensajes existentes de la sesión (si los hay)
        document.querySelectorAll(".message-wrapper.assistant .message-bubble").forEach(bubble => {
            // Solo formatear si no es el indicador de escritura
            if (!bubble.classList.contains("typing")) {
                bubble.innerHTML = formatMarkdown(bubble.innerText);
            }
        });

        // Hacer scroll automático al final
        scrollToBottom();

        // Enviar formulario del chat
        chatForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const messageText = userInput.value.trim();
            if (!messageText) return;

            // Limpiar input y desactivar controles
            userInput.value = "";
            setControlsEnabled(false);

            // Ocultar estado vacío si está visible
            if (!emptyState.classList.contains("d-none")) {
                emptyState.classList.add("d-none");
            }

            // Renderizar mensaje del usuario
            appendMessage(messageText, "user");
            scrollToBottom();

            // Mostrar indicador de escritura de Vitali
            showTyping(true);

            // Petición AJAX (Fetch) al controlador
            fetch("<?= BASE_URL ?>ai/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ message: messageText })
            })
            .then(response => response.json())
            .then(data => {
                showTyping(false);
                setControlsEnabled(true);

                if (data.success) {
                    appendMessage(data.reply, "assistant");
                } else {
                    appendMessage(data.error || "Ocurrió un error inesperado al contactar al asistente.", "assistant error-msg");
                }
                scrollToBottom();
                userInput.focus();
            })
            .catch(error => {
                showTyping(false);
                setControlsEnabled(true);
                appendMessage("Error de conexión. Asegúrate de estar conectado a internet e inténtalo de nuevo.", "assistant error-msg");
                scrollToBottom();
                console.error("Error en Fetch:", error);
            });
        });

        // Limpiar chat
        clearChatBtn.addEventListener("click", function() {
            if (confirm("¿Estás seguro de que deseas borrar el historial de conversación con Vitali?")) {
                fetch("<?= BASE_URL ?>ai/clear", {
                    method: "POST"
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Eliminar todas las burbujas de mensajes excepto el indicador de escritura
                        const wrappers = chatBody.querySelectorAll(".message-wrapper:not(#typingIndicator)");
                        wrappers.forEach(w => w.remove());
                        
                        // Mostrar el estado vacío de bienvenida
                        emptyState.classList.remove("d-none");
                    }
                })
                .catch(error => {
                    console.error("Error al limpiar chat:", error);
                });
            }
        });

        // Función para agregar burbujas al chat
        function appendMessage(text, role) {
            const wrapper = document.createElement("div");
            wrapper.className = `message-wrapper ${role}`;

            const bubble = document.createElement("div");
            bubble.className = "message-bubble";
            
            if (role.includes("assistant")) {
                bubble.innerHTML = formatMarkdown(text);
            } else {
                bubble.textContent = text;
            }

            wrapper.appendChild(bubble);
            
            // Insertar antes del indicador de escritura para que quede abajo del todo
            chatBody.insertBefore(wrapper, typingIndicator);
        }

        // Mostrar / Ocultar indicador de escritura
        function showTyping(show) {
            if (show) {
                typingIndicator.classList.remove("d-none");
            } else {
                typingIndicator.classList.add("d-none");
            }
        }

        // Habilitar / Deshabilitar controles de envío
        function setControlsEnabled(enabled) {
            userInput.disabled = !enabled;
            sendBtn.disabled = !enabled;
        }

        // Auto Scroll
        function scrollToBottom() {
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    });

    // Función auxiliar al hacer clic en sugerencias
    function sendSuggestion(text) {
        const userInput = document.getElementById("userInput");
        const chatForm = document.getElementById("chatForm");
        userInput.value = text;
        
        // Simular envío de formulario
        const submitEvent = new Event("submit", { cancelable: true });
        chatForm.dispatchEvent(submitEvent);
    }
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
