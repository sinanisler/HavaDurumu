<?php

/*
	
	havadurumu.php Türkiye illerinin güncel havadurumu bilgilerini 
	Meteoroloji Genel Müdürlüğünden elde edebilmeniz için yazılmış 
	ufak bir kütüphanedir.
	
*/


function havadurumu_getir($sehir , $istek=false){

	$sehiradi = $sehir;
	$strhtml = file_get_contents('http://www.mgm.gov.tr/mobile/tahmin-il-ve-ilceler.aspx?m='.$sehir);
	$dochtml = new DOMDocument();
	$dochtml->loadHTML($strhtml);
	
	if($sehir==true and $istek==false){
		$id1 = $dochtml->getElementById('ctl00_cpContent_thmMin1');
		$icerik1 = $id1->nodeValue;
		echo $icerik1;           
		}
		
		
		// En düşük hava sıcaklığı
	if($istek == "enaz" ){
		$id1 = $dochtml->getElementById('ctl00_cpContent_thmMin1');
		$icerik1 = $id1->nodeValue;
		echo $icerik1;           
		}
	
		// En yüksek hava sıcaklığı
	if($istek == "encok"){
		$id2 = $dochtml->getElementById('ctl00_cpContent_thmMax1');
		$icerik2 = $id2->nodeValue;
		echo $icerik2;           
		}
	
		// Havanın ve gökyüzünün durumu
	if($istek == "hava"){
		$id3 = $dochtml->getElementById('ctl00_cpContent_imgHadise1');
		$icerik3 = $id3->getAttribute('src');
		
		switch ($icerik3) {
			case "../FILES/imgIcon/99/a1-25x25-gif/-23.gif": echo "Çok Bulutlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/-25.gif": echo "Parçalı Bulutlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/-28.gif": echo "Az Bulutlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/-29.gif": echo "Açık"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/45.gif": echo "Sisli"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/61.gif": echo "Hafif Yağmurlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/63.gif": echo "Yağmurlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/65.gif": echo "Kuvvetli Yağmurlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/68.gif": echo "Karla Karışık Yağmurlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/71.gif": echo "Hafif Kar Yağışlı"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/73.gif": echo "Kar Yağışlı"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/-81.gif": echo "Sağnak Yağışlı"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/82.gif": echo "Kuvvetli Sağnak Yağışlı"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/75.gif": echo "Yoğun Kar Yağışlı"; break;
		}
	}
	
		
}

// örnek kullanımlar
havadurumu_getir("mersin","enaz");
havadurumu_getir("adana","encok");
havadurumu_getir("adana","hava");

?>