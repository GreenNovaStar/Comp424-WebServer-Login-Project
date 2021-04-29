#!/bin/bash

#---------Verify running as root---------#
# must run shell script as root
if [ "$(id -u)" != "0" ]; then
  echo "This script must be run as root" 1>&2
  exit
fi

#----------INSTALLING LAMP----------#
# LAMP installation code from https://iq.opengenus.org/install-lamp-stack-using-shell-script/
# updating Linux packages
echo -e "\n\nUpdating Apt Packages and upgrading latest patches\n"
sudo apt-get update -y && sudo apt-get upgrade -y

# install Apache web WebServer
echo -e "\n\nInstalling Apache2 Web server\n"
sudo apt-get install apache2 apache2-doc apache2-mpm-prefork apache2-utils libexpat1 ssl-cert -y

# install php & requirements
echo -e "\n\nInstalling PHP\n"
sudo apt-get install libapache2-mod-php php-mysql -y

# install MySQL server and client
echo -e "\n\nInstalling MySQL\n"
sudo apt-get install mysql-server mysql-client -y

# Set Permissions
# changes owenership of to user group
echo -e "\n\nPermissions for /var/www\n"
sudo chown -R www-data:www-data /var/www
echo -e "\n\n Permissions have been set\n"


echo -e "\n\nEnabling Modules\n"
sudo a2enmod rewrite
sudo phpenmod mcrypt


echo -e "\n\nRestarting Apache\n"
sudo service apache2 restart

echo -e "\n\nLAMP Installation Completed"

exit 0
