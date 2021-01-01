# Halk Bankası Hesap Hareketleri Web Servis
Bu aşamaya gelmeniz için banka hareketlerini çekeceğiniz hesap için bankaya talimat vermeniz gerekiyor. <br>
Banka sizin vereceğiniz bir ip adresinde kullanılabilir  kullanıcı adı ve parola tanımlıyor, sizde bu aşamada o ip adresi üzerinden sorgu oluşturabiliyorsunuz.

# Bankaya başvuru
Başvuru formunu projenin içinde bulabilirsiniz, gerekli alanları doldurup bankanın herhangi bir şubesine vermeniz yeterli. Bir kaç gün içerisinde geri dönüş yapacaklardır. <br>
E Posta olarak kullanıcı adını, sms olarak parolayı gönderiyorlar.


# Ayarlar
// Kodda göreceğiniz gibi olarak header ayarlarını yaptık. Daha sonra EkstreSorgulama metodu için gerekli parametleri girdik.<br>
Header parametlerinden WSS-Password Type, "PasswordText" türünde olmalıdır.<br>

// Bu alana size gönderdikleri kullanıcı adı ve parolayı girin.<br>
$username = "";<br>
$password = "";<br>

// Bu alanada hesap ekstresi için sorgulamak istediğiniz tarihleri girin. <br>
$start_date = '2020-12-12'; <br>
$end_date = '2020-12-15'; <br>

# İstek Parametreleri
BaslangicTarihi - DateTime - Sorgulama yapılacak tarih aralığına ait
başlangıç tarihi <br>
BitisTarihi -  DateTime - Sorgulama yapılacak tarih aralığına ait bitiş tarihi

# Cevap Parametreleri

HataKodu string -  Hata Kodu* <br>
HataAciklama string - Hata açıklama* <br>
HesapTuru string - Hesabın türünü belirtir, vadeli - vadesiz <br>
HesapNo string (Hesap[]) - Şube kodu – Müşteri Numarası – Hesap Numarası bilgilerini içerir <br>
MusteriNo string - Müşteri numarasıdır <br>
SubeKodu string - Hesabın bağlı bulunduğu şube kodudur <br>
SubeAdi string - Hesabın bağlı olduğu şube adıdır <br>
HesapAcilisTarihi string - Hesabın açıldığı tarih bilgisidir. (GG/AA/YYYY) <br>
SonHareketTarihi string - Hesabın işlem gördüğü son tarih bilgisidir <br>
Bakiye string - Sorgulanan tarih aralığındaki son bakiye bilgisidir <br>
HesapAdi string - Hesap sahibi tarafından verilen takma ad bilgisidir <br>
HesapCinsi string - Hesaın döviz cinsi bilgisidir <br>
BlokeMeblag string - Hesaba ait bloke edilmiş, kullanılmayan tutardır <br>
KullanilabilirBakiye string - Hesabın sorgulandığı andaki bakiye bilgisidir<br>
KrediLimit string - Hesabın sorgulandığı andaki açık hesap limitidir.<br>
KrediliKullanilabilirBakiye string - Hesabın sorgulandığı andaki bakiye + Kredi limit dahil bakiye bilgisidir <br>
VadeTarihi string - Son vade tarihidir yalnızca vadeli hesaplarda görünüdür<br>
FaizOrani string - Faiz oranı bilgisidir yalnızca vadeli hesaplarda görünür <br>

# Cevap Parametreleri - Hareketler
Tarih string - İşlem tarihidir <br>
Saat string - İşlem saatidir <br>
SiraNo string - Muhasebe sıra numarasıdır <br>
HareketTutari string - İşlemin muhasebe tutarıdır. Borç/Alacak bilgisi için "+/-" ve ayraç olarak "," kullanılır.<br>
Bakiye string - İşlem sonrası bakiye bilgisidir <br>
EktreAciklama  - İşlem açıklaması <br
Aciklama - Bazı özel işlemler için kullanılan açıklama bilgisidir Örn : Dosyalı transfer işlem açıklamaları <br>
IslemKod string - Yapılan işlemin MT940 ekstre standardı işlem kodları bilgisidir.(MSC,TRF, FEX vs) <br>
ReferansNo string - Referans numarası <br>
DekontNo string - Dekont Numarası <br>
Iptal string - İlgili işlemin iptal edilip edilmediğini gösterir , (E: Evet iptal edilmiş, H: Hayır iptal edilmemiş) <br>
KarsiMusteriNo string - İşlemi yapan tarafın müşteri numarası <br>
KarsiAdSoyad string - İşlemi yapan tarafın ad soyad bilgisi <br>
KarsiBankaKod string - İşlemi yapan tarafın bağlı olduğu banka kodu <br>
KarsiSubeKod string - İşlemi yapan tarafın bağlı olduğu şube kodu <br>
KarsiHesapIBAN string - İşlemi yapan tarafın IBAN bilgisi <br>
KarsiKimlikNo string - İşlemi yapan tarafın kimlik bilgisidir. (TC No, Vergi No, Yabancı Kimlik No) <br>
IslemYapanKimlikNo string - İşlemi gerçekleştiren kişinin kimlik bilgisidir <br>
İslemYapanAdSoyad string - İşlemi gerçekleştiren kişinin ad soyad bilgisidir <br>
AtmNo string - İşlemin gerçekleştiği ATM bilgisidir

<br><br>
Burda dikkat etmeniz gereken Üst taraftaki bakiye, hesabın güncel bakiyesi değildir. İki tarih arasındaki hareketlerin bakiyesidir. Hesabın güncel bakiyesi "KullanilabilirBakiye" parametresidir, burası sizi yanıltmasın, nerden biliyorum :))

<br>
Bunlardan haric BagliHesapEkstreRequest, DekontSorgulama diye iki adet sorgulama var onlarıda gelecek günlerde paylaşıyor olacağım.
