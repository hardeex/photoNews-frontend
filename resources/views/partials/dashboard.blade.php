<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard - Essential Nigeria News</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.1/apexcharts.min.js"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-gray-800">Essential Nigeria News</h1>
                        <span
                            class="ml-4 px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">Analytics</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <select id="date-range" class="bg-white border border-gray-300 rounded-md px-3 py-2 text-sm">
                            <option value="7">Last 7 days</option>
                            <option value="30" selected>Last 30 days</option>
                            <option value="90">Last 3 months</option>
                            <option value="365">Last year</option>
                        </select>
                        <button id="export-btn"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm transition">
                            Export Data
                        </button>
                        <a href="/dashboard" class="text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-6">
            <!-- Top Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 text-sm font-medium">Total Pageviews</h3>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">+24%</span>
                    </div>
                    <div class="flex items-baseline">
                        <p class="text-3xl font-bold text-gray-800">1,248,579</p>
                        <p class="ml-2 text-sm text-gray-500">views</p>
                    </div>
                    <div id="pageviews-trend" class="mt-4 h-16"></div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 text-sm font-medium">Unique Visitors</h3>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">+18%</span>
                    </div>
                    <div class="flex items-baseline">
                        <p class="text-3xl font-bold text-gray-800">428,962</p>
                        <p class="ml-2 text-sm text-gray-500">visitors</p>
                    </div>
                    <div id="visitors-trend" class="mt-4 h-16"></div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 text-sm font-medium">Avg. Time on Site</h3>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">+5%</span>
                    </div>
                    <div class="flex items-baseline">
                        <p class="text-3xl font-bold text-gray-800">4:32</p>
                        <p class="ml-2 text-sm text-gray-500">minutes</p>
                    </div>
                    <div id="time-trend" class="mt-4 h-16"></div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-500 text-sm font-medium">Bounce Rate</h3>
                        <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">+2%</span>
                    </div>
                    <div class="flex items-baseline">
                        <p class="text-3xl font-bold text-gray-800">32.4%</p>
                        <p class="ml-2 text-sm text-gray-500">rate</p>
                    </div>
                    <div id="bounce-trend" class="mt-4 h-16"></div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Traffic Overview</h3>
                    <div class="h-80">
                        <canvas id="traffic-chart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Top Content Categories</h3>
                    <div class="h-80">
                        <canvas id="categories-chart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Charts Row 2 -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">User Devices</h3>
                    <div class="h-64">
                        <canvas id="devices-chart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Traffic Sources</h3>
                    <div class="h-64">
                        <canvas id="sources-chart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">User Engagement</h3>
                    <div class="h-64">
                        <canvas id="engagement-chart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Demographics and Location -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Demographics</h3>
                        <select class="bg-white border border-gray-300 rounded-md px-2 py-1 text-sm">
                            <option>Age</option>
                            <option>Gender</option>
                            <option>Interest</option>
                        </select>
                    </div>
                    <div class="h-80">
                        <canvas id="demographics-chart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Visitor Locations</h3>
                        <select class="bg-white border border-gray-300 rounded-md px-2 py-1 text-sm">
                            <option>Top 10</option>
                            <option>All</option>
                        </select>
                    </div>
                    <div class="h-80">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        State</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Visitors</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        % of Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Lagos
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">98,450
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">23.4%</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Abuja
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">75,320
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">17.9%</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Port
                                        Harcourt</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">42,760
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">10.2%</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Kano</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">38,120
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">9.1%</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Enugu
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">29,450
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">7.0%</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Ibadan
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">25,800
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">6.1%</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Benin
                                        City</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">19,750
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">4.7%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top Articles Table -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Top Performing Articles</h3>
                    <select class="bg-white border border-gray-300 rounded-md px-2 py-1 text-sm">
                        <option>By Views</option>
                        <option>By Engagement</option>
                        <option>By Shares</option>
                    </select>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Article Title</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Author</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Views</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Avg. Time</th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Shares</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                    Nigeria Announces New Economic Policy Framework</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Politics</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Adesola Johnson</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">58,932</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">5:22</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">12,450</td>
                            </tr>
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                    Super Eagles Qualify for African Cup Finals</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sports</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Chukwudi Okonkwo</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">45,271</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">4:18</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">9,825</td>
                            </tr>
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                    Nigerian Tech Startup Secures $5M Funding</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Business</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Funmi Adeyemi</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">42,158</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">6:05</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">8,753</td>
                            </tr>
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                    Major Infrastructure Project Launches in Lagos</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Development</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Oluwaseun Afolabi</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">39,540</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">4:47</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">7,921</td>
                            </tr>
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 hover:text-blue-800">
                                    Nollywood Film Wins International Award</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Entertainment</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Chioma Okafor</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">35,682</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">3:58</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">15,423</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mini Trend Charts for KPIs
            const createAreaChart = (elementId, data, color) => {
                const options = {
                    series: [{
                        name: 'Trend',
                        data: data
                    }],
                    chart: {
                        type: 'area',
                        height: 60,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: true
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.3,
                        }
                    },
                    colors: [color]
                };

                const chart = new ApexCharts(document.getElementById(elementId), options);
                chart.render();
            };

            // Create mini trend charts
            createAreaChart('pageviews-trend', [1200000, 1150000, 1180000, 1220000, 1190000, 1210000, 1248579],
                '#3b82f6');
            createAreaChart('visitors-trend', [380000, 395000, 410000, 405000, 420000, 415000, 428962], '#10b981');
            createAreaChart('time-trend', [4.1, 4.2, 4.3, 4.2, 4.4, 4.3, 4.5], '#8b5cf6');
            createAreaChart('bounce-trend', [33.2, 32.9, 32.7, 33.0, 32.5, 32.8, 32.4], '#ef4444');

            // Traffic Overview Chart
            const trafficCtx = document.getElementById('traffic-chart').getContext('2d');
            const trafficChart = new Chart(trafficCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    datasets: [{
                            label: 'This Year',
                            data: [65000, 75000, 92000, 81000, 99000, 105000, 110000, 115000, 120000,
                                130000, 140000, 145000
                            ],
                            fill: false,
                            borderColor: '#3b82f6',
                            tension: 0.1
                        },
                        {
                            label: 'Last Year',
                            data: [45000, 55000, 62000, 71000, 79000, 85000, 90000, 95000, 100000,
                                110000, 115000, 120000
                            ],
                            fill: false,
                            borderColor: '#d1d5db',
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return (value / 1000000).toFixed(1) + 'M';
                                    } else if (value >= 1000) {
                                        return (value / 1000).toFixed(0) + 'K';
                                    }
                                    return value;
                                }
                            }
                        }
                    }
                }
            });

            // Categories Chart
            const categoriesCtx = document.getElementById('categories-chart').getContext('2d');
            const categoriesChart = new Chart(categoriesCtx, {
                type: 'bar',
                data: {
                    labels: ['Politics', 'Business', 'Sports', 'Entertainment', 'Technology', 'Health',
                        'Education'
                    ],
                    datasets: [{
                        label: 'Page Views',
                        data: [320000, 250000, 290000, 180000, 120000, 90000, 70000],
                        backgroundColor: [
                            '#3b82f6',
                            '#10b981',
                            '#f59e0b',
                            '#8b5cf6',
                            '#ec4899',
                            '#ef4444',
                            '#6366f1'
                        ]
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
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return (value / 1000000).toFixed(1) + 'M';
                                    } else if (value >= 1000) {
                                        return (value / 1000).toFixed(0) + 'K';
                                    }
                                    return value;
                                }
                            }
                        }
                    }
                }
            });

            // Devices Chart
            const devicesCtx = document.getElementById('devices-chart').getContext('2d');
            const devicesChart = new Chart(devicesCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Mobile', 'Desktop', 'Tablet'],
                    datasets: [{
                        data: [65, 28, 7],
                        backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    cutout: '65%'
                }
            });

            // Sources Chart
            const sourcesCtx = document.getElementById('sources-chart').getContext('2d');
            const sourcesChart = new Chart(sourcesCtx, {
                type: 'pie',
                data: {
                    labels: ['Direct', 'Organic Search', 'Social Media', 'Referral', 'Email'],
                    datasets: [{
                        data: [25, 40, 20, 10, 5],
                        backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Engagement Chart
            const engagementCtx = document.getElementById('engagement-chart').getContext('2d');
            const engagementChart = new Chart(engagementCtx, {
                type: 'radar',
                data: {
                    labels: ['Reading', 'Commenting', 'Sharing', 'Return Rate', 'Subscription'],
                    datasets: [{
                        label: 'Current Period',
                        data: [85, 60, 70, 75, 50],
                        fill: true,
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        borderColor: '#3b82f6',
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#3b82f6'
                    }, {
                        label: 'Previous Period',
                        data: [70, 55, 60, 65, 40],
                        fill: true,
                        backgroundColor: 'rgba(209, 213, 219, 0.2)',
                        borderColor: '#d1d5db',
                        pointBackgroundColor: '#d1d5db',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#d1d5db'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    elements: {
                        line: {
                            borderWidth: 2
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        r: {
                            angleLines: {
                                display: true
                            },
                            suggestedMin: 0,
                            suggestedMax: 100
                        }
                    }
                }
            });

            // Demographics Chart (Completed)
            const demographicsCtx = document.getElementById('demographics-chart').getContext('2d');
            const demographicsChart = new Chart(demographicsCtx, {
                type: 'bar',
                data: {
                    labels: ['18-24', '25-34', '35-44', '45-54', '55-64', '65+'],
                    datasets: [{
                        label: 'Male',
                        data: [10, 25, 15, 8, 5, 2], // Percentage of total visitors
                        backgroundColor: '#3b82f6',
                        borderWidth: 1
                    }, {
                        label: 'Female',
                        data: [12, 28, 18, 10, 6, 3], // Percentage of total visitors
                        backgroundColor: '#ec4899',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.raw}%`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Age Group'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Percentage of Visitors (%)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
