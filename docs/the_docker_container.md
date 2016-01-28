# The Docker Container

The Docker Container consists of a php 5.6 base image. This image will be extended by nginx, supervisor, acl, curl, php5-intl, php5-mysql and php-sqlliste.

**Attention:** I just switched the ubuntu14.04 image with the php5.6 image so some layers might be redundant.

###Building the Docker container

To build the container you need docker. If you use Linux install it depending on your OS installer. For Mac OSX you need an additional layer like docker-machine or any linux VM. I use a CoreOS box to execute docker. After checking your docker you need to cd to the project and execute **./build.sh**

The build command will start by checking for a local php5.6 image and pull it from remote if it does not exists. There after the command will add the additional layers within the Dockerfile and label the container as symfony-worker. After the build is finished you can start the container.

###Starting the Docker container

After building the image you can start the image by executing the **./start.sh** script. It will force close any old symfony-worker instance of the project. Then it will mount the project's source code to a busybox docker image as volume mount. This volume mount will be attached to the symfony-worker. After two seconds a docker ps will be printed to show if the symfony-worker is running. 

###Accessing the Docker container via browser

To execute the project within a browser you first need your IP. As Linux user it will be 127.0.0.1 and as Mac user you need to ssh into your vm and type **ifconfig**. The IP might be on eth1. The start script will map the symfony-worker container to port 8080. So 127.0.0.1:8080 or the equivalent IP for your vm will point to the nginx of your symfony-worker.

###Accessing the Docker container via shell

To ssh the symfony-worker you need to execute **docker exec -ti symfony-worker /bin/bash**. You will be connected as root user starting in /project folder.