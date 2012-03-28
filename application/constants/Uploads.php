<?php

class Application_Constants_Uploads
{
	
	// IMAGES
	static public $IMAGE_MAX_SIZE = 3000000; // 3 MB
	static public $IMAGE_ACCEPTED_TYPES = array('image/png', 'image/jpeg');
	
	static public $THUMB_SMALL = array('_small', array(50, 50));
	static public $THUMB_MEDIUM = array('_medium', array(100, 100));
	static public $THUMB_LARGE = array('_large', array(150, 150));
	
}
