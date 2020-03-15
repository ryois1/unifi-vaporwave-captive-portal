
# unifi-vaporwave-captive-portal
A vaporwave inspired external captive portal for Ubiquiti UniFi
# Requirements

 - PHP 7+
 - php-curl
 - php-json
 - php-fpm
 - UniFi Controller version 4.0.0 or later
# Install
 - Clone/Download this repo
 - Configure nginx, see nginx configuration
 - Configure UniFi controller
# Nginx

    server{
    listen (optional IP:)80;
    root /path/to/directory;
    index index.php;
    location / {
        try_files $uri $uri/ index.php?$args;
    }
    location ~ \.php$ {
        fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
        fastcgi_intercept_errors on;
        include fastcgi_params;
        fastcgi_pass unix:/run/php-fpm/www.sock; #your php-fpm sock
    }
}
# UniFi Controller
![Screenshot of UniFi config](https://i.imgur.com/D00GJNy.png)
 - External portal server
 - IP of your nginx host
 - Pre Authorization Access: IP of your nginx host
