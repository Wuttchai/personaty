 @extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">


<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
    <li data-target="#myCarousel" data-slide-to="4"></li>

  </ol>



  <!-- Wrapper for slides -->
  <div class="carousel-inner">

  @foreach ($infos as $key => $info)

    @if ($key < 1)
    <div class="item active">
      <img src="<?php echo "images/".$infos[$key]->Info_Img ?>"  style="width:100%;">
      <div class="carousel-caption">


      </div>
    </div>

@else
        <div class="item">
          <img src=" <?php echo "images/".$infos[$key]->Info_Img ?>"  style="width:100%;">
          <div class="carousel-caption">


          </div>
        </div>
@endif
  @endforeach

  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>

</div>

<hr width=80% size=3>


		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="text-center">
					<h2>ข่าวประชาสัมพันธ์</h2>
				</div>
				<hr>
			</div>
		</div>




<div class="row " >
  @if($hotnews != '[]')
    @foreach ($hotnews as $key1 => $hotnew)


      <div class="col-md-4" >
          <div class="card"  >

          <a href="/hotnews/detail{{ $hotnews[$key1]->Hotnews_ID }}" class="text-dark">  <img src="<?php echo "hotnew/".$hotnews[$key1]->Hotnews_img ?>" style=" height:300px;">
              <div class="card-block">
                  <h4 class="card-title">{{ $hotnews[$key1]->Hotnews_name }}</h4>

              </div>
              <?php
          $string = strip_tags($hotnews[$key1]->Hotnews_detail);

          if (strlen($string) >= 150) {

              // truncate string
              $stringCut = iconv_substr($string, 0, 150, "UTF-8");

          }else {
            $stringCut = $hotnews[$key1]->Hotnews_detail;

          }

                ?>
              <p class="card-block" style="word-break:break-all; height:100px;">{{ $stringCut }}</p>
              <div class="card-footer">
                  <span class="float-right"><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews[$key1]->datefirst }}
                  @if($hotnews[$key1]->datelast)
                 - {{ $hotnews[$key1]->datelast }}
                  @endif</span>

              </div>
          </div>
          <br>
      </div>
</a>
@endforeach
@endif
  </div>
  </div>
  <br>
<div class="row text-center">
        <div class="col-md-12 text-center">
          <div class="ficon">
                        <a href="/advertise" class="btn btn-danger" role="button">อ่านทั่งหมด</a>
                      </div>
        </div>
    </div>
<hr width=80% size=3>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h2>ข่าวกิจกรรม</h2>
    </div>
    <hr>
  </div>
</div>


@if($hotnews2 != '[]')
<div class="row">

    <div class="col-md-6">
        <div class="blockquote-box  clearfix">
            <div class="square pull-left">
                <img src="<?php echo "hotnew/".$hotnews2[0]->Hotnews_img ?>" style="width:150px; height:120px;">
            </div>
            <h4>{{ $hotnews2[0]->Hotnews_name }} </h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[0]->datefirst }}
            @if($hotnews2[0]->datelast)
           - {{ $hotnews2[0]->datelast }}
            @endif
            <?php
        $string = strip_tags($hotnews2[0]->Hotnews_detail);

        if (strlen($string) >= 122) {

            // truncate string
            $stringCut = iconv_substr($string, 0, 122, "UTF-8");

        }else {
          $stringCut = $hotnews2[0]->Hotnews_detail;

        }

              ?>
            <p>{{ $stringCut }}</p>
        </div>
        @if($hotnews2[1] != '[]')
        <div class="blockquote-box blockquote-primary clearfix">
          <div class="square pull-left">
              <img src="<?php echo "hotnew/".$hotnews2[1]->Hotnews_img ?>" style="width:150px; height:120px;">
          </div>
          <h4>{{ $hotnews2[1]->Hotnews_name }}</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[1]->datefirst }}
          @if($hotnews2[1]->datelast)
         - {{ $hotnews2[1]->datelast }}
          @endif
          <?php
      $string = strip_tags($hotnews2[1]->Hotnews_detail);

      if (strlen($string) >= 122) {

          // truncate string
          $stringCut = iconv_substr($string, 0, 122, "UTF-8");

      }else {
        $stringCut = $hotnews2[1]->Hotnews_detail;

      }

            ?>
          <p>{{ $stringCut }}</p>
        </div>
        @endif
        @if($hotnews2[2] != '[]')
        <div class="blockquote-box blockquote-success clearfix">
          <div class="square pull-left">
              <img src="<?php echo "hotnew/".$hotnews2[2]->Hotnews_img ?>" style="width:150px; height:120px;">
          </div>
          <h4>{{ $hotnews2[2]->Hotnews_name }}</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[2]->datefirst }}
          @if($hotnews2[2]->datelast)
         - {{ $hotnews2[2]->datelast }}
          @endif
          <?php
      $string = strip_tags($hotnews2[2]->Hotnews_detail);

      if (strlen($string) >= 122) {

          // truncate string
          $stringCut = iconv_substr($string, 0, 122, "UTF-8");

      }else {
        $stringCut = $hotnews2[2]->Hotnews_detail;

      }

            ?>
          <p>{{ $stringCut }}</p>
        </div>

    </div>
      @endif
      @if($hotnews3[2] != '[]')
    <div class="col-md-6">
        <div class="blockquote-box blockquote-info clearfix">
          <div class="square pull-left">
              <img src="<?php echo "hotnew/".$hotnews2[3]->Hotnews_img ?>" style="width:150px; height:120px;">
          </div>
          <h4>{{ $hotnews2[3]->Hotnews_name }}</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[3]->datefirst }}
          @if($hotnews2[3]->datelast)
         - {{ $hotnews2[3]->datelast }}
          @endif
          <?php
      $string = strip_tags($hotnews2[3]->Hotnews_detail);

      if (strlen($string) >= 122) {

          // truncate string
          $stringCut = iconv_substr($string, 0, 122, "UTF-8");

      }else {
        $stringCut = $hotnews2[3]->Hotnews_detail;

      }

            ?>
          <p>{{ $stringCut }}</p>
        </div>
        @endif
        @if($hotnews2[4] != '[]')
        <div class="blockquote-box blockquote-warning clearfix">
          <div class="square pull-left">
              <img src="<?php echo "hotnew/".$hotnews2[4]->Hotnews_img ?>" style="width:150px; height:120px;">
          </div>
          <h4>{{ $hotnews2[4]->Hotnews_name }}</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[4]->datefirst }}
          @if($hotnews2[4]->datelast)
         - {{ $hotnews2[4]->datelast }}
          @endif
          <?php
      $string = strip_tags($hotnews2[4]->Hotnews_detail);

      if (strlen($string) >= 122) {

          // truncate string
          $stringCut = iconv_substr($string, 0, 122, "UTF-8");

      }else {
        $stringCut = $hotnews2[4]->Hotnews_detail;

      }

            ?>
          <p>{{ $stringCut }}</p>
        </div>
        @endif
        @if($hotnews2[5] != '[]')
        <div class="blockquote-box blockquote-danger clearfix">
          <div class="square pull-left">
              <img src="<?php echo "hotnew/".$hotnews2[5]->Hotnews_img ?>" style="width:150px; height:120px;">
          </div>
          <h4>{{ $hotnews2[5]->Hotnews_name }}</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[5]->datefirst }}
          @if($hotnews2[5]->datelast)
         - {{ $hotnews2[5]->datelast }}
          @endif
          <?php
      $string = strip_tags($hotnews2[5]->Hotnews_detail);

      if (strlen($string) >= 122) {

          // truncate string
          $stringCut = iconv_substr($string, 0, 122, "UTF-8");

      }else {
        $stringCut = $hotnews2[5]->Hotnews_detail;

      }

            ?>
          <p>{{ $stringCut }}</p>
        </div>
        @endif
    </div>
