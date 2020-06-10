<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 18:10
 */

class UserModel
{
    /**
     * @var mixed
     */
    private $connection;

    /**
     * save connection resource
     */
    public function __construct()
    {
        $this->connection = Db::getInstance()->getConnection();
    }

    /** регистрация
     * @param array $data
     * @return bool
     */
    public function register(array $data): bool
    {
        $sql = "INSERT INTO users (login, password) VALUES (:login, :password)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':login' => $data['login'],
            ':password' => $data['password'],
        ]);

        if($this->connection->lastInsertId() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $login
     * @return bool
     */
    public function findUserByLogin(string $login): bool
    {
        $sql = "SELECT id FROM users WHERE login = :login";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':login' => $login]);

        $row = $stmt->fetch();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function login(array $data)
    {
        $sql = "SELECT id, login, password FROM users WHERE login = :login";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':login' => $data['login']]);

        $row = $stmt->fetch();

        if ($row) {
            if (password_verify($data['password'], $row['password'])) {
                $_SESSION['user_login'] = $row['login'];
                $_SESSION['user_id'] = $row['id'];
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getAllUsers(): array
    {
        $sql = "SELECT id, login FROM users WHERE id <> :id ORDER BY id ASC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':id' => $_SESSION['user_id']]);

        if ($rows = $stmt->fetchAll()) {
            return $rows;
        } else {
            return [];
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function addToFavorite(int $id): bool
    {
        $sql = "INSERT INTO favorite (user_login, contact_id) VALUES (:login, :id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':login' => $_SESSION['user_login'],
            ':id' => (int)$id,
        ]);

        if ($this->connection->lastInsertId() > 0) {
            header('Location: /user/favorite/');
            exit();
        } else {
            $_SESSION['infoMsg'] = '<div class="alert alert-danger">Ошибка добавления пользователя</div>';
            header('Location: /user/favorite/');
            exit();
        }
    }

    /**
     * @return array
     */
    public function getFavoriteForUser()
    {
        $sql = "SELECT f.contact_id, u.login, u.id "
            ."FROM favorite AS f "
            ."LEFT JOIN users AS u ON f.contact_id = u.id "
            ."WHERE f.user_login = :login "
            ."ORDER BY f.contact_id ASC ";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([':login' => $_SESSION['user_login']]);

        if ($rows = $stmt->fetchAll()) {
            return $rows;
        } else {
            return [];
        }

    }
}