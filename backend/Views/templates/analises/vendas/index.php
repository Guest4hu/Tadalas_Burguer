<div class="stats-cards">
    <div class="card">
        <p class="card-title">Vendas Totais</p>
        <p class="card-value"><?php echo number_format($totalVendas['totalVendas'] ?? 0, 0, ',', '.'); ?></p>
    </div>
    <div class="card" style="border-left-color: #007bff;">
        <p class="card-title">Pagamento via Pix</p>
        <p class="card-value"><?php echo number_format($totalVendas['tipoDePagamentoPix'] ?? 0, 0, ',', '.'); ?></p>
    </div>
    <div class="card" style="border-left-color: #28a745;">
        <p class="card-title">Pagamento via Cartão de Crédito</p>
        <p class="card-value"><?php echo number_format($totalVendas['tipoDePagamentoCC'] ?? 0, 0, ',', '.'); ?></p>
    </div>
    <div class="card" style="border-left-color: #ffc107;">
        <p class="card-title">Pagamento via Cartão de Débito</p>
        <p class="card-value"><?php echo number_format($totalVendas['tipoDePagamentoCD'] ?? 0, 0, ',', '.'); ?></p>
    </div>
    <div class="card" style="border-left-color: #dc3545;">
        <p class="card-title">Pagamento via Boleto</p>
        <p class="card-value"><?php echo number_format($totalVendas['tipoDePagamentoBN'] ?? 0, 0, ',', '.'); ?></p>
    </div>
</div>

<div id="admin-analytics-data"
    data-log-labels='<?php echo json_encode($totalVendas['logsComparison']['labels'] ?? []); ?>'
    data-log-data-current='<?php echo json_encode($totalVendas['logsComparison']['currentWeek'] ?? []); ?>'
    data-log-data-last='<?php echo json_encode($totalVendas['logsComparison']['lastWeek'] ?? []); ?>'
    data-activity-labels='<?php echo json_encode([
        'Pix', 'Cartão de Crédito', 'Cartão de Débito', 'Boleto'
    ]); ?>'
    data-activity-data='<?php echo json_encode([
        (int)($totalVendas['tipoDePagamentoPix'] ?? 0),
        (int)($totalVendas['tipoDePagamentoCC'] ?? 0),
        (int)($totalVendas['tipoDePagamentoCD'] ?? 0),
        (int)($totalVendas['tipoDePagamentoBN'] ?? 0)
    ]); ?>'
    style="display:none"></div>

<div class="chart-grid">
    <div class="chart-box">
        <h4 class="card-title">Vendas (Comparação Semanal)</h4>
        <canvas id="weekly-comparison-chart" style="height: 350px;"></canvas>
    </div>
    <div class="chart-box">
        <h4 class="card-title">Distribuição por Tipo de Pagamento</h4>
        <canvas id="activity-type-chart" style="height: 150px;"></canvas>
    </div>
</div>

<script src="/js/admin-charts.js">
    document.addEventListener('DOMContentLoaded', function() {
    const dataElement = document.getElementById('admin-analytics-data');
    // NOTE: Chart is expected to be loaded via <script> tags in the layout
    if (typeof Chart === 'undefined' || !dataElement) return;
 
    // --- 1. Dados de Comparação Semanal ---
    const labels = JSON.parse(dataElement.getAttribute('data-log-labels'));
    const logDataCurrent = JSON.parse(dataElement.getAttribute('data-log-data-current'));
    const logDataLast = JSON.parse(dataElement.getAttribute('data-log-data-last'));
 
    // --- 2. Dados de Atividade (Donut) ---
    const activityLabels = JSON.parse(dataElement.getAttribute('data-activity-labels'));
    const activityData = JSON.parse(dataElement.getAttribute('data-activity-data'));
 
    const activityColors = [
        '#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#17a2b8', '#fd7e14'
    ];
 
    // --- Gráfico de Comparação Semanal (Linhas) ---
    const ctxLogs = document.getElementById('weekly-comparison-chart').getContext('2d');
    if (ctxLogs) {
        new Chart(ctxLogs, {
            type: 'line',
            data: {
                labels: labels, // Dom, Seg, Ter, ...
                datasets: [
                    {
                        label: 'Semana Atual',
                        data: logDataCurrent,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                        fill: true,
                        tension: 0.3
                    },
                     {
                        label: 'Semana Anterior',
                        data: logDataLast,
                        borderColor: '#6c757d',
                        backgroundColor: 'rgba(108, 117, 125, 0.2)',
                        fill: false,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true, suggestedMax: Math.max(...logDataCurrent.map(Number), ...logDataLast.map(Number)) * 1.2 || 10, title: { display: true, text: 'Nº de Acessos' } },
                    x: { type: 'category', title: { display: true, text: 'Dia da Semana' } }
                },
                plugins: { 
                    legend: { position: 'bottom' }
                }
            }
        });
    }
 
    // --- Gráfico Donut (Atividades por Tipo) ---
    const ctxActivity = document.getElementById('activity-type-chart').getContext('2d');
    if (ctxActivity) {
        new Chart(ctxActivity, {
            type: 'doughnut',
            data: {
                labels: activityLabels,
                datasets: [{
                    data: activityData,
                    backgroundColor: activityColors.slice(0, activityLabels.length),
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: false }
                }
            }
        });
    }
});
</script>
<script src="/js/chart.js"></script>
<script src="/js/hammer.min.js"></script>
<script src="/js/cdn.min.js"></script>
<script src="/js/chartjs-adapter-date-fns.min.js"></script>
<script src="/js/chartjs-plugin-zoom.min.js"></script>
<script src="/js/chartjs-chart-financial.min.js"></script>
<script src="/js/chartjs-plugin-annotation.min.js"></script>
<script src="/js/chartjs-plugin-streaming.min.js"></script>
