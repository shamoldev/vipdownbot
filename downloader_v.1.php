<?php
ob_start();
error_reporting(0);
date_default_timezone_set("Asia/Tashkent");
define('API_KEY','5378082495:AAHfl80dTn2ZUz0Hzbkqqu-PqLNMBZ7Ebpk');
$admin = "789945598";
$time = date('H:i');
$sana = date('d.m.Y');


function bot($method,$steps=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$steps);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}

$servername = "localhost";
$username = "ibodat_uz";
$password = "mexroj17uz";
$connect = new mysqli($servername, $username, $password, $username);

$update = json_decode(file_get_contents('php://input'));
$callback = $update->callback_query->data;
$callcid = $update->callback_query->message->chat->id;
$callmid = $update->callback_query->message->message_id;
$message = $update->message;
$cid = $message->chat->id;
$mid = $message->message_id;
$chat_id = $message->chat->id;
$type = $message->chat->type;
$bot = bot('getme',['bot'])->result->username;
$text = $message->text;
$botdel = $update->my_chat_member->new_chat_member;
$botdel_id = $update->my_chat_member->from->id;
$userstatus = $botdel->status;
$name = $message->chat->first_name;
$lastname = $message->chat->last_name;
$botname = "Ibodat_kitobi_bot";
$back = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Ortga"]]
]
]);

if($connect->connect_error){
bot('sendMessage',[
'chat_id' =>$cid,
'text'=>"<b>⚠️ Maʼlumotlar bazasiga ulanishda muammo yuz berdi!</b>",
'parse_mode' =>'html',
]);
return false;
}

function addstep($step,$n,$cid){
global $connect;
$sql = "UPDATE `users` SET `step$n` = '$step' WHERE `id` = '$cid'";
$connect->query($sql);
}

$result = mysqli_query($connect, "SELECT * FROM `users`"); 
$row = mysqli_fetch_assoc($result);
$step1 = $row['step1'];
$step2 = $row['step2'];

if($type == "private"){
$result = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$cid'");
$row = mysqli_fetch_assoc($result);
if($row){
}else{
mysqli_query($connect, "INSERT INTO `users` (`id`,`date`,`time`,`status`,`step1`,`step2`) VALUES ('$cid','$sana','$time','active','null','null')");
}
}

if($type == "private"){
$result = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$cid'");
$row = mysqli_fetch_assoc($result);
$status = $row['status'];
if($status == "passive"){
mysqli_query($connect, "UPDATE `users` SET `status` = 'active' WHERE `id` = '$cid'");
}
}

if($botdel){
if($userstatus == "kicked"){
$sql = "UPDATE `users` SET `status` = 'passive' WHERE `id` = '$botdel_id'";
$result = mysqli_query($connect, $sql);
}
}

$result = mysqli_query($connect,"SELECT * FROM `active`");
while($row = mysqli_fetch_assoc($result)){
$holat = $row['status'];
if($chat_id == $admin){}
elseif($holat == "off"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"<b>🛠 Texnik xizmat davom etmoqda!

▪ Bot maʼmuriyati ushbu bot ichida baʼzi texnik ishlarni olib bormoqda.
▪ Shu sababdan menyu adminlar tomonidan oʻchirilgan va hozirda foydalanuvchilar uchun mavjud emas.
▪ Barcha funksiyalar tugallangandan keyin tiklanadi.

🔰 Agar siz ushbu botning administratori boʻlsangiz, ushbu rejimni oʻchirib qoʻyishingiz mumkin!
👉🏻👨🏻‍💻 Boshqaruv paneli | ⚙ Bot sozlamalari.

📝 Boshqalar uchun:
ℹ️ Keyinroq qaytib keling va bot holatini tekshirish uchun /start tugmasini bosing!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'remove_keyboard'=>true,
])
]);
return false;
}
}

$key= json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
    [['text'=>"🕋 Payg'ambarlar tarixi"]],
    [['text'=>"🕌 Savob olish"],['text'=>"📿 Suralar"]],
    [['text'=>"🤲Nomoz vaqti"]],
    ]
]);

$rozab= json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
[['text'=>"💫 Ro'za duosi"],['text'=>"🕋 Taqvim"]],
[['text'=>"🌄 Ramazon tabrik yasash"]],
[['text'=>"🌙 Ro'zaga vaqt"],['text'=>"Orqaga🔙"]],
]
]);

$admen= json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[

[['text'=>"🕋 Payg'ambarlar tarixi"]],
[['text'=>"🕌 Savob olish"],['text'=>"📿 Suralar"]],
[['text'=>"🤲Nomoz vaqti"]]
]
]);

$qollanma= json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
[['text'=>"👨‍💻 Dasturchi"],['text'=>"🗞 Yangiliklar"]],
[['text'=>"Orqaga🔙"]],
]
]);

