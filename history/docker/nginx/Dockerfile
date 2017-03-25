# Set the base image
FROM nginx:latest
# Set Timezone to Europe/Berlin
RUN rm /etc/localtime \
        && ln -s /usr/share/zoneinfo/Europe/Berlin /etc/localtime
# Expose http Port
EXPOSE 80
# Add Config Files
ADD history/docker/nginx/default.conf /etc/nginx/conf.d
RUN mkdir -p /var/log/isac/ && touch /var/log/isac/frontend_server.log
RUN ln -sf /proc/1/fd/1 /var/log/isac/frontend_server.log
