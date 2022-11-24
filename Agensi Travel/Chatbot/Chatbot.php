<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Alegreya&display=swap" rel="stylesheet">
	
	<style>
		.btn{
			position: fixed;
			bottom: 0;
			right: 0;
			z-index: 1080;
		  color: white;
		  text-align: center;
		  border-radius: 50%;
		  font-size: 18px;
		  background: #2F4F4F;
		}

		.btn:hover{
			background-color: #2F4F4F;
			border: none;
		}

		#chatbot{
			position: fixed;
			bottom: 0;
			right: 0;
			z-index: 1080;
			display: none;
			overflow: auto;
		}

		.pop-up-wrapper{
			position: fixed;
			bottom: 0;
			right: 0;
			margin-right: 15px;
			margin-bottom: 35px;
			width: 360px;
			background-image: url(images/images.jpg);
			background-repeat: no-repeat;
			background-size: cover;
			box-shadow: 4px 6px 10px #E1E1E1;
		}

		.headerchatbot{
			height: 40px;
			background-color: black;
			color: white;
			font-size: 30px;
			font-weight: bold;
			text-align: center;
			padding-top: 10px;
		}

		.close{
			font-size: 40px;
			color: #2F4F4F;
			position: absolute;
			right: 15px;
			top: -5px;
			opacity: 100%;
		}

		.close:hover{
			cursor: pointer;
			color: #5da3a3;
		}

		.isi{
			overflow-y: auto;
			width: 360px;
			height: 360px;
		}

		.isi .user {
		  display: flex;
		  align-items: baseline;
		}

		.isi .user .icon{
			height: 35px;
		  width: 35px;
		  color: white;
		  text-align: center;
		  margin-left: 5px;
		  line-height: 35px;
		  border-radius: 50%;
		  font-size: 16px;
		  background: #2F4F4F;
		}

		.pesan-bot{
			background-color: #2F4F4F;
			width: 55%;
			border-radius: 3px !important;
      padding: 5px;
      margin: 5px;
		}

		.pesan-user{
			background-color: #5da3a3;
			width: 55%;
			border-radius: 3px !important;
			padding: 5px;
			margin: 5px;
			margin-left: 140px;
		}

		.footerchatbot{
			height: 37px;
			border: 1.5px solid black;
			padding-bottom: 12px;
		}

		.chatform{
			margin-top: -2.5px;
		}

		.pesan{
			width: 310px !important;
      height: 33px !important;
      color: black;
      font-size: 10pt !important;
      border: 1.5px solid #2F4F4F;
      margin-top: 2px !important;
      padding-left: 5px !important;
      text-transform: none;
		}

		.btnsend{
			border-style: none;
			background-color: transparent;
			font-size: 20px;
			height: 35px;
			width: 35px;
		}

		p{
			font-size: 14px;
			color: white;
			font-family: 'Alegreya', serif;
			text-transform: none;
		}
	</style>

	<title>Chatbot</title>

  </head>
  <body>

  	<button type="button" class=" btn btn-dark rounded-circle p-0 m-3" style="width: 65px; height: 65px;" onclick="document.getElementById('chatbot').style.display='block'"><i class="fas fa-solid fa-comment fa-lg"></i></button>
  	<div id="chatbot">
  		<div class="pop-up-wrapper">
  			<div class="headerchatbot">
  				<p>CHATBOT</p>
  				<span class="close" onclick="document.getElementById('chatbot').style.display='none'">&times;</span>
  			</div>
  			<div class="isi">
  				<div class="user">
  				<div class="icon"><i class="fas fa-user"></i></div>
  				<div class="chat-bot">
  					<div class="pesan-bot">
  						<p>Hello, selamat datang di Agensi Travel. It's bot!</p>
  					</div>
  				</div>
  				</div>
  			</div>
  			<div class="footerchatbot">
  				<form class="form-inline chatform"></form>
  				<input type="text" name="chatform" class="pesan" id="pesan" placeholder="Type Your Message.....">
  				<button type="button" class="btnsend"><i class="fas fa-solid fa-paper-plane"></i></button>
  			</div>
  		</div>
  	</div>

  	<script>
		$(document).ready(function(){
			$(".btnsend").on("click", function(){
				$pesan = $(".pesan").val();
				$msg = '<div class="pesan-user"><p>'+$pesan+'</p></div>';
				$(".isi").append($msg);
				$(".pesan").val("");

				$.ajax({
					type: "POST",
					url: "chatbot/chatbot_check.php",
					data: 'text='+$pesan,
					success: function(result){
						$balasan = '<div class="user"><div class="icon"><i class="fas fa-user"></i></div><div class="pesan-bot"><p>'+result+'</p></div></div>';
						$(".isi").append($balasan);
						$(".isi").scrollTop($(".isi")[0].scrollHeight);
					}
				});
			});
		});
	</script>

  	<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>

</html>
