<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Rankings - LogicallyDebate</title>
    
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
        }

        body {
            background-color: var(--dark-bg);
            color: #e4e4e7;
            font-family: 'Outfit', sans-serif;
            margin: 0; 
            padding-top: 90px;
        }

        /* --- HERO HEADER --- */
        .page-header { text-align: center; padding: 40px 20px; }
        .page-title { font-family: 'Space Grotesk'; font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; margin-bottom: 10px; background: linear-gradient(to right, #fff, #888); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .page-sub { color: #888; font-size: 1rem; }

        /* --- PODIUM SECTION --- */
        .podium-area { 
            display: flex; 
            justify-content: center; 
            align-items: flex-end; 
            gap: 20px; 
            margin-bottom: 80px; 
            padding: 0 20px; 
        }
        
        .podium-card {
            background: linear-gradient(160deg, #18181b 0%, #09090b 100%);
            border: 1px solid #27272a;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            width: 300px;
            position: relative;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            transition: transform 0.3s;
        }

        .rank-1 { height: 420px; border-top: 6px solid var(--primary-gold); z-index: 2; }
        .rank-2 { height: 360px; border-top: 6px solid var(--primary-silver); }
        .rank-3 { height: 330px; border-top: 6px solid var(--primary-bronze); }

        .rank-badge {
            width: 40px; height: 40px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1.2rem; color: #000;
            position: absolute; top: -20px; left: 50%; transform: translateX(-50%);
        }
        .bg-gold { background: var(--primary-gold); }
        .bg-silver { background: var(--primary-silver); }
        .bg-bronze { background: var(--primary-bronze); }

        .avatar-large { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin: 30px 0 20px; border: 4px solid #1f1f22; }
        .rank-1 .avatar-large { width: 100px; height: 100px; border-color: var(--primary-gold); }

        .score-val { font-family: 'Space Grotesk'; font-size: 1.8rem; font-weight: 800; display: block; }
        .score-lbl { font-size: 0.7rem; text-transform: uppercase; color: #666; font-weight: 700; }

        /* --- TABLE SECTION --- */
        .table-container { max-width: 1100px; margin: 0 auto 100px; padding: 0 15px; }
        
        .custom-table { width: 100%; border-collapse: separate; border-spacing: 0 15px; }
        .custom-table th { text-align: left; color: #666; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; padding: 0 20px 10px; }
        .t-cell { background: #111; border-top: 1px solid #222; border-bottom: 1px solid #222; padding: 20px; vertical-align: middle; }
        .t-cell:first-child { border-left: 1px solid #222; border-radius: 12px 0 0 12px; font-weight: 800; color: #666; font-size: 1.2rem; }
        .t-cell:last-child { border-right: 1px solid #222; border-radius: 0 12px 12px 0; text-align: right; }
        .t-user { display: flex; align-items: center; gap: 15px; }
        .t-avatar { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; }

        /* --- MOBILE RESPONSIVENESS --- */
        @media (max-width: 991px) {
            .podium-area { flex-direction: column; align-items: center; gap: 40px; }
            .rank-1, .rank-2, .rank-3 { height: auto; width: 100%; max-width: 350px; order: 2; }
            .rank-1 { order: 1; transform: scale(1.05); }
            
            /* Convert Table to Cards on Mobile */
            .custom-table thead { display: none; }
            .custom-table, .custom-table tbody, .custom-table tr, .custom-table td { display: block; width: 100%; }
            .custom-table tr { margin-bottom: 15px; background: #111; border: 1px solid #222; border-radius: 12px; padding: 15px; }
            .t-cell { border: none !important; padding: 5px 0; display: flex; justify-content: space-between; align-items: center; border-radius: 0 !important; }
            .t-cell:first-child { font-size: 1rem; color: var(--primary-red); margin-bottom: 10px; }
            /* Add labels for mobile context */
            .t-cell:nth-child(3)::before { content: "Wins: "; color: #666; font-size: 0.8rem; margin-right: 10px; }
            .t-cell:nth-child(4)::before { content: "Win Rate: "; color: #666; font-size: 0.8rem; margin-right: 10px; }
            .t-cell:nth-child(5)::before { content: "Reputation: "; color: #666; font-size: 0.8rem; margin-right: 10px; }
        }
    </style>
</head>
<body>

    @include('frontend.shared.navbar')

    <header class="page-header">
        <h1 class="page-title">Global Leaderboard</h1>
        <p class="page-sub">Recognizing the sharpest minds.</p>
    </header>

    <div class="podium-area">
        <!-- Rank 2 -->
        <div class="podium-card rank-2">
            <div class="rank-badge bg-silver">2</div>
            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="avatar-large">
            <div class="fw-bold fs-5 text-white">Athena_Wisdom</div>
            <div class="text-secondary small mb-3">Master Debater</div>
            <span class="score-val" style="color: #94a3b8">8,420</span>
        </div>

        <!-- Rank 1 -->
        <div class="podium-card rank-1">
            <div class="rank-badge bg-gold"><i class="fas fa-crown"></i></div>
            <img src="https://randomuser.me/api/portraits/men/11.jpg" class="avatar-large">
            <div class="fw-bold fs-4 text-white">LogicMaster_99</div>
            <div class="text-secondary small mb-3">Grandmaster</div>
            <span class="score-val" style="color: #fbbf24">9,850</span>
        </div>

        <!-- Rank 3 -->
        <div class="podium-card rank-3">
            <div class="rank-badge bg-bronze">3</div>
            <img src="https://randomuser.me/api/portraits/men/33.jpg" class="avatar-large">
            <div class="fw-bold fs-5 text-white">SocratesReborn</div>
            <div class="text-secondary small mb-3">Expert Debater</div>
            <span class="score-val" style="color: #b45309">7,900</span>
        </div>
    </div>

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
                                <div class="text-white fw-bold">David Hume <span class="badge bg-dark border border-secondary text-secondary ms-1" style="font-size: 0.6rem">PRO</span></div>
                            </div>
                        </div>
                    </td>
                    <td class="t-cell"><span class="fw-bold text-white">142</span></td>
                    <td class="t-cell"><span class="fw-bold text-success">78%</span></td>
                    <td class="t-cell"><span class="fw-bold text-white">6,540</span></td>
                    <td class="t-cell">
                        <span class="badge bg-success bg-opacity-25 text-success rounded-pill">ONLINE</span>
                    </td>
                </tr>

                <!-- Row 5 -->
                <tr>
                    <td class="t-cell">05</td>
                    <td class="t-cell">
                        <div class="t-user">
                            <img src="https://randomuser.me/api/portraits/women/62.jpg" class="t-avatar">
                            <div>
                                <div class="text-white fw-bold">Hypatia_Alex <span class="badge bg-dark border border-secondary text-secondary ms-1" style="font-size: 0.6rem">CON</span></div>
                            </div>
                        </div>
                    </td>
                    <td class="t-cell"><span class="fw-bold text-white">120</span></td>
                    <td class="t-cell"><span class="fw-bold text-warning">65%</span></td>
                    <td class="t-cell"><span class="fw-bold text-white">5,900</span></td>
                    <td class="t-cell">
                        <span class="badge bg-secondary bg-opacity-25 text-secondary rounded-pill">OFFLINE</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>