<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha extends CI_Controller 
{
	public function index()
	{
		if(!isset($_SESSION))
        {
            session_start();
        }
        
        $code=$this->randomPassword();
        $this->session->set_userdata('myCap', $code);
        // $this->session->set_userdata('captcha', $code);
         
        //height and width for captcha background
        $im = imagecreatetruecolor(100, 50);
         
        //background color blue
        $bg = imagecolorallocate($im, 229, 229, 231);
        $border = imagecolorallocate($im, 208,208,208);
         
        //text color white
        $fg = imagecolorallocate($im, 0, 0, 0);
        imagefill($im, 0, 0, $bg);

        //( $image , $fontsize , $x-distance , $y-distance , $string , $fontcolor )
        imagestring($im, 20, 30, 20,  $code, $fg);

        //generate image
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);
	}

	public function randomPassword() 
    {
        $alphabet = "ABCDEFGHIJKLMNPQRSTUWXYZ123456789";
           
        //remember to declare $pass as an array 
        $pass = array(); 
         
           //put the length -1 in cache
            $alphaLength = strlen($alphabet) - 1; 
            for ($i = 0; $i < 4; $i++) 
            {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
         
           //turn the array into a string
            return implode($pass); 
    }

    public function getCaptcha()
    {
         if(!isset($_SESSION))
        {
            session_start();
        }
        
        $code=$this->randomPassword();
        $this->session->set_userdata('myCap', $code);
        // $this->session->set_userdata('captcha', $code);
         
        //height and width for captcha background
        $im = imagecreatetruecolor(100, 50);
         
        //background color blue
        $bg = imagecolorallocate($im, 229, 229, 231);
        $border = imagecolorallocate($im, 208,208,208);
         
        //text color white
        $fg = imagecolorallocate($im, 0, 0, 0);
        imagefill($im, 0, 0, $bg);

        //( $image , $fontsize , $x-distance , $y-distance , $string , $fontcolor )
        imagestring($im, 20, 30, 20,  $code, $fg);

        //generate image
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);
    }
}
