const questions = [
    {
        question: "What letter is this sign?",
        answers: [
            { text: "A", correct: true },
            { text: "B", correct: false },
            { text: "C", correct: false },
            { text: "D", correct: false }
        ]
    },
    // Add more questions here
];

let currentQuestionIndex = 0;

const questionElement = document.getElementById('question');
const answerButtonsElement = document.querySelector('.button-container');
const nextButton = document.getElementById('next-btn');

function startQuiz() {
    currentQuestionIndex = 0;
    nextButton.classList.add('hide');
    showQuestion(questions[currentQuestionIndex]);
}

function showQuestion(question) {
    questionElement.innerText = question.question;
    answerButtonsElement.innerHTML = '';
    question.answers.forEach(answer => {
        const button = document.createElement('button');
        button.innerText = answer.text;
        button.classList.add('btn');
        button.addEventListener('click', () => selectAnswer(answer));
        answerButtonsElement.appendChild(button);
    });
}

function selectAnswer(answer) {
    if (answer.correct) {
        // Play correct answer sound
        new Audio('sounds/correct.mp3').play();
    } else {
        // Play wrong answer sound
        new Audio('sounds/wrong.mp3').play();
    }
    nextButton.classList.remove('hide');
}

nextButton.addEventListener('click', () => {
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        showQuestion(questions[currentQuestionIndex]);
        nextButton.classList.add('hide');
    } else {
        alert('You have completed the quiz!');
    }
});

startQuiz();
