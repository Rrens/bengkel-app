@extends('components.master')

@section('container')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
                                <tr>
                                    <td style="vertical-align: top;">
                                        <label for="date">Date</label>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date" id="date" value="2023-12-09" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top; width:30%">
                                        <label for="user">Kasir</label>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="user" value="fanani" class="form-control"
                                                readonly>
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

                                                <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

                                                    <h4>A PHP Error was encountered</h4>

                                                    <p>Severity: Warning</p>
                                                    <p>Message: Undefined variable $customer</p>
                                                    <p>Filename: transaction/sale_form.php</p>
                                                    <p>Line Number: 46</p>


                                                    <p>Backtrace:</p>






                                                    <p style="margin-left:10px">
                                                        File:
                                                        C:\laragon\www\awrmotor\application\views\transaction\sale_form.php<br />
                                                        Line: 46<br />
                                                        Function: _error_handler </p>








                                                    <p style="margin-left:10px">
                                                        File:
                                                        C:\laragon\www\awrmotor\application\libraries\Template.php<br />
                                                        Line: 14<br />
                                                        Function: view </p>




                                                    <p style="margin-left:10px">
                                                        File:
                                                        C:\laragon\www\awrmotor\application\controllers\Transaction.php<br />
                                                        Line: 13<br />
                                                        Function: load </p>






                                                    <p style="margin-left:10px">
                                                        File: C:\laragon\www\awrmotor\index.php<br />
                                                        Line: 315<br />
                                                        Function: require_once </p>




                                                </div>
                                                <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

                                                    <h4>A PHP Error was encountered</h4>

                                                    <p>Severity: Warning</p>
                                                    <p>Message: foreach() argument must be of type array|object, null given
                                                    </p>
                                                    <p>Filename: transaction/sale_form.php</p>
                                                    <p>Line Number: 46</p>


                                                    <p>Backtrace:</p>






                                                    <p style="margin-left:10px">
                                                        File:
                                                        C:\laragon\www\awrmotor\application\views\transaction\sale_form.php<br />
                                                        Line: 46<br />
                                                        Function: _error_handler </p>








                                                    <p style="margin-left:10px">
                                                        File:
                                                        C:\laragon\www\awrmotor\application\libraries\Template.php<br />
                                                        Line: 14<br />
                                                        Function: view </p>




                                                    <p style="margin-left:10px">
                                                        File:
                                                        C:\laragon\www\awrmotor\application\controllers\Transaction.php<br />
                                                        Line: 13<br />
                                                        Function: load </p>






                                                    <p style="margin-left:10px">
                                                        File: C:\laragon\www\awrmotor\index.php<br />
                                                        Line: 315<br />
                                                        Function: require_once </p>




                                                </div>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="box box-widget">
                        <div class="box-body">
                            <table>
                                <tr>
                                    <td style="vertical-align: top; width:30%">
                                        <label for="barcode">ID Item</label>
                                    </td>
                                    <td>
                                        <div class="form-group input-group">
                                            <input type="hidden" id="item_id">
                                            <input type="hidden" id="price">
                                            <input type="hidden" id="stock">
                                            <input type="hidden" id="qty_cart">
                                            <input type="text" id="barcode" class="form-control" autofocus>
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
                                    <td style="vertical-align: top;">
                                        <label for="permintaan">Permintaan</label>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" id="permintaan" value="1" min="1"
                                                class="form-control">
                                        </div>
                                    </td>

                                    <td style="vertical-align: top;">
                                        <label for=""></label>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" id="add_cart" class="btn btn-block btn-primary">
                                                <i class="fa fa-cart-plus"> Add</i>
                                            </button>
                                        </div>
                                    </td>

                                    <!-- <td style="vertical-align: top;">
                                        <div>
                                            <button type="button" id="add_cart" class="btn btn-block btn-primary">
                                                <i class="fa fa-cart-plus"> Add</i>
                                            </button>
                                        </div>
                                    </td> -->
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="box box-widget">
                        <div class="box-body">
                            <div align="right">
                                <h4>Invoice
                                    <!-- <b><span id="invoice">
        <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

        <h4>A PHP Error was encountered</h4>

        <p>Severity: Warning</p>
        <p>Message:  Undefined variable $invoice</p>
        <p>Filename: transaction/sale_form.php</p>
        <p>Line Number: 132</p>


         <p>Backtrace:</p>






           <p style="margin-left:10px">
           File: C:\laragon\www\awrmotor\application\views\transaction\sale_form.php<br />
           Line: 132<br />
           Function: _error_handler			</p>








           <p style="margin-left:10px">
           File: C:\laragon\www\awrmotor\application\libraries\Template.php<br />
           Line: 14<br />
           Function: view			</p>




           <p style="margin-left:10px">
           File: C:\laragon\www\awrmotor\application\controllers\Transaction.php<br />
           Line: 13<br />
           Function: load			</p>






           <p style="margin-left:10px">
           File: C:\laragon\www\awrmotor\index.php<br />
           Line: 315<br />
           Function: require_once			</p>




        </div></span></b> -->
                                </h4>
                                <h1>
                                    <b><span id="grand_total2" style="font-size: 50pt;">0</span></b>
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
                                        <th width="15%">Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="cart_table">

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
                                <tr>
                                    <td style="vertical-align: top; width:30%">
                                        <label for="sub_total">Sub Total</label>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" id="sub_total" value="" class="form-control"
                                                readonly>
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
                                            <input type="number" id="grand_total" class="form-control" readonly>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="box box-widget">
                        <div class="box-body">
                            <table width="100%">
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
                                            <input type="number" id="change" class="form-control" readonly>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="box box-widget">
                        <div class="box-body">
                            <table width="100%">
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
                        <table class="table table-bordered table-striped" id="table1">
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

                                <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

                                    <h4>A PHP Error was encountered</h4>

                                    <p>Severity: Warning</p>
                                    <p>Message: Undefined variable $item</p>
                                    <p>Filename: transaction/sale_form.php</p>
                                    <p>Line Number: 292</p>


                                    <p>Backtrace:</p>






                                    <p style="margin-left:10px">
                                        File: C:\laragon\www\awrmotor\application\views\transaction\sale_form.php<br />
                                        Line: 292<br />
                                        Function: _error_handler </p>








                                    <p style="margin-left:10px">
                                        File: C:\laragon\www\awrmotor\application\libraries\Template.php<br />
                                        Line: 14<br />
                                        Function: view </p>




                                    <p style="margin-left:10px">
                                        File: C:\laragon\www\awrmotor\application\controllers\Transaction.php<br />
                                        Line: 13<br />
                                        Function: load </p>






                                    <p style="margin-left:10px">
                                        File: C:\laragon\www\awrmotor\index.php<br />
                                        Line: 315<br />
                                        Function: require_once </p>




                                </div>
                                <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

                                    <h4>A PHP Error was encountered</h4>

                                    <p>Severity: Warning</p>
                                    <p>Message: foreach() argument must be of type array|object, null given</p>
                                    <p>Filename: transaction/sale_form.php</p>
                                    <p>Line Number: 292</p>


                                    <p>Backtrace:</p>






                                    <p style="margin-left:10px">
                                        File: C:\laragon\www\awrmotor\application\views\transaction\sale_form.php<br />
                                        Line: 292<br />
                                        Function: _error_handler </p>








                                    <p style="margin-left:10px">
                                        File: C:\laragon\www\awrmotor\application\libraries\Template.php<br />
                                        Line: 14<br />
                                        Function: view </p>




                                    <p style="margin-left:10px">
                                        File: C:\laragon\www\awrmotor\application\controllers\Transaction.php<br />
                                        Line: 13<br />
                                        Function: load </p>






                                    <p style="margin-left:10px">
                                        File: C:\laragon\www\awrmotor\index.php<br />
                                        Line: 315<br />
                                        Function: require_once </p>




                                </div>
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
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Update Product Item</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="cartid_item">
                        <div class="form-group">
                            <label for="product_item">Product Item</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" id="barcode_item" class="form-control" readonly>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="product_item" class="form-control" readonly>
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
                                    <input type="number" id="stock_item" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="total_before">Total before Discount</label>
                            <input type="number" id="total_before" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="discount_item">Discount per Item</label>
                            <input type="number" id="discount_item" min="0" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="total_item">Total after Discount</label>
                            <input type="number" id="total_item" class="form-control" readonly>
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
    @endpush

    @push('scripts')
    @endpush
@endsection
