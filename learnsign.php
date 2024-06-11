<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Learn Sign Language</title>
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="icon" href="images/silent.png" type="image/png">
  <style>
    :root {
      --scrollcolor: white;
      --scrollbackground: #141e27;
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      padding: 0;
      margin: 0;
      height: 100vh;
    }

    body {
      background: #203239;
      width: 100%;
      height: 100vh;
      background-image: url("images/home.jpg");
      background-size: cover;
      background-position: center;
    }

    .title {
      font-size: 1.5rem;
      font-family: system-ui;
      line-height: 1.1;
      font-weight: 300;
      color: #fff;
      margin: 0.5rem auto;
      width: 85%;
      max-width: 1000px;
    }

    h1 {
      font-size: 50px;
      text-align: center;
      margin: 0.5rem auto;
      color: #3498DB; /* Changed to green */
    }

    .slider {
      width: 85%;
      max-width: 1200px;
      margin: 0 auto;
    }

    .slider__content {
      overflow-x: scroll;
      scroll-snap-type: x mandatory;
      display: flex;
      gap: 1rem;
      padding-bottom: 1rem;
      scrollbar-color: var(--scrollcolor) var(--scrollbackground);
    }

    .slider__content::-webkit-scrollbar {
      height: 0.5rem;
      width: 0.5rem;
      border-radius: 1rem;
      background: var(--scrollbackground);
    }

    .slider__content::-webkit-scrollbar-thumb {
      border-radius: 1rem;
      background: var(--scrollcolor);
    }

    .slider__content::-webkit-scrollbar-track {
      border-radius: 1rem;
      background: var(--scrollbackground);
    }

    .slider__item {
      scroll-snap-align: start;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      min-width: 100%;
      width: 100%;
      height: calc(100vh - 150px);
      border-radius: 0.25rem;
      overflow: hidden;
      position: relative;
    }

    @media (min-width: 2000px) {
      .slider__item {
        min-width: calc((100% / 3) - 2rem);
      }
    }

    .slider__image {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: contain;
      position: absolute;
      top: 0;
      left: 0;
    }

    .slider__info {
      position: relative;
      padding: 1rem 2rem;
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 0.25rem;
      z-index: 1;
    }

    .slider__info h2 {
      color: #fff;
      font-family: system-ui;
      line-height: 1.1;
      font-weight: 300;
      font-size: 2rem;
      text-align: center;
      margin: 0;
    }

    .slider__nav {
      margin: 1rem 0 4rem;
      width: 100%;
      padding: 0;
      display: flex;
      justify-content: flex-start;
      gap: 1rem;
      align-content: center;
      align-items: center;
      pointer-events: none;
    }

    @media (min-width: 460px) {
      .slider__nav {
        justify-content: flex-end;
      }
    }

    .slider__nav__button {
      margin: 0;
      appearance: none;
      border: 0;
      border-radius: 2rem;
      background: black;
      color: white;
      padding: 0.5rem 1rem;
      font-size: 0.80rem;
      line-height: 1;
      pointer-events: auto;
      transition: 0.2s ease-out;
      opacity: 0.25;
    }

    .slider__nav__button--active {
      opacity: 1;
      pointer-events: auto;
      cursor: pointer;
    }

    .audio-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 13vh;
      width: 270px;
    }

    #audio {
      width: 150px;
      height: 40px;
    }

    .header a {
      float: left;
      color: black;
      text-align: center;
      padding: 12px;
      text-decoration: none;
      font-size: 18px;
      line-height: 25px;
      border-radius: 4px;
    }

    .header a.active {
      background-color: dodgerblue;
      color: white;
    }

    .header-right {
      float: right;
    }

    .text1 {
      background-color: #5F9EA0;
    }

    .text2 {
      background-color: #9E4638;
    }

    .text3 {
      background-color: #D4AF37;
    }

    .text4 {
      background-color: #8B8000;
    }

    .text5 {
      background-color: #F88017;
    }

    .text6 {
      background-color: #5F9EA0;
    }

    .text7 {
      background-color: #B041FF;
    }

    .text8 {
      background-color: #9E4638;
    }

    .text9 {
      background-color: #CB6D51;
    }

    .text10 {
      background-color: #CD5C5C;
    }

    .text11 {
      background-color: #FBB917;
    }

    .text12 {
      background-color: #F08080;
    }

    .text13 {
      background-color: #EE9A4D;
    }

    .back-home {
      display: block;
      position: absolute;
      top: 20px;
      left: 20px;
      padding: 0.5rem 1rem;
      background-color: orange;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 4px;
      font-size: 18px;
      z-index: 10;
    }
  </style>
