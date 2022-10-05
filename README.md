# Ansible-Aws-Ubuntu-Apache-PHP

> <img src="./images/ansible.png">
<br>

## Table of content
- [Overview](#overview) 
- [Process](#my-process)
- [Link to files](#The-following-are-the-links-to-Ansible-playbook-index.php-file-and-Vagrantfile)
- [Author](#author)

## Overview
 > ### Setting up Apache and PHP on AWS with Ansible Playbook Using Ubuntu 22.04 AMI as the target machine and Ubuntu 20.04 as the control node. Ansible is a simple and powerful automation engine. It is used to help with configuration management, application deployment, and task automation. 
<br>

> ### In this write up I will show you how to set up an apache server, and host a simple php file on the server using ansible playbook. 
<br>

> ### This is done using Ubuntu 22.04 AMI (virtual machine) on AWS. 
<br>
<br>

## Process
- Install ansible on the control node(In this case I used an Ubuntu 20.04 VM created with vagrant).  
- Create ssh key pairs.
- Import the public key to AWS. 
- Creat an EC2 instance using Ubuntu 22.04 (target machine)
- Connect with the target machine through ssh then exit.
- Edit the /etc/ansible/hosts file adding the IP address of the target machine.
- After all was done, I pinged the ansible inventory to be sure all configurations are set properly
- Create a directory for the ansible.
- Cd into the ansible directory.
- Created a playbook to install apache, set the time zone to Africa/lagos and install php then ran a check on the playbook.
- Executed the playbook file. 
- Check the result in the target machine to see if the installations were deployed, and check the apache service to confirm it is working fine. 
- Create and edit an index.php file.
- Using ansible playbook, I copied the index.php file from the localhost to the remote server.
- Edit the apache config file on the remote server.
- Check the rendered page on my browser.
<br>
<br>

## The following are the links to Ansible playbook and index.php file.
 - [Ansible Playbook](./ec2-apache.yml)
 - [Index.php file](./index.php)

<br> 
<br>

## To Install ansible on the control node (In this case I used an Ubuntu 20.04 VM created with vagrant). 
#### Run the following command:
 
```bash
$ sudo apt update
$ sudo apt install -y software-properties-common python-apt 
$ sudo apt install -y ansible
$ ansible --version

```
<img src="./images/ansible-version.png">

<br>
<br>


## Create ssh key pairs 
#### Run the following command :

```bash
$ ssh-keygen -m rsa PEM
```
### Note: when prompted give it a passphrase of a minimum of 5 characters (required)
<img src="./images/keygen1.JPG">
<img src="./images/keygen2.JPG">

## change the private key to an extention of PEM.
```bash
$ mv /home/vagrant/.ssh/vagrantkeys /home/vagrant/.ssh/vagrantkeys.pem
```
<img src="./images/keygen4.JPG">

## Now, log into AWS console and import the public keys.
### Click on servicesc, type EC2 in the searchbox and select EC2 from the services menu.
<img src="./images/create-instance1.jpg">

### On EC2 dashboard, click on keypairs.
<img src="./images/create-instance2.JPG">

### Click on Actions and select "import key pair" from the drop-down menu.
<img src="./images/create-instance3.JPG">

### Enter the name of your keys
<img src="./images/create-instance4.JPG">

### copy your public keys here.
<img src="./images/create-instance5.JPG">
<img src="./images/keygen3.JPG">

### Click on import key pair
<img src="./images/create-instance6.JPG">
<img src="./images/create-instance7.JPG">


## Create an EC2 instance using Ubuntu 22.04 (target machine)
### Click on instances
<img src="./images/create-instance8.JPG">

### Click on launch instances at the top of the console.
<img src="./images/create-instance9.JPG">

### Give your instance a name
<img src="./images/create-instance10.JPG">

### Scroll down to Amazon machine images (AMI). Select ubuntu. Leave it at the free tier eligible. (If you are on free-tier, preferable choose machines that have free tier eligibility to save cost.)
<img src="./images/create-instance11.JPG">
<img src="./images/create-instance11a.jpg">

### Scroll down to Instance type ans choose t2.micro
<img src="./images/create-instance11b.jpg">

### Scroll down to Key pair (login) Enter the name of our key pair.
<img src="./images/create-instance12.JPG">

### Scroll down to Network settings, go to "create security groups"click on it.
<img src="./images/create-instance13.JPG">

### Scroll down and check the boxes to allow ssh traffic and other ports. 
<img src="./images/create-instance14.JPG">

### Scroll down to summary.Enter the number of instances you want to create. Review your choices. Click on Launch instance.
<img src="./images/create-instance15.JPG">

### Click on "view all instances"
<img src="./images/create-instance16.jpg">
<img src="./images/create-instance17.JPG">

### When your instance has been successfully created, click on "connect" at the top of the dashboard.
<img src="./images/create-instance19.JPG">

### Click on SSH client. Copy the example below.
<img src="./images/create-instance20.JPG">

### Paste the command on your terminal. This allows you to connect with your EC2 instance using ssh connection.

#### Note: do this at the ssh path where you have your keypairs stored so that the connecton can discover the keys.
<img src="./images/create-instance21.JPG">
<img src="./images/create-instance21a.JPG">
<img src="./images/create-instance21b.JPG">

### After successful connection. Exit.


## Edit the /etc/ansible/hosts file adding the IP address of the target marchine.

### First,copy the IP address and the user name of your AWS Ubuntu server.
<img src="./images/create-instance22.JPG">

#### Now Run the following command:
```console
$ sudo nano /etc/ansible/hosts
```

### Edit your host file with the IP address, user name and the path to the key pairs.
<img src="./images/create-instance23.JPG">
<br>
<br> 


## Ping the servers to be sure all configurations are set properly. This should return success.
#### Run the following command:

```bash
$ ansible all -m ping
 
```
<img src="./images/create-instance24.JPG">

<br>
<br>



## Create an ansible playbook to install apache and php on the remote VM. (using ppa:ondrej/php repository) 

#### Run the following command:

```console
$  nano playbook.yml   

```
<img src="./images/Playbook1.png ">
<img src="./images/Playbook2.png ">
<img src="./images/Playbook3.png ">
<br
 

## Run a check on the playbook to check if the syntax is written correctly. Run this check at the path where you created the playbook.

#### Run the following command :

```console
$ ansible-playbook playbook.yml --check

```
<img src="./images/playbook-check1.JPG">
<img src="./images/playbook-check2.JPG">
<img src="./images/playbook-check3.JPG">
<br>


## To execute the playbook 
#### run the following command:
```console
$ ansible-playbook playbook.yml

```
<img src="./images/playbook-run1.JPG">
<img src="./images/playbook-run2.JPG">
<img src="./images/playbook-run3.JPG">
<img src="./images/playbook-run4.JPG">



## Create an index.php file and edit the file.

```console
$  touch index.php   
$  nano index.php   

```
<img src="./images/indexphpfile1.JPG">
<img src="./images/indexphpfile2.JPG">
<br> 


## With ansible playbook, copy the index.php file from localhost(control node) to remote server(target machine). First create ansible playbook. then run a check to see if your playbook sytax is correct before executing the playbook.
#### Run the following command:

```bash
$  touch indexphp.yml  
#To create an index.php file
$  nano indexphp.yml
#To edit the file
$  ansible-playbook indexphp.yml --check
#To check if the playbook syntax is correct.
$  ansible-playbook indexphp.yml
#To execute the playbook
```
<img src="./images/Playbook4.png">
<img src="./images/copy indexphp-playbook-check.JPG">
<img src="./images/copy indexphp-run.JPG">
<br>



## When the playbook has been executed, check from your control node if it was deployed properly on the target machine.
#### Run the following command:

```console
$  ansible all -m shell -a "ls -al /var/www/html/" -b  
```
<img src="./images/indexphp-remote-check.JPG">
<br>

## You can execute the index.php file directly from terminal
#### Run the following command:

```console
$  php index.php
```
<img src="./images/execute-php-file-on-terminal.JPG">
<br>

## After executing all the playbooks (For the apache2 server ,PHP and index.php file), Copy the IP address of your remote server (Ubuntu AWS AMI) and paste it on your browser. You should see the default index.html file hosted on the server.

<img src="./images/Rendered-page1.JPG">
<br>


 ## Edit the apache config file to host the index.php file instead of the index.html file.
#### run the following command:
```console
$ sudo nano /etc/apache2/mods-enabled/dir.conf

```
### from the screenshot, note the order of file extentions.
<img src="./images/apache-config.JPG">
<br>

### change the order of file extentions to make index.php file come first. Save and close. 
<img src="./images/apache-config-edited.JPG">
<br>
<br>

##  Restart the apache2 service and check the status
#### run the following command:
```console
$ sudo systemctl restart apache2
$ systemctl status apache2
```
<img src="./images/restart-apache.JPG">
<br>


## Refresh the web browser.
### Screenshot of the rendered page.
<img src="./images/Rendered-page-php.JPG">

<br>
<br>

## Author

- Website - [Bukola Testimony](https://bukola-testimony.github.io/My-Portfolio-website/)
- Twitter - [@BukolaTestimony](https://twitter.com/BukolaTestimony)







