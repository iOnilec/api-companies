<?php

namespace App\Models\Company;

use PDO;

require __DIR__ . './../config/db.php';

class Company
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM companies");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO companies (companies_name, companies_cnpj) VALUES (:companies_name, :companies_cnpj)");

        return $stmt->execute([
            'companies_name' => $data['companies_name'],
            'companies_cnpj' => $data['companies_cnpj'],
        ]);
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM companies WHERE id = :id");

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE companies SET companies_name = :companies_name WHERE id = :id");

        return $stmt->execute([
            ':companies_name' => $data['companies_name'],
            ':id' => $id
        ]);
    }

    public function destroy($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM companies WHERE id = :id");

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
