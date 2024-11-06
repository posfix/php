<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);

include_once("settings.php");
include_once("helper.php");
include_once("base.php");
include_once("restHttpCaller.php");
include_once("BinNumberInquiryRequest.php");
include_once("BankCardInquiryRequest.php");
include_once("ApiPaymentRequest.php");
include_once("BankCardCreateRequest.php");
include_once("BankCardDeleteRequest.php");
include_once("PaymentInquiryRequest.php");


$settings = new Settings();

$request = new BinNumberInquiryRequest();
$request->binNumber = "492130";
$response = BinNumberInquiryRequest::execute($request, $settings);
print "Bin Inqury \xA" . $response . "\xA" . "\xA";

$request = new PaymentInquiryRequest();
$orderId = 1;
$request->orderId = $orderId;
$request->Echo = "Echo";
$request->Mode = $settings->Mode;
$response = PaymentInquiryRequest::execute($request, $settings);
print "PaymentInquiryRequest \xA" . $response . "\xA" . "\xA";


$request = new BankCardCreateRequest();
$request->userId = "123456";
$request->cardOwnerName = "Kart Sahibi Ad Soyad";
$request->cardNumber = "5456165456165454";
$request->cardAlias = "Adios";
$request->cardExpireMonth = "12";
$request->cardExpireYear = "24";
$request->clientIp = Helper::get_client_ip();
$response = BankCardCreateRequest::execute($request, $settings);
print "BankCardCreateRequest  \xA" . $response . "\xA" . "\xA";


$request = new BankCardInquiryRequest();
$request->userId = "123456";
$request->cardId = "";
$request->clientIp = Helper::get_client_ip();
$response = BankCardInquiryRequest::execute($request, $settings);
print "BankCardInquiryRequest  \xA" . $response . "\xA" . "\xA";


$request = new BankCardDeleteRequest();
$request->userId = "123456";
$request->cardId = "";
$request->clientIp = Helper::get_client_ip();
$response = BankCardDeleteRequest::execute($request, $settings);
print "BankCardDeleteRequest  \xA" . $response . "\xA" . "\xA";


$request = new ApiPaymentRequest();
$request->OrderId = Helper::Guid();
$request->Echo = "Echo";
$request->Mode = $settings->Mode;
$request->Amount = "10000"; // 100 tL
$request->CardOwnerName = "Kart Sahibi Ad Soyad";
$request->CardNumber = "4662803300111364";
$request->CardExpireMonth = "10";
$request->CardExpireYear = "25";
$request->Installment = "1";
$request->Cvc = "000";
$request->ThreeD = "false";



#region Sipariş veren bilgileri
$request->Purchaser = new Purchaser();
$request->Purchaser->Name = "Ahmet";
$request->Purchaser->SurName = "Veli";
$request->Purchaser->BirthDate = "1986-07-11";
$request->Purchaser->Email = "ahmet@veli.com";
$request->Purchaser->GsmPhone = "5881231212";
$request->Purchaser->IdentityNumber = "1234567890";
$request->Purchaser->ClientIp = Helper::get_client_ip();
#endregion

#region Fatura bilgileri

$request->Purchaser->InvoiceAddress = new PurchaserAddress();
$request->Purchaser->InvoiceAddress->Name = "Ahmet";
$request->Purchaser->InvoiceAddress->SurName = "Veli";
$request->Purchaser->InvoiceAddress->Address = "Mevlüt Pehlivan Mah-> PosFix Plaza Şişli";
$request->Purchaser->InvoiceAddress->ZipCode = "34782";
$request->Purchaser->InvoiceAddress->CityCode = "34";
$request->Purchaser->InvoiceAddress->IdentityNumber = "1234567890";
$request->Purchaser->InvoiceAddress->CountryCode = "TR";
$request->Purchaser->InvoiceAddress->TaxNumber = "123456";
$request->Purchaser->InvoiceAddress->TaxOffice = "Kozyatağı";
$request->Purchaser->InvoiceAddress->CompanyName = "PosFix";
$request->Purchaser->InvoiceAddress->PhoneNumber = "2122222222";
#endregion

#region Kargo Adresi bilgileri
$request->Purchaser->ShippingAddress = new PurchaserAddress();
$request->Purchaser->ShippingAddress->Name = "Ahmet";
$request->Purchaser->ShippingAddress->SurName = "Veli";
$request->Purchaser->ShippingAddress->Address = "Mevlüt Pehlivan Mah-> PosFix Plaza Şişli";
$request->Purchaser->ShippingAddress->ZipCode = "34782";
$request->Purchaser->ShippingAddress->CityCode = "34";
$request->Purchaser->ShippingAddress->IdentityNumber = "1234567890";
$request->Purchaser->ShippingAddress->CountryCode = "TR";
$request->Purchaser->ShippingAddress->PhoneNumber = "2122222222";
#endregion

#region Ürün bilgileri
$request->Products = array();
$p = new Product();
$p->Title = "Telefon";
$p->Code = "TLF0001";
$p->Price = "5000";
$p->Quantity = 1;
$request->Products[0] = $p;

$p = new Product();
$p->Title = "Bilgisayar";
$p->Code = "BLG0001";
$p->Price = "5000";
$p->Quantity = 1;
$request->Products[1] = $p;

#endregion


$response = ApiPaymentRequest::execute($request, $settings);
print "\xA ApiPaymentRequest  \xA" . $response . "\xA" . "\xA";
