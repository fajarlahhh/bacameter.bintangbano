<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Target Penagihan <small>Import</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Target Penagihan</a></li>
                        <li class="breadcrumb-item active">Import</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <x-notif.alert />
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form wire:submit.prevent="submit">
                                <div class="form-group">
                                    <label for="">File Excel</label>
                                    <input type="file" class="form-control" wire:model="file" required
                                        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                </div>
                                <a href="/dist/datapenagihan.xlsx" class="btn btn-primary">Download
                                    Template</a>&nbsp;
                                <input type="submit" value="Submit" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
