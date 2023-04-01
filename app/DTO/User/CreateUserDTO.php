<?php
namespace App\DTO\User;
use App\Http\Requests\CreateUserEnounRequest;
class CreateUserDTO {
    public function __construct(
        public string $nome,
        public string $email,
        public string $password,
    )
    {}
    public static function makeFromRequest(CreateUserEnounRequest $request) : self
    {
        return new self(
            $request->nome,
            $request->email,
            $request->password,
        );
    }
}