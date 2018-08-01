<?php

namespace Model;

/**
 *
 */
class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $email;
    /**
     * @var int
     */
    private $score;

    /**
     * @param int $id
     * @param string $email
     */
    public function __construct(int $id, string $email)
    {
        $this->id    = $id;
        $this->email = $email;
        $this->score = 0;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email) : void
    {
        $this->email = $email;
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
     * @return int
     */
    public function getScore() : int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore(int $score) : void
    {
        $this->score = $score;
    }

    public function increaseScore(int $getScore)
    {
        $this->score += $getScore;
    }


}
