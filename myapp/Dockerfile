# Build assets
FROM node:20 AS nodebuild
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# PHP 8.3 + ekstensi
FROM php:8.3-cli
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev unzip git \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd pdo_mysql bcmath
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app
# salin hasil build Vite
COPY --from=nodebuild /app/public/build /app/public/build

RUN composer install --no-dev --optimize-autoloader

CMD php -S 0.0.0.0:${PORT} -t public
