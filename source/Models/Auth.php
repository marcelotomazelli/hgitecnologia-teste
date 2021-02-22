<?php

namespace Source\Models;

use Source\Support\Message;

use Source\Core\Session;
use Source\Models\User;

class Auth
{
    /** @var Message */
    protected $message;

    /**
     * Auth constructor.
     */
    public function __construct()
    {
        $this->message = new Message();
    }

    /**
     * @return Message
     */
    public function message(): Message
    {
        return $this->message;
    }

    /**
     * @param string $columns 
     * @return User|null
     */
    public static function user(string $columns = '*'): ?User
    {
        $session = new Session();

        if (!self::logged()) {
            return null;
        }

        return (new User())->findById($session->authUser, $columns);
    }

    /**
     * @return bool 
     */
    public static function logged(): bool
    {
        return (new Session())->has('authUser');
    }

    /**
     * @param string $firstName 
     * @param string $lastName 
     * @param string $email 
     * @param string $birthdate 
     * @param string $password 
     * @param string $passwordRe 
     * @return bool
     */
    public function register(
        string $firstName,
        string $lastName,
        string $email,
        string $birthdate,
        string $password,
        string $passwordRe
    ): bool
    {
        $user = (new User())->bootstrap(
            $firstName,
            $lastName,
            $email,
            $birthdate,
            $password,
            $passwordRe
        );

        if (!$user->register()) {
            $this->message = $user->message();
            return false;
        }

        return true;
    }

    /**
     * @param string $email 
     * @param string $password 
     * @return bool
     */
    public function login(string $email, string $password): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->message->warning('E-mail informado é inválido');
            return false;
        }

        if (!is_passwd($password)) {
            $this->message->warning('Senha informada é inválida');
            return false;
        }

        $user = (new User())->findByEmail($email, 'id, password');

        if (!$user) {
            $this->message->error('E-mail informado não está cadastrado');
            return false;
        }

        if (!password_verify($password, $user->password)) {
            $this->message->error('Senha incorreta');
            return false;
        }

        (new Session())->set('authUser', $user->id);

        if (password_needs_rehash($user->password, CONF_PASSWORD_ALGO, CONF_PASSWORD_OPTION)) {
            $user->password = $password;
            $user->password_re = $password;
            $user->edit(true);
        }

        return true;
    }

    /**
     * @return bool 
     */
    public static function logout(): bool
    {
        (new Session())->unset('authUser');
        return true;
    }
}
