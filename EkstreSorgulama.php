<?php

require_once('WsseAuthHeader.php');
// BANKANIN SİZE VERDİĞİ KULLANICI ADI ŞİFRE
$username = "";
$password = '';

// İKİ TARİH ARASI DEĞERLER
$start_date = '2020-12-12';
$end_date = '2020-12-15';

$wsse_header = new WsseAuthHeader($username, $password);
$client = new SoapClient("https://webservice.halkbank.com.tr/HesapEkstreOrtakWS/HesapEkstreOrtak.svc?wsdl");
$client->__setSoapHeaders(array($wsse_header));

class HesapEkstreRequest
{
  // Burdaki obje yapısı bankanın istediği parametlere göre oluşturulur.
  // Aşağıda kullandığımız Ekstre sorgulama metodu 2 paremetreyi istiyor.

  public $BaslangicTarihi;
  public $BitisTarihi;

}
// Daha sonra sınıfımdaki objelere değerleri atadım.
$request = new HesapEkstreRequest();
$request->BaslangicTarihi=$start_date;
$request->BitisTarihi=$end_date;
$requestParams = array('request' => $request);

try
{
// Burda en çok kullanılan metodu örnekledim, birde bağlı müşteri metodu var onuda göstereceğim
$response=$client->EkstreSorgulama($requestParams);
}
catch(\Exception $e)
{
var_dump($client->__gsetLastRequest());
var_dump($e);
}
var_dump($response);



?>
