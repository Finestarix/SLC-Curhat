<div class="tab-pane fade" id="pills-update-avatar"
     role="tabpanel" aria-labelledby="pills-update-avatar-tab">

    <h5 class="text-center">Update Your Avatar</h5>

    <div class="nav-wrapper">

        <ul class="nav nav-pills nav-fill"
            id="tabs-icons-text" role="tablist">

            <li class="nav-item">
                <div class="nav-link active" style="cursor: pointer;"
                     id="pills-icons-text-1" data-toggle="tab"
                     href="#avatar-choose" role="tab" aria-selected="true">
                    <i class="fa fa-user mr-2"></i>
                    Choose Avatar
                </div>
            </li>

            <li class="nav-item">
                <div class="nav-link" style="cursor: pointer;"
                     id="tabs-pills-text-2" data-toggle="tab"
                     href="#avatar-upload" role="tab" aria-selected="false">
                    <i class="fa fa-cloud-upload mr-2"></i>
                    Upload Avatar
                </div>
            </li>

        </ul>

    </div>

    <div class="card card-plain bg-transparent border-0 mt-4">
        <div class="tab-content tab-space">
            <?php include('avatar/avatar-choose.php') ?>
            <?php include('avatar/avatar-upload.php') ?>
        </div>
    </div>
</div>
