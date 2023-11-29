@extends("includes.layout")

@section("session-type")
	@include("includes.database.session_start_nologin")
@endsection

@section("page-title", "Katalog Belanja | SimPet")

@section("page-contents")

	@include("includes.navigation_bar")

	<section class="catalogs">
		<div class="contents">

			<?php
			
			if (isset($dataProducts) && is_array($dataProducts) && !empty($dataProducts))
				$productsDB = $dataProducts;
			else
				$productsDB = 0;

			$counter = 0;
			$activeRow = "active";

			if ($productsDB > 0)
			{
				foreach ($productsDB as $value)
				{
					if ($counter % 3 == 0)
						echo "<div class='row " . $activeRow . "'>";
							
						echo
							"<div class='col'>
								<div class='card card-catalogs' title='" . $value->name . "'"; ?> onclick="window.location.href = '/product/<?php echo $value->_id; ?>/details'" >
				<?php	echo
									"<div class='icon'>
										<img src='" . $value->images->image0 . "' alt='product_image'>
									</div>
									<div class='descriptions'>
										<h1>" . $value->name . "</h1>
										<h4>Rp" . number_format($value->price, 0, ',', '.') . "</h4>
									</div>
								</div>
							</div>";
	
					$counter++;
	
					if ($counter % 3 == 0)
						echo "</div>";
	
					if ($counter % 9 == 0)
						$activeRow = "";
				}
	
				// Prevent bug if row is not closed yet
				if ($counter % 3 != 0)
					echo "</div>";

				if ($counter > 9)
					$diplayButtonLoadMore = "class='active'";
				else
					$diplayButtonLoadMore = "class=''";

				echo "<button id='load-more-products' $diplayButtonLoadMore title='Tampilkan lebih banyak produk'>Tampilkan lebih banyak</button>";
			}
			else
			{
				echo
					"<div class='no-data'>
						<img src='/graphics/icons/icon_logo.png' alt='icon_logo'>
						<h2>Maaf, tidak ada produk untuk saat ini...</h2>
					</div>";
			}
			
			?>

		</div>
	</section>

@endsection

@section("page-footer")
	@include("includes.footer")
@endsection