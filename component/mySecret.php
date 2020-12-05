<?php
$userBirthdate = $user->birthdate;
$currentTime = date("Y-m-d H:i:s");
$currentTime = date("Y-m-d H:i:s", time() + 60 * 60 * 6);
$differentUserBirthdate = abs(strtotime($currentTime) - strtotime($userBirthdate));
$differentUserYearBirthdate = floor($differentUserBirthdate / (365 * 60 * 60 * 24));
?>

<section class="color-content background-content"
         style="min-height: 100vh">

    <div class="container d-flex">
        <div class="col px-0 mt-5">
            <span class="h4">
                <i class="fa fa-retweet" aria-hidden="true"></i>
                Your Shared Secrets
            </span>
        </div>
    </div>

    <div class="container">
        <div class="row row-grid">

            <?php
            require_once('controller/core/secretController.php');
            $userSecrets = getMySecret();

            while ($userSecret = $userSecrets->fetch_object()) {
                $secretTime = $userSecret->created_at;
                $differentSecretCreated = abs(strtotime($currentTime) - strtotime($secretTime));

                $differentSecretYearCreated = floor($differentSecretCreated / (365 * 60 * 60 * 24));
                $differentValue = $differentSecretYearCreated;
                $differentDescription = "year(s)";

                if ($differentValue == 0) {
                    $differentSecretMonthCreated = floor(($differentSecretCreated -
                            $differentSecretYearCreated * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $differentValue = $differentSecretMonthCreated;
                    $differentDescription = "month(s)";

                    if ($differentValue == 0) {
                        $differentSecretDayCreated = floor(($differentSecretCreated -
                                $differentSecretYearCreated * 365 * 60 * 60 * 24 -
                                $differentSecretMonthCreated * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                        $differentValue = $differentSecretDayCreated;
                        $differentDescription = "days(s)";

                        if ($differentValue == 0) {
                            $differentSecretHourCreated = floor(($differentSecretCreated -
                                    $differentSecretYearCreated * 365 * 60 * 60 * 24 -
                                    $differentSecretMonthCreated * 30 * 60 * 60 * 24 -
                                    $differentSecretDayCreated * 60 * 60 * 24) / (60 * 60));
                            $differentValue = $differentSecretHourCreated;
                            $differentDescription = "hour(s)";

                            if ($differentValue == 0) {
                                $differentSecretMinutesCreated = floor(($differentSecretCreated -
                                        $differentSecretYearCreated * 365 * 60 * 60 * 24 -
                                        $differentSecretMonthCreated * 30 * 60 * 60 * 24 -
                                        $differentSecretDayCreated * 60 * 60 * 24 -
                                        $differentSecretHourCreated * 60 * 60) / 60);
                                $differentValue = $differentSecretMinutesCreated;
                                $differentDescription = "minute(s)";

                                if ($differentValue == 0) {
                                    $differentSecretSecondCreated = floor($differentSecretCreated -
                                        $differentSecretYearCreated * 365 * 60 * 60 * 24 -
                                        $differentSecretMonthCreated * 30 * 60 * 60 * 24 -
                                        $differentSecretDayCreated * 60 * 60 * 24 -
                                        $differentSecretHourCreated * 60 * 60 -
                                        $differentSecretMinutesCreated * 60);
                                    $differentValue = $differentSecretSecondCreated;
                                    $differentDescription = "second(s)";
                                }
                            }
                        }
                    }
                }

                $secretContent = explode(' ', $userSecret->content);
                if (count($secretContent) > 20) {
                    $secretContent = array_splice($secretContent, 0, 19);
                    $secretContent[20] = "...";
                }
                $secretContentShow = implode(" ", $secretContent);
                ?>

                <div class="col-lg-4 py-4">
                    <div class="card border-0 h-100">
                        <div class="card-body d-flex flex-column">

                            <div class="row">
                                <div class="col-10">
                                    <h5 class="text-uppercase <?= (strcmp($user->gender, "Male") == 0) ?
                                        "text-primary" : "text-danger" ?>">
                                        <i class="fa <?= (strcmp($user->gender, "Male") == 0) ?
                                            "fa-male" : "fa-female" ?>" aria-hidden="true"></i>
                                        <?= $user->gender ?>, <?= $differentUserYearBirthdate ?>
                                    </h5>
                                </div>
                            </div>

                            <div>
                                <small class="text-muted">
                                    <?= $differentValue ?> <?= $differentDescription ?> ago
                                </small>
                            </div>

                            <p class="description mt-2"><?= $secretContentShow ?></p>

                            <div class="mt-2">
                                <div class="btn-group btn-block">
                                    <button style="cursor:pointer;"
                                            class="btn <?= (strcmp($user->gender, "Male") == 0) ?
                                                "btn-primary" : "btn-danger" ?> btn-block mt-4">
                                        <span>
                                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                        </span>
                                        <span>
                                            <!--TODO: Change Total Like -->
                                            <span>5</span>
                                        </span>
                                    </button>
                                    <button style="cursor:pointer;"
                                            class="btn <?= (strcmp($user->gender, "Male") == 0) ?
                                                "btn-primary" : "btn-danger" ?> btn-block mt-4">
                                        <span>
                                            <i class="fa fa-thumbs-down"></i>
                                        </span>
                                        <span>
                                            <!--TODO: Change Total Dislike -->
                                            <span>1</span>
                                        </span>
                                    </button>
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