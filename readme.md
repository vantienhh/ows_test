## Cài môi trường
- php
- apache
- mysql

### Linux
#### Apache
- Cài đặt apache
```
sudo apt-get install apache2
```
- Thay đổi thư mục localhost mặc định
    - sudo nano /etc/apache2/sites-enabled/000-default
        - Thay đổi **DocumentRoot /var/www** thành **DocumentRoot ĐƯỜNG_DẪN_THƯ_MỤC_CODE**
        - Thay đổi **<Directory /var/www/>** thành **<Directory ĐƯỜNG_DẪN_THƯ_MỤC_CODE/>**
    - sudo service apache2 restart
    
#### PHP
- Cài PHP và libapache2-mod-php7.2 (phiên bản PHP tương ứng)
- sudo service apache2 restart

#### MYSQL
- Cài mysql
- mysql -u root -p
    - Điền mật khẩu
```mysql
create database ows_test;
```


### Mac
#### Apache
- sudo apachectl start
- sudo nano /etc/apache2/httpd.conf
    - Thay dòng DocumentRoot "/Library/WebServer/Documents" thành DocumentRoot "ĐƯỜNG_DẪN_THƯ_MỤC_CODE"
    VD: DocumentRoot "/Users/levantien/Lập trình/ows_test"
    - Thay đổi đường dẫn trong thẻ <Directory> thành   <Directory "ĐƯỜNG_DẪN_FOLDER">
    VD: <Directory "/Users/levantien/Lập trình/ows_test">
    - Thay AllowOverride None trong block của <Directory> thành ALL
    VD: AllowOverride All
 - sudo apachectl restart

#### PHP
- sudo nano /etc/apache2/httpd.conf
    - Bỏ dấu comment (#) ở dòng LoadModule php7_module libexec/apache2/libphp7.so (hoặc version PHP tương ứng)
- sudo apachectl restart

#### MYSQL
- brew install mysql
- brew services start mysql
- mysql -u root -p
    - Điền mật khẩu
```mysql
create database ows_test;
```
