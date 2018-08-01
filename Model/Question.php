<?php

namespace Model;

use Model\Answer;

/**
 *
 */
class Question
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var Answer[]
     */
    private $answers;

    /**
     * @param int $id
     * @param string $text
     * @param array $answers
     */
    public function __construct(int $id, string $text, array $answers)
    {
        $this->id      = $id;
        $this->text    = $text;
        $this->answers = $answers;
    }

    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text) : void
    {
        $this->text = $text;
    }

    /**
     * @return Answer[]
     */
    public function getAnswers() : array
    {
        return $this->answers;
    }

    /**
     * @param Answer[] $answers
     */
    public function setAnswers(array $answers) : void
    {
        $this->answers = $answers;
    }

    public function addAnswer(Answer $answer)
    {
        $this->answers[] = $answer;
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

}
