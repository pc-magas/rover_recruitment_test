FROM php:7-cli-alpine3.9

ARG USERID=1000
ARG GROUPID=1000

RUN apk add --no-cache --update bash bash-completion bash-doc &&\
    addgroup -g ${GROUPID} developer &&\
    mkdir -p /home/developer/code &&\
    adduser -D -u ${USERID} -G developer -h /home/developer -s /bin/bash developer &&\
    chown developer:developer -R /home/developer/code &&\
    php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');"&&\
    php -r "if (hash_file('sha384', '/tmp/composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" &&\
    php /tmp/composer-setup.php --install-dir=bin --filename=composer &&\
    php -r "unlink('composer-setup.php');" &&\
    chmod +x /bin/composer

VOLUME /home/developer/code
WORKDIR /home/developer/code
USER developer

ENTRYPOINT /bin/bash