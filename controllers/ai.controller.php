<?php

class Ai extends ControllerBase
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Renderiza la vista principal del chat con Vitali
     */
    public function render()
    {
        $this->view->render('ai/index');
    }

    /**
     * Procesa la interacción del chat mediante AJAX (POST)
     */
    public function chat()
    {
        header('Content-Type: application/json');

        // Verificar que la petición sea POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Método no permitido. Use POST.']);
            exit;
        }

        // Obtener y decodificar el mensaje del cuerpo de la petición
        $input = json_decode(file_get_contents('php://input'), true);
        $message = trim($input['message'] ?? '');

        if (empty($message)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'El mensaje no puede estar vacío.']);
            exit;
        }

        // Validar si la API Key está configurada
        if (!defined('AI_API_KEY') || empty(AI_API_KEY)) {
            echo json_encode([
                'success' => false, 
                'error' => 'El asistente Vitali está en mantenimiento. Por favor, configura tu API Key en el archivo config/config.php.'
            ]);
            exit;
        }

        // Inicializar el historial de conversación en la sesión si no existe
        if (!isset($_SESSION['ai_chat_history'])) {
            $_SESSION['ai_chat_history'] = [];
        }

        // Agregar mensaje del usuario al historial
        $_SESSION['ai_chat_history'][] = ['role' => 'user', 'content' => $message];

        try {
            // Invocar la API correspondiente
            $provider = defined('AI_PROVIDER') ? strtolower(AI_PROVIDER) : 'openai';
            
            if ($provider === 'gemini') {
                $reply = $this->llamarGemini($_SESSION['ai_chat_history']);
            } else {
                $reply = $this->llamarOpenAI($_SESSION['ai_chat_history']);
            }

            // Agregar respuesta de Vitali al historial
            $_SESSION['ai_chat_history'][] = ['role' => 'assistant', 'content' => $reply];

            echo json_encode([
                'success' => true,
                'reply' => $reply
            ]);
        } catch (Exception $e) {
            // Registrar error para depuración
            error_log("Error en Vitali AI Assistant: " . $e->getMessage());
            
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Vitali está teniendo problemas para responder en este momento. Inténtalo de nuevo.'
            ]);
        }
        exit;
    }

    /**
     * Limpia el historial de conversación de la sesión
     */
    public function clear()
    {
        header('Content-Type: application/json');
        if (isset($_SESSION['ai_chat_history'])) {
            unset($_SESSION['ai_chat_history']);
        }
        echo json_encode(['success' => true, 'message' => 'Conversación con Vitali reiniciada.']);
        exit;
    }

    /**
     * Llama a la API de OpenAI usando cURL
     */
    private function llamarOpenAI($history)
    {
        $systemPrompt = $this->getSystemPrompt();
        
        $messages = [['role' => 'system', 'content' => $systemPrompt]];
        foreach ($history as $msg) {
            $messages[] = [
                'role' => $msg['role'],
                'content' => $msg['content']
            ];
        }

        $model = defined('AI_MODEL') && !empty(AI_MODEL) ? AI_MODEL : 'gpt-4o-mini';

        $ch = curl_init('https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . AI_API_KEY
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'model' => $model,
            'messages' => $messages,
            'temperature' => 0.6
        ]));

        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            throw new Exception("Error cURL de OpenAI: " . $error_msg);
        }
        
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);

        if ($http_code !== 200) {
            $err_msg = $data['error']['message'] ?? "Código HTTP " . $http_code;
            throw new Exception("Error de API OpenAI: " . $err_msg);
        }

        return $data['choices'][0]['message']['content'] ?? 'No se recibió respuesta del asistente.';
    }

    /**
     * Llama a la API de Gemini usando cURL
     */
    private function llamarGemini($history)
    {
        $systemPrompt = $this->getSystemPrompt();
        $model = defined('AI_MODEL') && !empty(AI_MODEL) ? AI_MODEL : 'gemini-1.5-flash';
        
        // Mapear historial al formato de Gemini
        $contents = [];
        foreach ($history as $msg) {
            $role = ($msg['role'] === 'assistant') ? 'model' : 'user';
            $contents[] = [
                'role' => $role,
                'parts' => [
                    ['text' => $msg['content']]
                ]
            ];
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . AI_API_KEY;

        $payload = [
            'contents' => $contents,
            'systemInstruction' => [
                'parts' => [
                    ['text' => $systemPrompt]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.6
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            throw new Exception("Error cURL de Gemini: " . $error_msg);
        }

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);

        if ($http_code !== 200) {
            $err_msg = $data['error']['message'] ?? "Código HTTP " . $http_code;
            throw new Exception("Error de API Gemini: " . $err_msg);
        }

        return $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No se recibió respuesta del asistente.';
    }

    /**
     * Obtiene el prompt de sistema personalizado para Vitali
     */
    private function getSystemPrompt()
    {
        $nombreUsuario = $_SESSION['usuario_nombre'] ?? 'Usuario';
        
        $prompt = "Eres Vitali, un asistente virtual inteligente y empático especializado en salud y bienestar para la plataforma HealthMate.\n";
        $prompt .= "Estás interactuando con {$nombreUsuario}. Tu tono debe ser siempre profesional, amable, compasivo y tranquilizador.\n\n";
        
        $prompt .= "Instrucciones de comportamiento:\n";
        $prompt .= "1. ORIENTACIÓN GENERAL: Puedes responder preguntas sobre hábitos saludables, alimentación, ejercicio, bienestar mental y uso general de la plataforma HealthMate.\n";
        $prompt .= "2. LIMITACIÓN DE RESPONSABILIDAD MÉDICA (CRÍTICO): Bajo ninguna circunstancia debes emitir diagnósticos clínicos, recetar medicamentos específicos ni sustituir la opinión o consulta presencial de un profesional de la salud (médico, enfermero, etc.). Si el usuario describe síntomas graves, dolor agudo o una emergencia, debes recomendarle explícitamente acudir al servicio de urgencias o contactar a su médico inmediatamente.\n";
        $prompt .= "3. PRIVACIDAD: No solicites contraseñas, números de seguro social, ni información de tarjetas bancarias.\n";
        $prompt .= "4. FORMATO: Responde usando formato Markdown limpio para facilitar la lectura. Usa viñetas, negritas para dar énfasis y párrafos cortos.\n";
        $prompt .= "5. BREVEDAD: Intenta que tus respuestas sean concisas y directas para no abrumar al usuario.";

        return $prompt;
    }
}
