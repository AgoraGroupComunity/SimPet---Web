<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Cart;
use App\Http\Controllers\Products;

use Illuminate\Support\Facades\Session;

class Payment extends Controller
{
	private function getProductsInfo() : String
	{
		$cart = new Cart();
		$products = new Products();

		$dataCart = $cart->getCart();
		$productsQuery = "";
		$amountsProductQuery = "";

		if (isset($dataCart) && is_array($dataCart) && !empty($dataCart))
		{
			$i = 0;

			foreach ($dataCart as $valDataCart)
			{
				$currentDataProduct = $products->getProducts("?id=" . $valDataCart->product_id . "&cartdisplay");

				if (isset($currentDataProduct) && is_array($currentDataProduct) && !empty($currentDataProduct))
				{
					foreach ($currentDataProduct as $valCurrentDataProduct)
					{
						$productsQuery .= "&product" . $i . "=" . urlencode($valCurrentDataProduct->name);
						$amountsProductQuery .= "&amounts_product" . $i . "=" . urlencode($valDataCart->amounts);
					}
				}
				else
				{
					$cart->deleteCart($valDataCart->product_id);
				}

				$i++;
			}
		}

		// Delete all existing cart
		$cart->deleteCart();

		return $productsQuery . $amountsProductQuery;
	}

	public function payProducts($totalPrice, $uniqueCode, $courier)
	{
		$totalPrice = base64_decode(urldecode($totalPrice));
		$uniqueCode = base64_decode(urldecode($uniqueCode));
		$courier = base64_decode(urldecode($courier));

		if (session_status() === PHP_SESSION_NONE)
			session_start();

		$query = urlencode(Session::get("id")) . "&name=" . urlencode(Session::get("name")) . "&phone=" . urlencode(Session::get("phone")) . "&address=" . urlencode(Session::get("address")) . $this->getProductsInfo() . "&total_price=" . urlencode($totalPrice) . "&unique_code=" . urlencode($uniqueCode) . "&receipt_number=" . urlencode(mt_rand(1000000, 9999999)) . "&courier=" . urlencode($courier) . "&date=" . urlencode(date("Y-m-d H:i:s")) . "&status=" . urlencode("Diproses");
		
		$cUrl = curl_init();

		$options = array(
			CURLOPT_URL => "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/addShop?user_id=" . $query,
			CURLOPT_CUSTOMREQUEST => "POST"
		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
		curl_close($cUrl);

		return redirect("/payment/success");
	}

	public function Index($subTotalPrice, $amounts, $deliverPrice, $totalPrice, $uniqueCode, $courier)
	{
		$subTotalPrice = base64_decode(urldecode($subTotalPrice));
		$amounts = base64_decode(urldecode($amounts));
		$deliverPrice = base64_decode(urldecode($deliverPrice));
		$totalPrice = base64_decode(urldecode($totalPrice));
		$uniqueCode = base64_decode(urldecode($uniqueCode));
		$courier = base64_decode(urldecode($courier));

		$dataPayment = array(
			"subtotal_price" => $subTotalPrice,
			"amounts" => $amounts,
			"deliver_price" => $deliverPrice,
			"total_price" => $totalPrice,
			"unique_code" => $uniqueCode,
			"courier" => $courier
		);

		return view("pages/payment")->with("dataPayment", $dataPayment);
	}
}

?>