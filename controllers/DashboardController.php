<?php
// controllers/DashboardController.php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/DashboardModel.php';

class DashboardController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new DashboardModel();
    }

    public function index() {
        require_login();

        $data = [
            'totalChickens' => $this->model->getTotalChickens(),
            'dailyEggs' => $this->model->getDailyEggs(date('Y-m-d')),
            'feedInventoryKg' => $this->model->getFeedInventoryKg(),
            'monthlyNetProfit' => $this->model->getMonthlyNetProfit(date('Y-m')),
            'batches' => $this->model->getActiveBatches(),
            'eggTrend' => $this->model->getEggProductionTrend(),
            'pageTitle' => 'Farm Overview',
            'pageDescription' => 'Real-time pulse of your poultry operations.',
            'activeNav' => 'dashboard'
        ];

        $this->render('dashboard', $data);
    }
}
?>