# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Box
  config.vm.box = "alpipego/wp-version"
  config.vm.box_check_update = false

  # NETWORK
  config.vm.network "private_network", ip: "192.168.11.17"
  config.vm.hostname = "wp.version"

  # SHARE
  config.vm.synced_folder "wp-version", "/var/www/wp-version", group: "www-data", owner: "www-data", mount_options: ["dmode=777", "fmode=666"]

  # PROVISIONING
  config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"
  config.vm.provision "shell", inline: <<-SHELL
    sudo ln -s /var/www/wp-version/config/nginx.conf /etc/nginx/sites-enabled/wp-version
    sudo ln -s /var/www/wp-version/config/apache.conf /etc/apache2/sites-enabled/wp-version
  SHELL
  config.vm.provision "shell", run: "always", inline: <<-SHELL
    composer self-update
    # add any startup script here, e.g.
    # sudo service nginx reload
  SHELL
end
