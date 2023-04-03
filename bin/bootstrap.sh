#!/usr/bin/env bash

sudo -s

apt-get update

# Required packages
apt-get -y install  apache2
apt-get -y install  libnss-mdns
apt-get -y install  libssl0.9.8
apt-get -y install  language-pack-de-base
apt-get -y install  python-software-properties
add-apt-repository -y ppa:ondrej/php

apt-get update
apt-get -y install php7.2
apt-get -y install php-pear php7.2-curl php7.2-dev php7.2-gd php7.2-mbstring php7.2-zip php7.2-mysql php7.2-xml php7.2-xdebug

a2enmod php7.2

service apache2 restart
debconf-set-selections <<< 'mysql-server mysql-server/root_password password rootpass'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password rootpass'
apt-get -y install mysql-server

# MySQL configuration, cannot be linked because MySQL refuses to load world-writable configuration
service mysql restart

## a2dismod php5

# Allow access from host
mysql -uroot -prootpass -e "DROP DATABASE supersonic_heavy_vulture;"
mysql -uroot -prootpass -e "CREATE DATABASE supersonic_heavy_vulture CHARACTER SET utf8 COLLATE utf8_general_ci;"
mysql -uroot -prootpass -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%'; FLUSH PRIVILEGES;"
# mysql -uroot -prootpass supersonic_heavy_vulture < /var/www/html/bin/supersonic_heavy_vulture_2.sql

sed -i.bak s/128M/1024M/g /etc/php/7.2/apache2/php.ini
sed -i.bak s/"html_errors = Off"/"html_errors = On"/g /etc/php/7.2/apache2/php.ini

## add xdebug configuration
cat /var/www/html/bin/xdebug.config.txt >> /etc/php/7.2/apache2/php.ini

# Publish; Note that document root /home/vagrant/www is on the native virtual filesystem, the linked modules will be in an rsync'ed shared folder (one direction: host=>guest)
# a2enmod proxy
a2enmod rewrite
cp /var/www/html/bin/000-default.conf /etc/apache2/sites-available/
rm /var/www/html/index.html
service apache2 restart

## SSH settings
sed -i.bak s/"PasswordAuthentication no"/"PasswordAuthentication yes"/g /etc/ssh/sshd_config
service ssh restart