$suralar= json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
[['text'=>"📖 Fotiha surasi"]],
[['text'=>"📖 Baqara surasi"],['text'=>"📖 Imron surasi"]],
[['text'=>"📖 Niso surasi"],['text'=>"📖 Maida surasi"]],
[['text'=>"📖 Anam surasi"],['text'=>"📖 Arof surasi"]],
[['text'=>"📖 Anfol surasi"],['text'=>"📖 Tavba surasi"]],
[['text'=>"📖 Yunus surasi"],['text'=>"📖 Hud surasi"]],
[['text'=>"📖 Yusuf surasi"],['text'=>"📖 Rad surasi"]],
[['text'=>"📖 Ibrohim surasi"],['text'=>"📖 Hijr surasi"]],
[['text'=>"📖 Nahl surasi"],['text'=>"📖 Isro surasi"]],
[['text'=>"📖 Kahf surasi"],['text'=>"📖 Maryam surasi"]],
[['text'=>"📖 Toha surasi"],['text'=>"📖 Anbiyo suarsi"]],
[['text'=>"📖 Haj surasi"],['text'=>"📖 Muminun surasi"]],
[['text'=>"📖 Nur surasi"],['text'=>"📖 Furqon surasi"]],
[['text'=>"📖 Shuaro surasi"],['text'=>"📖 Naml surasi"]],
[['text'=>"📖 Qasos surasi"],['text'=>"📖 Ankabut surasi"]],
[['text'=>"📖 Rum Surasi"],['text'=>"📖 Luqmon surasi"]],
[['text'=>"📖 Sajda surasi"],['text'=>"📖 Ahzob surasi"]],
[['text'=>"📖 Saba surasi"],['text'=>"📖 Fotir surasi"]],
[['text'=>"📖 Yosin surasi"],['text'=>"📖 Soffat surasi"]],
[['text'=>"📖 Sod surasi"],['text'=>"📖 Zumar surasi"]],
[['text'=>"📖 Gofir surasi"],['text'=>"📖 Fussilat surasi"]],
[['text'=>"📖 Shoro surasi"],['text'=>"📖 Zuxruf surasi"]],
[['text'=>"📖 Zuhan surasi"],['text'=>"📖 Jathiya surasi"]],
[['text'=>"📖 Ahqaf surasi"],['text'=>"📖 Muhammad surasi"]],
[['text'=>"📖 Fath surasi"],['text'=>"📖 Hujurat surasi"]],
[['text'=>"📖 Qof surasi"],['text'=>"📖 Zuriyat surasi"]],
[['text'=>"📖 Tur surasi"],['text'=>"📖 Najim surasi"]],
[['text'=>"📖 Qamar surasi"],['text'=>"📖 Rohman surasi"]],
[['text'=>"📖 Voqiya surasi"],['text'=>"📖 Hadid surasi"]],
[['text'=>"📖 Mujadila surasi"],['text'=>"📖 Hashir surasi"]],
[['text'=>"📖 Mumtahina surasi"],['text'=>"📖 Soff surasi"]],
[['text'=>"📖 Juma surasi"],['text'=>"📖 Munofiqun surasi"]],
[['text'=>"📖 Taghabun surasi"],['text'=>"📖Taloq surasi"]],
[['text'=>"📖 Tahrim surasi"],['text'=>"📖 Mulk surasi"]],
[['text'=>"📖 Qalam surasi"],['text'=>"📖 Haqqa surasi"]],
[['text'=>"📖 Muorij surasi"],['text'=>"📖 Nuh surasi"]],
[['text'=>"📖 jinn surasi"],['text'=>"📖 Muzzammil surasi"]],
[['text'=>"📖 Muddathir surasi"],['text'=>"📖 Qiyama surasi"]],
[['text'=>"📖 Insan surasi"],['text'=>"📖 Mursalat surasi"]],
[['text'=>"📖 Naba surasi"],['text'=>"📖 Naziat surasi"]],
[['text'=>"📖 Abasa surasi"],['text'=>"📖 Takawir surasi"]],
[['text'=>"📖 Infitar surasi"],['text'=>"📖 Mutaffifeen surasi"]],
[['text'=>"📖 Inshiqaq surasi"],['text'=>"📖Burooj surasi"]],
[['text'=>"📖 Tariq surasi"],['text'=>"📖 Ala surasi"]],
[['text'=>"📖 Ghashiya surasi"],['text'=>"📖 Fajir surasi"]],
[['text'=>"📖 Balad surasi"],['text'=>"📖 Shams surasi"]],
[['text'=>"📖 Lail surasi"],['text'=>"📖 Dhuha surasi"]],
[['text'=>"📖 Sharh surasi"],['text'=>"📖 Teen surasi"]],
[['text'=>"📖 Alaq surasi"],['text'=>"📖 Qadr surasi"]],
[['text'=>"📖 Bayyina surasi"],['text'=>"📖 Zilzila surasi"]],
[['text'=>"📖 Adiyat surasi"],['text'=>"📖 Qaria surasi"]],
[['text'=>"📖 Takathur surasi"],['text'=>"📖 Asr surasi"]],
[['text'=>"📖 Humaza surasi"],['text'=>"📖 Fil surasi"]],
[['text'=>"📖 Quraysh surasi"],['text'=>"📖 Moun surasi"]],
[['text'=>"📖 Kavsar surasi"],['text'=>"📖 Kofirun surasi"]],
[['text'=>"📖 Nasr surasi"],['text'=>"📖 Masad surasi"]],
[['text'=>"📖 Ixlos surasi"],['text'=>"📖 Falaq surasi"]],
[['text'=>"📖 Nos surasi"],['text'=>"Orqaga🔙"]],
]
]);

