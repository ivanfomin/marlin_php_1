<?php

namespace Data;

include __DIR__ . '/Db.php';

abstract class Model
{
    protected  $db;
    
    public function __construct(Db $db)
    {
       $this->db = $db;
    }
    
    public function findAll()
    {
        return $this->db->query('SELECT * FROM ' . static::$table, [], static::class);
    }
    
    public  function findById($id)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';
        $data = $this->db->query($sql, [':id' => $id], static::class);
        return $data[0] ?? false;
    }
    
    public function save()
    {
        if ($this->isNew()) {
            $this->insert();
        } else {
            $this->update();
        }
    }
    
    public function isNew()
    {
        
        return empty($this->id);
    }
    
    protected function insert()
    {
        $columns = [];
        $binds = [];
        $data = [];
        foreach ($this as $column => $value) {
            if ('id' == $column || 'db' == $column) {
                continue;
            }
            $columns[] = $column;
            $binds[] = ':' . $column;
            $data[':' . $column] = $value;
        }
        
        $sql = '
                INSERT INTO ' . static::$table . '
                (' . implode(', ', $columns) . ')
                VALUES
                (' . implode(', ', $binds) . ')
                ';
        $this->db->execute($sql, $data);
        $this->id = $this->db->lastInsertId();
    }
    
    protected function update()
    {
        $columns = [];
        $data = [];
        $sql = 'UPDATE ' . static::$table . ' SET ';
        foreach ($this as $column => $value) {
            $data[':' . $column] = $value;
    
            if ('id' == $column || 'db' == $column) {
                continue;
            }
            $columns[] = $column . ' = :' . $column;
        }
        $sql = $sql . implode(', ', $columns) . ' WHERE id= ' . ':id';
       // $data[id] =$this->id;
        $this->db->execute($sql, $data);
    }
    
    public function delete()
    {
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id= ' . $this->id;
        $this->db->execute($sql);
    }
    
    public  function deleteName($name)
    {
        $sql = 'DELETE FROM ' . static::$table . " WHERE name = :name";
        $this->db->execute($sql, ['name' => $name]);
    }
}