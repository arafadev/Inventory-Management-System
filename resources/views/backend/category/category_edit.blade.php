@extends('admin.layouts.master')
@section('title', 'Edit Category')
@section('admin')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Category</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <form method="POST" action="{{ route('category.update', $category->id) }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="form-group col-sm-10">
                                <input class="form-control" type="text" name="name" value="{{ $category->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <div class="row mb-3">

                            <h5>Status:-</h5>

                            <div class="col-sm-10">
                                <input class="form-check-input" type="radio" name="status" id="active" value="1"
                                    {{ $category->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">
                                    Active
                                </label>

                                <input class="form-check-input" type="radio" name="status" value="0" id="inActive"
                                    {{ $category->status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inActive">InActive</label>
                            </div><br>
                            <div class="col-sm-10">

                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <input type="submit" class="btn btn-primary waves-effect waves-light" value="Edit Category">
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
