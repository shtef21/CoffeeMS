#!/bin/bash

# Install required packages
apt-get update && apt-get install -y wget git

# Download and install XAMPP
wget https://www.apachefriends.org/xampp-files/8.2.4/xampp-linux-x64-8.2.4-2-installer.run -P /tmp
chmod +x /tmp/xampp-linux-x64-8.2.4-2-installer.run
/tmp/xampp-linux-x64-8.2.4-2-installer.run

# Remove XAMPP installer
rm /tmp/xampp-linux-x64-8.2.4-2-installer.run

# Clone CoffeeMS from GitHub
git clone https://github.com/shtef21/CoffeeMS.git /opt/lampp/htdocs/CoffeeMS

# Start XAMPP and the CoffeeMS project
/opt/lampp/lampp start

# Cleanup cache
apt-get clean
