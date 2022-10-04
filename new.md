  # AltSchool-Cloud-Exercise-9-Week-6


> ![AltSchool Cloud Exercices](../cloud3.JPG) 

<br>

- [Back to first page](../README.md)
- [📔 Exercise 1](../README.md)
- [📔 Exercise 2](../Exercise-2/exercise2.md)
- [📔 Exercise 3](../Exercise-3/exercise3.md)
- [📔 Exercise 4](../Exercise-4/exercise4.md)
- [📔 Exercise 5](../Exercise-5/exercise5.md)
- [📔 Exercise 6](../Exercise-6/exercise6.md)
- [📔 Exercise 7](../Exercise-7/exercise7.md)
- [📔 Exercise 8](../Exercise-8/exercise8.md)
- [Overview](#overview) 
- [Task](#Task-EXERCISE-8) 
- [My process](#my-process)
- [Author](#author)


<br>

## Overview
### LEARNING CLOUD ENGINEERING WITH ALTSCHOOL.
<p>
It's about 2 months of learning cloud engineering with AltSchool.There has been so many new concepts to learn. This is the last week in september.
</p> 
<p>This week we learnt about configuration management with Ansible.I must say that this is an interesting week for me. In simple terms, Ansible is an IT automation tool. It is primarily intended for IT professinals, who use it for application deployment, updates on workstation and servers, cloud provisioning, configuration management and many more.
Ansible uses a simple syntax written in YAML called playbook. 
</p>
<p>Terms used in Ansible includes: control node (where ansible is installed), Ansible playbook, Tasks, Inventory,Modules and Roles.   
</p>
<br>
<br>


## Task EXERCISE 9💻
-  Create an ansible playbook to set up a server with apache.
- The server should be set to the Africa/Lagos timezone.
- Host an index.php with the following content as the main file on the server.

```console
<?Php echo (date("F d, Y, h:i:s: A e", time()))  ?>

```
<br>
<br>


## My process
- I created 2 VMs.
- I created ssh-keygen on the master-VM and copied it into the slave-VM. 
- I connected with slave-VM from master-VM through ssh and IP address. 
- In the master VM, I installed ansible.
- I created a directory for the ansible.
- I edited the /etc/ansible/hosts file adding the IP address of the slave-VM.
- I cd into ansible directory
- In the ansible directory, I created a host-inventory file.(Optional)
- I exported the ansible inventory module into the ansible path using the export command and echo the command to make sure it exported correctly.
- Then I edited the host-inventory file with the slave-VM IP address.(optional)
- After all was done, I pinged the ansible inventory to be sure all configurations are set properly
- I created a playbook to install apache, set the time zone to Africa/lagos and install php then ran a check on the playbook.
- I executed the playbook file. 
- I check the result in the slave-VM to see if the installations were deployed, and I checked the apache service to confirm it is working fine. 
- I created and edited an index.php file.
- Using ansible playbook, I copied the index.php file from the localhost to the remote server.
- I edited the apache config file in the remote server.
- I then checked the rendered page on my browser.
<br>
<br>

## The following are the links to Ansible playbook, index.php file and Vagrantfile. 
 - [Ansible Playbook](./ansible-apache.yml)
 - [Index.php file](./index.php)
 - [Vagrantfile](./Vagrantfile)

<br> 
<br>

## Created multiple VMs and edited the vagrantfile as follows:
#### screenshot of my vagrant file.
<img src="./images/vagrantfile.png">
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

## To edit the /etc/ansible/hosts file adding the IP address of the remote-server.

#### Run the following command:

```console
# nano /etc/ansible/hosts
```
<img src="./images/etc-ansible-hosts-file.JPG">
<br>
<br>  


## cd into the ansible directory, create a host file (an inventory file).(Optional)

```console
$  touch host-inventory

```

## Export the ansible inventory module into the ansible path using the export command and echo the command to make sure it exported correctly.

#### Run the following command:

```console
$  export ANSIBLE_INVENTORY=/home/varant/ansible/host-inventory
$  echo ANSIBLE_INVENTORY         

```
<img src="./images/export-ansible.JPG">
<br>
<br> 


## Edit the host-inventory file by copying the remote VM(slave machine) IP address into the file:


```console
$ nano host-inventory
```
<img src="./images/host-inventory.JPG">
<br> 

## Ping the server to be sure all configurations are set properly. This should return success.
#### Run the following command:

```bash
$ ansible all -m ping
#or
$ ansible all -i host-inventory -m ping
```
<img src="./images/ansible-ping.JPG">

<br>
<br>



## I created an ansible playbook to install apache and php7.4 on the remote VM. (using ppa:ondrej/php repository) 

#### Run the following command:

```console
$  nano php.yml   

```
<img src="./images/php-yml-file1.JPG">
<img src="./images/php-yml-file2.JPG">
<img src="./images/php-yml-file3.JPG">
<br> 
<br> 
 

## To run a check on the playbook to check if the syntax is written correctly.
#### Run the following command :

```console
$ ansible-playbook php.yml --check

```
<img src="./images/phpplaybook-check1.JPG">
<img src="./images/phpplaybook-check2.JPG">
<br>


## To execute the playbook 
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


## With ansible playbook, copy the index.php file from localhost(MasterVM) to remote server(SlaveVM). First create ansible playbook. then run a check to see if your playbook sytax is correct before executing the playbook.
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

## After executing all the playbooks (both apache2 server and indexphp) open the remote server i.e(slave machine) check if the apache and php has been installed correctly.
#### run the following command:
 
```bash
$ apache2 -v
#To check apache version
$ php  -v
#To check php version
```
<img src="./images/apache-php-version.JPG">



### check if the apache is running.
#### run the following command:
```console
$ systemctl status apache2

```
<img src="./images/status-apache2.JPG">
<br> 

##  Copy the ip address and check the browser if the page is live. You should see the default index.html file hosted on the server.Edit the apache cofig file to host the index.php file instead of the index.html file.
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



Setting up Apache and PHP on AWS with Ansible Playbook Using Ubuntu 22.04 AMI.
Ansible is a simple and powerful automation engine. It is used to help with configuration management, application deployment, and task automation. It makes your applications and systems easier to deploy and maintain
#Apache #PHP #Ubuntu #AWS #EC2instance #SSH #Ansible #Ansibleplaybook 



This repository is my documenting repository for learning the world of DevOps. I started this journey on the 1st January 2022 and I plan to run to March 31st for a complete 90-day romp on spending an hour a day including weekends to get a foundational knowledge across a lot of different areas that make up DevOps.




