@extends('admin.layouts.master')
@section('title', 'Change Password')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

@endsection
@section('admin')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Change Password</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <form method="POST" action="{{ route('admin.updatePassword') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Current Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="newPassword">
                                @error('newPassword')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="confirmPassword">
                                @error('confirmPassword')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <input type="submit" class="btn btn-primary waves-effect waves-light" value="Update-profile">
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('msg'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('msg') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('msg') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('msg') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('msg') }} ");
                    break;
            }
        @endif
    </script>
@endsection
