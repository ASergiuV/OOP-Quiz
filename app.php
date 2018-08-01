#! /usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 30.07.2018
 * Time: 14:45
 */

require_once("autoloader.php");

use View\View as View;
use Controller\Controller as Controller;
use Repository\DBRepository as DBRepository;


$repo = new DBRepository(1);
$ctrl = new Controller($repo);
$view = new View($ctrl);

$view->takeQuiz();



