@extends('components.master')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <br>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Pembelian</li>
            </ol>
        </section>

        <section class="content">
            <div class="container">
                <div class="row align-items-center">
                    <form action="{{ route('restock.pembelian.store') }}" method="post">
                        @csrf
                        <div class="col-md-6">
                            <div class="box box-widget">
                                <div class="box-body">
                                    <table>
                                        <tr>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="kode_pembelian">Kode Pembelian</label>
                                                    <input type="text" class="form-control" value="{{ $kode_pembelian }}"
                                                        id="kode_pembelian" readonly>
                                                </div>
                                            </div>
                                        </tr>

                                        <tr>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tanggal Pembelian *</label>
                                                    <input type="date" name="tanggal_pembelian"
                                                        value="{{ now() }}" class="form-control"
                                                        id="tanggal_pembelian">
                                                </div>

                                                {{-- <div class="form-group">
                                                        <label>Tanggal Pembelian *</label>
                                                        <input type="date" name="tanggal_pembelian"
                                                            value="{{ now()->toDateString() }}" class="form-control"
                                                            id="tanggal_pembelian" required>
                                                    </div> --}}
                                            </div>
                                        </tr>

                                        <tr>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Supplier *</label>
                                                    <select name="supplier_id" id="supplier_id" class="form-control">
                                                        <option selected hidden>- Pilih -</option>
                                                        @foreach ($supplier as $item)
                                                            <option {{ old('supplier_id') == $item->id ? 'selected' : '' }}
                                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="box body-widget">
                                <div class="box-body">
                                    <table>
                                        <tr>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name_item">Cari Item</label>
                                                    <div class="form-group input-group">
                                                        <input name="item_id" id="item_id" value="{{ old('item_id') }}"
                                                            hidden>
                                                        <input type="text" name="name_item" id="name_item"
                                                            value="{{ old('name_item') }}" class="form-control"
                                                            readonly="">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-info btn-flat"
                                                                data-toggle="modal" data-target="#modalItemAdd">
                                                                <i class="fa fa-search"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>

                                        <tr>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="stock">Stok Sekarang</label>
                                                    <input type="text" name="stock" id="stock"
                                                        value="{{ old('stock') }}" class="form-control" readonly="">
                                                </div>
                                            </div>
                                        </tr>

                                        <tr>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Stok Dibeli</label>
                                                    <input type="number" name="jumlah_pembelian" id="stok_dibeli"
                                                        value="{{ old('jumlah_pembelian') }}" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                        </tr>

                                        <tr>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <br>
                                                    <button type="submit" class="btn btn-primary"
                                                        style="float: right;">Simpan</button>
                                                </div>
                                            </div>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-widget">
                            <div class="box-body table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name Item</th>
                                            <th>Jumlah Pembelian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ !empty($item->item[0]) ? $item->item[0]->name : '-' }}</td>
                                                <td>{{ $item->jumlah_pembelian }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#modalEdit{{ $item->id }}">
                                                        <i class="fa fa-pencil"> Edit</i></button>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#modalDelete{{ $item->id }}">
                                                        <i class="fa fa-trash"> Delete</i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="form-group" style="margin-top: 10px;">
                                    <div style="float: right;">
                                        <form action="{{ route('restock.pembelian.store-pembelian') }}" method="post">
                                            @csrf
                                            <input type="text" id="supplier_id_pembelian" name="supplier_id_pembelian"
                                                value="{{ !empty(old('supplier_id_pembelian')) ? old('supplier_id_pembelian') : '' }}"
                                                hidden>
                                            <input type="date" id="supplier_tanggal_pembelian"
                                                value="{{ !empty(old('supplier_tanggal_pembelian')) ? old('supplier_tanggal_pembelian') : '' }}"
                                                name="supplier_tanggal_pembelian" hidden>
                                            <button type="submit" class="btn btn-primary">Proses</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Pembelian</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('restock.pembelian.update') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="item">Nama Item</label>
                                        <input type="text" name="item" id="item"
                                            value="{{ $item->item[0]->name }}" class="form-control" readonly>
                                        <input type="number" name="id" value="{{ $item->id }}" hidden>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Stok Dibeli</label>
                                        <input type="number" name="jumlah_pembelian"
                                            value="{{ $item->jumlah_pembelian }}" class="form-control" required>
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
                        {{-- <div style="float: right;">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div> --}}
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data as $item)
        <div class="modal fade" id="modalDelete{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Hapus {{ $item->item[0]->name }}?</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('restock.pembelian.delete') }}" method="post">
                            @csrf

                            {{-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="item">Nama Item</label>
                                        <input type="text" name="item" id="item"
                                            value="{{ $item->item[0]->name }}" class="form-control" readonly>
                                        <input type="number" name="id" value="{{ $item->id }}" hidden>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Stok Dibeli</label>
                                        <input type="number" name="jumlah_pembelian"
                                            value="{{ $item->jumlah_pembelian }}" class="form-control" required>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <div style="float: right;">
                                    <input type="number" value="{{ $item->id }}" name="id" hidden>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        {{-- <div style="float: right;">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div> --}}
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="modalItemAdd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Cari Produk</h4>
                </div>
                <div class="modal-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Sparepart</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Restok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                {{-- @dd($item) --}}
                                <tr>
                                    <td>{{ $item->barcode }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ !empty($item->category[0]) ? $item->category[0]->name : '-' }}</td>
                                    <td class="text-right">Rp {{ number_format($item->price) }}</td>
                                    <td class="text-right">{{ $item->stock }}</td>
                                    <td class="text-right"></td>
                                    <td>
                                        <button class="btn btn-xs btn-info" id="select"
                                            data-barcode="{{ $item->barcode }}" data-item_id="{{ $item->id }}"
                                            data-name_item="{{ $item->name }}" data-stock="{{ $item->stock }}">
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
            function fetchRestockData() {
                $('#example1 tbody tr').each(function() {
                    let barcode = $(this).find('td:first').text();

                    $.ajax({
                        url: `/transaction/sales/data-restock/${barcode}`,
                        method: 'GET',
                        success: function(data) {
                            console.log(data)
                            $(this).find('td').eq(5).text(
                                data);
                        }.bind(this),
                        error: function() {
                            console.log('fail', barcode)
                        }
                    });
                });
            }

            $(document).ready(function() {
                $(document).on('click', '#select', function() {
                    console.log($(this))
                    let barcode = $(this).data('barcode')
                    let item_id = $(this).data('item_id');
                    let name_item = $(this).data('name_item');
                    let stock = $(this).data('stock');
                    $('#item_id').val(item_id);
                    $('#name_item').val(name_item);
                    $('#stock').val(stock);
                    $('#modalItemAdd').modal('hide');

                    // $.ajax({
                    //     url: `/data-hitung/${item_id}`,
                    //     method: 'GET',
                    //     success: function(data) {
                    //         // console.log(data)
                    //         $('#stok_dibeli').val(data)
                    //     },
                    //     error: function() {
                    //         $('#stok_dibeli').val('')
                    //     }
                    // })

                    $.ajax({
                        url: `/transaction/sales/data-restock/${barcode}`,
                        method: 'GET',
                        success: function(data) {
                            $('#stok_dibeli').val(data)
                        },
                        error: function() {
                            console.log('fail', barcode)
                        }
                    });
                })

                fetchRestockData()
            })
        </script>

        <script>
            $('#supplier_id').on('change', function() {
                var id = $('#supplier_id').val();
                $('#supplier_id_pembelian').val(id);
            })

            $('#tanggal_pembelian').on('change', function() {
                let date = $('#tanggal_pembelian').val();
                console.log(date)
                $('#supplier_tanggal_pembelian').val(date);
            })

            $(document).on('keyup mouseup', function() {
                fetchRestockData()
            })
        </script>
    @endpush
@endsection
