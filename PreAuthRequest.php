<?php


//Müşteri bilgilerinin bulunduğı sınıfı temsil eder.


class PreAuthRequest extends BaseRequest
{
    public $Threed;
    public $OrderId;
    public $Amount;
    public $CardOwnerName;
    public $CardNumber;
    public $CardExpireMonth;
    public $CardExpireYear;
    public $Installment;
    public $CardCvc;
    public $UserId;
    public $CardId;
    public $WaitingConfirmation;
    public $Products;
    public $Purchaser;


    public static function execute(PreAuthRequest $request, Settings $settings)
    {
        $settings->transactionDate = Helper::GetTransactionDateString();
        $settings->HashString = $settings->PrivateKey . $request->OrderId . $request->Amount . $request->Mode . $request->CardOwnerName . $request->CardNumber . $request->CardExpireMonth . $request->CardExpireYear . $request->CardCvc . $request->UserId . $request->CardId . $request->Purchaser->Name . $request->Purchaser->SurName . $request->Purchaser->Email . $settings->transactionDate;
        return restHttpCaller::post($settings->BaseUrl . "rest/payment/preauth", Helper::GetHttpHeaders($settings, "application/json"), $request->toJsonString());
    }

    public function toJsonString()
    {

        $products = [];
        foreach ($this->Products as $product) {
            $tmp['productCode'] = $product->Code;
            $tmp['productName'] = $product->Title;
            $tmp['quantity'] = $product->Quantity;
            $tmp['price'] = $product->Price;
            $products[] = $tmp;
        }
        return json_encode([
            "orderId" => $this->OrderId,
            "echo" => $this->Echo,
            "mode" => $this->Mode,
            "amount" => $this->Amount,
            "cardOwnerName" => $this->CardOwnerName,
            "cardNumber" => $this->CardNumber,
            "cardExpireYear" => $this->CardExpireYear,
            "cardExpireMonth" => $this->CardExpireMonth,
            "installment" => $this->Installment,
            "cardCvc" => $this->CardCvc,
            "cardId" => $this->CardId,
            "userId" => $this->UserId,
            "threed" => $this->Threed,
            "waitConfirmation" => $this->WaitingConfirmation,
            "purchaser" => [
                "name" => $this->Purchaser->Name,
                "surname" => $this->Purchaser->Surname,
                "email" => $this->Purchaser->Email,
                "clientIp" => $this->Purchaser->ClientIp,
                "invoiceAddress" => [
                    "name" => $this->Purchaser->InvoiceAddress->Name,
                    "surname" => $this->Purchaser->InvoiceAddress->SurName,
                    "address" => $this->Purchaser->InvoiceAddress->Address,
                    "zipcode" => $this->Purchaser->InvoiceAddress->ZipCode,
                    "city" => $this->Purchaser->InvoiceAddress->CityCode,
                    "country" => $this->Purchaser->InvoiceAddress->CountryCode,
                    "tcCertificate" => $this->Purchaser->InvoiceAddress->IdentityNumber,
                    "taxNumber" => $this->Purchaser->InvoiceAddress->TaxNumber,
                    "taxOffice" => $this->Purchaser->InvoiceAddress->TaxOffice,
                    "companyName" => $this->Purchaser->InvoiceAddress->CompanyName,
                    "phoneNumber" => $this->Purchaser->InvoiceAddress->PhoneNumber
                ],
                "shippingAddress" => [
                    "name" => $this->Purchaser->ShippingAddress->Name,
                    "surname" => $this->Purchaser->ShippingAddress->SurName,
                    "address" => $this->Purchaser->ShippingAddress->Address,
                    "zipcode" => $this->Purchaser->ShippingAddress->ZipCode,
                    "city" => $this->Purchaser->ShippingAddress->CityCode,
                    "country" => $this->Purchaser->ShippingAddress->CountryCode,
                    "tcCertificate" => $this->Purchaser->ShippingAddress->IdentityNumber,
                    "phoneNumber" => $this->Purchaser->ShippingAddress->PhoneNumber
                ]
            ],
            "products" => $products
        ]);
    }


}


class Purchaser
{
    public $Name;
    public $Surname;
    public $BirthDate;
    public $Email;
    public $GsmPhone;
    public $IdentityNumber;
    public $ClientIp;
    public $InvoiceAddress;
    public $ShippingAddress;

}

//Müşteri adresi bilgilerinin bulunduğı sınıfı temsil eder.

class PurchaserAddress
{

    public $Name;
    public $Surname;
    public $Address;
    public $ZipCode;
    public $CityCode;
    public $IdentityNumber;
    public $CountryCode;
    public $TaxNumber;
    public $TaxOffice;
    public $CompanyName;
    public $PhoneNumber;
}


//Ürün bilgilerinin bulunduğu sınıfı temsil eder.

class Product
{
    public $Code;

    public $Title;

    public $Quantity;

    public $Price;
}
