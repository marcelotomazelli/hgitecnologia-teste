<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * @package Source\Models
 */
class User extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct('users', ['password_re'], ['first_name', 'last_name', 'email', 'birthdate', 'password']);
    }

    /**
     * @param string $firstName 
     * @param string $lastName 
     * @param string $email 
     * @param string $birthdate 
     * @param string $password 
     * @param string $passwordRe 
     * @return User
     */
    public function bootstrap(
        string $firstName,
        string $lastName,
        string $email,
        string $birthdate,
        string $password,
        string $passwordRe
    ): User
    {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->email = $email;
        $this->birthdate = $birthdate;
        $this->password = $password;
        $this->password_re = $passwordRe;
        return $this;
    }

    /**
     * @param string $email
     * @param string $columns
     * @return null|mixed|User
     */
    public function findByEmail(string $email, string $columns = '*'): ?User
    {
        return $this->find('email = :email', "email={$email}", $columns)->fetch();
    }

    /**
     * @return bool
     */
    public function register(): bool
    {
        if (!empty($this->id)) {
            $this->message->warning('Ocorreu erro inesperado. Tente novamente');
            return false;
        }

        if (!$this->required()) {
            $this->message->warning('Todos os campos devem ser preenchidos');
            return false;
        }

        if (!$this->check(true)) {
            return false;
        }

        if (!$this->save()) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function edit(bool $newPass = false): bool
    {
        if (empty($this->id)) {
            $this->message->warning('Ocorreu erro inesperado. Tente novamente');
            return false;
        }

        if (!$this->check($newPass)) {
            return false;
        }

        if (!$this->save()) {
            return false;
        }

        return true;
    }

    /**
     * @param bool $newPass 
     * @return bool 
     */
    protected function check(bool $newPass): bool
    {
        if (!empty($this->email)) {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->message->error('E-mail informado é inválido');
                return false;
            }


            if (empty($this->id)) {
                $email = (new User())
                    ->find('email = :email', "email={$this->email}", 'id')
                    ->fetch();
            } else {
                $email = (new User())
                    ->find(
                        'email = :email AND id != :id',
                        "email={$this->email}&id={$this->id}",
                        'id'
                    )
                    ->fetch();
            }

            if ($email) {
                $this->message->error('E-mail informado já está cadastrado');
                return false;
            }
        }

        if (!empty($this->birthdate)) {
            $birthdate = \DateTime::createFromFormat('Y-m-d', $this->birthdate);

            if ($this->birthdate >= date('Y-m-d')) {
                $this->message->error('Data de nascimento inválida');
                return false;
            }

            if ($this->birthdate > date('Y-m-d', strtotime('-18years'))) {
                $this->message->error('A idade mínima para utilizar a plaforma é 18 anos');
                return false;
            }

            if ($this->birthdate < date('Y-m-d', strtotime('-100years'))) {
                $this->message->error('A idade informada ultrapassa 100 anos, confira se digitou corretamente');
                return false;
            }
        }

        if (!empty($this->password) && $newPass) {
            if (!is_passwd($this->password) || !empty(password_get_info($this->password)['algo'])) {
                $this->message->warning('A senha informada é inválida');
                return false;
            }

            if (empty($this->password_re)) {
                $this->message->error('Para alterar a senha é necessário confirmação');
                return false;
            }

            if ($this->password != $this->password_re) {
                $this->message->warning('As senhas informadas devem ser iguais');
                return false;
            }

            $this->password = password_hash($this->password, CONF_PASSWORD_ALGO, CONF_PASSWORD_OPTION);
        }
        
        return true;
    }
}
