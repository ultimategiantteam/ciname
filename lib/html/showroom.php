<?php
require_once './import.php';
var_dump($_REQUEST);
use Cinema\Cinema;

$show = Cinema::$shows->find($_REQUEST['id']);

$movie = $show->getMovie()->getName();
$room = $show->getRoom();
$time = $show->getTime();
$fsk = $show->getMovie()->getFsk();
$rows = $show->getRows();
$cols = $show->getColumns();
$abc = range('A', 'Z');
$numbers = range(0, 26);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kino</title>

    <script crossorigin="anonymous"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script crossorigin="anonymous"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script crossorigin="anonymous"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" rel="stylesheet">
</head>

<style>
    .container2 {
        position: relative;
        text-align: center;
        color: white;
    }
    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
<body class="bg-dark">
<? include './includes/_navbar.html'?>
<div class="text-center text-light">
<h1>Movie:<?= ' '. $movie; ?></h1>
<h2>Room:<?=' '. $room->getName(); ?></h2>
    <h2>Time:<?= ' '. $time; ?></h2>
</div>
    <div class="container2 text-dark">
    <img src="2000px-FSK_12.svg.png" alt="Snow" style="width: 7rem;">
        <h3 class="centered"><?= $fsk;?></h3>
</div>

<div class="container m-auto">
    <div class="row">
        <table class="text-center col-4 offset-4">
            <thead>
            <tr>
                <td class="">
                    <img src="Chair-iconinvisible.png" style="width: 2rem">
                </td>
                <?php for ($i = 0; $i < $cols; $i++): ?>
                    <td class=" text-light"><?= $i; ?></td>
                <?php endfor; ?>
                <td class="">
                    <img src="Chair-iconinvisible.png" style="width: 2rem">
                </td>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < $rows; $i++): ?>
                <tr>
                    <td class=" text-light text-right">
                        <?= $i; ?>
                    </td>
                    <?php for ($j = 0; $j < $cols; $j++): ?>
                        <?php if ($show->isSeatFree($i * $cols + $j) == true): ?>
                            <td class="">
                                <img src="Chair-iconfree.png" style="width: 2rem">
                            </td>
                        <? else: ?>
                            <td class="">
                                <img src="Chair-icon.png" style="width: 2rem">
                            </td>
                        <? endif ?>
                    <?php endfor; ?>
                    <td class=" text-light text-left">
                        <?= $i; ?>
                    </td>
                </tr>
            <?php endfor; ?>
            </tbody>
            <tr>
                <td class="">
                    <img src="Chair-iconinvisible.png" style="width: 2rem">
                </td>
                <?php for ($i = 0; $i < $cols; $i++): ?>
                    <td class="text-light"><?= $i; ?></td>
                <?php endfor; ?>
                <td class="">
                    <img src="Chair-iconinvisible.png" style="width: 2rem">
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>