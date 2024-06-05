@extends('admin.layouts.master')
@section('title', 'Add Product')
@section('css')
    <link href="{{ asset('backend/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet') }}" type="text/css">

    <link href="{{ asset('backend/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
@endsection
@section('admin')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add Product</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <form method="POST" action="{{ route('product.store') }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="form-group col-sm-10">
                                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Select Category</label>
                            <div class="form-group col-sm-10">
                                <select class="form-select" name="category_id">
                                    <option selected=""> select category</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Supplier Name</label>
                            <div class="form-group col-sm-10">
                                <select class="form-select" name="supplier_id">
                                    <option selected=""> select suppliser</option>
                                    @foreach ($suppliers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Select Units</label>
                            <div class="form-group col-sm-10">
                                <select class="form-select" name="unit_id">
                                    <option selected=""> select Units</option>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">


                            <h5>Status:-</h5>

                            <div class="col-sm-10">
                                <input class="form-check-input" type="radio" name="status" id="active" value="1"
                                    checked="">
                                <label class="form-check-label" for="active">
                                    Active
                                </label>

                                <input class="form-check-input" type="radio" name="status" value="0" id="inActive">
                                <label class="form-check-label" for="inActive">InActive</label>
                            </div><br>
                            <div class="col-sm-10">

                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <input type="submit" class="btn btn-primary waves-effect waves-light" value="Add Supplier">
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{ asset('backend/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
@endsection
