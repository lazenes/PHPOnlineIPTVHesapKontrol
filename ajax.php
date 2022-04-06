<?php
/*
Enes BİBER
İpTV Kontrol Botu
*/



function IPTVkontrol($iptvSite,$user,$pass){
	$json_info=Array();
$json_info=json_decode(file_get_contents("http://mikkm.xyz/android/androidApi.php?url=".$iptvSite."&username=".$user."&password=".$pass."&mode=user_info"),true);
return $json_info;

}

		
if(isset($_POST['iptvadresi'])){
$IPTVler="";
$veri=$_POST['iptvadresi'];
$ayir = preg_split('/\n|\r/',$veri);

for($i=0; $i<=count($ayir)-1; $i++){
$veri=str_replace("http","url=http",$ayir[$i]);
$veri=str_replace("/get.php?","&",$veri);
parse_str($veri, $array);
$verMehteri = IPTVkontrol($array["url"],$array["username"],$array["password"]);
$remaining_days =$verMehteri['user_info']['exp_date'] - $verMehteri['server_info']['timestamp_now'];
$fullDays    = floor($remaining_days/(60*60*24));
	if( $fullDays==0 || $verMehteri['user_info']['status']=="Expired"){		
		continue;
		
	}else{
		if($fullDays < 0 && $verMehteri['user_info']['status']=="Active"){
		$fullDays="Süresiz ";
		}
		$IPTVler=$IPTVler."\n".$array["url"]."/get.php?username=".$array["username"]."&password=".$array["password"]."&type=m3u";
   echo " <tr>
        <td>".$array["url"]."</td>
        <td>".$array["username"]."</td>
        <td>".$array["password"]."</td>
        <td>".$fullDays." Gün</td><td>";
		
		for($formatlar=0; $formatlar<=count($verMehteri['user_info']['allowed_output_formats'])-1; $formatlar++){
		echo $verMehteri['user_info']['allowed_output_formats'][$formatlar].",";
		}
			
			echo "</td><td>".$verMehteri['user_info']['status']."</td>"; 
			echo "<td><a id='iptv[]' href='".$array["url"]."/get.php?username=".$array["username"]."&password=".$array["password"]."&type=m3u'>Format(".$verMehteri['user_info']['allowed_output_formats'][0].")</td></tr>"; 

}
}
	/*echo "<textarea style='display:none' id=t>".$IPTVler."</textarea><br>
<button onclick=saveTextAsFile(t.value,'IPTvListesi.txt')>İndir(.txt)</button>
";*/

}

		
//$verMehteri['user_info']['username'];
//$verMehteri['user_info']['password'];
//$verMehteri['user_info']['status'];
//$verMehteri['user_info']['allowed_output_formats'];  // For İle Döngüye Sok 0,1,2
//$verMehteri['server_info']['url'];
//$verMehteri['server_info']['port'];
	
?>

