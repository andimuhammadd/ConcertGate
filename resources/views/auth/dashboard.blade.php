@extends('layouts.auth')

@section('content')
<!--  Row 1 -->
<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Bagan Penjualan Ticket</h5>
                    </div>
                    <div>
                        <select class="form-select" id="monthSelect">
                            <option value="01" {{ $selectedMonth == '01' ? 'selected' : '' }}>Januari</option>
                            <option value="02" {{ $selectedMonth == '02' ? 'selected' : '' }}>Februari</option>
                            <option value="03" {{ $selectedMonth == '03' ? 'selected' : '' }}>Maret</option>
                            <option value="04" {{ $selectedMonth == '04' ? 'selected' : '' }}>April</option>
                            <option value="05" {{ $selectedMonth == '05' ? 'selected' : '' }}>Mei</option>
                            <option value="06" {{ $selectedMonth == '06' ? 'selected' : '' }}>Juni</option>
                            <option value="07" {{ $selectedMonth == '07' ? 'selected' : '' }}>Juli</option>
                            <option value="08" {{ $selectedMonth == '08' ? 'selected' : '' }}>Agustus</option>
                            <option value="09" {{ $selectedMonth == '09' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $selectedMonth == '10' ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ $selectedMonth == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $selectedMonth == '12' ? 'selected' : '' }}>Desember</option>
                        </select>

                        <button id="filterButton">Filter</button>

                    </div>
                </div>
                <canvas id="ticketSalesChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Pendapatan Tahunan</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">Rp. {{ number_format($annualRevenue, 0, ',', '.') }}</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div id="breakup"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <!-- Monthly Earnings -->
                <div class="card">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold"> Pendapatan Bulanan </h5>
                                <h4 class="fw-semibold mb-3">Rp. {{ number_format($monthlyRevenue, 0, ',', '.') }}</h4>
                                <div class="d-flex align-items-center pb-1">
                                    <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-down-right text-danger"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                    <p class="fs-3 mb-0">last year</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-currency-dollar fs-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="earning"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Transaksi Terbaru</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Email</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Total Price</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $index => $transaction)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $index + 1 }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $transaction->email }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{ $transaction->firstname . ' ' . $transaction->lastname }}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">Rp.{{ $transaction->total_price }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        @php
                                        $badgeClass = '';
                                        switch ($transaction->status) {
                                        case 'Paid':
                                        $badgeClass = 'bg-success';
                                        break;
                                        case 'Pending':
                                        $badgeClass = 'bg-primary';
                                        break;
                                        case 'Unpaid':
                                        $badgeClass = 'bg-secondary';
                                        break;
                                        case 'Canceled':
                                        $badgeClass = 'bg-danger';
                                        break;
                                        }
                                        @endphp
                                        <span class="badge {{ $badgeClass }} rounded-3 fw-semibold">{{ $transaction->status }}</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cData = JSON.parse(`<?php echo $chartData; ?>`);

        const ctx = document.getElementById('ticketSalesChart').getContext('2d');
        const ticketSalesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: cData.labels,
                datasets: [{
                    label: 'Tickets Sold this Month',
                    data: cData.data,
                    backgroundColor: 'rgba(93, 135, 255, 0.5)',
                    borderColor: 'rgba(93, 135, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        max: Math.max(...cData.data) + 10 // Dynamic max based on data
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#adb0bb'
                        }
                    }
                }
            }
        });

        // Filter button event listener
        document.getElementById('filterButton').addEventListener('click', function() {
            const selectedMonth = document.getElementById('monthSelect').value;
            window.location.href = `?month=${selectedMonth}`; // Redirect with selected month
        });
    });
</script>
@endsection