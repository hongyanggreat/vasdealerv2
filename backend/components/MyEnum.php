<?php 
namespace backend\components;
use Yii;
use yii\web\Controller;

class MyEnum 
{
	//CHECK SUBJECT

    public static function synActs($key = ""){
        $status = [
            "SUBSCRIPT_SUCCESS" => 'Thuê bao nhắn tin xác nhận đồng ý và đăng ký thành công',
            "REG"               => 'Đăng ký dịch vụ',
            "UNREG"             => 'Hủy dịch vụ',
            "REFUSED"           => 'Thuê bao nhắn tin từ chối',
            "SUBSCRIPT_FAIL"    => 'Thuê bao nhắn tin xác nhận đồng ý đăng ký nhưng việc đăng ký không thành công ',
            "RENEW"             => 'Gia hạn dịch vụ',
            "EXPIRED"           => 'Giao dịch quá thời gian quy định nhưng thuê bao không nhắn tin Y hoặc N',
            
          ];  
        if($key == "" || !isset($status[$key])){
            return $status; 
        }else{
            return $status[$key];
        }
    }
    public static function subscribeStatus(){
        $status = [
            "-1"  => 'Tất cả',
            "1" => 'Đang sử dụng dịch vụ', 
            "0" => 'Không sử dụng hoặc đã hủy',
            "2" => 'Không tồn tại',
            "3" => 'Không lấy được thông tin',
          ];  
        return $status; 
    }
    public static function errorSubscribeStatus($code = 0){
        
        $status = MyEnum::subscribeStatus();
        switch ($code) {
            case 0:
                $rs =  [
                    'classStatus' =>"has-warning",
                    'btnStatus'   =>"btn-warning",
                    'iconStatus'  =>"fa-bell-o",
                    'textStatus'  =>$status["{$code}"],
                ];
             break;
             case 1:
                $rs =  [
                    'classStatus' =>"has-success",
                    'btnStatus'   =>"btn-success",
                    'iconStatus'  =>"fa-check",
                    'textStatus'  =>$status["{$code}"],
                ];
             break;
            case 2:
                $rs =  [
                     'classStatus'=>"has-info",
                     'btnStatus'=>"btn-info",
                     'iconStatus'=>"fa-bell-o",
                     'textStatus'=>$status["{$code}"],
                ];
             break;
             case 3:
                $rs =  [
                     'classStatus'=>"has-error",
                     'btnStatus'=>"btn-danger",
                     'iconStatus'=>"fa-bell-o",
                     'textStatus'=>$status["{$code}"],
                ];
             break;
            
            default:
              $rs =  [
                     'classStatus'=>"has-error",
                     'btnStatus'=>"btn-danger",
                     'iconStatus'=>"fa-bell-o",
                     'textStatus'=>$status["{$code}"],
                ];
              break;
          }
        return $rs;
    }
     public static function dealerStatus(){
        $status = [
            ""  => 'Tất cả',
            "1" => 'Hoạt động', 
            "0" => 'Không hoạt động',
            "2" => 'Từ chối',
            "3" => 'Khóa',
            "4" => 'Xóa',
            "5" => 'Chờ đồng bộ',
          ];  
        return $status; 
    }
	public static function errorDealerStatus($code = 0){
        
        $status = MyEnum::dealerStatus();
        switch ($code) {
            case 0:
                $rs =  [
                    'classStatus' =>"has-warning",
                    'btnStatus'   =>"btn-warning",
                    'iconStatus'  =>"fa-bell-o",
                    'textStatus'  =>$status["{$code}"],
                ];
             break;
             case 1:
                $rs =  [
                    'classStatus' =>"has-success",
                    'btnStatus'   =>"btn-success",
                    'iconStatus'  =>"fa-check",
                    'textStatus'  =>$status["{$code}"],
                ];
             break;
            case 2:
                $rs =  [
                     'classStatus'=>"has-info",
                     'btnStatus'=>"btn-info",
                     'iconStatus'=>"fa-bell-o",
                     'textStatus'=>$status["{$code}"],
                ];
             break;
             case 3:
                $rs =  [
                     'classStatus'=>"has-error",
                     'btnStatus'=>"btn-danger",
                     'iconStatus'=>"fa-bell-o",
                     'textStatus'=>$status["{$code}"],
                ];
             break;
              case 4:
                $rs =  [
                     'classStatus'=>"has-error",
                     'btnStatus'=>"btn-danger",
                     'iconStatus'=>"fa-bell-o",
                     'textStatus'=>$status["{$code}"],
                ];
             break;
             case 5:
                $rs =  [
                     'classStatus'=>"has-error",
                     'btnStatus'=>"btn-danger",
                     'iconStatus'=>"fa-bell-o",
                     'textStatus'=>$status["{$code}"],
                ];
             break;
            
            default:
              $rs =  [
                     'classStatus'=>"has-error",
                     'btnStatus'=>"btn-danger",
                     'iconStatus'=>"fa-bell-o",
                     'textStatus'=>$status["{$code}"],
                ];
              break;
          }
    	return $rs;
    }
    
