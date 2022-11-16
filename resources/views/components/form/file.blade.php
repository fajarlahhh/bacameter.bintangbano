<div>
  @if ($dataFile)
    <div id="accordion" class="accordion">
      @if ($dataFile->file->where('jenis', '!=', 'pdf')->count() > 0)
        <!-- begin card -->
        <div class="card bg-dark text-white">
          <div class="card-header bg-dark-darker pointer-cursor d-flex align-items-center collapsed"
            data-toggle="collapse" data-target="#collapseThree">
            <i class="fa fa-circle fa-fw text-teal mr-2 f-s-8"></i> File Gambar
          </div>
          <div id="collapseThree" class="collapse show" data-parent="#accordion">
            <div class="card-body">
              <div class="row row-space-10">
                @foreach ($dataFile->file->where('jenis', '!=', 'pdf') as $row)
                  <div class="col-xs-6 col-sm-3 text-center">
                    @if (in_array($row->getKey(), $fileDihapus))
                      <a href="#" class="widget-card widget-card-rounded square m-b-5">
                        <div class="widget-card-cover">
                          <div class="d-flex h-100 align-items-center justify-content-center">
                            <div class="text-center">
                              <div class="text-white f-s-14"><b>FILE DIHAPUS</b></div>
                            </div>
                          </div>
                        </div>
                      </a>
                      <button class="btn text-white btn-warning" type="button"
                        wire:click="batalHapusFile({{ $row->getKey() }})">Batal Hapus</button>
                    @else
                      <a href="{{ config('constants.storage_link') . $row->file }}" target="_blank"
                        class="widget-card widget-card-rounded square m-b-5">
                        <div class="widget-card-cover"
                          style="background-image: url({{ config('constants.storage_link') . $row->file }})">
                        </div>
                      </a>
                      @if ($fileDihapus)
                        <button class="btn text-white btn-danger" type="button"
                          wire:click="hapusFile({{ $row->getKey() }})">Hapus</button>
                      @endif
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <!-- end card -->
      @endif
      @if ($dataFile->file->where('jenis', 'pdf')->count() > 0)
        <!-- begin card -->
        <div class="card bg-dark text-white">
          <div class="card-header bg-dark-darker pointer-cursor d-flex align-items-center collapsed"
            data-toggle="collapse" data-target="#collapseTwo">
            <i class="fa fa-circle fa-fw text-indigo mr-2 f-s-8"></i> File PDF
          </div>
          <div id="collapseTwo" class="collapse show" data-parent="#accordion">
            <div class="card-body p-0 text-center">
              @foreach ($dataFile->file->where('jenis', 'pdf') as $row)
                @if (in_array($row->getKey(), $fileDihapus))
                  <button class="btn text-white btn-warning" type="button"
                    wire:click="batalHapusFile({{ $row->getKey() }})">Batal
                    Hapus</button>
                @else
                  <embed src="{{ config('constants.storage_link') . $row->file }}" class="width-full height-600"
                    type="application/pdf">
                  @if ($fileDihapus)
                    <button class="btn text-white btn-danger" type="button"
                      wire:click="hapusFile({{ $row->getKey() }})">Hapus</button>
                  @endif
                @endif
                <br>
              @endforeach
            </div>
          </div>
        </div>
        <!-- end card -->
      @endif
    </div>
  @endif
</div>
