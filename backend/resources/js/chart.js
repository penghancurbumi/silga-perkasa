let salesChartInstance = null;

function initSalesChart() {
    const canvas = document.getElementById("salesChart");

    // Jika canvas tidak ada, hentikan
    if (!canvas) return;

    // Hancurkan instance sebelumnya jika ada (penting saat navigasi wire:navigate)
    if (salesChartInstance) {
        salesChartInstance.destroy();
        salesChartInstance = null;
    }

    // Ambil data dari atribut data-* yang di-pass dari blade
    const rawLabels = canvas.dataset.labels;
    const rawData = canvas.dataset.values;

    const labels = rawLabels ? JSON.parse(rawLabels) : ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
    const values = rawData ? JSON.parse(rawData) : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    salesChartInstance = new Chart(canvas, {
        type: "line",
        data: {
            labels,
            datasets: [
                {
                    label: "Konten",
                    data: values,
                    borderColor: "#10b981",
                    backgroundColor: "rgba(16,185,129,0.12)",
                    pointBackgroundColor: "#10b981",
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: "lowongan",
                    data: values,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(16,185,129,0.12)',
                    pointBackgroundColor: "#10b981",
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'lamaran',
                    data: values,
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245,158,11,0.10',
                    pointBackgroundColor: "#f59e0b",
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: '#1e293b',
                    titleColor: '#94a3b8',
                    bodyColor: '#f1f5f9',
                    padding: 10,
                    cornerRadius: 8
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { size: 11 } }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 11 },
                        stepSize: 1,
                        precision: 0
                    },
                    grid: { color: 'rgba(148,163,184,0.12)' }
                }
            }
        }
    });
}

// Update chart data tanpa destroy (lebih smooth)
function updateSalesChart(labels, values) {
    if (!salesChartInstance) {
        initSalesChart();
        return;
    }
    salesChartInstance.data.labels = labels;
    salesChartInstance.data.datasets.forEach(dataset => {
        dataset.data = values;
    });
    salesChartInstance.update('active');
}

// Saat pertama load
document.addEventListener('DOMContentLoaded', initSalesChart);

// Saat navigasi via wire:navigate
document.addEventListener('livewire:navigated', initSalesChart);

// Terima data chart baru dari Livewire dispatch saat period berubah
document.addEventListener('livewire:init', () => {
    Livewire.on('chart-updated', ({ labels, values }) => {
        updateSalesChart(labels, values);
    });
});
