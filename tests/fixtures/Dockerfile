FROM ubuntu:latest
COPY ScaleManager/src/InstanceReporter.sh /root
RUN chmod +x /root/InstanceReporter.sh
ENTRYPOINT ["/root/InstanceReporter.sh"]
