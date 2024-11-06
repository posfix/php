<?php include('menu.php'); ?>

    <fieldset>
        <legend>
            <label style="font-weight: bold; width: 250px;">Sepet Bilgileri</label>
        </legend>
        <table class="table">
            <thead>
            <tr>
                <th>Ürün</th>
                <th>Kod</th>
                <th>Adet</th>
                <th>Birim Fiyat</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Telefon</td>
                <td>TLF0001</td>
                <td>1</td>
                <td>50.00 TL</td>
            </tr>
            <tr>
                <td>Bilgisayar</td>
                <td>BLG0001</td>
                <td>1</td>
                <td>50.00 TL</td>
            </tr>

            <tr>
                <td colspan="3">Toplam Tutar</td>

                <td>100.00 TL</td>
            </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset>
        <legend>
            <label style="font-weight: bold; width: 250px;">Kargo Adresi Bilgileri</label>
        </legend>
        <label style="font-weight: bold;">Ad :</label> Ahmet<br> <label style="font-weight: bold;">Soyad :</label> Veli
        <br>
        <label style="font-weight: bold;">Adres :</label> Mevlüt Pehlivan Mah. PosFix Plaza Şişli <br> <label
                style="font-weight: bold;"
        >Posta Kodu :</label> 34782 <br> <label style="font-weight: bold;">Şehir :</label> İstanbul <br> <label
                style="font-weight: bold;"
        >Ülke :</label> Türkiye <br> <label style="font-weight: bold;">Telefon Numarası:</label> 2123886600 <br>
    </fieldset>
    <fieldset>
        <legend>
            <label style="font-weight: bold; width: 250px;">Fatura Adresi Bilgileri</label>
        </legend>
        <label style="font-weight: bold;">Ad :</label> Ahmet<br> <label style="font-weight: bold;">Soyad :</label>
        Veli<br>
        <label style="font-weight: bold;">Adres :</label> Mevlüt Pehlivan Mah. PosFix Plaza Şişli<br> <label
                style="font-weight: bold;"
        >Posta Kodu :</label> 34782<br> <label style="font-weight: bold;">Şehir :</label> İstanbul<br> <label
                style="font-weight: bold;"
        >Ülke :</label> Türkiye<br> <label style="font-weight: bold;">TC Kimlik Numarası :</label> 1234567890<br> <label
                style="font-weight: bold;"
        >Telefon Numarası:</label> 2123886600<br> <label style="font-weight: bold;">Vergi Numarası :</label> 123456<br>
        <label
                style="font-weight: bold;"
        >Vergi Dairesi Adı :</label> Kozyatağı<br> <label style="font-weight: bold;">Firma Adı:</label> PosFix
    </fieldset>
    <form
            method="post"
            class="form-horizontal"
    >
        <fieldset>
            <!-- Form Name -->
            <legend>
                <label style="font-weight: bold; width: 250px;">Kart Bilgileriyle Ödeme</label>
            </legend>
            <!-- Text input-->
            <div class="form-group">
                <label
                        class="col-md-4 control-label"
                        for=""
                >Kart Sahibi Adı Soyadı:</label>
                <div class="col-md-4">
                    <input
                            value="Fatih Coskun"
                            name="nameSurname"
                            class="form-control input-md"
                    >
                </div>
            </div>
            <div class="form-group">
                <label
                        class="col-md-4 control-label"
                        for=""
                > Kart Numarası:</label>
                <div class="col-md-4">
                    <input
                            value="4662803300111364"
                            name="cardNumber"
                            class="form-control input-md"
                    >
                </div>
            </div>
            <div class="form-group">
                <label
                        class="col-md-4 control-label"
                        for=""
                > Son Kullanma Tarihi Ay/Yıl: </label>
                <div class="col-md-4">
                    <input
                            value="10"
                            name="month"
                            class="form-control input-md"
                            width="50px"
                    > <input
                            value="25"
                            name="year"
                            class="form-control input-md"
                            width="50px"
                    >
                </div>
            </div>
            <div class="form-group">
                <label
                        class="col-md-4 control-label"
                        for=""
                > CVC: </label>
                <div class="col-md-4">
                    <input
                            value="000"
                            name="cvc"
                            class="form-control input-md"
                    >
                </div>
            </div>
        </fieldset>
        Taksit Sayısı <select name="installment">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>
        <!-- Button -->
        <div class="form-group">
            <label
                    class="col-md-4 control-label"
                    for=""
            ></label>
            <div class="col-md-4">
                <button
                        type="submit"
                        id=""
                        name=""
                        class="btn btn-success"
                >Ön Otorizasyon Açma
                </button>
            </div>
        </div>
    </form>

<?php if (!empty($_POST)): ?>
    <?php

    $settings = new Settings();

    $request = new PreAuthRequest();
    $request->OrderId = Helper::Guid();
    $request->Echo = "Echo";
    $request->Mode = $settings->Mode;
    $request->Amount = "10000"; // 100 tL
    $request->CardOwnerName = $_POST['nameSurname'];
    $request->CardNumber = $_POST['cardNumber'];
    $request->CardExpireYear = $_POST['year'];
    $request->CardExpireMonth = $_POST['month'];
    $request->Installment = $_POST['installment'];
    $request->CardCvc = $_POST['cvc'];
    $request->CardId = "";
    $request->UserId = "";
    $request->Threed = "false";
    $request->WaitingConfirmation = "false";

    $request->Purchaser = new Purchaser();
    $request->Purchaser->Name = "Ahmet";
    $request->Purchaser->SurName = "Veli";
    $request->Purchaser->BirthDate = "1986-07-11";
    $request->Purchaser->Email = "ahmet@veli.com";
    $request->Purchaser->GsmPhone = "5881231212";
    $request->Purchaser->IdentityNumber = "1234567890";
    $request->Purchaser->ClientIp = "127.0.0.1";

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

    $request->Purchaser->ShippingAddress = new PurchaserAddress();
    $request->Purchaser->ShippingAddress->Name = "Ahmet";
    $request->Purchaser->ShippingAddress->SurName = "Veli";
    $request->Purchaser->ShippingAddress->Address = "Mevlüt Pehlivan Mah-> PosFix Plaza Şişli";
    $request->Purchaser->ShippingAddress->ZipCode = "34782";
    $request->Purchaser->ShippingAddress->CityCode = "34";
    $request->Purchaser->ShippingAddress->IdentityNumber = "1234567890";
    $request->Purchaser->ShippingAddress->CountryCode = "TR";
    $request->Purchaser->ShippingAddress->PhoneNumber = "2122222222";

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

    $response = PreAuthRequest::execute($request, $settings);
    $output = Helper::formattoJSONOutput($response);
    print "<h3>Sonuç:</h3>";
    echo "<pre>";
    echo htmlspecialchars($output);
    echo "</pre>";

    ?>
<?php endif; ?>

<?php include('footer.php'); ?>