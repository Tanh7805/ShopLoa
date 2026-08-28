<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('Mã OTP xác thực tài khoản - Loa Bluetooth Shop')
                    ->html("
                        <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4;'>
                            <h2 style='color: #2c3e50;'>Xác thực đăng ký tài khoản</h2>
                            <p>Cảm ơn bạn đã đăng ký tài khoản tại Loa Bluetooth Shop.</p>
                            <p>Mã OTP của bạn là:</p>
                            <h1 style='color: #e74c3c; letter-spacing: 5px;'>{$this->otp}</h1>
                            <p>Mã này có hiệu lực trong vòng <b>10 phút</b>. Vui lòng không chia sẻ mã này với bất kỳ ai.</p>
                        </div>
                    ");
    }
}