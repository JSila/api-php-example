<?php namespace App\Http;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

trait RespondsTrait {

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->statusCode, $headers);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message
            ]
        ]);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this
            ->setStatusCode(SymfonyResponse::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondForbidden($message = 'Forbidden')
    {
        return $this
            ->setStatusCode(SymfonyResponse::HTTP_FORBIDDEN)
            ->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondUnprocessableEntity($message = 'Unprocessable Entity')
    {
        return $this
            ->setStatusCode(SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondCreated($message = 'Created')
    {
        return $this
            ->setStatusCode(SymfonyResponse::HTTP_CREATED)
            ->respond([
                'message' => $message
            ]);
    }
}