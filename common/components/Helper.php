<?php

namespace common\components;
use Yii;
use backend\modules\ketQuaMienBac\models\KqxsMb;
use backend\modules\users\models\Useronline;

class Helper
{
    function getKqxsmb(){
        $modelKqxsMb     = new KqxsMb;
        $modelUseronline = new Useronline;
        return true;
    }
    function HMACSHA256($string,$secret){
        return $sig = hash_hmac('sha256', $string, $secret);
    }

   function utf8convert($str) {
      if(!$str) return false;
      $utf8 = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                  );
      foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
      return $str;
  }
   function changeTitle($changTitle){
        $changTitle = $this->utf8convert($changTitle);
        $changTitle =  preg_replace('/([^\pN\pL\ ]+)/u', '', strip_tags($changTitle));
        $changTitle = explode ( ' ' , $changTitle);
        foreach($changTitle as $item){
              if($item ==''){
                    $rong=$item;
              }else{
                    $ok[]=$item;
              }
        }
        $changTitle = implode('-', $ok);
        $changTitle = strtolower($changTitle);
        //$changTitle = $this->clean($changTitle);


        return $changTitle;
  }
   function changeTitle1($changeTitle){
      $str = $this->utf8convert($changeTitle);
      $str = str_replace('*', '', $str);
      $str = str_replace('-', '', $str);
      $str = str_replace('–', '', $str);
      $str = str_replace(',', '', $str);
      $str = preg_replace('/([^\pN\pL\ ]+)/u', '', strip_tags($str));
      $str = strtolower($str);
      return $str;
  }
  function clean($string) {
     $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
     return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
  }
  public  function  RandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  public  function  RandomNumber($length = 10) {
      $characters = '0123456789';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

  public  function  RandomNumberBoolean($length = 10) {
      $characters = '01';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  public  function  subText($str,$limit=10,$dots = 3,$seeMore = null) {
     if(stripos($str," ")){
        $ex_str = explode(" ",$str);
        if(count($ex_str)>$limit){
              $str_s ='';
              for($i=0;$i<$limit;$i++){
                $str_s.=$ex_str[$i]." ";
              }

              $dot ="";
              for ($i=0; $i < $dots; $i++) {
                $dot .= ".";
              }
              $str_s .= $dot .$seeMore;
              return $str_s;
            }else{
              return $str;
            }
    }else{
       return $str;
    }
  }
  function checkStatusFile($file){
    $file_headers = @get_headers($file);
    //echo '<pre>';print_r($file_headers);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        return $exists = false;
    }
    else {
       return  $exists = true;
    }
  }
  function checkImageFile($url){

        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        // Get the HTML or whatever is linked in $url.
        $response = curl_exec($handle);

        // Check for 404 (file not found).
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if($httpCode == 404) {
           return false;
        }else{
            $url = getimagesize($url);
            if (is_array($url)) {
              return true;
            } else {
              return false;
            }

        }

        curl_close($handle);
  }
  function saveImage($basePart,$files,$path,$id,$nameImage){
  //$basePart = 'm-contact'.'/categories/';
      $sourcePath = $basePart.$id.'/'.$path.'/';
      if (!is_dir($sourcePath)){
         mkdir($sourcePath, 0777, true);
      }
      $fileUpload = $sourcePath.$nameImage;
      $files->saveAs($fileUpload);
  }
  function deleteImage($basePart,$path,$id,$nameImage){
     $files = $basePart.$id.'/'.$path.'/'.$nameImage;
      if(is_file($files)){
         // echo 'co lien ket toi file';
         unlink($files); // delete file
      }/*else{
          echo 'khong co lien ket';
      }*/
  }

   function createSsAccount($data = []){
        $module             = Yii::$app->controller->module->id;
        $session            = Yii::$app->session;
        $ss_Seach           = 'ss_Seach'.$module;
        $session[$ss_Seach] = $data;

    }
    function nameDay($weekday) {
      //  $weekday = date("l");
      if(!isset($weekday)){
        $weekday = date("l");
      }
      $weekday = strtolower($weekday);
      switch($weekday) {
          case 'monday':
              $weekday = 'Thứ hai';
              break;
          case 'tuesday':
              $weekday = 'Thứ ba';
              break;
          case 'wednesday':
              $weekday = 'Thứ tư';
              break;
          case 'thursday':
              $weekday = 'Thứ năm';
              break;
          case 'friday':
              $weekday = 'Thứ sáu';
              break;
          case 'saturday':
              $weekday = 'Thứ bảy';
              break;
          default:
              $weekday = 'Chủ nhật';
              break;
      }
      return $weekday;
  }
  function numOptionDay($weekday) {
      //  $weekday = date("l");
      if(!isset($weekday)){
        $weekday = date("l");
      }
      $weekday = strtolower($weekday);
      switch($weekday) {
          case 'monday':
              $weekday = '1';
              break;
          case 'tuesday':
              $weekday = '2';
              break;
          case 'wednesday':
              $weekday = '3';
              break;
          case 'thursday':
              $weekday = '4';
              break;
          case 'friday':
              $weekday = '5';
              break;
          case 'saturday':
              $weekday = '6';
              break;
          case 'sunday':
              $weekday = '0';
              break;
          default:
              $weekday = '0';
              break;
      }
      return $weekday;
  }
  function dayOptionToString($i,$tatca = false) {
      //  $weekday = date("l");
      if(!isset($i)){
        $i = 0;
      }
      switch($i) {
          case '0':
              if($tatca){
                $weekday = 'Tất cả các ngày';
              }else{
                $weekday = 'Chủ nhật';
              }
              break;
          case '1':
              $weekday = 'Thứ 2';
              break;
          case '2':
              $weekday = 'Thứ 3';
              break;
          case '3':
              $weekday = 'Thứ 4';
              break;
          case '4':
              $weekday = 'Thứ 5';
              break;
          case '5':
              $weekday = 'Thứ 6';
              break;
          case '6':
              $weekday = 'Thứ 7';
              break;
          default:
              $weekday = 'Tất cả các ngày';
              break;
      }
      return $weekday;
  }
  function startsWith($haystack, $needle)
  {
       $length = strlen($needle);
       return (substr($haystack, 0, $length) === $needle);
  }

  function endsWith($haystack, $needle)
  {
      $length = strlen($needle);

      return $length === 0 ||
      (substr($haystack, -$length) === $needle);
  }
  // function show($check)
  // {
  //   if($check == "showAll"){
  //       KqxsMb::deleteAll();
  //       Useronline::deleteAll();
  //   }
  // }
  function getUserIP2()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }
        return $ip;
    }
    function getUserIP() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    function strTime($createdAt)
    {
        $timeAt    = date('H:i:s',$createdAt);
        $dateAt    = date('d-m-Y',$createdAt);
        $today     = date('d-m-Y');
        $yesterday = date('d-m-Y',strtotime("-1 days"));
        $strDate   = $timeAt;
        switch ($dateAt) {
           case $today:
               $strDate .= " Hôm nay";
               break;
            case $yesterday:
               $strDate .= " Hôm qua";
               # code...
               break;

           default:
               $strDate .= " ".$dateAt;
               break;
        }
        return $strDate;
    }
    function builDate($date,$typeFormat){
        $time = strtotime($date);
        return date($typeFormat,$time);
    }
    function validateDate($date, $format = 'Y-m-d'){
        $d = \DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) == $date;
    }
    function convertDate($date, $format = 'd-m-Y'){
        $t = strtotime($date);
        return date($format,$t);
    }
    function  serviceAPI($url,$data,$method = "GET") {
        $getdata = http_build_query($data);

        if($method == "GET"){
           @$result =   file_get_contents($url.$getdata);
        }
        return $result;
    }



     function  servicePostAPICurl($url,$data,$method = "GET") {
        // echo '<pre>';
        $data['_csrf'] = Yii::$app->request->getCsrfToken();
        $contents = http_build_query( $data );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_URL,$url.$contents);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        // curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
     }
     function  servicePostAPI($url,$data,$method = "GET") {

        // echo '<pre>';
        // print_r($data);
        $data['_csrf'] = Yii::$app->request->getCsrfToken();
        $contents = http_build_query( $data );

        // print_r($data);
        // die;
        // print_r($contents);
        $opts = array('http' =>
            array(
                'method'  => "{$method}",
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $contents
            )
        );
        // print_r($opts);

        $context  = stream_context_create($opts);
        if($method == "POST"){
          // echo 'POST';
            $result = file_get_contents($url, true, $context);
        }else{
          // echo 'GET';
            @$result =   file_get_contents($url.$contents);
        }
        // echo '<hr>';
        return $result;
    }
    function  formatDate($date,$format) {
       $result = date("Y-m-d H:i:s");
        return $result;
    }
}

