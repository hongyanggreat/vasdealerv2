<?php 

namespace backend\components;
use Yii;
use yii\web\Controller;

class PhoneNumber 
{
    function start_with($needle, $haystack) {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
    function detect_number ($number) {
        $number = str_replace(array('-', '.', ' '), '', $number);
        // $number is not a phone number
        // if (!preg_match('/^(01[2689]|09)[0-9]{8}$/', $number)) return false;
        if (!preg_match('/^(01[2689]|09)[0-9]{8}|(841[2689]|849)[0-9]{8}$/', $number)) return false;

        // Store all start number in an array to search
        $carriers_number = PhoneNumber::carriers();
        $start_numbers = array_keys($carriers_number);
        

           //echo $number .'<br>';
        foreach ($start_numbers as $start_number) {
           //echo $start_number.'<br>';
          // echo PhoneNumber::start_with($start_number, $number);
            // if $start number found in $number then return value of $carriers_number array as carrier name
            if (PhoneNumber::start_with($start_number, $number)) {
               return $carriers_number[$start_number];
            }
        }

        // if not found, return false
        return false;
    }


    function carriers(){
        return $carriers_number = [

            '086'  =>'Viettel',
            '096'  =>'Viettel',
            '097'  =>'Viettel',
            '098'  =>'Viettel',
            '0161' =>'Viettel',
            '0162' =>'Viettel',
            '0163' =>'Viettel',
            '0164' =>'Viettel',
            '0165' =>'Viettel',
            '0166' =>'Viettel',
            '0167' =>'Viettel',
            '0168' =>'Viettel',
            '0169' =>'Viettel',
            
            '089'  =>'Mobifone',
            '090'  =>'Mobifone',
            '093'  =>'Mobifone',
            '0120' =>'Mobifone',
            '0121' =>'Mobifone',
            '0122' =>'Mobifone',
            '0126' =>'Mobifone',
            '0128' =>'Mobifone',
            
            '088'  =>'Vinaphone',
            '091'  =>'Vinaphone',
            '094'  =>'Vinaphone',
            '0123' =>'Vinaphone',
            '0125' =>'Vinaphone',
            '0127' =>'Vinaphone',
            '0129' =>'Vinaphone',
            '0124' =>'Vinaphone',
            
            '0993' => 'Gmobile',
            '0994' => 'Gmobile',
            '0995' => 'Gmobile',
            '0996' => 'Gmobile',
            '0997' => 'Gmobile',
            '0199' => 'Gmobile',
            
            '092'  => 'Vietnamobile',
            '0186' => 'Vietnamobile',
            '0188' => 'Vietnamobile',
            

            '095'  =>'SFone',
        ];
    }
    public static function detect_phone_vina ($number) {

        $number =  PhoneNumber::PhoneTo84($number);
        if (!preg_match('/^(01[2689]|09)[0-9]{8}|(841[2689]|849)[0-9]{8}$/', $number)) return false;
        $carriers_number = PhoneNumber::carriersVina();
        $start_numbers = array_keys($carriers_number);
        // echo '<pre>';
        // print_r($start_numbers);
        // die;
        foreach ($start_numbers as $start_number) {

            if (PhoneNumber::start_with((String) $start_number, (String) $number)) {
               return true;
            }
        }
        return false;
    }
    function startsWith($haystack, $needle)
    {
         $length = strlen($needle);
         return (substr($haystack, 0, $length) === $needle);
    }

    public static function PhoneTo84($number) {
        if ($number == null) {
            $number = "";
            return $number;
        }
        $number = str_replace(array("o"), "0", $number);
        $number = str_replace(array('-', '.', ' '), '', $number);
        // PhoneNumber::startsWith($number,"84");
        if (PhoneNumber::startsWith($number,"84")) {
            return $number;
        } else if (PhoneNumber::startsWith($number,"0")) {
            $number = "84" . substr($number, 1);
        } else if (PhoneNumber::startsWith($number,"+84")) {
            $number = substr($number,1);
        } else {
            $number = "84" . $number;
        }
        return $number;
    }
    function carriersVina(){
        return $carriers_number = [

            '8488'  => 'Vinaphone',
            '8491'  => 'Vinaphone',
            '8494'  => 'Vinaphone',
            '84123' => 'Vinaphone',
            '84125' => 'Vinaphone',
            '84127' => 'Vinaphone',
            '84129' => 'Vinaphone',
            '84124' => 'Vinaphone',
            
        ];
    }
  
}