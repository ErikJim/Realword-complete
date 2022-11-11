<?php 
namespace App\Controllers;
use App\Models\CounterModel;
use CodeIgniter\Controller;
class ApiController extends Controller
{
    public function getBetweenRange() {
        $between = $this->request->getVar();
        $range = explode(",", $between['words-between']);
        $superiorLimit = $range[0];
        $inferiorLimit = $range[1];
        $counterModel = new CounterModel();
        $whereCondition = ['articles_comments >=' => $inferiorLimit, 'articles_comments <=' => $superiorLimit ];
        $data = $counterModel->where($whereCondition)->findAll();
        $sumatory = 0;
        foreach ($data as $counter) {
            $sumatory = $sumatory + $counter['articles_comments'];
        }
        $response = (object)['total' => $sumatory];
        return $this->response->setJSON($response);
    }
}