</div>
@endif
<br>




<div class="row text-center">


    <div class="col-md-12 text-center">
      <div class="ficon">
                    <a href="/activities" class="btn btn-danger" role="button">อ่านทั่งหมด</a>
                  </div>
    </div>
</div>


<hr width=80% size=3>
<div class="row">
  <div class="col-md-6 ">
    <div class="text-center">
      <h2>เอกสารที่เผยแพร่</h2>
    </div>
    <hr>
  </div>
  <div class="col-md-6 ">
    <div class="text-center">
      <h2>วันที่ปิดเข้าเยี่ยม</h2>
    </div>
    <hr>
  </div>
</div>
<div class="col-md-6">
<div class="box box-danger">

            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin text-center">
                  <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อไฟล์</th>
                    <th>จัดการ</th>

                  </tr>
                  </thead>
                  <tbody>
                    @if($doccument != '[]')
                  @foreach($doccument as $key2 => $doccuments)

                  <tr>
                    <td>{{ $key2+1 }}</td>
                    <td>{{ $doccument[$key2]->doc_file }}</td>
                    <td><a href="/pdf/view/<?php echo $doccument[$key2]->doc_id ?>" target="_blank" ><button type="button" class="btn btn-default btn-lm btn-warning">
                              <span class="glyphicon glyphicon glyphicon-file"></span> แสดงตัวอย่าง
                            </button>
                            </a>

                       <a href="/pdf/<?php echo $doccument[$key2]->doc_file ?>" target="_blank" download><button type="button" class="btn btn-default btn-lm btn-danger">
                                 <span class="glyphicon glyphicon-download-alt"></span> ดาวห์โหลด
                               </button>  </a></td>

                  </tr>

                  @endforeach
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
            </div>


                  <div class="ficon text-center">
                                <a href="/documentsh" class="btn btn-danger" role="button">อ่านทั่งหมด</a>
                              </div>
                </div>
                <div class="col-md-6">
                <div class="box box-danger">

                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="table-responsive">

                              <div  id='calendar'></div>
                              </div>
                            </div>
                            </div>



                                </div>
            </div>
            <br>
            <br>
 </div>

<br>
<br>
        </div>
    </div>

@endsection
@push('scripts')
<script>

  $(document).ready(function() {
      $('#calendar').fullCalendar({
        events : [
              @foreach($tasks as $task)
              {
                  title : '{{ $task->cal_name }}',
                  start : '{{ $task->cal_date }}',
                  color: 'red',
                  end:     '{{ $task->cal_last }}',
                  displayEventTime: false
              },
              @endforeach
          ]});

  });


</script>
@endpush
