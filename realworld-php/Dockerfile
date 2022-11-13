FROM php:8.1-apache

RUN apt-get update
RUN apt-get upgrade -y

RUN apt-get install --fix-missing -y libpq-dev
RUN apt-get install --no-install-recommends -y libpq-dev
RUN apt-get install -y libxml2-dev libbz2-dev zlib1g-dev
RUN apt-get -y install libsqlite3-dev libsqlite3-0 mariadb-client curl exif ftp
RUN docker-php-ext-install intl
RUN apt-get -y install --fix-missing zip unzip 
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN set -eux; 

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD conf/apache.conf /etc/apache2/sites-available/000-default.conf

RUN cd /var/www/html
ADD . codeigniter4
# RUN composer create-project codeigniter4/appstarter codeigniter4 -s rc
RUN ls
RUN chmod -R 0777 /var/www/html/codeigniter4/writable

RUN apt-get clean \
    && rm -r /var/lib/apt/lists/*
    
VOLUME /var/www/html

#====================================================================#
#                          SET WORKDIR                               #
#====================================================================#
WORKDIR /var/www/html/codeigniter4

CMD ["bash", "/startScript.sh"]