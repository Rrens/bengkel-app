@extends('components.master')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Penerimaan Kulakan
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Penerimaan</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Penerimaan</h3>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pembelian ID</th>
                                        <th>Nama Toko</th>
                                        <th>Supplier Name</th>
                                        <th>Item Name</th>
                                        <th>Jumlah Pembelian</th>
                                        <th>Jumlah Penerimaan</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Tanggal Penerimaan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>Trident</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#modalEdit">
                                                <i class="fa fa-pencil"> Edit</i>
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

    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Penerimaan</h4>
                </div>
                <form action="http://localhost/awrmotor/supplier/process" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <input type="hidden" name="penerimaan_id" value="61">
                                <div class="col-md-6">
                                    <label for="tanggal_pembelian">Tanggal Pembelian</label>
                                    <input type="text" name="tanggal_pembelian" id="tanggal_pembelian"
                                        value="2023-11-27 00:00:00" class="form-control" readonly="">
                                </div>

                                <div class="col-md-6">
                                    <label>Tanggal Diterima</label>
                                    <input type="date" name="tanggal_penerimaan" value="2023-12-09" class="form-control"
                                        required="">
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                                            <label>Date *</label>
                                            <input type="hidden" name="penerimaan_id" value="61">
                                            <input type="date" name="tanggal_penerimaan" value="2023-12-09" class="form-control" required>
                                        </div> -->

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="jumlah_pembelian">Stock Dibeli</label>
                                    <input type="number" name="jumlah_pembelian" id="jumlah_pembelian" value="1"
                                        class="form-control" readonly="">
                                </div>

                                <div class="col-md-6">
                                    <label>Stock Diterima</label>
                                    <input type="number" name="jumlah_penerimaan" value="" class="form-control"
                                        required="">
                                </div>
                            </div>
                        </div>
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

    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delte Supplier</h4>
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
    @endpush
@endsection
