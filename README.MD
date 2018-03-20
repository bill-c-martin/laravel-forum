## Localhost Setup

1. Download and install VirtualBox and vagrant
2. Download and install homestead:
   1. `cd ~`
   2. `git clone https://github.com/laravel/homestead.git Homestead`
   3. `cd Homestead`
   4. `bash init.sh`
4. Add to Homestead.yaml:
```
folders:
    - map: ~/projects/laravel-forum
      to: /home/vagrant/projects/laravel-forum

sites:
    - map: forum.local
      to: /home/vagrant/projects/laravel-forum/public
```
5. Bootup homestead with `vagrant up`
6. Add `127.0.0.1 forum.local` into `/etc/hosts` file
7. Verify localhost app loads on `http://forum.local:8000`
