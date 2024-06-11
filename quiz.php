<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/silent.png" type="image/png">
    <title>Silent Language Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/background-image.gif'); 
            background-size: cover;
            background-position: center;
            text-align: center;
            padding-top: 5vh;
            margin: 0;
        }
        .header {
            background-color: #f8f8f8;
            color: #333;
            padding: 10px 20px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header img {
            height: 50px;
        }
        .header h1 {
            flex-grow: 1;
            margin: 0;
            text-align: center;
            font-size: 24px;
            color: #4CAF50;
        }
        .btn-home {
            background-color: #ff5722;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 0.9em;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-home:hover {
            background-color: #E67E22;
        }
        .container {
            display: none; /* Initially hidden */
            margin-top: 10vh;
        }
        .quiz-title {
            font-size: 3vw;
            margin-bottom: 3vh;
            color: #333;
        }
        .question {
            font-size: 3vw;
            margin-bottom: 4vh;
        }
        .buttons {
            display: grid;
            grid-template-columns: repeat(2, 40vw);
            gap: 2vw;
            justify-content: center;
        }
        .button {
            width: 40vw;
            height: 10vw;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3vw;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s;
        }
        .button:nth-child(1) {
            background-color: #8E44AD; /* Purple */
        }
        .button:nth-child(2) {
            background-color: #3498DB; /* Blue */
        }
        .button:nth-child(3) {
            background-color: #FFEB3B; /* Yellow */
        }
        .button:nth-child(4) {
            background-color: #E67E22; /* Orange */
        }
        .button.correct {
            background-color: #2ECC71; /* Green for correct */
        }
        .button.wrong {
            background-color: #E74C3C; /* Red for wrong */
        }
        .button:hover {
            opacity: 0.8;
        }
        .score {
            margin-top: 4vh;
            font-size: 3vw;
        }
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 2px solid #333;
            border-radius: 10px;
            padding: 3vw;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            z-index: 1000;
        }
        #popup h2 {
            margin-top: 0;
            font-size: 4vw;
        }
        #popup button {
            background-color: #33ccff;
            color: white;
            border: none;
            padding: 2vw 3vw;
            cursor: pointer;
            border-radius: 5px;
            margin: 2vw;
            font-size: 3vw;
        }
        #popup button:hover {
            background-color: #0099cc;
        }
        #startButton {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 30px 60px; /* Increased padding for larger button */
            font-size: 3vw; /* Increased font size */
            cursor: pointer;
            border-radius: 10px;
            margin-top: 20vh;
        }
        #startButton:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="images/silent.png" alt="Silent Logo">
        <h1>Silent Language Quiz</h1>
        <button class="btn-home" onclick="goHome()">Back to Home</button>
    </div>

    <button id="startButton" onclick="startQuiz()">Start Quiz</button>

    <div class="container" id="quizContainer">
        <div class="question" id="question">Identify the letter for this sign</div>
        <div class="buttons">
            <div class="button" onclick="checkAnswer(this, 'A')">A</div>
            <div class="button" onclick="checkAnswer(this, 'B')">B</div>
            <div class="button" onclick="checkAnswer(this, 'C')">C</div>
            <div class="button" onclick="checkAnswer(this, 'D')">D</div>
        </div>
        <div class="score">
            Score: <span id="score">0</span>
        </div>
    </div>

    <div id="popup">
        <h2>Quiz Completed!</h2>
        <p>Score: <span id="finalScore"></span></p>
        <p>Total Correct: <span id="totalCorrect"></span></p>
        <p>Total Wrong: <span id="totalWrong"></span></p>
        <p>Time Taken: <span id="timeTaken"></span></p>
        <button onclick="restartQuiz()">Restart</button>
        <button onclick="goHome()">Home</button>
    </div>

    <audio id="backgroundMusic" src="sounds/sounds/background.mp3" autoplay loop></audio>
    <audio id="correctSound" src="sounds/sounds/correct.mp3"></audio>
    <audio id="wrongSound" src="sounds/sounds/wrong.mp3"></audio>

    <script>
        let score = 0;
        let currentQuestion = 0;
        let totalCorrect = 0;
        let totalWrong = 0;
        let startTime = new Date(); // Record the start time

        const backgroundMusic = document.getElementById('backgroundMusic');
        backgroundMusic.volume = 0.05; // Set background music volume to a lower level

        const correctSound = document.getElementById('correctSound');
        correctSound.volume = 0.5;
        const wrongSound = document.getElementById('wrongSound');
        wrongSound.volume = 0.5;

        const questions = [
            { question: 'Identify the letter for this sign', correctAnswer: 'A', options: ['A', 'B', 'C', 'D'], image: 'images/2.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'B', options: ['A', 'B', 'C', 'D'], image: 'images/3.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'C', options: ['A', 'B', 'C', 'D'], image: 'images/4.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'D', options: ['A', 'B', 'C', 'D'], image: 'images/5.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'E', options: ['A', 'B', 'C', 'E'], image: 'images/6.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'G', options: ['A', 'G', 'C', 'D'], image: 'images/8.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'H', options: ['H', 'B', 'C', 'D'], image: 'images/9.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'K', options: ['A', 'B', 'K', 'D'], image: 'images/12.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'Q', options: ['A', 'Q', 'C', 'D'], image: 'images/18.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'T', options: ['A', 'B', 'T', 'D'], image: 'images/21.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'W', options: ['A', 'W', 'C', 'D'], image: 'images/24.png' },
            { question: 'Identify the letter for this sign', correctAnswer: 'Y', options: ['A', 'B', 'C', 'Y'], image: 'images/26.png' },
        ];

        function startQuiz() {
            document.getElementById('startButton').style.display = 'none';
            document.getElementById('quizContainer').style.display = 'block';
            loadQuestion(currentQuestion);
        }

        function loadQuestion(index) {
            const questionElement = document.getElementById('question');
            const buttons = document.querySelectorAll('.button');
            const question = questions[index];

            questionElement.innerHTML = `<img src="${question.image}" alt="Sign" style="width:20vw;height:auto;"><br>${question.question}`;
            buttons.forEach((button, i) => {
                button.textContent = question.options[i];
                button.classList.remove('correct', 'wrong');
                button.onclick = () => checkAnswer(button, question.options[i]);
            });
        }

        function checkAnswer(element, answer) {
            if (answer === questions[currentQuestion].correctAnswer) {
                element.classList.add('correct');
                correctSound.play();
                score++;
                totalCorrect++;
            } else {
                element.classList.add('wrong');
                wrongSound.play();
                totalWrong++;
            }
            document.getElementById('score').textContent = score;
            disableButtons();
            setTimeout(nextQuestion, 1000); // Move to next question after 1 second
        }

        function disableButtons() {
            const buttons = document.querySelectorAll('.button');
            buttons.forEach(button => {
                button.onclick = null;
            });
        }

        function nextQuestion() {
            currentQuestion++;
            if (currentQuestion < questions.length) {
                loadQuestion(currentQuestion);
            } else {
                showPopup();
            }
        }

        function showPopup() {
            const endTime = new Date(); // Record the end time
            const timeTaken = Math.round((endTime - startTime) / 1000); // Calculate time taken in seconds

            // Send quiz results to the server using XMLHttpRequest
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'quiz.php', true); // Ensure the method is POST and URL is correct
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                } else {
                    console.error('Error:', xhr.statusText);
                }
            };
            xhr.send(`finalScore=${score}&totalCorrect=${totalCorrect}&totalWrong=${totalWrong}&timeTaken=${timeTaken}`);

            document.getElementById('finalScore').textContent = score;
            document.getElementById('totalCorrect').textContent = totalCorrect;
            document.getElementById('totalWrong').textContent = totalWrong;
            document.getElementById('timeTaken').textContent = timeTaken + ' seconds';
            document.getElementById('popup').style.display = 'block';
        }

        function restartQuiz() {
            currentQuestion = 0;
            score = 0;
            totalCorrect = 0;
            totalWrong = 0;
            startTime = new Date(); // Reset the start time
            loadQuestion(currentQuestion);
            document.getElementById('score').textContent = score;
            document.getElementById('popup').style.display = 'none';
        }

        function goHome() {
            window.location.href = 'home.html';
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Do nothing here as the quiz will start on button click
        });
    </script>
</body>
</html>