$paygamtar= json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
[['text'=>"Odam Alayhissalom"],['text'=>"Idris Alayhissalom"]],
[['text'=>"Hud Alayhissalom"],['text'=>"Nuh Alayhissalom"]],
[['text'=>"Solih Alayhissalom"],['text'=>"Ibrohim Alayhissalom"]],
[['text'=>"Lut  Isxoq Yaqub Alayhissalomlar"]],
[['text'=>"Ismoil Alayhissalom"],['text'=>"Orqaga🔙"]],
]
]);

$admpan= json_encode([
  'resize_keyboard'=>true,
  'keyboard'=>[
[['text'=>"📊 Statistika"],['text'=>"📝 Habar yuborish"]],
[['text'=>"Orqaga🔙"]],
]
]);

if($text== "/start" or $text== "Orqaga🔙"){
bot('sendMessage',[
"chat_id"=>$cid,
'text'=>"<b> Assalomu alaykum botimizga xush kelibsiz o'zingga kerakli menyuni tanlang </b> ",
"parse_mode"=>"html",
"reply_markup"=>$key,
]);
}

if($text== "/start" or $text== "Orqaga🔙" and $cid == $admin){
bot('sendMessage',[
"chat_id"=>$cid,
'text'=>"<b> Assalomu alaykum botimizga xush kelibsiz o'zingga kerakli menyuni tanlang </b> ",
"parse_mode"=>"html",
"reply_markup"=>$admen,
]);
}

//Ushbu kodni @ProstaMukhammadazim tuzgan va
//@MeProCompany kanalida tarqatildi
//Manba hurmat qilinsin: @MeProCompany 

if($text== "💫 Ro'za duosi"){
bot('sendPhoto',[
"chat_id"=>$cid,
"photo"=>"https://t.me/MukhammadazimDev/49",
"caption"=>"<b>Ro'za duosi:

نَوَيْتُ أَنْ أَصُومَ صَوْمَ شَهْرَ رَمَضَانَ مِنَ الْفَجْرِ إِلَى الْمَغْرِبِ، خَالِصًا لِلهِ تَعَالَى أَللهُ أَكْبَرُ

Navaytu an asuvma sovma shahri ramazona minal fajri ilal mag‘ribi, xolisan lillahi taʼaalaa Allohu akbar.

Maʼnosi: Ramazon oyining ro‘zasini subhdan to kun botguncha tutmoqni niyat qildim. Xolis Alloh uchun Alloh buyukdir.

💫💫💫💫💫💫💫💫💫💫💫💫💫💫

اَللَّهُمَّ لَكَ صُمْتُ وَ بِكَ آمَنْتُ وَ عَلَيْكَ تَوَكَّلْتُ وَ عَلَى رِزْقِكَ أَفْتَرْتُ، فَغْفِرْلِى مَا قَدَّمْتُ وَ مَا أَخَّرْتُ بِرَحْمَتِكَ يَا أَرْحَمَ الرَّاحِمِينَ

Allohumma laka sumtu va bika aamantu va aʼlayka tavakkaltu va aʼlaa rizqika aftartu, fag‘firliy ma qoddamtu va maa axxortu birohmatika yaa arhamar roohimiyn.

Maʼnosi: Ey Alloh, ushbu Ro‘zamni Sen uchun tutdim va Senga iymon keltirdim va Senga tavakkal qildim va bergan rizqing bilan iftor qildim. Ey mehribonlarning eng mehriboni, mening avvalgi va keyingi gunohlarimni mag‘firat qilgil.

@$botname - Mukammal islomiy bot😊💫
</b>",
"parse_mode"=>"html",
]);
}

if($text== "📿 Suralar"){
bot('sendMessage',[
"chat_id"=>$cid,
"text"=>"<b>Kerakli surani tanlang :)</b>",
"parse_mode"=>"html",
"reply_markup"=>$suralar,
]);
}

if($text == "👨‍💻 Dasturchi"){
 bot('sendMessage',[
 'chat_id'=>$cid,
  'text'=>"<b>🧑‍💻Bot Dasturchisi: </b>
  
<i>@ProstaMukhammadazim | MePro Mentor</i>",
'parse_mode'=>'html',
"reply_markup"=>json_encode([
              "inline_keyboard"=>[
              [["text"=>"🖇 Loyihalar","url"=>"https://t.me/ProstaMukhammadazim/44"],],
              ]
              ]), 
]);
}


