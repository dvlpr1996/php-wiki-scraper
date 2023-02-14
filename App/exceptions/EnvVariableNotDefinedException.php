<?PHP

namespace app\exceptions;

use Exception;

class EnvVariableNotDefinedException extends Exception
{
	public function __construct(string $message, int $statusCode = 500, $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);
    }

    public function String()
    {
        return ": [{$this->code}]: {$this->file}";
    }
}
