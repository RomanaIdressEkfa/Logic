<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Logically Debate</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-red: #ef233c;
            --dark-black: #050505;
            --light-bg: #f3f4f6;
            --sidebar-width: 290px; /* Width increased for bigger text */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            overflow-x: hidden;
        }

        /* --- SIDEBAR DESIGN (UPDATED) --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid #e5e7eb;
            z-index: 1000;
            padding-top: 25px;
            overflow-y: auto; /* Scrollable if needed */
        }

        /* LOGO SECTION */
        .brand-section {
            padding: 0 30px 30px 30px; /* More padding bottom */
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-section h3 {
            font-weight: 800;
            font-size: 1.5rem; /* Bigger Font */
            color: var(--dark-black);
            margin: 0;
            letter-spacing: -0.5px;
        }
        .brand-section span { color: var(--primary-red); }

        /* MENU CATEGORY LABELS */
        .menu-category {
            font-size: 0.75rem; /* Bigger than before */
            color: #9ca3af;
            font-weight: 700;
            text-transform: uppercase;
            padding: 25px 30px 15px 30px; /* More spacing top */
            letter-spacing: 0.5px;
        }

        /* NAV LINKS (BIGGER & SPACED) */
        .nav-link {
            display: flex;
            align-items: center;
            padding: 16px 30px; /* Taller items */
            color: #555;
            font-weight: 500;
            font-size: 1.05rem; /* Increased Font Size */
            text-decoration: none;
            transition: all 0.2s ease-in-out;
            border-left: 5px solid transparent; /* Prepare for border */
            margin-bottom: 5px; /* Spacing between items */
        }

        .nav-link i {
            width: 28px; /* Fixed width for alignment */
            font-size: 1.2rem; /* Bigger Icons */
            margin-right: 12px;
            color: #9ca3af;
            transition: color 0.2s;
        }

        .nav-link:hover {
            color: var(--primary-red);
            background: #fff9f9;
        }
        .nav-link:hover i { color: var(--primary-red); }

        /* ACTIVE STATE (MATCHING "UNIQUE" SCREENSHOT) */
        .nav-link.active {
            background-color: #fff0f1; /* Light Red BG */
            color: var(--primary-red);
            border-left-color: var(--primary-red); /* Solid Red Bar */
            font-weight: 600;
        }
        .nav-link.active i { color: var(--primary-red); }


        /* --- MAIN CONTENT AREA --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px 40px;
        }

        /* Top Header */
        .top-header {
            background: white;
            padding: 20px 40px;
            margin: -30px -40px 40px -40px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .visit-btn {
            background: #f3f4f6;
            color: #374151;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-badge {
            background: var(--dark-black);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Welcome Section */
        .welcome-text h2 { font-weight: 800; font-size: 2rem; color: #111; }
        .welcome-text span { color: var(--primary-red); }
        .welcome-sub { color: #6b7280; margin-bottom: 40px; font-size: 1.1rem; }

        /* CARDS */
        .stat-card {
            border-radius: 20px;
            padding: 30px;
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-5px); }

        /* Card Colors */
        .card-red { background: var(--primary-red); color: white; }
        .card-red .icon-box { background: rgba(255,255,255,0.2); }
        .card-black { background: var(--dark-black); color: white; }
        .card-black .icon-box { background: rgba(255,255,255,0.1); }
        .card-white { background: white; color: #111; border: 1px solid #e5e7eb; }
        .card-white .icon-box { background: #fff0f1; color: var(--primary-red); }

        .stat-card h3 { font-size: 2.2rem; font-weight: 700; margin-top: 15px; margin-bottom: 5px; }
        .stat-card p { font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.9; }
        
        .icon-box {
            width: 50px; height: 50px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            position: absolute; top: 25px; right: 25px;
        }

        /* TABLES */
        .content-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            border: 1px solid #e5e7eb;
            height: 100%;
        }

        .section-title { font-weight: 700; font-size: 1.2rem; margin-bottom: 25px; color: #111; }
        .view-all { color: var(--primary-red); text-decoration: none; font-size: 0.9rem; font-weight: 600; float: right; }

        .custom-table th { font-size: 0.8rem; text-transform: uppercase; color: #9ca3af; font-weight: 700; border-bottom: 1px solid #f3f4f6; padding-bottom: 15px; }
        .custom-table td { padding: 18px 0; vertical-align: middle; color: #374151; font-weight: 500; border-bottom: 1px solid #f9fafb; font-size: 1rem; }
        
        /* Categories List */
        .cat-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px; background: #f9fafb; border-radius: 12px; margin-bottom: 15px;
            transition: 0.2s;
        }
        .cat-item:hover { background: #fff0f1; cursor: pointer; }
        .cat-icon { width: 45px; height: 45px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; color: var(--primary-red); box-shadow: 0 2px 4px rgba(0,0,0,0.05); font-size: 1.2rem; }

    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <!-- Brand -->
        <div class="brand-section">
            <i class="fas fa-brain fa-lg" style="color: var(--primary-red);"></i>
            <h3>Logically Debate<span>.</span></h3>
        </div>

        <!-- Menu: Analytics -->
        <div class="menu-category">Analytics</div>
        <a href="#" class="nav-link active">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <!-- Menu: Debate & Topics -->
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

        <!-- Menu: Community -->
        <div class="menu-category">Community</div>
        <a href="#" class="nav-link">
            <i class="fas fa-users"></i> Users List
        </a>
        <a href="#" class="nav-link">
            <i class="fas fa-gavel"></i> Reports
        </a>

        <!-- Menu: Configuration -->
        <div class="menu-category">Configuration</div>
        <a href="#" class="nav-link">
            <i class="fas fa-cog"></i> System Settings
        </a>
        
        <!-- Logout -->
        <div style="margin-top: 50px; padding: 0 30px 30px 30px;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn w-100 py-3 fw-bold text-white d-flex align-items-center justify-content-center gap-2" 
                        style="background: var(--dark-black); border-radius: 12px;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- Top Header -->
        <div class="top-header">
            <div class="d-flex align-items-center gap-3">
                <button class="visit-btn"><i class="fas fa-globe"></i> Visit Website</button>
            </div>
            
            <div class="d-flex align-items-center gap-4">
                <i class="far fa-bell fa-lg text-secondary" style="font-size: 1.4rem;"></i>
                <div class="admin-badge">
                    <div class="fw-bold">LD</div>
                    <div class="d-flex flex-column" style="line-height: 1.2;">
                        <small style="font-size: 0.65rem; opacity: 0.8;">HELLO,</small>
                        <span style="font-size: 0.9rem;">Super Admin</span>
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
        <div class="row g-4 mb-5">
            <!-- Card 1 -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card card-red">
                    <p>Total Debates</p>
                    <h3>1,254</h3>
                    <div class="icon-box"><i class="fas fa-fire"></i></div>
                    <small style="opacity: 0.8;"><i class="fas fa-arrow-up"></i> +12.5% this month</small>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card card-black">
                    <p>Active Users</p>
                    <h3>850</h3>
                    <div class="icon-box"><i class="fas fa-user-check"></i></div>
                    <small style="opacity: 0.7; color: #4ade80;"><i class="fas fa-circle" style="font-size: 8px;"></i> Online Now</small>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card card-white">
                    <p style="color: #6b7280;">Pending Reports</p>
                    <h3>12</h3>
                    <div class="icon-box"><i class="fas fa-flag"></i></div>
                    <small class="text-danger fw-bold">Needs Attention</small>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card" style="background: #374151; color: white;">
                    <p>Categories</p>
                    <h3>66</h3>
                    <div class="icon-box" style="background: rgba(255,255,255,0.1);"><i class="fas fa-folder"></i></div>
                    <small style="opacity: 0.8;">Active Sections</small>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="row g-4">
            <!-- Table -->
            <div class="col-lg-8">
                <div class="content-section">
                    <a href="#" class="view-all">View All</a>
                    <h5 class="section-title">Recently Added Debates</h5>
                    
                    <div class="table-responsive">
                        <table class="table custom-table table-borderless">
                            <thead>
                                <tr>
                                    <th width="50%">TOPIC NAME</th>
                                    <th>CREATOR</th>
                                    <th>STATUS</th>
                                    <th class="text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 45px; height: 45px; background: #f3f4f6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-robot text-dark fa-lg"></i>
                                            </div>
                                            <span class="fw-bold text-dark">AI vs Human Creativity</span>
                                        </div>
                                    </td>
                                    <td>Dr. A. Smith</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Published</span></td>
                                    <td class="text-end"><button class="btn btn-sm btn-light"><i class="fas fa-ellipsis-v"></i></button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 45px; height: 45px; background: #f3f4f6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-globe-americas text-dark fa-lg"></i>
                                            </div>
                                            <span class="fw-bold text-dark">Climate Change Policy</span>
                                        </div>
                                    </td>
                                    <td>Sarah Connor</td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">Pending</span></td>
                                    <td class="text-end"><button class="btn btn-sm btn-light"><i class="fas fa-ellipsis-v"></i></button></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width: 45px; height: 45px; background: #f3f4f6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-bitcoin text-dark fa-lg"></i>
                                            </div>
                                            <span class="fw-bold text-dark">Future of Crypto</span>
                                        </div>
                                    </td>
                                    <td>Elon M.</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Published</span></td>
                                    <td class="text-end"><button class="btn btn-sm btn-light"><i class="fas fa-ellipsis-v"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-lg-4">
                <div class="content-section">
                    <h5 class="section-title">Top Categories</h5>
                    
                    <div class="cat-item">
                        <div class="d-flex align-items-center">
                            <div class="cat-icon"><i class="fas fa-balance-scale"></i></div>
                            <div>
                                <div class="fw-bold text-dark">Politics</div>
                                <small class="text-muted">81 Debates</small>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>

                    <div class="cat-item">
                        <div class="d-flex align-items-center">
                            <div class="cat-icon"><i class="fas fa-microchip"></i></div>
                            <div>
                                <div class="fw-bold text-dark">Technology</div>
                                <small class="text-muted">68 Debates</small>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>

                    <div class="cat-item">
                        <div class="d-flex align-items-center">
                            <div class="cat-icon"><i class="fas fa-book-open"></i></div>
                            <div>
                                <div class="fw-bold text-dark">Education</div>
                                <small class="text-muted">68 Debates</small>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>

                    <button class="btn btn-outline-dark w-100 mt-4 py-3" style="border-style: dashed;">Manage All Categories</button>
                </div>
            </div>
        </div>

    </div>

</body>
</html>