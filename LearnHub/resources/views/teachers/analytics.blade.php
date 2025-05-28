@extends('layouts.app')

@section('title', 'Báo cáo thống kê - LearnHub')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Báo cáo thống kê</h1>
    </div>
    
    <div class="row g-4">
        <!-- Thống kê học viên -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white p-4 border-0">
                    <h4 class="fw-semibold mb-0">Thống kê đăng ký khóa học</h4>
                </div>
                <div class="card-body p-4">
                    <canvas id="enrollmentChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Tiến độ khóa học -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white p-4 border-0">
                    <h4 class="fw-semibold mb-0">Tiến độ học tập</h4>
                </div>
                <div class="card-body p-4">
                    <canvas id="progressChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Thông tin chi tiết -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white p-4 border-0">
                    <h4 class="fw-semibold mb-0">Chi tiết theo khóa học</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 ps-4">Khóa học</th>
                                    <th class="py-3 text-center">Số học viên</th>
                                    <th class="py-3 text-center">Tiến độ trung bình</th>
                                    <th class="py-3 text-center">Tỷ lệ hoàn thành</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($progressStats as $stat)
                                    <tr>
                                        <td class="ps-4">{{ $stat->course }}</td>
                                        <td class="text-center">{{ $stat->total_count }}</td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="progress flex-grow-1 me-2" style="height: 6px; max-width: 100px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" 
                                                         style="width: {{ $stat->avg_progress }}%" 
                                                         aria-valuenow="{{ $stat->avg_progress }}" 
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span>{{ number_format($stat->avg_progress, 1) }}%</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($stat->total_count > 0)
                                                {{ number_format(($stat->completed_count / $stat->total_count) * 100, 1) }}%
                                                <span class="text-muted">({{ $stat->completed_count }}/{{ $stat->total_count }})</span>
                                            @else
                                                0%
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <p class="text-muted mb-0">Chưa có dữ liệu thống kê</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dữ liệu cho biểu đồ đăng ký
        const enrollmentData = @json($enrollmentStats);
        
        // Dữ liệu cho biểu đồ tiến độ
        const progressData = @json($progressStats);
        
        // Biểu đồ đăng ký
        if (document.getElementById('enrollmentChart')) {
            const enrollmentDates = enrollmentData.map(item => item.date);
            const enrollmentCounts = enrollmentData.map(item => item.count);
            
            new Chart(document.getElementById('enrollmentChart'), {
                type: 'line',
                data: {
                    labels: enrollmentDates,
                    datasets: [{
                        label: 'Số học viên đăng ký',
                        data: enrollmentCounts,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }
        
        // Biểu đồ tiến độ
        if (document.getElementById('progressChart')) {
            const courseNames = progressData.map(item => item.course);
            const avgProgress = progressData.map(item => item.avg_progress);
            
            new Chart(document.getElementById('progressChart'), {
                type: 'bar',
                data: {
                    labels: courseNames,
                    datasets: [{
                        label: 'Tiến độ trung bình (%)',
                        data: avgProgress,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        }
    });
</script>
@endsection 