<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?> - VeryCD Offline Web Service</title>

    <link rel="stylesheet" href="include/frameworks/css/bootstrap.min.css">
    <link rel="stylesheet" href="include/frameworks/css/fontawesome.css">

    <link rel="stylesheet" href="include/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">
            <a class="navbar-brand" href="index.php">
                VeryCD Offline Web Service
            </a>
            <button class="navbar-toggler" type="button"
                    data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
                    <input class="form-control mr-sm-2" name="keyword" type="search" aria-label="Keyword"
                           placeholder="Enter keyword here">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">
                        <span class="fas fa-search"></span> Search
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <main class="container body-content center-block">
