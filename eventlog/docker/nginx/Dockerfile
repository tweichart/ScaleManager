# Set the base image
FROM nginx:latest
# Set Timezone to Europe/Berlin
RUN rm /etc/localtime \
        && ln -s /usr/share/zoneinfo/Europe/Berlin /etc/localtime
# Expose http Port
EXPOSE 80
# Add Config Files
ADD history/docker/nginx/default.conf /etc/nginx/conf.d
