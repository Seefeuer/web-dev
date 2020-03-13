$script = <<-SCRIPT
echo I am provisioning...
date > /etc/vagrant_provisioned_at
echo "Europe/Berlin" | sudo tee /etc/timezone
dpkg-reconfigure -f noninteractive tzdata
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
add-apt-repository ppa:ondrej/php
apt-get update -y -q
apt-get install -y -q make git libssl-dev zip unzip
apt-get install -y -q apache2 mysql-server php php-zip php-mysql php-xml composer libapache2-mod-php
a2enmod rewrite
echo "<Directory /var/www/html>" >> /etc/apache2/sites-available/000-default.conf
echo "    Options Indexes FollowSymLinks" >> /etc/apache2/sites-available/000-default.conf
echo "    AllowOverride All" >> /etc/apache2/sites-available/000-default.conf
echo "    Require all granted" >> /etc/apache2/sites-available/000-default.conf
echo "</Directory>" >> /etc/apache2/sites-available/000-default.conf
service apache2 restart
addgroup vagrant www-data
SCRIPT
Vagrant.configure("2") do |config|
#  config.vm.box = "ubuntu/xenial64"
  config.vm.box = "ubuntu/bionic64"
  config.vm.box_check_update = true
  config.ssh.forward_agent = true
  config.vm.network "forwarded_port", guest: 80, host: 2080
  config.vm.provision "shell", inline: $script
end
