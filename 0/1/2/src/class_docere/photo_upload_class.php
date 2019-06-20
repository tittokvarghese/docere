<?php
/* Thanks Jesus */
/* This file will be creating brilliant profile picture */


ini_set ('gd.jpeg_ignore_warning', true);


class setProfilePhoto
{
	const errorHtml  = "<div style=\"margin-top:120px;\" align=\"center\" class=\"ffamily\">Error uploading image!</div>";
	const errorHtml2 = "<div style=\"margin-top:70px;\" align=\"center\" class=\"ffamily\">Too big Image file! <br>Please reduce the size of your cover photo<br>using an image editor.</div>";
	const errorHtml3 = "<div style=\"margin-top:120px;\" align=\"center\" class=\"ffamily\">Unsupported file type!</div>";
	const detectDevice  = FALSE;
	const iwidth		= "270";
	const iheight		= "300";
	const quality		= "90";
	const defaultExt	= ".jpg";

	public    $profile_image_name;
	public    $newImageName;
	public 	  $fullpath;
	protected $imageSize;
	protected $tempSrc;
	protected $imageType;
	protected $width;
	protected $height;
	protected $createdImage;

	public function __construct($getname)
	{
		$this->profile_image_name = $getname;
		$this->newImageName = rand(99999,999999).'_'.time().'_'.rand(time(),999999).'_'.rand(99999,999999).'_n'.self::defaultExt;
		$this->fullpath		= PHOTO_SAVE_PATH.$this->newImageName; 
		$this->imageSize 	= $this->profile_image_name['size'];
		$this->tempSrc		= $this->profile_image_name['tmp_name']; 
		$this->imageType	= $this->profile_image_name['type']; 
		list($this->width,$this->height) = @getimagesize($this->tempSrc);	
	}



	private function getErrorHtml()
	{
	
	
		$size = @getimagesize($this->profile_image_name['tmp_name']);
if (empty($size) || ($size[0] === 0) || ($size[1] === 0)) {
    return;
}
	
	
	
		if( ! isset($this->profile_image_name) or ! is_uploaded_file($this->profile_image_name['tmp_name']))
		{
		die(self::errorHtml);
		}
		else if($this->imageSize>9291456) /* CHECK FOR 2MB SIZE, 1MB FOR 1048576*/
		{
		die(self::errorHtml2);
		}

		switch(strtolower($this->imageType))
		{
			case 'image/png'  : $this->createdImage = imagecreatefrompng($this->profile_image_name['tmp_name']); break;
			case 'image/gif'  : $this->createdImage = imagecreatefromgif($this->profile_image_name['tmp_name']); break;			
			case 'image/jpeg' : 
			case 'image/pjpeg': $this->createdImage = @imagecreatefromjpeg($this->profile_image_name['tmp_name']); break;
			default			  : die(self::errorHtml3); 
		}
		
	}
	
private function cropImage($widthSize,$heightSize,$path)
{
	if($this->width <= 0 || $this->height <= 0) { return FALSE; }
	if($this->width>$this->height)
	{
	$y_offset 	 = 0;
	$x_offset 	 = ($this->width - $this->height) / 2;
	$square_size =  $this->width - ($x_offset * 2);
	} else {
	$x_offset 	 = 0;
	$y_offset 	 = ($this->height - $this->width) / 2;
	$square_size =  $this->height - ($y_offset * 2);
	}
	$newCanves 	 = imagecreatetruecolor($widthSize,$heightSize);	

	if(imagecopyresampled($newCanves,$this->createdImage,0,0,$x_offset,$y_offset,$widthSize,$heightSize,$square_size,$square_size))
	{
		switch(strtolower($this->imageType))
			{
			case 'image/png'	: imagepng($newCanves,$path); break;
			case 'image/gif'	: imagegif($newCanves,$path); break;			
			case 'image/jpeg'	:
			case 'image/pjpeg'	: imagejpeg($newCanves,$path,self::quality); break;
			default				: return FALSE;
		}
		if(is_resource($newCanves)){ imagedestroy($newCanves); } 
		return TRUE;
	}
}


	public function upload()
	{
		self::getErrorHtml();
	
		if( ! self::cropImage(self::iwidth,self::iheight,$this->fullpath))
		{
			echo self::errorHtml;
			exit;
		}
		
	}	
	

}

	
/*****************/
