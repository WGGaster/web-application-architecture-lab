1. параметры виртуальной машины в процессе создания (имя ВМ, память, диск)
![Описание](screenshots/01-vm-settings.png)

2. командная строка Ubuntu после установки с приглашением фамилия@фамилия:~$
![](screenshots/02-vm-console.png)

3. вывод cat ~/report/01-system.txt
![вывод cat ~/report/01-system.txt](screenshots/03-system-info.png)

4. вывод ip addr show
![вывод ip addr show](screenshots/04-ip-addr.png)

5. вывод sudo ss -tlnp
![вывод sudo ss -tlnp](screenshots/05-ports.png)

6. вывод sudo systemctl status ssh
![вывод sudo systemctl status ssh](screenshots/06-ssh-status.png)

7. вывод sudo ss -tlnp | grep ssh
![вывод sudo ss -tlnp | grep ssh](screenshots/07-ssh-port.png)

8. вывод grep '/bin/bash' /etc/passwd
![вывод grep '/bin/bash' /etc/passwd](screenshots/08-users.png)

9. процесс создания пользователя boardy
![процесс создания пользователя boardy](screenshots/09-new-user.png)

10. вывод id boardy
![вывод id boardy](screenshots/10-user-check.png)

11. вывод ls -la /
![вывод ls -la /](screenshots/11-root-tree.png)

12. вывод ls -la ~
![вывод ls -la ~](screenshots/12-home-tree.png)

13. вывод ls -ld / /etc /var /tmp /home
![вывод ls -ld / /etc /var /tmp /home](screenshots/13-permissions.png)

14. три состояния testfile.txt (до, после chmod 755, после chmod 600)
![три состояния testfile.txt (до, после chmod 755, после chmod 600)](screenshots/14-chmod.png)

15. вывод dpkg -l | grep -E 'openssh|python|git|curl|vim|nano'
![вывод dpkg -l | grep -E 'openssh|python|git|curl|vim|nano'](screenshots/15-packages.png)

16. вывод systemctl list-units --type=service --state=running
![вывод systemctl list-units --type=service --state=running](screenshots/16-services.png)

17. вывод ps aux --sort=-%mem | head -11
![вывод ps aux --sort=-%mem | head -11](screenshots/17-top-processes.png)

18. вывод подсчёта процессов по пользователям
![вывод подсчёта процессов по пользователям](screenshots/18-process-count.png)

19. вывод топ-10 больших файлов в /var
![вывод топ-10 больших файлов в /var](screenshots/19-big-files.png)

20. вывод ls -lh ~/report/ со всеми файлами
![вывод ls -lh ~/report/ со всеми файлами](screenshots/20-report-files.png)

