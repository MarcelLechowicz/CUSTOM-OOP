<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
?>
<head>
    <!-- Meta tags and title -->
    <meta charset="UTF-8">
    <title>Milionerzy</title>
    <!-- Link to an external CSS file -->
    <link rel="stylesheet" type="text/css" href="styl.css">
</head>
<body>
    <!-- Header section with PHP logic for checking session login status -->
    <header>
      <?php
      if(isset($_SESSION['logon']) && $_SESSION['logon'] == True){
        echo '<h1>Hello, '.$_SESSION['login'].'</h1>'.'<br/><a href="logout.php">Wyloguj się</a>';
      }
      else{
        $_SESSION['error'] = "Proszę się zalogować!";
        header('Location: indexx.php');
        exit();
      }
      ?>
    </header>

  <div id="question"></div>
  <ul class="options" id="options"></ul>
  <div id="result"></div>

  <script>
    const questions = [
      // An array of objects representing quiz questions
      {
        question: "Jaka jest stolica Polski?",
        options: ["Warszawa", "Kraków", "Wrocław", "Gdańsk"],
        correctAnswer: "Warszawa"
      },
      {
        question: "Data bitwy pod Grunwaldem.",
        options: ["1623", "1918", "1939", "1410"],
        correctAnswer: "1410"
      },
      {
        question: "Tytuł naukowy Pana Jerzego Barglika.",
        options: ["Technik?", "Generał", "A ja nie wiem co bym dał", "Profesor"],
        correctAnswer: "Profesor"
      },
      {
        question: "ile wynosi przeciętny okres życia studenta na kierunku Informatyka przemysłowa",
        options: ["4 kolosy i 3 wejściówki", "aż do inżyniera", "aż przepije kase na mieszkanie/akademik na Mariackiej", "1 sesja góra 2"],
        correctAnswer: "1 sesja góra 2"
      },
      {
        question: "Wiecej niż jedno zwierzę to...?",
        options: ["stado", "trzoda", "lama", "Miałem kolegę Bartka z którym kiedyś po szkole pojechaliśmy na lody..."],
        correctAnswer: "lama"
      },
      {
        question: "Prawdopodbieństwo wygranej jednego losu na loterii lotto to 1 do...?",
        options: ["13 milionów", "nic dlatego nie gram", "Poważnych odpowiedzi nie było?", "50/50"],  //50/50 correct answer don't ask
        correctAnswer: "50/50"
      },
      {
        question: "rok wynosi",
        options: ["342 dni", "24 godziny", "365", "nie wiem"],
        correctAnswer: "365"
      },
      {
        question: "Rok powstania Politechniki Śląskiej?",
        options: ["1945", "Dinozaury tak długo nie żyją", "I właśnie wtedy poznałem waszą matkę...", "nie wiem i pewnie się nie dowiem"],
        correctAnswer: "1945"
      },
      {
        question: "Będzie zaliczone.",
        options: ["Odp 2", "Tak", "Odp 2", "Odp 2"],
        correctAnswer: "Tak"
      },
      {
        question: "Co znajduje się w godle Politechniki Śląskiej.",
        options: ["Orzeł", "Jastrząb", "Sokół", "Gołąb"],
        correctAnswer: "Orzeł"
      },

    ];

    let currentQuestionIndex = 0;
    let moneyWon = 0;

    
    function displayQuestion() {            // Function to display the current question
      const currentQuestion = questions[currentQuestionIndex];
      const questionElement = document.getElementById('question');
      const optionsElement = document.getElementById('options');
      const resultElement = document.getElementById('result');

      questionElement.textContent = currentQuestion.question;
      optionsElement.innerHTML = '';

      currentQuestion.options.forEach((option, index) => {
        const optionElement = document.createElement('li');
        optionElement.className = 'option';
        optionElement.textContent = `${index + 1}. ${option}`;
        optionElement.addEventListener('click', () => checkAnswer(index));
        optionsElement.appendChild(optionElement);
      });

      resultElement.textContent = '';
    }

    function checkAnswer(optionIndex) {             // Function to check the selected answer
      const currentQuestion = questions[currentQuestionIndex];

      if (currentQuestion.options[optionIndex] === currentQuestion.correctAnswer) {       // Implementation details
        moneyWon += 100000;
        document.getElementById('result').textContent = `Poprawna odpowiedź! Wygrałeś ${moneyWon} złotych.`;
      } else {
        document.getElementById('result').textContent = `Niestety, to nieprawidłowa odpowiedź. Koniec gry.`;
        return; // Koniec gry po błędnej odpowiedzi
      }

      currentQuestionIndex++;

      if (currentQuestionIndex === questions.length) {
        document.getElementById('result').textContent = `Gratulacje! Wygrałeś milion złotych!`;
      } else {
        displayQuestion(); // Initial display of the first question
      }
    }

    displayQuestion();
  </script>

</body>
</html>