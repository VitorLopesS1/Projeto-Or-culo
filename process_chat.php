<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $logFile = __DIR__ . '\log.txt'; // Certifique-se de usar o caminho absoluto

    // Registrar início da requisição
    file_put_contents($logFile, "Nova requisição recebida.\n", FILE_APPEND);

    $question = trim($_POST['question'] ?? '');

    if (empty($question)) {
        file_put_contents($logFile, "Erro: Pergunta vazia.\n", FILE_APPEND);
        echo json_encode(['answer' => 'Por favor, envie uma pergunta válida.']);
        exit;
    }

    file_put_contents($logFile, "Pergunta recebida: $question\n", FILE_APPEND);

    // Configuração da chave da API
    $apiKey = 'sk-9HNX9UZSdT4o3esJHOC2pxIv0JP8dCrzH8YeW50c1XT3BlbkFJhjIN-R1bO7etigMvcup3kBxCrxx-XtIUMl7YuTub0A'; // Substitua pela sua chave API válida

    if (!$apiKey) {
        file_put_contents($logFile, "Erro: Chave da API não configurada.\n", FILE_APPEND);
        echo json_encode(['answer' => 'Erro: Chave da API não configurada.']);
        exit;
    }

    // Formatar o prompt para a API
    $prompt = "Faça de conta que você é um oráculo e responda à seguinte pergunta: $question";

    $data = [
        'model' => 'gpt-4', // Usando o modelo GPT-4
        'messages' => [['role' => 'user', 'content' => $prompt]],
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Authorization: Bearer $apiKey",
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15); // Adicionar tempo limite de 15 segundos

    $response = curl_exec($ch);

    if ($response === false) {
        $error = curl_error($ch);
        file_put_contents($logFile, "Erro cURL: $error\n", FILE_APPEND);
        echo json_encode(['answer' => 'Erro na comunicação com a API.']);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    file_put_contents($logFile, "Resposta da API recebida: $response\n", FILE_APPEND);

    $responseData = json_decode($response, true);

    if (isset($responseData['error'])) {
        $errorDetail = $responseData['error']['message'] ?? 'Erro desconhecido.';
        file_put_contents($logFile, "Erro da API: $errorDetail\n", FILE_APPEND);
        echo json_encode(['answer' => "Erro: $errorDetail"]);
        exit;
    }

    $answer = $responseData['choices'][0]['message']['content'] ?? 'Erro ao processar resposta.';
    file_put_contents($logFile, "Resposta enviada ao cliente: $answer\n", FILE_APPEND);

    echo json_encode(['answer' => $answer]);
}