<?php 

namespace App\Models\Utils;

Class Utils {

	public static function prepareHtml($data) {
		/*$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;*/
		return htmlentities($data);
	}

	public static function decodeHtml($data) {
		/*$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;*/
		return html_entity_decode($data);
	}

}

 

 ?>