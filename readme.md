
## Fleet-Manager
This project is a test for a vehicles fleet management. 
 
Users are able to manage a fleet of three types of vehicles Cars, Buses and Trucks.

This project has been developed in PHP using Laravel 5.8 Framework and Docker.
The docker images are based on LEMP server (PHP 7.2, Ngnix and MySQL 5.7)

#### Technologies
- PHP 7.2
- Ngnix
- MySQL 5.7
- [Dokcer](https://docs.docker.com/get-started/ "Dokcer")
- [Docker-compose](https://docs.docker.com/compose/gettingstarted/ "Docker-compose")
- [Composer](https://getcomposer.org/doc/00-intro.md "Composer")
- [Laravel 5.8](https://laravel.com/docs/5.8/installation "Laravel")

####Setting up the service
It's required to install docker and docker-compose to run the test. Go to the project directory and run:  

`$ docker-compose up`

This command will create three containers:

    |       Containers        | 
    | ----------------------- | 
    | volvotest_db_1 (MySQL)  | 
    | volvotest_app_1 (PHP)   | 
    | volvotest_web_1 (Nginx) |
    
If you have problems with the docker installation, you should check the user credencials. Probably you will need to use a root or user administrator credencial.
    
A few minutes are needed to install all dependecies, so why not take a mug of coffee? =)

Afterwards, check the containers and running command:
 
`$ docker ps`

It probably will show this:

    |CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                                NAMES          |
    |b869b192c9cd        volvotest_web       "nginx -g 'daemon of…"   26 minutes ago      Up 26 minutes       443/tcp, 0.0.0.0:8080->80/tcp        volvotest_web_1|
    |72023f975393        volvotest_app       "docker-php-entrypoi…"   26 minutes ago      Up 26 minutes       9000/tcp                             volvotest_app_1|
    |ef48ecc02773        mysql:5.7           "docker-entrypoint.s…"   26 minutes ago      Up 26 minutes       33060/tcp, 0.0.0.0:33061->3306/tcp   volvotest_db_1 |


If the three containers are running, it's time to set up the laravel installation. 

`$ docker exec -ti volvotest_app_1 bash`

It must to show you something like this:

`root@72023f975393:/var/www#`

Then, run the command:

`root@72023f975393:/var/www# composer setup`

This command is going to install all Laravel dependences and create the database tables.

If everthing goes as expected, then you will be able to access the system with this link:
- [http://localhost:8080](http://localhost:8080 "Localhost:8080")


## The system

This test is for a front-end position with strong background with back-end, so I've tried to
create the best user experience as I could.   

- Dashboad with totals by vehicles type
- Create vehicle
- Set vehicle color
- Delete vehicle
- Pie Chart by Type 


## Feedback
Give me a feedback by e-mail: renan.scalet@gmail.com
