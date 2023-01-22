<?php

namespace Http;

class Response
{
	protected mixed $content;
	protected int $status;

	public function __construct(mixed $content, int $status = 200)
	{
		$this->setContent($content);
		$this->setStatus($status);
	}

	public function setContent(mixed $content)
	{
		$this->content = $content;

		return $this;
	}

	public function setStatus(int $status = 200)
	{
		$this->status = $status;

		return $this;
	}

	public function getContent(): mixed
	{
		return $this->content;
	}

	public function getStatus(): int
	{
		return $this->status;
	}
}