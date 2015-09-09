<?php

namespace farmani\mailgunmailer;

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
 *         'class' => 'farmani\mailer\Mailer',
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
	public $messageClass = 'farmani\mailgunmailer\Message';

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
		$mailer = $this->getMailgunMailer();


		$message->setClickTracking($this->clicksTrackingMode)
		->addTags($this->tags);

		Yii::info('Sending email', __METHOD__);
		$response = $this->getMailgunMailer()->post(
			"{$this->domain}/messages", 
			$message->getMessage(), 
			$message->getFiles()
			);

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
