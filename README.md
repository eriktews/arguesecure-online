## Basic usage

### Installation

There are two ways to install ArgueSecure: (A) build from scratch and (B) delploy a pre-built VM image. The second option is the easiest.

#### (A) Installing from scratch:
1. Install Laravel Homestead: https://laravel.com/docs/master/homestead  
2. Start up the machine then get the repo: https://github.com/danionita/ArgueSecure.git
3. run 'composer install' and 'node install' (add --no-bin-links if you are on a windows host) 
4. run 'php artisan migrate'
6. Start the websocket server and let it run (not a daemon): node ./server/server.js 
7. Update Help and instructions pages as shown below

#### (B) Installing using VM image:
1. Download VM image: https://surfdrive.surf.nl/files/index.php/s/0C1tM7suCRGJIN0
2. Deploy VM in virtualization environment of your choice and add the image as HDD.
3. Open .env (vim ./arguesecure-online/.env) and change WEBSOCKET_IP to whatever the IP of the page will be. Also change APP_DEBUG to false.
4. Open config/app.php (vim ./arguesecure-online/config/app.php) and change 'url' => 'http://argue.app' (line 32), to whatever the IP/URL of the page will be.
5. Set up port forwarding on port 80 and 3002 (if not changed, as shown below)
6. Start the websocket server and let it run (not a daemon): node ./server/server.js 
7. Update Help and instructions pages as shown below

### Adding help and instructions:

Edit resources/views/static/help.blade.php   
Edit resources/views/static/instructions.blade.php  

### Adding/removing/exporting users:

To access the administration page, go to: ArgueSecureURL/superuser  
To add a batch of users (from CSV):

1. Create a CSV with the follwing format (headers are mandatory):   

         name,email,password   
         user1,user1,password1   
         user2,user2,password2  
2. Copy CSV file to /storage/app/users.csv (for example via WinSCP)   
3. Log into web interface as admin user, go to the superuser page (ArgueSecureURL/superuser) and click "create users from csv"   

### Update

Go to the arguesecure folder: ```cd ./arguesecure-online```
Get the latest files from GitHub: ```git pull```

### Clear database 

Run this command: ```php artisan migrate:refresh```
Then, to re-create the admin user: 
```
php artisan tinker
\App\User::create(['name'=>'admin','email'=>'admin','password'=>bcrypt('XDARSEC')]);
```

## Configuration

### Defaults:

##### mysql user
user: homestead, password: secret  
##### linux user
user: vagrant password: vagrant  
##### Web interface superuser
admin user: admin password: XDARSEC  
##### Websocket port
3002  

### Change web interface superuser:

1. log into mysql
2. encrypt your new password with bycrypt
3. Update users.admin password field

### Change default port:

```
.env: change WEBSOCKET_PORT
./server/server.js:  change default port
```


## License

The ArgueSecure framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
