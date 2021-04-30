#!/bin/bash

#---------Verify running as root---------#
# must run shell script as root
if [ "$(id -u)" != "0" ]; then
  echo "This script must be run as root" 1>&2
  exit
fi

# script should be run after installation.sh is ran (needs apache2 preinstalled)

# Configure firewall. Script needs user with sudo permissions.
# adjusting firewall. Allows outside to access default ports.

# Profile opens port 443 (TLS/SSL encrypted traffic) & port 80 (unencrypted traffic)
sudo ufw allow 'Apache Full'

# restart apache2/web service system
sudo systemctl reload apache2

#----------Configuring IPTables----------#
# https://www.hostinger.com/tutorials/iptables-tutorial
# check status of IP Tables
sudo iptables -L -v
# needed to begin appending rules to iptables
sudo iptables -A
# enable traffic to localhost
sudo iptables -A INPUT -i lo -j ACCEPT
# Enable TCP traffic to apecified ports 22, 80, 443
sudo iptables -A INPUT -p tcp --dport 22 -j ACCEPT
sudo iptables -A INPUT -p tcp --dport 80 -j ACCEPT
sudo iptables -A INPUT -p tcp --dport 443 -j ACCEPT
# Display appended rules to verify everything is set correctly
sudo /sbin/iptables-save

#----------Configuring Snort----------#
# Change ipvar HOME_NET in snort.conf to system IP address (172.31.16.222/20)
# sudo gedit /etc/snort/snort.conf
sed -i -e 's/ipvar HOME_NET.*/ipvar HOME_NET 172.31.16.222\/20/g' /etc/snort/snort.conf
# get latest rules for snort to have up-to-date attack definitions and protection actions
sudo wget https://www.snort.org/rules/snortrules-snapshot-3130.tar.gz?oinkcode=a5b122e19f9a34460f63a5437fbac7cacbfe601d
# unzip updated snort rules folder to /etc/snort/rules
sudo tar -xvzf snortrules-snapshot-2983.tar.gc -C /etc/snort/rules
# Enable Promiscuous Mode for our network inferface to listen to all network traffic on our instance
sudo ip link set eth0 promisc on
# Run Snort
# -d filters out application layer packets
# -l log sets log directory
# -A sends alert to console
# -c indicates which config file to use
sudo snort -d -l /var/log/snort/ -h 172.31.16.222/20 -A console -c /etc/snort/snort.conf
# Snort Implementation complete

#----------Configuring Virtual Host------------#
# Open files for the new Domain Name
sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/424dasquad.com.conf
sudo nano /etc/apache2/sites-available/424dasquad.com.conf
# write in 424dasquad.com.conf
echo "<VirtualHost *:80>" >>/etc/apache2/sites-available/424dasquad.com.conf
echo "  ServerName 424dasquad.com" >> /etc/apache2/sites-available/424dasquad.com.conf
echo "  ServerAlias www.424dasquad.com" >> /etc/apache2/sites-available/424dasquad.com.conf
echo "  ServerAdmin dasquad424@gmail.com" >> /etc/apache2/sites-available/424dasquad.com.conf
echo "  DocumentRoot /var/www/html" >> /etc/apache2/sites-available/424dasquad.com.conf
echo "  ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/sites-available/424dasquad.com.conf
echo "  CustomLog ${APACHE_LOG_DIR}/access.log combined" >> /etc/apache2/sites-available/424dasquad.com.conf
echo "</VirtualHost>" >> /etc/apache2/sites-available/424dasquad.com.conf
# used a2ensite tool to enable the site
sudo a2ensite 424dasquad.com.conf
# disable default site
sudo a2dissite 000-default.conf
# restarted Apache2
sudo systemctl restart apache2

#----------Configuring SSL Certificate to site----------#
sudo certbot --apache -d 424dasquad.com
# set Alias for subdomains to work with certificate
sudo certbot --apache -d 424dasquad.com -d www.424dasquad.com


#-----------Configuring Mailing System----------#
# Configuring Composer
composer require phpmailer/phpmailer