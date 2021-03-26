<?php

namespace Modules\Admin\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactReply extends Mailable {

    use Queueable,
        SerializesModels;

    public $model;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($model) {
        $this->model = $model;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('admin::mail.contact_reply');
    }

}
