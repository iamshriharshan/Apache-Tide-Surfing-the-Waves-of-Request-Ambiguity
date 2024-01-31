FROM httpd:2.4.55

COPY httpd.conf /tmp/httpd.conf
RUN cat /tmp/httpd.conf >> /usr/local/apache2/conf/httpd.conf && rm /usr/local/apache2/htdocs/index.html
COPY src/. /usr/local/apache2/htdocs