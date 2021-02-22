<?php

namespace Source\Core;

use Source\Support\Message;

/**
 * @package Source\Models
 */
abstract class Model
{
    /** @var object|null */
    protected $data;

    /** @var \PDOException|null */
    protected $fail;

    /** @var Message|null */
    protected $message;

    /** @var string */
    protected $find;

    /** @var string */
    protected $findAppend;

    /** @var string */
    protected $params;

    /** @var string $entity database table */
    protected $entity;

    /** @var array $protected no update or create */
    protected $protected;

    /** @var array $entity database table */
    protected $required;

    /**
     * Model constructor.
     * @param string $entity database table name
     * @param array $protected table protected columns
     * @param array $required table required columns
     */
    public function __construct(string $entity, array $protected, array $required)
    {
        $this->entity = $entity;
        $this->protected = array_merge($protected, ['id', 'created_at', 'updated_at']);
        $this->required = $required;

        $this->message = new Message();
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (empty($this->data)) {
            $this->data = new \stdClass();
        }

        $this->data->$name = $value;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data->$name);
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        return ($this->data->$name ?? null);
    }

    /**
     * @return object|null
     */
    public function data(): ?object
    {
        return $this->data;
    }

    /**
     * @return \PDOException
     */
    public function fail(): ?\PDOException
    {
        return $this->fail;
    }

    /**
     * @return Message|null
     */
    public function message(): ?Message
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function query(): string
    {
        return $this->find . $this->findAppend;
    }

    /**
     * @param string|null $terms 
     * @param string|null $params 
     * @param string $columns 
     * @return Model|mixed
     */
    public function find(
        ?string $terms = null, 
        ?string $params = null, 
        string $columns = '*'
    )
    {
        $this->find = "SELECT {$columns} FROM {$this->entity}";

        if ($terms) {
            $this->find .= " WHERE {$terms}";
            parse_str($params, $this->params);
        }
        return $this;
    }

    /**
     * @param int $id
     * @param string $columns
     * @return null|mixed|Model
     */
    public function findById(int $id, string $columns = '*'): ?Model
    {
        return $this->find('id = :id', "id={$id}", $columns)->fetch();
    }

    /**
     * @param string $term 
     * @return Model
     */
    public function findAppend(string $term): Model
    {
        $this->findAppend .= " {$term}";
        return $this;
    }

    /**
     * @param bool|boolean $all 
     * @return null|array|mixed|Model
     */
    public function fetch(bool $all = false) 
    {
        try {
            $stmt = $this->prepare($this->query());
            $stmt->execute($this->params);

            if (!$stmt->rowCount()) {
                return null;
            }

            if ($all) {
                return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
            }

            return $stmt->fetchObject(static::class);
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @param array $data 
     * @return int|null 
     */
    protected function insert(array $data): ?int
    {
        try {
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $stmt = $this->prepare("INSERT INTO {$this->entity} ({$columns}) VALUES ({$values})");
            $stmt->execute($this->filter($data));

            return Connect::getInstance()->lastInsertId();
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @param array $data 
     * @param string $terms 
     * @param string $params 
     * @return int|null 
     */
    protected function update(array $data, string $terms, string $params): ?int
    {
        try {
            $dateSet = [];
            foreach ($data as $bind => $value) {
                $dateSet[] = "{$bind} = :{$bind}";
            }
            $dateSet = implode(', ', $dateSet);
            parse_str($params, $params);

            $stmt = $this->prepare("UPDATE {$this->entity} SET {$dateSet} WHERE {$terms}");
            $stmt->execute($this->filter(array_merge($data, $params)));
            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @return bool 
     */
    public function save(): bool
    {
        /** INSERT */
        if (empty($this->id)) {
            $id = $this->insert($this->safe());

            if (!$id) {
                $this->message->error("Erro ao cadastrar, verifique os dados ou tente novamente mais tarde");
                return false;
            }
            
            $action = 'cadastrar';
        }

        /** UPDATE */
        if (!empty($this->id)) {
            $id = $this->id;

            $this->update($this->safe(), "id = :id", "id={$id}");
            $action = 'atualizar';
        }

        if ($this->fail()) {
            $this->message->error("Erro ao {$action}, verifique os dados");
            return false;
        }

        $this->data = ($this->findById($id))->data();
        return true;
    }

    /**
     * @param string $terms 
     * @param string|null $params 
     * @return bool
     */
    public function delete(string $terms, ?string $params): bool
    {
        try {
            $stmt = $this->prepare("DELETE FROM {$this->entity} WHERE {$terms}");

            if ($params) {
                parse_str($params, $params);
                $stmt->execute($params);
            } else {
                $stmt->execute();
            }

            return true;
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return false;
        }
    }

    /**
     * @return bool
     */
    public function destroy(): bool
    {
        if (empty($this->id)) {
            return false;
        }

        return $this->delete('id = :id', "id={$this->id}");
    }

    /**
     * @param string $query 
     * @return \PDOStatement 
     */
    protected function prepare(string $query): \PDOStatement
    {
        return Connect::getInstance()->prepare($query);
    }

    /**
     * @return array|null
     */
    protected function safe(): ?array
    {
        $safe = (array)$this->data;
        foreach ($this->protected as $unset) {
            unset($safe[$unset]);
        }
        return $safe;
    }

    /**
     * @param array $data
     * @return array|null
     */
    private function filter(array $data): ?array
    {
        $filter = [];
        foreach ($data as $key => $value) {
            $filter[$key] = (is_null($value) ? null : filter_var($value, FILTER_DEFAULT));
        }
        return $filter;
    }

    /**
     * @return bool
     */
    protected function required(): bool
    {
        $data = (array) $this->data();
        foreach ($this->required as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }
        return true;
    }
}
