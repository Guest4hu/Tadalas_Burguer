<?php
// Exemplo: depois você coloca suas queries aqui
$labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$datapoints = [0, 20, 20, 60, 60, 120, 180, 120, 125, 105, 110, 170];
?>

<script>
const labels = <?php echo json_encode($labels); ?>;
const datapoints = <?php echo json_encode($datapoints); ?>;

// O restante do seu código permanece igual
const data = {
    labels: labels,
    datasets: [
        {
            label: 'Cubic interpolation (monotone)',
            data: datapoints,
            borderColor: Utils.CHART_COLORS.red,
            fill: false,
            cubicInterpolationMode: 'monotone',
            tension: 0.4
        }, {
            label: 'Cubic interpolation',
            data: datapoints,
            borderColor: Utils.CHART_COLORS.blue,
            fill: false,
            tension: 0.4
        }, {
            label: 'Linear interpolation (default)',
            data: datapoints,
            borderColor: Utils.CHART_COLORS.green,
            fill: false
        }
    ]
};

// ... resto do script
</script>
