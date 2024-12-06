<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oráculo Responde</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0px;
            padding: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: aliceblue;
            color: black;
            height: 100vh;
            overflow: auto;
            background-image: url('fundo4.png');
            background-size: cover;

            background-position: center;

            background-repeat: no-repeat;

        }


        #showChatButton {
            position: absolute;
            top: 53%;
            left: 52%;
            transform: translate(-50%, -50%);
            padding: 10px 20px;
            font-size: 16px;
            background-color: #0b93f6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #chat-container {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 90%;
            max-width: 600px;
            height: 80%;
            background: #444654;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .history-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #202123;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .history-item-checkbox {
            width: 20px;
            height: 20px;
            accent-color: #0b93f6;

            cursor: pointer;
        }

        .history-delete {
            margin-top: 10px;
            padding: 10px 15px;
            background: #ff9800;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .history-delete:hover {
            background: #e68900;
        }


        .history-clear {
            margin-top: 10px;
            padding: 10px 15px;
            background: #dc3545;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .history-clear:hover {
            background: #a71d2a;
        }


        .chat-container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 90%;
            max-width: 800px;
            height: 90%;
            background: #444654;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }


        .chat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: #202123;
            color: white;
            font-weight: bold;
            border-bottom: 1px solid #333;
        }

        .chat-header button {
            padding: 6px 32px;
            background: #0b93f6;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
        }

        .chat-header button:hover {
            background: #0077cc;
        }


        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-image: url('fundo\ 2.png');
            background-position: 50% 50%;


            background-size: cover;

            scroll-behavior: smooth;
            scrollbar-width: none;

            -ms-overflow-style: none;

        }

        .chat-messages::-webkit-scrollbar-thumb {
            background-color: #555;
            border-radius: 3px;
        }



        .history-container {
            overflow-y: auto;

            scrollbar-width: none;

            -ms-overflow-style: none;

        }

        .history-container::-webkit-scrollbar {
            display: none;

        }

        #historyContent {
            overflow-y: auto;
            scrollbar-width: none;

            -ms-overflow-style: none;

        }

        #historyContent::-webkit-scrollbar {
            display: none;

        }

        .message {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .message.user {
            justify-content: flex-end;
        }

        .message.user .text {
            background: #0b93f6;
            color: white;
            align-self: flex-end;
            border-radius: 10px 10px 0 10px;
        }

        .message.oraculo {
            justify-content: flex-start;
        }

        .message.oraculo .text {
            background: #444654;
            color: #fff;
            border-radius: 10px 10px 10px 0;
        }

        .message .text {
            max-width: 75%;
            padding: 10px 15px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            line-height: 1.5;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .chat-input {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: #202123;
            border-top: 1px solid #444654;
        }



        .chat-input input {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background: #40414f;
            color: white;
            outline: none;
        }

        .chat-input input::placeholder {
            color: #bbb;
        }

        .chat-input button {
            padding: 10px 15px;
            background: #0b93f6;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .chat-input button:hover {
            background: #0077cc;
        }

        .history-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 10;
            justify-content: center;
            align-items: center;
        }

        .history-modal.active {
            display: flex;
        }

        .history-container {
            background: #444654;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            color: white;
            overflow-y: auto;
            max-height: 80%;
        }

        .history-container h2 {
            margin-top: 0;
            color: #0b93f6;
        }

        .history-item {
            margin-bottom: 15px;
            padding: 10px;
            background: #202123;
            border-radius: 8px;
            color: white;
        }

        .history-close {
            margin-top: 20px;
            padding: 10px 15px;
            background: #dc3545;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            align-self: flex-end;
        }

        .history-close:hover {
            background: #a71d2a;
        }


        button:hover {
            background: #0077cc;
            transform: scale(1.05);

            transition: all 0.3s ease;

        }


        #openHistoryButton:hover {
            background: #0056a3;

        }


        #clearChatButton:hover {
            background: #b53131;
        }


        #sendButton:hover {
            background: #0057b3;
        }

        img {
            width: 223px;
            height: 223px;
            margin-bottom: 203px;
            border-radius: 50%;
            border: 0.5px solid white;

        }
        .button {
            --black-700: hsla(0 0% 12% / 1);
            --border_radius: 9999px;
            --transtion: 0.3s ease-in-out;
            --offset: 2px;

            cursor: pointer;
            position: relative;

            display: flex;
            align-items: center;
            gap: 0.5rem;

            transform-origin: center;

            padding: 1rem 2rem;
            background-color: transparent;

            border: none;
            border-radius: var(--border_radius);
            transform: scale(calc(1 + (var(--active, 0) * 0.1)));

            transition: transform var(--transtion);
        }

        .button::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            width: 100%;
            height: 100%;
            background-color: var(--black-700);

            border-radius: var(--border_radius);
            box-shadow: inset 0 0.5px hsl(0, 0%, 100%), inset 0 -1px 2px 0 hsl(0, 0%, 0%),
                0px 4px 10px -4px hsla(0 0% 0% / calc(1 - var(--active, 0))),
                0 0 0 calc(var(--active, 0) * 0.375rem) hsl(260 97% 50% / 0.75);

            transition: all var(--transtion);
            z-index: 0;
        }

        .button::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            width: 100%;
            height: 100%;
            background-color: hsla(260 97% 61% / 0.75);
            background-image: radial-gradient(
                    at 51% 89%,
                    hsla(266, 45%, 74%, 1) 0px,
                    transparent 50%
                ),
                radial-gradient(at 100% 100%, hsla(266, 36%, 60%, 1) 0px, transparent 50%),
                radial-gradient(at 22% 91%, hsla(266, 36%, 60%, 1) 0px, transparent 50%);
            background-position: top;

            opacity: var(--active, 0);
            border-radius: var(--border_radius);
            transition: opacity var(--transtion);
            z-index: 2;
        }

        .button:is(:hover, :focus-visible) {
            --active: 1;
        }

        .button:active {
            transform: scale(1);
        }

        .button .text_button {
            position: relative;
            z-index: 10;

            background-image: linear-gradient(
                90deg,
                hsla(0 0% 100% / 1) 0%,
                hsla(0 0% 100% / var(--active, 0)) 120%
            );
            background-clip: text;

            font-size: 1rem;
            
        }
    </style>
