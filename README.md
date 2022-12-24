# Proje Hakkında

## Installation & Demo
`Install.md` dosyasını takip ederek projeyi çalıştırabilirsiniz.  
Sonrasında aşağıdaki adreslerden demoyu görebilirsiniz:
```text
Turkish ---> http://127.0.0.1:8000/demo/tr
English ---> http://127.0.0.1:8000/demo/en
```  

## Özet
Demo, 3 Mezun sayfasının kopyasıdır.
Seçilen mezunların dinamik olarak değiştiği bir örnektir.
Uygulama kurulumu sırasında bir grup öğrenci random olarak üretilir.
Seçilecek öğrenciler belirli aralıklarla güncellenir.
Gösterilen öğrenciler bir sonraki random seçimde gösterilmez.

## Öğrencilerin Üretilmesi
Örnek: Aşağıdaki komut ile 50 random öğrenci üretilir. 
```shell
php artisan student:seed 50
```
Öğrencilerin random üretilmesinden sorumlu class: `app/Console/Commands/SeedStudents.php`  
Üretilen öğrenci dataları `storage/app/students.txt` dosyasında saklanır.

## Seçilecek Öğrencilerin Güncellenmesi
Örnek: Aşağıdaki komut ile birlikte 5 random öğrenci seçilir ve seçilen öğrenciler indexleri kaydedilir 
(Bir sonraki seçimde aynı öğrencilerin gösterilmemesi için.) 
```shell
php artisan student:update-indexes 5
```

Bu komut her 1 dakikada otomatik olarak çalıştırılır.  
Komutun hangi sıklıkla çağıralacağını belirleyen class: `app/Console/Kernel.php`  
Bu class içerisinde her `1` dakikada random `3` öğrenci seçileceği tanımlanır:
```php
protected function schedule(Schedule $schedule): void
{
    $numberOfSelectedStudents = 3;
    $schedule->command("student:update-indexes {$numberOfSelectedStudents}")->everyMinute();
}
```
Diğer frekans seçenekleri için: https://laravel.com/docs/9.x/scheduling#schedule-frequency-options

Öğrencilerin random seçiminden sorumlu class: `app/Console/Commands/UpdateStudentIndexes.php`  

Seçilen öğrencilerin indexleri `storage/app/indexes.txt` dosyasında saklanır.

## Routes ve İçeriğin Üretilmesi
Route dosyası: `routes/web.php` Gelen `GET` isteğinin karşılandığı dosyadır.  
`Blade` (https://laravel.com/docs/9.x/blade) tarafından üretilmiş html sayfası döner.
Blade Template'lerini `resources/views` dosyası altında bulabilirsiniz. Ana Blade Template'i `resources/views/app.blade.php`'dır.  

Bu template içerisinde, verilen `lang` parametresine göre `İngilizce` veya `Türkçe` içerik üretilir:  
```php
@if($lang === 'tr')
    @include('tr.alumni')
@else
    @include('en.alumni')
@endif
```

```text
tr.alumni --> resources/views/tr/alumni.blade.php
en.alumni --> resources/views/en/alumni.blade.php
```
`lang` parametresi `routes/web.php`'dan `resources/views/app.blade.php`'a verilir:
```php
return view('app',
        [
            "lang" => $lang,
            ...
            ...
```
