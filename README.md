# Ansible-Aws-Ubuntu-Apache-PHP
> ![Ansible image](./ansible.png) 
<br>

## Table of content
- [Overview](#overview) 
- [Task](#Task-EXERCISE-8) 
- [My process](#my-process)
- [Author](#author)

## Overview
 > ### Setting up Apache and PHP on AWS with Ansible Playbook Using Ubuntu 22.04 AMI as the target machine and Ubuntu 20.04 and vagrant as the control node. Ansible is a simple and powerful automation engine. It is used to help with configuration management, application deployment, and task automation. 
<br>

> ### In this write up I will show you how to set up an apache server, and host a simple php file on the server using ansible playbook. This guide assumes that you already have ansible installed on your control node. 
<br>

> ### This is done using Ubuntu 22.04 AMI (virtual machine) on AWS. 
<br>
<br>

## Process
- Create ssh key pair on control node (In this case I used virtual Ubuntu 20.04 with vagrant). 
- Import the public key to AWS. 
- Creat an EC2 instance using Ubuntu 22.04 (target machine)
- Then I connected with the target machine through ssh then exit.
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

## The following are the links to Ansible playbook, index.php file and Vagrantfile. 
 - [Ansible Playbook](./ansible-apache.yml)
 - [Index.php file](./index.php)

<br> 
<br>


## Created ssh-keygen on the master-VM and copied it into the slave-VM. 
#### Run the following command :

```bash
$ ssh-keygen -t rsa 
#To generate ssh keys. Preferably give it a passphrase when prompted.
$ ssh-copy-id -i <remote-host IP address> vagrant@192.168.56.9
#To copy public keys into the remote server.
$ ssh <remote-host IP address> vagrant@192.168.56.9
#To connect with the remote server.

```

## To install ansible and check ansible version:
#### Run the following command:
 
```bash
$ sudo apt update
$ sudo apt install -y software-properties-common python-apt 
$ sudo apt install -y ansible
$ ansible --version

```
<img src="./images/Ansible-version.JPG">

<br>
<br>

## Edit the /etc/ansible/hosts file adding the IP address of the target marchine.

#### Run the following command:

```console
$ sudo nano /etc/ansible/hosts
```
<img src="./images/etc-ansible-hosts-file.JPG">
<br>
<br> 


## Ping the servers to be sure all configurations are set properly. This should return success.
#### Run the following command:

```bash
$ ansible all -m ping
 
```
<img src="./images/ansible-ping.JPG">

<br>
<br>



## Create an ansible playbook to install apache and php on the remote VM. (using ppa:ondrej/php repository) 

#### Run the following command:

```console
$  nano php.yml   

```
<img src="./images/php-yml-file1.JPG">
<img src="./images/php-yml-file2.JPG">
<img src="./images/php-yml-file3.JPG">
<br> 
<br> 
 

## Run a check on the playbook to check if the syntax is written correctly.
#### Run the following command :

```console
$ ansible-playbook php.yml --check

```
<img src="./images/phpplaybook-check1.JPG">
<img src="./images/phpplaybook-check2.JPG">
<br>


## Execute the playbook 
#### run the following command:
```console
$ ansible-playbook php.yml

```
<img src="./images/phpplaybook-run1.JPG">
<img src="./images/phpplaybook-run2.JPG">


## create an index.php file in the localhost and edit the file.

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
<img src="./images/indexphp-playbook-new.JPG">
<img src="./images/copy indexphp-playbook-check.JPG">
<img src="./images/copy indexphp-run.JPG">
<br>



## When the playbook has been executed, check from the terminal if it was deployed properly.
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

## After executing all the playbooks (both apache2 server and indexphp) open the remote server, check if the apache and php has been installed correctly.
#### run the following command:
 
```bash
$ apache2 -v
#To check apache version
$ php  -v
#To check php version
```
<img src="./images/apache-php-version.JPG">



### To check if the apache is running.
#### run the following command:
```console
$ systemctl status apache2

```
<img src="./images/status-apache2.JPG">
<br> 

##  Copy the ip address and paste on your browser. You should see the default index.html file hosted on the server. Edit the apache cofig file to host the index.php file instead of the index.html file.
#### run the following command:
```console
$ sudo nano /etc/apache2/mods-enabled/dir.conf

```
### from the screenshot, note the order of file extentions.
<img src="./images/apache-config-file1.JPG">
<br>

### change the order of file extentions to make index.php file come first. Save and close 
<img src="./images/apache-config-file-2.JPG">
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
<img src="./images/rendered-page.JPG">

<br>
<br>

## Author

- Website - [Bukola Testimony](https://bukola-testimony.github.io/My-Portfolio-website/)
- Twitter - [@BukolaTestimony](https://twitter.com/BukolaTestimony)







