# -*- mode: ruby -*-
# vi: set ft=ruby :

unless Vagrant.has_plugin?("vagrant-hostsupdater")
  puts "The vagrant-hostsupdater plugin is not installed. You will have to manually add the following entry 192.168.11.17 wp.version"
end

unless Vagrant.has_plugin?("vagrant-vbguest")
  puts "The vagrant-vbguest plugin is not installed. If you are using VirtualBox < 5.0 you should install this plugin."
end

Vagrant.configure(2) do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Box
  config.vm.box = "alpipego/wp-version"
  config.vm.box_version = "0.4.0"

  # NETWORK
  config.vm.network "private_network", ip: "192.168.11.17"
  config.vm.hostname = "wp.version"

  # SHARE
  config.vm.synced_folder "wp-version", "/var/www/wp-version", group: "www-data", owner: "www-data", mount_options: ["dmode=777", "fmode=666"]

  config.ssh.insert_key = false

  # PROVISIONING
  config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"
  config.vm.provision "shell", inline: <<-SHELL
    if [ ! -e /etc/nginx/sites-enabled/wp-version ]; then
        sudo ln -s /var/www/wp-version/config/nginx.conf /etc/nginx/sites-enabled/wp-version
    fi
    if [ ! -e /etc/apache2/sites-enabled/wp-version ]; then
        sudo ln -s /var/www/wp-version/config/apache.conf /etc/apache2/sites-enabled/wp-version
    fi
    composer self-update
    cd /var/www/wp-version && composer update
  SHELL
  config.vm.provision "shell", run: "always", inline: <<-SHELL
    composer self-update
    # add any startup script here, e.g.
    sudo service php7.0-fpm stop
    phpbrew fpm start
    sudo service nginx reload
  SHELL
end