    public static function errorCode(){
        $status = [
           "501"  => "CheckSum không đúng",
           "502"  => "Tham số truyền vào không hợp lệ",
           "503"  => "Đại lý không tồn tại",
           "504"  => "Đại lý đang bị khóa",
           "505"  => "Không lấy được thông tin",
           "506"  => "Địa chỉ IP không hợp lệ",
           "11"   => "Đại lý đã được khởi tạo trên hệ thống Vasdealer",
           "101"  => "Tài khoản không hợp lệ",
           "13"   => "Mã gói cước/ dịch vụ không tồn tại",
           "15"   => "Đại lý đã được khởi tạo",
           "30"   => "Số lượng thuê bao được phép đăng ký trong ngày đạt mức tối đa (100)",
           "31"   => "Số lượng dịch vụ được phép đăng ký trong ngày đạt mức tối đa (200)",
           "22"   => "Đại lý đang bị khóa",
           "8"    => "Thời gian giữa 2 lần đăng ký dịch vụ nhỏ hơn thời gian quy định (1 phút)",
           "999"  => "Lỗi hệ thống",
           "301"  => "Lỗi Authentication",
           "302"  => "Lỗi thời gian request của Agent&Sale Management Platform không đồng bộ với thời gian server VasDealer core",
           "200"  => "Lỗi các Module của hệ thống VinaPhone",
           "202"  => "Giao dịch không hợp lệ  do Agent hiện đang tạm khóa",
           "203"  => "Giao dịch không hợp lệ do đã có lời mời với thuê bao/dịch vụ nhưng thuê bao đã từ chối/ chưa xác nhận",
           "204"  => "Giao dịch không hợp lệ do Agent đã mời quá số lượng cho phép nhưng thuê bao chưa xác nhận",
           "205"  => "Giao dịch không hợp lệ do thuê bao đã đăng ký (chưa hủy trong VasDealerCore)",
           "206"  => "Giao dịch không hợp lệ do Agent request nhỏ hơn thời gian được phép (default 5s)",
           "207"  => "Giao dịch không hợp lệ do không có thông tin lịch sử thuê bao",
           "208"  => "Giao dịch không hợp lệ do ngày hủy thuê bao chưa quá 90 ngày",
           "209"  => "Giao dịch không hợp lệ do thuê bao đang đăng ký dịch vụ(chưa hủy phía nhà cung cấp dịch vụ)",
           "2010" => "Giao dịch không hợp lệ  do thông tin thuê bao không hợp lệ (Không xác định được trạng thái hiện tại của thuê bao)",
           "2011" => "Giao dịch không hợp lệ do lỗi kiểm tra số dư tài khoản của thuê bao",
           "2012" => "Giao dịch không hợp lệ do số dư tài khoản không đủ để đăng ký dịch vụ",
           "2013" => "Giao dịch không hợp lệ do thuê bao đang Active dịch vụ",
           "2014" => "Quá trình đăng ký bị timeout, hệ thống VasDealerCore sẽ tiến hành retry kiểm tra lại xem đã thành công hay chưa và đồng bộ lại thông tin về Platform",
           "2015" => "Quá trình đăng ký Không thành công do lỗi nội tại của CP, cụ thể xem thêm thông tin ở description",
           "2016" => "Quá trình mua bài hát không thành công do lỗi nội tại của hệ thống Fundial",
           "1"    => "Thành công",
           "#"    => "Lỗi khác",
           

          ];  
        return $status; 
    }
    public static function errorCodeStatus($code = "#"){
       
       $errorCode = MyEnum::errorCode();
          // return $errorCode[$code];
       if(isset($errorCode[$code])){
          return $errorCode[$code];
       }else{
          return $errorCode["#"];
       }
    } 
}

