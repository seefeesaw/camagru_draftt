<html>
<head>
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<meta name="viewport" content="height=device-height, initial-scale=1.0">
	<title>cAmAgru | Home</title>
	<link href="./main.css" rel="stylesheet">
</head>
<?php
session_start();
if (isset($_SESSION['loggedin']) == false || $_SESSION['loggedin'] == false)
{
	//header("location:http://localhost:8080/zain/index.php");
}
?>
<body>
	<div id="top-nav">
		<div id="title" class="top-nav"><a href="/">cAmAgru</a></div>
		<div id="gallery" class="top-nav"><a href="./gallary/gallary.php">Gallery</a></div>
		<div id="pref" class="top-nav"><a href="./config/pref.php">Preferences</a></div>
		<div id="logout" class="top-nav"><a href="./config/logout.php">Log Out</a></div>
	</div>
	
	<div id="top-pics">
		<div id="vidiv">
			<video autoplay="true" id="vid"></video>
		</div>
		<canvas id="canv"></canvas>
		<div id="right">
			<div id="description">Click an image to preview</div>
			<div id="allpics">
				<img class="pics" id="pic1" onclick="selectPic('pic1')" src="./images/Emoji/1f4a4.png"/>
				<img class="pics" id="pic2" onclick="selectPic('pic2')" src="./images/Emoji/1f4a9.png"/>
				<img class="pics" id="pic3" onclick="selectPic('pic3')" src="./images/Emoji/1f4a2.png"/>
				<img class="pics" id="pic4" onclick="selectPic('pic4')" src="./images/Emoji/1f4ae.png"/>
				<img class="pics" id="pic5" onclick="selectPic('pic5')" src="./images/Emoji/1f6ab.png"/>
				<img class="pics" id="pic6" onclick="selectPic('pic6')" src="./images/Emoji/1f48b.png"/>
				<img class="pics" id="pic7" onclick="selectPic('pic7')" src="./images/Emoji/1f49e.png"/>
				<img class="pics" id="pic8" onclick="selectPic('pic8')" src="./images/Emoji/1f49f.png"/>
			</div>
		</div>
	</div>
	<div id="belowbody1">
		<div class="centre-flex">
			<input id="unique" placeholder="" >
			<button class="allButs" id="snap" onclick="snap()">Save Image</button>
			<input id="upload" type="file" accept="image/*" capture/>
			<button type="submit" name="save" onclick="javascript: upload(document.getElementById('unique').placeholder)">save</button>
		</div>
	</div>
	<div id="bot-pics">
		<div id="smallpic1" class="smallpic">
			<div id="prev-pic" class="pagenation">&laquo;</div>
			<div id="in-smallpic1" class="in-smallpic"></div>
		</div>
		<div id="bigpic" class="bigpic"></div>
		<div id="smallpic2" class="smallpic">
			<div id="in-smallpic2" class="in-smallpic"></div>
			<div id="next-pic" class="pagenation">&raquo;</div>
		</div>
	</div>
	<form id="submitForm">
		<input type="show" id="postImg" name="img">
		<input type="show" id="postOverlay" name="overlay">
		<input type="show" id="postTime" name="time">
		<input type="show" id="postUsername" name="username" value="<?php echo $_SESSION['username']; ?>">
	</form>
	<script>

	var selectedPic;
		var p1 = new Image();
		p1.setAttribute('crossOrigin', 'anonymous');
		p1.src = "./images/Emoji/1f4a4.png";
		var p2 = new Image();
		p2.setAttribute('crossOrigin', 'anonymous');
		p2.src = "./images/Emoji/1f4a9.png";
		var p3 = new Image();
		p3.setAttribute('crossOrigin', 'anonymous');
		p3.src = "./images/Emoji/1f4a2.png";
		var p4 = new Image();
		p4.setAttribute('crossOrigin', 'anonymous');
		p4.src = "./images/Emoji/1f4ae.png";
		var p5 = new Image();
		p5.setAttribute('crossOrigin', 'anonymous');
		p5.src = "./images/Emoji/1f6ab.png";
		var p6 = new Image();
		p6.setAttribute('crossOrigin', 'anonymous');
		p6.src = "./images/Emoji/1f48b.png";
		var p7 = new Image();
		p7.setAttribute('crossOrigin', 'anonymous');
		p7.src = "./images/Emoji/1f49e.png";
		var p8 = new Image();
		p8.setAttribute('crossOrigin', 'anonymous');
		p8.src = "./images/Emoji/1f49f.png";
		function selectPic(num)
		{
			selectedPic = num;
			snap();
		}

		// var video = document.querySelector("#vid");
		// navigator.getUserMedia = navigator.getUserMedia ||
		// navigator.webkitGetUserMedia || navigator.mozGetUserMedia || 
		// navigator.msGetUserMedia || navigator.oGetUserMedia;
		var input = document.querySelector('input[type=file]'); // see Example 4
		input.onchange = function () 
		{
			var file = input.files[0];
			// print_r($file);
			// upload(file);
			drawOnCanvas(file);
			displayAsImage(file);
		};

	
		
		function upload(file)
		{
			var form = new FormData(),
			xhr = new XMLHttpRequest();
			form.append('image', file);
			xhr.open('POST', 'config/save.php', true);
			xhr.send(form);
		}

		function drawOnCanvas(file)
		{
			var reader = new FileReader();

			reader.onload = function (e)
			{
				var dataURL = e.target.result,
				c = document.querySelector('canvas'),
				ctx = c.getContext('2d'),
				img = new Image();

				img.onload = function()
				{
					c.width = img.width;
					c.height = img.height;
					ctx.drawImage(img, 0, 0);
				};

				img.src = dataURL;
				document.getElementById('unique').placeholder = dataURL;
			};
			reader.readAsDataURL(file);
		}
		

		function displayAsImage(file)
		{
			var imgURL = URL.createObjectURL(file),
			img = document.createElement('img');

			img.onload = function()
			{
				URL.revokeObjectURL(imgURL);
			};

			img.src = imgURL;
			document.body.appendChild(img);
		}

		var canvas = document.querySelector('canvas');
		var context = canvas.getContext('2d');
		var w, h, ratio;

	

		// video.addEventListener('loadedmetadata', 
		// 	function()
		// 	{
		// 		ratio = video.videoWidth / video.videoHeight;
		// 		w = video.videoWidth - 100;
		// 		h = parseInt(w / ratio, 10);
		// 		canvas.width = w;
		// 		canvas.height = h;			
		// 	}, false);

		function snap()
		{
			// context.clearRect(0, 0, 400, 360);
			// context.drawImage(video, 0, 0, w, h);
			if (selectedPic == 'pic1')
				drawP1();
			else if (selectedPic == 'pic2')
				drawP2();
			else if (selectedPic == 'pic3')
				drawP3();
			else if (selectedPic == 'pic4')
				drawP4();
			else if (selectedPic == 'pic5')
				drawP5();
			else if (selectedPic == 'pic6')
				drawP6();
			else if (selectedPic == 'pic7')
				drawP7();
			else if (selectedPic == 'pic8')
				drawP8();
		}

		// if (navigator.getUserMedia)
		// {       
		// 	navigator.getUserMedia({video: true}, handleVideo,videoError);
		// }

		// function handleVideo(stream)
		// {
		// 	video.src = window.URL.createObjectURL(stream);
		// }

		// function videoError(e)
		// {// do something
		// }

		function drawP1()
		{
			var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p1, c.width/4, c.height/4, c.width/2, c.height/2);
			// document.getElementById("viddiv").style.backgroundImage = "url(./images/Emoji/1f4a4.png)";
			document.getElementById('postOverlay').value = "1";
			document.getElementById('unique').placeholder = c.toDataURL();
		}

		function drawP2()
		{
			var c = document.getElementById("canv");
			var context = c.getContext('2d');
			// context.drawImage(p2, 0, 0, c.width, c.height);
			context.drawImage(p2, c.width/4, c.height/4, c.width/2, c.height/2);
			document.getElementById('postOverlay').value = "2";
			document.getElementById('unique').placeholder = c.toDataURL();
		}

		function drawP3()
		{
			var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p3, c.width/4, c.height/4, c.width/2, c.height/2);
			document.getElementById('postOverlay').value = "3";
			document.getElementById('unique').placeholder = c.toDataURL();
		}

		function drawP4()
		{
			var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p4, c.width/4, c.height/4, c.width/2, c.height/2);
			document.getElementById('postOverlay').value = "4";
			document.getElementById('unique').placeholder = c.toDataURL();
		}

		function drawP5()
		{
			var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p5, c.width/4, c.height/4, c.width/2, c.height/2);
			document.getElementById('postOverlay').value = "5";
			document.getElementById('unique').placeholder = c.toDataURL();
		}

		function drawP6()
		{
			var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p6, c.width/4, c.height/4, c.width/2, c.height/2);
			document.getElementById('postOverlay').value = "6";
			document.getElementById('unique').placeholder = c.toDataURL();
		}

		function drawP7()
		{
			var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p7, c.width/4, c.height/4, c.width/2, c.height/2);
			document.getElementById('postOverlay').value = "7";
			document.getElementById('unique').placeholder = c.toDataURL();
		}

		function drawP8()
		{
			var c = document.getElementById("canv");
			var context = c.getContext('2d');
			context.drawImage(p8, c.width/4, c.height/4, c.width/2, c.height/2);
			document.getElementById('postOverlay').value = "8";
			document.getElementById('unique').placeholder = c.toDataURL();
		}

		function save()
		{
			var c = document.getElementById("canv");
			document.getElementById('postImg').value = canvas.toDataURL("image/png");
			document.getElementById('postTime').value = Math.round((new Date()).getTime() / 1000);
			var fd = new FormData(document.forms["submitForm"]);

			var ajax = new XMLHttpRequest();
			ajax.open('POST', 'config/save.php', true);

			ajax.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					window.location.replace(this.responseText);
				}
			};

			ajax.onload = function() {

			};
			ajax.send(fd);
		}	
	</script>
</body>
</html>