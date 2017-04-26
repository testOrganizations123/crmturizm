<?php

 //Возвращает true, если домен доступен
       function isDomainAvailible($domain)
       {
               //Проверка на правильность URL 
               if(!filter_var($domain, FILTER_VALIDATE_URL))
               {
                       return false;
               }

               //Инициализация curl
               $curlInit = curl_init($domain);
               curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
               curl_setopt($curlInit,CURLOPT_HEADER,true);
               curl_setopt($curlInit,CURLOPT_NOBODY,true);
               curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

               //Получаем ответ
               $response = curl_exec($curlInit);

               curl_close($curlInit);

               if ($response) return true;

               return false;
       }
	   
	   function sendmessage()
	   {
		    if( $curl = curl_init() ) {
				curl_setopt($curl, CURLOPT_URL, 'http://proxytest.1gb.ru/message.php');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, "t=5&d=422");
				$out = curl_exec($curl);
				echo $out;
				curl_close($curl);
			  }
  
		   /*
		   $ch = curl_init(); 
		  // GET запрос указывается в строке URL 
		  curl_setopt($ch, CURLOPT_URL, 'http://proxytest.1gb.ru/message.php?t=5&d=4'); 
		  curl_setopt($ch, CURLOPT_HEADER, false); 
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
		  curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Bot (http://mysite.ru)'); 
		  $data = curl_exec($ch); 
		  curl_close($ch); 
		  /**/
	   }
	   
       if (isDomainAvailible('http://proxytest.1gb.ru/'))
       {
				sendmessage();
               echo "Работает и готов отвечать на запросы!";
       }
       else
       {
               echo "Ой, сайт не доступен.";
       }
?>