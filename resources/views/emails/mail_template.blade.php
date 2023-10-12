<!DOCTYPE html>
<html>
<head>
    <title>DPMPTSP Indramayu</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>Pengaduan : </p>
    <p>{{ $mailData['body']['isi'] }}</p>
    <p>Jawaban :</p>
    <p>{{$mailData['body']['jawab']}}</p>
    <p>Diterima & Dijawab oleh : {{$mailData['body']['petugas']}}</p>
</body>
</html>