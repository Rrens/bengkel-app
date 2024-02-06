@extends('components.master')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                LAPORAN TRANSAKSI SERVIS
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Laporan Transaksi</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Laporan</h3>
                            {{-- <div class="pull-right d-flex justify-items-center align-content-center">
                                <input type="month" class="form-control">
                                <button class="btn btn-primary">Filter</button>
                            </div> --}}
                            <div class="pull-right d-flex">
                                {{-- <input type="month" class="form-control"> --}}
                                <select class="form-control" id="bulan_pilihan" name="bulan_pilihan">
                                    <option selected hidden>Filter Bulan</option>
                                    <option value="all">Semua</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option {{ (empty($month) ? '' : $month == $i) ? 'selected' : '' }}
                                            value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                        <th>Diskon</th>
                                        <th>Total Akhir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->customer[0]->name }}</td>
                                            <td>{{ format_rupiah($item->total_price) }}</td>
                                            <td>{{ format_rupiah($item->service) }}</td>
                                            <td>{{ format_rupiah($item->final_price) }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#modalDetail{{ $item->id }}">Detail</button>
                                                <a href="{{ route('laporan.transaction.print', $item->id) }}"
                                                    target="_blank" class="btn btn-success btn-sm">Print</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @foreach ($data as $item)
        <div class="modal fade" id="modalDetail{{ $item->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Detail Laporan</h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <table class="table table-bordered no-margin">
                            <tbody>
                                <tr>
                                    <th style="width:20%">Pelanggan</th>
                                    <td style="width:30%"><span
                                            id="invoice">{{ empty($item->customer[0]->name) ? 'Umum' : $item->customer[0]->name }}</span>
                                    </td>
                                    <th style="width:20%">Kasir</th>
                                    <td style="width:30%"><span id="cust">{{ $item->user[0]->username }}</span></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td><span id="datetime">{{ $item->date }}</span></td>
                                    <th>Tunai</th>
                                    <td><span id="cashier">{{ format_rupiah($item->cash) }}</span></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td><span id="total">{{ format_rupiah($item->total_price) }}</span></td>
                                    <th>Kembalian</th>
                                    <td><span id="cash">{{ format_rupiah($item->remaining) }}</span></td>
                                </tr>
                                <tr>
                                    <th>Diskon</th>
                                    <td><span id="discount">{{ format_rupiah($item->discount) }}</span></td>
                                    <th>Catatan</th>
                                    <td><span id="change">{{ $item->note }}</span></td>
                                </tr>
                                <tr>
                                    <th>Total Keseluruhan</th>
                                    <td colspan="3"><span id="grandtotal">{{ format_rupiah($item->final_price) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Produk</th>
                                    <td colspan="3"><span id="product">
                                            <table class="table no-margin">
                                                <tbody>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Price</th>
                                                        <th>Jual </th>
                                                        <th>Permintaan</th>
                                                        <th>Disc</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    @foreach ($data_detail->where('sale_id', $item->id) as $row)
                                                        {{-- @dd($row) --}}
                                                        <tr>
                                                            <td>{{ $row->item[0]->name }}</td>
                                                            <td>{{ format_rupiah($row->item[0]->price) }}</td>
                                                            <td>{{ $row->jual }}</td>
                                                            <td>{{ $row->qty }}</td>
                                                            <td>{{ format_rupiah($row->discount_row) }}</td>
                                                            <td>{{ format_rupiah($row->total) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <div style="float: right;">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                            {{-- <button type="submit" class="btn btn-primary">Simpan</button> --}}
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @push('head')
        <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    @endpush

    @push('head')
        <style>
            .bg-danger {
                background-color: red;
            }

            .badge-warning {
                background-color: yellow;
            }

            .badge-success {
                background-color: green;
            }
        </style>
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
                $('#bulan_pilihan').on('change', function() {
                    var selectedValue = $(this).val();
                    if (selectedValue != 'all') {

                        var url = '/laporan/transaction-service/' + selectedValue;
                    } else {
                        var url = '/laporan/transaction-service';

                    }
                    window.location.href = url;
                });
            });
        </script>
    @endpush
@endsection
