<?php

class PostAuthRequest extends BaseRequest
{
    public $OrderId;
    public $Amount;
    public $ClientIp;


    public static function execute(PostAuthRequest $request, Settings $settings)
    {
        $settings->transactionDate = Helper::GetTransactionDateString();
        $settings->HashString = $settings->PrivateKey . $request->OrderId . $request->Amount . $request->Mode . $request->ClientIp . $settings->transactionDate;
        return restHttpCaller::post($settings->BaseUrl . "rest/payment/postauth", Helper::GetHttpHeaders($settings, "application/json"), $request->toJsonString());
    }

    public function toJsonString()
    {
        return json_encode([
            "orderId" => $this->OrderId,
            "mode" => $this->Mode,
            "amount" => $this->Amount,
            "clientIp" => $this->ClientIp
        ]);
    }
}