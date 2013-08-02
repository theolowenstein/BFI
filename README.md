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
	
		vagrant up

5.	And Vagrant should boot up, within 2-5 minutes.
6.	In the meantime, open up Vagrantfile and check the URLs listed within:

		:localhost_aliases => ["dev.bfi.local", "foo.bfi.local", etc.]

7.	You'll need to add those URLs your /etc/hosts file for everything to work smoothly:
	
		33.33.33.10 dev.bfi.local foo.bfi.local etc.

8.	Once Vagrant is up and you're back to the command prompt again, you're set to go!
9.	If at any point you'd like to add subdomains, make sure to enter them in the above two spots.
10.	Once you're done working and want to shut down Vagrant, type into Terminal:

		vagrant halt

11.	NEVER type vagrant destroy unless you absolutely know what you're doing.
12.	You can SSH into vagrant via:

		vagrant ssh

13.	Once you're done, always make sure to commit, sync, and submit a Pull Request on GitHub.
14.	Enjoy!
