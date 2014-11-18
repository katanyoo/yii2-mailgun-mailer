<?php

namespace katanyoo\mailer;

use yii\mail\BaseMessage;

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
	/**
	 * @inheritdoc
	 */
	public function getFrom()
	{
	    return $this->from;
	}

	/**
	 * @inheritdoc
	 */
	public function setFrom($from)
	{
	    $this->from = $from;

	    return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getTo()
	{
	    return $this->to;
	}

	/**
	 * @inheritdoc
	 */
	public function setTo($to)
	{
	    $this->to = $to;

	    return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getSubject()
	{
	    return $this->subject;
	}

	/**
	 * @inheritdoc
	 */
	public function setSubject($subject)
	{
	    $this->subject = $subject;

	    return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function setTextBody($text)
	{
	    $this->textBody = $text;

	    return $this;
	}
}