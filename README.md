# testblog


mysql:
```
create database testblog;
grant all on testblog.* to 'test'@'localhost' identfied by 'test';
flush privileges;
```

console:
```
mysql -hlocalhost -utest -ptest testblog < testblog.sql
```

apache:
```apache
DocumentRoot /var/www/testblog.com/web
<Directory /var/www/testblog.com/web>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```

edit:  App\config.php
user: admin:admin

