<?php $counter = 0; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>questions</title>
</head>
<body>
    <center>
    hello <?= $name; ?>

    questions:
        <br>
        <br>

        <form action="#" method="post">
            <input name="submitted" value="yes" type="hidden">
            <?php foreach ($questions as $index => $question) : ?>
                <label for="<?= $index ?>"><?= ++$counter ?>. <pre><?=$question;?></pre></label><br>
                <textarea id="<?= $index ?>" name="<?= $index ?>" rows="10" cols="50"><?= $answers[$index] ?? ''; ?> </textarea>
            <br>
            <?php endforeach; ?>

            <br>
            <br>
            <button type="submit">save answers</button>
        </form>
    </center>
</body>
</html>