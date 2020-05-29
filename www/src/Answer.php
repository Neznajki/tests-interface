<?php


class Answer
{
    const FOLDER = '/tmp/answers';
    const ANSWER_INDEX = 'submitted';

    public function isAnswer(): bool
    {
        return isset($_POST[self::ANSWER_INDEX]) && $_GET['name'];
    }

    public function getAnswer(string $index): ?string
    {
        $folder = $this->getFolder();
        if (! is_dir($folder)) {
            return null;
        }

        $file = $folder . '/' . $index;
        if (is_file($file)) {
            return file_get_contents($file);
        }

        return null;
    }

    public function save(): void
    {
        $folder = $this->getFolder();

        if (! is_dir($folder)) {
            mkdir($folder);
            chmod($folder, 0777);
        }

        foreach ($_POST as $index => $content) {
            if ($index === self::ANSWER_INDEX) {
                continue;
            }

            $file = $folder . '/' . $index;
            file_put_contents($file, $content);
            chmod($file, 0777);
        }
    }

    /**
     * @return string
     */
    protected function getName(): string
    {
        return preg_replace('/\\s/', '_', $_GET['name']);
    }

    /**
     * @return string
     */
    public function getFolder(): string
    {
        return self::FOLDER . '/' . $this->getName();
    }
}