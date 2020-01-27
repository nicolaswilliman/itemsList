# Ubuntu instructions

Clone this repository into the directory `/var/www/` running `$ git clone https://github.com/nicolaswilliman/itemsList.git`.

Then, get into the repository directory and run `$ docker-compose up`.

After the project is up, run `$ docker exec -it challenge-db bash`to get into the apache container.

Then run the following commands in the apache container:
`$ composer install`
`$ chmod 777 www/images`

Now, to be able to use the website, add the following line in your `/etc/hosts` file:

`127.0.0.1       challenge.test.com`

Now you are able to use the website through `challenge.test.com`.