<?php
  header('Content-Type: text/plain;'); //Мы будем выводить простой текст
  set_time_limit(0); //Скрипт должен работать постоянно
  ob_implicit_flush(); //Все echo должны сразу же выводиться
  $address = 'localhost'; //Адрес работы сервера
  $port = 8082; //Порт работы сервера (лучше какой-нибудь редкоиспользуемый)
  

   $socket = stream_socket_client('tcp://localhost:8082', $errorNumber, $errorString, 1);
	
	 if (!$socket) {
            echo "{$errorString} ({$errorNumber})<br />\n";
        } else {
			$data = "first message";
            $head = "GET / HTTP/1.1\r\n" .
                "Host: localhost\r\n" .
                "Upgrade: websocket\r\n" .
                "Connection: Upgrade\r\n" .
                "Sec-WebSocket-Key: tQXaRIOk4sOhqwe7SBs43g==\r\n" .
                "Sec-WebSocket-Version: 13\r\n" .
                "Content-Length: ".strlen($data)."\r\n"."\r\n";

            fwrite($socket, $head);
            $headers = fread($socket, 2000);
            echo $headers;
			
			fwrite($socket, $data);
            $wsdata = fread($socket, 2000);
            var_dump($wsdata);
            fclose($socket);
			
		}
	print "222";
   exit;
  if (($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {
    //AF_INET - семейство протоколов
    //SOCK_STREAM - тип сокета
    //SOL_TCP - протокол
    echo "Ошибка создания сокета";
  }
  else {
    echo "Сокет создан\n";
  }
 
    $result = socket_connect($socket, $address, $port);
	if ($result === false) {
		echo "Не удалось выполнить socket_connect().\nПричина: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
	} else {
		echo "OK.\n";
	}


  
  //$result = socket_connect($socket, $address, $port);
  /*
  if ($result === false) {
    echo "Ошибка при подключении к сокету";
  } else {
    echo "Подключение к сокету прошло успешно\n";
  }
 
  
  $out = socket_read($socket, 1024); //Читаем сообщение от сервера
  echo "Сообщение от сервера: $out.\n";
  $msg = "15";
  echo "Сообщение серверу: $msg\n";
   /**/
   
   // $out = socket_read($socket, 1024); //Читаем сообщение от сервера
 // echo "Сообщение от сервера: $out.\n";
  
    echo "Читаем ответ:\n\n";
	while ($out = socket_read($socket, 2048)) {
		echo "Answer".$out;
	}


    $msg = "15";
  echo "Сообщение серверу: $msg\n";
  socket_write($socket, $msg, strlen($msg)); //Отправляем серверу сообщение
  
  exit;
  
  //$out = socket_read($socket, 1024); //Читаем сообщение от сервера
  echo "Сообщение от сервера: $out.\n"; //Выводим сообщение от сервера
  $msg = 'exit'; //Команда отключения
  echo "Сообщение серверу: $msg\n";
  socket_write($socket, $msg, strlen($msg));
  echo "Соединение завершено\n";
  //Останавливаем работу с сокетом
  if (isset($socket)) {
    socket_close($socket);
    echo "Сокет успешно закрыт";
  }
?>