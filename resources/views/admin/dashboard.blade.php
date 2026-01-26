<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Logically Debate</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-red: #ef233c;
            --dark-black: #050505;
            --light-bg: #f3f4f6;
            --sidebar-width: 260px; /* Reduced from 290px for better proportion */
            --header-height: 70px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            font-size: 0.925rem; /* Standardized Base Font Size */
            color: #374151;
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid #e5e7eb;
            z-index: 1050;
            padding-top: 20px;
            overflow-y: auto;
            transition: all 0.3s ease-in-out;
        }

        /* Brand */
        .brand-section {
            padding: 0 25px 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .brand-section h3 {
            font-weight: 800;
            font-size: 1.25rem; /* Fixed Size */
            color: var(--dark-black);
            margin: 0;
        }
        .brand-section span { color: var(--primary-red); }

        /* Menu Items */
        .menu-category {
            font-size: 0.7rem;
            color: #9ca3af;
            font-weight: 700;
            text-transform: uppercase;
            padding: 20px 25px 10px;
            letter-spacing: 0.5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 25px; /* Reduced padding */
            color: #555;
            font-weight: 500;
            font-size: 0.95rem; /* Fixed Size */
            text-decoration: none;
            transition: all 0.2s;
            border-left: 4px solid transparent;
            margin-bottom: 2px;
        }

        .nav-link i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 10px;
            color: #9ca3af;
            transition: color 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            background-color: #fff0f1;
            color: var(--primary-red);
        }
        .nav-link.active {
            border-left-color: var(--primary-red);
            font-weight: 600;
        }
        .nav-link:hover i, .nav-link.active i { color: var(--primary-red); }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 25px 30px;
            transition: all 0.3s ease-in-out;
            min-height: 100vh;
        }

        /* Top Header */
        .top-header {
            background: white;
            padding: 15px 25px;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            border: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .toggle-btn {
            display: none; /* Hidden on desktop */
            background: none; border: none; font-size: 1.4rem; color: #374151;
            cursor: pointer; margin-right: 15px;
        }

        .visit-btn {
            background: #f3f4f6; color: #374151; border: none; padding: 8px 16px;
            border-radius: 8px; font-size: 0.85rem; font-weight: 600;
            display: flex; align-items: center; gap: 8px; text-decoration: none;
        }

        .admin-badge {
            background: var(--dark-black); color: white; padding: 6px 15px;
            border-radius: 8px; display: flex; align-items: center; gap: 10px;
        }

        /* Welcome Section */
        .welcome-text h2 { font-weight: 800; font-size: 1.6rem; color: #111; margin-bottom: 5px; }
        .welcome-text span { color: var(--primary-red); }
        .welcome-sub { color: #6b7280; margin-bottom: 30px; font-size: 0.95rem; }

        /* --- CARDS (Optimized) --- */
        .stat-card {
            border-radius: 16px;
            padding: 25px;
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            transition: transform 0.2s;
            min-height: 160px;
        }
        .stat-card:hover { transform: translateY(-3px); }

        /* Card Styles */
        .card-red { background: var(--primary-red); color: white; }
        .card-red .icon-box { background: rgba(255,255,255,0.2); }
        .card-black { background: var(--dark-black); color: white; }
        .card-black .icon-box { background: rgba(255,255,255,0.1); }
        .card-white { background: white; color: #111; border: 1px solid #e5e7eb; }
        .card-white .icon-box { background: #fff0f1; color: var(--primary-red); }
        .card-dark { background: #374151; color: white; }
        .card-dark .icon-box { background: rgba(255,255,255,0.1); }

        /* Typography inside cards (Reduced) */
        .stat-card h3 { font-size: 1.8rem; font-weight: 700; margin-top: 10px; margin-bottom: 2px; }
        .stat-card p { font-size: 0.8rem; text-transform: uppercase; font-weight: 600; opacity: 0.9; margin: 0; }
        .stat-card small { font-size: 0.75rem; }

        .icon-box {
            width: 45px; height: 45px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; position: absolute; top: 20px; right: 20px;
        }

        /* --- TABLES & CONTENT --- */
        .content-section {
            background: white; border-radius: 16px; padding: 25px;
            border: 1px solid #e5e7eb; height: 100%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }

        .section-title { font-weight: 700; font-size: 1.1rem; margin-bottom: 20px; color: #111; }
        .view-all { color: var(--primary-red); font-size: 0.85rem; font-weight: 600; text-decoration: none; float: right; }

        .custom-table th { font-size: 0.75rem; text-transform: uppercase; color: #9ca3af; font-weight: 700; padding-bottom: 12px; border-bottom: 1px solid #f3f4f6; }
        .custom-table td { padding: 15px 0; vertical-align: middle; font-size: 0.9rem; border-bottom: 1px solid #f9fafb; }
        
        .cat-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 15px; background: #f9fafb; border-radius: 10px; margin-bottom: 12px;
            transition: 0.2s; cursor: pointer;
        }
        .cat-item:hover { background: #fff0f1; }
        .cat-icon {
            width: 40px; height: 40px; background: white; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            margin-right: 12px; color: var(--primary-red); font-size: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        /* --- RESPONSIVE CSS (The Fix) --- */
        @media (max-width: 991px) {
            .sidebar { left: -260px; } /* Hide Sidebar */
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0,0,0,0.1); }
            
            .main-content { margin-left: 0; padding: 20px; }
            
            .toggle-btn { display: block; } /* Show Hamburger */
            
            .top-header { flex-direction: row; padding: 15px; margin-bottom: 20px; }
            .visit-btn span { display: none; } /* Hide text on small screens */
            
            .stat-card { min-height: 140px; padding: 20px; }
            .stat-card h3 { font-size: 1.5rem; }
            
            /* Overlay when sidebar open */
            .overlay {
                display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(0,0,0,0.5); z-index: 1040;
            }
            .overlay.active { display: block; }
        }

        @media (max-width: 576px) {
            .welcome-text h2 { font-size: 1.4rem; }
            .admin-badge span { display: none; } /* Hide "Super Admin" text on very small screens */
            .section-title { font-size: 1rem; }
        }
    </style>
</head>
<body>

    <!-- Overlay for Mobile -->
    <div class="overlay" onclick="toggleSidebar()"></div>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <!-- Brand -->
        <div class="brand-section">
            <i class="fas fa-brain fa-lg" style="color: var(--primary-red);"></i>
            <h3>Logically Debate
                
            </h3>
        </div>

        <!-- Menu -->
        <div class="menu-category">Analytics</div>
        <a href="#" class="nav-link active">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <div class="menu-category">Debate & Topics</div>
        <a href="#" class="nav-link">
            <i class="fas fa-comments"></i> All Debates
        </a>
        <a href="#" class="nav-link">
            <i class="fas fa-layer-group"></i> Categories
        </a>
        <a href="#" class="nav-link">
            <i class="fas fa-tags"></i> Tags & Keywords
        </a>

        <div class="menu-category">Community</div>
        <a href="#" class="nav-link">
            <i class="fas fa-users"></i> Users List
        </a>
        <a href="#" class="nav-link">
            <i class="fas fa-gavel"></i> Reports
        </a>

        <div class="menu-category">Configuration</div>
        <a href="#" class="nav-link">
            <i class="fas fa-cog"></i> System Settings
        </a>
        
        <!-- Logout -->
        <div style="margin-top: 30px; padding: 0 25px 25px;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn w-100 py-2 fw-bold text-white d-flex align-items-center justify-content-center gap-2" 
                        style="background: var(--dark-black); border-radius: 10px; font-size: 0.9rem;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- Top Header -->
        <div class="top-header">
            <div class="d-flex align-items-center">
                <!-- Toggle Button (Visible on Mobile) -->
                <button class="toggle-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>

                <a href="{{ route('home') }}" target="_blank" class="visit-btn">
                    <i class="fas fa-globe"></i> <span>Visit Website</span>
                </a>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="position-relative" style="cursor: pointer;">
                    <i class="far fa-bell fa-lg text-secondary"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                </div>
                
                <div class="admin-badge">
                    <div class="fw-bold">LD</div>
                    <div class="d-flex flex-column" style="line-height: 1.1;">
                        <small style="font-size: 0.6rem; opacity: 0.8; letter-spacing: 0.5px;">HELLO,</small>
                        <span style="font-size: 0.85rem; font-weight: 600;">Super Admin</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Greeting -->
        <div class="welcome-text">
            <h2>Good Morning, <span>Admin!</span> 👋</h2>
            <p class="welcome-sub">Here's what's happening on the debate platform today.</p>
        </div>

        <!-- Cards Row -->
        <div class="row g-3 g-xl-4 mb-4">
            <!-- Card 1 -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card card-red">
                    <p>Total Debates</p>
                    <h3>1,254</h3>
                    <div class="icon-box"><i class="fas fa-fire"></i></div>
                    <small><i class="fas fa-arrow-up"></i> +12.5% this month</small>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card card-black">
                    <p>Active Users</p>
                    <h3>850</h3>
                    <div class="icon-box"><i class="fas fa-user-check"></i></div>
                    <small style="color: #4ade80;"><i class="fas fa-circle" style="font-size: 6px; margin-bottom: 2px;"></i> Online Now</small>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card card-white">
                    <p style="color: #6b7280;">Pending Reports</p>
                    <h3>12</h3>
                    <div class="icon-box"><i class="fas fa-flag"></i></div>
                    <small class="text-danger fw-bold">Needs Attention</small>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card card-dark">
                    <p>Categories</p>
                    <h3>66</h3>
                    <div class="icon-box"><i class="fas fa-folder"></i></div>
                    <small>Active Sections</small>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="row g-4">
            <!-- Table -->
            <div class="col-lg-12 col-xl-8">
                <div class="content-section">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="section-title m-0">Recently Added Debates</h5>
                        <a href="#" class="view-all">View All</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table custom-table table-borderless align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="min-width: 200px;">TOPIC NAME</th>
                                    <th>CREATOR</th>
                                    <th>STATUS</th>
                                    <th class="text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-robot text-dark"></i>
                                            </div>
                                            <span class="fw-bold text-dark" style="font-size: 0.9rem;">AI vs Human Creativity</span>
                                        </div>
                                    </td>
                                    <td>Dr. A. Smith</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill fw-normal">Published</span></td>
                                    <td class="text-end"><button class="btn btn-sm btn-light text-secondary"><i class="fas fa-ellipsis-v"></i></button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-globe-americas text-dark"></i>
                                            </div>
                                            <span class="fw-bold text-dark" style="font-size: 0.9rem;">Climate Change Policy</span>
                                        </div>
                                    </td>
                                    <td>Sarah Connor</td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill fw-normal">Pending</span></td>
                                    <td class="text-end"><button class="btn btn-sm btn-light text-secondary"><i class="fas fa-ellipsis-v"></i></button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 40px; height: 40px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-bitcoin text-dark"></i>
                                            </div>
                                            <span class="fw-bold text-dark" style="font-size: 0.9rem;">Future of Crypto</span>
                                        </div>
                                    </td>
                                    <td>Elon M.</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill fw-normal">Published</span></td>
                                    <td class="text-end"><button class="btn btn-sm btn-light text-secondary"><i class="fas fa-ellipsis-v"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-lg-12 col-xl-4">
                <div class="content-section">
                    <h5 class="section-title">Top Categories</h5>
                    
                    <div class="cat-item">
                        <div class="d-flex align-items-center">
                            <div class="cat-icon"><i class="fas fa-balance-scale"></i></div>
                            <div>
                                <div class="fw-bold text-dark" style="font-size: 0.9rem;">Politics</div>
                                <small class="text-muted" style="font-size: 0.75rem;">81 Debates</small>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-muted small"></i>
                    </div>

                    <div class="cat-item">
                        <div class="d-flex align-items-center">
                            <div class="cat-icon"><i class="fas fa-microchip"></i></div>
                            <div>
                                <div class="fw-bold text-dark" style="font-size: 0.9rem;">Technology</div>
                                <small class="text-muted" style="font-size: 0.75rem;">68 Debates</small>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-muted small"></i>
                    </div>

                    <div class="cat-item">
                        <div class="d-flex align-items-center">
                            <div class="cat-icon"><i class="fas fa-book-open"></i></div>
                            <div>
                                <div class="fw-bold text-dark" style="font-size: 0.9rem;">Education</div>
                                <small class="text-muted" style="font-size: 0.75rem;">68 Debates</small>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-muted small"></i>
                    </div>

                    <button class="btn btn-outline-dark w-100 mt-3 py-2 text-uppercase small fw-bold" style="border-style: dashed;">Manage Categories</button>
                </div>
            </div>
        </div>

    </div>

    <!-- Script to Toggle Sidebar -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.querySelector('.overlay').classList.toggle('active');
        }
    </script>

</body>
</html>