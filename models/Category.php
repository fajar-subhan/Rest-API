<?php 
namespace Api\Models;

use Api\Core\Database;
use Api\Exception\BaseException;
use Exception;
use PDO;

class Category extends Database
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
    private string $table              = "categories";

    public $id;
    public $category_name;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        $this->conn = parent::__construct();
    }

    
    /**
     * This method is useful for retrieving 
     * all the data in the categories table
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
            a.id AS id,
            a.categories_name AS category_name,
            a.categories_created_at AS created_at,
            a.categories_updated_at as updated_at
            FROM $this->table a
            ORDER BY a.id ASC 
            ";
            
            /* Creates Prepare watcher object associated with the current event loop instance */
            $stmt = $this->conn->prepare($query);

            /* Execute the statement */
            $stmt->execute();

            if($stmt->rowCount() > 0)
            {
                $i = 0;
                foreach($stmt->fetchAll() as $rows)
                {
                    $data[$i]['id']         = $rows['id'];
                    $data[$i]['name']       = $rows['category_name'];
                    $data[$i]['created_at'] = $rows['created_at'];
                    $data[$i]['updated_at'] = $rows['updated_at'];
                    $i++;
                }

                $result= ['status' => 'true','date' => date('Y-m-d H:i:s'),'data' => $data];
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
     * based on the id table categories
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
            a.id AS id,
            a.categories_name AS category_name,
            a.categories_created_at AS created_at,
            a.categories_updated_at as updated_at
            FROM $this->table a
            WHERE a.id = :id
            ORDER BY a.id ASC 
            ";

            /* Creates Prepare watcher object associated with the current event loop instance */
            $stmt = $this->conn->prepare($query);

            /* Binds a parameter to the specified variable name */
            $stmt->bindParam(':id',$this->id,PDO::PARAM_INT);
            
            /* Execute the statement */
            $stmt->execute();

            if($stmt->rowCount() > 0)
            {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                /* Set property */
                $this->id            = $data['id'];
                $this->category_name = $data['category_name'];
                $this->created_at    = $data['created_at'];
                $this->updated_at    = $data['updated_at'];

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
     * Entering data into table categories
     * 
     * @return  Json         $result
     * @var     Array        $result
     * @var     PDOStatement $stmt
     */
    public function create()
    {
        $result = ['status' => 'false','date' => date('Y-m-d H:i:s'),'message' => 'Category failed create'];

        try 
        {
            $query = "INSERT INTO $this->table
            SET 
                categories_name         = :category_name,
                categories_created_at   = :created_at
            ";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':category_name',$this->category_name,PDO::PARAM_STR);
            $date = date('Y-m-d H:i:s');
            $stmt->bindParam(':created_at',$date,PDO::PARAM_STR);

            if($stmt->execute())
            {
                $result = ['status' => 'true','date' => date('Y-m-d H:i:s'),'message' => 'Category success create'];
            }
        }
        catch(Exception $e)
        {
            BaseException::getException($e);
        }

        echo json_encode($result);
    }

    /**
     * Update categories table
     *
     *  @return  Json         $result
     * @var     Array        $result
     * @var     PDOStatement $stmt
     */
    public function update()
    {
        $result = ['status' => 'false','date' => date('Y-m-d H:i:s'),'message' => 'Category failed update'];

        try 
        {
            $query = "UPDATE  $this->table a
            SET 
                a.categories_name       = :category_name,
                a.categories_updated_at = :updated_at
            WHERE 
                a.id = :id
            ";
    
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":category_name",$this->category_name,PDO::PARAM_STR);
            $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
            $date = date('Y-m-d H:i:s');
            $stmt->bindParam(":updated_at",$date,PDO::PARAM_STR);
            
            if($stmt->execute())
            {
                $result = ['status' => 'true','date' => date('Y-m-d H:i:s'),'message' => 'Category success update'];
            }
        }
        catch(Exception $e)
        {
            BaseException::getException($e);            
        }

        echo json_encode($result);
    }

    /**
     * Delete categories table
     * 
     * @return  Json         $result
     * @var     Array        $result
     * @var     PDOStatement $stmt
     */
    public function delete()
    {
        $result = ['status' => 'false','date' => date('Y-m-d H:i:s'),'message' => 'Category failed delete'];

        try 
        {
            $query = "DELETE FROM $this->table 
            WHERE 
                id = :id
            ";
    
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
            
            if($stmt->execute())
            {
                $result = ['status' => 'true','date' => date('Y-m-d H:i:s'),'message' => 'Category success delete'];
            }
        }
        catch(Exception $e)
        {
            BaseException::getException($e);            
        }

        echo json_encode($result);
    }
}