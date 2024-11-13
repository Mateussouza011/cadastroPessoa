# Imagem base PHP com Apache para desenvolvimento
FROM php:8.1-apache

# Instalar dependências e extensões necessárias para desenvolvimento
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    vim \
    nano \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Instalar o Composer globalmente
COPY . .

# Habilitar módulo rewrite do Apache
RUN a2enmod rewrite

# Definir o diretório de trabalho para o desenvolvimento
WORKDIR /workspace

# Expor a porta padrão do Apache
EXPOSE 80

# Comando padrão para o Apache rodar em primeiro plano
CMD ["apache2-foreground"]

# Alterar a porta de escuta do Apache
RUN sed -i 's/80/8000/g' /etc/apache2/ports.conf /etc/apache2/sites-enabled/000-default.conf
EXPOSE 8000