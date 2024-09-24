<?PHP

namespace app\exceptions;

use Exception;

class ViewDoesNotExistException extends Exception
{
    public function __construct(string $message, int $statusCode = 500, $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);
    }

    public function __toString():string
    {
        return "[ Error code : {$this->code} ]: {$this->message}";
    }
}
