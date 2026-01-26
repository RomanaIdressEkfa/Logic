<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Profile</title>
    
    <!-- Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;700&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-red: #ef233c;
            --dark-bg: #050505;
            --card-bg: #0f0f0f;
            --border-color: #222;
        }

        body {
            background-color: var(--dark-bg);
            color: white;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding-top: 100px; /* Space for Navbar */
            min-height: 100vh;
        }

        h1, h2, h3, h4 { font-family: 'Space Grotesk', sans-serif; }

        /* Profile Header */
        .profile-header-card {
            background: linear-gradient(180deg, rgba(20,20,20,0.8) 0%, rgba(5,5,5,0.9) 100%);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 40px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }
        
        .avatar-circle {
            width: 120px; height: 120px;
            border-radius: 50%;
            border: 3px solid var(--primary-red);
            object-fit: cover;
            box-shadow: 0 0 30px rgba(239, 35, 60, 0.2);
        }

        .role-badge {
            background: rgba(239, 35, 60, 0.1);
            color: var(--primary-red);
            border: 1px solid var(--primary-red);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* Stat Boxes */
        .stat-card {
            background: #111;
            border: 1px solid #222;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: 0.3s;
        }
        .stat-card:hover { border-color: var(--primary-red); transform: translateY(-5px); }
        .stat-value { font-size: 2rem; font-weight: 800; color: white; }
        .stat-label { color: #666; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; }

        /* Debate History List */
        .history-item {
            background: #0f0f0f;
            border: 1px solid #222;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: 0.3s;
        }
        .history-item:hover { background: #151515; border-color: #333; }
        
        .win-indicator { color: #2ecc71; font-weight: bold; font-size: 0.9rem; }
        .loss-indicator { color: #e74c3c; font-weight: bold; font-size: 0.9rem; }

        .btn-logout {
            background: transparent;
            border: 1px solid #333;
            color: #888;
            padding: 8px 20px;
            border-radius: 50px;
            transition: 0.3s;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-logout:hover { border-color: var(--primary-red); color: white; background: rgba(239,35,60,0.1); }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-header-card { text-align: center; }
            .header-content { flex-direction: column; gap: 20px; }
            .history-item { flex-direction: column; align-items: flex-start; gap: 15px; }
            .history-meta { width: 100%; display: flex; justify-content: space-between; }
        }
    </style>
</head>
<body>

    @include('frontend.shared.navbar')

    <div class="container py-5">
        
        <!-- 1. Profile Header -->
        <div class="profile-header-card mb-5">
            <div class="d-flex align-items-center justify-content-between header-content">
                <div class="d-flex align-items-center gap-4 header-content">
                    <img src="https://i.pravatar.cc/150?u={{ $user->id }}" alt="User Avatar" class="avatar-circle">
                    <div>
                        <div class="mb-2">
                            <span class="role-badge">{{ str_replace('_', ' ', $user->role) }}</span>
                        </div>
                        <h1 class="fw-bold m-0">{{ $user->name }}</h1>
                        <p class="text-secondary m-0">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="mt-3 mt-md-0">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt me-2"></i> Log Out
                    </button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            <!-- 2. Left Column: Stats -->
            <div class="col-lg-4">
                <h4 class="mb-4">Performance Stats</h4>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="stat-card">
                            <div class="stat-value">12</div>
                            <div class="stat-label">Debates</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card">
                            <div class="stat-value text-danger">85%</div>
                            <div class="stat-label">Win Rate</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="stat-card">
                            <div class="stat-value">4,250</div>
                            <div class="stat-label">Logic XP</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-4 rounded-3 border border-secondary bg-dark bg-opacity-25">
                    <h5 class="fw-bold mb-3"><i class="fas fa-medal text-warning me-2"></i> Achievements</h5>
                    <span class="badge bg-secondary me-1 mb-1">First Blood</span>
                    <span class="badge bg-secondary me-1 mb-1">Logician</span>
                    <span class="badge bg-secondary me-1 mb-1">5 Streak</span>
                </div>
            </div>

            <!-- 3. Right Column: History -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="m-0">Recent Activity</h4>
                    <a href="#" class="text-secondary small text-decoration-none">View All</a>
                </div>

                <!-- History Item 1 -->
                <div class="history-item">
                    <div>
                        <small class="text-secondary d-block mb-1">VS @Athena_Wisdom</small>
                        <h5 class="fw-bold m-0">"Is AI Consciousness Possible?"</h5>
                    </div>
                    <div class="history-meta text-end">
                        <div class="win-indicator mb-1">VICTORY (+150 XP)</div>
                        <small class="text-secondary">2 hours ago</small>
                    </div>
                </div>

                <!-- History Item 2 -->
                <div class="history-item">
                    <div>
                        <small class="text-secondary d-block mb-1">VS @SocratesReborn</small>
                        <h5 class="fw-bold m-0">"Universal Basic Income Economic Impact"</h5>
                    </div>
                    <div class="history-meta text-end">
                        <div class="loss-indicator mb-1">DEFEAT (-20 XP)</div>
                        <small class="text-secondary">Yesterday</small>
                    </div>
                </div>

                <!-- History Item 3 -->
                <div class="history-item">
                    <div>
                        <small class="text-secondary d-block mb-1">VS @LogicMaster</small>
                        <h5 class="fw-bold m-0">"Crypto Regulation Necessity"</h5>
                    </div>
                    <div class="history-meta text-end">
                        <div class="win-indicator mb-1">VICTORY (+200 XP)</div>
                        <small class="text-secondary">3 days ago</small>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('frontend.shared.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>