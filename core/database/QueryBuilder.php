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

        if($begin >= 0 && $rows >0)
        {
            $sql .=" LIMIT {$begin} , {$rows} ";
        }

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //função criar
    public function insert($table, $parameters)
    {
        $sql = sprintf('INSERT INTO %s (%s) VALUES (:%s)',
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
        $sql = sprintf('UPDATE %s SET %s WHERE id = :id',
        $table,
        implode(', ', array_map(function($param){
            return $param . ' = :' .$param;
        },
        array_keys($parameters)))
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
    

    public function delete($table, $id)
    {
        $sql = sprintf('DELETE FROM %s WHERE %s', $table, 'id = :id');

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(compact('id'));

        } 
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function selectOne($table, $id)
    {
        $sql = sprintf('SELECT * FROM %s WHERE id=:id LIMIT 1', $table);

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

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

    public function populaBanco($table,$size)
    {
        /* DADOS: <?= $user->id ?> <?= $user->name ?> <?= $user->email ?> <?= $user->password ?> */
        for($i = 0; $i<=$size; $i++)
            {
                $name = "Nome {$i}";
                $email = "email{$i}@email.com";
                $password = "senha_user{$i}";
                
                $this->insert($table, [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password
                ]);
            }
    }

    public function countFromSearch($table, $busca)
    {
        $sql = "SELECT COUNT(*) as total_ocorr FROM $table WHERE title LIKE :busca or author LIKE :busca";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':busca', "%$busca");
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total_ocorr'];
    }

    public function searchFromDB($search, $inicio, $itemsPagina)
    {
        $string_busca = "%$search%";

        $sql = "SELECT * FROM posts WHERE title LIKE :string_busca or author LIKE :string_busca LIMIT :inicio, :fim";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':string_busca', $string_busca, PDO::PARAM_STR);
        $stmt->bindValue(':inicio', (int)$inicio, PDO::PARAM_INT);
        $stmt->bindValue(':fim', (int)$itemsPagina, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}