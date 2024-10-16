<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.html');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Actividad de Inglés</title>
    <script src="/exit.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #b3e0ff; /* Fondo azul claro, como el mar */
            padding: 20px;
        }
        .module {
            background-color: #fff;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: left;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Sutil sombra */
        }
        .question {
            margin: 10px 0;
        }
        .feedback {
            font-size: 20px;
        }
        .btn-verify {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .summary {
            margin-top: 20px;
        }
    </style>
    <script>
        function checkAnswers(module) {
            const answers = {
                module1: ["am", "is", "are", "is", "are"],
                module2: ["has", "have", "has", "have", "have"],
                module3: ["play", "read", "write", "sing", "draw"]
            };
            const feedbacks = document.querySelectorAll('.' + module + '-feedback');
            const inputs = document.querySelectorAll('.' + module + '-input');
            for (let i = 0; i < answers[module].length; i++) {
                if (inputs[i].value.toLowerCase() === answers[module][i]) {
                    feedbacks[i].innerHTML = "&#10004; Correcto";
                    feedbacks[i].style.color = '#4CAF50'; /* Color verde */
                } else {
                    feedbacks[i].innerHTML = "&#10006; Incorrecto";
                    feedbacks[i].style.color = 'red'; /* Color rojo */
                }
            }
        }
    </script>
</head>
<body>
    <h1>Actividad de Inglés</h1>

    <div class="module" id="module1">
        <h2>Módulo 1: Verbo "To Be"</h2>
        <div class="question">
            <p>1. I <input type="text" class="module1-input"> a student.</p>
            <p class="feedback module1-feedback"></p>
        </div>
        <div class="question">
            <p>2. She <input type="text" class="module1-input"> a teacher.</p>
            <p class="feedback module1-feedback"></p>
        </div>
        <div class="question">
            <p>3. They <input type="text" class="module1-input"> friends.</p>
            <p class="feedback module1-feedback"></p>
        </div>
        <div class="question">
            <p>4. He <input type="text" class="module1-input"> a doctor.</p>
            <p class="feedback module1-feedback"></p>
        </div>
        <div class="question">
            <p>5. You <input type="text" class="module1-input"> a student.</p>
            <p class="feedback module1-feedback"></p>
        </div>
    </div>

    <div class="module" id="module2">
        <h2>Módulo 2: "Have" y "Has"</h2>
        <div class="summary">
            <p>"Have" se utiliza con pronombres personales (I, you, we, they).</p>
            <p>"Has" se utiliza con pronombres personales (he, she, it).</p>
        </div>
        <div class="question">
            <p>1. She <input type="text" class="module2-input"> a cat.</p>
            <p class="feedback module2-feedback"></p> </div>
        <div class="question">
            <p>2. They <input type="text" class="module2-input"> two cars.</p>
            <p class="feedback module2-feedback"></p>
        </div>
        <div class="question">
            <p>3. He <input type="text" class="module2-input"> a book.</p>
            <p class="feedback module2-feedback"></p>
        </div>
        <div class="question">
            <p>4. I <input type="text" class="module2-input"> a bicycle.</p>
            <p class="feedback module2-feedback"></p>
        </div>
        <div class="question">
            <p>5. You <input type="text" class="module2-input"> a computer.</p>
            <p class="feedback module2-feedback"></p>
        </div>
    </div>

    <div class="module" id="module3">
        <h2>Módulo 3: Verbos en General</h2>
        <div class="question">
            <p>1. Escribe un verbo que comience con "p" y signifique "jugar".</p>
            <input type="text" class="module3-input">
            <p class="feedback module3-feedback"></p>
        </div>
        <div class="question">
            <p>2. Escribe un verbo que comience con "r" y signifique "leer".</p>
            <input type="text" class="module3-input">
            <p class="feedback module3-feedback"></p>
        </div>
        <div class="question">
            <p>3. Escribe un verbo que comience con "w" y signifique "escribir".</p>
            <input type="text" class="module3-input">
            <p class="feedback module3-feedback"></p></div>
        <div class="question">
            <p>4. Escribe un verbo que comience con "s" y signifique "cantar".</p>
            <input type="text" class="module3-input">
            <p class="feedback module3-feedback"></p>
        </div>
        <div class="question">
            <p>5. Escribe un verbo que comience con "d" y signifique "dibujar".</p>
            <input type="text" class="module3-input">
            <p class="feedback module3-feedback"></p>
        </div>
    </div>

    <button class="btn-verify" onclick="checkAnswers('module1')">Verificar respuestas Módulo 1</button>
    <button class="btn-verify" onclick="checkAnswers('module2')">Verificar respuestas Módulo 2</button>
    <button class="btn-verify" onclick="checkAnswers('module3')">Verificar respuestas Módulo 3</button>
</body>
</html>
