FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

# para ma wara an error haimo josh an servername shit
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory to Laravel
WORKDIR /var/www/html

# Copy existing Laravel project files
COPY . /var/www/html

# Expose port 80 for Apache
EXPOSE 83

# Start Apache when the container runs
CMD ["apache2-foreground"]