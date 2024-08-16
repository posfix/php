<?php

	//Müşteri bilgilerinin bulunduğı sınıfı temsil eder.

        

class CheckoutFormCreateRequest extends  BaseRequest
{
    public $Threed;
    public $OrderId;
    public $Amount;
    public $AllowedInstallments;
    public $VendorId;
    public $Products;
    public $Purchaser;
    public $CallbackUrl;
                      
    public static function execute(CheckoutFormCreateRequest $request, Settings $settings)
    {
          $settings->transactionDate = Helper::GetTransactionDateString();
          $settings->HashString = $settings->PrivateKey . $request->Mode . $request->Purchaser->Name . $request->Purchaser->SurName . $request->Purchaser->Email . $settings->transactionDate;
          return  restHttpCaller::post($settings->BaseUrl . "rest/checkoutForm/create", Helper::GetHttpHeaders($settings, "application/json"), $request->toJsonString());
    }
	
    public function toJsonString()
    {
        return json_encode([
            "script" => $this->script,
            "iframeUrl" => $this->iframeUrl,           
        ]);
    }

}