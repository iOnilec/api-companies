<?php

namespace App\Controllers\CompaniesController;

use App\Models\Company\Company;
use Exception;
use PDO;

require_once __DIR__ . '/../Models/Company.php';
require_once __DIR__ . '/../config/db.php';

class CompaniesController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = connect();
    }

    public function index()
    {
        try {
            $companies = new Company($this->pdo);

            $data = $companies->index();

            http_response_code(200);
            echo json_encode([
                'status' => 200,
                'message' => 'Requisição feita com sucesso',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(500);

            echo json_encode([
                'status' => 500,
                'message' => 'Erro no processamento dos dados',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function store()
    {
        try {
            $data_create = json_decode(file_get_contents('php://input'), true);

            $companies = new Company($this->pdo);

            $create = $companies->store($data_create);

            if ($create) {
                http_response_code(201);

                echo json_encode([
                    'status' => 201,
                    'message' => 'Empresa registrada com sucesso',
                    'data' => $create
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500);

            echo json_encode([
                'status' => 500,
                'message' => 'Erro no processamento dos dados',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try {

            $companies = new Company($this->pdo);

            $data = $companies->show($id);

            if (!$data) {
                http_response_code(404);

                echo json_encode([
                    'status' => 404,
                    'message' => 'Empresa não encontrada',
                ]);

                return;
            }

            http_response_code(200);

            echo json_encode([
                'status' => 200,
                'message' => 'Requisição feita com sucesso',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(500);

            echo json_encode([
                'status' => 500,
                'message' => 'Erro no processamento dos dados',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function update($id)
    {
        try {
            $data_update = json_decode(file_get_contents('php://input'), true);

            $companies = new Company($this->pdo);

            $id_company = $companies->show($id);

            if (!$id_company) {
                http_response_code(404);

                echo json_encode([
                    'status' => 404,
                    'message' => 'Empresa não encontrada',
                ]);

                return;
            }

            $updated = $companies->update($id, $data_update);

            if ($updated) {
                http_response_code(200);

                echo json_encode([
                    'status' => 200,
                    'message' => 'Empresa atualizada com sucesso',
                    'data' => $updated
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500);

            echo json_encode([
                'status' => 500,
                'message' => 'Erro no processamento dos dados',
                'exception' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $companies = new Company($this->pdo);

            $data = $companies->show($id);

            if (!$data) {
                http_response_code(404);

                echo json_encode([
                    'status' => 404,
                    'message' => 'Empresa não encontrada',
                ]);

                return;
            }

            $delete = $companies->destroy($id);

            if ($delete) {
                http_response_code(200);

                echo json_encode([
                    'status' => 200,
                    'message' => 'Empresa deletada com sucesso'
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500);

            echo json_encode([
                'status' => 500,
                'message' => 'Erro no processamento dos dados',
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
