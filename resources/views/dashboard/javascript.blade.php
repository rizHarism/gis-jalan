<script>
    $(document).ready(function() {
        // $('#dashboard').addClass('active');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
{{-- chart js --}}
<script>
    const ctx = document.getElementById('jalan-chart');
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['BAIK', 'SEDANG', 'RUSAK RINGAN', 'RUSAK BERAT'],
            datasets: [{
                label: 'My First Dataset',
                data: [15, 507, 554, 431],
                backgroundColor: [
                    '#198754',
                    '#ffc107',
                    '#fd7e14',
                    '#dc3545',
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                labels: {
                    // render: 'value',
                    fontSize: 14
                },
                legend: {
                    position: 'bottom',
                    // align: 'start',
                    labels: {
                        font: {
                            size: 14,
                        },
                        padding: 30,
                    }
                },
            }
            // option of cart
        }
    });
</script>
