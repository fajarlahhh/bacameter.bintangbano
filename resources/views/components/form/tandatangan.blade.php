<div>
  <table class="width-full f-s-14">
    <tr>
      @foreach ($data as $index => $row)
        <td class="text-center">
          @if ($data->count() == $index + 1)
            {{ config('constants.alamat') . ', ' . date('d F Y', strtotime($data->created_at)) }}
          @else
            &nbsp;
          @endif
          <br>
          {{ $row->alias ?: $row->pegawai->jabatan . ' ' . $row->pegawai->bidang }}
          <br><br><br><br>
          <u>{{ $row->pegawai->nama }}</u>
          <br>
        </td>
      @endforeach
    </tr>
  </table>
</div>
