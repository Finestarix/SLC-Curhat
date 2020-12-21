<?php
require_once(dirname(__FILE__) . '/../util/timeHelper.php');

$users = getAllUser();

?>
<div class="background-content color-content" style="min-height: 100vh">
    <div class="container pt-lg-md">
        <div class="row">
            <?php
            while ($user = $users->fetch_object()) {
                $user->username = preg_replace('#&lt;(/?(?:pre|b|em|u|ul|li|ol|strong|s|p|br))&gt;#', '<\1>',
                    htmlspecialchars($user->username, ENT_QUOTES));

                $userJoinDate = strtotime($user->created_at);
                $userParseDate = date("d M, Y");
                ?>
                <div class="col-md-6 col-lg-4 mt-5 mb-5">
                    <div class="card card-profile">
                        <div class="card-header d-flex align-items-center justify-content-center">
                            <img src="/assets/images/avatar/<?= $user->image_path ?>" width="180px">
                        </div>
                        <div class="card-body pt-0">
                            <div class="text-center">
                                <h5 class="h5 mt-3">
                                    <a href="/profile?uname=<?= $user->username ?>"><?= $user->username ?></a>
                                </h5>
                                <div class="font-weight-300">
                                    <?php if (strcmp($user->gender, "Male") === 0) { ?>
                                        <div>
                                            <i class="fa fa-mars pr-1"></i><?= $user->gender ?>
                                        </div>
                                    <?php } else { ?>
                                        <div>
                                            <i class="fa fa-venus pr-1"></i><?= $user->gender ?>
                                        </div>
                                    <?php } ?>
                                    <div class="small mt-1 mb-3">
                                        <i class="fa fa-calendar pr-1"></i>Joined <?= $userParseDate ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div class="d-flex flex-column text-center mx-2">
                                    <div><b>+<?= $user->point ?></b></div>
                                    <div>Points</div>
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
</div>
