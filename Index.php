<?php
/*
Programmer : mohamadhosseinheidari
Telegram ID : @NOBL3ST
*/
error_reporting(0);
define('API_KEY','Token');
date_default_timezone_set('Asia/Tehran');
//-----------------------------------------------------------------------------------------
function MrPHPBot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//-----------------------------------------------------------------------------------------
//متغیر ها :
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$textmassage = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$from_id2 = $update->callback_query->from->id;
$callback_id = $update->callback_query->id;
$message_id2 = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$Dev = 193930120;
$channel = -1001142699316;
$step= file_get_contents("data/$from_id/file.txt");
$tc = $update->message->chat->type;
$botlist2= file_get_contents("data/$chat_id2/listbot.txt");
$date= file_get_contents("data/$chat_id2/date.txt");
$text= file_get_contents("data/$chat_id2/text.txt");
$name= file_get_contents("data/$chat_id2/name.txt");
$link= file_get_contents("data/$chat_id2/link.txt");
$textin = $update->inline_qurey->qurey;
//-----------------------------------------------------------------------------------------
//فانکشن ها :
function SendMessage($chat_id, $text){
MrPHPBot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>'MarkDown']);
}
function SendDocument($chat_id,$document,$caption){
	bot('SendDocument',[
	'chat_id'=>$chat_id,
	'document'=>$document,
        'caption'=>$caption
	]);
	}
function save($filename, $data)
{
$file = fopen($filename, 'w');
fwrite($file, $data);
fclose($file);
}
function sendAction($chat_id, $action){
MrPHPBot('sendChataction',[
'chat_id'=>$chat_id,
'action'=>$action]);
}
function Forward($berekoja,$azchejaei,$kodompayam)
{
MrPHPBot('ForwardMessage',[
'chat_id'=>$berekoja,
'from_chat_id'=>$azchejaei,
'message_id'=>$kodompayam
]);
}
function objectToArrays( $object ) {
				if( !is_object( $object ) && !is_array( $object ) )
				{
				return $object;
				}
				if( is_object( $object ) )
				{
				$object = get_object_vars( $object );
				}
			return array_map( "objectToArrays", $object );
			}
