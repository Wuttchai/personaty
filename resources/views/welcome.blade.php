@extends('layouts.app')

@section('content')
	<div id="results">ตัวอย่างรูป</div>

	<h1>กล้องถ่าย</h1>
	<h3>ขนาดภาพ 320x240 </h3>

	<div id="my_camera"></div>

	<form>
		<input type=button value="ถ่ายภาพ" onClick="take_snapshot()">
	</form>

	@endsection

	@push('scripts')

	<script src="{{ asset('js/text.js') }}"></script>
	<script language="JavaScript">

document.getElementById("results").style.display = "none";

	Webcam.set({
		width: 320,
		height: 240,
		image_format: 'jpeg',
		jpeg_quality: 90
	});
	Webcam.attach( '#my_camera' );

		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				console.log(data_uri);
				// display results in page
				document.getElementById('results').innerHTML =

					'<img src="'+data_uri+'"/>';
					document.getElementById("results").style.display = "block";

			} );
		}
	</script>
@endpush
