
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
                        <strong>{{ $date[0]->address_name }}</strong><br>
                        <h5 >ที่อยู่ : {{ $date[0]->address_at }} ต.{{ $date[0]->address_tumbon }} อ.{{ $date[0]->address_aumpor }}</h5>
                        <h5 > จ.{{ $date[0]->address_province }}
                        เบอร์โทร: {{ $date[0]->address_tel }}</h5>

                      </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      <address>
                        <strong>เลขที่ใบเสร็จสินค้า #007612</strong><br><br>
                          รหัสการสั่งซื้อ: {{ $date[0]->Prosell_ID }}<br>
                          วันที่ซื้อ: {{ $date[0]->Prosell_creat }}<br>
                          ชื่อผู้ซื้อ:  {{ Auth::user()->User_Name }}
                      </address>
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

                                    @foreach ($Car as $product )

                                      <tr>
                                        <th scope="row">&nbsp;&nbsp;&nbsp;{{ $num }}</th>
                                        <td>{{ $product->Pro_Name }}</td>
                                        <td>&nbsp;{{ $product->Det_Num }} ชิ้น</td>
                                        <td>&nbsp;{{ number_format($product->Pro_Price) }} บาท</td>
                                        <td>&nbsp;{{ number_format($product->Det_Num * $product->Pro_Price) }} บาท</td>

                                      </tr>

                          <?php
                          $num ++;
                          $totalPirce += $product->Det_Num * $product->Pro_Price;
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
                      <p class="lead">วันที่สั่ง : {{ $date[0]->Prosell_creat }}</p>

                      <div class="table-responsive">
                        <table class="table">

                          <tr>
                            <th>รวมราคาทั้งหมด :</th>
                            <td>{{ number_format($totalPirce) }}บาท</td>
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
