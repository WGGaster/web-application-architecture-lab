# Отчет по лабораторной работе №7
**Тема:** PHP-FPM и FastAPI для Boardy

---

### Часть A. PHP-FPM

#### Задание 1. Установка PHP-FPM
Php -v и systemctl status php*-fpm
![Описание](screenshots/01-php-version.png)

---

#### Задание 2. Форма и сообщения на PHP
Отправка формы, ответ «Спасибо»
![Описание](screenshots/02-php-form.png)

Messages.php с таблицей (мин. 3 сообщения)
![Описание](screenshots/03-php-messages.png)

---

#### Задание 3. Конфиг Nginx для PHP
Конфиг с fastcgi_pass
![Описание](screenshots/04-nginx-php.png)

---

#### Задание 4. Shared nothing
Три вызова, каждый раз «Счётчик: 1»
![Описание](screenshots/05-shared-nothing.png)

---

#### Задание 5. Блокировка воркеров
Время выполнения 10 параллельных запросов
![Описание](screenshots/06-php-slow.png)

---

### Часть B. FastAPI

#### Задание 6. Установка и приложение
Curl .../api/status (JSON)
![Описание](screenshots/07-api-status.png)

Curl .../api/messages (JSON с данными)
![Описание](screenshots/08-api-messages.png)

---

#### Задание 7. Живой процесс (счётчик)
Счётчик растёт: 1, 2, 3
![Описание](screenshots/09-counter.png)

---

#### Задание 8. Async: 10 запросов за 2 секунды
10 запросов, общее время ~2 сек
![Описание](screenshots/10-async-slow.png)

---

#### Задание 9. Блокирующий код убивает event loop
5 запросов, общее время ~10 сек
![Описание](screenshots/11-blocking.png)

---

#### Задание 10. Swagger
Swagger-документация
![Описание](screenshots/12-swagger.png)

---

#### Задание 11. systemd-сервис
Systemctl status boardy-api (active)
![Описание](screenshots/13-systemd.png)

---

#### Задание 12. Nginx proxy_pass
Конфиг с proxy_pass
![Описание](screenshots/14-nginx-api.png)

---

### Часть C. Сравнение

#### Задание 13. Два формата
HTML vs JSON
![Описание](screenshots/15-compare.png)

---

#### Задание 14. Процессы
Пул PHP-FPM и один Uvicorn
![Описание](screenshots/16-processes.png)

---

### Сдача через Pull Request

![Описание](screenshots/17-pull-request.png)