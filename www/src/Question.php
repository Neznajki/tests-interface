<?php


class Question
{
    const FOLDER = '/tmp/questions';
    /** @var Answer */
    private $answer;

    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function isQuestion(): bool
    {
        return empty($_POST[Answer::ANSWER_INDEX]) && $_GET['name'];
    }

    public function displayQuestions(): void
    {
        $questions = [];
        $answers = [];
        $counter = 0;

        $files = scandir(self::FOLDER);
        foreach($files as $file) {
            $fileContents = $this->getFileContents(self::FOLDER . '/' . $file);
            if (empty($fileContents)) {
                continue;
            }

            $index = ++$counter . '_' . $this->createIndex($fileContents);

            $questions[$index] = $fileContents;
            $answer = $this->answer->getAnswer($index);
            if ($answer) {
                $answers[$index] = $answer;
            }
        }

        display('questions', ['name' => $_GET['name'], 'questions' => $questions, 'answers' => $answers]);
    }

    protected function getFileContents(string $file): string
    {
        return file_get_contents($file);
    }

    protected function createIndex(string $fileContents): string
    {
        return rtrim(
            preg_replace('/\\..*$/', '',
                preg_replace('/[^a-zA-Z_]/', '',
                    preg_replace('/\s/', '_', $fileContents)
                )
            )
            ,
            "_ \t\n\r "
        );
    }
}