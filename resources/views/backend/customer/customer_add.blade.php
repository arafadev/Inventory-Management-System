@extends('admin.layouts.master')
@section('title', 'Add Customer')
@section('admin')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add Customer</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
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
                            <label class="col-sm-2 col-form-label">Mobile Number</label>
                            <div class="form-group col-sm-10">
                                <input class="form-control" type="text" name="mobile_no" value="{{ old('mobile_no') }}">
                                @error('mobile_no')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="form-group col-sm-10">
                                <input class="form-control" type="text" name="email" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">address</label>
                            <div class="form-group col-sm-10">
                                <input class="form-control" type="text" name="address" value="{{ old('address') }}">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Customer Image</label>
                            <div class="form-group col-sm-10">
                                <input class="form-control" type="file" name="customer_image" id="image"
                                    value="{{ old('customer_image') }}">
                                @error('customer_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <img class="rounded-circle avatar-xl" s
                                    src="{{ !empty($user->profile_img) ? url('upload/admin_images/' . $user->profile_img) : url('upload/no_img.jpg') }}"
                                    alt="Card image cap" data-holder-rendered="true" id="showImage">
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
                        <input type="submit" class="btn btn-primary waves-effect waves-light" value="Add Customer">
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
