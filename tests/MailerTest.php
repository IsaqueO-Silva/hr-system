<?php

use PHPUnit\Framework\TestCase;
use Isaque\Mailer;

class MailerTest extends TestCase {

    public function testEmailSendingToUser() {

        /* Dont forgot to set an username and password in the Mailer class */
        $mailer = new Mailer('mockmail@gmail.com', 'john doe', array(
            'name'  => 'john doe',
            'link'  => 'test'
        ));

        $this->assertEquals(NULL, $mailer->send());
    }
}
?>