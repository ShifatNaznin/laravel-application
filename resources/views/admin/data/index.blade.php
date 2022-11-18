@extends('admin.admin')
@section('content')
<div class="content-header row align-items-center m-0">
    <div class="col-sm-8 header-title p-0">
        @include('flash::message')
        <div class="media">

            <div class="media-body">
                <h1 class="font-weight-bold">List of Data</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-4 text-right p-0">
        <a href="{{ route('createData') }}" class="btn btn-success mb-2 mr-1">
            <i class="typcn typcn-plus mr-2"></i>Add Data</a>
    </div>
</div>

<div class="body-content">

    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 font-weight-600 mb-0">Data</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table display table-bordered table-striped table-hover multi-tables dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Asset</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $index = 1;
                        @endphp
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{date('F-j-Y', strtotime($item->date)) }}</td>
                            <td>{{ $item->get_asset->assetName }}</td>
                            <td>{{ $item->get_type->typeName }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>
                                <a class="btn btn-success-soft btn-sm mr-1" href="{{ route('editData', $item->id) }}"
                                    title="Edit"><i class="far fa-edit"></i></a>
                                <a href="{{ route('deleteData', $item->id) }}"
                                    class="btn btn-danger-soft btn-sm deleteItem" title="Delete"><i
                                        class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @php
                        $index++;
                        @endphp
                        @endforeach

                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    $(document).ready(function() {
            $(document).on('click', '.deleteItem', function(event) {
                const url = $(this).attr('href');
                event.preventDefault();
                swal({
                        title: `Are you sure you want to delete this Item?`,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = url;
                        }
                    });
            });
        });
</script>
@endpush
@endsection