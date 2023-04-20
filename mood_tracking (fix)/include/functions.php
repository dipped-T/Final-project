<?php
	/*Generate a link string from the root url of the website*/
	function url_for($url){
		global $root_url;
		return $root_url . '/' . $url;
	}
	/*Redirect to a link located in the website*/
	function redirect_to($url){
		header("Location: ".url_for($url));
	}
	/*check if there is a post request after form submit*/
	function is_post_request(){
		return $_SERVER['REQUEST_METHOD'] == "POST";
	}
	/*Add slashes to all form inputs to avoid database injection*/
	function a($string){
		return addslashes($string);
	}
	/*Add slashes to all form inputs to avoid database injection and return the sanitized inputs in an array*/
	function sanitize_create_inputs($fields,$inputs){
		$sanitized_inputs = [];
		foreach ($fields as $field) {
			$sanitized_inputs[$field] = addslashes($inputs[$field]);
		}
		return $sanitized_inputs;
	}
	/*Add slashes to all form inputs to avoid database injection and return the sanitized inputs in an array and prepare the EDIT syntax database query*/
	function sanitize_edit_inputs($fields,$inputs){
		$sanitized_inputs = [];
		foreach ($fields as $field) {
			$sanitized_inputs[] = $field."='".addslashes($inputs[$field])."'";
		}
		return $sanitized_inputs;
	}
?>