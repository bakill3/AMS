<?php

namespace Deost\Ams\Model;

use PDO;
use PDOException;

class UserModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Validates user credentials.
     *
     * @param string $username
     * @param string $password
     * @return bool Returns true if credentials are valid, false otherwise.
     */
    public function validateUser(string $username, string $password): bool {
        try {
            $stmt = $this->pdo->prepare("SELECT password FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && password_verify($password, $row['password'])) {
                return true;
            }
        } catch (PDOException $e) {
            error_log("Database error during user validation: " . $e->getMessage());
        }

        return false;
    }

    /**
     * Checks if a username already exists.
     *
     * @param string $username
     * @return bool Returns true if username exists, false otherwise.
     */
    private function usernameExists(string $username): bool
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    /**
     * Creates a new user with hashed password.
     *
     * @param string $username
     * @param string $password
     * @return bool Returns true if user was created successfully, false otherwise.
     */
    public function createUser(string $username, string $password): bool
    {
        if ($this->usernameExists($username)) {
            error_log("Attempted to create a user with an existing username: $username");
            return false;
        }

        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error during user creation: " . $e->getMessage());
            return false;
        }
    }
}
