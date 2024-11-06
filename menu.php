<?php
ini_set('display_errors',1);
error_reporting(E_ERROR );

include_once("Settings.php");
include_once ("helper.php");
include_once ("base.php");
include_once ("restHttpCaller.php");
include_once ("BinNumberInquiryRequest.php");
include_once ("BinNumberInquiryRequestV4.php");
include_once ("BankCardInquiryRequest.php");
include_once ("ApiPaymentRequest.php");
include_once ("Api3DPaymentRequest.php");
include_once ("BankCardCreateRequest.php");
include_once ("BankCardDeleteRequest.php");
include_once ("PaymentInquiryRequest.php");
include_once ("LinkPaymentCreateRequest.php");
include_once ("LinkPaymentListRequest.php");
include_once ("LinkPaymentDeleteRequest.php");
include_once("PaymentRefundInquiryRequest.php");
include_once("CreatePaymentRefundRequest.php");
include_once("CheckoutFormCreateRequest.php");
include_once ("PreAuthRequest.php");
include_once ("PostAuthRequest.php");

?>

<html lang="tr">

    <head>
        <title>PosFix Developer Portal</title>
        <link href="Content/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="Content/Site.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
    </head>

    <body>

          <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">

                <img src="Content/posfix-logo.png" width="100" height="100" />
                <ul class="nav navbar-nav">
                    <li><a href="Api3DPayment.php">Tek Adımda 3D Ödeme</a></li>
                    <li><a href="ApiPayment.php">(Non-3d) Ödeme</a></li>
                    <li><a href="PreAuth.php">Ön Otorizasyon Açma</a></li>
                    <li><a href="PaymentInquiry.php">Ödeme Sorgulama</a></li>
                    <li><a href="PostAuth.php">Ön Otorizasyon Kapama</a></li>
                    <li><a href="binInquiry.php">Bin Sorgulama</a></li>
                    <li><a href="binInquiryV4.php">Bin Sorgulama V4</a></li>
                    <li><a href="AddCardToWallet.php">Cüzdana Kart Ekle </a></li>
                    <li><a href="GetCardFromWallet.php">Cüzdandaki Kartları Listele</a></li>
                    <li><a href="DeleteCardFromWallet.php">Cüzdandan Kart Sil</a></li>
                    <li><a href="ApiPaymentWithWallet.php">Cüzdandaki Kart Tek Tıkla Ödeme</a></li>
                    <li><a href="Api3DPaymentWithWallet.php">Cüzdandaki Kart Tek Tıkla 3D Ödeme</a></li>
                    <li><a href="LinkPaymentCreate.php">Link İle Ödeme (Link Gönderim)</a></li>
                    <li><a href="LinkPaymentList.php">Link İle Ödeme (Link Sorgulama)</a></li>
                    <li><a href="LinkPaymentDelete.php">Link İle Ödeme (Link Silme)</a></li>
                    <li><a href="CreatePaymentRefund.php">İade Oluşturma</a></li>
                    <li><a href="PaymentRefundInqury.php">İade Sorgulama</a></li>
                    <li><a href="CheckoutFormCreate.php">Checkout From Oluşturma</a></li>
                </ul>
            </div>
        </div>
    </div>
<div class="container body-content">

    <br />
    <br />
    <br />
