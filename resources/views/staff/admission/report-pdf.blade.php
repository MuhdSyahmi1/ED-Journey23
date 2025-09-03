<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Profile Applications Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 12px;
        }
        
        .report-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        
        .report-info p {
            margin: 5px 0;
            font-size: 11px;
        }
        
        .statistics {
            margin-bottom: 30px;
            display: table;
            width: 100%;
        }
        
        .stat-item {
            display: table-cell;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
        }
        
        .stat-number {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        
        .stat-label {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
        }
        
        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-verified {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .footer {
            position: fixed;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>USER PROFILE APPLICATIONS REPORT</h1>
        <p>Generated on {{ now()->format('F d, Y \a\t h:i A') }}</p>
    </div>

    <div class="report-info">
        <p><strong>Report Details:</strong></p>
        @if(request('search'))
            <p>Search Filter: "{{ request('search') }}"</p>
        @endif
        @if(request('status'))
            <p>Status Filter: {{ ucfirst(request('status')) }}</p>
        @endif
        <p>Total Records: {{ $reportData->count() }}</p>
    </div>

    @php
        $totalApplications = $reportData->count();
        $verifiedApplications = $reportData->where('verification_status', 'verified')->count();
        $pendingApplications = $reportData->where('verification_status', 'pending')->count();
        $rejectedApplications = $reportData->where('verification_status', 'rejected')->count();
    @endphp

    <div class="statistics">
        <div class="stat-item">
            <div class="stat-number">{{ $totalApplications }}</div>
            <div class="stat-label">Total Applications</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $verifiedApplications }}</div>
            <div class="stat-label">Verified</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $pendingApplications }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $rejectedApplications }}</div>
            <div class="stat-label">Rejected</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30%;">Full Name</th>
                <th style="width: 20%;">Application Date</th>
                <th style="width: 20%;">Application Status</th>
                <th style="width: 30%;">Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reportData as $application)
                <tr>
                    <td>{{ $application->full_name }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($application->application_date)->format('M d, Y') }}<br>
                        <small style="color: #666;">{{ \Carbon\Carbon::parse($application->application_date)->format('h:i A') }}</small>
                    </td>
                    <td>
                        @if($application->verification_status === 'verified')
                            <span class="status-badge status-verified">Verified</span>
                        @elseif($application->verification_status === 'rejected')
                            <span class="status-badge status-rejected">Rejected</span>
                        @else
                            <span class="status-badge status-pending">Pending</span>
                        @endif
                    </td>
                    <td>{{ $application->email_address }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px;">
                        No applications found matching the specified criteria.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>This report was generated from the ED-journey User Profile Management System</p>
    </div>
</body>
</html>