FROM php:8.2-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets
# Redis
RUN pecl install redis && docker-php-ext-enable redis
# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

## Node.js, NPM, Yarn
#RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
#RUN apt-get install -y nodejs
#RUN npm install npm@latest -g
#RUN npm install yarn -g

# Kullanıcı ve grup oluşturma
#RUN groupadd -g ${gid} ${user} && useradd -u ${uid} -g ${gid} -m ${user}

#RUN usermod -aG www-data $user

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN usermod -aG root $user
RUN usermod -aG www-data $user

WORKDIR /var/www/html

COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

#ENTRYPOINT ["/var/www/html/entrypoint.sh"]

#COPY  ./entrypoint.sh ./entrypoint.sh
#RUN ./entrypoint.sh
COPY . .
USER $user