</head>

<body>
  <a href="home.html" class="back-home">Back to Home</a>
  <h1>Learn Sign Language</h1>
  <div class="slider" x-data="{start: true, end: false}" style="padding-top: 150px;">
    <div class="slider__content" x-ref="slider" x-on:scroll.debounce="$refs.slider.scrollLeft == 0 ? start = true : start = false; Math.abs(($refs.slider.scrollWidth - $refs.slider.offsetWidth) - $refs.slider.scrollLeft) < 5 ? end = true : end = false;">
      
      <div class="slider__item">
        <div class="audio-container">
          <img class="slider__image" src="images/2.gif" alt="Please">
          <audio controls>
            <source src="audio/please.mp3" type="audio/mpeg">
          </audio>
          <div class="slider__info">
            <h2 class="text1">Please</h2>
          </div>
        </div>
      </div>
      
      <div class="slider__item">
        <div class="audio-container">
          <img class="slider__image" src="images/3.gif" alt="Thank You">
          <audio controls>
            <source src="audio/thankyou.mp3" type="audio/mpeg">
          </audio>
          <div class="slider__info">
            <h2 class="text2">Thank You</h2>
          </div>
        </div>
      </div>
      
      
      <div class="slider__item">
        <div class="audio-container">
          <img class="slider__image" src="images/5.gif" alt="Hello">
          <audio controls>
            <source src="audio/hello.mp3" type="audio/mpeg">
          </audio>
          <div class="slider__info">
            <h2 class="text4">Hello</h2>
          </div>
        </div>
      </div>
      
      <div class="slider__item">
        <div class="audio-container">
          <img class="slider__image" src="images/6.gif" alt="Goodbye">
          <audio controls>
            <source src="audio/goodbye.mp3" type="audio/mpeg">
          </audio>
          <div class="slider__info">
            <h2 class="text5">Goodbye</h2>
          </div>
        </div>
      </div>
      
       <div class="slider__item">
        <div class="audio-container">
          <img class="slider__image" src="images/8.gif" alt="I Love You">
          <audio controls>
            <source src="audio/iloveyou.mp3" type="audio/mpeg">
          </audio>
          <div class="slider__info">
            <h2 class="text7">I Love You</h2>
          </div>
        </div>
      </div>
      
      <div class="slider__item">
        <div class="audio-container">
          <img class="slider__image" src="images/9.gif" alt="Sorry">
          <audio controls>
            <source src="audio/sorry.mp3" type="audio/mpeg">
          </audio>
          <div class="slider__info">
            <h2 class="text8">Sorry</h2>
          </div>
        </div>
      </div>
      
      <div class="slider__item">
        <div class="audio-container">
          <img class="slider__image" src="images/10.gif" alt="Yes">
          <audio controls>
            <source src="audio/yes.mp3" type="audio/mpeg">
          </audio>
          <div class="slider__info">
            <h2 class="text9">Yes</h2>
          </div>
        </div>
      </div>
      
      <div class="slider__item">
        <div class="audio-container">
          <img class="slider__image" src="images/11.gif" alt="No">
          <audio controls>
            <source src="audio/no.mp3" type="audio/mpeg">
          </audio>
          <div class="slider__info">
            <h2 class="text10">No</h2>
          </div>
        </div>
      </div>
      
      <div class="slider__item">
        <div class="audio-container">
          <img class="slider__image" src="images/12.gif" alt="Delighted">
          <audio controls>
            <source src="audio/delighted.mp3" type="audio/mpeg">
          </audio>
          <div class="slider__info">
            <h2 class="text11">Delighted</h2>
          </div>
        </div>
      </div>
      
      <div class="slider__item">
        <div class="audio-container">
          <img class="slider__image" src="images/13.gif" alt="Help">
          <audio controls>
            <source src="audio/help.mp3" type="audio/mpeg">
          </audio>
          <div class="slider__info">
            <h2 class="text12">Help</h2>
          </div>
        </div>
      </div>
      
    </div>
    <div class="slider__nav" style="display: flex; justify-content: center;">
      <button class="slider__nav__button" x-on:click="$refs.slider.scrollBy({left: $refs.slider.offsetWidth * -1, behavior: 'smooth'});" x-bind:class="start ? '' : 'slider__nav__button--active'">Previous</button>
      <button class="slider__nav__button" x-on:click="$refs.slider.scrollBy({left: $refs.slider.offsetWidth, behavior: 'smooth'});" x-bind:class="end ? '' : 'slider__nav__button--active'">Next</button>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.2/cdn.js"></script>
</body>

</html>
