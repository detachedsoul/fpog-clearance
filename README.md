# Final Year Clearance

## Intro

This was made for Eddy Quincy's final year project. While not perfect security wise and when it comes to modularity, it works so yeah.

## Features

- Student login
- Admin login
- Documents upload
- Document verification by an admin
- Feedback on clearance status for each option

## Usage

You should have a local server (XAMP or Laragon would do) installed. Download the files and extract it to your ```htdocs``` folder and if you are using XAMP, and ```www``` folder if you're using Laragon. You also need a database. In the ```assets``` folder I have made available an SQL file with the necessary database structure and values. By default the database is called ```eddyquincy```, but can be renamed as needed. Create the database and import the SQL file.

If you'll be changing the name of your database, it is also important that you change the database name in the ```functions.php``` file. You can find this in ```includes/functions.php``` and ```admin/includes/functions.php```. Change the lines ```$con = mysqli_connect('localhost', 'root', '', 'eddyquincy');``` to ```$con = mysqli_connect('localhost', 'root', '', 'your new database name');```

For the admin area, the usernames are:

- ```STAFF001```
- ```STAFF002```

The passwords are:

- ```123456``` for ```STAFF001```
- ```098765``` for ```STAFF002```

## Live Demo

A live demo can be found on [https://fpog-clearance.000webhostapp.com](https://fpog-clearance.000webhostapp.com) for student login, and [https://fpog-clearance.000webhostapp.com/admin](https://fpog-clearance.000webhostapp.com/admin) for the adminstrative area.

Login details can be found in the ```assets`` folder.

## Support

While I don't plan on improving this, I'm open for questions and contributions. I can be reached via Facebook via [Wisdom Ojimah](https://web.facebook.com/IamWisdomOjimah).
