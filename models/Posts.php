<?php
namespace Api\Models;

use Api\Core\Database;
use Api\Exception\BaseException;
use Exception;
use PDO;

class Posts extends Database
{
    /**
     * The active connection
     */
    private $conn;

    /**
     * Primary table name
     * 
     * @var string $table 
     */
    private string $table              = "posts";

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct()
    {
        $this->conn = parent::__construct();
    }

    /**
     * This method is useful for retrieving 
     * all the data in the posts table
     * 
     * @return  Json         $result
     * @var     Array        $result
     * @var     PDOStatement $stmt
     */
    public function read()
    {
        $result = ['status' => 'true','date' => date('Y-m-d H:i:s'),'data' => 'Data not found'];
        $data   = [];

        try 
        {
            $query = "SELECT 
            b.categories_name AS category_name,
            a.id AS posts_id,
            a.category_id AS category_id,
            a.posts_title AS title,
            a.posts_body AS body,
            a.posts_author AS author,
            a.posts_created_at AS created_at,
            a.posts_updated_at AS updated_at
            FROM $this->table a
            LEFT JOIN categories b ON a.category_id = b.id
            ORDER BY a.id ASC";

            /* Creates Prepare watcher object associated with the current event loop instance */
            $stmt = $this->conn->prepare($query);

            /* Execute the statement */
            $stmt->execute();
    
            if($stmt->rowCount() > 0)
            {
                $i = 0;
                foreach($stmt->fetchAll() as $rows)
                {
                    $data[$i]['name']        = $rows['category_name'];
                    $data[$i]['posts_id']    = $rows['posts_id'];
                    $data[$i]['category_id'] = $rows['category_id'];
                    $data[$i]['title']       = $rows['title'];
                    $data[$i]['body']        = $rows['body'];
                    $data[$i]['author']      = $rows['author'];
                    $i++;
                }
    
                $result = ['status' => 'true','date' => date('Y-m-d H:i:s'),'data' => $data]; 
            }
        }
        catch(Exception $e)
        {
            BaseException::getException($e);
        }

        echo json_encode($result);
    }   

    /**
     * This method serves to retrieve data 
     * based on the id table posts
     * 
     * @return  Json         $result
     * @var     Array        $result
     * @var     PDOStatement $stmt
     */
    public function readSingle()
    {
        $result = ['status' => 'true','date' => date('Y-m-d H:i:s'),'data' => 'Data not found'];
        $data   = [];

        try 
        {
            $query = "SELECT 
            b.categories_name AS category_name,
            a.id AS posts_id,
            a.category_id AS category_id,
            a.posts_title AS title,
            a.posts_body AS body,
            a.posts_author AS author,
            a.posts_created_at AS created_at,
            a.posts_updated_at AS updated_at
            FROM $this->table a
            LEFT JOIN categories b ON a.category_id = b.id
            WHERE a.id = ? ";

            /* Creates Prepare watcher object associated with the current event loop instance */
            $stmt = $this->conn->prepare($query);
            
            /* Binds a parameter to the specified variable name */
            $stmt->bindParam(1,$this->id,PDO::PARAM_INT);

            /* Execute the statement */
            $stmt->execute();

            if($stmt->rowCount() > 0)
            {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
                /* Set property */
                $this->title        = $data['title'];
                $this->body         = $data['body'];
                $this->author       = $data['author'];
                $this->category_id  = $data['category_id'];
                $this->category_name= $data['category_name'];
    
                $result = ['status' => 'true','date' => date('Y-m-d H:i:s'),'data' => $data]; 
            }
        }
        catch(Exception $e)
        {
            BaseException::getException($e);
        }

        echo json_encode($result);        
    }

    /**
     * Entering data into table posts
     * 
     */
    public function create()
    {
        $result = ['status' => 'false','date' => date('Y-m-d H:i:s'),'message' => 'Post success create'];

        try 
        {
            $query = "INSERT INTO $this->table
            SET 
                posts_title     = :title,
                posts_body      = :body,
                posts_author    = :author,
                category_id     = :category_id,
                posts_created_at= :created_at
            ";

            /* Creates Prepare watcher object associated with the current event loop instance */
            $stmt = $this->conn->prepare($query);

            /* Binds a parameter to the specified variable name */
            $stmt->bindParam(':title',$this->title,PDO::PARAM_STR);
            $stmt->bindParam(':body',$this->body,PDO::PARAM_STR);
            $stmt->bindParam(':author',$this->author,PDO::PARAM_STR);
            $stmt->bindParam(':category_id',$this->category_id,PDO::PARAM_INT);
            $date = date('Y-m-d H:i:s');
            $stmt->bindParam(':created_at',$date,PDO::PARAM_STR);

            if($stmt->execute())
            {
                $result = ['status' => 'true','date' => date('Y-m-d H:i:s'),'message' => 'Post success create'];
            }
        }
        catch(Exception $e)
        {
            BaseException::getException($e);
        }

        echo json_encode($result);
    }

    
    /**
     * Update data into table posts
     * 
     */
    public function update()
    {
        $result = ['status' => 'false','date' => date('Y-m-d H:i:s'),'message' => 'Post failed update'];

        try 
        {
            $query = "UPDATE $this->table
            SET 
                posts_title     = :title,
                posts_body      = :body,
                posts_author    = :author,
                category_id     = :category_id,
                posts_updated_at= :updated_at
            WHERE 
                id = :id
            ";

            /* Creates Prepare watcher object associated with the current event loop instance */
            $stmt = $this->conn->prepare($query);

            /* Binds a parameter to the specified variable name */
            $stmt->bindParam(':title',$this->title,PDO::PARAM_STR);
            $stmt->bindParam(':body',$this->body,PDO::PARAM_STR);
            $stmt->bindParam(':author',$this->author,PDO::PARAM_STR);
            $stmt->bindParam(':category_id',$this->category_id,PDO::PARAM_INT);
            $date = date('Y-m-d H:i:s');
            $stmt->bindParam(':updated_at',$date,PDO::PARAM_STR);
            $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);

            if($stmt->execute())
            {
                $result = ['status' => 'true','date' => date('Y-m-d H:i:s'),'message' => 'Post success update'];
            }
        }
        catch(Exception $e)
        {
            BaseException::getException($e);
        }

        echo json_encode($result);
    }

    /**
     * Delete data post
     * 
     */
    public function delete()
    {
        $result = ['status' => 'false','date' => date('Y-m-d H:i:s'),'message' => 'Post failed delete'];
        
        try 
        {
            $query = "DELETE FROM $this->table WHERE id = :id";
        
            /* Creates Prepare watcher object associated with the current event loop instance */
            $stmt = $this->conn->prepare($query);

            /* Binds a parameter to the specified variable name */
            $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);

            if($stmt->execute())
            {
                $result = ['status' => 'true','date' => date('Y-m-d H:i:s'),'message' => 'Post success delete'];
            }
        }   
        catch(Exception $e)
        {
            BaseException::getException($e);
        }

        echo json_encode($result);
    }
    
}