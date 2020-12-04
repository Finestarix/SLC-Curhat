<?php
$differentTime = abs(strtotime(date("Y-m-d")) - strtotime($user->birthdate));
$user->age = floor($differentTime / (365 * 60 * 60 * 24));
?>

<div class="modal fade show"
     id="modalSecretForm"
     tabindex="-1"
     role="dialog"
     aria-labelledby="modalSecretForm"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal"
         role="document">

        <div class="modal-content">

            <div class="modal-body p-0">
                <div class="card bg-light border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-5 color-content">

                        <div class="text-center h4">
                            What is your secret ?
                        </div>

                        <div class="dropdown-divider my-3"></div>

                        <form method="POST" action="/storeSecret">

                            <input type="hidden"
                                   name="CSRF_TOKEN"
                                   value="<?= getToken() ?>">

                            <div class="d-flex flex-row mb-3">
                                <input class="form-control mr-2"
                                       type="text"
                                       name="age"
                                       value="<?= $user->age ?>"
                                       id="age"
                                       disabled>
                                <input class="form-control ml-2"
                                       type="text"
                                       name="gender"
                                       value="<?= $user->gender ?>"
                                       id="gender"
                                       disabled>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control"
                                          type="text"
                                          name="secret"
                                          id="secret"
                                          placeholder="What is your secret ?"></textarea>
                            </div>

                            <div class="g-recaptcha mt-3"
                                 data-sitekey="6LeBneUZAAAAAGHT1XUyOW_om6CxcF4rQeb2DEeZ">
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                        id="btn-store"
                                        class="btn btn-primary mt-3 btn-store">
                                    Add
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
