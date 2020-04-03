$script = <<-SCRIPT
echo "I am provisioning..."
date > /etc/vagrant_provisioned_at
echo "Europe/Berlin" | sudo tee /etc/timezone
echo "sf-web-dev" > /etc/hostname
echo "127.0.1.1 sf-web-dev" >> /etc/hosts
dpkg-reconfigure -f noninteractive tzdata
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
add-apt-repository ppa:ondrej/php
apt-get update -y
apt-get install -y make git libssl-dev zip unzip htop iptables
apt-get install -y apache2 mysql-server php composer libapache2-mod-php
apt-get install -y php-zip php-mysql php-xml php-curl php-imagick php-imap php-mbstring
sed -i "s/bind-address/#bind-address/" /etc/mysql/mysql.conf.d/mysqld.cnf
mysql -uroot -proot --execute="CREATE USER 'root'@'%' IDENTIFIED BY 'root';"
mysql -uroot -proot --execute="CREATE USER 'vagrant'@'%' IDENTIFIED BY 'vagrant';"
mysql -uroot -proot --execute="GRANT ALL PRIVILEGES ON * . * TO 'root'@'%' WITH GRANT OPTION;"
mysql -uroot -proot --execute="GRANT ALL PRIVILEGES ON * . * TO 'vagrant'@'%' WITH GRANT OPTION;"
mysql -uroot -proot --execute="FLUSH PRIVILEGES;"
a2enmod rewrite
echo "<Directory /var/www/html>" >> /etc/apache2/sites-available/000-default.conf
echo "    Options Indexes FollowSymLinks" >> /etc/apache2/sites-available/000-default.conf
echo "    AllowOverride All" >> /etc/apache2/sites-available/000-default.conf
echo "    Require all granted" >> /etc/apache2/sites-available/000-default.conf
echo "</Directory>" >> /etc/apache2/sites-available/000-default.conf
service apache2 restart
service mysql restart
addgroup vagrant www-data
echo "1" > /proc/sys/net/ipv4/ip_forward
iptables -t nat -A PREROUTING -s 127.0.0.1 -p tcp --dport 2080 -j REDIRECT --to 80
iptables -t nat -A OUTPUT -s 127.0.0.1 -p tcp --dport 2080 -j REDIRECT --to 80
SCRIPT
Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/bionic64"
  config.vm.box_check_update = true
  config.ssh.forward_agent = true
  config.vm.network "forwarded_port", guest: 80, host: 2080
  config.vm.network "forwarded_port", guest: 3306, host: 3307
  config.vm.provision "shell", inline: $script
  config.vm.provider "virtualbox" do |v|
    v.memory = 4096
    v.cpus = 2
  end
  config.vm.synced_folder ".", "/var/www/html"
end
