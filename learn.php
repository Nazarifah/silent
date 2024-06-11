<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">  
    <link rel="stylesheet" href="style1.css">

    <title>Learn Sign Alphabets</title>
</head>
<body>
<style>
    /* Add your CSS modifications here */
    #goToTopBtn {
        position: fixed;
        top: 20px; /* Adjust the distance from top */
        left: 20px; /* Adjust the distance from left */
        z-index: 99;
        cursor: pointer;
        background-color: orange; /* Change button background color */
        color: white; /* Change button text color */
        padding: 10px 20px; /* Adjust button padding */
        border: none;
        border-radius: 5px;
    }
</style>

<button id="goToTopBtn" onclick="window.location.href = 'home.html';">Back</button>

<div class="container" id="entireSectionOuter">
    <h1>Learn Sign Alphabets</h1>
    <div class="row">
        <div class="col-8">
            <div class="searchSection">
                <input type="text" onkeyup="changeImg(this.value)" placeholder="Search.." class="form-control mb-3">
            </div>
            <div class="alphabetOuter">
                <ul>
                    <li onclick="changeImg('a')">A</li>
                    <li onclick="changeImg('b')">B</li>
                    <li onclick="changeImg('c')">C</li>
                    <li onclick="changeImg('d')">D</li>
                    <li onclick="changeImg('e')">E</li>
                    <li onclick="changeImg('f')">F</li>
                    <li onclick="changeImg('g')">G</li>
                    <li onclick="changeImg('h')">H</li>
                    <li onclick="changeImg('i')">I</li>
                    <li onclick="changeImg('j')">J</li>
                    <li onclick="changeImg('k')">K</li>
                    <li onclick="changeImg('l')">L</li>
                    <li onclick="changeImg('m')">M</li>
                    <li onclick="changeImg('n')">N</li>
                    <li onclick="changeImg('o')">O</li>
                    <li onclick="changeImg('p')">P</li>
                    <li onclick="changeImg('q')">Q</li>
                    <li onclick="changeImg('r')">R</li>
                    <li onclick="changeImg('s')">S</li>
                    <li onclick="changeImg('t')">T</li>
                    <li onclick="changeImg('u')">U</li>
                    <li onclick="changeImg('v')">V</li>
                    <li onclick="changeImg('w')">W</li>
                    <li onclick="changeImg('x')">X</li>
                    <li onclick="changeImg('y')">Y</li>
                    <li onclick="changeImg('z')">Z</li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <div class="resultSection">
                <img src="images/default.jpg" id="output" alt="">
            </div>
        </div>
    </div>
</div>

<audio id="alphabetSound"></audio>

<script>
    function changeImg(x) {
        let txt = x.toLowerCase();
        let imgPath = "images/" + txt + ".jpg"; // Assuming your image filenames follow the pattern letter.jpg
        let soundPath = "sounds/sounds/" + txt + "-sound.mpeg"; // Assuming your sound filenames follow the pattern letter-sound.mpeg
        let img = document.querySelector("#output");
        let sound = document.querySelector("#alphabetSound");

        img.onerror = function() {
            img.src = "images/default.jpg"; // Default image if requested image not found
        };
        img.src = imgPath;

        sound.onerror = function() {
            console.log("Error loading sound: " + soundPath); // Log error
            sound.src = ""; // Stop any sound if the requested sound file is not found
        };
        sound.src = soundPath;
        sound.play().catch(error => {
            console.log("Error playing sound: ", error); // Log error if there's an issue playing the sound
        });
    }
</script>
</body>
</html>
