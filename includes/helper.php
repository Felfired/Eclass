<?php
	
	function redirect($location) {
		
		header('Location:' . $location);
		exit();
	}
	
	function setFlashMsg($message, $type = 'success') {
		
		if ($type == 'success') {
			$_SESSION['_flash_message'] = "<div class=\"alert alert-success\"><strong>Success!</strong> " . $message . "</div>";
			} else {
			$_SESSION['_flash_message'] = "<div class=\"alert alert-danger\"><strong>Error!</strong> " . $message . "</div>";
		}
	}
	
	function printFlashMsg() {
		
		if (isset($_SESSION['_flash_message'])) {
			echo $_SESSION['_flash_message'];
			unset($_SESSION['_flash_message']);
		}
	}
?>