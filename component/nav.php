<?php
require_once(dirname(__FILE__) . '/../util/uriHelper.php');
checkURI(realpath(__FILE__));
?>

<nav class="navbar navbar-expand-lg sticky-top background-nav">

    <div class="container d-flex flex-row align-items-center justify-content-between">

        <div class="d-flex flex-row align-items-center justify-content-center">

            <a href="/">
                <img width="50"
                     src="/assets/images/logo.png"
                     alt="SLC-Curhat">
            </a>

            <div class="m-0 p-0 dropdown">
                <div class="pl-5 dropdown-toggle color-secondary h6">
                    Explore
                </div>
                <div class="m-0 p-0 dropdown-menu">
                    <a href="/popular"
                       class="pt-2 pb-1 pl-3 pr-3 d-flex align-items-center no-underline dropdown-effect">
                        <i class="fa fa-fire h4 text-secondary"></i>
                        <div class="ml-4 text-secondary h6">Popular</div>
                    </a>
                    <a href="/top"
                       class="pt-2 pb-1 pl-3 pr-3 d-flex align-items-center no-underline dropdown-effect">
                        <i class="fa fa-thumbs-up h4 text-success"></i>
                        <div class="ml-3 text-success h6">Most Likes</div>
                    </a>
                    <a href="/worst"
                       class="pt-2 pb-1 pl-3 pr-3 d-flex align-items-center no-underline dropdown-effect">
                        <i class="fa fa-thumbs-down h4 text-danger"></i>
                        <div class="ml-3 text-danger h6">The Worst</div>
                    </a>
                </div>

            </div>

            <a href="/hof"
               class="pl-5 no-underline color-secondary h6">
                Hall Of Fame
            </a>

            <a href=""
               class="pl-5 no-underline color-secondary h6"
               data-toggle="modal" data-target="#modalLoginForm">
                Login
            </a>

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
                     class="fa fa-search position-absolute color-secondary"
                     id="search-button"
                     aria-hidden="true"></div>

            </div>

        </div>

        <a href="/register"
           class="no-underline">
            <div class="btn btn-light color-secondary shadow rounded
                        d-flex flex-row align-content-center">
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16"
                     class="bi bi-person-plus-fill" fill="#1B2845">
                    <path fill-rule="evenodd"
                          d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0
                             6zm7.5-3a.5.5 0 0 1.5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5
                             a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                <div class="pl-2 color-secondary">Sign Up</div>
            </div>
        </a>

    </div>

</nav>

<div class="modal fade show"
     id="modalLoginForm"
     tabindex="-1"
     role="dialog"
     aria-labelledby="modalLoginForm"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal"
         role="document">

        <div class="modal-content">

            <div class="modal-body p-0">
                <div class="card bg-light border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-5">

                        <div class="text-center mb-4">
                            <div class="h5">Login</div>
                        </div>

                        <form role="form"
                              method="post"
                              action="/controller/loginController.php">

                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                    <input class="form-control"
                                           name="identity"
                                           id="identity"
                                           placeholder="Username / Email"
                                           type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <input class="form-control"
                                           name="password"
                                           id="password"
                                           placeholder="Password"
                                           type="password">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                        class="btn btn-primary my-4">
                                    Sign in
                                </button>
                            </div>

                        </form>

                        <p class="text-center mb-0">
                            <a href="/register">Sign Up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .no-underline {
        text-decoration: none !important;
    }

    .dropdown:hover > .dropdown-menu {
        display: block;
    }

    .dropdown-effect:hover {
        background-color: #1B2845;
        text-decoration: none;
    }

    a {
        text-decoration: none !important;
    }

    .dropdown-toggle:hover,
    a:hover,
    .dropdown-effect:hover > i,
    .dropdown-effect:hover > div {
        color: white !important;
    }
</style>