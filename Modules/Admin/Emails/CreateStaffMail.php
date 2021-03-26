<?php

namespace Modules\Admin\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateStaffMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $model;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($model, $password) {
        $this->model = $model;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('admin::mail.create_staff');
    }

}
