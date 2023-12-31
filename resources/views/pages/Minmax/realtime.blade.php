@extends('components.master')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                DAFTAR STOCK SPARE PART MIN MAX REALTIME
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Pembelian</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Real Time</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Spare Part</th>
                                        <th>Stok</th>
                                        <th>Stok Min</th>
                                        <th>Stok Max</th>
                                        <th>Safety Stok</th>
                                        <th>Lead Time</th>
                                        <th>Max Per</th>
                                        <th>Rata-rata Per</th>
                                        <th>Restok</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($data as $item) --}}
                                    <tr>
                                        {{-- <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal_pembelian }}</td>
                                            <td>{{ $item->supplier[0]->name }}</td>
                                            <td>{{ $item->item[0]->name }}</td>
                                            <td>{{ $item->jumlah_pembelian }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#modalEdit{{ $item->id }}">
                                                    <i class="fa fa-pencil"> Edit</i>
                                                </button>
                                            </td> --}}
                                    </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Penerimaan</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('restock.pembelian.update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tanggal Pembelian *</label>
                                        <input type="date" name="tanggal_pembelian" value="{{ $date }}"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Supplier *</label>
                                        <select name="supplier_id" class="form-control">
                                            <option selected hidden>- Pilih -</option>
                                            @foreach ($supplier as $item)
                                                <option {{ !empty(old('supplier_id')) ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="name_item">Search Item</label>
                            </div>
                            <div class="form-group input-group">
                                <input type="hidden" name="item_id" id="item_id" value="">
                                <input type="text" name="name_item" id="name_item" value=""
                                    class="form-control" readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal"
                                        data-target="#modalItemAdd">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="stock">Stok Sekarang</label>
                                        <input type="text" name="stock" id="stock" value=""
                                            class="form-control" readonly="">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Stok Dibeli</label>
                                        <input type="number" name="jumlah_pembelian"
                                            value="{{ old('jumlah_pembelian') }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div style="float: right;">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}

    {{-- <div class="modal fade" id="modalItemAdd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Select Product Item</h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped" id="example2">
                        <thead>
                            <tr>
                                <th>Name Item</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-right">Rp {{ number_format($item->price) }}</td>
                                    <td class="text-right">{{ $item->stock }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" id="select"
                                            data-item_id="{{ $item->id }}" data-name_item="{{ $item->name }}"
                                            data-stock="{{ $item->stock }}">
                                            <i class="fa fa-check"> Select</i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

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
                    var item_id = $(this).data('item_id');
                    var name_item = $(this).data('name_item');
                    var stock = $(this).data('stock');
                    $('#item_id').val(item_id);
                    $('#name_item').val(name_item);
                    $('#stock').val(stock);
                    $('#modalItemAdd').modal('hide');
                })
            })
        </script>
    @endpush
@endsection
