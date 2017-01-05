Author: Harshit Mago


Language Used: PHP



Dependencies: PHP, Apache2 and root level permission to the project dir.



Assumptions: 
- There will be only one csv. However this app can easily process multiple scripts with very little modification.
- Column names in the csv are constant, however their sequnce can change.
- App should be made without using MYSQL.
- App should follow OOPs concept.
- No GUI required
- This is one time process, no other filteration is required after process completion.
- Only CSV format is supported.



Design: Project is implemented using DDD and It is scalable, reusable and easily extensible.



Instructions:
- Copy the project to the root dir of your server.
- Change the configuration of the project if required in eb/configs/config.php
- Copy the input csv in the csv/input dir(Note: This is the default path, you can change it in config.php). 
- Run the program by browser/terminal/third party app
	=> browser: http://localhost/eb/index.php
	=> terminal: 1) Go to the var/wwww/ed folder, 2) Execute following file: php index.php
	=> third party app: Make a curl request to http://localhost/eb/index.php
