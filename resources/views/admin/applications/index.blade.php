<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reunion Applications</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #1e293b;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            margin: 0;
            padding: 20px;
            color: var(--text);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background: var(--card);
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card);
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-info h3 {
            margin: 0;
            font-size: 0.85rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-info p {
            margin: 4px 0 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
        }

        .btn-logout {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .btn-logout:hover {
            background: #fecaca;
        }

        .card {
            background: var(--card);
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: #f1f5f9;
            padding: 16px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.95rem;
        }

        .photo-thumb {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 99px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-approved { background: #dcfce7; color: #166534; }
        .status-rejected { background: #fee2e2; color: #991b1b; }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-view { background: #f1f5f9; color: #475569; }
        .btn-view:hover { background: #e2e8f0; }
        .btn-approve { background: var(--success); color: white; }
        .btn-approve:hover { opacity: 0.9; }
        .btn-reject { background: var(--error); color: white; }
        .btn-reject:hover { opacity: 0.9; }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 30px;
            width: 90%;
            max-width: 800px;
            border-radius: 20px;
            max-height: 85vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 15px;
        }

        .close-btn {
            font-size: 1.5rem;
            cursor: pointer;
            color: #64748b;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .detail-item {
            margin-bottom: 15px;
        }

        .detail-label {
            font-size: 0.8rem;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 1rem;
            font-weight: 500;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .media-preview {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .media-preview img, .media-preview video {
            max-width: 100%;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Admin Dashboard</h1>
                <p style="margin: 5px 0 0; color: #64748b; font-size: 0.9rem;">Welcome back, {{ auth()->user()->name }}</p>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(99, 102, 241, 0.1); color: var(--primary);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="stat-info">
                    <h3>Total Apply</h3>
                    <p>{{ $totalApplications }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--success);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <div class="stat-info">
                    <h3>Approved</h3>
                    <p>{{ $approvedApplications }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--warning);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </div>
                <div class="stat-info">
                    <h3>Pending</h3>
                    <p>{{ $totalApplications - $approvedApplications - $applications->where('status', 'rejected')->count() }}</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div style="background: var(--success); color: white; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Year</th>
                            <th>Guests</th>
                            <th>Payment</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $app)
                            <tr>
                                <td>#{{ $app->id }}</td>
                                <td>
                                    @if($app->photo)
                                        <img src="{{ asset('storage/' . $app->photo) }}" class="photo-thumb" alt="Photo">
                                    @else
                                        <div class="photo-thumb" style="background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 10px;">No Image</div>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight: 600;">{{ $app->name }}</div>
                                </td>
                                <td>{{ ucfirst(str_replace('_', ' ', $app->member_type)) }}</td>
                                <td>{{ $app->graduation_year }}</td>
                                <td>{{ $app->number_of_guests }}</td>
                                <td>{{ $app->payment_method }}</td>
                                <td style="font-weight: 600;">{{ $app->donation_amount }} BDT</td>
                                <td>
                                    <span class="badge status-{{ $app->status }}">
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 8px;">
                                        <button class="btn btn-view" onclick="showDetails({{ json_encode($app) }})">View</button>
                                        
                                        @if(auth()->user()->role !== 'viewer' && $app->status == 'pending')
                                            <form action="{{ route('admin.applications.approve', $app->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                <button type="submit" class="btn btn-approve">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.applications.reject', $app->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                <button type="submit" class="btn btn-reject">Reject</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="text-align: center; padding: 40px; color: #64748b;">No applications found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalName" style="margin:0;">Application Details</h2>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            
            <div class="details-grid" id="modalBody">
                <!-- Content injected by JS -->
            </div>

            <div class="media-preview" id="modalMedia">
                <!-- Media injected by JS -->
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('detailsModal');
        const modalBody = document.getElementById('modalBody');
        const modalMedia = document.getElementById('modalMedia');
        const modalName = document.getElementById('modalName');

        function showDetails(app) {
            modalName.textContent = `Details for ${app.name}`;
            
            let html = `
                <div class="detail-item">
                    <div class="detail-label">Member Type</div>
                    <div class="detail-value">${app.member_type.replace('_', ' ').toUpperCase()}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Gender</div>
                    <div class="detail-value">${app.gender ? app.gender.toUpperCase() : 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Graduation Year</div>
                    <div class="detail-value">${app.graduation_year}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Phone</div>
                    <div class="detail-value">${app.phone || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Number of Guests</div>
                    <div class="detail-value">${app.number_of_guests}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Transaction ID</div>
                    <div class="detail-value" style="color: var(--primary); font-weight: 700;">${app.transaction_number}</div>
                </div>
                <div class="detail-item full-width">
                    <div class="detail-label">Present Address</div>
                    <div class="detail-value">${app.present_address || 'N/A'}</div>
                </div>
                <div class="detail-item full-width">
                    <div class="detail-label">Permanent Address</div>
                    <div class="detail-value">${app.permanent_address || 'N/A'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Wants to Perform?</div>
                    <div class="detail-value">${app.wants_to_perform ? 'YES' : 'NO'}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Performance Type</div>
                    <div class="detail-value">${app.performance_type || 'N/A'}</div>
                </div>
                <div class="detail-item full-width">
                    <div class="detail-label">Message to Teachers</div>
                    <div class="detail-value">${app.message_to_teachers || 'N/A'}</div>
                </div>
                <div class="detail-item full-width">
                    <div class="detail-label">Donation Message</div>
                    <div class="detail-value">${app.donation_message || 'N/A'}</div>
                </div>
                <div class="detail-item full-width">
                    <div class="detail-label">Any Question?</div>
                    <div class="detail-value">${app.message || 'N/A'}</div>
                </div>
            `;
            
            modalBody.innerHTML = html;

            let mediaHtml = '';
            if(app.photo) {
                mediaHtml += `<div><div class="detail-label">Photo</div><img src="/storage/${app.photo}"></div>`;
            }
            if(app.video) {
                mediaHtml += `<div><div class="detail-label">Video</div><video controls src="/storage/${app.video}"></video></div>`;
            }
            modalMedia.innerHTML = mediaHtml;

            modal.style.display = 'block';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>