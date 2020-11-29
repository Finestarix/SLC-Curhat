<?php

require_once(dirname(__FILE__) . '/../controller/core/CSRFController.php');
require_once(dirname(__FILE__) . '/../controller/core/userController.php');

$user = NULL;
if (isset($_SESSION['USER']))
    $user = getCurrentUser();

regenerateToken();

session_regenerate_id();

?>

<link rel="stylesheet" href="/assets/css/nav.css">

<nav class="navbar navbar-expand-lg sticky-top background-nav">

    <div class="container d-flex flex-row align-items-center justify-content-between">

        <div class="d-flex flex-row align-items-center justify-content-center">

            <a href="/">
                <img width="50"
                     src="/assets/images/logo.png"
                     alt="SLC-Curhat">
            </a>

            <div class="m-0 p-0 dropdown">
                <div class="pl-5 dropdown-toggle color-nav h6" style="cursor: pointer">
                    <b>Explore</b>
                </div>
                <div class="m-0 p-2 dropdown-menu" style="width: 180px">
                    <a href="/popular"
                       class="pt-2 pb-1 pl-3 pr-3 d-flex align-items-center no-underline dropdown-effect">
                        <i class="fa fa-fire h5 text-secondary"></i>
                        <div class="ml-3 text-secondary h6"><b>Popular</b></div>
                    </a>
                    <a href="/top"
                       class="pt-2 pb-1 pl-3 pr-3 d-flex align-items-center no-underline dropdown-effect">
                        <i class="fa fa-thumbs-up h5 text-success"></i>
                        <div class="ml-2 text-success h6"><b>Most Likes</b></div>
                    </a>
                    <a href="/worst"
                       class="pt-2 pb-1 pl-3 pr-3 d-flex align-items-center no-underline dropdown-effect">
                        <i class="fa fa-thumbs-down h5 text-danger"></i>
                        <div class="ml-2 text-danger h6"><b>The Worst</b></div>
                    </a>
                </div>

            </div>

            <a href="/hof"
               class="pl-5 no-underline color-nav h6">
                <b>Hall Of Fame</b>
            </a>

            <?php
            if (!isset($_SESSION['USER'])) {
                ?>
                <a class="pl-5 no-underline color-nav h6" style="cursor: pointer"
                   data-toggle="modal" data-target="#modalLoginForm">
                    <b>Login</b>
                </a>
                <?php
            }
            ?>

        </div>

        <div class="d-flex flex-row align-items-center justify-content-center">

            <div class="form-inline position-relative">

                <label>
                    <input style="width: 20em; border-radius: 20px"
                           class="form-control mr-3 glyphicon glyphicon-remove-circle"
                           placeholder="Search"
                           type="text">
                </label>

                <div style="cursor: pointer; right: 30px;"
                     class="fa fa-search position-absolute color-nav-2"
                     id="search-button"
                     aria-hidden="true"></div>

            </div>

        </div>

        <?php
        if (!isset($_SESSION['USER'])) {
            ?>
            <a href="/register"
               class="no-underline">
                <div class="btn btn-light color-secondary shadow rounded
                        d-flex flex-row align-content-center">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16"
                         class="bi bi-person-plus-fill" fill="#10385d">
                        <path fill-rule="evenodd"
                              d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0
                                    6zm7.5-3a.5.5 0 0 1.5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5
                                    a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    <div class="pl-2 color-nav-2"><b>Sign Up</b></div>
                </div>
            </a>
            <?php
        }
        ?>

        <?php
        if (isset($_SESSION['USER'])) {
            ?>
            <div class="d-flex flex-row align-items-center justify-content-center">

                <div style="font-size: 25px; cursor: pointer;"
                     class="mr-5 ">
                    <i class="fas fa-envelope color-nav message-icon"></i>
                </div>

                <div class="mr-5 dropdown color-nav position-relative">
                    <div class="dropdown-toggle" style="font-size: 25px; cursor: pointer">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="m-0 mt-1 p-2 dropdown-menu position-absolute" style="left: -60px">
                        <h6 class="text-center"><b>Hi, <?= $user->username ?></b></h6>
                        <div class="dropdown-divider"></div>
                        <a href="/profile?uname=<?= $user->username ?>"
                           class="d-flex flex-row align-items-center dropdown-item dropdown-effect">
                            <i class="fa fa-id-badge mr-3"></i>
                            <div>My Profile</div>
                        </a>
                        <a href="/my-secrets"
                           class="d-flex flex-row align-items-center dropdown-item dropdown-effect">
                            <i class="fa fa-envelope mr-3 no-underline dropdown-effect"></i>
                            <div>My Secrets</div>
                        </a>
                        <a href="/settings"
                           class="d-flex flex-row align-items-center dropdown-item dropdown-effect">
                            <i class="fa fa-cog mr-3 no-underline dropdown-effect"></i>
                            <div>Settings</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/logout"
                           class="d-flex flex-row align-items-center dropdown-item dropdown-effect">
                            <i class="fa fa-sign-out-alt mr-3 no-underline dropdown-effect"></i>
                            <div>Logout</div>
                        </a>
                    </div>

                </div>

                <a class="no-underline"
                   data-toggle="modal" data-target="#modalSecretForm">
                    <div class="btn btn-light color-secondary shadow rounded
                        d-flex flex-row align-content-center">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16"
                             class="bi bi-plus-circle-fill" fill="#10385d">
                            <path fill-rule="evenodd"
                                  d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0
                                        0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                        <div class="pl-2 color-nav-2"><b>Add Secret</b></div>
                    </div>
                </a>
            </div>
            <?php
        }
        ?>

    </div>
</nav>

<?php if ($user == NULL) include('login.php') ?>

<?php if ($user != NULL) include('secret.php') ?>

<?php include('snackbar.php') ?>

<script>
    function showError() {
        const snackbar = document.getElementById("snackbar");
        snackbar.className = "show";
        setTimeout(function () {
            snackbar.className = snackbar.className.replace("show", "");
        }, 3000);
    }
</script>

<?php

if (isset($_SESSION['ERROR']) || isset($_SESSION['SUCCESS'])) {
    echo '<script>showError()</script>';

    if (isset($_SESSION['ERROR']))
        unset($_SESSION['ERROR']);
    else
        unset($_SESSION['SUCCESS']);
}
?>
