
##  VAGRANT
vagrant-ssh:
	@vagrant ssh

vagrant-reprovision:
	@vagrant reload --provision

vagrant-pause:
	@vagrant halt

vagrant-suspend:
	@vagrant suspend

vagrant-resume:
	@vagrant resume

vagrant-destroy:
	@vagrant destroy

vagrant-status:
	@vagrant status

vagrant-up:
	@vagrant up


##  ALIASES
vagrant-sleep: vagrant-suspend
vagrant-create: vagrant-up
vagrant-wake: vagrant-resume


##  VIRTUALBOX
virtualbox-start-headless:
	@vboxmanage startvm Debian_Base --type headless

virtualbox-stop:
	@vboxmanage controlvm Debian_Base savestate

virtualbox-shutdown:
	@vboxmanage controlvm Debian_Base acpipowerbutton

virtualbox-info:
	@vboxmanage showvminfo Debian_Base --machinereadable

virtualbox-status:
	@vboxmanage showvminfo Debian_Base --machinereadable | grep VMState= | sed "s/VMState=//" | sed 's/"//g'


##  DATABASE
sql-dump-all-databases:
    @mysqldump -uvagrant -pvagrant --all-databases > all_database_`date +'%Y-%m-%d'`.sql

