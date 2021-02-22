<?php

namespace Source\App;

use Source\Core\Controller;

use Source\Models\User;
use Source\Models\Auth;

/**
 * @package  Source\App
 */
class AdminController extends Controller
{
    /** @var User */
    protected $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . '/../../themes/' . CONF_VIEW_ADMIN . '');

        if (Auth::logged()) {
            $this->user = Auth::user();

            if (!$this->user) {
                $this->redirect('/erro/problemas');
            }
        } else {
            $this->message->warning('Efetue login para acessar as funções de administrador')->flash();
            $this->redirect('/login');
        }
    }
    
    /**
     * ADMIN DASHBOARD
     */
    public function dash(): void
    {
        $this->redirect('/admin/usuarios');
    }

    /**
     * @param array|null $data 
     */
    public function users(?array $data): void 
    {
        $this->template('users');

        $terms = 'id != :id';
        $params = "id={$this->user->id}";

        if (!empty($data)) {
            $data = $this->filterData($data);

            if (!empty($data['nameEmail'])) {
                if (filter_var($data['nameEmail'], FILTER_VALIDATE_EMAIL)) {
                    $terms .= " AND email = :email";
                    $params .= "&email={$data['nameEmail']}";
                } else {
                    $data['nameEmail'] = mb_strtolower(($data['nameEmail']));

                    $terms .= " AND (last_name LIKE :like OR first_name LIKE :like)";
                    $params .= "&like=%25{$data['nameEmail']}%25";
                }
            }

            if (!empty($data['registeredAt'])) {
                if (str_include('/', $data['registeredAt'])) {
                    $date = \DateTime::createFromFormat('m/Y', $data['registeredAt']);

                    if (!$date) {
                        $this->message->error('Data de registro informada é inválida');
                        return;
                    }

                    $terms .= " AND month(created_at) = :month";
                    $params .= "&month={$date->format('m')}";
                } else {
                    $date = \DateTime::createFromFormat('Y', $data['registeredAt']);

                    if (!$date) {
                        $this->message->error('Data de registro informada é iválida');
                        return;
                    }
                }

                $terms .= " AND year(created_at) = :year";
                $params .= "&year={$date->format('Y')}";
            }

            $this->data['search'] = (object) $data;
        }

        $this->data['users'] = (new User())
            ->find(
                $terms,
                $params,
                "id, first_name, last_name, email, DATE_FORMAT(created_at, '%d/%m/%Y') as registered_at" 
            )
            ->findAppend('ORDER BY created_at DESC')
            ->fetch(true);
    }

    /**
     * @param array $data 
     */
    public function removeUser(array $data): void
    {
        $data = $this->filterData($data);

        $user = (new User())->findById($data['user']);

        if (!$user) {
            $this->json['message'] = $this->message->error('Usuário não encontrado, recarrege a página e tente novamente')->render();
            return;
        }

        $firstName = $user->first_name;
        $lastName = $user->last_name;

        if (!$user->destroy()) {
            $this->json['message'] = $this->message->error('Erro inesperado ocorreu, tente novamente mais tarde')->render();
            return;
        }

        $this->json['message'] = $this->message->success("Usuário \"{$firstName} {$lastName}\" foi removido com sucesso")->render();
        $this->json['success'] = true;
    }
}
