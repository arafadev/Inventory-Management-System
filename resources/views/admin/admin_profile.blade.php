@extends('admin.layouts.master')
@section('title', 'Admin Profile')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

@endsection
@section('admin')


    <div class="col-lg-6e">
        <div class="card"><br><br>
            <center>

                <img class="rounded-circle avatar-xl"
                    src="{{ !empty($user->profile_img) ? url('upload/admin_images/' . $user->profile_img) : url('upload/no_img.jpg') }}"
                    alt="Card image cap" data-holder-rendered="true">
            </center>
            <div class="card-body text-center">
                <h2 class="card-title">Name: {{ $user->name }}</h2>
                <hr>
                <h6 class="card-text text-bold">Email: {{ $user->email }}</h6><br>
                <a href="{{ route('admin.edit', Auth::user()->id) }}">
                    <button type="button" style="width:100px"
                        class="btn btn-primary waves-effect waves-light">Edit</button>

                </a>
            </div>
        </div>
    </div>


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
