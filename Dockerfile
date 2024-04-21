FROM bauson/com:alpine83a
COPY . .
RUN cd api && composer update

