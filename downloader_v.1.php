<?php

ob_start();
define('API_KEY','853949184:AAEC_B2gP9Tk4u4O8lAimoKbDH5ap3uNoHU');
function bot($mirinfo,$kh=[]){
    $mirinfouz = "https://api.telegram.org/bot".API_KEY."/".$mirinfo;
    $yangi = curl_init();
    curl_setopt($yangi,CURLOPT_URL,$mirinfouz);
    curl_setopt($yangi,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($yangi,CURLOPT_POSTFIELDS,$kh);
    $kh = curl_exec($yangi);
    if(curl_error($yangi)){
        var_dump(curl_error($yangi));
    }else{
        return json_decode($kh);
    }
}


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$mid = $message->message_id;
$text = $message->text;
$tx = $message->text;
$uid= $message->from->id;
$ism = $message->from->first_name;
$familya = $message->from->last_name;
$username = $message->from->username;
$name = "<a href='tg://user?id=$uid'>$ism $familya</a>";
$check = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@odamlarga_qiziq&user_id={$cid}");
$kanalim = "-1001942968404";
$api_key = "API kalit"; // api key @mirinfouz_botdan olinadi



$menyu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[["text"=>'Mening profilim'],["text"=>'Balansim']],
[['text'=>"📊 Statistika"],['text'=>"sozlamalr"]],
]
]);


if($tx == '/start' and strpos($check, '"status":"left"') == TRUE){
    bot('sendMessage',[
        'chat_id'=>$cid,
        'text'=>"Assalomu alaykum $name ! agar ushbu kod sizga yoqqan bo'lsa iltimos o'z shaxsiy fikringizni yoki taklifingizni @pyatkauzb guruxida qoldiring",
        'parse_mode'=>'html',
        'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Kanalga az'o bolish",'url'=>'https://t.me/odamlarga_qiziq']]
]
])
]);
}


if($tx == '/start' and strpos($check, '"status":"left"') != TRUE){
bot('sendMessage', [
'chat_id'=>$cid,
'text'=>"Endi botdan xohlaganingizcha foydalaning",
'reply_markup'=>$menyu,
'parse_mode'=>'html',
]);
}


if(mb_stripos($text,"instagram") !== false){
$filem = json_decode(file_get_contents("https://mirinfo.uz/api/instagram/?api_key={$api_key}&url={$text}"), true);
$vid = $filem['videoUrl'];
bot('sendMessage',[
 'chat_id'=>$cid,
 'text'=>"
 ☇<b>🔍</b>",
 'parse_mode'=>"HTML"
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'text'=>'🔍'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid +1,
 'text'=>'Loading!.'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!..'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!...'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!....'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'✅'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'□□□□□ 0%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■□□□□ 20%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■□□□ 40%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■□□ 60%'
]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■■□ 80%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■■■ 100%'
 ]); 
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Video topildi!'
 ]); 
  bot('deletemessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid + 1,
    ]);
 sleep(0.1);
bot('sendvideo',[
'chat_id'=>$cid,
'video'=>"$vid", 
'caption'=>"@uzbekpostbot", 
'parse_mode'=>'html',
'reply_markup'=>$boshm,
]);
}






if(mb_stripos($text,"facebook") !== false){
$filem = json_decode(file_get_contents("https://mirinfo.uz/api/fb?api_key={$api_key}&url={$text}"), true);
$vid = $filem['videoUrl'];
bot('sendMessage',[
 'chat_id'=>$cid,
 'text'=>"
 ☇<b>🔍</b>",
 'parse_mode'=>"HTML"
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'text'=>'🔍'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid +1,
 'text'=>'Loading!.'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!..'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!...'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!....'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'✅'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'□□□□□ 0%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■□□□□ 20%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■□□□ 40%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■□□ 60%'
]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■■□ 80%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■■■ 100%'
 ]); 
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Video topildi!'
 ]); 
  bot('deletemessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid + 1,
    ]);
 sleep(0.1);
bot('sendvideo',[
'chat_id'=>$cid,
'video'=>"$vid", 
'caption'=>"Video @uzbekpost bot orqali yuklandi!", 
'parse_mode'=>'html',
'reply_markup'=>$boshm,
]);
}



if(mb_stripos($text,"youtu") !== false){
$filem = json_decode(file_get_contents("https://mirinfo.uz/api/utube?api_key={$api_key}&url={$text}"), true);
$vid = $filem['videoUrl'];
bot('sendMessage',[
 'chat_id'=>$cid,
 'text'=>"
 ☇<b>🔍</b>",
 'parse_mode'=>"HTML"
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'text'=>'🔍'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid +1,
 'text'=>'Loading!.'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!..'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!...'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!....'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'✅'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'□□□□□ 0%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■□□□□ 20%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■□□□ 40%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■□□ 60%'
]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■■□ 80%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■■■ 100%'
 ]); 
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Video topildi!'
 ]); 
  bot('deletemessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid + 1,
    ]);
 sleep(0.1);
bot('sendvideo',[
'chat_id'=>$cid,
'video'=>"$vid", 
'caption'=>"Video @uzbekpostbot orqali yuklandi!", 
'parse_mode'=>'html',
'reply_markup'=>$boshm,
]);
}





if(mb_stripos($text,"tiktok") and strpos($check, '"status":"left"') != TRUE){
$filem = json_decode(file_get_contents("https://mirinfo.uz/api/tiktok/?api_key={$api_key}&url={$text}"), true);
$vid = $filem['videoUrl'];
bot('sendMessage',[
 'chat_id'=>$cid,
 'text'=>"
 ☇<b>🔍</b>",
 'parse_mode'=>"HTML"
 ]);
 sleep(0.3);
bot('editMessageText',[
 'chat_id'=>$cid,
 'text'=>'🔍'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid +1,
 'text'=>'Loading!.'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!..'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!...'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Loading!....'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'✅'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'□□□□□ 0%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■□□□□ 20%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■□□□ 40%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■□□ 60%'
]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■■□ 80%'
 ]);
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'■■■■■ 100%'
 ]); 
 sleep(0.1);
bot('editMessageText',[
 'chat_id'=>$cid,
 'message_id'=>$mid + 1,
 'text'=>'Video topildi!'
 ]); 
  bot('deletemessage',[
    'chat_id'=>$cid,
    'message_id'=>$mid + 1,
    ]);
 sleep(0.1);
bot('sendvideo',[
'chat_id'=>$cid,
'video'=>"$filem", 
'caption'=>"Video @uzbekpost bot orqali yuklandi!", 
'parse_mode'=>'html',
'reply_markup'=>$boshm,
]);
}






?>