</head>

<body>
    <img id="wizardImage" src="projeto1-removebg-preview.png" alt="Mago" style="margin-left: 62px;">
    <button id="showChatButton" class="button"> <span class="text_button"><span>Converse com o Oráculo</span></button>


    <div id="chat-container">
        <div class="chat-header">
            <span>Oráculo Respostas</span>
            <button id="openHistoryButton">Histórico</button>
            <button id="clearChatButton">Limpar Chat</button>


        </div>
        <div class="chat-messages" id="chatMessages"></div>
        <div class="chat-input">
            <input type="text" id="userInput" placeholder="Digite sua mensagem aqui...">
            <button id="sendButton">Enviar</button>
        </div>
    </div>


    <div class="history-modal" id="historyModal">
        <div class="history-container">
            <h2>Histórico</h2>
            <div id="historyContent"></div>
            <button class="history-delete" id="deleteSelectedButton">Excluir Selecionados</button>
            <button class="history-close" id="closeHistoryButton">Fechar</button>
            <button class="history-clear" id="clearHistoryButton">Limpar Histórico</button>
        </div>
    </div>

    <script>
        const sendButton = document.getElementById('sendButton');
        const userInput = document.getElementById('userInput');
        const chatMessages = document.getElementById('chatMessages');
        const openHistoryButton = document.getElementById('openHistoryButton');
        const historyModal = document.getElementById('historyModal');
        const historyContent = document.getElementById('historyContent');
        const closeHistoryButton = document.getElementById('closeHistoryButton');
        const clearChatButton = document.getElementById('clearChatButton');
        const clearHistoryButton = document.getElementById('clearHistoryButton');
        const deleteSelectedButton = document.getElementById('deleteSelectedButton');
        const showChatButton = document.getElementById('showChatButton');
        const chatContainer = document.getElementById('chat-container');
        const wizardImage = document.getElementById('wizardImage');

        document.addEventListener('DOMContentLoaded', () => {
            const showChatButton = document.getElementById('showChatButton');
            const chatContainer = document.getElementById('chat-container');

            if (showChatButton && chatContainer) {
                showChatButton.addEventListener('click', () => {
                    chatContainer.style.display = 'flex';
                    showChatButton.style.display = 'none';
                });
            } else {
                console.error('Elementos não encontrados no DOM');
            }
        });
        showChatButton.addEventListener('click', () => {
            
            showChatButton.style.display = 'none';
            wizardImage.style.display = 'none';

           
            chatContainer.style.display = 'block';
        });

        showChatButton.addEventListener('click', () => {
            chatContainer.style.display = 'block';
            showChatButton.style.display = 'none'; 
        });



        clearHistoryButton.addEventListener('click', clearHistory);
        deleteSelectedButton.addEventListener('click', deleteSelectedItems);

        sendButton.addEventListener('click', sendMessage);
        userInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') sendMessage();
        });
        openHistoryButton.addEventListener('click', openHistory);
        closeHistoryButton.addEventListener('click', closeHistory);

        clearChatButton.addEventListener('click', clearChat);

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && historyModal.classList.contains('active')) {
                closeHistory();
            }
        });

        function sendMessage() {
            const messageText = userInput.value.trim();
            if (!messageText) return;

            addMessage(messageText, 'user');
            userInput.value = '';

            fetch('process_chat.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `question=${encodeURIComponent(messageText)}`
                })
                .then((response) => response.json())
                .then((data) => {
                    const oraculoMessage = data.answer || 'Erro ao obter resposta.';
                    addMessage(oraculoMessage, 'oraculo');
                    saveToHistory(messageText, oraculoMessage);
                })
                .catch(() => {
                    addMessage('Erro ao comunicar com o servidor.', 'oraculo');
                });
        }

        function addMessage(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message', sender);
            if (sender === 'oraculo') {
                const icon = document.createElement('img');
                icon.src = "projeto1-removebg-preview.png"; 
                icon.alt = "Oráculo";
                icon.style.width = "70px"; 
                icon.style.height = "70px"; 
                icon.style.marginRight = "0.5px"; 
                icon.style.marginLeft = "0.5px";
                messageDiv.appendChild(icon);
            }


            const messageText = document.createElement('div');
            messageText.classList.add('text');
            messageText.textContent = text;

            messageDiv.appendChild(messageText);
            chatMessages.appendChild(messageDiv);

            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function saveToHistory(question, answer) {
            const history = JSON.parse(localStorage.getItem('history')) || [];
            history.push({
                question,
                answer
            });
            localStorage.setItem('history', JSON.stringify(history));
        }


        function openHistory() {
            const history = JSON.parse(localStorage.getItem('history')) || [];
            historyContent.innerHTML = history.map(item => `
                <div class="history-item">
                    <p><strong>Pergunta:</strong> ${item.question}</p>
                    <p><strong>Resposta:</strong> ${item.answer}</p>
                </div>
            `).join('');
            historyModal.classList.add('active');
        }

        function closeHistory() {
            historyModal.classList.remove('active');

        }

        function clearHistory() {
            localStorage.removeItem('history');
            historyContent.innerHTML = '';
        }

        function clearChat() {
            chatMessages.innerHTML = '';
        }

        function deleteSelectedItems() {
            const checkboxes = document.querySelectorAll('.history-item-checkbox:checked'); 
            const history = JSON.parse(localStorage.getItem('history')) || [];


            const updatedHistory = history.filter((_, index) => {
                return !Array.from(checkboxes).some(checkbox => parseInt(checkbox.dataset.index) === index);
            });


            localStorage.setItem('history', JSON.stringify(updatedHistory));


            openHistory();
        }

        function openHistory() {
            const history = JSON.parse(localStorage.getItem('history')) || [];
            historyContent.innerHTML = history.map((item, index) => `
        <div class="history-item">
            <input type="checkbox" class="history-item-checkbox" data-index="${index}">
            <p><strong>Pergunta:</strong> ${item.question}</p>
            <p><strong>Resposta:</strong> ${item.answer}</p>
        </div>
    `).join('');
            historyModal.classList.add('active');
        }
    </script>
</body>

</html>