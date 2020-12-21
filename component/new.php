<?php
require_once(dirname(__FILE__) . '/../util/timeHelper.php');
?>

<section class="color-content background-content"
         style="min-height: 100vh">

    <div class="container d-flex">
        <div class="col px-0">
            <div class="row justify-content-center">
                <div class="col-lg-4 align-self-center">
                    <div class="btn-group btn-block">
                        <a href="/" role="button"
                           class="btn btn-light btn-block mt-4">
                            <span><i class="fa fa-fire" aria-hidden="true"></i></span>
                            <span>Hot</span>
                        </a>
                        <a href="/new" role="button"
                           class="btn btn-light active btn-block mt-4">
                            <span><i class="fa fa-star" aria-hidden="true"></i></span>
                            <span>New</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row row-grid">

            <?php
            require_once('controller/core/secretController.php');
            $userSecrets = getNewSecret();

            while ($userSecret = $userSecrets->fetch_object()) {
                $secretTime = $userSecret->created_at;
                $showTime = getTotalTime($secretTime);

                $secretContent = preg_replace('#&lt;(/?(?:pre|b|em|u|ul|li|ol|strong|s|p|br))&gt;#', '<\1>',
                    htmlspecialchars($userSecret->content, ENT_QUOTES));

                $userBirthdate = $userSecret->userBirthdate;
                $currentTime = date("Y-m-d H:i:s", time() + 60 * 60 * 6);
                $differentUserBirthdate = abs(strtotime($currentTime) - strtotime($userBirthdate));
                $differentUserYearBirthdate = floor($differentUserBirthdate / (365 * 60 * 60 * 24));
                ?>
                <div class="col-lg-4 py-4">
                    <div class="card border-0 h-100">
                        <div class="card-body d-flex flex-column">

                            <div class="row">
                                <div class="col-10">
                                    <h5 class="text-uppercase <?= (strcmp($userSecret->userGender, "Male") == 0) ?
                                        "text-primary" : "text-danger" ?>">
                                        <i class="fa <?= (strcmp($userSecret->userGender, "Male") == 0) ?
                                            "fa-male" : "fa-female" ?>" aria-hidden="true"></i>
                                        <?= $userSecret->userGender ?>, <?= $differentUserYearBirthdate ?>
                                    </h5>
                                </div>
                            </div>

                            <div>
                                <small class="text-muted">
                                    <?= $showTime ?> ago
                                </small>
                            </div>

                            <p class="description mt-2" style="min-height: 150px"><?= $secretContent ?></p>

                            <div class="mt-2">
                                <div class="btn-group btn-block d-flex" style="flex: 1 1 0;">
                                    <form style="flex-basis: 100%; text-align: center;" class="pr-1"
                                          action="/likeController" method="POST">

                                        <input type="hidden"
                                               name="CSRF_TOKEN"
                                               value="<?= getToken() ?>">

                                        <input type="hidden" name="secretID" value="<?= $userSecret->id ?>">

                                        <button style="cursor:pointer;"
                                                class="btn <?= (strcmp($userSecret->userGender, "Male") == 0) ?
                                                    "btn-primary" : "btn-danger" ?> btn-block mt-4">
                                        <span>
                                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                        </span>
                                            <span>
                                            <span><?= ($userSecret->totalLike == NULL) ? 0 : $userSecret->totalLike ?></span>
                                        </span>
                                        </button>
                                    </form>

                                    <form style="flex-basis: 100%; text-align: center;" class="pl-1"
                                          action="/dislikeController" method="POST">

                                        <input type="hidden"
                                               name="CSRF_TOKEN"
                                               value="<?= getToken() ?>">

                                        <input type="hidden" name="secretID" value="<?= $userSecret->id ?>">

                                        <button style="cursor:pointer;"
                                                href="/likeController?id=<?= $userSecret->id ?>"
                                                class="btn <?= (strcmp($userSecret->userGender, "Male") == 0) ?
                                                    "btn-primary" : "btn-danger" ?> btn-block mt-4">
                                        <span>
                                            <i class="fa fa-thumbs-down"></i>
                                        </span>
                                            <span>
                                            <span><?= ($userSecret->totalDislike == NULL) ? 0 : $userSecret->totalDislike ?></span>
                                        </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>