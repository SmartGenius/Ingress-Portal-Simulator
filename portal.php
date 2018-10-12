<?php

header("Content-Type: image/png");

// Coded by SmartGenius
// 2018 - Resistencia Latinoamerica

$font1 = dirname(__FILE__) . '/portal/GeomGraphicSemibold.ttf';

//posible values range[1-8]
if(!empty($_GET['resonators'])){
		$resonators=$_GET['resonators'];
	}
	else{
		$resonators="1,1,1,1,1,1,1,1";
}
// posible values [LA,LAVR,SBUL,NULL]
if(!empty($_GET['mods'])){
		$modifiers=$_GET['mods'];
	}
	else{
		$modifiers="NULL,NULL,NULL,NULL";
}
if(!empty($_GET['faction'])){
		$faction=$_GET['faction'];
	}
	else{
		$faction= NULL;
}
if(!empty($_GET['nickname'])){
		$nickname=$_GET['nickname'];
	}
	else{
		$nickname="Agent Nick";
	}

if($faction == "RES" ){

						$portalbase = "portal/PortalBaseRES.png";	
					}
					elseif ($faction == "ENL" ){
						$portalbase = "portal/PortalBaseENL.png";
					}
					elseif ($faction == NULL){
						$portalbase = "portal/PortalBaseNEU.png";
					}
					else {
						$portalbase = "portal/PortalBaseNEU.png";
					}
					
					
//$defreso

//Split string into Array Resos[] Mods[]
$resos = explode(",",$resonators);
$mods = explode(",",$modifiers);

$index=0;
foreach ($mods as $smod){
	if ($smod == "NULL"){
		$mods[$index] = "AMP";
	}
		$index = $index + 1;
}

rsort($mods);

$rbase=0;
$multresos = array(1,1,1,1,1,1,1,1);
$multmods = array(0,0,0,0);

//$imgresosdef = array("RL0.png","RL1.png","RL2.png","RL3.png","RL4.png","RL5.png","RL6.png","RL7.png","RL8.png");
$resosval = array(0,1000,1500,2000,2500,3000,4000,5000,6000);
$imgresosnew = array("RL0.png");
$resosenergy= array(0);

$index=0;
foreach ($resos as $level){
	$index = $index + 1;
	$imgresosnew[$index] = "RL".$level.".png";
	$resosenergy[$index] = $resosval[$level];
	
}
$index=0;
foreach ($mods as $mmod){
	if ($mmod == "AMP"){
		$multmods[$index] = 0;
	}
		if ($mmod == "LA"){
		$multmods[$index] = 2;
	}
		if ($mmod == "SBUL"){
		$multmods[$index] = 5;
	}
		if ($mmod == "VRLA"){
		$multmods[$index] = 7;
	}
		$index = $index + 1;
}

$portalenergy = array_sum($resosenergy);
$portallevel = array_sum($resos)/8;
$portalbase1 = ($portallevel**4)*0.16;
$portalmods = $multmods[0] + ($multmods[1]*0.25) + ($multmods[2]*0.125) + ($multmods[3]*0.125);
if ($portalmods == 0){
	$portalmods= 1;
	}
$portaldistance = round ($portalmods * $portalbase1,2) ;


$portal = imagecreatetruecolor(504, 504);
imagesavealpha ($portal, true);
$alphacolor	= imagecolorallocatealpha($portal, 0,0,0,127);
$yellow = imagecolorallocate($portal, 219, 172, 15);
$blue = imagecolorallocate($portal, 0, 175, 240);
$green = imagecolorallocate($portal, 0, 168, 90);
$gray = imagecolorallocate($portal, 56, 56, 56);

imagefill($portal,0,0,$alphacolor);

$base2 = imagecreatefrompng($portalbase);
imagecopyresampled($portal, $base2, 0, 0, 0, 0, 504, 504, 504, 504);

//add mods to image
$mod1 = imagecreatefrompng("portal/".$mods[0].".png");
imagecopyresampled($portal, $mod1, 40, 60, 0, 0, 84, 84, 84, 84);

$mod2 = imagecreatefrompng("portal/".$mods[1].".png");
imagecopyresampled($portal, $mod2, 155, 60, 0, 0, 84, 84, 84, 84);

$mod3 = imagecreatefrompng("portal/".$mods[2].".png");
imagecopyresampled($portal, $mod3, 270, 60, 0, 0, 84, 84, 84, 84);

$mod4 = imagecreatefrompng("portal/".$mods[3].".png");
imagecopyresampled($portal, $mod4, 380, 60, 0, 0, 84, 84, 84, 84);

//add resonators to image
$reso1 = imagecreatefrompng("portal/". $imgresosnew[1]);
imagecopyresampled($portal, $reso1, 225,190,0,0,62,62,62,62);

$reso2 = imagecreatefrompng("portal/". $imgresosnew[2]);
imagecopyresampled($portal, $reso2, 290,250,0,0,62,62,62,62);

$reso3 = imagecreatefrompng("portal/". $imgresosnew[3]);
imagecopyresampled($portal, $reso3, 290,330,0,0,62,62,62,62);

$reso4 = imagecreatefrompng("portal/". $imgresosnew[4]);
imagecopyresampled($portal, $reso4, 225,370,0,0,62,62,62,62);

$reso5 = imagecreatefrompng("portal/". $imgresosnew[5]);
imagecopyresampled($portal, $reso5, 100,370,0,0,62,62,62,62);

$reso6 = imagecreatefrompng("portal/". $imgresosnew[6]);
imagecopyresampled($portal, $reso6, 30,250,0,0,62,62,62,62);

$reso7 = imagecreatefrompng("portal/". $imgresosnew[7]);
imagecopyresampled($portal, $reso7, 30,330,0,0,62,62,62,62);

$reso8 = imagecreatefrompng("portal/". $imgresosnew[8]);
imagecopyresampled($portal, $reso8, 100,190,0,0,62,62,62,62);


if(!empty($_GET['noinfo'])){
		$portallevel = "???";
		$portaldistance = "???";
		$portalenergy = "???";
	}

imagettftext($portal, 15, 0, 345, 190, $yellow, $font1, "Level " . $portallevel );
imagettftext($portal, 15, 0, 350, 270, $yellow, $font1, $portaldistance ." Km");
imagettftext($portal, 15, 0, 350, 370, $yellow, $font1, $portalenergy . " XM");
imagettftext($portal, 10, 0, 370, 500, $gray, $font1, "&#x62;y&#x20;&#x53;m&#x61;rt&#x47;&#x65;&#x6E;&#x69;&#x75;&#x73;");


if(!empty($_GET['faction'])){
		$faction=$_GET['faction'];
		if($faction == "RES" ){
			imagettftext($portal, 25, 0, 235, 477, $blue, $font1, $nickname);
		}
		else{
			imagettftext($portal, 25, 0, 235, 477, $green, $font1, $nickname);
		}
	}
	else{
		$faction="flyer";
		imagettftext($portal, 25, 0, 235, 477, $yellow, $font1, $nickname);
}

// mostrar la imagen
imagepng($portal);
?>