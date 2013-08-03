BFI
===

BFI Site Update

This is the GitHub directory for the dev version of BFI's website presence, kicked off with the redesign/relaunch process in 2013.

This is a general overview of how to make your way around the project.

Vagrant
=======

This project is packaged up in a Vagrant box, making it easy to share the same dev environment between differnt platforms. More information on Vagrant can be found at http://www.vagrantup.com/. Vagrant leverages VirtualBox to make a "headless" virtual server, in which to serve up the site.

So. In order to get started with developing for BFI, you'll need to do the following:

1.	Download and Install Vagrant (http://downloads.vagrantup.com/)
2.	Download and Install VirtualBox (https://www.virtualbox.org/wiki/Downloads)
3.	Clone this project (if you already haven't)
4.	In terminal, cd into the project directory and enter:
	
		$ vagrant up

5.	Vagrant will work for a minute and prompt you for your local machine's admin password, to set up NFS file sharing on the virtual serve. Enter it, and Vagrant should continue booting up.
6.	In the meantime, open up Vagrantfile and check the URLs listed within:

		:localhost_aliases => ["dev.bfi.local", "foo.bfi.local", etc.]

7.	You'll need to add those URLs your /etc/hosts file for everything to work smoothly:
	
		192.168.33.10 dev.bfi.local foo.bfi.local etc.

8.	Once Vagrant is up and you're back to the command prompt again, you're set to go! If at any point you'd like to add subdomains, make sure to enter them in the above two spots.
9.	Once you're done working and want to shut down Vagrant, type into Terminal:

		$ vagrant halt

10.	NEVER type vagrant destroy unless you absolutely know what you're doing.
11.	You can SSH into vagrant via:

		$ vagrant ssh

12.	Once you're done, always make sure to commit, sync, and submit a Pull Request on GitHub.
13.	Enjoy!

Files
=====

Files for the project are in:

	./public/dev.bfi.local/www/

which is akin to the public_html folder in a standard shared hosting environment.

Adding another subdomain
===================

Adding another subdomain (if so desired) would take the following steps:

1.	Add new-subdomain.dev.bfi.local to the 192.168.33.10 line in local machine's /etc/hosts file.
2.	Add new-subdomain.dev.bfi.local to the :localhost_aliases array in the Vagrantfile.
3.	Restart the virtual machine:

		$ vagrant halt
		$ vagrant up

4. Go to http://new-subdomain.dev.bfi.local and work away!
5. FYI: Subdomains in :localhost_aliases array are automatically hardset to dev.bfi.local codebase in

		./cookbooks/drupal-cookbooks/drupal/recipes/drupal_apps.rb

phpMyAdmin
==========

phpMyAdmin can be accessed via http://dev.bfi.local/phpmyadmin, with username: myadmin and password: myadmin.

mySQL
=====

Server settings set:

	memory_limit: 2048M
	thread_stack: 192K

Reference
=========

This Vagrant environment utilizes the setup in the Drupal Vagrant project at https://drupal.org/project/vagrant, and there is some added documentation on set-up and use at http://webwash.net/tutorials/getting-started-drupal-vagrant.

Jambo!
