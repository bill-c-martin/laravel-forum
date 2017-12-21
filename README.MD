## Localhost Setup

1. Download and install VirtualBox and vagrant
2. Download and install homestead:
   1. `cd ~`
   2. `git clone https://github.com/laravel/homestead.git Homestead`
   3. `bash Homestead/init.sh`
3. Add `homestead.test` entry to hosts file:
   1. `vi /etc/hosts `
   2. Add line to hosts file: `127.0.0.1 homestead.test`
4. Verify localhost app loads on `http://homestead.test:8000`
