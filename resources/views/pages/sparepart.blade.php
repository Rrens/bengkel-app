@extends('components.master')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Spare Part
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Spare Part</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Spare Part</h3>
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
                                        <th>Name</th>
                                        <th>Kategori</th>
                                        <th>Price</th>
                                        <th>Stock</th>
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

    <div class="modal fade" id="modalAdd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Spare Part</h4>
                </div>
                <form action="http://localhost/awrmotor/supplier/process" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="hidden" name="id" value="">
                            <input type="text" name="name" value="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Price *</label>
                            <input type="number" name="price" value="" class="form-control" required>
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

    <div class="modal fade" id="modalEdit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Spare Part</h4>
                </div>
                <form action="http://localhost/awrmotor/supplier/process" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="hidden" name="id" value="">
                            <input type="text" name="name" value="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Price *</label>
                            <input type="number" name="price" value="" class="form-control" required>
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
                    <h4 class="modal-title">Delete Spare Part</h4>
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
