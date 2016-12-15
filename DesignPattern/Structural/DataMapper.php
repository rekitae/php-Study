<?php
/*
 * DB Object Relational Mapper (ORM) : Doctrine2 uses DAO named as “EntityRepository”
 */
class User
{
    private $username;
    private $email;

    public static function fromState(array $state): User
    {
        return new self(
            $state['username'],
            $state['email']
        );
    }

    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}

class UserMapper
{
    private $adapter;

    public function __construct(IPersistStorage $storage)
    {
        $this->adapter = $storage;
    }

    public function findById(int $id): User
    {
        $result = $this->adapter->find($id);

        if ($result === null) {
            throw new \InvalidArgumentException("User #$id not found");
        }

        return $this->mapRowToUser($result);
    }

    public function findLIst(): array
    {
        $result = $this->adapter->findList();

        $arr = [];
        foreach ($result as $node)
        {
            $arr[] = $this->mapRowToUser($node);
        }

        return $arr;
    }

    private function mapRowToUser(array $row): User
    {
        return User::fromState($row);
    }
}

interface IPersistStorage
{
    public function find(int $id): ?array;

    public function findList(): ?array;
}

class MemoryPersistStorage implements IPersistStorage
{
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function find(int $id): ?array
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }

        return null;
    }

    public function findList(): array
    {
        return $this->data;
    }
}

class MysqlPersistStorage implements IPersistStorage
{
    public function find(int $id): ?array
    {
        echo 'DB SELECT query pk = ', $id, PHP_EOL;

        return null;
    }

    public function findList(): ?array
    {
        echo 'DB SELECT quiery ', PHP_EOL;

        return null;
    }
}

$storage = new MemoryPersistStorage([
    1 => ['username' => 'rekitae', 'email' => 'gitagy@gmail.com'],
    2 => ['username' => 'sw1626', 'email' => 'sw1626@naver.com'],
]);
$mapper = new UserMapper($storage);

$user = $mapper->findById(1);
print_r($user);

$user = $mapper->findById(2);
print_r($user);

$users = $mapper->findList();
print_r($users);

//$user = $mapper->findById(3);

//////////////////////////////////////////////////

$storage = new MysqlPersistStorage();
$mapper = new UserMapper($storage);

$mapper->findById(1111);