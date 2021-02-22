<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Core\Session;

use Source\Models\Auth;

class WebController extends Controller
{
    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../themes/' . CONF_VIEW_WEB . '/');
    }

    /**
     * WEB HOME
     */
    public function home(): void
    {
        $this->template('home');
    }

    /**
     * @param array|null $data 
     */
    public function register(?array $data): void
    {
        if (Auth::logged()) {
            $this->redirect('/');
            return;
        }

        $this->template('register');

        if (!empty($data['csrf'])) {
            $data = $this->filterData($data);
            $this->data['data'] = (object) $data;

            $expected = ['firstName', 'lastName', 'email', 'birthdate', 'password', 'passwordRe'];

            if (!$this->validateRequest(true, $data, $expected)) {
                return;
            }

            $date = \DateTime::createFromFormat('d/m/Y', $data['birthdate']);

            $auth = new Auth;
            $register = $auth->register(
                $data['firstName'],
                $data['lastName'],
                $data['email'],
                ($date ? $date->format('Y-m-d') : null),
                $data['password'],
                $data['passwordRe']
            );

            if (!$register) {
                $this->message = $auth->message();
                return;
            }

            $this->message->text("{$data['firstName']} {$data['lastName']}")->flash();
            $this->redirect('/bem-vindo');
        }
    }

    /**
     * @param array|null $data 
     */
    public function login(?array $data): void
    {
        if (Auth::logged()) {
            $this->redirect('/');
            return;
        }

        $this->template('login');

        if (!empty($data['csrf'])) {
            $data = $this->filterData($data);
            $this->data['data'] = (object) $data;

            if (!$this->validateRequest(true, $data, ['email', 'password'])) {
                return;
            }

            $auth = new Auth;

            if (!$auth->login($data['email'], $data['password'])) {
                $this->message = $auth->message();
                return;
            }

            $this->redirect('/');
        }
    }

    /**
     * WEB LOGOUT
     */
    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/');
    }
    
    /**
     * @param array|null $data 
     */
    public function profile(?array $data): void
    {
        if (!Auth::logged()) {
            $this->message->warning('Efetue login para acessar seu perfil')->flash();
            $this->redirect('/login');
            return;
        }

        $this->template('profile');

        $user = Auth::user();

        if (!$user) {
            $this->redirect('/erro/problemas');
            return;
        }

        $user->birthdate = \DateTime::createFromFormat('Y-m-d', $user->birthdate)->format('dmY');
        $user->registered_at = (new \DateTime($user->created_at))->format('d/m/Y');
        $this->data['user'] = $user;

        if (!empty($data['csrf'])) {
            $data = $this->filterData($data);
            $expected = ['firstName', 'lastName', 'email', 'birthdate'];

            if (!$this->validateRequest(true, $data, $expected)) {
                return;
            }

            $date = \DateTime::createFromFormat('d/m/Y', $data['birthdate']);

            $edit = Auth::user();

            if (!$edit) {
                $this->redirect('/erro/problemas');
                return;
            }

            $edit->first_name = $data['firstName'];
            $edit->last_name = $data['lastName'];
            $edit->email = $data['email'];
            $edit->birthdate = ($date ? $date->format('Y-m-d') : null);

            if (!$edit->edit()) {
                $this->message = $edit->message();
                return;
            }

            $this->message->text("{$edit->first_name}")->flash();
            $this->redirect('/dados-atualizados');
        }
    }
    
    /**
     * WEB OPTION WELCOME
     */
    public function welcome(): void
    {
        $flash = (new Session())->flash();

        if (!$flash) {
            $this->redirect('/');
            return;
        }

        $this->data['title'] = "Bem-vindo(a) {$flash->text()}";
        $this->data['image'] = theme('/assets/img/welcome.png');
        $this->data['description'] = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat atque fugit, nulla quibusdam commodi laborum omnis libero excepturi distinctio. Minima vitae ullam corrupti id fugiat ut obcaecati molestias, voluptas facere!';
        $this->data['actionLink'] = url('/login');
        $this->data['actionDesc'] = 'Fazer login';

        $this->template('optin');
    }

    /**
     * WEB OPTION UPDATED
     */
    public function updated(): void
    {
        $flash = (new Session())->flash();

        if (!$flash) {
            $this->redirect('/');
            return;
        }

        $this->data['title'] = "Seus dados foram atualizados com sucesso {$flash->text()} :)";
        $this->data['image'] = theme('/assets/img/updated.png');
        $this->data['titleClass'] = 'text-success';

        $this->template('optin');
    }

    /**
     * @param array $data 
     */
    public function error(array $data): void
    {
        $data = $this->filterData($data);

        $error = 'Ops';

        if (is_numeric($data['error'])) {
            if (is_int($data['error'] * 1)) {
                $error = $data['error'];
            }
        }

        $this->data['errcode'] = $error;

        $this->template('error');
    }

    /**
     * @param bool $isExact 
     * @param array $data 
     * @param array $expected 
     * @return bool 
     */
    public function validateRequest(bool $isExact, array $data, array $expected): bool
    {
        if (!csrf_verify($data['csrf'])) {
            $this->message->error('Por favor, use o formulário para essa ação');
            return false;
        }

        array_push($expected, 'csrf');

        if ($isExact && !exact_ind($data, $expected)) {
            $this->message->warning('Todos os campos devem ser preenchidos corretamente');
            return false;
        } else if (!expected_ind($data, $expected)) {
            $this->message->warning('Todos os campos devem ser preenchidos corretamente');
            return false;
        }

        return true;
    }
}
