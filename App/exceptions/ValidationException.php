<?PHP

declare(strict_types=1);

namespace app\exceptions;

use Exception;

class ValidationException extends Exception
{
    private int $statusCode = 422;

    public function __construct(string|array $message, $previous = null)
    {
        $message = !is_string($message) ? implode(', ', $message) : $message;
        parent::__construct($message, $this->statusCode, $previous);
    }

    public function __toString(): string
    {
        return "[ Error code : {$this->code} ]: {$this->message}";
    }
}
