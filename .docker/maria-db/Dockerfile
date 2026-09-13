FROM mariadb:11.2-jammy

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN groupmod -g ${GROUP_ID} mysql && usermod  -u ${USER_ID} -g ${GROUP_ID} mysql

USER mysql

COPY .docker/maria-db/create-test-db.sql /docker-entrypoint-initdb.d
