<?php 
/**
 * Classes that are useful for handling dataabse processing
 * 
 * @author Fajar Subhan
 * @category Database
 */
namespace Api\Core;

use \PDO as PDO;
use \PDOException AS PDOException;
use Api\Exception\BaseException;

class Database 
{
    /**
     * Database hostname
     * 
     * @var string $db_host 
     */
    private $db_host = "localhost";

    /**
     * Database name
     * 
     * @var string $db_name
     */
    private $db_name = "api";

    /**
     * Database port
     * 
     * @var int $db_port
     */
    private $db_port = 3306;

    /**
     * Database username
     * 
     * @var string $db_user
     */
    private $db_user = "root";

    /**
     * Database password
     * 
     * @var string $db_pass
     */
    private $db_pass = "";

    /**
     * The active PDO connection
     * 
     * @var PDO $pdo
     */
    protected $pdo;

    protected function __construct()
    {
        try 
        {
            $dsn = "mysql:host={$this->db_host};dbname={$this->db_name};port={$this->db_port}";
            $this->pdo = new PDO($dsn,$this->db_user,$this->db_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $this->pdo;
        }
        catch(PDOException $e)
        {
            BaseException::getException($e);
        }

    }

}