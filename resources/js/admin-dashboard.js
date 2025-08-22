// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Manager Status Chart
    const ctx1 = document.getElementById('managerStatusChart').getContext('2d');
    new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ['Active Manager', 'Inactive Manager'],
            datasets: [{
                data: [1, 0],
                backgroundColor: ['#28a745', '#dc3545'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // We're using custom legend below
                }
            }
        }
    });

    // Manager Roles Chart
    const ctx2 = document.getElementById('managerRolesChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Programme Manager', 'Admission Manager', 'Both'],
            datasets: [{
                data: [0, 0, 1],
                backgroundColor: ['#007bff', '#ffc107', '#28a745'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Upload Case Chart
    const ctx3 = document.getElementById('uploadCaseChart').getContext('2d');
    new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: ['No Data Available'],
            datasets: [{
                data: [1],
                backgroundColor: ['#c0c4cc'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});