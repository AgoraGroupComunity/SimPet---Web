<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserAuthentication extends Controller
{
	private function isUserExists(String $username, int $eventValue = 0) : bool
	{
		$cUrl = curl_init();

		$options = array(
			CURLOPT_URL => "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/checkUser?username=" . urlencode($username),
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
		curl_close($cUrl);

		if ($data && count($data) > 0)
		{
			if ($eventValue === 0)
			{
				echo "<script>window.location = '/login?userexists=true';</script>";

				return true;
			}
			else if ($eventValue === 1)
			{
				if ($username !== Session::get("username"))
				{
					echo "<script>alert('Username telah dipakai!\\nGunakan username lain.'); window.location = 'profile?mod=general';</script>";

					return true;
				}
				else
				{
					return false;
				}
			}
		}

		return false;
	}

	public function Register(Request $request)
	{
		if (session_status() === PHP_SESSION_NONE)
			session_start();

		if (!$this->isUserExists($request->input("username")))
		{
			$cUrl = curl_init();

			$options = array(
				CURLOPT_URL => "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/registerUser?avatar=" . "" . "&name=" . urlencode($request->input("name")) . "&username=" . urlencode($request->input("username")) . "&email=" . urlencode($request->input("email")) . "&phone=" . urlencode($request->input("phone")) . "&address=" . urlencode($request->input("address")) . "&password=" . md5(md5(urlencode($request->input("password")))),	//double-hashing method
				CURLOPT_CUSTOMREQUEST => "POST"
			);

			curl_setopt_array($cUrl, $options);
			$response = curl_exec($cUrl);
			$data = json_decode($response);
			curl_close($cUrl);

			return redirect("/signin?username=" . $request->input("username") . "&password=" . $request->input("password"));
		}
	}

	public function Signin(Request $request)
	{
		if (session_status() === PHP_SESSION_NONE)
			session_start();

		$cUrl = curl_init();

		// Password confirmation
		$query = "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/loginUser?username=" . urlencode($request->input("username"));
		
		if (isset($request) && !empty($request->input("password_resume")))
			$query .= "&password=" . urlencode($request->input("password_resume"));
		else
			$query .= "&password=" . md5(md5(urlencode($request->input("password"))));	//double-hashing method

		$options = array(
			CURLOPT_URL => $query,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array($cUrl, $options);
		$response = curl_exec($cUrl);
		$data = json_decode($response);
		curl_close($cUrl);

		if (is_array($data) && !empty($data))
		{
			foreach ($data as $row)
			{
				Session::put("id", $row->_id);

				if (!empty($row->avatar))
					Session::put("avatar", $row->avatar);
				else
					Session::put("avatar", "/graphics/avatar.png");

				Session::put("name", $row->name);
				Session::put("username", $row->username);
				Session::put("email", $row->email);
				Session::put("phone", $row->phone);
				Session::put("address", $row->address);
				Session::put("password", $row->password);
			}
		}
		else
		{
			return "<script>window.location = '/login?baduserdata=true'</script>";
		}

		// Make return to the latest or specific destination page after signin or re-signin
		if (isset($request) && !empty($request->input("pagecallback")))
			return redirect("/" . $request->input("pagecallback"));
		else if (Session::get("username") === "admin")
			return redirect("/admin");
		else
			return redirect("/");
	}

	public function Update(Request $request)
	{
		if (session_status() === PHP_SESSION_NONE)
			session_start();

		$id = Session::get("id");
		$name = $request->input("name");
		$username = $request->input("username");
		$email = $request->input("email");
		$phone = $request->input("phone");
		$address = $request->input("address");

		$query = urlencode($id) . "&name=" . urlencode($name) . "&username=" . urlencode($username) . "&email=" . urlencode($email) . "&phone=" . urlencode($phone) . "&address=" . urlencode($address) . "&password=";

		// Password confirmation
		if (!empty($request->input("password_update")))
			$query .= md5(md5(urlencode($request->input("password_update"))));	//double-hashing method
		else
			$query .= urlencode(Session::get("password"));

		if (!$this->isUserExists($username, 1))
		{
			if ((md5(md5($request->input("confirm_password"))) !== Session::get("password")) && !empty($request->input("confirm_password")))
			{
				return "<script>alert('Konfirmasi Password tidak valid!\\nSilakan cek kembali.'); window.location = 'profile?mod=changepassword';</script>";
			}
			else
			{
				$cUrl = curl_init();

				$options = array(
					CURLOPT_URL => "https://us-east-1.aws.data.mongodb-api.com/app/application-0-exinc/endpoint/updateUser?id=" . $query,
					CURLOPT_CUSTOMREQUEST => "PUT"
				);

				curl_setopt_array($cUrl, $options);
				$response = curl_exec($cUrl);
				$data = json_decode($response);
				curl_close($cUrl);

				// Password confirmation
				if (!empty($request->input("password_update")))
					return redirect("/signin?username=" . $username . "&password=" . $request->input("password_update"));
				else
					return redirect("/signin?username=" . $username . "&password_resume=" . Session::get("password"));
			}
		}
	}

	public function Signout()
	{
		session_start();

		Session::flush();

		return redirect("/login");
	}
}

?>