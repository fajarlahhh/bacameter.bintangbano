<div>
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <img src="/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8; width:30%">
        <br>
        <a href="/" class="h2"><b>HA</b>BIT</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form wire:submit.prevent="submit">
          <div class="input-group mb-3">
            <input type="text" class="form-control" autocomplete="off" wire:model.defer="uid" placeholder="UID" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control " wire:model.defer="kataSandi" placeholder="Kata Sandi" />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" wire:model.defer="remember" />
                <label for="remember">
                  Ingat Saya
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
          <hr>
          <div class="text-center">
            <small><strong>Copyright &copy; 2022</strong>
              All rights reserved.</small>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <br>
  <x-notif.info />
  <x-notif.alert />
</div>
