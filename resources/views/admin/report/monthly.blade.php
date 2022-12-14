@extends('admin.admin')
@section('content')

<div class="content-header row align-items-center m-0">

    <div class="col-sm-8 header-title p-0">
        <div class="media">

            <div class="media-body">
                <h1 class="font-weight-bold">Monthly Report</h1>
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
                            <th>Year</th>
                            <th>Month</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control" id="yearId" name="yearId">
                                    <option value="">--Select Year--</option>
                                    @foreach ($year as $yearitem)
                                    <option value="{{ $yearitem->year_name }}">
                                        {{ $yearitem->year_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="monthId" id="monthId">
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
    $(document).ready(function () {
    $("#yearId").on("change", function () {
        let year = $(this).children("option:selected").val();
        if (year > 0) {
            $.ajax({
                url: "{{ route('getMonth') }}",
                method: "GET",
                data: {
                    year: year,
                },
                success: function (response) {
                    console.log(response);
                    $("#monthId").html(response);
                },
            });
        } else {
            $("#monthId").html("");
        }
    });
});
$(document).ready(function () {
    $("#yearId").on("change", function () {
        $("#showData").html('');
    });
    $("#monthId").on("change", function () {
        let year = $("#yearId").val();
        let month = $("#monthId").val();
        $.ajax({
            url: "{{ route('getReportList') }}",
            method: "GET",
            data: {
                year: year,
                month: month,
            },
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (response) {
                $("#loader").hide();
                $("#showData").html(response);
            },
        });
    });
});


</script>
@endpush
@endsection