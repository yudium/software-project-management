<div class="card">
    <div class="table-responsive">
        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
            <thead>
            <tr>
                <th>Pembayaran ke-</th>
                <th>Tanggal Tenggat</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th class="text-center">Pilih</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($project->termin->details as $termin_detail)
            @if ($termin_detail->paid_amount == $termin_detail->amount)
                @continue
            @endif
            <tr>
                <td class="text-center">#{{ $termin_detail->serial_number }}</td>
                <td>{{ $termin_detail->due_date }}</td>
                <td><b>Rp.@money($termin_detail->amount)</b></td>
                <td>
                    @if ($termin_detail->amount != $termin_detail->paid_amount)
                    Sisa <b>Rp.@money($termin_detail->amount - $termin_detail->paid_amount)</b>
                    @elseif ($termin_detail->paid_amount == 0)
                    <b>@money($termin_detail->amount)</b>
                    @endif
                </td>
                <td class="text-center">
                    <input class="termin-check" type="checkbox" name="termin_detail_id[]" value="{{ $termin_detail->id }}">
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
