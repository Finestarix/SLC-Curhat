<div class="section section-lg background-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="mt-5 mb-5 card bg-light shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5 color-secondary">

                        <div class="mb-2 text-center h4">
                            Sign up
                        </div>

                        <form method="POST" action="/registerController">

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
                                           value=""
                                           id="username"
                                           placeholder="Username">
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
                                           value=""
                                           id="email"
                                           placeholder="Email Address">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <input class="form-control"
                                           type="password"
                                           name="password"
                                           value=""
                                           id="password"
                                           placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <input class="form-control"
                                           type="password"
                                           name="confirm-password"
                                           value=""
                                           id="confirm-password"
                                           placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <div class="input-group row">
                                    <div class="input-group-append col-sm-4 mr-0 pr-0">
                                        <select name="birthdate-day"
                                                class="form-control">
                                            <option value="0" selected="selected">Day</option>
                                            <?php
                                            foreach (range(1, 31) as $date)
                                                echo "<option value=" . $date . ">" . $date . "</option>"
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-group-append col-sm-4 mr-0 pr-0">
                                        <select name="birthdate-month"
                                                class="form-control">
                                            <option value="0" selected="selected">Month</option>
                                            <?php
                                            $month_list = ['January', 'February', 'March', 'April',
                                                'May', 'June', 'July', 'August',
                                                'September', 'October', 'November', 'December'];
                                            foreach (range(1, 12) as $month)
                                                echo "<option value=" . $month . ">" . $month_list[$month - 1] . "</option>"
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-group-append col-sm-4 mr-0 pr-0">
                                        <select name="birthdate-year"
                                                class="form-control">
                                            <option value="0" selected="selected">Year</option>
                                            <?php
                                            foreach (range(2004, 1985) as $date)
                                                echo "<option value=" . $date . ">" . $date . "</option>"
                                            ?>
                                        </select>
                                    </div>
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
                                        <option selected="selected">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
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
                                        <option selected="selected">Select Campus</option>
                                        <option value="kemanggisan">Kemanggisan</option>
                                        <option value="alsut">Alam Sutera</option>
                                        <option value="bekasi">Bekasi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="g-recaptcha mt-3"
                                 data-sitekey="6LeBneUZAAAAAGHT1XUyOW_om6CxcF4rQeb2DEeZ">
                            </div>

                            <div class="mt-3">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input"
                                           id="terms-condition"
                                           value=""
                                           name="terms-condition"
                                           type="checkbox">
                                    <label class="custom-control-label"
                                           for="terms-condition">
                                        I Agree with the Terms And Condition
                                    </label>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                        id="btn-register"
                                        class="btn btn-primary mt-3 btn-submit">
                                    Sign Up
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>