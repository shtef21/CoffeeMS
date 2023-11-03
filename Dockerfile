# Use the official Ubuntu 22.04 base image
FROM ubuntu:22.04

# Set environment variables to avoid interactive prompts during installation
ENV DEBIAN_FRONTEND=noninteractive

# Update the package list and install necessary packages
RUN apt-get update -y && apt-get install -y \
    apache2 \
    php \
    php-mysql \
    php-gd \
    php-curl \
    mysql-server

# Copy your project files into the /var/www/html directory
COPY . /var/www/html
RUN rm /var/www/html/index.html

# Expose port 80 for Apache
EXPOSE 80

# The server should be available when you open:
#   https://localhost

# Start Apache and MySQL services
CMD service apache2 start && service mysql start && tail -f /var/log/apache2/access.log
