# PosFix Php

PosFix PHP Client Kütüphanesidir. PosFix API'lerine çok hızlı bir şekilde bağlanmanızı sağlar.
[https://www.posfix.com.tr](https://www.posfix.com.tr) adresimizden mağaza başvurusu yaparak
hesabınızı açabilirsiniz.


## Entegrasyon sürecinde dikkat edilecek noktalar

PosFix servislerini kullanabilmek için [PosFix'e](https://www.posfix.com.tr) üye olmalısınız. Üye olduktan sonra Mağaza Listesi > Detay sayfası içerisindeki Public ve Private Key sizinle paylaşılacaktır.Paylaşılan bu anahtarları -php projesinde Settings classda yer alan publicKey ve privateKey alanlarına eklemeniz gerekmektedir.
```php
$this->PublicKey = ""; // "Public Magaza Anahtarı - size mağaza başvurunuz sonucunda gönderilen publik key (açık anahtar) bilgisini kullanınız.",
$this->PrivateKey = ""; // "Private Magaza Anahtarı  - size mağaza başvurunuz sonucunda gönderilen privaye key (gizli anahtar) bilgisini kullanınız.",
$this->BaseUrl = "https://api.posfix.com.tr/"; //PosFix web servisleri API url'lerinin başlangıç bilgisidir. Restful web servis isteklerini takip eden kodlar halinde bulacaksınız.
```

Örnek projelerimizdeki servislerimizi daha iyi anlamak için [PosFix geliştirici merkezini](http://developer.posfix.com.tr) takip etmeniz büyük önem arz etmektedir.

* Entegrasyon işlemlerinde encoding “UTF-8” kullanılması önerilmektedir.Token parametrelerinden kaynaklı sorun encoding probleminden kaynaklanmaktadır. Özel karakterlerde encoding işlemi yapılmalıdır.
* Servis isteği yaparaken göndermiş olduğunuz alanların başında ve sonunda oluşabilecek boşluk alanlarını kaldırmanızı ( trim() ) önemle rica ederiz. Çünkü bu alanlar oluşacak hash sonuçlarını etkilemektedir.
* Entegrasyon dahilinde gönderilen input alanlarında, kart numarası alanı dışında kart numarası bilgisi gönderilmesi halinde işlem reddedilecektir.

PosFix örnek projelerinin amacı, yazılım geliştiricilere PosFix servislerine entegre olabilecek bir proje örneği sunmak ve entegrasyon adımlarının daha iyi anlaşılmasını sağlamaktır.
Projeleri doğrudan canlı ortamınıza alarak kod değişimi yapmadan kullanmanız için desteğimiz bulunmamaktadır. **Projeyi bir eğitsel kaynak (tutorial) olarak kullanınız.**

### Gerekli Teknolojiler
* PHP CLI Interpreter : 8.3.9
* PHP Language Level : 5.6
* XAMPP 

## Test Kartları

Testleriniz sırasında aşağıdaki kart numaralarını ve diğer bilgileri kullanabilirsiniz.

| Sıra No 	| Kart Numarası    	| SKT   	| CVC 	| Banka                 | Kart Ailesi            |
|---------	|------------------	|-------	|-----	| ---------------       | ---------              |
| 1       	| 4282209004348015 	| 12/26 	| 123 	| Garanti Bankası       | BONUS                  |
| 2       	| 5571135571135575 	| 12/26 	| 000 	| Akbank                | AXESS                  |
| 3       	| 4355084355084358 	| 12/26 	| 000 	| Akbank                | AXESS                  |
| 4       	| 4662803300111364 	| 10/25 	| 000 	| Alternatif Bank       | BONUS                  |
| 5      	| 4022774022774026 	| 12/24 	| 000 	| Finansbank            | CARD FINANS            |
| 6       	| 5456165456165454 	| 12/24 	| 000 	| Finansbank            | CARD FINANS            |
| 7         | 9792023757123604  | 01/26     | 861   | Finansbank            | FINANSBANK DEBIT       |
| 8       	| 4531444531442283 	| 12/24 	| 000 	| Aktif Yatırım Bankası | AKTIF KREDI KARTI      |
| 9       	| 5818775818772285 	| 12/24 	| 000 	| Aktif Yatırım Bankası | AKTIF KREDI KARTI      |
| 10      	| 4508034508034509 	| 12/24 	| 000 	| İş bankası            | MAXIMUM                |
| 11      	| 5406675406675403 	| 12/24 	| 000 	| İş bankası            | MAXIMUM                |
| 12      	| 4025903160410013 	| 07/26 	| 123 	| Kuveyttürk            | KUVEYTTURK KREDI KARTI |
| 13      	| 5345632006230604 	| 12/24 	| 310 	| Aktif Yatırım Bankası | AKTIF KREDI KARTI      |
| 14      	| 4282209027132016 	| 12/24 	| 358 	| Garanti Bankası       | BONUS                  |
| 15      	| 4029400154245816 	| 03/24 	| 373 	| Vakıf Bank            | WORLD                  |
| 16      	| 4029400184884303 	| 01/26 	| 378 	| Vakıf Bank            | WORLD                  |
| 17      	| 9792350046201275 	| 07/27	 	| 993 	| TÜRK ELEKTRONIK PARA  | PARAM KART             |
| 18      	| 6501700194147183	| 03/27	 	| 136 	| Vakıf Bank            | WORLD                  |
| 19     	| 6500528865390837	| 01/26	 	| 686 	| Vakıf Bank            | VAKIFBANK DEBIT        |

Test kartlarımızda alınan hata kodları ve çözümleriyle ilgili detaylı bilgiye ulaşabilmek için [PosFix Hata Kodları](https://developer.posfix.com.tr/home/ErrorCode) inceleyebilirsiniz.

### Örnek Kullanım Yöntemi
```php
	$settings = new Settings ();

	$request = new Api3DPaymentRequest();
	$request->OrderId = Helper::Guid();
	$request->Echo = "Echo";
	$request->Mode = $settings->Mode;
	$request->Amount = "100"; // 100 tL
	$request->CardOwnerName = $_POST ["nameSurname"];
	$request->CardNumber = $_POST ["cardNumber"];
	$request->CardExpireMonth = $_POST ["month"];
	$request->CardExpireYear = $_POST ["year"];
	$request->Installment = $_POST ["installment"];
	$request->Cvc = $_POST ["cvc"];
	$request->SuccessUrl = "https://apitest.posfix.com.tr/rest/payment/threed/test/result";
        $request->FailUrl = "https://apitest.posfix.com.tr/rest/payment/threed/test/result";


	// region Sipariş veren bilgileri
	$request->Purchaser = new Purchaser ();
	$request->Purchaser->Name = "Ahmet";
	$request->Purchaser->SurName = "Veli";
	$request->Purchaser->BirthDate = "1986-07-11";
	$request->Purchaser->Email = "ahmet@veli.com";
	$request->Purchaser->GsmPhone = "5881231212";
	$request->Purchaser->IdentityNumber = "1234567890";
	$request->Purchaser->ClientIp = Helper::get_client_ip ();
	// endregion

	// region Fatura bilgileri
	$request->Purchaser->InvoiceAddress = new PurchaserAddress ();
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
	// endregion

	// region Kargo Adresi bilgileri
	$request->Purchaser->ShippingAddress = new PurchaserAddress ();
	$request->Purchaser->ShippingAddress->Name = "Ahmet";
	$request->Purchaser->ShippingAddress->SurName = "Veli";
	$request->Purchaser->ShippingAddress->Address = "Mevlüt Pehlivan Mah-> PosFix Plaza Şişli";
	$request->Purchaser->ShippingAddress->ZipCode = "34782";
	$request->Purchaser->ShippingAddress->CityCode = "34";
	$request->Purchaser->ShippingAddress->IdentityNumber = "1234567890";
	$request->Purchaser->ShippingAddress->CountryCode = "TR";
	$request->Purchaser->ShippingAddress->PhoneNumber = "2122222222";
	// endregion

	// region Ürün bilgileri
	$request->Products = array ();
	$p = new Product ();
	$p->Title = "Telefon";
	$p->Code = "TLF0001";
	$p->Price = "5000";
	$p->Quantity = 1;
	$request->Products [0] = $p;

	$p = new Product ();
	$p->Title = "Bilgisayar";
	$p->Code = "BLG0001";
	$p->Price = "5000";
	$p->Quantity = 1;
	$request->Products [1] = $p;

	// endregion

    $response = $request->execute3D($settings);
```


## Hash Hesaplama
PosFix servislerine entegre olurken alınan hataların en sık karşılaşılanı hash değerinin doğru hesaplanmasıdır. Hash değeri her servise göre değişen verilerin yanyana eklenmesi ile oluşan değerin bir dizi işleme tabi tutulması ile oluşur.

Aşağıdaki adreste hash hesaplama ile ilgili detaylar yer almaktadır. Yine burada yer alan interaktif fonksiyon ile hesapladığınız hash fonksiyonlarını test edebilirsiniz.

[PosFix Hash Hesaplama](https://developer.posfix.com.tr/#hashCalculate)

Her örnek projenin Helper sınıfı içinde hash hesaplama ile alakalı bir fonksiyon bulunmaktadır. Entegrasyon sırasında bu hazır fonksiyonları da kullanabilirsiniz.

## Canlı Ortama Geçiş

* Test ortamında kullandığınız statik verilerin canlı ortamda gerçek müşteri datasıyla değiştirildiğinden emin olun.
* Canlı ortamda yanlış, sabit data gönderilmediğinden emin olun. Gönderdiğiniz işlemlere ait verileri mutlaka size özel panelden görüntüleyin.
* Geliştirmeler tamamlandıktan sonra ödeme adımlarını, PosFix test kartları ile tüm olası durumlar için test edin ve sonuçlarını görüntüleyin.
* PosFix servislerinden dönen ve olabilecek tüm hataları karşılayacak ve müşteriye uygun cevabı gösterecek şekilde kodunuzu düzenleyin ve test edin.
* PosFix hata kodları kullanıcı dostu mesajlar olup müşterinize gösterebilirsiniz.
* Hassas olmayan verileri ve servis yanıtlarını, hata çözümü ve olası sorunların çözümünde yardımcı olması açısından loglamaya dikkat edin.
* Canlı ortama geçiş sonrası ilk işlemleri kendi kredi kartlarınız ile deneyerek sonuçlarını size özel kurum ekranlarından görüntüleyin. Sonuçların ve işlemlerin doğru tamamlandığından emin olun.

Sorularınız olması durumunda bize [Destek](http://developer.posfix.com.tr/Home/Support) üzerinden yazabilirsiniz.
