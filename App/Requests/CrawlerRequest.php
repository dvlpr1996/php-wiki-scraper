<?php

namespace app\Requests;

use app\Core\interfaces\ValidatorInterface;

class CrawlerRequest implements ValidatorInterface
{
	public function validateRules(): array
	{
		return [
			'input' => 'required|alpha_num|min:1|',
		];
	}
}
