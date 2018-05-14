 @extends('layouts.app')
@section('content')
{{ Counter::show('home') }}
<?php Counter::showAndCount('home','home') ?>
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
            <?php
        $string = strip_tags($hotnews[$key1]->Hotnews_detail);
        $string2 = strip_tags($hotnews[$key1]->Hotnews_name);
        if (strlen($string2) >= 22) {

            // truncate string
            $stringCut2 = iconv_substr($string, 0, 24, "UTF-8");

        }else {
          $stringCut2 = $hotnews[$key1]->Hotnews_name;

        }
        if (strlen($string) >= 135) {

            // truncate string
            $stringCut = iconv_substr($string, 0, 135, "UTF-8");

        }else {
          $stringCut = $hotnews[$key1]->Hotnews_detail;

        }

              ?>
              <div class="card-block">
                  <h4 class="card-title">{{ $stringCut2 }}...</h4>

              </div>

              <p class="card-block" style="word-break:break-all; height:100px;">{{ $stringCut }}...</p>
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
                        <a href="/advertise" class="btn btn-danger" role="button">อ่านทั้งหมด</a>
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
        <div class="blockquote-box blockquote-danger clearfix">
            <div class="square pull-left">
                <img src="<?php echo "hotnew/".$hotnews2[0]->Hotnews_img ?>" style="width:150px; height:125px;">
            </div>
            <?php
          $stringhot = strip_tags($hotnews2[0]->Hotnews_detail);
          $stringhot2 = strip_tags($hotnews2[0]->Hotnews_name);
          if (strlen($stringhot2) >= 22) {

            // truncate string
            $stringCuthot2 = iconv_substr($stringhot2, 0, 24, "UTF-8");

          }else {
          $stringCuthot2 = $hotnews2[0]->Hotnews_name;

          }
          if (strlen($stringhot) >= 122) {

            // truncate string
            $stringCuthot = iconv_substr($stringhot, 0, 122, "UTF-8");

          }else {
          $stringCuthot = $hotnews2[0]->Hotnews_detail;

          }

              ?>

            <h4>{{ $stringCuthot2 }}..</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[0]->datefirst }}
            @if($hotnews2[0]->datelast)
           - {{ $hotnews2[0]->datelast }}
            @endif

            <p>{{ $stringCuthot }}..</p>
        </div>
        @if(isset($hotnews2[4]))
        <div class="blockquote-box blockquote-danger clearfix">
          <div class="square pull-left">
              <img src="<?php echo "hotnew/".$hotnews2[4]->Hotnews_img ?>" style="width:150px; height:125px;">
          </div>
          <?php
        $stringhot3 = strip_tags($hotnews2[4]->Hotnews_name);
        $stringnew3 = strip_tags($hotnews2[4]->Hotnews_detail);
        if (strlen($stringhot3) >= 22) {

          // truncate string
        $stringCutname3 = iconv_substr($stringhot3, 0, 22, "UTF-8");

        }else {
        $stringCutname3 = $hotnews2[4]->Hotnews_name;

        }
        if (strlen($stringnew3) >= 122) {

          // truncate string
          $stringCutdetail3 = iconv_substr($stringnew3, 0, 122, "UTF-8");

        }else {
          $stringCutdetail3 = $hotnews2[4]->Hotnews_detail;

        }

            ?>
          <h4>{{ $stringCutname3 }}..</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[4]->datefirst }}
          @if($hotnews2[4]->datelast)
         - {{ $hotnews2[4]->datelast }}
          @endif

          <p>{{ $stringCutdetail3 }}..</p>
        </div>
        @endif
        @if(isset($hotnews2[2]))
        <div class="blockquote-box blockquote-danger clearfix">
          <div class="square pull-left">
              <img src="<?php echo "hotnew/".$hotnews2[2]->Hotnews_img ?>" style="width:150px; height:125px;">
          </div>
          <?php
        $stringhot4 = strip_tags($hotnews2[2]->Hotnews_name);
        $stringnew4 = strip_tags($hotnews2[2]->Hotnews_detail);
        if (strlen($stringhot4) >= 22) {

          // truncate string
        $stringCutname4 = iconv_substr($stringhot4, 0, 22, "UTF-8");

        }else {
        $stringCutname4 = $hotnews2[2]->Hotnews_name;

        }
        if (strlen($stringnew4) >= 122) {

          // truncate string
          $stringCutdetail4 = iconv_substr($stringnew4, 0, 122, "UTF-8");

        }else {
          $stringCutdetail4 = $hotnews2[2]->Hotnews_detail;

        }

            ?>
          <h4>{{ $stringCutname4 }}..</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[2]->datefirst }}
          @if($hotnews2[2]->datelast)
         - {{ $hotnews2[2]->datelast }}
          @endif

          <p>{{ $stringCutdetail4 }}..</p>
        </div>
