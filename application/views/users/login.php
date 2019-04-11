

<?php echo form_open('login'); ?>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mb-5 ml-5">Sign in</h2>
                    <p class="text-center mb-5 ml-5"><?= validation_errors(); ?></p>
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                        <div class="col-md-6">
                          <input type="text" name="username" id="username" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-6">
                          <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
