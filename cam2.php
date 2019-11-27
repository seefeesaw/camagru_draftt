<video id="player" controls autoplay></video>
<button id="capture">Capture</button>
<form method="POST">
<button id="save" type="submit" name="submit">Save</button> 
<img id="lolo" name="lolo"  src="">
<input id="zain" type="text" name="lolo">
</form>
<canvas id="canvas" width=320 height=240></canvas>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php

if (isset($_POST['lolo']))
{
    if (!file_exists('gallary/')) {
        mkdir('gallary/', 0777, true);
	}
	echo "are we geting in here";
	$upload_dir = "gallary/";
	var_dump($_POST);
	$img = $_POST['lolo'];
     $img = str_replace('data:image/png;base64,', '', $img);
    // $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $name = mktime();
   	$file = $upload_dir . $name . ".png";
	file_put_contents($file, $data);
	echo $img;
}

?>
<script>
  const player = document.getElementById('player');
  const canvas = document.getElementById('canvas');
  const context = canvas.getContext('2d');
  const captureButton = document.getElementById('capture');

  const constraints = {
    video: true,
  };

  captureButton.addEventListener('click', () => {
    // Draw the video frame to the canvas.
    context.drawImage(player, 0, 0, canvas.width, canvas.height);
	document.getElementById('lolo').src = canvas.toDataURL();
	document.getElementById('zain').value = canvas.toDataURL();
  });

  // Attach the video stream to the video element and autoplay.
  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      player.srcObject = stream;
    });

    /* Get from elements values */
var values = $(this).serialize();
// var ajx_obj = new XMLHttpRequest();

/* ajx_obj.open('POST', "cam2.php", true);
ajx_obj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
ajx_obj.send("image="+canßvas.toDataURL('image/png'));*/


</script>