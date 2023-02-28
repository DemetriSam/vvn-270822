FROM nginx:alpine

RUN rm /etc/nginx/conf.d/*

WORKDIR /var/www/vvn-php/

COPY ./images/nginx/nginx.conf /etc/nginx/
COPY ./images/nginx/production.conf /etc/nginx/conf.d/

COPY ./public /var/www/vvn-php/public

