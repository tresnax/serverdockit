Vagrant.configure("2") do |config|
    config.vm.box = "bento/ubuntu-22.04"
  
    # Create a private network, which allows host-only access to the machine
    # using a specific IP.
     config.vm.network "private_network", ip: "192.168.56.11"
    
    # Enable provisioning with a shell script. Additional provisioners such as
    # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
    # documentation for more information about their specific syntax and use.
    # config.vm.provision "shell", inline: <<-SHELL
    #   apt-get update
    #   apt-get install -y apache2
    # SHELL
    config.vm.provision "file", source: "~/.ssh/id_ed25519.pub", destination: "~/.ssh/me.pub"
    config.vm.provision "shell", inline: <<-SHELL
    cat /home/vagrant/.ssh/me.pub >> /home/vagrant/.ssh/authorized_keys
    #sudo apt update && sudo apt-get -y upgrade
  SHELL
  end