# Kurulum
- İlk olarak proje dizininde composer install çalıştırılmalı
- Veritabanı tablolarımı oluşturmak için php artisan migrate komutu çalıştırılmalı


# Bilgiler
- Kullanıcıya abonelik eklemek için öncelikle many to many yapısında olan abonelik tablosuna örnek bir kayıt eklenmeli.
- Postman üzerinden abonelik, ödeme ve kullanıcı işlemleri için gönderilecek isteklerde login veya register işleminde dönen token'i Authorization token olarak kullanılmalı.
- Aylık süresi bitmiş abonelikleri yenileyen yapıyı çalıştırmak için php artisan schedule:work çalıştırılması gerekli.
