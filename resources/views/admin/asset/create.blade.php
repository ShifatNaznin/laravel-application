@extends('admin.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-8 col-md-8 col-xl-10">
        @include('flash::message')

        <div class="body-content">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Add Asset</h6>
                        </div>
                        <div class="col-sm-4 text-right p-0">
                            <a href="{{ route('assetList') }}" class="btn btn-success mb-2 mr-1">
                                <i class="typcn typcn-arrow-back-outline mr-2"></i>Back</a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('storeAsset') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="font-weight-600">Asset Name</label>
                            <input type="text" name="assetName" class="form-control" placeholder="Enter Asset Name"
                                required value="{{ old('assetName') }}" required>
                            @if ($errors->has('assetName'))
                            <div class="invalid-feedback">
                                {{ 'This field is required' }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success mr-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection