<!doctype html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>WebcamJS Test Page</title>
	<style type="text/css">
		body { font-family: Helvetica, sans-serif; }
		h2, h3 { margin-top:0; }
		form { margin-top: 15px; }
		form > input { margin-right: 15px; }
		#results { float:right; margin:20px; padding:20px; border:1px solid; background:#ccc; }
	</style>
</head>
<body>
	<div id="results">ตัวอย่างรูป</div>

	<h1>กล้องถ่าย</h1>
	<h3>ขนาดภาพ 320x240 </h3>

	<div id="my_camera"></div>

	<form>
		<input type=button value="Take Snapshot" onClick="take_snapshot()">
	</form>



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

</body>
</html>
