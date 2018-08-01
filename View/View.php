<?php

namespace View;

use Controller\Controller;
use Model\Quiz;
use Model\User;

/**
 *
 */
class View
{
    /**
     * @var Controller
     */
    private $controller;


    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->controller = $controller;
    }


    public function takeQuiz()
    {
        echo "Welcome!" . PHP_EOL;
        echo "By entering your email you agree to GDPR regulations and to our Terms Of Service" . PHP_EOL;
        echo "Terms Of Service: after entering our database you remain there. THE END" . PHP_EOL;
        echo "Please input an email: ";
        $userEmail = readline();
        $user      = new User(1, $userEmail);

        $this->controller->setUser($user);

        echo "You have been registered!" . PHP_EOL;
        echo "Please choose a Quiz :" . PHP_EOL;
        echo "1. General knowledge quiz" . PHP_EOL;
        echo "Your input: ";
        $userQuizChoice = readline();

        if ($userQuizChoice !== 1 && 1 === 2) {//failsafe if user picks other than quiz 1 , validation must be done for scaling
            $this->controller->chooseQuiz($userQuizChoice);
        }

        $questions = $this->controller->getQuestions();
        if (empty($questions)) {
            echo "It looks like we misplaced the questions, please come back at another time!" . PHP_EOL;
            die;
        }
        echo "The quiz will start now!" . PHP_EOL;


        foreach ($questions as $question) {
            echo $question->getText() . PHP_EOL;
            $inputAnswer = readline();
            $repoAnswer  = $this->controller->getAnswerByTextAndQuestionID($inputAnswer, $question->getId());
            if (!$repoAnswer) {
                echo "Wrong answer!" . PHP_EOL;
                continue;
            }
            if ($this->controller->checkQuestionAnswer($question, $repoAnswer)) {
                echo "Good answer!" . PHP_EOL;
                $user->increaseScore($repoAnswer->getScore());
            }
        }
        echo "Quiz has ended!" . PHP_EOL;
        $this->controller->updateUserScore($user);
        echo "Output your score to the screen or do you want it mailed? 1 - screen; 2 - email" . PHP_EOL;
        $userChoice = readline();
        if ($userChoice == 2) {
            mail($user->getEmail(), strtoupper('Your Score for the Amazing Quiz you just took'),
                'Score: ' . $user->getScore() . "\n We wish you a happy evening!\n Bye!");
        } else {
            echo "Your score is {$user->getScore()} !" . PHP_EOL;
        }
    }

}
