<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class UsersAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport // passport permet de gerer l'authentification des users
    {
        $email = $request->request->get('email', ''); // pour recuprer l'email qui a été saisie par l'utilisateur

        $request->getSession()->set(Security::LAST_USERNAME, $email); // dans la session on insert le dernier utilisateur qui été saisie 

        return new Passport
        (
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')), // pour recuprer le mot de passe qu a ete cree
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),// csrf_token jeton de securité pour permettre de verifier que nottre formulaire vient de notre site.
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName))// retourner sur la page sur laquelle etait l'utilisateur
        {
            return new RedirectResponse($targetPath);
        }

        // For example:
        return new RedirectResponse($this->urlGenerator->generate('app_main')); // cela va rediriger l'utilisateur vers sur la page main
        //throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl(Request $request): string //qui va nous permettre d'avoir l'url par rapport a cette route 
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
