# xml_loader
An aplication to load a XML file into a mysql database throught doctrine2 using the symfony2

Run the following commands:

git clone https://github.com/eopnetto/xml_loader
cd xml_loader/
composer install


Then set your mysql credentials in "xml_loader\app\config\config.yml" file:

# Doctrine Configuration
doctrine:
    dbal:
        driver: pdo_mysql
        host: 'localhost'
        port: '3306'
        dbname: 'web_store'
        user: '<your_user>'
        password: '<your_password>'
        charset: UTF8

Finish executing the following commands:

php app/console doctrine:schema:update --force
php app/console server:run

It's done!
Now access the url http://localhost:8000/ and upload your xml file and the files will be processed and database will be populat.
Now you can access data from REST API url:

E.g.:
http://localhost:8000/api/people
http://localhost:8000/api/people/1
http://localhost:8000/api/people/1/phones
http://localhost:8000/api/people/1/phones/1