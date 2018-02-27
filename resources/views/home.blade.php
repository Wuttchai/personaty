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
        <h3>{{ $infos[$key]->Info_Name }}</h3>

      </div>
    </div>

@else
        <div class="item">
          <img src=" <?php echo "images/".$infos[$key]->Info_Img ?>"  style="width:100%;">
          <div class="carousel-caption">
            <h3>{{ $infos[$key]->Info_Name }}</h3>

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



<div class="row text-center">
    @foreach ($hotnews as $key1 => $hotnew)

      <div class="col-md-4">
<a href="#" class="text-dark">
          <h4>{{ $hotnews[$key1]->Hotnews_Name }}</h4>
          <p> <span class="glyphicon glyphicon-calendar"></span>{{ $hotnews[$key1]->datefirst }}</p>
          <img src="<?php echo "hotnew/".$hotnews[$key1]->Hotnews_img ?>" alt="xxx" class="img-thumbnail">
          <br>
          <br>
          <p>{{ $hotnews[$key1]->Hotnews_detail }}</p>
            </a>


      </div>
@endforeach
  </div>
  <br>




<div class="row text-center">


        <div class="col-md-12 text-center">
          <div class="ficon">
                        <a href="#" class="btn btn-danger" role="button">Read more</a>
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



<div class="row text-center">
@foreach ($hotnews as $key1 => $hotnew)

  <div class="col-md-4">
<a href="#" class="text-dark">
      <h4>{{ $hotnews[$key1]->Hotnews_Name }}</h4>
      <p> <span class="glyphicon glyphicon-calendar"></span>{{ $hotnews[$key1]->datefirst }}</p>
      <img src="<?php echo "hotnew/".$hotnews[$key1]->Hotnews_img ?>" alt="xxx" class="img-thumbnail">
      <br>
      <br>

      <p>{{ $hotnews[$key1]->Hotnews_detail }}</p>
      <div class="ficon">
        </a>
      </div>

  </div>
@endforeach
</div>
<br>




<div class="row text-center">


    <div class="col-md-12 text-center">
      <div class="ficon">
                    <a href="#" class="btn btn-danger" role="button">Read more</a>
                  </div>
    </div>
</div>


<hr width=80% size=3>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h2>เอกสารที่เผยแพร่</h2>
    </div>
    <hr>
  </div>
</div>
<ul class="nav  nav-pills nav-justified ">
   <li class="active"><a data-toggle="tab" href="#home" class="text-dark">แบบฟอร์มเข้าเยี่ยม</a></li>
   <li><a data-toggle="tab" href="#menu1" class="text-dark">แบบฟอร์มเข้าเยี่ยมนอกเวลา</a></li>
   <li><a data-toggle="tab" href="#menu2" class="text-dark">เอกสารสำหรับการประกันตัว</a></li>
   <li><a data-toggle="tab" href="#menu3" class="text-dark">แบบฟอร์มการขอย้ายผู้ต้องขัง</a></li>
 </ul>

 <div class="tab-content">
   <div id="home" class="tab-pane fade in active text-center">
     <br>
     <h4>แบบฟอร์มเข้าเยี่ยม</h4>
     <br>
     <p>เนื้อหาของเพลงจะทำให้ผู้ที่ได้รับฟังรู้สึกอยากที่จะมอบความรักให้กับคนรัก หรือแม้แต่เวลาคนรักทะเลาะกัน ก็ยังสามารถส่งเพลงนี้เพื่อง้อกันได้เช่นกัน</p>
<br>
     <button type="button" class="btn btn-default btn-lm btn-danger">
               <span class="glyphicon glyphicon-download-alt"></span> ดาวห์โหลด
             </button>

   </div>
   <div id="menu1" class="tab-pane fade text-center">
     <br>
     <h4>เอกสารสำหรับการประกันตัว</h4>
     <p>เนื้อหาของเพลงจะทำให้ผู้ที่ได้รับฟังรู้สึกอยากที่จะมอบความรักให้กับคนรัก หรือแม้แต่เวลาคนรักทะเลาะกัน ก็ยังสามารถส่งเพลงนี้เพื่อง้อกันได้เช่นกัน</p>
     <button type="button" class="btn btn-default btn-lm btn-danger">
               <span class="glyphicon glyphicon-download-alt"></span> ดาวห์โหลด
             </button>
   </div>
   <div id="menu2" class="tab-pane fade text-center">
     <br>
     <h4>แบบฟอร์มเข้าเยี่ยม</h4>
     <p>เนื้อหาของเพลงจะทำให้ผู้ที่ได้รับฟังรู้สึกอยากที่จะมอบความรักให้กับคนรัก หรือแม้แต่เวลาคนรักทะเลาะกัน ก็ยังสามารถส่งเพลงนี้เพื่อง้อกันได้เช่นกัน</p>
     <button type="button" class="btn btn-default btn-lm btn-danger">
               <span class="glyphicon glyphicon-download-alt"></span> ดาวห์โหลด
             </button>

   </div>
   <div id="menu3" class="tab-pane fade text-center">
     <br>
     <h4>แบบฟอร์มการขอย้ายผู้ต้องขัง</h4>
     <p>เนื้อหาของเพลงจะทำให้ผู้ที่ได้รับฟังรู้สึกอยากที่จะมอบความรักให้กับคนรัก หรือแม้แต่เวลาคนรักทะเลาะกัน ก็ยังสามารถส่งเพลงนี้เพื่อง้อกันได้เช่นกัน</p>
     <button type="button" class="btn btn-default btn-lm btn-danger">
               <span class="glyphicon glyphicon-download-alt"></span> ดาวห์โหลด
             </button>
     </div>
 </div>

<br>
<br>
        </div>
    </div>

@endsection
@push('scripts')

@endpush
