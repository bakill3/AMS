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
        $this->pdo->exec("SET NAMES utf8");
    }

    public function validateUser(string $username, string $password): bool {
        try {
            $stmt = $this->pdo->prepare("SELECT password FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                error_log("Fetched user data for '$username': " . print_r($row, true));
                
                if (password_verify($password, $row['password'])) {
                    error_log("Password verification successful for user: $username");
                    return true;
                } else {
                    error_log("Password verification failed for user: $username. Incorrect password.");
                }
            } else {
                error_log("No user found with username: $username.");
            }
        } catch (PDOException $e) {
            error_log("Database error during user validation for '$username': " . $e->getMessage());
        }
    
        return false;
    }

    public function createUser(string $username, string $password): bool {
        if ($this->usernameExists($username)) {
            error_log("Attempted to create a user with an existing username: $username");
            return false;
        }

        try {
            $options = [
                'memory_cost' => 1<<17, // 128 MB
                'time_cost'   => 4,
                'threads'     => 2
            ];
            $hashedPassword = password_hash($password, PASSWORD_ARGON2ID, $options);
    
            $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error during user creation for '$username': " . $e->getMessage());
            return false;
        }
    }

    private function usernameExists(string $username): bool {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Database error checking username existence for '$username': " . $e->getMessage());
            return false;
        }
    }
}
