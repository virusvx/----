<?PHP
echo "t";

/**
* URL-адрес бота и его маркер.
*/

$access_token = '730398305:AAHNPM3sw-LNYQZ1cDAHvH9_uSF6Lbm7FKk';

$api = 'https://api.telegram.org/bot'. $access_token;

/**
* Зададим основные переменные.
*/

$output = json_decode(file_get_contents($api.'/getUpdates'), TRUE); // Получим то, что передано скрипту ботом в POST-сообщении и распарсим
print_r($output);
$chat_id = $output['message']['chat']['id']; // Выделим идентификатор чата

$first_name = $output['message']['chat']['first_name']; // Выделим имя собеседника

$message = $output['message']['text']; // Выделим сообщение собеседника
print_r($message);
/**
* Получим команды от пользователя.
* Переведём их для удобства в нижний регистр
*/

switch(strtolower_ru($message)) {

case ('привет'):

case ('/hello'):

sendMessage($chat_id, 'Привет, '. $first_name . '! ' . $emoji['preload'] );

break;

case ('/start'):

break;

default:

sendMessage($chat_id, 'Неизвестная команда!' );

break;

}

/**
* Функция отправки сообщения в чат sendMessage().
*/

function sendMessage($chat_id, $message) {

file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message));

}

/**
* Функция перевода символов в нижний регистр, учитывающая кириллицу
*/

function strtolower_ru($text) {

  $alfavitlover = array('ё','й','ц','у','к','е','н','г', 'ш','щ','з','х','ъ','ф','ы','в', 'а','п','р','о','л','д','ж','э', 'я','ч','с','м','и','т','ь','б','ю');

    $alfavitupper = array('Ё','Й','Ц','У','К','Е','Н','Г', 'Ш','Щ','З','Х','Ъ','Ф','Ы','В', 'А','П','Р','О','Л','Д','Ж','Э', 'Я','Ч','С','М','И','Т','Ь','Б','Ю');

return str_replace($alfavitupper,$alfavitlover,strtolower($text));

}