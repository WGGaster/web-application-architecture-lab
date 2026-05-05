1. Вывод systemctl status nginx (active)
![Описание](screenshots/01-nginx-status.png)
---
2. «Welcome to nginx!» в браузере (IP виден в адресной строке)
![Описание](screenshots/02-browser-ip.png)
---
3. Вывод curl -v
![Описание](screenshots/03-curl.png)
---
4. Вывод ls -la /var/www/ ДО и ПОСЛЕ chown
![Описание](screenshots/04-permissions.png)
---
cat /etc/nginx/sites-available/default


listen: 80 default_server #прослушивание указанного порта

root: /var/www/html #корневая папка веба

server_name: _ #имя сервера

index: index.html index.htm index.nginx-debian.html; #порядок поиска индексного файла

---
5. Панель VK Cloud с созданной зоной
![Описание](screenshots/05-dns-zone.png)
---
6. A-запись в панели VK Cloud (домен, IP, TTL видны)
![Описание](screenshots/06-a-record.png)
---
7. Вывод ping (домен резолвится в IP VPS)
![Описание](screenshots/07-ping.png)
---
8. Вывод dig с подписями
![Описание](screenshots/08-dig.png)
QUESTION SECTION: ;khalitov-ai-info.duckdns.org.  IN      A
ANSWER SECTION: khalitov-ai-info.duckdns.org. 30 IN     A       81.26.178.213
SERVER: 127.0.0.53#53(127.0.0.53) 
---
9. Вывод dig +trace
![Описание](screenshots/09-1-dig-trace.png)
![Описание](screenshots/09-2-dig-trace.png)
---
10. Страница Nginx в браузере (домен виден в адресной строке)
![Описание](screenshots/10-browser-domain.png)