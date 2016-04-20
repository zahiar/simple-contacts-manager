#!/usr/bin/env bash

###################
##Package Prompts##
###################

#Install software packages
sudo apt-get -y update
sudo apt-get -y install apache2 php5 php5-dev php5-curl libpcre3-dev php-http build-essential vim curl

sudo wget https://phar.phpunit.de/phpunit-4.8.21.phar
sudo chmod +x phpunit-4.8.21.phar
sudo mv phpunit-4.8.21.phar /usr/local/bin/phpunit

#Set timezone
echo "Europe/London" | sudo tee /etc/timezone
sudo dpkg-reconfigure --frontend noninteractive tzdata

#########################
##Project specific setup##
#########################

#Add Vhost file
VHOST=$(cat <<EOF
<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        ServerName dev.za

        DocumentRoot /var/www/za/src

        ErrorLog /var/log/apache2/za_error.log
        CustomLog /var/log/apache2/za_access.log combined
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-available/dev.za.conf

sudo a2ensite dev.za.conf
sudo service apache2 restart

#Add to hosts file
sudo -- sh -c "echo 127.0.1.1  dev.za >> /etc/hosts"