if($text== "📖 Fotiha surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/50",
"caption"=>"<b>
📿🔊 Sura: Fotiha
📋 Sura raqami: 001

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Baqara surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/51",
"caption"=>"<b>
📿🔊 Sura: Baqara
📋 Sura raqami: 002

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Imron surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/52",
"caption"=>"<b>
📿🔊 Sura: Oliy Imron
📋 Sura raqami: 003

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Niso surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/53",
"caption"=>"<b>
📿🔊 Sura: Niso
📋 Sura raqami: 004

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Maida surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/54",
"caption"=>"<b>
📿🔊 Sura: Maida
📋 Sura raqami: 005

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Anam surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/55",
"caption"=>"<b>
📿🔊 Sura: Anam
📋 Sura raqami: 006

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Arof surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/56",
"caption"=>"<b>
📿🔊 Sura: Arof
📋 Sura raqami: 007

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Anfol surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/57",
"caption"=>"<b>
📿🔊 Sura: Anfol
📋 Sura raqami: 008

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Tavba surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/58",
"caption"=>"<b>
📿🔊 Sura: Tavba
📋 Sura raqami: 009

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Yunus surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/59",
"caption"=>"<b>
📿🔊 Sura: Yunus
📋 Sura raqami: 010

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Hud surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/60",
"caption"=>"<b>
📿🔊 Sura: Hud
📋 Sura raqami: 011

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Yusuf surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/61",
"caption"=>"<b>
📿🔊 Sura: Yusuf
📋 Sura raqami: 012

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Rad surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/62",
"caption"=>"<b>
📿🔊 Sura: Rad
📋 Sura raqami: 013

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Ibrohim surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/63",
"caption"=>"<b>
📿🔊 Sura: Ibrohim
📋 Sura raqami: 014

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}


if($text== "📖 Hijr surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/64",
"caption"=>"<b>
📿🔊 Sura: Hijr
📋 Sura raqami: 015

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Nahl surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/65",
"caption"=>"<b>
📿🔊 Sura: Nahl
📋 Sura raqami: 016

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Isro surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/66",
"caption"=>"<b>
📿🔊 Sura: Isro
📋 Sura raqami: 017

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Kahf surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/67",
"caption"=>"<b>
📿🔊 Sura: Kahf
📋 Sura raqami: 018

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Maryam surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/69",
"caption"=>"<b>
📿🔊 Sura: Maryam
📋 Sura raqami: 019

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Toha surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/70",
"caption"=>"<b>
📿🔊 Sura: Toha
📋 Sura raqami: 020

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Anbiyo suarsi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/71",
"caption"=>"<b>
📿🔊 Sura: Anbiyo
📋 Sura raqami: 021

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Haj surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/72",
"caption"=>"<b>
📿🔊 Sura: Haj
📋 Sura raqami: 022

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}


if($text== "📖 Muminun surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/73",
"caption"=>"<b>
📿🔊 Sura: Muminun
📋 Sura raqami: 023

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Nur surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/74",
"caption"=>"<b>
📿🔊 Sura: Nur
📋 Sura raqami: 024

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}


if($text== "📖 Furqon surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/75",
"caption"=>"<b>
📿🔊 Sura: Furqon
📋 Sura raqami: 025

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Shuaro surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/76",
"caption"=>"<b>
📿🔊 Sura: Shuaro
📋 Sura raqami: 026

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Naml surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/77",
"caption"=>"<b>
📿🔊 Sura: Naml
📋 Sura raqami: 027

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Qasos surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/78",
"caption"=>"<b>
📿🔊 Sura: Qasos
📋 Sura raqami: 028

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Ankabut surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/79",
"caption"=>"<b>
📿🔊 Sura: Ankabut
📋 Sura raqami: 029

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Rum Surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/80",
"caption"=>"<b>
📿🔊 Sura: Rum
📋 Sura raqami: 030

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Luqmon surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/81",
"caption"=>"<b>
📿🔊 Sura: Luqmon
📋 Sura raqami: 031

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}


