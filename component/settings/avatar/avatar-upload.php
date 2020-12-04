<div class="tab-pane fade" id="avatar-upload">

    <form method="POST" id="form-settings-avatar-upload"
          action="/updateAvatar"
          enctype="multipart/form-data">

        <input type="hidden"
               name="CSRF_TOKEN"
               value="<?= getToken() ?>">

        <div class="text-center text-center">
            <img src="/assets/images/avatar/<?= $user->image_path ?>"
                 id="avatar-display"
                 width="250px"
                 height="250px">

            <div><b id="avatar-info"
                    class="mt-2"></b></div>
            <div>
                <span class="btn btn-round btn-file mt-2">
                    <span class="btn btn-info"
                          id="btn-change-avatar">
                        <i class="fas fa-edit"></i>
                        Change
                    </span>

                    <input type="file"
                           style="display: none"
                           id="avatar"
                           name="avatar">
                </span>
            </div>
            <small>Maximum 2MB</small>
        </div>

        <div class="text-center">
            <button class="btn btn-primary my-4 btn-submit">Upload Avatar
            </button>
        </div>

    </form>

</div>

<script>
    $('#btn-change-avatar').click((e) => {
        e.preventDefault();
        const avatarFileUpload = document.getElementById('avatar');
        avatarFileUpload.click();
    });

    $('#avatar').change((evt) => {
        const avatarInfo = document.getElementById('avatar-info');
        avatarInfo.innerHTML = $('input[type=file]').val().split('\\').pop();

        const targetEvent = evt.target || window.event.srcElement;
        const targetFile = targetEvent.files;
        if (FileReader && targetFile && targetFile.length) {
            const fileReader = new FileReader();
            fileReader.onload = () => document.getElementById('avatar-display').src = fileReader.result;
            fileReader.readAsDataURL(targetFile[0]);
        }
    });
</script>