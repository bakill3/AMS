FROM php:8.1-apache

# Install system packages for PHP extensions recommended for Composer
RUN apt-get update && apt-get install -y \
        git \
        unzip \
        libzip-dev \
        zip \
  && docker-php-ext-install pdo pdo_mysql zip

# Install Composer globally
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
  && php -r "unlink('composer-setup.php');"

# Enable Apache mod_rewrite for .htaccess and clean URLs
RUN a2enmod rewrite

# Copy application source
COPY . /var/www/html

# Update Apache configuration to set the correct DocumentRoot to 'public' directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Ensure .htaccess and other Rewrite rules are honored by Apache
RUN echo '<Directory "/var/www/html/public">\n\
    AllowOverride All\n\
</Directory>' >> /etc/apache2/conf-available/custom.conf \
  && a2enconf custom

# Set ServerName to suppress the "Could not reliably determine the server's fully qualified domain name" message
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set proper permissions on the public directory
RUN chown -R www-data:www-data /var/www/html/public && chmod -R 755 /var/www/html/public

COPY php.ini $PHP_INI_DIR/conf.d/
