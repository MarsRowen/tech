<?php
// models/ReportModel.php
require_once __DIR__ . '/BaseModel.php';

class ReportModel extends BaseModel {
    public function getMonthlyEggSummary() {
        return $this->db->query("SELECT strftime('%Y-%m', collected_at) AS month, SUM(quantity) AS total_eggs FROM eggs GROUP BY month ORDER BY month DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalEggsForMonth($month) {
        $stmt = $this->db->prepare("SELECT IFNULL(SUM(quantity),0) FROM eggs WHERE strftime('%Y-%m', collected_at) = ?");
        $stmt->execute([$month]);
        return (int) $stmt->fetchColumn();
    }

    public function getWeeklyEggTrend($weeks = 7) {
        $trendLabels = [];
        $trendValues = [];

        for ($i = $weeks - 1; $i >= 0; $i--) {
            $week = (new DateTime())->modify("-{$i} weeks");
            $label = 'Week ' . $week->format('W');
            $weekKey = $week->format('o-W');

            $trendLabels[] = $label;
            $stmt = $this->db->prepare("SELECT IFNULL(SUM(quantity),0) FROM eggs WHERE strftime('%Y-W', collected_at) = ?");
            $stmt->execute([$weekKey]);
            $trendValues[] = (int) $stmt->fetchColumn();
        }

        return ['labels' => $trendLabels, 'values' => $trendValues];
    }
}
?>