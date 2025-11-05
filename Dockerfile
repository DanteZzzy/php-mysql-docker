FROM php:7.4-apache

# Instalar as dependências para conectar ao MySQL
RUN docker-php-ext-install mysqli

# Ativar o mod_rewrite do Apache
RUN a2enmod rewrite

# Copiar os arquivos da aplicação para o container
COPY . /var/www/html/

# Expor a porta 80
EXPOSE 80
