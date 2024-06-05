@extends('admin.layouts.master')
@section('title', 'Purchases')
@section('css')

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- DataTables -->
    <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('admin')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('purchase.add') }}">
                        <button type="button" class="btn btn-info waves-effect waves-light" style="float: right;">Add
                            Purchase</button><br><br>
                    </a>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Purchase Number</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($purchases as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->purchase_no }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->date)->format('D, d F Y') }} </td>
                                    <td>{{ $item->supplier->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->buying_qty }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <button type="button"
                                                class="btn btn-success waves-effect waves-light">Approved</button>
                                        @else
                                            <button type="button" class="btn btn-warning waves-effect waves-light">Not
                                                Approved</button>
                                        @endif

                                    </td>
                                    <td>

                                        <a href="{{ route('purchase.delete', $item->id) }}" class="btn btn-danger"
                                            id="delete">

                                            <i class="ri-delete-bin-6-line"></i>
                                        </a>


                                        @if ($item->status == '1')
                                            <a href="{{ route('purchase.inactive', $item->id) }}">
                                                <button type="button" class="btn btn-warning waves-effect waves-light"><i
                                                        class="ri-arrow-down-line" title="InApproved purchase"></i></button>
                                            </a>
                                        @else
                                            <a href="{{ route('purchase.active', $item->id) }}">
                                                <button type="button" class="btn btn-success waves-effect waves-light"><i
                                                        class="ri-arrow-up-line" title="Approved purchase"></i></button>
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('js')
    

    <!-- Required datatable js -->
    <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Buttons examples -->
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>

    <!-- Datatable init js -->
    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="{{ asset('backend/assets/js/code.js') }}"></script>




@endsection
