<?php
// controllers/ReportController.php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/ReportModel.php';

class ReportController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new ReportModel();
    }

    public function index() {
        require_login();

        $currentMonth = date('Y-m');
        $totalEggsThisMonth = $this->model->getTotalEggsForMonth($currentMonth);
        $trend = $this->model->getWeeklyEggTrend();

        // static placeholder
        $recentExports = [
            ['name' => 'Financial_Summary.pdf', 'time' => '1 hour ago'],
            ['name' => 'Egg_Production.pdf', 'time' => '1 hour ago'],
        ];

        $data = [
            'totalEggsThisMonth' => $totalEggsThisMonth,
            'trendLabels' => $trend['labels'],
            'trendValues' => $trend['values'],
            'recentExports' => $recentExports,
            'pageTitle' => 'Reports',
            'pageDescription' => 'Review production summaries and financial performance.',
            'activeNav' => 'reports'
        ];

        $this->render('report', $data);
    }
}
?>