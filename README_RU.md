# ufo-img-crawler
 Это CLI приложение.
 
### О проекте:
 Этот краулер является тестовым заданием для компании Innovation Group.
 В связи с тем, что на момент разработки, у меня не было много времени, пришлось
 пожертвовать написанием ТТД.
 А так-же отказаться от оптимизации и балансировки нагрузки.
 Таким образом данная версия краулера не предназначена для парсинга сайтов с большим
 количеством страниц.

### Usage:
 options [arguments]

### Options:
 --help (-h)    Показать это сообщение
 
 --url  (-u)    Передать параметр url для запуска краулера

### Настройки:
 Выполните команду "composer install", дождитесь установки зависимостей.
 Для папки "reports" нужно установить права на запись.

### Результат:
 Результаты парсинга сохраняются в папку "reports" в виде html файлов. Так как задание
 подразумевает тестирование знаний back-end, я не тратил время на отрисовку валидного html.


