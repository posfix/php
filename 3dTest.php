<?php
ini_set ( 'display_errors', 1 );
error_reporting ( E_ERROR );

include_once ("settings.php");
include_once ("helper.php");
include_once ("base.php");
include_once ("restHttpCaller.php");
include_once ("Api3DPaymentRequest.php");
include_once ("ThreeDPaymentCompleteRequest.php");

$settings = new Settings ();

$settings->PublicKey = ""; // "Public Magaza Anahtarı",
$settings->PrivateKey = ""; // "Private Magaza Anahtarı",
$settings->BaseUrl = "https://www.posfix.com.tr/rest/payment/threed";
$settings->Version = "1.0";
$settings->Mode = "T"; // Test -> T / Prod -> P
$settings->HashString = "";

$request = new Api3DPaymentRequest ();
$request->OrderId = Helper::Guid ();
$request->Echo = "Echo";
$request->Mode = $settings->Mode;
$request->Version = $settings->Version;
$request->Amount = "10000"; // 100 tL
$request->CardOwnerName = "Kart Sahibi Ad Soyad";
$request->CardNumber = "4662803300111364";
$request->CardExpireMonth = "10";
$request->CardExpireYear = "25";
$request->Installment = "1";
$request->Cvc = "000";
$request->CardId = "";
$request->UserId = "";

$request->PurchaserName = "Ahmet";
$request->PurchaserSurname = "Veli";
$request->PurchaserEmail = "ahmet@veli.com";
$request->SuccessUrl = helper::getCurrentUrl() . "/success.php";
$request->FailUrl = helper::getCurrentUrl() . "/fail.php";

$response = Api3DPaymentRequest::execute ( $request, $settings );
print $response;
?>
