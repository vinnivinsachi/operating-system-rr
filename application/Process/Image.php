<?php

class Application_Process_Image
{
	
	/**
	 * Save all the images from a form upload.
	 * 
	 * @param string $formName The name of the form that was submitted.
	 * @return Application_Process_Result With an array of error data if application.
	 */
	static public function saveImagesFromForm($formName) {
		$thumbsArray = array(
			Application_Constants_Uploads::$THUMB_SMALL,
			Application_Constants_Uploads::$THUMB_MEDIUM,
			Application_Constants_Uploads::$THUMB_LARGE,
		);
		$images = self::createImagesArrayFrom_FILE($formName); // rearrange the images array
		$errors = array(); // array to hold errors
		foreach($images as $name => $imageInfo) { // FOR EACH image
			$processResult = self::imageValid($imageInfo); // check image validity
			if(!$processResult->success) $errors[$name] = $processResult->data; // IF image is NOT valid
			else { // ELSE (image IS valid)
				$uploadsDir = DOCUMENT_ROOT.DIR_IMAGE_UPLOADS;
				$processResult = self::save($imageInfo, $uploadsDir); // save the image
				if(!$processResult->success) $errors[$name] = $processResult->data; // IF any errors while saving
				else Custom_Images::createThumbnails($uploadsDir.'/'.$imageInfo['name'], $thumbsArray); // create thumbnails
			}
		}
		return new Application_Process_Result(true, $errors); // return result
	}
	
	/**
	 * Save the tmp image to a new location on server and add an entry to the DB.
	 * 
	 * @param array $imageInfo
	 * @param string $directory
	 * @return Application_Process_Result $data => errors array if $success => false.
	 */
	static public function save(array $imageInfo, $directory) {
		$errors = array(); // array to hold error messages
		if(file_exists($directory.'/'.$imageInfo['name'])) $errors[] = 'File already exists'; // IF file already exists
		if(!move_uploaded_file($imageInfo['tmp_name'], $directory.'/'.$imageInfo['name'])) $errors[] = 'Something went wrong moving the file'; // IF error when moving file
		if(count($errors)) return new Application_Process_Result(false, $errors); // IF any errors
		else return new Application_Process_Result(true); // ELSE (no errors)
	}	
	
	/**
	 * Checks if the image upload is valid.
	 * 
	 * @param array $image An array of image data
	 * @return Application_Process_Result $data is the error messages if false.
	 */
	static private function imageValid(array $image) {
		$errors = array(); // arra to hold error messages
		if(!in_array($image['type'], Application_Constants_Uploads::$IMAGE_ACCEPTED_TYPES)) $errors[] = 'Type not permitted';
		if($image['size'] > Application_Constants_Uploads::$IMAGE_MAX_SIZE) $errors[] = 'File too big';
		if(count($errors)) return new Application_Process_Result(false, $errors); // IF there were any errors
		else return new Application_Process_Result(true);
	}
		
	/**
	 * Creates a more accessible array of images from $_FILE.
	 * 
	 * @param string $formName The name of the form from which the images were uploaded.
	 * @return array of imageInfo's.
	 */
	static private function createImagesArrayFrom_FILE($formName) {
		$images = array();
		foreach($_FILES[$formName]['error'] as $key => $error) { // for each image error code
			if($error == UPLOAD_ERR_OK) { // IF no errors
				$image = array(
					'name' =>	$_FILES[$formName]['name'][$key],
					'type' =>	$_FILES[$formName]['type'][$key],
					'size' =>	$_FILES[$formName]['size'][$key],
					'tmp_name' =>	$_FILES[$formName]['tmp_name'][$key],
					'error' =>	$error
				);
				$images[$key] = $image;
			}
		}
		return  $images; // return the images info array
	}
	
}
