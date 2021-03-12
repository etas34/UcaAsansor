<html>
<head></head>
<body>
<p>Merhaba  <strong>{{ $atanan_user }}</strong></p>
<p><strong>{{ $atayan_user }}</strong> size yeni bir görev atamıştır.</p>
<p><strong>Görev Başlığı		:</strong> {{ $gorev_baslik }}</p>
<p><strong>Görev İçerik    		:</strong> {{ $gorev_icerik }}</p>
<p>Detaylar için tıklayınız     : <a href="{{URL::to('/')}}">http://ucaasansor.net/yonetim</a></p>
</body>
</html>
