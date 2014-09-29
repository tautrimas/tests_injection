# Tests Injection workshop

## Environment

Install VirtualBox 4.3.16 from https://www.virtualbox.org/wiki/Downloads. If you already have VirtualBox, **upgrade** to this exact version or above.

Install Vagrant 1.6.5 from https://www.vagrantup.com/downloads.html. If you already have VirtualBox, **upgrade** to this exact version or above.

## Repository

Fork https://github.com/tautrimas/tests_injection repository.

Clone your **fork**. Let's call that project directory PROJECT.

## Launch

MISSING INSTRUCTIONS ON CUSTOM VAGRANT

Open terminal in PROJECT directory.

Do `vagrant up`.

Do `vagrant ssh -- mysql -u testsinjection --password=testsinjection testsinjection < pages.sql`.

Check project at http://testsinjection.dev
