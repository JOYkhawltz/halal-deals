<?php

namespace Modules\Admin\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends Mailable {

    use Queueable,
        SerializesModels;

    public $model;
    public $new_password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($model, $new_password) {
        $this->model = $model;
        $this->new_password = $new_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('admin::mail.forgot_password');
    }

}
