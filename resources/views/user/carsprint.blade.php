
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ใบเสร็จสินค้า</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/testboot.css') }}">


</head>
<body onload="window.print();">
  <div class="container"  id="information"  >
  <div class="loader" id="loader"></div>
     <div class="row justify-content-center" >

       <div class="container">




          <!-- /.col-lg-3 -->

          <div class="col-lg-12 ">




            <!-- /.row -->
            <section class="invoice">
                  <!-- title row -->
                  <div class="row">
                    <div class="col-xs-12">
                      <h2 class="page-header">
                        <i class="fa fa-globe"></i> ใบเสร็จสินค้า
                        <small class="pull-right">วันที่: 2/10/2014</small>
                      </h2>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- info row -->
                  <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                      จาก
                      <address>
                        <strong>เรือนจำจังหวัดพระนครศรีอยุธยา.</strong><br>
                        เลขที่ 123, หมู่ที่ 3<br>
                        ต.หันตรา, อ.พระนครศรีอยุธยา<br>

                        จังหวัดพระนครศรีอยุธยา, 13000<br>
                        เบอร์โทร: 035 709 113<br>

                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      ถึง
                      <address>
                        <strong>{{ Auth::user()->User_Name }}</strong><br>
                        {{ Auth::user()->User_Address }}<br>
                        Phone: {{ Auth::user()->User_Tel }}<br>
                        Email: {{ Auth::user()->email }}
                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      <b>Invoice #007612</b><br>
                      <br>
                      <b>Order ID:</b> 4F3S8J<br>
                      <b>Payment Due:</b> 2/22/2014<br>
                      <b>Account:</b> 968-34567
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <!-- Table row -->
                  <div class="row">
                    <div class="col-xs-12 table-responsive">
                      <table class="table table-striped">
                        <thead>
                        <tr>
                          <th>ลำดับ</th>
                          <th>ชื่อสินค้า</th>
                          <th>จำนวน</th>
                          <th>ราคาต่อชิ้น</th>
                          <th>ราคารวม</th>

                        </tr>
                        </thead>
                        <tbody>

                          <?php
                          $num =1;
                          $totalPirce =0;
                          ?>

                                    @foreach (Cart::content() as $key1 => $product)

                                      <tr>
                                        <th scope="row">&nbsp;&nbsp;&nbsp;{{ $num }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>&nbsp;{{ $product->qty }} ชิ้น</td>
                                        <td>&nbsp;{{ $product->price }} บาท</td>
                                        <td>&nbsp;{{ $product->qty * $product->price }} บาท</td>

                                      </tr>

                          <?php
                          $num ++;
                          $totalPirce += $product->qty * $product->price;
                          ?>
                                       @endforeach

                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">

                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                      <p class="lead">Amount Due {{ Session::get('date') }}</p>

                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th style="width:50%">ราคาสินค้าทั้งหมด :</th>
                            <td>{{ Cart::subtotal() }} บาท</td>
                          </tr>
                          <tr>
                            <th>ภาษี :</th>
                            <td>{{ Cart::tax() }} บาท</td>
                          </tr>
                          <tr>
                            <th>รวมราคาทั้งหมด :</th>
                            <td>{{ Cart::total() }} บาท</td>
                          </tr>

                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <!-- this row will not appear when printing -->

                </section>
          </div>
          <!-- /.col-lg-12 -->

        </div>
        <!-- /.row -->

      </div>


         </div>
<!-- ./wrapper -->
</body>
</html>
