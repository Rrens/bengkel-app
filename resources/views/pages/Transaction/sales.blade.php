@extends('components.master')

@section('container')
    <div class="content-wrapper" style="min-height: 822px;">
        <section class="content-header">
            <h1>Sales
                <small>Penjualan</small>
            </h1>
            <ol class=" breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
                <li>Transaction</li>
                <!-- <li class="active">Stock In</li> -->
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="box box-widget">
                        <div class="box-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <label for="date">Date</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="date" id="date" value="2023-12-09"
                                                    class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top; width:30%">
                                            <label for="user">Kasir</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" id="user" value="Fanani A" class="form-control"
                                                    readonly="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top">
                                            <label for="customer">Customer</label>
                                        </td>
                                        <td>
                                            <div>
                                                <select id="customer" class="form-control">
                                                    <option value="">Umum</option>
                                                    <option value="9">Aldo</option>
                                                    <option value="10">fanani</option>
                                                    <option value="11">bela</option>
                                                    <option value="12">aini</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="box box-widget">
                        <div class="box-body">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top; width:30%">
                                            <label for="barcode">Barcode</label>
                                        </td>
                                        <td>
                                            <div class="form-group input-group">
                                                <input type="hidden" id="item_id">
                                                <input type="hidden" id="price">
                                                <input type="hidden" id="stock">
                                                <input type="hidden" id="qty_cart">
                                                <input type="text" id="barcode" class="form-control" autofocus="">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal"
                                                        data-target="#modal-item">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <label for="qty">Qty</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" id="qty" value="1" min="1"
                                                    class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div>
                                                <button type="button" id="add_cart" class="btn btn-block btn-primary">
                                                    <i class="fa fa-cart-plus"> Add</i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="box box-widget">
                        <div class="box-body">
                            <div align="right">
                                <h4>Invoice
                                    <b><span id="invoice">MP2312090001</span></b>
                                </h4>
                                <h1>
                                    <b><span id="grand_total2" style="font-size: 50pt;">185000</span></b>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="box box-widget">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barcode</th>
                                        <th>Product Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th width="10%">Discount Item</th>
                                        <th width="15%">Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="cart_table">
                                    <tr>
                                        <td>1.</td>
                                        <td class="barcode">A001</td>
                                        <td>Kampas Rem Honda</td>
                                        <td class="text-right">15000</td>
                                        <td class="text-center">7</td>
                                        <td class="text-right">0</td>
                                        <td class="text-right" id="total">105000</td>
                                        <td class="text-center" width="160px">
                                            <button id="update_cart" data-toggle="modal" data-target="#modal-item-edit"
                                                data-cartid="1" data-barcode="A001" data-product="Kampas Rem Honda"
                                                data-stock="111" data-price="15000" data-qty="7" data-discount="0"
                                                data-total="105000" class="btn btn-xs btn-primary">
                                                <i class="fa fa-pencil"></i> Update
                                            </button>
                                            <button id="del_cart" data-cartid="1" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i>Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="box box-widget">
                        <div class="box-body">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top; width:30%">
                                            <label for="sub_total">Sub Total</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" id="sub_total" value="" class="form-control"
                                                    readonly="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <label for="discount">Jasa</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" id="discount" value="0" min="0"
                                                    class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <label for="grand_total">Grand Total</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" id="grand_total" class="form-control"
                                                    readonly="">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="box box-widget">
                        <div class="box-body">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top; width:30%">
                                            <label for="cash">Cash</label>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="number" id="cash" value="0" min="0"
                                                    class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <label for="change">Change</label>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="number" id="change" class="form-control"
                                                    readonly="">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="box box-widget">
                        <div class="box-body">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <label for="note">Note</label>
                                        </td>
                                        <td>
                                            <div>
                                                <textarea id="note" rows="3" class="form-control"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div>
                        <button id="cancel_payment" class="btn btn-block btn-flat btn-warning">
                            <i class="fa fa-refresh"> Cancel</i>
                        </button>
                        <button id="process_payment" class="btn btn-block btn-flat btn-flat btn-success">
                            <i class="fa fa-paper-plane-o"> Process Payment</i>
                        </button>
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
                        <h4 class="modal-title">Add Product Item</h4>
                    </div>
                    <div class="modal-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A001</td>
                                    <td>Kampas Rem Honda</td>
                                    <td>Unit</td>
                                    <td class="text-right">Rp. 15.000</td>
                                    <td class="text-right">111</td>
                                    <td class="text-right">
                                        <button class="btn btn-xs btn-info" id="select" data-id="10"
                                            data-barcode="A001" data-price="15000" data-stock="111">
                                            <i class="fa fa-check"></i> Select
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A002</td>
                                    <td>Oli Motul</td>
                                    <td>Unit</td>
                                    <td class="text-right">Rp. 80.000</td>
                                    <td class="text-right">222</td>
                                    <td class="text-right">
                                        <button class="btn btn-xs btn-info" id="select" data-id="11"
                                            data-barcode="A002" data-price="80000" data-stock="222">
                                            <i class="fa fa-check"></i> Select
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A003</td>
                                    <td>Lampu Honda</td>
                                    <td>Unit</td>
                                    <td class="text-right">Rp. 30.000</td>
                                    <td class="text-right">333</td>
                                    <td class="text-right">
                                        <button class="btn btn-xs btn-info" id="select" data-id="12"
                                            data-barcode="A003" data-price="30000" data-stock="333">
                                            <i class="fa fa-check"></i> Select
                                        </button>
                                    </td>
                                </tr>
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
                            <label for="product_item">Product Item</label>
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
                            <label for="price_item">Price</label>
                            <input type="number" id="price_item" min="0" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7">
                                    <label for="qty_item">Qty</label>
                                    <input type="number" id="qty_item" min="1" class="form-control">
                                </div>
                                <div class="col-md-5">
                                    <label for="qty_item">Stock</label>
                                    <input type="number" id="stock_item" class="form-control" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="total_before">Total before Discount</label>
                            <input type="number" id="total_before" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="discount_item">Discount per Item</label>
                            <input type="number" id="discount_item" min="0" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="total_item">Total after Discount</label>
                            <input type="number" id="total_item" class="form-control" readonly="">
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

            $(document).on('click', '#select', function() {
                $('#item_id').val($(this).data('id'))
                $('#barcode').val($(this).data('barcode'))
                $('#price').val($(this).data('price'))
                $('#stock').val($(this).data('stock'))
                $('#modal-item').modal('hide')

                get_cart_qty($(this).data('barcode'))
            })

            function get_cart_qty(barcode) {
                //
                var qty_cart = $("#cart_table td.barcode:contains('" + barcode + "')").parent().find("td").eq(4).html()
                if (qty_cart != null) {
                    $('#qty_cart').val(qty_cart)
                } else {
                    $('#qty_cart').val(0)
                }
            }

            //menambahkan data di cart
            $(document).on('click', '#add_cart', function() {
                var item_id = $('#item_id').val()
                var price = $('#price').val()
                var stock = $('#stock').val()
                var qty = $('#qty').val()
                var qty_cart = $('#qty_cart').val()
                if (item_id == '') {
                    alert('Product belum dipilih')
                    $('#barcode').focus()
                } else if (stock < 1 || parseInt(stock) < (parseInt(qty_cart) + parseInt(qty))) {
                    alert('Stock tidak mencukupi')
                    $('#barcode').focus()
                } else {
                    $.ajax({
                        type: 'POST',
                        url: 'http://localhost/mypos/sale/process',
                        data: {
                            'add_cart': true,
                            'item_id': item_id,
                            'price': price,
                            'qty': qty
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                $('#cart_table').load('http://localhost/mypos/sale/cart_data', function() {
                                    calculate()
                                })
                                $('#item_id').val('')
                                $('#barcode').val('')
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
                    var cart_id = $(this).data('cartid')
                    $.ajax({
                        type: 'POST',
                        url: 'http://localhost/mypos/sale/cart_del',
                        dataType: 'json',
                        data: {
                            'cart_id': cart_id
                        },
                        success: function(result) {
                            if (result.success == true) {
                                $('#cart_table').load('http://localhost/mypos/sale/cart_data', function() {
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
                $('#qty_item').val($(this).data('qty'))
                $('#total_before').val($(this).data('price') * $(this).data('qty'))
                $('#discount_item').val($(this).data('discount'))
                $('#total_item').val($(this).data('total'))
            })

            //hitung yang di cart
            function count_edit_modal() {
                var price = $('#price_item').val()
                var qty = $('#qty_item').val()
                var discount = $('#discount_item').val()

                total_before = price * qty
                $('#total_before').val(total_before)

                total = (price - discount) * qty
                $('#total_item').val(total)

                if (discount == '') {
                    $('#discount_item').val(0)
                }
            }

            //saat ditekan atau di click
            $(document).on('keyup mouseup', '#price_item, #qty_item, #discount_item', function() {
                count_edit_modal()
            })

            // edit
            $(document).on('click', '#edit_cart', function() {
                var cart_id = $('#cartid_item').val()
                var price = $('#price_item').val()
                var qty = $('#qty_item').val()
                var discount = $('#discount_item').val()
                var total = $('#total_item').val()
                var stock = $('#stock_item').val()
                if (price == '' || price < 1) {
                    alert('Harga tidak boleh kosong')
                    $('#pice_item').focus()
                } else if (qty == '' || qty < 1) {
                    alert('Qty tidak boleh kosong')
                    $('#qty_item').focus()
                } else if (parseInt(qty) > parseInt(stock)) {
                    alert('Stock tidak mencukupi')
                    $('#qty_item').focus()
                } else {
                    $.ajax({
                        type: 'POST',
                        url: 'http://localhost/mypos/sale/process',
                        data: {
                            'edit_cart': true,
                            'cart_id': cart_id,
                            'price': price,
                            'qty': qty,
                            'discount': discount,
                            'total': total
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                $('#cart_table').load('http://localhost/mypos/sale/cart_data', function() {
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

            //hitung yang dibawah cart
            function calculate() {
                var subtotal = 0;
                $('#cart_table tr').each(function() {
                    subtotal += parseInt($(this).find('#total').text())
                })
                isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

                var discount = $('#discount').val()
                var grand_total = 0

                grand_total += (parseInt(subtotal) + parseInt(discount))

                if (isNaN(grand_total)) {
                    $('#grand_total').val(0)
                    $('#grand_total2').text(0)
                } else {
                    $('#grand_total').val(grand_total)
                    $('#grand_total2').text(grand_total)
                }

                var cash = $('#cash').val();
                cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0)

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
                var customer_id = $('#customer').val()
                var subtotal = $('#sub_total').val()
                var discount = $('#discount').val()
                var grandtotal = $('#grand_total').val()
                var cash = $('#cash').val()
                var change = $('#change').val()
                var note = $('#note').val()
                var date = $('#date').val()
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
                            url: 'http://localhost/mypos/sale/process',
                            data: {
                                'process_payment': true,
                                'customer_id': customer_id,
                                'subtotal': subtotal,
                                'discount': discount,
                                'grandtotal': grandtotal,
                                'cash': cash,
                                'change': change,
                                'note': note,
                                'date': date
                            },
                            dataType: 'json',
                            success: function(result) {
                                if (result.success) {
                                    alert('Transaksi berhasil');
                                    window.open('http://localhost/mypos/sale/cetak/' + result.sale_id,
                                        '_blank')
                                } else {
                                    alert('Transaksi gagal');
                                }
                                location.href = 'http://localhost/mypos/sale'
                            }
                        })
                    }
                }
            })

            $(document).on('click', '#cancel_payment', function() {
                if (confirm('Batalkan?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'http://localhost/mypos/sale/cart_del',
                        dataType: 'json',
                        data: {
                            'cancel_payment': true
                        },
                        success: function(result) {
                            if (result.success == true) {
                                $('#cart_table').load('http://localhost/mypos/sale/cart_data', function() {
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