if($text== "📖 Sajda surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/82",
"caption"=>"<b>
📿🔊 Sura: Sajda
📋 Sura raqami: 032

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Ahzob surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/83",
"caption"=>"<b>
📿🔊 Sura: Ahzob
📋 Sura raqami: 033

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Saba surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/84",
"caption"=>"<b>
📿🔊 Sura: Saba
📋 Sura raqami: 034

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Fotir surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/85",
"caption"=>"<b>
📿🔊 Sura: Fotir
📋 Sura raqami: 035

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Yosin surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/86",
"caption"=>"<b>
📿🔊 Sura: Yosin
📋 Sura raqami: 036

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Soffat surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/87",
"caption"=>"<b>
📿🔊 Sura: Soffat
📋 Sura raqami: 037

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Sod surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/88",
"caption"=>"<b>
📿🔊 Sura: Sod
📋 Sura raqami: 038

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Zumar surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/89",
"caption"=>"<b>
📿🔊 Sura: Zumar 
📋 Sura raqami: 039

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Gofir surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/90",
"caption"=>"<b>
📿🔊 Sura: Gofir 
📋 Sura raqami: 040

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Fussilat surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/91",
"caption"=>"<b>
📿🔊 Sura: Fussilat
📋 Sura raqami: 041

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Shoro surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/92",
"caption"=>"<b>
📿🔊 Sura: Shoro
📋 Sura raqami: 042

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Zuxruf surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/93",
"caption"=>"<b>
📿🔊 Sura: Zuxruf
📋 Sura raqami: 043

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Zuhan surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/94",
"caption"=>"<b>
📿🔊 Sura: Zuhan 
📋 Sura raqami: 044

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Jathiya surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/95",
"caption"=>"<b>
📿🔊 Sura: Jathiya
📋 Sura raqami: 045

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Ahqaf surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/96",
"caption"=>"<b>
📿🔊 Sura: Ahqaf 
📋 Sura raqami: 046

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Muhammad surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/97",
"caption"=>"<b>
📿🔊 Sura: Muhammad 
📋 Sura raqami: 047

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Fath surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/98",
"caption"=>"<b>
📿🔊 Sura: Fath  
📋 Sura raqami: 048

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Hujurat surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/99",
"caption"=>"<b>
📿🔊 Sura: Hujurat   
📋 Sura raqami: 049

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Qof surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/100",
"caption"=>"<b>
📿🔊 Sura: Qof 
📋 Sura raqami: 050

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}


if($text== "📖 Zuriyat surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/101",
"caption"=>"<b>
📿🔊 Sura: Zuriyat 
📋 Sura raqami: 051

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Tur surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/102",
"caption"=>"<b>
📿🔊 Sura: Tur 
📋 Sura raqami: 052

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Najim surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/103",
"caption"=>"<b>
📿🔊 Sura: Najim 
📋 Sura raqami: 053

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Qamar surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/104",
"caption"=>"<b>
📿🔊 Sura: Qamar  
📋 Sura raqami: 054

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Rohman surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/105",
"caption"=>"<b>
📿🔊 Sura: Rohman 
📋 Sura raqami: 055

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Voqiya surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/106",
"caption"=>"<b>
📿🔊 Sura: Voqiya 
📋 Sura raqami: 056

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Hadid surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/107",
"caption"=>"<b>
📿🔊 Sura: Hadid  
📋 Sura raqami: 057

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Mujadila surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/108",
"caption"=>"<b>
📿🔊 Sura: Mujadila 
📋 Sura raqami: 058

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Hashir surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/109",
"caption"=>"<b>
📿🔊 Sura: Hashir  
📋 Sura raqami: 059

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Mumtahina surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/110",
"caption"=>"<b>
📿🔊 Sura: Mumtahina 
📋 Sura raqami: 060

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Soff surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/111",
"caption"=>"<b>
📿🔊 Sura: Soff 
📋 Sura raqami: 061

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Juma surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/112",
"caption"=>"<b>
📿🔊 Sura: Juma 
📋 Sura raqami: 062

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Munofiqun surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/113",
"caption"=>"<b>
📿🔊 Sura: Munofiqun 
📋 Sura raqami: 063

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Taghabun surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/114",
"caption"=>"<b>
📿🔊 Sura: Taghabun 
📋 Sura raqami: 064

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}


