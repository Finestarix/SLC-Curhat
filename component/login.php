<div class="modal fade show"
     id="modalLoginForm"
     tabindex="-1"
     role="dialog"
     aria-labelledby="modalLoginForm"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal"
         role="document">

        <div class="modal-content">

            <div class="modal-body p-0">
                <div class="card bg-light border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-5">

                        <div class="text-center h4">
                            <div class="h5">Login</div>
                        </div>

                        <div class="dropdown-divider my-3"></div>

                        <form role="form"
                              method="post"
                              action="/loginController">

                            <input type="hidden"
                                   name="CSRF_TOKEN"
                                   value="<?= getToken() ?>">

                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                    <input class="form-control"
                                           name="identity"
                                           id="identity"
                                           placeholder="Username / Email"
                                           type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <input class="form-control"
                                           name="password"
                                           id="password"
                                           placeholder="Password"
                                           type="password">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                        class="btn btn-primary mt-3">
                                    Sign in
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>