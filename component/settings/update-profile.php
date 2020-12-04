<?php
    $userBirthdate = $user->birthdate;
    $userBirthdate = explode("-", $userBirthdate);
?>

<div class="tab-pane fade show active" id="pills-update-profile"
     role="tabpanel" aria-labelledby="pills-update-profile-tab">

    <h5 class="text-center">Update Your Profile</h5>

    <form id="form-settings-profile"
          method="POST"
          action="/updateProfile">

        <input type="hidden"
               name="CSRF_TOKEN"
               value="<?= getToken() ?>">

        <div class="form-group">
            <label for="username">Username</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input class="form-control"
                       type="text"
                       name="username"
                       value="<?= $user->username ?>"
                       id="username"
                       placeholder="Username"
                       disabled>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                <input class="form-control"
                       type="text"
                       name="email"
                       value="<?= $user->email ?>"
                       id="email"
                       placeholder="Email Address"
                       disabled>
            </div>
        </div>

        <div class="form-group focused">
            <label for="gender">Gender</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-venus-mars"></i>
                    </span>
                </div>
                <select name="gender" class="form-control">
                    <option value="male"
                        <?php if (strcasecmp($user->gender, "male") == 0) echo "selected" ?>
                    >Male</option>
                    <option value="female"
                        <?php if (strcasecmp($user->gender, "female") == 0) echo "selected" ?>
                    >Female</option>
                </select>
            </div>
        </div>

        <div class="form-group focused">
            <label for="campus">Campus</label>
            <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-award"></i>
                    </span>
                </div>
                <select name="campus" class="form-control">
                    <option value="kemanggisan"
                        <?php if (strcasecmp($user->location, "kemanggisan") == 0) echo "selected" ?>
                    >Kemanggisan</option>
                    <option value="alsut"
                        <?php if (strcasecmp($user->location, "alam sutera") == 0) echo "selected" ?>
                    >Alam Sutera</option>
                    <option value="bekasi"
                        <?php if (strcasecmp($user->location, "bekasi") == 0) echo "selected" ?>
                    >Bekasi</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="birthdate">Birthdate</label>
            <div class="input-group row">
                <div class="input-group-append col-sm-4 mr-0 pr-0">
                    <select name="birthdate-day"
                            class="form-control">
                        <?php
                        foreach (range(1, 31) as $date) {
                            echo "<option value=" . $date;
                            if (((int)$userBirthdate[2]) === $date)
                                echo " selected";
                            echo ">" . $date . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group-append col-sm-4 mr-0 pr-0">
                    <select name="birthdate-month"
                            class="form-control">
                        <?php
                        $month_list = ['January', 'February', 'March', 'April',
                            'May', 'June', 'July', 'August',
                            'September', 'October', 'November', 'December'];
                        foreach (range(1, 12) as $month) {
                            echo "<option value=" . $month;
                            if (((int)$userBirthdate[1]) === $month)
                                echo " selected";
                            echo ">" . $month_list[$month - 1] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group-append col-sm-4 mr-0 pr-0">
                    <select name="birthdate-year"
                            class="form-control">
                        <?php
                        foreach (range(2004, 1985) as $date) {
                            echo "<option value=" . $date;
                            if (((int)$userBirthdate[0]) === $date)
                                echo " selected";
                            echo ">" . $date . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="g-recaptcha mt-3"
             data-sitekey="6LeBneUZAAAAAGHT1XUyOW_om6CxcF4rQeb2DEeZ">
        </div>

        <div class="text-center">
            <button type="submit"
                    id="btn-profile"
                    class="btn btn-primary mt-3 btn-submit">
                Update Profile
            </button>
        </div>

    </form>
</div>
