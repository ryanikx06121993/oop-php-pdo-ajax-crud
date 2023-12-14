<?php

class Utilities {

	  // Sanitize Inputs
	  public function test_input($data) {
	    $data = strip_tags($data);
	    $data = htmlspecialchars($data);
	    $data = stripslashes($data);
	    $data = trim($data);
	    return $data;
	  }

	//   // JSON Format Converter Function
	//   public function message($content, $status) {
	//     return json_encode(['message' => $content, 'error' => $status]);
	//   }

    }

?>