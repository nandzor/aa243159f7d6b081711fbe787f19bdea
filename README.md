berikut adalah aplikasi API send email
fitur:
1. send email
2. insert data to table

Maaf sebelumnya saya sama sekali belum pernah menggunakan PostgreSQL, Docker dan Oauth2 untuk authentikasi.
Maaf saya hanya bisa mengerjakan sebisa saya saja :)

Dari Codingan ini saya mengambil refrensi dari https://developer.okta.com/blog/2019/03/08/simple-rest-api-php
Saya ikuti flow nya sebagai refrensi
kemudian saya code ulang sesuai kebutuhan
Saya tambahkan configurasi .env
Untuk test email, saya pakai MailTrap
Kemudian Saya coba skalian deh menggunakan Okta untuk Oauth2 nya
Namun setelah coba saya tambahkan token ke header api yang saya buat,
apache2 saya ngehang.
Setelah saya coba2 dan tidak bisa trace dimana errornya saya sampai pusing.
Akhirnya saya pakai Simple Auth saja hehe.
Mungkin next time kalo saya beneran diterima kerja saya akan coba belajar banyak lg tentang authorization dan authentication.
Terutama Oauth2, dan juga docker
So far email send dan insert data nya sudah jalan.

