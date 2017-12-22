## Localhost Setup

1. Download and install VirtualBox and vagrant
2. Download and install homestead:
   1. `cd ~`
   2. `git clone https://github.com/laravel/homestead.git Homestead`
   3. `cd Homestead`
   4. `bash init.sh`
3. Bootup homestead with `vagrant up`
4. Add `127.0.0.1 homestead.test` into `/etc/hosts` file
5. Verify localhost app loads on `http://homestead.test:8000`
