# Базовый образ с nginx и php
FROM richarvey/nginx-php-fpm

# Удаляем конфиги сайтов которые там есть
RUN rm -Rf /etc/nginx/sites-enabled/*

# Добавляем наш конфиг
ADD docker/nginx/conf.d/site.conf /etc/nginx/sites-available/site.conf

# Включаем его
RUN ln -s /etc/nginx/sites-available/site.conf /etc/nginx/sites-enabled/site.conf

# Создаем папки
RUN mkdir -p /var/www/app
#RUN mkdir /var/www/app/log

# Объявляем рабочию деректорию
WORKDIR /var/www/app

# Добавляем composer.json
COPY composer.* ./

# Запускаем composer
RUN composer install --prefer-dist --optimize-autoloader --no-dev && composer clear-cache

# Добавляем наше приложение
COPY . .

# Выставляем права
RUN chmod 0777 ./db && chmod 0777 ./runtime && chmod 0777 ./web/assets

# Запускаем миграции
RUN php yii migrate --interactive=0

# Выставляем права
RUN chmod 0777 ./db/db.db

# Копируем конфиг
#COPY ./env/dev/.env .

#EXPOSE 80
