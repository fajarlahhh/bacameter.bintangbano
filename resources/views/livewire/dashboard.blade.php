<div>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card card-widget widget-user shadow">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-info">
              <h3 class="widget-user-username">Hy, {{ auth()->user()->nama }}</h3>
              <h5 class="widget-user-desc">{{ auth()->user()->perusahaan }}</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle elevation-2" src="/dist/img/logo.png">
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ \App\Models\Pembaca::all()->count() }}</h5>
                    <span class="description-text">PEMBACA</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ \App\Models\BacaMeter::whereNull('tanggal_baca')->count() }}</h5>
                    <span class="description-text">BACA METER</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">{{ \App\Models\Tagihan::whereNull('tanggal_tagih')->count() }}</h5>
                    <span class="description-text">PENAGIHAN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
