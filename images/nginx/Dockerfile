FROM nginx:stable-alpine

ARG DOMAIN
ARG ENV
ARG BACK_DIR

COPY /production.conf /etc/nginx/conf.d/

ENV DOMAIN=${DOMAIN}
ENV BACK_DIR=${BACK_DIR}
ENV ENV=${ENV}

RUN mkdir -p /var/lib/nginx/cache \
    && chmod 700 /var/lib/nginx/cache

COPY /nginx.conf /etc/nginx/
COPY /mime.types /etc/nginx/
COPY /ssl /etc/nginx/ssl/
COPY /nginx-entrypoint.sh /nginx-entrypoint.sh

RUN chmod +x /nginx-entrypoint.sh

ENTRYPOINT ["sh", "/nginx-entrypoint.sh"]

CMD ["nginx", "-g", "daemon off;"]

