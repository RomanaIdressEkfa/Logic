<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogicallyDebate - The Ultimate Platform</title>
    <link rel="icon" type="image/x-icon" href="https://i.ibb.co.com/s916M5xG/Logo-01.png">
    
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
            --text-grey: #a0a0a0;
        }

        body {
            background-color: var(--dark-bg);
            color: white;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            position: relative;
        }

        h1, h2, h3, h4, .brand-font { font-family: 'Space Grotesk', sans-serif; }
        a { text-decoration: none; }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #000; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-red); }

        #canvas-container {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: -1;
            background: radial-gradient(circle at center, #110505 0%, #000000 100%);
            pointer-events: none; /* Allows clicking through the canvas */
        }

        /* --- HERO SECTION --- */
        .hero-section { 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            padding-top: 100px; 
            padding-bottom: 50px;
            position: relative;
            z-index: 1;
        }
        .hero-title { 
            font-size: clamp(2.5rem, 6vw, 4.5rem); 
            line-height: 1.1; 
            font-weight: 800; 
            margin-bottom: 25px; 
        }
        .text-outline {
            -webkit-text-stroke: 1px rgba(255,255,255,0.4);
            color: transparent;
        }
        
        /* Stats */
        .stat-box {
            text-align: center; 
            padding: 25px 15px; 
            border: 1px solid var(--border-color); 
            border-radius: 12px;
            background: rgba(15, 15, 15, 0.6); 
            backdrop-filter: blur(5px);
            transition: transform 0.3s, border-color 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .stat-box:hover { border-color: var(--primary-red); transform: translateY(-5px); }
        .stat-number { font-size: clamp(1.8rem, 3vw, 3rem); font-weight: 800; color: white; display: block; }
        .stat-label { color: var(--primary-red); text-transform: uppercase; letter-spacing: 1px; font-size: 0.7rem; font-weight: 700; margin-top: 5px; }

        /* General Sections */
        .section-padding { padding: 80px 0; }
        .section-header { margin-bottom: 50px; }
        .section-title { font-size: clamp(2rem, 4vw, 2.5rem); font-weight: 700; margin-bottom: 10px; }
        .section-sub { color: var(--text-grey); font-size: 1.1rem; }

        /* Battle Cards */
        .custom-card {
            background: var(--card-bg); 
            border: 1px solid var(--border-color); 
            border-radius: 16px;
            overflow: hidden; 
            transition: all 0.3s ease; 
            height: 100%; 
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .custom-card:hover { 
            transform: translateY(-8px); 
            border-color: #333; 
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5); 
        }
        .card-img-top { 
            height: 220px; 
            background-size: cover; 
            background-position: center; 
            position: relative; 
            width: 100%;
        }
        .card-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(15,15,15,1) 100%);
        }
        .live-badge {
            position: absolute; top: 15px; left: 15px; 
            background: var(--primary-red); color: white;
            padding: 5px 10px; font-size: 0.7rem; font-weight: 800; 
            border-radius: 4px; text-transform: uppercase;
            animation: pulse 1.5s infinite;
            z-index: 2;
        }
        .card-body-custom {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Judge Cards */
        .judge-card {
            text-align: center;
            background: #0a0a0a;
            padding: 30px 15px;
            border-radius: 20px;
            border: 1px solid #1a1a1a;
            transition: 0.3s;
            height: 100%;
        }
        .judge-card:hover { border-color: var(--primary-red); transform: translateY(-5px); }
        .judge-img {
            width: 80px; height: 80px; border-radius: 50%; object-fit: cover;
            border: 3px solid #333; margin-bottom: 15px;
        }

        /* Rank Items */
        .rank-item {
            display: flex; align-items: center; justify-content: space-between;
            background: #111; padding: 15px 20px; border-radius: 12px; margin-bottom: 15px;
            border-left: 4px solid transparent;
            transition: 0.3s;
        }
        .rank-item:hover { background: #161616; transform: scale(1.02); }
        .rank-1 { border-left-color: #FFD700; } 
        .rank-2 { border-left-color: #C0C0C0; } 
        .rank-3 { border-left-color: #CD7F32; } 
        .rank-number { font-size: 1.2rem; font-weight: 800; color: #444; width: 30px; }
        .rank-score { font-weight: 700; color: var(--primary-red); white-space: nowrap; }
        .rank-info h5 { font-size: 1rem; margin: 0; }
        .rank-info small { font-size: 0.8rem; }

        /* Step Cards */
        .step-card { padding: 30px; border-left: 2px solid var(--border-color); position: relative; height: 100%; transition: 0.3s; }
        .step-card:hover { border-left-color: var(--primary-red); background: linear-gradient(to right, rgba(239,35,60,0.05), transparent); }
        .step-number { font-size: 3rem; font-weight: 800; color: rgba(255,255,255,0.05); position: absolute; top: 10px; right: 20px; }

        /* Footer */
        footer { 
            border-top: 1px solid var(--border-color); 
            padding: 60px 0 30px 0; 
            margin-top: 80px; 
            background: #020202; 
        }
        .social-btn {
            width: 35px; height: 35px; border-radius: 50%; background: #111; color: white;
            display: inline-flex; align-items: center; justify-content: center; margin-right: 8px;
            transition: 0.3s; font-size: 0.9rem;
        }
        .social-btn:hover { background: var(--primary-red); transform: rotate(360deg); color: white; }

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.5; } 100% { opacity: 1; } }

        /* --- RESPONSIVE ADJUSTMENTS --- */
        @media (max-width: 991px) {
            .hero-section { text-align: center; }
            .hero-section .d-flex { justify-content: center; }
            .hero-desc { margin: 0 auto 2rem auto !important; }
            
            /* Show the interactive card below text on mobile */
            .mobile-interactive-card { margin-top: 50px; }
        }
        
        @media (max-width: 768px) {
            .section-padding { padding: 50px 0; }
            .step-card { border-left: none; border-top: 2px solid var(--border-color); margin-bottom: 20px; text-align: center; }
            .step-card:hover { border-top-color: var(--primary-red); border-left-color: var(--border-color); background: linear-gradient(to bottom, rgba(239,35,60,0.05), transparent); }
            .step-number { right: 50%; transform: translateX(50%); top: 10px; }
            
            .rank-item { padding: 12px; }
            .rank-img { width: 40px; height: 40px; }
            
            .input-group { flex-direction: column; }
            .input-group input { width: 100%; border-radius: 6px !important; margin-bottom: 10px; }
            .input-group button { width: 100%; border-radius: 6px !important; }
        }
    </style>
</head>
<body>

    <!-- 3D Background -->
    <div id="canvas-container"></div>

    <!-- NAVBAR Placeholder (Keeping your include) -->
    @include('frontend.shared.navbar')

    <!-- 1. HERO SECTION -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="d-inline-block border border-danger text-danger px-3 py-1 rounded-pill small fw-bold mb-3 fade-in">
                        <i class="fas fa-circle me-2" style="font-size: 8px;"></i> LIVE PLATFORM V2.0
                    </div>
                    <h1 class="hero-title fade-in">
                        Logic is the <br> 
                        <span class="text-outline">Ultimate</span> <span style="color: var(--primary-red)">Weapon.</span>
                    </h1>
                    <p class="lead text-secondary mb-4 fade-in hero-desc" style="max-width: 550px;">
                        Welcome to LogicallyDebate. A decentralized platform where ideas fight for survival, judging is transparent, and intelligence is rewarded.
                    </p>
                    <div class="d-flex gap-3 fade-in flex-wrap">
                        <a href="{{ route('debates') }}" class="btn btn-danger btn-lg px-5 rounded-pill fw-bold border-0" style="background: var(--primary-red);">Start Debating</a>
                        <button class="btn btn-outline-light btn-lg px-5 rounded-pill">Watch Demo</button>
                    </div>
                </div>
                
                <!-- 3D Interactive Overlay (Optimized for all screens) -->
                <div class="col-lg-5 mt-5 mt-lg-0">
                    <div class="p-4 p-md-5 border border-secondary rounded-4 bg-dark bg-opacity-25 fade-in mobile-interactive-card" style="backdrop-filter: blur(10px);">
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="m-0 text-white">Current Top Topic</h5>
                            <span class="badge bg-danger">HOT</span>
                        </div>
                        <h3 class="fw-bold mb-3 text-white fs-4">"AI will replace human creativity by 2030"</h3>
                        <div class="progress mb-3" style="height: 6px; background: #333;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 65%"></div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 35%"></div>
                        </div>
                        <div class="d-flex justify-content-between text-secondary small fw-bold">
                            <span class="text-primary">AGREE (65%)</span>
                            <span class="text-danger">DISAGREE (35%)</span>
                        </div>
                        <div class="mt-4 text-center">
                            <button class="btn btn-sm btn-outline-secondary w-100 rounded-pill">Cast Your Vote</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Row (Responsive Grid) -->
            <div class="row g-3 mt-4 fade-in">
                <div class="col-12 col-md-4">
                    <div class="stat-box">
                        <span class="stat-number count" data-target="1240">0</span>
                        <span class="stat-label">Live Debates</span>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="stat-box">
                        <span class="stat-number count" data-target="8500">0</span>
                        <span class="stat-label">Active Intellectuals</span>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="stat-box">
                        <span class="stat-number count" data-target="98">0</span>
                        <span class="stat-label">Accuracy Score</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. LIVE BATTLES SECTION -->
    <section class="section-padding">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold mb-2 section-title">Live Battles</h2>
                    <p class="section-sub m-0">Witness high-stakes intellectual combat.</p>
                </div>
                <a href="{{ route('debates') }}" class="btn btn-outline-secondary rounded-pill btn-sm-block">View Debate Hall</a>
            </div>

            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                <!-- Card 1 -->
                <div class="col">
                    <div class="custom-card scroll-reveal">
                        <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1555421689-491a97ff2040?q=80&w=800&auto=format&fit=crop');">
                            <div class="card-overlay"></div>
                            <span class="live-badge">Live</span>
                        </div>
                        <div class="card-body-custom">
                            <div>
                                <div class="small text-danger fw-bold mb-2">POLITICS</div>
                                <h4 class="fw-bold mb-3 fs-5">Universal Basic Income: Necessary or Harmful?</h4>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-top border-secondary pt-3 mt-2">
                                <div class="d-flex">
                                    <div class="bg-secondary rounded-circle" style="width:30px;height:30px; border:2px solid #000;"></div>
                                    <div class="bg-light rounded-circle" style="width:30px;height:30px; margin-left:-10px; border:2px solid #000;"></div>
                                </div>
                                <span class="text-secondary small"><i class="fas fa-eye me-1 text-danger"></i> 1.2k</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col">
                    <div class="custom-card scroll-reveal">
                        <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1620712943543-bcc4688e7485?q=80&w=800&auto=format&fit=crop');">
                             <div class="card-overlay"></div>
                            <span class="live-badge">Live</span>
                        </div>
                        <div class="card-body-custom">
                            <div>
                                <div class="small text-info fw-bold mb-2">TECHNOLOGY</div>
                                <h4 class="fw-bold mb-3 fs-5">Is Open Source AI dangerous for security?</h4>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-top border-secondary pt-3 mt-2">
                                <div class="d-flex">
                                    <div class="bg-secondary rounded-circle" style="width:30px;height:30px; border:2px solid #000;"></div>
                                    <div class="bg-light rounded-circle" style="width:30px;height:30px; margin-left:-10px; border:2px solid #000;"></div>
                                </div>
                                <span class="text-secondary small"><i class="fas fa-eye me-1 text-danger"></i> 850</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col">
                    <div class="custom-card scroll-reveal">
                        <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1507413245164-6160d8298b31?q=80&w=800&auto=format&fit=crop');">
                             <div class="card-overlay"></div>
                            <span class="live-badge">Live</span>
                        </div>
                        <div class="card-body-custom">
                            <div>
                                <div class="small text-warning fw-bold mb-2">SCIENCE</div>
                                <h4 class="fw-bold mb-3 fs-5">Genetic Engineering: Playing God or Saving Lives?</h4>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-top border-secondary pt-3 mt-2">
                                <div class="d-flex">
                                    <div class="bg-secondary rounded-circle" style="width:30px;height:30px; border:2px solid #000;"></div>
                                    <div class="bg-light rounded-circle" style="width:30px;height:30px; margin-left:-10px; border:2px solid #000;"></div>
                                </div>
                                <span class="text-secondary small"><i class="fas fa-eye me-1 text-danger"></i> 3.4k</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. JUDGED BY THE BEST -->
    <section class="section-padding bg-black">
        <div class="container">
            <div class="text-center section-header">
                <h2 class="section-title">Judged by the Best</h2>
                <p class="section-sub">Moderated by verified industry experts.</p>
            </div>

            <!-- Responsive Grid for Judges: 2 per row on mobile, 4 on desktop -->
            <div class="row g-3 g-md-4 row-cols-2 row-cols-lg-4">
                <div class="col">
                    <div class="judge-card scroll-reveal">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Judge" class="judge-img">
                        <h5 class="fw-bold mb-1 fs-6">Dr. Alan</h5>
                        <p class="text-secondary small mb-2">Philosophy Chair</p>
                        <span class="badge bg-secondary bg-opacity-25 text-light" style="font-size: 0.7rem;">Philosophy</span>
                    </div>
                </div>
                <div class="col">
                    <div class="judge-card scroll-reveal">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Judge" class="judge-img">
                        <h5 class="fw-bold mb-1 fs-6">Sarah C.</h5>
                        <p class="text-secondary small mb-2">Tech Ethics</p>
                        <span class="badge bg-secondary bg-opacity-25 text-light" style="font-size: 0.7rem;">AI & Tech</span>
                    </div>
                </div>
                <div class="col">
                    <div class="judge-card scroll-reveal">
                        <img src="https://randomuser.me/api/portraits/men/86.jpg" alt="Judge" class="judge-img">
                        <h5 class="fw-bold mb-1 fs-6">Marcus W.</h5>
                        <p class="text-secondary small mb-2">Economist</p>
                        <span class="badge bg-secondary bg-opacity-25 text-light" style="font-size: 0.7rem;">Economics</span>
                    </div>
                </div>
                <div class="col">
                    <div class="judge-card scroll-reveal">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Judge" class="judge-img">
                        <h5 class="fw-bold mb-1 fs-6">Elena F.</h5>
                        <p class="text-secondary small mb-2">Historian</p>
                        <span class="badge bg-secondary bg-opacity-25 text-light" style="font-size: 0.7rem;">History</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. HOW IT WORKS SECTION -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">The Logic Protocol</h2>
                <p class="section-sub">How we ensure fair and rational debate.</p>
            </div>
            
            <div class="row g-4 row-cols-1 row-cols-md-3">
                <div class="col">
                    <div class="step-card scroll-reveal">
                        <span class="step-number">01</span>
                        <h4 class="fw-bold mt-2 mt-md-4">Challenge</h4>
                        <p class="text-secondary">Create a topic or accept a challenge. Define the rules, time limits, and judging criteria.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="step-card scroll-reveal">
                        <span class="step-number">02</span>
                        <h4 class="fw-bold mt-2 mt-md-4">Debate</h4>
                        <p class="text-secondary">Engage in structured rounds. Our AI detects logical fallacies in real-time.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="step-card scroll-reveal">
                        <span class="step-number">03</span>
                        <h4 class="fw-bold mt-2 mt-md-4">Verdict</h4>
                        <p class="text-secondary">Community voting combined with Expert Judge scoring determines the ultimate winner.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. TOP DEBATERS -->
    <section class="section-padding bg-black">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0 text-center text-lg-start">
                    <h2 class="section-title mb-4">Top Debaters <br> of the Month</h2>
                    <p class="text-secondary mb-4">
                        Ranking is based on logic score, lack of fallacies, and audience retention. Climb the ranks to earn exclusive badges.
                    </p>
                    <a href="#" class="btn btn-outline-light rounded-pill px-4">View Global Rankings</a>
                </div>
                
                <div class="col-lg-6 offset-lg-1">
                    <!-- Rank 1 -->
                    <div class="rank-item rank-1 scroll-reveal">
                        <div class="d-flex align-items-center gap-3">
                            <span class="rank-number">01</span>
                            <img src="https://randomuser.me/api/portraits/men/11.jpg" class="rank-img" style="width:50px; height:50px; border-radius:50%;" alt="">
                            <div class="rank-info">
                                <h5 class="fw-bold text-white">LogicMaster_99</h5>
                                <small class="text-secondary">Grandmaster</small>
                            </div>
                        </div>
                        <div class="rank-score">9,850 XP</div>
                    </div>

                    <!-- Rank 2 -->
                    <div class="rank-item rank-2 scroll-reveal">
                        <div class="d-flex align-items-center gap-3">
                            <span class="rank-number">02</span>
                            <img src="https://randomuser.me/api/portraits/women/22.jpg" class="rank-img" style="width:50px; height:50px; border-radius:50%;" alt="">
                            <div class="rank-info">
                                <h5 class="fw-bold text-white">Athena_Wisdom</h5>
                                <small class="text-secondary">Master Debater</small>
                            </div>
                        </div>
                        <div class="rank-score">8,420 XP</div>
                    </div>

                    <!-- Rank 3 -->
                    <div class="rank-item rank-3 scroll-reveal">
                        <div class="d-flex align-items-center gap-3">
                            <span class="rank-number">03</span>
                            <img src="https://randomuser.me/api/portraits/men/33.jpg" class="rank-img" style="width:50px; height:50px; border-radius:50%;" alt="">
                            <div class="rank-info">
                                <h5 class="fw-bold text-white">SocratesReborn</h5>
                                <small class="text-secondary">Expert Debater</small>
                            </div>
                        </div>
                        <div class="rank-score">7,900 XP</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. TRENDING TOPICS -->
    <section class="section-padding">
        <div class="container">
            <h2 class="section-title mb-4">Trending Topics</h2>
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="custom-card p-4 p-md-5 d-flex align-items-end" style="min-height: 300px; background: linear-gradient(to top, black, transparent), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1000&auto=format&fit=crop') center/cover;">
                        <div class="w-100">
                            <span class="badge bg-danger mb-2">HOT TOPIC</span>
                            <h2 class="fw-bold text-white fs-3">Space Colonization</h2>
                            <p class="text-light m-0">Is Mars truly the backup plan for humanity?</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex flex-column gap-3 h-100">
                        <div class="custom-card p-4 flex-grow-1 d-flex align-items-center bg-dark" style="min-height: 140px;">
                            <div>
                                <h5 class="fw-bold m-0 text-white">Cryptocurrency Regulation</h5>
                                <small class="text-secondary">156 Active Debates</small>
                            </div>
                        </div>
                        <div class="custom-card p-4 flex-grow-1 d-flex align-items-center bg-dark" style="min-height: 140px;">
                            <div>
                                <h5 class="fw-bold m-0 text-white">Climate Action</h5>
                                <small class="text-secondary">89 Active Debates</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. NEWSLETTER -->
    <section class="section-padding">
        <div class="container">
            <div class="p-4 p-lg-5 rounded-4 border border-secondary text-center" style="background: linear-gradient(45deg, #111, #000);">
                <h2 class="fw-bold mb-3">Join the Intellectual Elite</h2>
                <p class="text-secondary mb-4">Get weekly summaries of the best debates and logic puzzles.</p>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="input-group">
                            <input type="email" class="form-control bg-dark border-secondary text-white py-3 px-4" placeholder="Enter your email">
                            <button class="btn btn-danger px-4 fw-bold" style="background: var(--primary-red);">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. VIP FOOTER -->
   @include('frontend.shared.footer')

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        // --- THREE.JS BACKGROUND ---
        const container = document.getElementById('canvas-container');
        const scene = new THREE.Scene();
        scene.fog = new THREE.FogExp2(0x050505, 0.002);
        
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
        camera.position.z = 40;
        
        const renderer = new THREE.WebGLRenderer({alpha:true, antialias:true});
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        container.appendChild(renderer.domElement);

        // Particles
        const geo = new THREE.BufferGeometry();
        const count = 1500;
        const pos = new Float32Array(count*3);
        for(let i=0; i<count*3; i++) pos[i] = (Math.random()-0.5)*100;
        geo.setAttribute('position', new THREE.BufferAttribute(pos, 3));
        
        const mat = new THREE.PointsMaterial({
            size: 0.15, 
            color: 0xef233c, 
            transparent: true, 
            opacity: 0.8
        });
        
        const mesh = new THREE.Points(geo, mat);
        scene.add(mesh);

        // Animation
        const clock = new THREE.Clock();
        function animate() {
            requestAnimationFrame(animate);
            const t = clock.getElapsedTime();
            mesh.rotation.y = t * 0.05;
            renderer.render(scene, camera);
        }
        animate();

        window.addEventListener('resize', ()=>{
            camera.aspect = window.innerWidth/window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });

        // --- GSAP ANIMATIONS ---
        gsap.registerPlugin(ScrollTrigger);

        // Header animations
        gsap.from(".fade-in", {
            y: 50, opacity: 0, duration: 1, stagger: 0.2, ease: "power3.out"
        });

        // Scroll reveals for cards
        gsap.utils.toArray('.scroll-reveal').forEach(el => {
            gsap.from(el, {
                scrollTrigger: { 
                    trigger: el, 
                    start: "top 90%", // Trigger slightly earlier for better mobile feel
                    toggleActions: "play none none reverse" 
                },
                y: 50, opacity: 0, duration: 0.8, ease: "power3.out"
            });
        });

        // Counter Animation
        const counters = document.querySelectorAll('.count');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            gsap.to(counter, {
                innerText: target, 
                duration: 2, 
                snap: {innerText: 1}, 
                scrollTrigger: { trigger: counter, start: "top 90%" }
            });
        });
    </script>
</body>
</html>