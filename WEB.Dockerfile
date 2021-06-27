FROM nginx:latest

COPY ./ssl/nginx-selfsigned.crt /etc/ssl/certs/
COPY ./ssl/nginx-selfsigned.key /etc/ssl/private/
