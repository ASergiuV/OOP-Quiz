<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 01.08.2018
 * Time: 17:50
 */

namespace Repository;

use Model\Answer;
use Model\Question;
use Model\Quiz;
use Model\User;
use PDO;

const DSN = "mysql:host=localhost;port=3306;dbname=Quiz";

class DBRepository extends Repository
{
    private $pdo = null;
    private $username = 'sergiuabrudean';
    private $password = 'Internship';


    public function __construct(int $quizID)
    {
        $this->pdo = new PDO(DSN, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $this->initRepo($quizID);
    }

    /**
     * Loads db data into memory
     *
     * @param int $quizID
     */
    public function initRepo(int $quizID) : void
    {
        $this->questions = [];
        $this->quiz      = null;
        $this->answers   = [];
        $sql             = "SELECT * FROM QUESTION q 
                            INNER JOIN QUIZ_QUESTION qq 
                            ON q.id = qq.questionID
                            WHERE qq.quizID = {$this->pdo->quote($quizID)}";

        $stmt = $this->pdo->query($sql);

        foreach ($stmt->fetchAll() as $questionArray) {
            $answers    = [];
            $questionID = $questionArray['id'];
            $sql2       = "SELECT * FROM ANSWER a 
                            INNER JOIN QUESTION_ANSWER qa 
                            ON a.id = qa.answerID
                            WHERE qa.questionID = {$this->pdo->quote($questionID)}";

            $stmt2 = $this->pdo->query($sql2);

            foreach ($stmt2->fetchAll() as $answerArray) {
                $answers[] = new Answer($answerArray['id'], $answerArray['text'], $answerArray['score']);
            }
            $this->answers[$questionArray['id']] = $answers;

            $this->questions[] = new Question($questionArray['id'], $questionArray['text'], $answers);

        }

        $sql3       = "SELECT * FROM QUIZ 
                        WHERE id = {$this->pdo->quote($quizID)}";
        $stmt3      = $this->pdo->query($sql3);
        $fetched    = $stmt3->fetch();
        $this->quiz = new Quiz($fetched['id'], $this->questions);

    }

    /**
     * If quiz changes everything must be reloaded
     *
     * @param int $quizID
     */
    public function setQuiz(int $quizID) : void
    {
        $this->initRepo($quizID);
    }

    /**
     * @param User $user
     */
    public function setUser(User $user) : void
    {
        parent::setUser($user);
        $statement = "INSERT INTO USER(`email`) VALUES (:email)";
        $stmt      = $this->pdo->prepare($statement);

        $stmt->bindParam('email', $email);

        $email = $user->getEmail();
        $stmt->execute();
    }

    /**
     * @param User $user
     */
    public function updateUserScoreDB(User $user) : void
    {
        $score = $user->getScore();
        $sql   = "UPDATE USER SET `score` = ? WHERE `email` = ?";
        $stmt  = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $score, PDO::PARAM_INT);
        $stmt->bindValue(2, $user->getEmail(), PDO::PARAM_STR);
        $success = $stmt->execute();
    }
}
