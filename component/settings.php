<div class="background-content">

    <div class="container pt-lg-md">

        <div class="row justify-content-center">

            <div class="col-lg-6 my-5">

                <div class="title mb-3">
                    <h4 class="h4 mb-4 color-content">Settings</h4>
                </div>

                <div class="nav-wrapper">

                    <ul class="nav nav-pills nav-fill mb-3"
                        role="tablist">

                        <li class="nav-item mr-2">
                            <a class="nav-link btn btn-light active" id="pills-update-profile-tab" role="tab"
                               data-toggle="pill" href="#pills-update-profile"
                               aria-controls="pills-home" aria-selected="true">
                                <i class="fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn btn-light" id="pills-profile-tab" role="tab"
                               data-toggle="pill" href="#pills-update-avatar"
                               aria-controls="pills-profile" aria-selected="false">
                                <i class="fa fa-cloud-upload"></i>
                                Avatar
                            </a>
                        </li>

                        <li class="nav-item ml-2">
                            <a class="nav-link btn btn-light" id="pills-contact-tab" role="tab"
                               data-toggle="pill" href="#pills-update-password"
                               aria-controls="pills-contact" aria-selected="false">
                                <i class="fa fa-key"></i>
                                Password
                            </a>
                        </li>

                    </ul>

                </div>

                <div class="card shadow bg-light">
                    <div class="card-body">
                        <div class="tab-content">
                            <?php include('settings/update-profile.php') ?>
                            <?php include('settings/update-avatar.php') ?>
                            <?php include('settings/update-password.php') ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
