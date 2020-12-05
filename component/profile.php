<?php
$username = $_GET['uname'];
$currentUser = getUserByUsername($username);

if (!$currentUser) {
    $_SESSION['ERROR'] = 'Invalid username';
    die();
}

$userJoinDate = strtotime($currentUser->created_at);
$userParseDate = date("d M, Y");
?>

<div class="background-content"
     style="padding-top: 100px; height: 90vh">

    <div class="container">

        <div class="card card-profile shadow m-4 p-4">

            <div class="row justify-content-between align-items-center position-relative">

                <div class="card-profile-stats d-flex justify-content-center"
                     style="width: 250px">
                    <!-- TODO: Get Total Stories -->
                    <div class="d-flex flex-column text-center mx-2">
                        <div><b>0</b></div>
                        <div>Stories</div>
                    </div>

                    <!-- TODO: Get Total Comments -->
                    <div class="d-flex flex-column text-center mx-2">
                        <div><b>0</b></div>
                        <div>Comments</div>
                    </div>

                    <!-- TODO: Get Total Points -->
                    <div class="d-flex flex-column text-center mx-2">
                        <div><b>+<?= $currentUser->point ?></b></div>
                        <div>Points</div>
                    </div>
                </div>

                <div class="position-absolute" style="top: -120px; left: 50%; margin-left: -90px; width: inherit;">
                    <div class="d-flex align-items-center">
                        <img src="/assets/images/avatar/<?= $currentUser->image_path ?>" width="180px">
                    </div>
                </div>

                <?php
                if (strcmp($user->username, $username) == 0) {
                    ?>
                    <div style="width: 250px">
                        <div class="float-right mr-3">
                            <a href="/settings" style="color: white !important;"
                               class="btn btn-primary">Settings</a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="text-center mt-4">

                <h3><?= $currentUser->username ?></h3>

                <div class="h6 mt-2">
                    <?php
                    if ($currentUser->gender === "Male") {
                        ?>
                        <i class="fa fa-mars"></i> Male
                        <?php
                    } else if ($currentUser->gender === "Female") {
                        ?>
                        <i class="fa fa-venus"></i> Female
                        <?php
                    }
                    ?>
                </div>

                <div class="small mt-2" data-toggle="tooltip" data-placement="top" title=""
                     data-original-title="1 week ago"><i class="fa fa-calendar"></i> Joined <?= $userParseDate ?>
                </div>

                <?php
                if ($currentUser->verified == 1 && strcmp($user->username, $username) == 0) {
                    ?>
                    <div class="mt-3">
                        <img src="/assets/images/badge/verified.png" draggable="false"
                             data-toggle="tooltip" data-placement="top" title="" data-original-title="Verified Email">
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
