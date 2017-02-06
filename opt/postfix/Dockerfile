FROM ubuntu:16.04

MAINTAINER Michal Zdrojewski <code@strayobject.co.uk>

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y postfix

RUN postconf -e "mynetworks=172.23.0.0/16 127.0.0.0/8 [::ffff:127.0.0.0]/104 [::1]/128"

COPY opt/postfix/init.sh /root/init.sh

CMD ["/bin/bash","/root/init.sh"]
