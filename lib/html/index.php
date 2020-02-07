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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    <a class="navbar-brand d-inline" href="index.php""><img class="img-fluid" src="kitag.png" alt=".."></a>
                    <button class="navbar-toggler align-top" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse ml-4" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Movies <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shows.php">Shows</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid bg-success mb-2">
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
            <div class="col-auto col-lg-3">
                <div class="card mx-auto text-center mb-4" style="width:100%;">
                    <img src="../save/Saved Movies/<?= $movie->getId() . '.jpg' ?>" class="card-img-top" alt="...">
                    <div class="card-body" style="height: 4rem">
                        <p class="card-title d-block font-weight-bold"><?= $movie->getName(); ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Fsk:<?= $movie->getFsk(); ?></li>
                    </ul>
                    <div class="card-body">
                        <h5 class="card-link">Duration: <?= $movie->getDuration(); ?></h5>
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