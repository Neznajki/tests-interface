<?php

require_once __DIR__ . "/stdinc.php";
$main = new Main();
$answer = new Answer();
$question = new Question($answer);

if ($main->isLoginPage()) {
    $main->displayLogin();
}


if ($question->isQuestion()) {
    $question->displayQuestions();
}


if ($answer->isAnswer()) {
    $answer->save();
    $question->displayQuestions();
}
