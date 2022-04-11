<?php

const SITE_ROOT = __DIR__;
const BASE_URL = 'http://localhost/dinamic-site/';
// Адрес нашего сайта на локальном сервере
//путь к нашем файлу чтобы не менять каждый раз везде здесь надо поменять host  и все

define("ROOT_PATH", realpath(dirname(__FILE__)));

//print_r(SITE_ROOT.'<br>');

//print_r(BASE_URL.'<br>');

// Путь нашего сайта на компьютере его домен

//print_r(SITE_ROOT);
/*http://localhost:63343/localhost/dinamic-site/

http://localhost/dinamic-site/*/


/*unset($_SESSION['id']);    //функция удаление чего либо
unset($_SESSION['login']);// например сессии
unset($_SESSION['email']);
unset($_SESSION['admin']);*/

// Когда идет подгрузка страницы HTML  пишем относительный путь от
// родительской (текущей) страницы


//----------------      ССЫЛКА         --------------------

// Это путь на сервере http://localhost/dinamic-site/
// Ссылка всегда пишется абсолютным путем
// Когда нужна ссылка на страницу HTML пишем aбсолютный путь BASE_URL."file"
// <?php echo  BASE_URL .'file.php'



//----------         ВКЛЮЧЕНИЕ ФАЙЛА      --------------
// Это путь внутри структуры сайта  D:\OpenServer\domains\localhost\dinamic-site
//Когда нужно включить PHP файл в страницу HTML :

// пишем либо отн. путь относительно текущей HTML страницы и тогда этот PHP может подключать себя относительно подключающего HTML страницы
// либо абсолютный путь SITE_ROOT и подключаемый PHP файл тоже исп SITE_ROOT
// SITE_ROOT не забываем слэш .'/file.php'








