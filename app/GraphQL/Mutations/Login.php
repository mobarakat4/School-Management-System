<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\DTO\LoginDTO;
use App\Services\Auth\AuthService;

final  class Login
{
    /** @param  array{}  $args */
    private $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    public function __invoke(null $_, array $args)
    {
        // TODO implement the resolver
        $dto = new LoginDTO($args['email'],$args['password']);
        $data = $this->authService->login($dto);
        return $data;
    }
}
