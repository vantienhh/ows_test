## Cài môi trường
1/ Apache
- Cài đặt apache
```
sudo apt-get install apache2
```
- Thay đổi thư mục localhost mặc định
    - sudo nano /etc/apache2/sites-enabled/000-default
        - Thay đổi **DocumentRoot /var/www** thành **DocumentRoot ĐƯỜNG_DẪN_THƯ_MỤC_CODE**
        - Thay đổi **<Directory /var/www/>** thành **<Directory ĐƯỜNG_DẪN_THƯ_MỤC_CODE/>**
    - sudo service apache2 restart
    
2/ PHP
- Cài PHP và libapache2-mod-php7.2 (phiên bản PHP tương ứng)
- sudo service apache2 restart

3/ MYSQL
- Cài mysql
- mysql -u root -p
    - Điền mật khẩu
```mysql
create database ows_test;
```

## RUN
1/ env
```
cp .env.example .env
```
(Thay đổi **DB_USER** và **DB_PASSWORD** trong file **env**)

2/ composer
```
composer install
```
