<?php

namespace katanyoo\mailgunmailer;

use yii\mail\BaseMessage;
use Mailgun\Messages\MessageBuilder;

require_once __DIR__.'/../../mailgun/mailgun-php/src/Mailgun/Constants/Constants.php';

/**
 * Message implements a message class based on Mailgun.
 *
 *
 * @method Mailer getMailer() returns mailer instance.
 *
 *
 * @author Katanyoo Ubalee <ublee.k@gmail.com>
 */
class Message extends BaseMessage
{

/*	protected $bcc;
	protected $cc;
	protected $charset;
	protected $from;
	protected $htmlBody;
	protected $replyTo;
	protected $subject;
	protected $textBody;
	protected $to;*/

	/**
	 * @var \Mailgun\Messages\MessageBuilder Mailgun message instance.
	 */
	private $_messageBuilder;

	/**
	 * @return \Swift_Message Swift message instance.
	 */
	public function getMessageBuilder()
	{
		if (!is_object($this->_messageBuilder)) {
			$this->_messageBuilder = $this->createMessageBuilder();
		}

		return $this->_messageBuilder;
	}

	/**
	 * @inheritdoc
	 */
	public function getCharset()
	{
		return 'utf-8';
	}

	/**
	 * @inheritdoc
	 */
	public function setCharset($charset)
	{
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getFrom()
	{
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function setFrom($from)
	{
		$this->getMessageBuilder()->setFromAddress($from);

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getReplyTo()
	{
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function setReplyTo($replyTo)
	{
		$this->getMessageBuilder()->setReplyToAddress($replyTo);

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getTo()
	{
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function setTo($to)
	{
		$this->getMessageBuilder()->addToRecipient($to);

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getCc()
	{
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function setCc($cc)
	{
		$this->getMessageBuilder()->addCcRecipient($cc);

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getBcc()
	{
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function setBcc($bcc)
	{
		$this->getMessageBuilder()->addBccRecipient($bcc);

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getSubject()
	{
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function setSubject($subject)
	{
		$this->getMessageBuilder()->setSubject($subject);

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function setTextBody($text)
	{
		$this->getMessageBuilder()->setTextBody($text);

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function setHtmlBody($html)
	{
		$this->getMessageBuilder()->setHtmlBody($html);

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function attach($fileName, array $options = [])
	{
		$this->getMessageBuilder()->addAttachment($fileName);
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function attachContent($content, array $options = [])
	{
		$this->getMessageBuilder()->addAttachment($content);
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function embed($fileName, array $options = [])
	{
		//$this->getMessageBuilder()->addAttachment($fileName);
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function embedContent($content, array $options = [])
	{
		//$this->getMessageBuilder()->addAttachment($fileName);
		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function toString()
	{
		return "mailgun_tostring()_method";
	}

	public function addTags($tags)
	{
		foreach ($tags as $tag) {
			$this->getMessageBuilder()->addTag($tag);
		}
		return $this;
	}

	/**
	 * Set click tracking
	 * @param Boolean|String $enabled true, false, "html"
	 */
	public function setClickTracking($enabled)
	{
		$this->getMessageBuilder()->setClickTracking($enabled);
		return $this;
	}

	/**
	 * @return Array message object
	 */
	public function getMessage()
	{
		return $this->getMessageBuilder()->getMessage();
	}

	/**
	 * @return Array files list
	 */
	public function getFiles()
	{
		return $this->getMessageBuilder()->getFiles();
	}

	/**
	 * Creates the Mailgun email message instance.
	 * @return \MessageBldr email message instance.
	 */
	protected function createMessageBuilder()
	{
		return new MessageBuilder();
	}
}