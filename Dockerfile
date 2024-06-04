# Composer
FROM baseimage:composer-php8.3-ubuntu.Dockerfile as vendor
COPY ./ /var/www/app
WORKDIR /var/www/app
# RUN composer install \
#    --ignore-platform-reqs \
#    --no-interaction \
#    --no-plugins \
#    --no-scripts \
#    --prefer-dist
# RUN composer dumpautoload --optimize
# RUN app_key=$(php ./artisan key:generate --show); echo "APP_KEY=$app_key" > .env; unset app_key


# npm
FROM baseimage:node18-alpine as asset
COPY --from=vendor /var/www/app /var/www/app
WORKDIR /var/www/app
# RUN npm install && npm run prod
# RUN rm -r ./node_modules

# final
FROM baseimage:php8.3-ubuntu
ARG DEBIAN_FRONTEND=noninteractive
RUN apt update && apt upgrade -y
COPY --chown=www-data:www-data --from=vendor /var/www/app /var/www/app
WORKDIR /var/www/app
RUN chown -R $USER:www-data ./storage && chmod -R 775 ./storage
RUN apt update && apt install -y \
    nano \
    nginx \
    && apt clean
RUN apt-get install php-sqlite3 -y
RUN echo "\
    server {\n\
        listen 80;\n\
        listen [::]:80;\n\
        root   /var/www/app/public;\n\
        access_log /var/log/nginx/application.access.log;\n\
        error_log /var/log/nginx/application.error.log;\n\
        add_header X-Frame-Options \"SAMEORIGIN\";\n\
        add_header X-Content-Type-Options \"nosniff\";\n\
        index index.php index.html index.htm;\n\
        charset utf-8;\n\
        location / {\n\
            try_files \$uri \$uri/ /index.php?\$query_string;\n\
        }\n\
        error_page 404 /index.php;\n\
        location ~ \.php$ {\n\
            fastcgi_pass unix:/run/php/php8.3-fpm.sock;\n\
            fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;\n\
            include fastcgi_params;\n\
        }\n\
        location ~ /\.(?!well-known).* {\n\
            deny all;\n\
        }\n\
    }\n" > /etc/nginx/sites-available/default
RUN echo "\
    #!/bin/sh\n\
    echo \"Starting services...\"\n\
    nginx -g \"daemon off;\" &\n\
    /etc/init.d/php8.3-fpm start -D\n\
    echo \"Ready.\"\n\
    tail -s 1 /var/log/nginx/*.log -f\n\
    " > /usr/local/bin/start.sh
# RUN php artisan optimize:clear
EXPOSE 80
EXPOSE 8081
CMD [ "sh", "/usr/local/bin/start.sh" ]
