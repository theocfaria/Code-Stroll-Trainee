<?php

namespace App\Core\Database;

use PDO, Exception;

class QueryBuilder
{
    protected $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table, $begin = null, $rows = null)
    {
        $sql = "select * from {$table}";

        if ($begin >= 0 && $rows > 0) {
            $sql .= " LIMIT {$begin} , {$rows} ";
        }

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function verificaLogin($email, $senha)
    {
        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'password' => $senha
            ]);

            $user = $stmt->fetch(PDO::FETCH_OBJ);

            return $user;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (:%s)',
            $table,
            implode(', ', array_keys($parameters)),
            implode(', :', array_keys($parameters)),
        );

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //função editar
    public function update($table, $id, $parameters)
    {
        $sql = sprintf(
            'UPDATE %s SET %s WHERE id = :id',
            $table,
            implode(', ', array_map(
                function ($param) {
                    return $param . ' = :' . $param;
                },
                array_keys($parameters)
            ))
        );
        $parameters['id'] = $id;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //função editar
    // public function update($table, $id, $parameters)
    // {
    //     $sql = sprintf('UPDATE %s SET %s WHERE id = %s',
    //     $table,
    //     implode(', ', array_map(function($param){
    //         return $param . ' = :' .$param;
    //     },
    //     array_keys($parameters))),
    //     $id
    // );

    // try {
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->execute($parameters);

    //         return $stmt->fetchAll(PDO::FETCH_CLASS);

    //     } catch (Exception $e) {
    //         die($e->getMessage());
    //     }
    // }


    public function delete($table, $id)
    {
        $sql = sprintf('DELETE FROM %s WHERE %s', $table, 'id = :id');

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(compact('id'));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectOne($table, $id)
    {
        $sql = sprintf('SELECT * FROM %s WHERE id=:id LIMIT 1', $table);

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function countAll($table)
    {
        $sql = "SELECT COUNT(*) FROM {$table} ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([]);

            return intval($stmt->fetch(PDO::FETCH_NUM)[0]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function populaBancoPost($table, $size)
    {
        for ($i = 0; $i <= $size; $i++) {
            $title = "Titulo {$i}";
            $content = "Descrição {$i}";
            $author = "Nome{$i}";
            $created_at = "2025-11-16";

            $this->insert($table, [
                'title' => $title,
                'content' => $content,
                'author' => $author,
                'created_at' => $created_at,
            ]);
        }
    }

    public function populaBancoUser($table, $size)
    {
        for ($i = 0; $i <= $size; $i++) {
            $name = "Nome{$i}";
            $email = "nome{$i}@email.com";
            $password = "Nome{$i}/user";

            $this->insert($table, [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);
        }
    }


    public function countFromSearch($table, $busca)
    {
        $sql = "SELECT count(*) FROM {$table} WHERE title LIKE :busca";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':busca', "%{$busca}%");
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function countFromSearchUsers($table, $busca)
    {
        $sql = "SELECT count(*) FROM {$table} WHERE name LIKE :busca";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':busca', "%{$busca}%");
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function searchFromDB($busca, $begin, $rows)
    {
        $sql = "SELECT posts.*, users.name AS autor_nome  
            FROM posts
            JOIN users ON users.id = posts.author     
            WHERE posts.title LIKE :busca             
            LIMIT :begin, :rows";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':busca', "%{$busca}%");
        $stmt->bindValue(':begin', (int)$begin, PDO::PARAM_INT);
        $stmt->bindValue(':rows', (int)$rows, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function searchFromDBUsers($busca, $begin, $rows)
    {
        $sql = "SELECT * FROM users WHERE name LIKE :busca LIMIT :begin, :rows";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':busca', "%{$busca}%");
        $stmt->bindValue(':begin', (int)$begin, PDO::PARAM_INT);
        $stmt->bindValue(':rows', (int)$rows, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectPostsAutores($begin, $rows)
    {
        $sql = "SELECT posts.*, users.name AS autor_nome
                FROM posts
                JOIN users ON users.id = posts.author
                LIMIT :begin, :rows";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':begin', (int)$begin, PDO::PARAM_INT);
        $stmt->bindValue(':rows', (int)$rows, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function FindByID($table, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE ID = {$id}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([]);

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectPostsRecentes($limit)
    {
        $sql = "SELECT posts.*, users.name AS autor_nome 
                FROM posts 
                JOIN users ON users.id = posts.author 
                ORDER BY posts.created_at DESC 
                LIMIT :limit";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function countPostsByAuthor($table, $authorId)
    {
        $sql = "SELECT COUNT(*) FROM {$table} WHERE author = :authorId";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['authorId' => $authorId]);
            return intval($stmt->fetchColumn());
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectPostsByAuthorId($authorId, $begin, $rows)
    {
        $sql = "SELECT posts.*, users.name AS autor_nome
            FROM posts
            JOIN users ON users.id = posts.author
            WHERE posts.author = :authorId
            LIMIT :begin, :rows";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':authorId', $authorId, \PDO::PARAM_INT);
        $stmt->bindValue(':begin', (int)$begin, \PDO::PARAM_INT);
        $stmt->bindValue(':rows', (int)$rows, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAllPostsByAuthor($authorId)
    {
        $sql = "SELECT * FROM posts WHERE author = :authorId";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['authorId' => $authorId]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteWhere($table, $column, $value)
    {
        $sql = "DELETE FROM {$table} WHERE {$column} = :val";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['val' => $value]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