if($text== "📖Taloq surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/115",
"caption"=>"<b>
📿🔊 Sura: Taloq 
📋 Sura raqami: 065

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Tahrim surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/116",
"caption"=>"<b>
📿🔊 Sura: Tahrim  
📋 Sura raqami: 066

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Mulk surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/117",
"caption"=>"<b>
📿🔊 Sura: Mulk 
📋 Sura raqami: 067

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Qalam surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/118",
"caption"=>"<b>
📿🔊 Sura: Qalam 
📋 Sura raqami: 068

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Haqqa surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/119",
"caption"=>"<b>
📿🔊 Sura: Haqqa 
📋 Sura raqami: 069

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Muorij surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/120",
"caption"=>"<b>
📿🔊 Sura: Muorij 
📋 Sura raqami: 070

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Nuh surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/121",
"caption"=>"<b>
📿🔊 Sura: Nuh 
📋 Sura raqami: 071

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 jinn surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/122",
"caption"=>"<b>
📿🔊 Sura: jinn 
📋 Sura raqami: 072

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Muzzammil surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/123",
"caption"=>"<b>
📿🔊 Sura: Muzzammil 
📋 Sura raqami: 073

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Muddathir surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/124",
"caption"=>"<b>
📿🔊 Sura: Muddathir 
📋 Sura raqami: 074

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Qiyama surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/125",
"caption"=>"<b>
📿🔊 Sura: Qiyama 
📋 Sura raqami: 075

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Insan surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/126",
"caption"=>"<b>
📿🔊 Sura: Insan 
📋 Sura raqami: 076

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Mursalat surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/127",
"caption"=>"<b>
📿🔊 Sura: Mursalat 
📋 Sura raqami: 077

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Naba surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/128",
"caption"=>"<b>
📿🔊 Sura: Naba 
📋 Sura raqami: 078

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Naziat surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/129",
"caption"=>"<b>
📿🔊 Sura: Naziat 
📋 Sura raqami: 079

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Abasa surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/130",
"caption"=>"<b>
📿🔊 Sura: Abasa 
📋 Sura raqami: 080

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Takawir surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/131",
"caption"=>"<b>
📿🔊 Sura: Takawir
📋 Sura raqami: 081

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Infitar surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/132",
"caption"=>"<b>
📿🔊 Sura: Infitar 
📋 Sura raqami: 082

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Mutaffifeen surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/133",
"caption"=>"<b>
📿🔊 Sura: Mutaffifeen  
📋 Sura raqami: 083

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Inshiqaq surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/134",
"caption"=>"<b>
📿🔊 Sura: Inshiqaq 
📋 Sura raqami: 084

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖Burooj surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/135",
"caption"=>"<b>
📿🔊 Sura: Burooj 
📋 Sura raqami: 085

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Tariq surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/136",
"caption"=>"<b>
📿🔊 Sura: Tariq 
📋 Sura raqami: 086

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Ala surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/137",
"caption"=>"<b>
📿🔊 Sura: Ala 
📋 Sura raqami: 087

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Ghashiya surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/138",
"caption"=>"<b>
📿🔊 Sura: Ghashiya 
📋 Sura raqami: 088

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Fajir surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/139",
"caption"=>"<b>
📿🔊 Sura: Fajir 
📋 Sura raqami: 089

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Balad surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/140",
"caption"=>"<b>
📿🔊 Sura: Balad 
📋 Sura raqami: 090

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Shams surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/141",
"caption"=>"<b>
📿🔊 Sura: Shams 
📋 Sura raqami: 091

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Lail surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/142",
"caption"=>"<b>
📿🔊 Sura: Lail 
📋 Sura raqami: 092

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Dhuha surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/143",
"caption"=>"<b>
📿🔊 Sura: Dhuha 
📋 Sura raqami: 093

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Sharh surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/144",
"caption"=>"<b>
📿🔊 Sura: Sharh 
📋 Sura raqami: 094

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Teen surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/145",
"caption"=>"<b>
📿🔊 Sura: Teen 
📋 Sura raqami: 095

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Alaq surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/146",
"caption"=>"<b>
📿🔊 Sura: Falaq
📋 Sura raqami: 096

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Qadr surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/147",
"caption"=>"<b>
📿🔊 Sura: Qadr 
📋 Sura raqami: 097

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Bayyina surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/148",
"caption"=>"<b>
📿🔊 Sura: Bayyina 
📋 Sura raqami: 098

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Zilzila surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/149",
"caption"=>"<b>
📿🔊 Sura: Zilzila 
📋 Sura raqami: 099

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Adiyat surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/150",
"caption"=>"<b>
📿🔊 Sura: Adiyat 
📋 Sura raqami: 100

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Qaria surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/151",
"caption"=>"<b>
📿🔊 Sura: Qaria 
📋 Sura raqami: 101

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Takathur surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/152",
"caption"=>"<b>
📿🔊 Sura: Takathur 
📋 Sura raqami: 102

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Asr surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/153",
"caption"=>"<b>
📿🔊 Sura: Asr 
📋 Sura raqami: 103

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Humaza surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/154",
"caption"=>"<b>
📿🔊 Sura: Humaza 
📋 Sura raqami: 104

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Fil surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/155",
"caption"=>"<b>
📿🔊 Sura: Fil 
📋 Sura raqami: 105

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Quraysh surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/156",
"caption"=>"<b>
📿🔊 Sura: Quraysh 
📋 Sura raqami: 106

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Moun surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/157",
"caption"=>"<b>
📿🔊 Sura: Moun 
📋 Sura raqami: 107

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Kavsar surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/158",
"caption"=>"<b>
📿🔊 Sura: Kavsar 
📋 Sura raqami: 108

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Kofirun surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/159",
"caption"=>"<b>
📿🔊 Sura: Kofirun 
📋 Sura raqami: 109

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Nasr surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/160",
"caption"=>"<b>
📿🔊 Sura: Nasr 
📋 Sura raqami: 110

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Masad surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/161",
"caption"=>"<b>
📿🔊 Sura: Masad 
📋 Sura raqami: 111

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Ixlos surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/162",
"caption"=>"<b>
📿🔊 Sura: Ixlos 
📋 Sura raqami: 112

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Falaq surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/163",
"caption"=>"<b>
📿🔊 Sura: Falaq 
📋 Sura raqami: 113

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "📖 Nos surasi"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/164",
"caption"=>"<b>
📿🔊 Sura: Nos 
📋 Sura raqami: 114

@$botname orqali ALLAH uchun islomiy barcha bilimlarni o'rganing 😊💫</b>",
"parse_mode"=>"html",
]);
}

