# Use Ubuntu 22.04 as the base image
FROM ubuntu:22.04

# Set non-interactive mode during package installation
ENV DEBIAN_FRONTEND=noninteractive

# Run linux_setup.sh
COPY setup_linux.sh /opt/setup_linux.sh
RUN chmod +x /opt/setup_linux.sh
RUN /opt/setup_linux.sh

# Expose port 5000
EXPOSE 5000

# Start XAMPP
CMD /opt/lampp/lampp start

# Initialize MySQL by running coffeems.sql
COPY coffeems.sql /opt/coffeems.sql
RUN /opt/lampp/bin/mysql -u root < /opt/coffeems.sql

# Define a healthcheck to ensure the container is healthy (optional)
HEALTHCHECK --interval=30s --timeout=5s --retries=3 CMD curl -f http://localhost:5000 || exit 1
