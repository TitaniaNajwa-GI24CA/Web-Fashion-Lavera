</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    if(document.getElementById('salesChart')){

        const ctx = document.getElementById('salesChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Penjualan',
                    data: salesValues,
                    tension: 0.45,
                    fill: true,
                    borderWidth: 3,
                    borderColor: '#d96f94',
                    backgroundColor: 'rgba(255, 182, 193, 0.22)',
                    pointBackgroundColor: '#d96f94',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(210,150,165,.18)'
                        },
                        ticks: {
                            callback: function(value){
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function(){

        const openBtn = document.getElementById("openAdminProfileModal");
        const closeBtn = document.getElementById("closeAdminProfileModal");
        const modal = document.getElementById("adminProfileModal");

        if(openBtn && closeBtn && modal){
            openBtn.addEventListener("click", function(e){
                e.preventDefault();
                modal.classList.add("active");
            });

            closeBtn.addEventListener("click", function(){
                modal.classList.remove("active");
            });

            modal.addEventListener("click", function(e){
                if(e.target === modal){
                    modal.classList.remove("active");
                }
            });
        }

    });
</script>
<script src="<?= base_url('assets/js/pop-up.js'); ?>"></script>
</body>
</html>