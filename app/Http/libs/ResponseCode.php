<?php

namespace App\Http\libs;

class ResponseCode {

    #2xx
    const SUCCESS = '200';
    const UNSUCCESS = '201';

    #21x: khai bao cho VtFlow
    const ACCESS_TOKEN_INVALID = '230';
    const ACCESS_TOKEN_EXPIRED = '231';
    const REFRESH_TOKEN_INVALID = '232';
    const REFRESH_TOKEN_EXPIRED = '232';

    #4xx
    const UNAUTHORIZED = '401';
    const FORBIDDEN = '403';
    const NOT_FOUND = '404';
    const LOGIN_FAIL = '410';

    const INVALID_OLD_PASSWORD = '411';
    const INVALID_NEW_PASSWORD = '412';
    const INVALID_MAP_PASSWORD = '413';
    const INVALID_MAP_NEW_PASSWORD = '414';

    const EMPTY_MSISDN = '440';
    const NOT_MEMBER = '444';


    #5xx
    const SYSTEM_ERROR = '500';

    #8x

    const CAPTCHA_EMPTY = '800';
    const CAPTCHA_INVALID = '808';
    const LOCK_USER = '888';

    #9xx
    // user chua dang ky
    const USER_UNREGISTERED = 900;
    //user bi ha xuong
    const USER_INACTIVE = 909;

    public static function getMessage($errorCode) {
        $mess = [
            self::SUCCESS => __( 'Thành công'),
            self::UNSUCCESS => __( 'Thất bại'),

            self::UNAUTHORIZED => __( 'Mã xác thực không hợp lệ'),
            self::LOGIN_FAIL => __( 'Đăng nhập không thành công, số điện thoại hoặc mật khẩu không hợp lệ'),

            self::INVALID_OLD_PASSWORD => __( 'Mật khẩu cũ không hợp lệ'),
            self::INVALID_NEW_PASSWORD => __( 'Mật khẩu mới không hợp lệ. Độ dài mật khẩu từ 6 đến 128 ký tự'),
            self::INVALID_MAP_PASSWORD => __( '2 mật khẩu mới không giống nhau'),
            self::INVALID_MAP_NEW_PASSWORD => __( 'Mật khẩu mới không được trùng mật khẩu cũ'),

            self::FORBIDDEN => __( 'Xác thực không thành công'),
            self::NOT_FOUND => __( 'Đối tượng không tồn tại hoặc chưa được phê duyệt'),

            self::SYSTEM_ERROR => __( 'Lỗi hệ thống'),

        ];
        if ($mess[$errorCode]) {
            return $mess[$errorCode];
        }
        return '';
    }

}
