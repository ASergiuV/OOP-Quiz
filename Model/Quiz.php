<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 30.07.2018
 * Time: 15:43
 */

namespace Model;


class Quiz
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $questions;

    /**
     * @var int
     */
    private $maxScore;

    /**
     * Quiz constructor.
     *
     * @param int $id
     * @param array $questions
     */
    public function __construct(int $id, array $questions)
    {
        $this->id        = $id;
        $this->questions = $questions;
        $maxScore        = 0;
        foreach ($questions as $question) {
            foreach ($question->getAnswers() as $answer) {
                $maxScore += $answer->getScore();
            }
        }
        $this->maxScore = $maxScore;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getQuestions() : array
    {
        return $this->questions;
    }

    /**
     * @param array $questions
     */
    public function setQuestions(array $questions) : void
    {
        $this->questions = $questions;
    }

    /**
     * @return int
     */
    public function getMaxScore() : int
    {
        return $this->maxScore;
    }

    /**
     * @param int $maxScore
     */
    public function setMaxScore(int $maxScore) : void
    {
        $this->maxScore = $maxScore;
    }


}
