# Use Ubuntu
FROM ubuntu:20.04

# Run terminal commands
RUN echo 'hello'

# Set ENV variables
ENV SMTH=0

# Set a default CMD on container startup
CMD ["echo", "Docker is easy 🐋"]
