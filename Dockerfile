FROM php:7-cli-alpine3.9

ARG USERID=1000
ARG GROUPID=1000


RUN chmod +x /usr/bin/entrypoint.sh &&\
    chown root:root /usr/bin/entrypoint.sh &&\
    apk add --no-cache --update bash bash-completion bash-doc &&\
    addgroup -g ${GROUPID} developer &&\
    mkdir -p /home/developer/code &&\
    adduser -D -u ${USERID} -G developer -h /home/developer -s /bin/bash developer &&\
    chown -R ${USERID}:${GROUPID} /home/developer/code


VOLUME /home/developer/code

USER developer

ENTRYPOINT [/bin/bash]