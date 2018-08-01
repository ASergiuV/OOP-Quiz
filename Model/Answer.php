<?php

namespace Model;

/**
 *
 */
class Answer
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
     * @var int
     */
    private $score;


    /**
     * @param int $id
     * @param string $answerText
     * @param int $score
     */
    public function __construct(int $id, string $answerText, int $score)
    {
        $this->id    = $id;
        $this->text  = $answerText;
        $this->score = $score;
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
    public
    function setText(
        string $text
    ) : void {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public
    function getScore() : int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public
    function setScore(
        int $score
    ) : void {
        $this->score = $score;
    }

    /**
     * @return int
     */
    public
    function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public
    function setId(
        int $id
    ) : void {
        $this->id = $id;
    }

}
