Vagrant.configure("2") do |config|
  config.vm.define "Debian_Base"
  config.vm.box = "debian/stretch64"
  config.vm.box_check_update = true
  config.vm.hostname = "debian-base"
  config.vm.provider :virtualbox do |vb|
    vb.name = "Debian_Base"
  end
  config.ssh.forward_agent = true
  config.vm.network "forwarded_port", guest: 80, host: 3080
  config.vm.provision "shell", inline: $script
end

$script = <<-SCRIPT
date > /etc/vagrant_provisioned_at
echo "Europe/Berlin" | sudo tee /etc/timezone
dpkg-reconfigure -f noninteractive tzdata
#debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
#debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
apt-get update -y -q
apt-get dist-update -y -q
apt-get install -y -q make git libssl-dev zip unzip htop
apt-get install -y -q php composer php-zip php-xml
sed -i "s/#alias l/alias l/" /home/vagrant/.bashrc
sed -i "s/#alias l/alias l/" /root/.bashrc
#apt-get install -y -q apache2 mysql-server php-mysql libapache2-mod-php
#service apache2 restart
#addgroup vagrant www-data
SCRIPT

