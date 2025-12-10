<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class Crud extends Model
{
    protected $DBGroup = 'default';
    protected $db;
    protected $forge;
    protected $dbAvailable = true;

    public function __construct(ConnectionInterface &$db = null)
    {
        parent::__construct();

        try {
            $this->db = \Config\Database::connect($this->DBGroup);
            $this->forge = \Config\Database::forge($this->DBGroup);
            $this->dbAvailable = true;
        } catch (\Throwable $e) {
            $this->db = null;
            $this->forge = null;
            $this->dbAvailable = false;
        }
    }

    /**
     * AUTO CREATE COLUMN: create_date & create_user
     */
    protected function checkColumn(string $table, string $column): void
    {
        $schema = $this->db->getDatabase();

        // Check date column
        $colDate = $this->readData('*', 'information_schema.COLUMNS', [
            ['TABLE_SCHEMA' => $schema],
            ['TABLE_NAME'   => $table],
            ['COLUMN_NAME'  => $table . '_' . $column . '_date'],
        ]);

        if (count($colDate) === 0) {
            $this->forge->addColumn($table, [
                $table . '_' . $column . '_date' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'null'       => true,
                    'default'    => null,
                ]
            ]);
        }

        // Check user column
        $colUser = $this->readData('*', 'information_schema.COLUMNS', [
            ['TABLE_SCHEMA' => $schema],
            ['TABLE_NAME'   => $table],
            ['COLUMN_NAME'  => $table . '_' . $column . '_user'],
        ]);

        if (count($colUser) === 0) {
            $this->forge->addColumn($table, [
                $table . '_' . $column . '_user' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'null'       => true,
                    'default'    => null,
                ]
            ]);
        }
    }

    /**
     * CREATE
     */
    public function createData(string $table, array $data)
    {
        if (! $this->dbAvailable) {
            return ['message' => 'Database not available'];
        }

        $this->checkColumn($table, 'create');

        return $this->db->table($table)->insert($data)
            ? $this->db->error()
            : $this->db->error();
    }

    /**
     * READ
     */
    public function readData($select, $from, $wheres = [], $joins = [], $groupBy = '', $order = '', $orderBy = '', $limit = null)
    {
        if (! $this->dbAvailable) {
            return [];
        }

        $builder = $this->db->table($from);

        if (!empty($select)) {
            $builder->select($select);
        }

        // JOIN FIXED
        foreach ($joins as $join) {
            if (is_array($join) && isset($join['table'], $join['on'])) {
                $builder->join($join['table'], $join['on'], $join['type'] ?? '');
            }
        }

        // WHERE FIXED (SUPAYA TIDAK ERROR)
        foreach ($wheres as $where) {
            if (is_array($where)) {
                $builder->where($where);
            }
        }

        if ($groupBy !== '') {
            $builder->groupBy($groupBy);
        }

        if ($order !== '') {
            $builder->orderBy($order, $orderBy);
        }

        if (is_array($limit)) {
            $builder->limit($limit['limit'] ?? null, $limit['offset'] ?? null);
        }

        $query = $builder->get();
        $error = $this->db->error();

        if (!empty($error['message'])) {
            throw new \RuntimeException($error['message']);
        }

        return $query->getResultArray();
    }

    /**
     * UPDATE
     */
    public function updateData(string $table, array $data, array $where)
    {
        if (! $this->dbAvailable) {
            return ['message' => 'Database not available'];
        }

        return $this->db->table($table)
            ->where($where)
            ->update($data)
            ? $this->db->error()
            : $this->db->error();
    }

    /**
     * DELETE
     */
    public function deleteData(string $table, array $where)
    {
        if (! $this->dbAvailable) {
            return ['message' => 'Database not available'];
        }

        return $this->db->table($table)
            ->where($where)
            ->delete()
            ? $this->db->error()
            : $this->db->error();
    }

    /**
     * COUNT FILTERED
     */
    public function countFiltered($select, $from, $where = [], $join = [], $like = [])
    {
        if (! $this->dbAvailable) {
            return 0;
        }

        $builder = $this->db->table($from);

        if (!empty($select)) {
            $builder->select($select);
        }

        foreach ($join as $j) {
            if (is_array($j) && isset($j['table'], $j['on'])) {
                $builder->join($j['table'], $j['on'], $j['type'] ?? '');
            }
        }

        foreach ($like as $l) {
            if (is_array($l)) {
                $builder->like($l);
            }
        }

        foreach ($where as $w) {
            if (is_array($w)) {
                $builder->where($w);
            }
        }

        return $builder->countAllResults();
    }

    /**
     * COUNT ALL
     */
    public function count_all($from)
    {
        if (! $this->dbAvailable) {
            return 0;
        }

        return $this->db->table($from)->countAllResults();
    }
}
