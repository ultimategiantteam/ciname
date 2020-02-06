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
        <?php


        require_once './import.php';


        use Cinema\Collection;
        use Cinema\Movie;
        $movies = Collection::load($movies, Movie::class);
        foreach ($movies as $movie) {
            ?>
            <div class="col-3 py-2 d-flex justify-content-center">
                <div class="card" style="width: 13rem;">
                    <img class="card-img-top m-3" src="../save/Saved Movies/<?= $movie->getId() . '.jpg'?>" style="width: 11rem;" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $movie->getName();?></h5>
                    </div>
                </div>
            </div>
            <?php
        }

        ?>
    </div>
</div>


</body>
</html>