FROM php

RUN apt-get -y update
RUN apt-get -y install git zip unzip nodejs npm
RUN curl -sS https://getcomposer.org/installer​ | php -- \
     --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


WORKDIR /app
COPY . .


RUN composer install

RUN php artisan key:generate
RUN npm install && npm run dev

CMD php artisan serve --host=0.0.0.0
