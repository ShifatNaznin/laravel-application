<div class="table-responsive">
    <table class="table display table-bordered table-striped table-hover multi-tables dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Asset</th>
                <th>Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
            $index = 1;
            $total =0;
            @endphp
            @forelse ($data as $item)
            <tr>
                <td>{{ $index }}</td>
                <td>{{date('F-j-Y', strtotime($item->date)) }}</td>
                <td>{{ $item->get_asset->assetName }}</td>
                <td>{{ $item->get_type->typeName }}</td>
                <td>{{ $item->amount }}</td>
                @php
                    $total = $total+$item->amount;
                @endphp
            </tr>
            @php
            $index++;
            @endphp
            @empty
            <td colspan="5" class="text-danger text-center">No Data Found!!</td>
            @endforelse
            <tr>
                <th colspan="4" class="text-center">Total</th>
                    <th>{{$total}}</th>
            </tr>
        </tbody>


    </table>
</div>