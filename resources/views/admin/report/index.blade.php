@extends('admin.admin')
@section('content')

<div class="content-header row align-items-center m-0">

    <div class="col-sm-8 header-title p-0">
        <div class="media">

            <div class="media-body">
                <h1 class="font-weight-bold">Type Report</h1>
            </div>
        </div>
    </div>
</div>

<div class="body-content">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-row">
                <table class="table table-master display table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control" id="typeId" name="typeId">
                                    <option value="">--Select--</option>
                                    @foreach ($type as $typeData)
                                    <option value="{{ $typeData->id }}">
                                        {{ $typeData->typeName }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <img src="#" style="height: 100px;" alt="">
        </div>
    </div>
    <div class="card mb-4" id="showData">

    </div>
</div>
@push('js')
<script>
    $(document).ready(function() {
                $('#typeId').on('change', function() {
                    let typeId = $(this).children("option:selected").val();
                    $.ajax({
                        url: "{{ route('getReportList') }}",
                        method: 'GET',
                        data: {
                            typeId: typeId,
                        },
                        success: function(response) {
                            $('#showData').html(response);
                        },

                    });
                });
            });
</script>
@endpush
@endsection