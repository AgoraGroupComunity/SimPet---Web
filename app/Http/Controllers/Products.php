<?php

namespace App\Http\Controllers;

class Products extends Controller
{
	public array $dataProducts = [];
	
	public function getProducts($param) : array
	{
		if (session_status() === PHP_SESSION_NONE)
			session_start();

		$query = (!empty($param)) ? $param : "";

		$cUrl = curl_init();

		$options = array(
			CURLOPT_URL => "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/getProducts" . $query,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
		curl_close($cUrl);

		if (is_array($data) && !empty($data))
			return $this->dataProducts = $data;

		return [];
	}

	public function Index()
	{
		$this->getProducts("?display");

		return view("pages/catalogs")->with("dataProducts", $this->dataProducts);
	}

	public function Details($productId)
	{
		$this->getProducts("?id=" . $productId);

		return view("pages/catalogdetails")->with("dataProducts", $this->dataProducts);
	}
}

?>