//================================================
//-----------------------------------------------------------------------------------------
if($textmassage == "/start"){
          if (!file_exists("data/$from_id/file.txt")) {
  save("data/$from_id/file.txt","none");
            mkdir("data/$from_id");
          }
  if ($tc == 'private'){
            sendAction($chat_id, 'typing');
            MrPHPBot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>"سلام $first_name
شما در ربات  تبلیغات  چی عضو شدید:)
➖➖➖
با این ربات میتوانید به صورت رایگان تبلیغ خود را به کانال تبلیغات چی ارسال کنید
➖➖➖
✏️α∂ѕcнιвσт",
            'parse_mode'=>'html',
          	'reply_markup'=>json_encode([
          	'resize_keyboard'=>true,
			 'inline_keyboard'=>[
            [
   ['text'=>"ارسال تبلیغات شیشه ای",'callback_data'=>"sendch1"],['text'=>"ارسال تبلیغات متنی",'callback_data'=>"sendch2"]
   ],
      [
  ['text'=>"بریم کانال",'url'=>"https://telegram.me/Ads_Chi"]
   ],
   ]
  ])
  ]);
 }
  else{
            SendMessage($chat_id,"این ربات فقط در خصوصی فعالیت میکند.");
            }
}
 if($data=="back"){
save("data/$from_id2/file.txt","none");
 sendAction($chat_id, 'typing');
 MrPHPBot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
 'text'=>"شما اکنون در منوی اصلی هستید\nانتخاب کنید :",
 'parse_mode'=>'MarkDown',
 'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'inline_keyboard'=>[
   [
   ['text'=>"ارسال تبلیغات شیشه ای",'callback_data'=>"sendch1"],['text'=>"ارسال تبلیغات متنی",'callback_data'=>"sendch2"]
   ],
      [
  ['text'=>"بریم کانال",'url'=>"https://telegram.me/Ads_Chi"]
   ],
   ]
  ])
  ]);
 }
  elseif($data=="sendch2"){
$datew = $date;
if(date('G',time()) > $datew){
save("data/$from_id2/file.txt","sendch2");
 sendAction($chat_id, 'typing');
 MrPHPBot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
 'text'=>"جهت ارسال تبلیغ به کانال متن تبلیغ خود را بفرستید در غیر اینصورت برروی گزینه برگردیم عقب بزن تا برگردیم :)\n➖➖➖\nدر متن خود میتوانید از فرمت های html استفاده کنید.",
 'parse_mode'=>'MarkDown',
 'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'inline_keyboard'=>[
   [
   ['text'=>"برگردیم عقب",'callback_data'=>"back"]
   ],
   ]
  ])
  ]);
}
else{
          MrPHPBot('answerCallbackQuery',[
  'callback_query_id'=>$callback_id,
  'text'=>"هر یک ساعت یکبار میتوانید تبلیغ بفرستید.",
  'show_alert'=>true
  ]);
            }
}
  elseif($step == "sendch2"){
$text = $textmassage;
$ndate = date("G");
save("data/$from_id/date.txt","$ndate");
save("data/$from_id/file.txt","none");
  MrPHPBot('sendmessage',[
          	'chat_id'=>$channel,
          	'text'=>"$text\n➖➖➖\n@Ads_Chi",
            'parse_mode'=>'html'
			]);
			  MrPHPBot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>"تبلیغ شما با موفقیت در کانال ارسال شد.",
            'parse_mode'=>'MarkDown'
			]);
}
 elseif($data=="sendch1"){
$datew = $date;
if(date('G',time()) > $datew){
save("data/$from_id2/file.txt","sendch1");
 sendAction($chat_id, 'typing');
 MrPHPBot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
 'text'=>"جهت ارسال تبلیغ به کانال ابتدا متن بالای دکمه شیشه ای را بفرستید :)",
 'parse_mode'=>'MarkDown',
 'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 'inline_keyboard'=>[
   [
   ['text'=>"برگردیم عقب",'callback_data'=>"back"]
   ],
   ]
  ])
  ]);
}
else{
          MrPHPBot('answerCallbackQuery',[
  'callback_query_id'=>$callback_id,
  'text'=>"هر یک ساعت یکبار میتوانید تبلیغ بفرستید.",
  'show_alert'=>true
  ]);
            }
}
  elseif($step == "sendch1"){
save("data/$from_id/text.txt","$textmassage");
save("data/$from_id/file.txt","sendch11");
			  MrPHPBot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>"خب حالا نام دکمه شیشه ای رو بفرست :)",
            'parse_mode'=>'MarkDown'
]);
}
  elseif($step == "sendch11"){
save("data/$from_id/name.txt","$textmassage");
save("data/$from_id/file.txt","sendch111");
			  MrPHPBot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>"خب الان لینک دکمه شیشه رو بفرست :)",
            'parse_mode'=>'MarkDown'
]);
}
elseif($step == "sendch111"){
save("data/$from_id/link.txt","$textmassage");
save("data/$from_id/file.txt","none");
			  MrPHPBot('sendmessage',[
          	'chat_id'=>$chat_id,
          	'text'=>"انتخاب کن :)",
            'parse_mode'=>'MarkDown',
			 'reply_markup'=>json_encode([
 'resize_keyboard'=>true,
 	 'inline_keyboard'=>[
            [
   ['text'=>"لغو",'callback_data'=>"ok"],['text'=>"ارسال",'callback_data'=>"send"]
   ],
   ]
  ])
]);
}
elseif($data=="send"){
$channel2 = -1001142699316;
$ndate = date("G");
save("data/$chat_id2/date.txt","$ndate");
 sendAction($chat_id, 'typing');
MrPHPBot('sendmessage',[
	'chat_id'=>$channel2,
  'message_id'=>$message_id2,
	'text'=>"$text\n➖➖➖\n@Ads_Chi",
  'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'inline_keyboard'=>[
	[
	['text'=>"$name",'url'=>"$link"]
	],
	]
	])
	]);
 MrPHPBot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
 'text'=>"باموفقیت ارسال شد.",
 'parse_mode'=>'MarkDown',
  ]);
}
elseif($data=="ok"){
save("data/$from_id/name.txt","");
save("data/$from_id/text.txt","");
save("data/$from_id/link.txt","");
 sendAction($chat_id, 'typing');
 MrPHPBot('editMessagetext',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id2,
 'text'=>"عملیات لغو شد.",
 'parse_mode'=>'MarkDown',
  ]);
}
elseif ($textin = "Ads") {
   MrPHPBot('answerInlineQuery', [
        'inline_query_id' => $update->inline_query->id,
        'results' => json_encode([[
            'type' => 'article',
            'id' => base64_encode(rand(5, 555)),
            'title' => 'بنر تبلیغاتی',
            'input_message_content' => ['parse_mode' => 'MarkDown', 'message_text' => "دوست داری تو کانال تبلیغاتچی تبلیغ کنی و پست موردنظر خودت روبزاری پس بزن بریم\n➖➖➖
*AdsChiBot*"],
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "عضویت در ربات", 'url' => 'https://telegram.me/AdsChibot']
                    ],
                    [
                        ['text' => "اشتراک با دیگران", 'switch_inline_query' => 'ads']
                    ]
                ]
            ]
        ]])
    ]);
}
?>
