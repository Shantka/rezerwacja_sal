<?php use Components\Auth; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= ($title ?? '(no title)'); ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/">System Rezerwacji Sal</a>

    <div class="collapse navbar-collapse show">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav">
            <?php if (Auth::userIsAuthenticated()) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/profile"><?= Auth::getUser()->getUsername() ?></a>
                </li>
                <?php if (Auth::getUser()->getIsAdmin()) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/adminpanel">Panel administratora</a>
                    </li>
                <?php } ?>                
                <li class="nav-item">
                    <a class="nav-link" href="/calendar">Kalendarz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/rezerwacje">Rezerwacje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/rooms">Sale</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Wyloguj</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>

<main class="container">
    <?php if (isset($content)) {
        echo $content;
    } else {
        echo (new \Components\Template('home'))->render();
    } ?>
</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>