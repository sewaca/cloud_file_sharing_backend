FROM mysql:8

COPY ./dump/dumpfile.sql /database/docker-entrypoint-initdb.d/

WORKDIR /database

EXPOSE 3306

