@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start")
@endsection

@section("page-title", "Tanya Ternak | SimPet")

@section("page-contents")

	@include("includes.navigation_bar")

	<section class="aimessage">
		<div class="contents">
			<div class="card">
				<div class="header">Tanya Ternak</div>
				<div class="aimessage-container">
					<div class="aimessage-system">Halo, selamat datang di Tanya Ternak! Ayo tanya apapun seputar peternakan dan nantinya AI akan membantu menyelesaikan masalah Anda!</div>
				</div>
				<div class="input-area">
					<input class="input-message" type="text" placeholder="Tulis pesan di sini">
					<button class="button-send-message" title="Kririm pesan Anda">Kirim</button>
				</div>
			</div>
		</div>
	</section>

	<script>
		$(document).ready(function()
		{
			$.ajaxSetup(
			{
				headers:
				{
					"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
				}
			});

			$(".button-send-message").on("click", function()
			{
				if ($(".input-message").val() != "")
				{
					$(".aimessage-container").append("<div class='aimessage-user'>" + $(".input-message").val() + "</div>");
				

					$.ajax(
					{
						type: "post",
						url: "{{url("sendChatAI")}}",
						data:
						{
							"input": $(".input-message").val()
						},
						success: function(res)
						{
							$(".aimessage-container").append("<div class='aimessage-ai'>" + res + "</div>");
							$(".input-message").val("");
						}
					});
				}
			});
		});
	</script>

@endsection