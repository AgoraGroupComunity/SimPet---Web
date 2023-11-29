<script>
	$(document).ready(function()
	{
		function isMobileDevice()
		{
			return (navigator.maxTouchPoints > 0 && /Android|iPhone/i.test(navigator.userAgent));
		}

		function activeButton($m_button)
		{
			if (!$m_button.hasClass("active"))
				$m_button.addClass("active");
		}
		
		function deactiveButton($m_button)
		{
			if ($m_button.hasClass("active"))
				$m_button.removeClass("active");
		}

		$(window).on("scroll", function()
		{
			deactiveButton($(".bx-menu"));
			deactiveButton($(".navigation-bar .buttons"));
		});

		$(".navigation-bar .buttons a").on("click", function()
		{
			var index = $(".navigation-bar .buttons a").index(this);

			if ($(this).hasClass("not-available"))
				return;

			$(".navigation-bar .buttons a").each(function(i)
			{
				if (i !== index)
					deactiveButton($(this));
			});

			activeButton($(this));
		});

		$(".bx-menu").on("click", function()
		{
			$(".bx-menu").toggleClass("active");
			$(".navigation-bar .buttons").toggleClass("active");
		});
		
		$("#search-avatar").on("click", function()
		{
			$("#avatar-input").click();
		});

		$("#avatar-input").on("change", function()
		{
			const selectedAvatar = $(this).prop("files")[0];

			if (selectedAvatar)
			{
				var reader = new FileReader();

				reader.onload = function(e)
				{
					var image = new Image();
					image.src = e.target.result;

					// Check image resolutions
					image.onload = function()
					{
						if (image.width > 1280 || image.height > 720)
						{
							return alert("Resolusi atau ukuran gambar yang Anda pilih terlalu besar dari 720pixels. Silakan pilih gambar yang lebih kecil.\n\n[ Resolusi maksimal 1280x720pixels ]");
						}
						else
						{
							var base64String = e.target.result;

							$("#avatar-preview").attr("src", base64String);
							
							// We want auto upload the updated avatar instead using PHP to do it
							$.ajax(
							{
								url: "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/updateUser?id=" + <?php echo json_encode(Session::get("id")); ?>,
								type: "PUT",
								data:
								{
									avatar: base64String
								},
								success: function(res)
								{
									return window.location.href = "profile?refresh=true";
								},
								error: function(err)
								{
									return alert("Terjadi kesalahan dalam update foto Anda.\n\n[ Error message: " + err +" ]");
								}
							});
						}
					}
				}

				reader.readAsDataURL(selectedAvatar);
			}
		});

		$("#form-update").submit(function(event)
		{
			var name = $("#name-update").val();
			var username = $("#username-update").val();
			var regex = /^\s+/;

			if (username.includes(" "))
			{
				alert("Username tidak boleh terdapat spasi.");
				$("#username-update").val("");
				event.preventDefault();

				return;
			}
			
			if (username.length > 15)
			{
				alert("Username tidak boleh melebihi dari 15 karakter.");
				$("#username-update").val("");
				event.preventDefault();

				return;
			}
			
			if (name.length > 50)
			{
				alert("Nama tidak boleh melebihi dari 50 karakter.");
				$("#name-update").val("");
				event.preventDefault();

				return;
			}

			if (regex.test($("#password-update").val()))
			{
				alert("Password tidak boleh diawali dengan spasi.");
				event.preventDefault();

				return;
			}
			
			if ($("#password-update").val() !== $("#confirm-password-update").val())
			{
				alert("Password Baru dan Konfirmasi Password Baru harus sama.");
				event.preventDefault();

				return;
			}
			
			if (($("#confirm-password").val() !== "") && ($("#password-update").val() === ""))
			{
				alert("Password baru tidak boleh kosong!\nSilakan cek kembali.");
				event.preventDefault();

				return;
			}
			
			if (($("#confirm-password").val() === "") && ($("#password-update").val() === $("#confirm-password-update").val()) && ($("#confirm-password").val() !== ""))
			{
				alert("Konfirmasi Password tidak boleh kosong.");
				event.preventDefault();

				return;
			}
		});

		$("#cancel-update").on("click", function()
		{
			window.location.href = "/";
		});

		$("#load-more-products").on("click", function()
		{
			deactiveButton($(".row"));
			activeButton($(".row"));

			deactiveButton($("#load-more-products"));
		});

		$(".card-details-image-list .container").on("mouseover", function()
		{
			var index = $(".card-details-image-list .container").index(this);

			$(".card-details-image-list .container").each(function(i)
			{
				if (i !== index)
					deactiveButton($(this));
			});

			activeButton($(this));

			var currentImageDetail = $(".card-details-image-list .container").eq(index).find("img").attr("src");

			$(".card-details-image img").attr("src", currentImageDetail);
		});

		$(".card-details-image").on(
		{
			mouseenter: function(event)
			{
				var parentOffset = $(this).offset();

				var mouseX = event.pageX - parentOffset.left;
				var mouseY = event.pageY - parentOffset.top;

				var percentX = mouseX / $(this).width() * 100;
				var percentY = mouseY / $(this).height() * 100;

				$(this).find("img").addClass("zoomed").css(
				{
					"transform-origin": percentX + "%" + percentY + "%"
				});
			},

			mousemove: function(event)
			{
				var parentOffset = $(this).offset();

				var mouseX = event.pageX - parentOffset.left;
				var mouseY = event.pageY - parentOffset.top;

				var percentX = mouseX / $(this).width() * 100;
				var percentY = mouseY / $(this).height() * 100;

				$(this).find("img").addClass("zoomed").css(
				{
					"transform-origin": percentX + "%" + percentY + "%"
				});
			},

			mouseleave: function(event)
			{
				$(this).find("img").removeClass("zoomed").css(
				{
					"transform-origin": "center center"
				});
			}
		});

		$("#quantity-decrease").on("click", function()
		{
			var quantityInput = $("#quantity-input");
			var currentQuantity = parseInt(quantityInput.val(), 10);

			if (currentQuantity > 1)
				quantityInput.val(currentQuantity - 1);
		});

		$("#quantity-increase").on("click", function()
		{
			var quantityInput = $("#quantity-input");
			var currentQuantity = parseInt(quantityInput.val(), 10);

			quantityInput.val(currentQuantity + 1);
		});

		$("#add-cart-button").on("click", function()
		{
			var query = $(".product-id").text() + "/" + $("#quantity-input").val();

			return window.location.href = "/cart/addcart/" + query + "/0";
		});

		$(".quantity-decrease-cart").each(function(index, element)
		{
			$(element).on("click", function(event)
			{
				event.stopPropagation();

				var quantityInput = $(this).siblings(".quantity-input-cart");
				var currentQuantity = parseInt(quantityInput.val(), 10);

				if (currentQuantity > 0)
					quantityInput.val(currentQuantity - 1);
			});
		});

		$(".quantity-input-cart").each(function(index, element)
		{
			$(element).on("click", function(event)
			{
				event.stopPropagation();
			});
			
			$(element).on("change", function(event)
			{
				var query = $(this).siblings(".product-id").text() + "/" + $(this).val();
			
				return window.location.href = "/cart/addcart/" + query + "/1";
			});
		});

		$(".quantity-increase-cart").each(function(index, element)
		{
			$(element).on("click", function(event)
			{
				event.stopPropagation();

				var quantityInput = $(this).siblings(".quantity-input-cart");
				var currentQuantity = parseInt(quantityInput.val(), 10);

				quantityInput.val(currentQuantity + 1);
			});
		});

		$(".quantity-remove").each(function(index, element)
		{
			$(element).on("click", function(event)
			{
				event.stopPropagation();
			
				var quantityInput = $(this).closest(".action").find(".quantity-input-cart");
				var currentQuantity = parseInt(quantityInput.val(), 10);

				quantityInput.val(currentQuantity - currentQuantity);

				quantityInput.trigger("change");
			});
		});

		$(".bank-number-copy-button").on("click", function()
		{
			navigator.clipboard.writeText($(".bank-number").text());
			alert("Nomor rekening telah disalin");
		});

		function enableTiltElements()
		{
			VanillaTilt.init(document.querySelectorAll(".card-features"),
			{
				glare: true,
				gyroscope: true,
				max: 25,
				reset: true,
				reverse: true,
				scale: 1.1,
				speed: 400
			});

			VanillaTilt.init(document.querySelectorAll(".card-catalogs"),
			{
				glare: true,
				gyroscope: true,
				max: 20,
				reset: true,
				reverse: true,
				scale: 1.1,
				speed: 400,
				axis: "x"
			});
		}

		function disableTiltElements()
		{
			document.querySelectorAll(".card-features").forEach(elements =>
			{
				VanillaTilt.init(elements);
				elements.vanillaTilt.destroy();
			});

			document.querySelectorAll(".card-catalogs").forEach(elements =>
			{
				VanillaTilt.init(elements);
				elements.vanillaTilt.destroy();
			});
		}

		if (window.matchMedia("(orientation: landscape)").matches)
		{
			if (isMobileDevice())
				disableTiltElements();
			else
				enableTiltElements();
		}
		else
		{
			enableTiltElements();
		}

		window.matchMedia("(orientation: landscape)").addEventListener("change", e =>
		{
			const landscape = e.matches;

			if (landscape)
			{
				if (isMobileDevice())
					disableTiltElements();
				else
					enableTiltElements();
			}
			else
			{
				enableTiltElements();
			}
		});
	});
</script>