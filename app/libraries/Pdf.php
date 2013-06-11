<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
        $X = 0;
        $Y = 0;
    }

    public function getX($xSeed = 0)
    {
    	$X = $xSeed;
        return $X;
    }

    public function getY($ySeed = 0)
    {
    	$Y = $ySeed;
        return $Y;
    }

    public function resetXY()
    {
    	$X = 0;
    	$Y = 0;
    }
    public function moveX($value)
	{
        $X += $value;
        return $X;	    	
	}

	public function moveY($value)
	{
        $Y += $value;
        return $Y;	    	
	}

    public function CreateTextBox($textval, $x = 0, $y, $width = 0, $height = 10, $fontsize = 10, $fontstyle = '', $align = 'L') {
		$this->SetXY($x+5, $y); // 20 = margin left
		$this->SetFont(PDF_FONT_NAME_MAIN, $fontstyle, $fontsize);
		$this->Cell($width, $height, $textval, 0, false, $align);
	}
	
}
 