if($text== "🕋 Payg'ambarlar tarixi"){
bot('sendMessage',[
"chat_id"=>$cid,
"text"=>"<b>☪️ Qaysi payg'ambar tarixlari haqida o'rganmoqchisiz?</b>",
"parse_mode"=>"html",
"reply_markup"=>$paygamtar,
]);
}

if($text== "Odam Alayhissalom"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/165",
"caption"=>"<b>Odam Alayhissalom haqlarida qissa💫
🔊 Nuriddin hoji domla</b>",
"parse_mode"=>"html",
]);
}

if($text== "Idris Alayhissalom"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/166",
"caption"=>"<b>IDRIS A.S. PAYGAMBARLAR TARIHI.💫
🔊 ABDULLOH DOMLA</b>",
"parse_mode"=>"html",
]);
}

if($text== "Hud Alayhissalom"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/167",
"caption"=>"<b>Hud Alayhissalom haqlarida.💫
🔊 ABDULLOH DOMLA</b>",
"parse_mode"=>"html",
]);
}

if($text== "Nuh Alayhissalom"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/168",
"caption"=>"<b>NUH ALAYHI SALOM haqlarida.💫
🔊 ABDULLOH DOMLA</b>",
"parse_mode"=>"html",
]);
}

if($text== "Solih Alayhissalom"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/169",
"caption"=>"<b>Solih Alayhissalom haqlarida.💫
🔊 ABDULLOH DOMLA</b>",
"parse_mode"=>"html",
]);
}

if($text== "Ibrohim Alayhissalom"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/170",
"caption"=>"<b>Ibrohim Alayhissalom haqlarida.💫
🔊 ABDULLOH DOMLA</b>",
"parse_mode"=>"html",
]);
}

if($text== "Lut  Isxoq Yaqub Alayhissalomlar"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/171",
"caption"=>"<b>Lut,Isxoq,Yaqub alayhissalomlar haqlarida.💫
🔊 ABDULLOH DOMLA</b>",
"parse_mode"=>"html",
]);
}

if($text== "Ismoil Alayhissalom"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/172",
"caption"=>"<b>Ismoil alayhissalom haqlarida.💫
🔊 Anbiyolar qissasi</b>",
"parse_mode"=>"html",
]);
}

if($text== "🕌 Savob olish"){
bot('sendAudio',[
"chat_id"=>$cid,
"audio"=>"https://t.me/MukhammadazimDev/173",
"caption"=>"<b>Albatta tarqating 😊 
Ramazongacha uzr so'rash va minnatforchilik bildirish lozim 📿</b>",
"parse_mode"=>"html",
]);
}

if($text== "✨ Nashidlar"){
bot('sendMessage',[
"chat_id"=>$cid,
"text"=>"<b>Barcha nashidlarni <i>@$nashrek</i> kanalidan topasiz 📿💫
Allah uchun obuna bo'lib qo'ying✊🏻

@$botname  - Mukammal islomiy bot😊💫
</b>",
"parse_mode"=>"html",
]);
}


if($text == "👨🏻‍💻 Boshqaruv paneli" and $cid == $admin or $text == "/panel" and $cid == $admin){
addstep("null",1,$cid);
addstep("null",2,$cid);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>👨🏻‍💻 Boshqaruv paneliga xush kelibsiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📝 Pochta tizimi"],['text'=>"📊 Statistika"],],
[['text'=>"⚙ Bot sozlamalari"],['text'=>"◀️ Ortga"],],
]
])
]);
exit();
}

if($text == "📝 Pochta tizimi" and $cid == $admin){
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📝 Pochta tizimi boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✍🏻 Xabar yuborish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
])
]);
exit();
}

if($text == "✍🏻 Xabar yuborish" and $chat_id == $admin){
$result = mysqli_query($connect, "SELECT * FROM `send`");
$row = mysqli_fetch_assoc($result);
if(!$row){
addstep("send",1,$admin);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📤 Foydalanuvchilarga yuboriladigan xabarni botga yuboring!</b>",
'parse_mode'=>'html',
'reply_markup'=>$back
]);
exit;
}else{
addstep("null",1,$admin);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📑 Hozirda botda xabar yuborish jarayoni davom etmoqda. Yangi xabar yuborish uchun eski yuborilayotgan xabar barcha foydalanuvchilarga yuborilishini kuting!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✍🏻 Xabar yuborish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
])
]);
exit;
}
}

