<button type="button" class="btn btn-danger mb-2" id="printPdf">Print Pdf</button>
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
{{-- @push('js') --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#printPdf').click(function() {
            var assetId = $('#assetId').val();
            alert(assetId);
            $.ajax({
                type: 'GET',
                url: '/print-pdf',
                data: {
                    assetId: assetId,
                },
                // xhrFields: {
                //     responseType: 'blob'
                // },
                // beforeSend: function() {
                //     $('#loader').show();
                // },
        xhrFields: {
            responseType: 'blob'
        },
        success: function(response){
            var blob = new Blob([response]);
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = "Fisher-Id-Card-List.pdf";
            link.click();
        },
        error: function(blob){
        console.log(blob);
        }

                // success: function(response) {
                //     console.log(response);
                //     $('#loader').hide();
                //     var blob = new Blob([response]);
                //     var link = document.createElement('a');
                //     link.href = window.URL.createObjectURL(blob);
                //     link.download = "abc.pdf";
                //     link.click();
                // },
                // error: function(blob) {
                //     console.log(blob);
                // }
            });

        });
    });
</script>
{{-- @endpush --}}