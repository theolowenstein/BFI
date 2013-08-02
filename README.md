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

5.	And Vagrant should boot up, within 2-5 minutes.
6.	In the meantime, open up Vagrantfile and check the URLs listed within:

		:localhost_aliases => ["dev.bfi.local", "foo.bfi.local", etc.]

7.	You'll need to add those URLs your /etc/hosts file for everything to work smoothly:
	
		33.33.33.10 dev.bfi.local foo.bfi.local etc.

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

phpMyAdmin
==========

phpMyAdmin can be accessed via http://dev.bfi.local/phpmyadmin, with username: myadmin and password: myadmin.

Adding another site
===================

Adding another site (if so desired) would take the following steps:

1.	Make new directory ./public/new-subdomain.bfi.local
2.	Add files to:

		./public/new-subdomain.bfi.local/www

3.	Add new-subdomain.bfi.local to the 33.33.33.10 line in the /etc/hosts file.
4.	Add new-subdomain.bfi.local to the :localhost_aliases array in the Vagrant file.
5.	Restart the virtual machine:

		$ vagrant halt
		$ vagrant up

6. Go to http://new-subdomain.bfi.local and work away!

Reference
=========

This Vagrant environment utilizes the setup in the Drupal Vagrant project at https://drupal.org/project/vagrant, and there is some added documentation on set-up and use at http://webwash.net/tutorials/getting-started-drupal-vagrant.

Jambo!