@endif
    </div>

      @if(isset($hotnews2[1]))
    <div class="col-md-6">
        <div class="blockquote-box blockquote-danger clearfix">
          <div class="square pull-left">
              <img src="<?php echo "hotnew/".$hotnews2[1]->Hotnews_img ?>" style="width:150px; height:125px;">
          </div>
          <?php
        $stringhot5 = strip_tags($hotnews2[1]->Hotnews_name);
        $stringnew5 = strip_tags($hotnews2[1]->Hotnews_detail);
        if (strlen($stringhot5) >= 22) {

          // truncate string
        $stringCutname5 = iconv_substr($stringhot5, 0, 22, "UTF-8");

        }else {
        $stringCutname5 = $hotnews2[1]->Hotnews_name;

        }
        if (strlen($stringnew5) >= 122) {

          // truncate string
          $stringCutdetail5 = iconv_substr($stringnew5, 0, 122, "UTF-8");

        }else {
          $stringCutdetail5 = $hotnews2[1]->Hotnews_detail;

        }

            ?>
          <h4>{{ $stringCutname5 }}..</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[1]->datefirst }}
          @if($hotnews2[1]->datelast)
         - {{ $hotnews2[1]->datelast }}
          @endif

          <p>{{ $stringCutdetail5 }}..</p>
        </div>
        @endif
        @if(isset($hotnews2[3]))
        <div class="blockquote-box blockquote-danger clearfix">
          <div class="square pull-left">
              <img src="<?php echo "hotnew/".$hotnews2[3]->Hotnews_img ?>" style="width:150px; height:125px;">
          </div>
          <?php
        $stringhot6 = strip_tags($hotnews2[3]->Hotnews_name);
        $stringnew6 = strip_tags($hotnews2[3]->Hotnews_detail);
        if (strlen($stringhot6) >= 22) {

          // truncate string
        $stringCutname6 = iconv_substr($stringhot6, 0, 22, "UTF-8");

        }else {
        $stringCutname6 = $hotnews2[3]->Hotnews_name;

        }
        if (strlen($stringnew6) >= 122) {

          // truncate string
          $stringCutdetail6 = iconv_substr($stringnew6, 0, 122, "UTF-8");

        }else {
          $stringCutdetail6 = $hotnews2[3]->Hotnews_detail;

        }

            ?>
          <h4>{{ $stringCutname6 }}..</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[3]->datefirst }}
          @if($hotnews2[3]->datelast)
         - {{ $hotnews2[3]->datelast }}
          @endif

          <p>{{ $stringCutdetail6 }}..</p>
        </div>
        @endif
        @if(isset($hotnews2[5]) )
        <div class="blockquote-box blockquote-danger clearfix">
          <div class="square pull-left">
              <img src="<?php echo "hotnew/".$hotnews2[5]->Hotnews_img ?>" style="width:150px; height:130px;">
          </div>
          <?php
        $stringhot7 = strip_tags($hotnews2[5]->Hotnews_name);
        $stringnew7 = strip_tags($hotnews2[5]->Hotnews_detail);
        if (strlen($stringhot7) >= 22) {

          // truncate string
        $stringCutname7 = iconv_substr($stringhot7, 0, 22, "UTF-8");

        }else {
        $stringCutname7 = $hotnews2[5]->Hotnews_name;

        }
        if (strlen($stringnew7) >= 122) {

          // truncate string
          $stringCutdetail7 = iconv_substr($stringnew7, 0, 122, "UTF-8");

        }else {
          $stringCutdetail7 = $hotnews2[5]->Hotnews_detail;

        }

            ?>
          <h4>{{ $stringCutname7 }}..</h4><span class="glyphicon glyphicon-calendar"></span>{{ $hotnews2[5]->datefirst }}
          @if($hotnews2[5]->datelast)
         - {{ $hotnews2[5]->datelast }}
          @endif

          <p>{{ $stringCutdetail7 }}..</p>
        </div>
        @endif
    </div>
</div>
@endif
<br>




<div class="row text-center">


    <div class="col-md-12 text-center">
      <div class="ficon">
                    <a href="/activities" class="btn btn-danger" role="button">อ่านทั้งหมด</a>
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
                    <td>{{ $doccument[$key2]->doc_name }}</td>
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
                                <a href="/documentsh" class="btn btn-danger" role="button">อ่านทั้งหมด</a>
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
          ],
  hiddenDays: [ 0, 6 ]
        });

  });


</script>
@endpush
