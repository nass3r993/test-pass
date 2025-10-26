FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

RUN echo '<Directory /var/www/html/uploads/profile_images/>' >> /etc/apache2/apache2.conf && \
    echo '    Options +Indexes' >> /etc/apache2/apache2.conf && \
    echo '    AllowOverride None' >> /etc/apache2/apache2.conf && \
    echo '    Require all granted' >> /etc/apache2/apache2.conf && \
    echo '</Directory>' >> /etc/apache2/apache2.conf

RUN echo 'AddType application/x-httpd-php .phtml' >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html