if($step1 == "send" and $text!= "👨🏻‍💻 Boshqaruv paneli" and  $text!= "/start" and $text!= "◀️ Ortga"){
addstep("null",1,$admin);
$result = mysqli_query($connect, "SELECT * FROM `users`");
$stat = mysqli_num_rows($result);
$res = mysqli_query($connect,"SELECT * FROM `users` WHERE `user_id` = '$stat'");
$row = mysqli_fetch_assoc($res);
$user_id = $row['id'];
$time1 = date('H:i', strtotime('+1 minutes'));
$time2 = date('H:i', strtotime('+2 minutes'));
$tugma = json_encode($update->message->reply_markup);
$reply_markup = base64_encode($tugma);
mysqli_query($connect, "INSERT INTO `send` (`time1`,`time2`,`start_id`,`stop_id`,`admin_id`,`message_id`,`reply_markup`,`step`) VALUES ('$time1','$time2','0','$user_id','$admin','$mid','$reply_markup','send')");
addstep("null",2,$admin);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>📋 Saqlandi!
📑 Xabar foydalanuvchilarga soat $time1 da agar ushbu vaqtda yuborilmasa soat $time2 da yuboriladi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✍🏻 Xabar yuborish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
])
]);
exit;
}

$result = mysqli_query($connect, "SELECT * FROM `send`"); 
$row = mysqli_fetch_assoc($result);
$sendstep = $row['step'];
if($sendstep == "send" and isset($_GET['update'])){
$row1 = $row['time1'];
$row2 = $row['time2'];
$start_id = $row['start_id'];
$stop_id = $row['stop_id'];
$admin_id = $row['admin_id'];
$message_id = $row['message_id'];
$tugma = $row['reply_markup'];
if($tugma == "bnVsbA=="){
$reply_markup == "";
}else{
$reply_markup = base64_decode($tugma);
}
$time1 = date('H:i', strtotime('+1 minutes'));
$time2 = date('H:i', strtotime('+2 minutes'));
$limit = 150;

if($time == $row1 or $time == $row2){
$sql = "SELECT * FROM `users` LIMIT $start_id,$limit";
$res = mysqli_query($connect,$sql);
while($a = mysqli_fetch_assoc($res)){
$id = $a['id'];
if($id == $stop_id){
bot('copyMessage',[
'chat_id'=>$id,
'from_chat_id'=>$admin_id,
'message_id'=>$message_id,
'disable_web_page_preview'=>true,
'reply_markup'=>$reply_markup
]);
bot('sendMessage',[
'chat_id'=>$admin_id,
'text'=>"<b>✅ ️Xabar barcha bot foydalanuvchilariga yuborildi!</b>",
'parse_mode'=>'html'
]);
mysqli_query($connect, "DELETE FROM `send`");
exit;
}else{
bot('copyMessage',[
'chat_id'=>$id,
'from_chat_id'=>$admin_id,
'message_id'=>$message_id,
'disable_web_page_preview'=>true,
'reply_markup'=>$reply_markup
]);
}
}
mysqli_query($connect, "UPDATE `send` SET `time1` = '$time1'");
mysqli_query($connect, "UPDATE `send` SET `time2` = '$time2'");
$get_id = $start_id + $limit;
mysqli_query($connect, "UPDATE `send` SET `start_id` = '$get_id'");
bot('sendMessage',[
'chat_id'=>$admin_id,
'text'=>"<b>✅ Yuborildi: $get_id</b>",
'parse_mode'=>'html'
]);
}
}

if($text == "📊 Statistika"){
$getstat = mysqli_query($connect, "SELECT * FROM `users`");
$stat = mysqli_num_rows($getstat);
$getactive = mysqli_query($connect,"SELECT * FROM `users` WHERE `status` = 'active'");
$active = mysqli_num_rows($getactive);
$getpassive = mysqli_query($connect,"SELECT * FROM `users` WHERE `status` = 'passive'");
$passive = mysqli_num_rows($getpassive);
$getvideos = mysqli_query($connect, "SELECT * FROM `videos`");
$videos = mysqli_num_rows($getvideos);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>👥 Bot foydalanuvchilari soni: $stat nafar
🟢 Faol foydalanuvchilar soni: $active nafar
🔴 Nofaol foydalanuvchilar soni: $passive nafar
🖥 Yuklangan videolar soni: $videos ta
⏰ Soat: $time | 📆 Sana: $sana</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"📊 Statistika"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
])
]);
exit();
}

if($text == "⚙ Bot sozlamalari" and $cid == $admin){
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>⚙ Bot sozlamalari boʻlimidasiz!
📋 Quyidagi boʻlimlardan birini tanlang!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅ Botni yoqish"],['text'=>"❌ Botni o‘chirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
])
]);
exit();
}

if($text == "✅ Botni yoqish" and $cid == $admin){
mysqli_query($connect, "DELETE FROM `active` WHERE `status` = 'off'");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>⚠️ Bot muvaffaqiyatli yoqildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅ Botni yoqish"],['text'=>"❌ Botni o‘chirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
])
]);
exit();
}

if($text == "❌ Botni o‘chirish" and $cid == $admin){
mysqli_query($connect, "INSERT INTO `active`(`status`) VALUES ('off')");
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"<b>⚠️ Bot muvaffaqiyatli oʻchirildi!</b>",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅ Botni yoqish"],['text'=>"❌ Botni o‘chirish"],],
[['text'=>"👨🏻‍💻 Boshqaruv paneli"],],
]
])
]);
exit();
}
?>