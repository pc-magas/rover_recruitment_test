FROM php:7-cli-alpine3.9

ARG USERID=1000
ARG GROUPID=1000

ENV DOCKER_UID=${USERID}
ENV DOCKER_GID=${GROUPID}

COPY ./entrypoint.sh /usr/bin/entrypoint.sh

RUN chmod +x ./entrypoint.sh &&
    apk add --no-cache --update bash bash-completion bash-doc &&
    groupadd -r -g ${DOCKER_GID} developer &&
    useradd -r -y ${DOCKER_UID} -g ${DOCKER_GID} -d /home/developer -m -s /bin/bash developer &&
    chown -r ${DOCKER_UID}:${DOCKER_GID} /home/developer


VOLUME /home/developer

ENTRYPOINT [/usr/bin/entrypoint.sh]