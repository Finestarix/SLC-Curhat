<link rel="stylesheet" href="/assets/css/avatar-choose.css">

<div class="tab-pane show active" id="avatar-choose">

    <form method="POST" id="form-settings-avatar-post"
          action="/updateAvatar">

        <input type="hidden"
               name="CSRF_TOKEN"
               value="<?= getToken() ?>">

        <div class="cc-selector d-flex flex-row justify-content-between flex-wrap">
            <?php
            foreach (range(1, 60) as $number) {
                ?>
                <input class="m-0" id="avatar_<?= $number ?>" type="radio" name="avatar_user" value="<?= $number ?>">
                <label class="drinkcard-cc" for="avatar_<?= $number ?>"
                       style="background-image:url(/assets/images/avatar/avatar_<?= $number ?>.png);"></label>
                <?php
            }
            ?>
        </div>

        <div class="text-center">
            <button type="submit"
                    id="btn-register"
                    class="btn btn-primary mt-3 btn-submit">
                Update Profile
            </button>
        </div>
    </form>
</div>

<script>
    let userAvatar = "<?= $user->image_path ?>";
    userAvatar = userAvatar.split('.')[0];
    const selectedAvatar = document.getElementById(userAvatar);
    selectedAvatar.checked = true;
</script>