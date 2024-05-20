@extends('components.master')

@section('container')
    <div class="content-wrapper" style="min-height: 822px;">
        <section class="content-header">
            {{-- <h1>Sales
                <small>Penjualan</small>
            </h1> --}}
            <br>
            <ol class=" breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
                <li>Transaksi Servis Motor</li>
                <!-- <li class="active">Stock In</li> -->
            </ol>
        </section>

        <section class="content">
            <div class="container center">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table>
                                    <tr>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kode_transaksi">Kode Transaksi</label>
                                                <input type="text" name="kode_transaksi" id="kode_transaksi"
                                                    class="form-control" value="{{ $invoice }}" readonly>
                                            </div>
                                        </div>
                                    </tr>

                                    {{-- <tr>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Tanggal Transaksi</label>
                                                <input type="date" class="form-control"
                                                    value="{{ old('date') == null ? $date : old('date') }}" name="date"
                                                    id="date">
                                            </div>
                                        </div>
                                    </tr> --}}

                                    <tr>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Tanggal Transaksi</label>
                                                <input type="date" class="form-control"
                                                    value="{{ old('date') == null ? $date : old('date') }}" name="date"
                                                    id="date">
                                            </div>
                                        </div>
                                    </tr>

                                    {{-- <div class="form-group">
                                        <label>Tanggal Pembelian *</label>
                                        <input type="date" name="tanggal_pembelian"
                                            value="{{ now() }}" class="form-control"
                                            id="tanggal_pembelian">
                                    </div> --}}

                                    <tr>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kasir">Kasir</label>
                                                <input type="text" name="user_id" id="user_id"
                                                    value="{{ auth()->user()->name }}" readonly class="form-control">
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="customer">Pelanggan</label>
                                                <select id="customer" class="form-control">
                                                    <option selected>Umum</option>
                                                    @foreach ($customers as $item)
                                                        <option {{ $item->id == old('customer') ? 'selected' : '' }}
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
                        <div class="box box-widget">
                            <div class="box-body">
                                <table>
                                    <tr>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="barcode">Barcode</label>
                                                <div class="form-group input-group">
                                                    <input type="hidden" id="item_id">
                                                    <input type="hidden" id="price">
                                                    <input type="hidden" id="stock">
                                                    <input type="hidden" id="jual_cart">
                                                    <input type="hidden" id="qty_cart">
                                                    <input type="text" id="barcode" class="form-control" autofocus="">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info btn-flat" data-toggle="modal"
                                                            data-target="#modal-item">
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
                                                <label for="jumlah_jual">Jumlah Jual</label>
                                                <input type="number" class="form-control" id="jumlah_jual">
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="jumlah_permintaan">Jumlah Permintaan</label>
                                                <input type="number" class="form-control" name="jumlah_permintaan"
                                                    id="jumlah_permintaan">
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <br>
                                                <button type="button" id="add_cart" class="btn btn-primary" style="float: right;">
                                                    <i class="fa fa-cart-plus"> Add</i>
                                                </button>
                                            </div>
                                        </div>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="box box-widget">
                            <div class="box-body table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Barcode</th>
                                            <th>Product Item</th>
                                            <th>Price</th>
                                            <th>Jumlah Jual</th>
                                            <th>Jumlah Permintaan</th>
                                            <th width="10%">Diskon Produk</th>
                                            <th width="15%">Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody id="cart_table">
                                        @foreach ($carts as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="barcode">{{ $item->item[0]->barcode }}</td>
                                                <td>{{ $item->item[0]->name }}</td>
                                                <td>{{ format_rupiah_tanpa_rp($item->price) }}</td>
                                                <td>{{ $item->jumlah_jual }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ format_rupiah_tanpa_rp($item->discount_item) }}</td>
                                                <td id="total">{{ format_rupiah_tanpa_rp($item->total) }}</td>
                                                <td class="text-center" width="160px">
                                                    <button id="update_cart" data-toggle="modal"
                                                        data-target="#modal-item-edit" data-cartid="{{ $item->item_id }}"
                                                        data-barcode="{{ $item->item[0]->barcode }}"
                                                        data-product="{{ $item->item[0]->name }}"
                                                        data-stock="{{ $item->item[0]->stock }}"
                                                        data-price="{{ $item->price }}"
                                                        data-jual="{{ $item->jumlah_jual }}"
                                                        data-qty="{{ $item->quantity }}"
                                                        data-discount="{{ $item->discount_item }}"
                                                        data-total="{{ $item->total }}" class="btn btn-xs btn-primary">
                                                        <i class="fa fa-pencil"></i> Update
                                                    </button>

                                                    <button id="del_cart" data-cartid="{{ $item->id }}"
                                                        class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash"></i>Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table>
                                    <tr>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sub_total">Sub Total</label>
                                                <input type="text" id="sub_total" value="" class="form-control"
                                                    readonly="">
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="discount">Diskon</label>
                                                <input type="text" id="discount" value="0" min="0"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="grand_total">Total Harga Akhir</label>
                                                <input type="text" id="grand_total" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="cash">Dibayarkan</label>
                                                <input type="text" id="cash" value="0" min="0"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="cash">Kembalian</label>
                                                <input type="text" id="change" value="0" min="0"
                                                    class="form-control" readonly>
                                            </div>
                                        </div>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="box box-widget">
                            <div class="box-body">
                                <table>
                                    <tr>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="note">Catatan</label>
                                                <textarea id="note" rows="13" class="form-control"></textarea>
                                            </div>
                                            <input type="date" name="date" id="date_id" value="{{ old('date') }}"
                                            hidden>
                                        </div>
                                    </tr>

                                    <tr>
                                        <div class="pull-right d-flex">
                                            <div class="form-group">
                                                <div style="float: right; padding:10px">
                                                    <button id="cancel_payment" class="btn btn-block btn-flat btn-warning">
                                                        <i class="fa fa-refresh"> Cancel</i>
                                                    </button>
                                                </div>

                                                <div style="float: right; padding:10px">
                                                    <button id="process_payment" class="btn btn-block btn-flat btn-flat btn-success">
                                                        <i class="fa fa-paper-plane-o"> Process Payment</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <!-- modal add product item -->
        <div class="modal fade" id="modal-item">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Pilih Produk</h4>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_item as $item)
                                    <tr>
                                        <td>{{ $item->barcode }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ !empty($item->category[0]) ? $item->category[0]->name : '-' }}</td>
                                        <td class="text-right">Rp. {{ number_format($item->price) }}</td>
                                        <td class="text-right">{{ $item->stock }}</td>
                                        <td class="text-right">
                                            <button class="btn btn-xs btn-info" id="select"
                                                data-id="{{ $item->id }}" data-barcode="{{ $item->barcode }}"
                                                data-price="{{ $item->price }}" data-stock="{{ $item->stock }}">
                                                <i class="fa fa-check"></i> Select
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

        <!-- modal edit product di cart -->
        <div class="modal fade" id="modal-item-edit">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Update Product Item</h4>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="cartid_item">
                        <div class="form-group">
                            <label for="product_item">Produk Item</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" id="barcode_item" class="form-control" readonly="">
                                </div>

                                <div class="col-md-7">
                                    <input type="text" id="product_item" class="form-control" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price_item">Harga</label>
                            <input type="text" id="price_item" min="0" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="jual_item">Jual</label>
                                    <input type="number" id="jual_item" min="1" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label for="qty_item">Permintaan</label>
                                    <input type="number" id="qty_item" min="1" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label for="qty_item">Stok</label>
                                    <input type="number" id="stock_item" class="form-control" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="total_before">Total sebelum diskon</label>
                            <input type="text" id="total_before" class="form-control" readonly="">
                        </div>

                        <div class="form-group">
                            <label for="discount_item">Diskon per barang</label>
                            <input type="text" id="discount_item" min="0" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="total_item">Total setelah Diskon</label>
                            <input type="text" id="total_item" class="form-control" readonly="">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="pull-right">
                            <button type="button" id="edit_cart" class="btn btn-flat btn-success">
                                <i class="fa fa-paper-plane"></i> Save
                            </button>
                        </div>
                    </div>
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
            function formatRupiah(angka) {
                var isNegative = angka < 0; // Periksa apakah angka negatif
                angka = Math.abs(angka); // Ubah ke nilai absolut

                var reverse = angka.toString().split('').reverse().join(''),
                    // split   = number_string.split(','),
                    // sisa    = reverse.match[0].length % 3,
                    // rupiah  = reverse.match[0].substr(0, sisa),
                    ribuan  = reverse.match(/\d{1,3}/g);

                ribuan = ribuan.join('.').split('').reverse().join('');

                // Tambahkan tanda minus jika angka negatif
                if (isNegative) {
                    ribuan = '-' + ribuan;
                }

                return ribuan;
            }

            $('#discount').on('change', function() {
                let discount = $(this).val();

                console.log(discount)
                $(this).val(formatRupiah(discount));
            });

            $('#cash').on('change', function() {
                let cash = $(this).val();
                $(this).val(formatRupiah(cash));
            });

            $('#date').on('change', function() {
                let date = $('#date').val();
                $('#date_id').val(date)
            })

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

            $('#jumlah_jual').on('keyup', function() {
                let stock = parseInt($('#stock').val());
                let jumlah_jual = parseInt($('#jumlah_jual').val());
                let jumlah_permintaan = parseInt($('#jumlah_permintaan').val());
                // let jumlah_permintaan = parseInt($('#jumlah_permintaan').val());
                // console.log(stock)
                // console.log(jumlah_jual)
                // console.log(jumlah_permintaan)

                if (jumlah_jual >= stock) {
                    $('#jumlah_jual').val(stock);
                    $('#jumlah_permintaan').val(jumlah_jual);
                    alert('Jumlah Jual Melebihi Stok')
                } else {
                    $('#jumlah_jual').val(jumlah_jual);
                    $('#jumlah_permintaan').val(jumlah_jual);
                }
            })

            $(document).on('click', '#select', function() {
                $('#item_id').val($(this).data('id'))
                $('#barcode').val($(this).data('barcode'))
                $('#price').val($(this).data('price'))
                $('#stock').val($(this).data('stock'))
                $('#modal-item').modal('hide')

                $.ajax({
                    url: `sales/check-min-stock/${$(this).data('id')}`,
                    method: 'GET',
                    success: function(data) {
                        // let stock = $(this).data('stock')
                        let stock = $('#stock').val()
                        console.log(data)
                        // console.log(stock)
                        if (stock <= data['stock_min'] && stock > data['safety_stock'] && stock > 0) {
                            if (!confirm('Sudah Sampai Batas Stock Min, Apakah anda yakin?')) {
                                // get_cart_qty($(this).data('barcode'))
                                $('#item_id').val('')
                                $('#barcode').val('')
                                $('#price').val('')
                                $('#stock').val('')
                            }
                        } else if (stock <= data['safety_stock'] && stock > 0) {

                            if (!confirm('Sudah Sampai Batas Safety Stock, Apakah anda yakin?')) {
                                // get_cart_qty($(this).data('barcode'))
                                $('#item_id').val('')
                                $('#barcode').val('')
                                $('#price').val('')
                                $('#stock').val('')
                            }
                        } else if (stock == 0) {

                            if (!confirm('Barang tidak mencukupi')) {
                                // get_cart_qty($(this).data('barcode'))
                                $('#item_id').val('')
                                $('#barcode').val('')
                                $('#price').val('')
                                $('#stock').val('')
                            }
                        } else {
                            get_cart_qty($(this).data('barcode'))

                        }

                    }
                })

            })

            function get_cart_qty(barcode) {
                //
                let qty_cart = $("#cart_table td.barcode:contains('" + barcode + "')").parent().find("td").eq(4).html()
                if (qty_cart != null) {
                    $('#qty_cart').val(qty_cart)
                } else {
                    $('#qty_cart').val(0)
                }
            }

            function get_jual_cart(barcode) {
                //
                let jual_cart = $("#cart_table td.barcode:contains('" + barcode + "')").parent().find("td").eq(4).html()
                if (jual_cart != null) {
                    $('#jual_cart').val(jual_cart)
                } else {
                    $('#jual_cart').val(0)
                }
            }

            //menambahkan data di cart
            $(document).on('click', '#add_cart', function() {
                let item_id = $('#item_id').val()
                let price = $('#price').val()
                let stock = $('#stock').val()
                let jual = $('#jumlah_jual').val()
                let qty = $('#jumlah_permintaan').val()
                let jual_cart = $('#jual_cart').val()
                let qty_cart = $('#qty_cart').val()
                let user_id = $('#user_id').val()
                if (item_id == '') {
                    alert('Product belum dipilih')
                    $('#barcode').focus()
                } else if (stock < 1 || parseInt(stock) < (parseInt(jual_cart) + parseInt(jumlah_jual))) {
                    alert('Stock tidak mencukupi')
                    $('#barcode').focus()
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('service.sales.add-cart') }}',
                        data: {
                            'add_cart': true,
                            'item_id': item_id,
                            'price': price,
                            'jual': jual,
                            'qty': qty,
                            'user_id': user_id,
                            '_token': '{{ csrf_token() }}',
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                $('#cart_table').load('{{ route('cart-data') }}', function() {
                                    calculate()
                                })
                                $('#item_id').val('')
                                $('#barcode').val('')
                                $('#jumlah_jual').val('')
                                $('#jumlah_permintaan').val('')
                                $('#qty').val(1)
                                $('#barcode').focus()
                            } else {
                                alert('Gagal tambah item cart')
                            }
                        }
                    })
                }
            })

            //hapus data di cart
            $(document).on('click', '#del_cart', function() {
                if (confirm('Apakah Anda yakin?')) {
                    let id = $(this).data('cartid')
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('service.sales.delete') }}',
                        dataType: 'json',
                        data: {
                            'id': id,
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(result) {
                            if (result.success == true) {
                                $('#cart_table').load('{{ route('cart-data') }}', function() {
                                    calculate()
                                })
                            } else {
                                alert('Gagal hapus item cart');
                            }
                        }
                    })
                }
            })

            //update data di cart
            $(document).on('click', '#update_cart', function() {
                $('#cartid_item').val($(this).data('cartid'))
                $('#barcode_item').val($(this).data('barcode'))
                $('#product_item').val($(this).data('product'))
                $('#stock_item').val($(this).data('stock'))
                $('#price_item').val($(this).data('price'))
                $('#jual_item').val($(this).data('jual'))
                $('#qty_item').val($(this).data('qty'))
                $('#total_before').val($(this).data('price') * $(this).data('jual'))
                $('#discount_item').val($(this).data('discount'))
                $('#total_item').val($(this).data('total'))
            })

            //hitung yang di cart
            function count_edit_modal() {
                let price = $('#price_item').val()
                let jual = $('#jual_item').val()
                // let qty = $('#qty_item').val()
                let discount = $('#discount_item').val()

                total_before = price * jual
                $('#total_before').val(total_before)

                total = (price - discount) * jual
                $('#total_item').val(total)

                if (discount == '') {
                    $('#discount_item').val(0)
                }
            }

            //saat ditekan atau di click
            $(document).on('keyup mouseup', '#price_item, #qty_item, #jual_item, #discount_item', function() {
                count_edit_modal()
            })

            // edit
            $(document).on('click', '#edit_cart', function() {
                let item_id = $('#cartid_item').val()
                let price = $('#price_item').val()
                let jual = $('#jual_item').val()
                let qty = $('#qty_item').val()
                let discount = $('#discount_item').val()
                let total = $('#total_item').val()
                let stock = $('#stock_item').val()
                if (price == '' || price < 1) {
                    alert('Harga tidak boleh kosong')
                    $('#pice_item').focus()
                } else if (jual == '' || jual < 1) {
                    alert('Jumlah jual tidak boleh kosong')
                    $('#jual_item').focus()
                } else if (parseInt(jual) > parseInt(stock)) {
                    alert('Stock tidak mencukupi')
                    $('#jual_item').focus()
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('service.sales.update') }}',
                        data: {
                            'edit_cart': true,
                            'item_id': item_id,
                            'price': price,
                            'jumlah_jual': jual,
                            'quantity': qty,
                            'discount': discount,
                            'total': total,
                            '_token': '{{ csrf_token() }}',
                        },
                        dataType: 'json',
                        success: function(result) {
                            console.log(result)
                            if (result.success == true) {
                                $('#cart_table').load('{{ route('cart-data') }}', function() {
                                    calculate()
                                })
                                alert('Item cart berhasil ter-update')
                                $('#modal-item-edit').modal('hide');
                            } else {
                                alert('Data item cart tidak ter-update')
                                $('#modal-item-edit').modal('hide');
                            }
                        }
                    })
                }
            })

            function removePoint(number) {
                let data = number.includes('.') ? number.replace(/\./g, '') : number
                // console.log(data)
                return data
            }

            //hitung yang dibawah cart
            function calculate() {
                let subtotal = 0;
                $('#cart_table tr').each(function() {
                    subtotal += parseInt($(this).find('#total').text().replace(/\./g, ''))
                })
                isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(formatRupiah(subtotal))

                let discount = removePoint($('#discount').val());

                // console.log(discount);
                let grand_total = 0

                grand_total += (parseInt(subtotal) - parseInt(discount))

                if (isNaN(grand_total)) {
                    $('#grand_total').val(0)
                    $('#grand_total2').val(0)
                } else {
                    $('#grand_total').val(formatRupiah(grand_total))
                    $('#grand_total2').val(formatRupiah(grand_total))
                }

                let cash = $('#cash').val();
                cash != 0 ? $('#change').val(formatRupiah(cash - grand_total)) : $('#change').val(0)
                // console.log(cash - grand_total)


                if (discount == '') {
                    $('#discount').val(0)
                }
            }


            $(document).on('keyup mouseup', '#discount, #cash', function() {
                calculate()
            })

            // panggil fungsi hitung
            $(document).ready(function() {
                calculate()
            })

            // process payment
            $(document).on('click', '#process_payment', function() {
                let customer_id = $('#customer').val()
                let subtotal = removePoint($('#sub_total').val())
                let discount = removePoint($('#discount').val())
                let grandtotal = removePoint($('#grand_total').val())
                let cash = removePoint($('#cash').val())
                let change = removePoint($('#change').val())
                let note = $('#note').val()
                let date = $('#date').val()
                if (subtotal < 1) {
                    alert('Belum ada product item yang dipilih')
                    $('#barcode').focus()
                } else if (cash < 1) {
                    alert('Jumlah uang cash belum diinput')
                    $('#cash').focus()
                } else {
                    if (confirm('Yakin proses transaksi ini?')) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('service.sales.store-sales') }}',
                            data: {
                                'process_payment': true,
                                'customer_id': customer_id,
                                'subtotal': subtotal,
                                'discount': discount,
                                'grandtotal': grandtotal,
                                'cash': cash,
                                'change': change,
                                'note': note,
                                'date': date,
                                '_token': '{{ csrf_token() }}',
                            },
                            dataType: 'json',
                            success: function(result) {
                                // console.log(result);
                                if (result.success) {
                                    let sales_id = result.sale_id ? result.sale_id : 1;
                                    alert('Transaksi berhasil');
                                    window.open(
                                        `{{ route('service.sales.print', ':sales_id') }}`.replace(
                                            ':sales_id', sales_id),
                                        '_blank')
                                } else {
                                    alert('Transaksi gagal');
                                }
                                location.href = '{{ route('service.sales.index') }}'
                                // console.log(result)
                            }
                        })
                    }
                }
            })

            $(document).on('click', '#cancel_payment', function() {
                if (confirm('Batalkan?')) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('service.sales.cancel-sales') }}',
                        dataType: 'json',
                        data: {
                            'cancel_payment': true,
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(result) {
                            if (result.success == true) {
                                $('#cart_table').load('{{ route('cart-data') }}', function() {
                                    calculate()
                                })
                            }
                        }
                    })
                    $('#discount').val(0)
                    $('#cash').val(0)
                    $('#customer').val('').change()
                    $('#barcode').val('')
                    $('#barcode').focus()
                }
            })
        </script>
    @endpush
@endsection
