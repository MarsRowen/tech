<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="card-panel" style="display: grid; grid-template-columns: 320px 1fr; gap: 18px;">
    <div>
        <h2>Report Configuration</h2>
        <p style="margin-top:4px; color: var(--muted);">Select a template, date range, and export format.</p>

        <div style="display: grid; gap: 10px; margin-top: 14px;">
            <label style="font-weight: 600; font-size: 0.9rem;">Report Template</label>
            <button class="button" type="button" style="background:#fff; color:#111; border:1px solid rgba(0,0,0,0.12);">Batch Performance Analysis</button>

            <label style="font-weight: 600; font-size: 0.9rem;">Date Range</label>
            <div style="display:flex; gap:10px;">
                <input type="date" style="flex:1; padding:10px; border-radius:10px; border:1px solid rgba(0,0,0,0.12);" />
                <input type="date" style="flex:1; padding:10px; border-radius:10px; border:1px solid rgba(0,0,0,0.12);" />
            </div>

            <label style="font-weight: 600; font-size: 0.9rem;">Export Format</label>
            <div style="display:flex; gap:10px;">
                <button class="button" type="button" style="background:#fff; color:#111; border:1px solid rgba(0,0,0,0.12);">PDF</button>
                <button class="button" type="button" style="background:#fff; color:#111; border:1px solid rgba(0,0,0,0.12);">Excel</button>
            </div>

            <button class="button" type="button" style="margin-top: 8px;">Generate Report</button>
        </div>

        <div style="margin-top: 22px;">
            <h3 style="margin:0;">Recent Exports</h3>
            <div style="margin-top: 10px; display: grid; gap: 10px;">
                <?php foreach ($recentExports as $export): ?>
                    <div style="display:flex; justify-content:space-between; align-items:center; padding: 10px 12px; border:1px solid rgba(0,0,0,0.1); border-radius: 12px;">
                        <div>
                            <div style="font-weight:600;"><?= htmlspecialchars($export['name']) ?></div>
                            <div style="font-size:0.85rem; color: var(--muted);"><?= htmlspecialchars($export['time']) ?></div>
                        </div>
                        <span style="font-size:1.2rem;">⬇️</span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div style="display: grid; gap: 16px;">
        <h2>Batch Performance Analysis</h2>
        <p style="margin-top:4px; color: var(--muted);">Lorem ipsum dolor sit amet</p>

        <div class="stats" style="grid-template-columns: repeat(3, minmax(180px, 1fr));">
            <div class="stat">
                <h3>Total Production</h3>
                <p><?= number_format($totalEggsThisMonth) ?> Eggs this month</p>
            </div>
            <div class="stat">
                <h3>Feed Conversion</h3>
                <p>0</p>
            </div>
            <div class="stat">
                <h3>Avg. Mortality</h3>
                <p>0%</p>
            </div>
        </div>

        <div style="background: rgba(255,255,255,0.9); padding: 14px 16px; border-radius: 18px; border: 1px solid rgba(0,0,0,0.08);">
            <h3 style="margin:0 0 10px;">Production vs. Financials Trend</h3>
            <div style="max-width:520px; height: 280px;">
                <canvas id="reportTrendChart" style="width:100%; height:100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const reportLabels = <?= json_encode($trendLabels, JSON_HEX_TAG) ?>;
    const reportData = <?= json_encode($trendValues, JSON_HEX_TAG) ?>;

    new Chart(document.getElementById('reportTrendChart'), {
        type: 'line',
        data: {
            labels: reportLabels,
            datasets: [{
                label: 'Eggs',
                data: reportData,
                borderColor: 'rgba(46, 204, 113, 0.9)',
                backgroundColor: 'rgba(46, 204, 113, 0.15)',
                tension: 0.3,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>