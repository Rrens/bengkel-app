@extends('components.master')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Stock In
                <small>Barang Masuk</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Stock In</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Stock In</h3>
                            <div class="pull-right">
                                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal"
                                    data-target="#modalAdd">
                                    <i class="fa fa-plus"> Create</i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Barcode</th>
                                        <th>Product Item</th>
                                        <th>Qty</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Trident</td>
                                        <td>Internet
                                            Explorer 4.0
                                        </td>
                                        <td>Win 95+</td>
                                        <td> 4</td>
                                        <td>X</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#modalDetail">
                                                <i class="fa fa-eye"> Detail</i>
                                            </button>
                                            <button data-toggle="modal" data-target="#modalDelete"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"> Delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Stock In</h4>
                </div>
                <form action="http://localhost/awrmotor/supplier/process" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Date *</label>
                            <input type="date" name="date" value="2023-12-09" class="form-control" required="">
                        </div>

                        <div>
                            <label for="barcode">Barcode</label>
                        </div>
                        <div class="form-group input-group">
                            <input type="hidden" name="item_id" id="item_id">
                            <input type="text" name="barcode" id="barcode" class="form-control" required=""
                                autofocus="">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal"
                                    data-target="#modalItemAdd">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Item Name *</label>
                            <input type="text" name="item_name" id="item_name" class="form-control" readonly="">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="unit_name">Item Unit</label>
                                    <input type="text" name="unit_name" id="unit_name" value="-"
                                        class="form-control" readonly="">
                                </div>
                                <div class="col-md-4">
                                    <label for="stock">Initial Stock</label>
                                    <input type="text" name="stock" id="stock" value="-" class="form-control"
                                        readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Detail *</label>
                            <input type="text" name="detail" class="form-control" placeholder="Kulakan / Tambahan / Etc"
                                required="">
                        </div>
                        <div class="form-group">
                            <label>Supplier *</label>
                            <select name="supplier" class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="4">Toko B</option>
                                <option value="6">Toko C</option>
                                <option value="12">Toko A</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Qty *</label>
                            <input type="number" name="qty" class="form-control" required="">
                        </div>
                        <div class="modal-footer">
                            <div style="float: right;">
                                <button type="button" class="btn btn-default pull-left"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalItemAdd" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Select Product Item</h4>
                </div>
                <div class="modal-body table-responsive">
                    <div id="table1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_length" id="table1_length"><label>Show <select
                                            name="table1_length" aria-controls="table1" class="form-control input-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-6">
                                <div id="table1_filter" class="dataTables_filter"><label>Search:<input type="search"
                                            class="form-control input-sm" placeholder="" aria-controls="table1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-striped dataTable no-footer" id="table1"
                                    role="grid" aria-describedby="table1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="table1" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Barcode: activate to sort column descending"
                                                style="width: 0px;">Barcode</th>
                                            <th class="sorting" tabindex="0" aria-controls="table1" rowspan="1"
                                                colspan="1" aria-label="Name: activate to sort column ascending"
                                                style="width: 0px;">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="table1" rowspan="1"
                                                colspan="1" aria-label="Unit: activate to sort column ascending"
                                                style="width: 0px;">Unit</th>
                                            <th class="sorting" tabindex="0" aria-controls="table1" rowspan="1"
                                                colspan="1" aria-label="Price: activate to sort column ascending"
                                                style="width: 0px;">Price</th>
                                            <th class="sorting" tabindex="0" aria-controls="table1" rowspan="1"
                                                colspan="1" aria-label="Stock: activate to sort column ascending"
                                                style="width: 0px;">Stock</th>
                                            <th class="sorting" tabindex="0" aria-controls="table1" rowspan="1"
                                                colspan="1" aria-label="Action: activate to sort column ascending"
                                                style="width: 0px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                        <tr role="row" class="odd">
                                            <td class="sorting_1">A001</td>
                                            <td>Kampas Rem Honda</td>
                                            <td>Unit</td>
                                            <td class="text-right">Rp. 15.000</td>
                                            <td class="text-right">110</td>
                                            <td>
                                                <button class="btn btn-xs btn-info" id="select" data-id="10"
                                                    data-barcode="A001" data-name="Kampas Rem Honda" data-unit="Unit"
                                                    data-stock="110">
                                                    <i class="fa fa-check"> Select</i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr role="row" class="even">
                                            <td class="sorting_1">A002</td>
                                            <td>Oli Motul</td>
                                            <td>Unit</td>
                                            <td class="text-right">Rp. 80.000</td>
                                            <td class="text-right">222</td>
                                            <td>
                                                <button class="btn btn-xs btn-info" id="select" data-id="11"
                                                    data-barcode="A002" data-name="Oli Motul" data-unit="Unit"
                                                    data-stock="222">
                                                    <i class="fa fa-check"> Select</i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">A003</td>
                                            <td>Lampu Honda</td>
                                            <td>Unit</td>
                                            <td class="text-right">Rp. 30.000</td>
                                            <td class="text-right">333</td>
                                            <td>
                                                <button class="btn btn-xs btn-info" id="select" data-id="12"
                                                    data-barcode="A003" data-name="Lampu Honda" data-unit="Unit"
                                                    data-stock="333">
                                                    <i class="fa fa-check"> Select</i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="table1_info" role="status" aria-live="polite">Showing
                                    1 to 3 of 3 entries</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button previous disabled" id="table1_previous"><a
                                                href="#" aria-controls="table1" data-dt-idx="0"
                                                tabindex="0">Previous</a></li>
                                        <li class="paginate_button active"><a href="#" aria-controls="table1"
                                                data-dt-idx="1" tabindex="0">1</a></li>
                                        <li class="paginate_button next disabled" id="table1_next"><a href="#"
                                                aria-controls="table1" data-dt-idx="2" tabindex="0">Next</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetail">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Stock In Detail</h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered no-margin">
                        <tbody>
                            <tr>
                                <th>Barcode</th>
                                <td><span id="barcode"></span></td>
                            </tr>
                            <tr>
                                <th>Item Name</th>
                                <td><span id="item_name"></span></td>
                            </tr>
                            <tr>
                                <th>Detail</th>
                                <td><span id="detail"></span></td>
                            </tr>
                            <tr>
                                <th>Supplier Name</th>
                                <td><span id="supplier_name"></span></td>
                            </tr>
                            <tr>
                                <th>Qty</th>
                                <td><span id="qty"></span></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td><span id="date"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delte Sales In</h4>
                </div>
                <form action="http://localhost/awrmotor/supplier/process" method="post">
                    <div class="modal-body">
                        <input type="number" value="" name="id" hidden>
                    </div>
                    <div class="modal-footer">
                        <div style="float: right;">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('head')
        <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
        <script>
            $(function() {
                $('#example1').DataTable()
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                })
            })
        </script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '#select', function() {
                    var item_id = $(this).data('id');
                    var barcode = $(this).data('barcode');
                    var name = $(this).data('name');
                    var unit_name = $(this).data('unit');
                    var stock = $(this).data('stock');
                    $('#item_id').val(item_id);
                    $('#barcode').val(barcode);
                    $('#item_name').val(name);
                    $('#unit_name').val(unit_name);
                    $('#stock').val(stock);
                    $('#modalItemAdd').modal('hide');
                })
            })
        </script>
    @endpush
@endsection
