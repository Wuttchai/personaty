@extends('layouts.app')
@section('content')

   <div class="row">
       <div class="col-md-12">




<hr width=80% size=3>

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="text-center">
      <h2>เอกสารที่เผยแพร่</h2>
    </div>
    <hr>
  </div>
  <div class="col-md-12 col-md-offset-3">
    <form  role="search"  method="GET">

  <div id="custom-search-input">
                   <div class="input-group col-md-6 text-center">
                       <input type="text" class="  search-query form-control" placeholder="Search" name="q"/>
                       <span class="input-group-btn">
                           <button class="btn btn-danger" type="button">
                               <span class=" glyphicon glyphicon-search"></span>
                           </button>
                       </span>
                   </div>
               </div>
               </form>
               <br>
</div>
</div>

@if($doccument->total() == 0)
<div class="alert alert-danger text-center" role="alert">
<strong>ไม่มีชื่อเอกสาร !</strong>   กรุณาตรวจสอบข้อมูลที่กรอกอีกครั้ง
</div>
@else
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
                  </tbody>
                </table>
              </div>
            </div>
            </div>

            <div class="row text-center">


                   <div class="col-md-12 text-center">
                     <div class="ficon">
                                   {{ $doccument->links() }}
                                 </div>
                   </div>
               </div>


@endif



<br>
<br>
       </div>
   </div>

@endsection
@push('scripts')

@endpush
