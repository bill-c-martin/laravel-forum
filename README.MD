## Overview

This is a fully-featured forum built during taking the ~20 hour [Let's Build A Forum with Laravel and TDD](https://laracasts.com/series/lets-build-a-forum-with-laravel) course, for fun, because why not.

## Software/Library Stack

- PHP 7.1
- MySQL 5.7
- Ubuntu 16.04 in Laravel Homestead / Vagrant
- Laravel 5.6 
- phpunit 7.0
- Vue.js

## Localhost Setup

1. Clone this repo to `~/projects/laravel-forum/`
2. Download and install VirtualBox and vagrant
3. Download and install homestead:
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
5. Bootup homestead with `vagrant up` from `~/projects/Homestead/`
6. Add `127.0.0.1 forum.local` into `/etc/hosts` file
7. Verify localhost app loads on `http://forum.local:8000`
