<?php
require_once './import.php';
use Cinema\Cinema;
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
<body class="bg-dark">
<header>
    <div class="container-fluid bg-black text-center border border-secondary">
        <div class="row">
            <div class="col-1 p-0 text-secondary border-right border-secondary">
                <img alt="..." class="img-fluid" src="./kitag.png"/>
            </div>
            <div class="col-3 p-0 pt-3 text-secondary border-right border-secondary">
                <a class="py-3 px-5 bg-dark text-white text-decoration-none" href="index.php">
                    Movies
                </a>
            </div>
            <div class="col-3 p-0 py-3 text-secondary border-right border-secondary">
                <a class="py-3 px-5 bg-dark text-white text-decoration-none" href="rooms.php">
                    Rooms
                </a>
            </div>
            <div class="col-3 p-0 pt-3 text-secondary border-right border-secondary">
                <a class="py-3 px-5 bg-dark text-white text-decoration-none" href="shows.php">
                    Shows
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-success">
        <div class="py-3">
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <?php foreach (Cinema::$shows as $show): ?>
            <div class="col-3 py-2">
                <div class="card" style="width: 13rem; height:10rem">
                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                    <div class="card-body">
                        <h5 class="card-title"><?= $show->getMovie()->getName(); ?></h5>
                        <h6 class="card-title"><?= $show->getRoom()->getName(); ?></h6>
                        <h6 class="card-title"><?= $show->getTime(); ?></h6>
                        <a class="btn btn-primary" href="showroom.php?id=<?= $show->getId();?>" >Buchen</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>