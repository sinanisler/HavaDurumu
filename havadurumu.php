<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Hava Durumu Kütüphanesi github.com/sinanisler</title>
</head><body>
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
		$id1 = $dochtml->getElementById('cpContent_thmMin1');
		$icerik1 = $id1->nodeValue;
		return $icerik1;          
		}
		
		
		// En düşük hava sıcaklığı
	if($istek == "enaz" ){
		$id1 = $dochtml->getElementById('cpContent_thmMin1');
		$icerik1 = $id1->nodeValue;
		return $icerik1;          
		}
	
		// En yüksek hava sıcaklığı
	if($istek == "encok"){
		$id2 = $dochtml->getElementById('cpContent_thmMax1');
		$icerik2 = $id2->nodeValue;
		return $icerik2;          
		}
	
		// Havanın ve gökyüzünün durumu
	if($istek == "hava"){
		$id3 = $dochtml->getElementById('cpContent_imgHadise1');
		$icerik3 = $id3->getAttribute('src');
		
		switch ($icerik3) {
			case "../FILES/imgIcon/99/a1-25x25-gif/-23.gif": $havadurum = "Çok Bulutlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/-25.gif": $havadurum = "Parçalı Bulutlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/-28.gif": $havadurum = "Az Bulutlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/-29.gif": $havadurum = "Açık"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/45.gif": $havadurum = "Sisli"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/61.gif": $havadurum = "Hafif Yağmurlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/63.gif": $havadurum = "Yağmurlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/65.gif": $havadurum = "Kuvvetli Yağmurlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/68.gif": $havadurum = "Karla Karışık Yağmurlu"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/71.gif": $havadurum = "Hafif Kar Yağışlı"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/73.gif": $havadurum = "Kar Yağışlı"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/-81.gif": $havadurum = "Sağnak Yağışlı"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/82.gif": $havadurum = "Kuvvetli Sağnak Yağışlı"; break;
			case "../FILES/imgIcon/99/a1-25x25-gif/75.gif": $havadurum = "Yoğun Kar Yağışlı"; break;
		}
		
		return $havadurum;
	}
	
		
}

// örnek kullanımlar
echo havadurumu_getir("mersin","enaz"); // 1,5,10,20  sayısal çıktı
echo "<br>";
echo havadurumu_getir("adana","encok"); // 1,5,10,20  sayısal çıktı
echo "<br>";
echo havadurumu_getir("adana","hava");  // Bulutlu, Yağmurlu, Açık string-kelime çıktı

?>



</body>
</html>
