<?php
// наш клиет, с которого должны приходиться запросы на бэк, то есть сюда
header("Access-Control-Allow-Origin: https://delblog.local");
// разрешенные запросы (DELETE нету, потому что удаление постов идёт только через PUT запрос)
header("Access-Control-Allow-Methods: GET, POST, PUT");
// разрешенные заголовки, которые можно кидать на backend, тут же и есть главный для авторизации - Authorization
header('Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Accept, X-PINGOTHER, Content-Type');
// не знаю зачем это, но я думаю что оно не помешает. Вроде бы это для кеширования запросов и их время жизни => получается некая оптимизация
header('Access-Control-Max-Age: 86400');
