@extends('components.master')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <br>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Laporan Pembelian</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title" style="margin-right: 10px;">Data Laporan Pembelian</h3>
                            @if (!empty($month) && !empty($year))
                                <a target="_blank"
                                    href="{{ route('laporan.pembelian.print-filter', ['month' => $month, 'year' => $year]) }}"
                                    class="btn btn-success btn-sm">print</a>
                            @else
                                <a target="_blank" href="{{ route('laporan.pembelian.print') }}"
                                    class="btn btn-success btn-sm">print</a>
                            @endif
                            <div class="pull-right d-flex">
                                <button class="btn btn-primary" id="btn-filter">Filter</button>
                            </div>
                            <div class="pull-right d-flex">
                                <select class="form-control" id="month" name="bulan_pilihan">
                                    <option value="all">Bulan Semua</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option {{ (empty($month) ? '' : $month == $i) ? 'selected' : '' }}
                                            value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="pull-right d-flex">
                                <select name="year" id="year" class="form-control">
                                    <option value="all">Tahun Semua</option>
                                    @foreach ($year as $item)
                                        <option {{ empty($tahun) ? '' : 'selected' }} value="{{ $item }}">
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Beli</th>
                                        <th>Pemasok</th>
                                        <th>Spare part</th>
                                        <th>Jumlah Dibeli</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ indo_date($item->tanggal_pembelian) }}</td>
                                            <td>{{ $item->supplier_name }}</td>
                                            <td>{{ $item->sparepart }}</td>
                                            <td>{{ $item->jumlah_pembelian }}</td>
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
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#btn-filter').on('click', function() {
                    let month = $('#month').val()
                    let year = $('#year').val()
                    var url = `/laporan/pembelian/filter/${month}/${year}`;
                    window.location.href = url;
                });
            });
        </script>
    @endpush
@endsection
