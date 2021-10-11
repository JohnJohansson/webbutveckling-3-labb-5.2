# API

**V1.1**

Fixed the bugs after exelent teacher feedback.

There was a small error in the install script here.

In the $sql = "
INSERT INTO * VALUES ";

I had missed a . so the correct code would be " $sql .= " 

This is now fixed and all of the code works as it should. 

Link to published page: http://studenter.miun.se/~tijo1901/DT173G/moment%205.2/pub/

Link to api raw data: http://studenter.miun.se/~tijo1901/DT173G/moment%205.1/api.php

Link to api Install script: http://studenter.miun.se/~tijo1901/DT173G/moment%205.1/install.php (so you can erase and then replace the courses)


**V1.0**

So this is part two of the API assigment, sadly its not working exactly as it should online.

On this free hosting site I can consume the API but not make any changes, it did however let me

at one time add an extra course: https://doggobloggo12.000webhostapp.com/consume/pub/index.html

delet just gives me an error message though, one that I googled and it just dosent help, it can 

be the code, it can be the browsers it can be the hosting services. I dont know.

Anyways so what these files do is well hosting all the files for the api, te database concetions and so on,

I have an install file so you can easily recreate the databae and fill it with courses.

I have a switch case (curtesy of my teachers) with one GET one DELETE one POST and one PUT command,

This will let my other file 5.1 send request about changings a colum in the database, delete one, reading 

one or all of them or adding a new one to the API, the api is in J-son format. Here you can see that 

https://doggobloggo12.000webhostapp.com/api/api.php I have atest file that prints out the data to the screen,

and also updates a course with id 3 if that exist. Also a config file with the database connectoion. 

The class file have all the good stuff that let the switch case work, its from there we read out and put in 

stuff from the database table. Oh and heres the homepage on the schools server, as you can see it dosent 

work at all and I have no real idea why: https://studenter.miun.se/~tijo1901/DT173G/moment%205.2/pub/