<?php

namespace Controller;

use Model\Answer;
use Model\Question;
use Model\User;
use Repository\IRepository;
use Repository\DBRepository;


/**
 *
 */
class Controller
{
    /**
     * @var DBRepository
     */
    private $repository;

    /**
     * @param IRepository $repository
     */
    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Question $question
     * @param Answer $answer
     *
     * @return bool
     */
    public function checkQuestionAnswer(Question $question, Answer $answer) : bool
    {
        if (in_array($answer, $question->getAnswers())) {
            return true;
        }

        return false;
    }

    /**
     * @param string $text
     * @param int $questionID
     *
     * @return Answer
     */
    public function getAnswerByTextAndQuestionID(string $text, int $questionID) : Answer
    {
        /**
         * @var Answer[]
         */
        $answers = $this->repository->getAnswersTextByQuestionID($questionID);

        if (!in_array($text, $answers)) {
            return new Answer(00, '', 0);
        }

        $answers = $this->repository->getAnswersByQuestionID($questionID);
        foreach ($answers as $answer) {
            if ($answer->getText() === $text) {
                return $answer;
            }
        }

    }

    /**
     * @return array|Question[]
     */
    public function getQuestions()
    {
        return $this->repository->getQuestions();
    }

    public function setUser(User $u)
    {
        $this->repository->setUser($u);
    }

    public function updateUserScore(User $u)
    {
        $this->repository->updateUserScoreDB($u);
    }

    public function chooseQuiz(int $quizID)
    {
        $this->repository->setQuiz($quizID);
    }

    public function getMaxScore()
    {
        return $this->repository->getMaxScore();
    }

}
