@extends('components.master')

@section('container')
    <div class="content-wrapper">
        <section class="content-header">
            <br>
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
                                        <th>Kode Transaksi Pembelian</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Supplier Nama</th>
                                        <th>Tanggal Penerimaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_pembelian }}</td>
                                            <td>{{ indo_date($item->tanggal_pembelian) }}</td>
                                            <td>{{ $item->supplier_name }}</td>
                                            <td>{{ indo_date(check_empty($item->tanggal_penerimaan)) }}
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#modalEdit{{ $item->id_penerimaan }}">
                                                    <i class="fa fa-pencil"> Edit</i>
                                                </button>
                                                <button data-toggle="modal"
                                                    data-target="#modalDelete{{ $item->id_penerimaan }}"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"> Hapus</i>
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
        </section>
    </div>

    @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id_penerimaan }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Edit Penerimaan</h4>
                    </div>
                    <form action="{{ route('restock.penerimaan.update') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $item->id_penerimaan }}">
                                    <input type="number" value="{{ $item->id_pembelian }}" name="id_pembelian" hidden>
                                    <div class="col-md-6">
                                        <label for="tanggal_pembelian">Tanggal Pembelian</label>
                                        <input type="date" name="tanggal_pembelian" id="tanggal_pembelian"
                                            value="{{ $item->tanggal_pembelian }}" class="form-control" readonly="">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Tanggal Diterima</label>
                                        <input type="date" name="tanggal_penerimaan" id="tanggal_penerimaan"
                                            value="{{ check_empty($item->tanggal_penerimaan) }}" class="form-control"
                                            required="">
                                    </div>
                                </div>
                            </div>
                            @foreach ($pembelian_detail->where('pembelian_id', $item->pembelian_id) as $row)
                                {{-- @dd($row) --}}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama_sparepart">Nama Sparepart</label>
                                            <input type="number" value="{{ $row->id }}" name="pembelian_detail_id[]"
                                                hidden>
                                            <input type="text" name="nama_sparepart[]" id="nama_sparepart"
                                                value="{{ $row->item[0]->name }}" class="form-control" readonly="">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="jumlah_pembelian">Stok Dibeli</label>
                                            <input type="number" name="jumlah_pembelian[]" id="jumlah_pembelian"
                                                value="{{ $row->jumlah_pembelian }}" class="form-control" readonly="">
                                        </div>
                                        {{-- @dd($penerimaan_detail->where('pembelian_detail_id', $row->id)->first() == null) --}}
                                        <div class="col-md-4">
                                            <label>Stok Diterima</label>
                                            <input type="number" name="jumlah_penerimaan[]"
                                                value="{{ $penerimaan_detail->where('pembelian_detail_id', $row->id)->first() == null ? '-' : $penerimaan_detail->where('pembelian_detail_id', $row->id)->first()['jumlah_penerimaan'] }}"
                                                class="form-control" required="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="jumlah_pembelian">Lead Time</label>
                                        <input type="number" name="lead_time" id="lead_time" class="form-control">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <div style="float: right;">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data as $item)
        <div class="modal fade" id="modalDelete{{ $item->id_penerimaan }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Hapus Penerimaan</h4>
                    </div>
                    <form action="{{ route('restock.penerimaan.delete') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="number" value="{{ $item->id_penerimaan }}" name="id_penerimaan" hidden>
                            <input type="number" value="{{ $item->id_pembelian }}" name="id_pembelian" hidden>
                        </div>
                        <div class="modal-footer">
                            <div style="float: right;">
                                <button type="button" class="btn btn-default pull-left"
                                    data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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

        {{-- <script>
            let tanggal_penerimaan = new Date($('#tanggal_penerimaan').val());
            let tanggal_pembelian = new Date($('#tanggal_pembelian').val());
            $('#tanggal_penerimaan').on('change', function() {
                let selisihMillis = tanggal_penerimaan - tanggal_pembelian;

                // Konversi milidetik ke hari
                let lead_time_hari = selisihMillis / (1000 * 60 * 60 * 24);

                console.log(selisihMillis);
                console.log(tanggal_pembelian);
                console.log(tanggal_penerimaan);
            });
        </script> --}}
    @endpush
@endsection
