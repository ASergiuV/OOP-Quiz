<?php

namespace Repository;

use Model\User;
use Model\Question;
use Model\Quiz;
use Model\Answer;

class Repository implements IRepository
{
    /**
     * @var User
     */
    protected $user;
    /**
     * @var Question[]
     */
    protected $questions;
    /**
     * @var Answer[]
     */
    protected $answers;
    /**
     * @var Quiz
     */
    protected $quiz;

    /**
     * @param User $user
     * @param Quiz $quiz
     */
    public function __construct(User $user, Quiz $quiz)
    {
        $this->questions = $quiz->getQuestions();
        $this->user      = $user;
        $this->answers   = $this->initAnswers();
        $this->quiz      = $quiz;
    }

    /**
     *
     */
    private function initAnswers() : array
    {
        foreach ($this->questions as $question) {
            $this->answers[$question->getId()] = $question->getAnswers();
        }

        return $this->answers;
    }

    public function getAnswersTextByQuestionID(int $questionID) : array
    {
        $answersText = [];
        foreach ($this->answers[$questionID] as $answer) {
            $answersText[$answer->getId()] = $answer->getText();
        }

        return $answersText;
    }

    public function getAnswersByQuestionID(int $questionID) : array
    {
        return $this->answers[$questionID];
    }

    /**
     * @return Question[]
     */
    public function getQuestions() : array
    {
        return $this->questions;
    }

    /**
     * @return User
     */
    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user) : void
    {
        $this->user = $user;
    }

    /**
     * @return Quiz
     */
    public function getQuiz() : Quiz
    {
        return $this->quiz;
    }


}
