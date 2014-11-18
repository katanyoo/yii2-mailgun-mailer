<?php

namespace katanyoo\mailer;

use Yii;
use yii\base\InvalidConfigException;
use yii\mail\BaseMailer;

use Mailgun\Mailgun;
/**
 * Mailer implements a mailer based on Mailgun.
 *
 * To use Mailer, you should configure it in the application configuration like the following,
 *
 * ~~~
 * 'components' => [
 *     ...
 *     'mailer' => [
 *         'class' => 'katanyoo\mailer\Mailer',
 *         'domain' => 'example.com',
 *         'key' => 'key-somekey',
 *         'tags' => ['yii'],
 *         'enableTracking' => false,
 *     ],
 *     ...
 * ],
 * ~~~
 */
class Mailer extends BaseMailer
{

	/**
	 * [$messageClass description]
	 * @var string message default class name.
	 */
	//public $messageClass = 'katanyoo\mailer\Message';

	public $domain;
	public $key;

	public $fromAddress;
	public $fromName;
	public $tags = [];
	public $campaignId;
	public $enableDkim;
	public $enableTestMode;
	public $enableTracking;
	public $clicksTrackingMode; // true, false, "html"
	public $enableOpensTracking;

	public $viewPath = '@app/views/mail';

	private $_mailgunMailer;

	/**
	 * @return Mailgun Mailgun mailer instance.
	 */
	public function getMailgunMailer()
	{
		if (!is_object($this->_mailgunMailer)) {
		    $this->_mailgunMailer = $this->createMailgunMailer();
		}

		return $this->_mailgunMailer;
	}

	/**
	 * @inheritdoc
	 */
	protected function sendMessage($message)
	{
		$messageBldr = $this->getMailgunMailer()->MessageBuilder();

		#Define the from address.
		$messageBldr->setFromAddress($message->getFrom());
		#Define a to recipient.
		$messageBldr->addToRecipient($message->getTo());
		#Define the subject.
		$messageBldr->setSubject($message->getSubject());
		#Define the body of the message.
		$messageBldr->setTextBody($message->getTextBody());

		$messageBldr->setClickTracking($this->clicksTrackingMode);

		$response = $this->getMailgunMailer()->post(
			"{$this->domain}/messages", 
			$messageBldr->getMessage(), 
			$messageBldr->getFiles()
			);

		Yii::info('Sending email "'.$messageBldr->getSubject().'" to "'.$messageBldr->getTo(), __METHOD__);
		Yii::info('Response : '.print_r($response, true), __METHOD__);

		return true;
	}

	/**
	 * Creates Mailgun mailer instance.
	 * @return Mailgun mailer instance.
	 */
	protected function createMailgunMailer()
	{
		$mg = new Mailgun($this->key);
		return $mg;
	}
}
