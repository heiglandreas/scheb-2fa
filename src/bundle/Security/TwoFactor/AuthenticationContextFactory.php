<?php

declare(strict_types=1);

namespace Scheb\TwoFactorBundle\Security\TwoFactor;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

/**
 * @final
 */
class AuthenticationContextFactory implements AuthenticationContextFactoryInterface
{
    public function __construct(private string $authenticationContextClass)
    {
    }

    public function create(Request $request, TokenInterface $token, Passport $passport, string $firewallName): AuthenticationContextInterface
    {
        /**
         * @psalm-suppress InvalidStringClass
         *
         * @var AuthenticationContextInterface $authenticationContext
         */
        $authenticationContext = new $this->authenticationContextClass($request, $token, $passport, $firewallName);

        return $authenticationContext;
    }
}
