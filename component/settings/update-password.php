<div class="tab-pane fade"
     id="pills-update-password"
     role="tabpanel"
     aria-labelledby="pills-update-password-tab">

    <h5 class="text-center">Change Your Password</h5>

    <form method="POST" id="form-settings-password"
          action="/updatePassword">

        <input type="hidden"
               name="CSRF_TOKEN"
               value="<?= getToken() ?>">

        <div class="form-group">
            <label for="old-password">Current Password</label>
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-key"></i>
                    </span>
                </div>
                <input class="form-control"
                       type="password"
                       name="old-password"
                       value=""
                       id="old-password"
                       placeholder="Current Password">
            </div>
        </div>

        <div class="form-group">
            <label for="new-password">New Password</label>
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-key"></i>
                    </span>
                </div>
                <input class="form-control"
                       type="password"
                       name="new-password"
                       value=""
                       id="new-password"
                       placeholder="New Password">
            </div>
        </div>

        <div class="form-group">
            <label for="confirm-new-password">Confirm New Password</label>
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-key"></i>
                    </span>
                </div>
                <input class="form-control"
                       type="password"
                       name="confirm-new-password"
                       value=""
                       id="confirm-new-password"
                       placeholder="Confirm New Password">
            </div>
        </div>

        <div class="text-center">
            <button type="submit"
                    id="btn-password"
                    class="btn btn-primary mt-3 btn-submit">
                Change Password
            </button>
        </div>

    </form>
</div>