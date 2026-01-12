<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Rankings - LogicallyDebate</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-red: #ef233c;
            --primary-gold: #fbbf24;
            --primary-silver: #94a3b8;
            --primary-bronze: #b45309;
            --dark-bg: #050505;
            --card-bg: #0f0f10;
            --border-color: #27272a;
            --text-main: #e4e4e7;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-main);
            font-family: 'Outfit', sans-serif;
            margin: 0; padding: 0;
        }

        /* --- NAVBAR --- */
        .navbar-global {
            height: 70px; background: rgba(9, 9, 11, 0.95); border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: space-between; padding: 0 40px;
            position: sticky; top: 0; z-index: 1000; backdrop-filter: blur(10px);
        }
        .brand { font-family: 'Space Grotesk'; font-size: 1.5rem; font-weight: 800; color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .brand-icon { width: 36px; height: 36px; background: var(--primary-red); color: white; display: flex; align-items: center; justify-content: center; border-radius: 8px; transform: skew(-10deg); }
        .nav-links a { color: #888; text-decoration: none; font-weight: 600; margin: 0 15px; text-transform: uppercase; transition: 0.3s; font-size: 0.9rem; }
        .nav-links a:hover, .nav-links a.active { color: white; }

        /* --- HERO HEADER --- */
        .page-header { text-align: center; padding: 60px 0 40px; }
        .page-title { font-family: 'Space Grotesk'; font-size: 3rem; font-weight: 800; margin-bottom: 10px; background: linear-gradient(to right, #fff, #888); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .page-sub { color: #888; font-size: 1.1rem; }

        /* --- PODIUM SECTION --- */
        .podium-area { display: flex; justify-content: center; align-items: flex-end; gap: 30px; margin-bottom: 80px; padding: 0 20px; }
        
        .podium-card {
            background: linear-gradient(160deg, #18181b 0%, #09090b 100%);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            width: 300px; /* Big Width */
            position: relative;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            transition: transform 0.3s;
        }
        .podium-card:hover { transform: translateY(-10px); }

        /* Rank Specifics */
        .rank-1 { height: 420px; border-top: 6px solid var(--primary-gold); z-index: 2; }
        .rank-2 { height: 360px; border-top: 6px solid var(--primary-silver); }
        .rank-3 { height: 330px; border-top: 6px solid var(--primary-bronze); }

        /* Rank Badge */
        .rank-badge {
            width: 50px; height: 50px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1.5rem; color: #000;
            position: absolute; top: -25px; left: 50%; transform: translateX(-50%);
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }
        .bg-gold { background: var(--primary-gold); box-shadow: 0 0 20px rgba(251, 191, 36, 0.4); }
        .bg-silver { background: var(--primary-silver); box-shadow: 0 0 20px rgba(148, 163, 184, 0.4); }
        .bg-bronze { background: var(--primary-bronze); box-shadow: 0 0 20px rgba(180, 83, 9, 0.4); }

        .avatar-large { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin: 30px 0 20px; border: 4px solid #1f1f22; }
        .rank-1 .avatar-large { border-color: var(--primary-gold); width: 120px; height: 120px; }

        .user-name { font-size: 1.4rem; font-weight: 700; color: white; margin-bottom: 5px; }
        .user-title { font-size: 0.9rem; color: #888; font-weight: 600; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 1px; }
        
        .score-box { background: rgba(255,255,255,0.05); padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.05); }
        .score-val { font-family: 'Space Grotesk'; font-size: 2rem; font-weight: 800; display: block; line-height: 1; }
        .score-lbl { font-size: 0.7rem; text-transform: uppercase; color: #666; font-weight: 700; }

        .trend-up { color: var(--primary-green); font-size: 0.9rem; font-weight: 700; }

        /* --- TABLE SECTION --- */
        .table-container { max-width: 1100px; margin: 0 auto 100px; }
        
        .custom-table { width: 100%; border-collapse: separate; border-spacing: 0 15px; }
        
        .custom-table th { 
            text-align: left; color: #666; font-weight: 700; font-size: 0.8rem; 
            text-transform: uppercase; padding: 0 20px 10px; letter-spacing: 1px;
        }
        
        .custom-table tr { transition: 0.2s; }
        .custom-table tr:hover .t-cell { background: #1a1a1d; border-color: #333; }

        .t-cell { 
            background: #111; border-top: 1px solid #222; border-bottom: 1px solid #222; 
            padding: 20px; vertical-align: middle; 
        }
        .t-cell:first-child { border-left: 1px solid #222; border-radius: 12px 0 0 12px; font-weight: 800; color: #666; font-size: 1.2rem; }
        .t-cell:last-child { border-right: 1px solid #222; border-radius: 0 12px 12px 0; text-align: right; }

        .t-user { display: flex; align-items: center; gap: 15px; }
        .t-avatar { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; }
        .t-name { font-weight: 700; color: white; font-size: 1rem; }
        .t-role { font-size: 0.7rem; background: #222; padding: 2px 6px; border-radius: 4px; color: #aaa; margin-left: 8px; }

        .stat-val { font-weight: 700; color: white; font-size: 1.1rem; }
        .stat-sub { font-size: 0.8rem; color: #666; }

    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar-global">
        <a href="{{ route('home') }}" class="brand">
            <div class="brand-icon"><i class="fas fa-bolt"></i></div>
            <div>Logically<span>Debate</span></div>
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('debates') }}">Debate Hall</a>
            <a href="{{ route('leaderboard') }}" class="active">Leaderboard</a>
            <a href="#">Community</a>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('debate.create') }}" class="btn btn-danger fw-bold rounded-pill px-4" style="background: var(--primary-red); border:none;">Create Debate</a>
            <a href="#" class="btn btn-outline-light fw-bold rounded-pill px-4">My Profile</a>
        </div>
    </nav>

    <!-- HEADER -->
    <header class="page-header">
        <h1 class="page-title">Global Leaderboard</h1>
        <p class="page-sub">Recognizing the sharpest minds and most logical debaters.</p>
    </header>

    <!-- PODIUM -->
    <div class="podium-area">
        
        <!-- Rank 2 -->
        <div class="podium-card rank-2">
            <div class="rank-badge bg-silver">2</div>
            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="avatar-large">
            <div class="user-name">Athena_Wisdom</div>
            <div class="user-title">Master Debater</div>
            
            <div class="score-box">
                <span class="score-val" style="color: #94a3b8">8,420</span>
                <span class="score-lbl">Logic Score</span>
            </div>
            <div class="trend-up"><i class="fas fa-arrow-up"></i> 12 Positions</div>
        </div>

        <!-- Rank 1 -->
        <div class="podium-card rank-1">
            <div class="rank-badge bg-gold"><i class="fas fa-crown"></i></div>
            <img src="https://randomuser.me/api/portraits/men/11.jpg" class="avatar-large">
            <div class="user-name">LogicMaster_99</div>
            <div class="user-title">Grandmaster</div>
            
            <div class="score-box">
                <span class="score-val" style="color: #fbbf24">9,850</span>
                <span class="score-lbl">Logic Score</span>
            </div>
            <div class="trend-up"><i class="fas fa-fire"></i> 5 Win Streak</div>
        </div>

        <!-- Rank 3 -->
        <div class="podium-card rank-3">
            <div class="rank-badge bg-bronze">3</div>
            <img src="https://randomuser.me/api/portraits/men/33.jpg" class="avatar-large">
            <div class="user-name">SocratesReborn</div>
            <div class="user-title">Expert Debater</div>
            
            <div class="score-box">
                <span class="score-val" style="color: #b45309">7,900</span>
                <span class="score-lbl">Logic Score</span>
            </div>
            <div class="trend-up"><i class="fas fa-minus"></i> Stable</div>
        </div>

    </div>

    <!-- TABLE -->
    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Debater</th>
                    <th>Debates Won</th>
                    <th>Win Rate</th>
                    <th>Reputation</th>
                    <th class="text-end">Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 4 -->
                <tr>
                    <td class="t-cell">04</td>
                    <td class="t-cell">
                        <div class="t-user">
                            <img src="https://randomuser.me/api/portraits/men/52.jpg" class="t-avatar">
                            <div>
                                <div class="t-name">David Hume <span class="t-role">PRO</span></div>
                                <div class="stat-sub">Joined 2024</div>
                            </div>
                        </div>
                    </td>
                    <td class="t-cell">
                        <div class="stat-val">142</div>
                        <div class="stat-sub">Wins</div>
                    </td>
                    <td class="t-cell">
                        <div class="stat-val text-success">78%</div>
                    </td>
                    <td class="t-cell">
                        <div class="stat-val">6,540</div>
                    </td>
                    <td class="t-cell">
                        <span class="badge bg-success bg-opacity-25 text-success px-3 py-2 rounded-pill">ONLINE</span>
                    </td>
                </tr>

                <!-- Row 5 -->
                <tr>
                    <td class="t-cell">05</td>
                    <td class="t-cell">
                        <div class="t-user">
                            <img src="https://randomuser.me/api/portraits/women/62.jpg" class="t-avatar">
                            <div>
                                <div class="t-name">Hypatia_Alex <span class="t-role">CON</span></div>
                                <div class="stat-sub">Joined 2023</div>
                            </div>
                        </div>
                    </td>
                    <td class="t-cell">
                        <div class="stat-val">120</div>
                        <div class="stat-sub">Wins</div>
                    </td>
                    <td class="t-cell">
                        <div class="stat-val text-warning">65%</div>
                    </td>
                    <td class="t-cell">
                        <div class="stat-val">5,900</div>
                    </td>
                    <td class="t-cell">
                        <span class="badge bg-secondary bg-opacity-25 text-secondary px-3 py-2 rounded-pill">OFFLINE</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>