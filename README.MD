## Localhost Setup

1. Clone this repo to `~/projects/laravel-forum/`
2. Download and install VirtualBox and Vagrant
3. Download and install Homestead:
   1. `cd ~`
   2. `git clone https://github.com/laravel/homestead.git Homestead`
   3. `cd Homestead`
   4. `bash init.sh`
4. Configure laravel-forum site in Homestead:
   1. In `~/projects/Homestead/Homestead.yaml`, change:
`folders:
    - map: ~/code
      to: /home/vagrant/code

sites:
    - map: homestead.test
      to: /home/vagrant/code/public`

   2. to: 

`folders:
    - map: ~/projects/laravel-forum
      to: /home/vagrant/projects/laravel-forum

sites:
    - map: forum.local
      to: /home/vagrant/projects/laravel-forum`
5. Bootup homestead with `vagrant up` from `~/projects/Homestead/`
6. Add `127.0.0.1 forum.local` into `/etc/hosts` file
7. Verify localhost app loads on `http://forum.local:8000/`
