$script = <<-SCRIPT
echo "I am provisioning..."
date > /etc/vagrant_provisioned_at
echo "Europe/Berlin" | sudo tee /etc/timezone
echo "sf-web-dev" > /etc/hostname
echo "127.0.1.1 sf-node-dev" >> /etc/hosts
dpkg-reconfigure -f noninteractive tzdata
apt-get update -y
apt-get install -y make git libssl-dev zip unzip htop iptables ssh
apt-get install -y nodejs npm
echo "1" > /proc/sys/net/ipv4/ip_forward
iptables -t nat -A PREROUTING -s 127.0.0.1 -p tcp --dport 3000 -j REDIRECT --to 3000
iptables -t nat -A OUTPUT -s 127.0.0.1 -p tcp --dport 3000 -j REDIRECT --to 3000
ln -s /home/vagrant/project/MakefileInVM /home/vagrant/Makefile
cp /home/vagrant/project/id_rsa /home/vagrant/.ssh/id_rsa
chmod 700 /home/vagrant/.ssh/id_rsa
chown vagrant:vagrant /home/vagrant/.ssh/id_rsa
SCRIPT
Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/focal64"
  config.vm.box_check_update = true
  config.ssh.forward_agent = true
  config.vm.network "forwarded_port", guest: 3000, host: 3000
  config.vm.network "forwarded_port", guest: 8087, host: 8087
  config.vm.provision "shell", inline: $script
  config.vm.provider "virtualbox" do |v|
    v.memory = 4096
    v.cpus = 2
  end
  config.vm.synced_folder ".", "/home/vagrant/project"
end
