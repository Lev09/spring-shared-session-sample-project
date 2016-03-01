FROM haproxy
EXPOSE 80
EXPOSE 443
WORKDIR /home
COPY config haproxy-cfg
CMD ["haproxy", "-db", "-f", "/home/haproxy-cfg/haproxy.cfg"]
