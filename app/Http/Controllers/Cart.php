<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class Cart extends Controller
{
	private int $dataCartAmounts = 0;

	private function isCartExists(String $productId) : bool
	{
		if (session_status() === PHP_SESSION_NONE)
			session_start();

		$data = $this->getCart($productId);

		if (is_array($data) && !empty($data))
		{
			foreach ($data as $value)
			{
				$this->dataCartAmounts = intval($value->amounts);
			}

			$this->deleteCart($productId);

			return true;
		}

		return false;
	}

	public function deleteCart(String $productId = "")
	{
		if (session_status() === PHP_SESSION_NONE)
			session_start();

		$query = (!empty($productId)) ? "&product_id=" . urlencode($productId) : "";

		$cUrl = curl_init();

		$options = array(
			CURLOPT_URL => "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/deleteCart?user_id=" . urlencode(Session::get("id")) . $query,
			CURLOPT_CUSTOMREQUEST => "DELETE"
		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
		curl_close($cUrl);
	}

	public function getCart(String $productId = "") : array
	{
		if (session_status() === PHP_SESSION_NONE)
			session_start();

		$query = (!empty($productId)) ? "&product_id=" . urlencode($productId) : "";

		$cUrl = curl_init();

		$options = array(
			CURLOPT_URL => "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/getCart?user_id=" . urlencode(Session::get("id")) . $query,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
		curl_close($cUrl);

		return $data;
	}

	public function addCart(String $productId, int $amounts, int $param)
	{
		if (session_status() === PHP_SESSION_NONE)
			session_start();

		$cUrl = curl_init();

		if ($this->isCartExists($productId))
		{
			if ($param === 0)
				$this->dataCartAmounts = $this->dataCartAmounts + $amounts;
			else
				$this->dataCartAmounts = $amounts;
		}
		else
		{
			$this->dataCartAmounts = $amounts;
		}

		$options = array(
			CURLOPT_URL => "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/addCart?user_id=" . urlencode(Session::get("id")) . "&product_id=" . urlencode($productId) . "&amounts=" . urlencode($this->dataCartAmounts),
			CURLOPT_CUSTOMREQUEST => "POST"
		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
		curl_close($cUrl);

		// Delete the existing cart if the amount is 0
		if (intval($this->dataCartAmounts) === 0)
			$this->deleteCart($productId);

		// Return to cart page
		return redirect("/cart");
	}

	public function Index()
	{
		$dataCart = $this->getCart();

		return view("pages/cart")->with("dataCart", $dataCart);
	}
}

?>