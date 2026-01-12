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
        }

        h1, h2, h3, h4, .brand-font { font-family: 'Space Grotesk', sans-serif; }
        a { text-decoration: none; }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #000; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-red); }

        #canvas-container {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
            background: radial-gradient(circle at center, #110505 0%, #000000 100%);
        }

      
        .hero-section { 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            padding-top: 80px; 
            position: relative;
            z-index: 1;
        }
        .hero-title { 
            font-size: clamp(2.5rem, 5vw, 5rem); 
            line-height: 1.1; 
            font-weight: 800; 
            margin-bottom: 25px; 
        }
        .text-outline {
            -webkit-text-stroke: 1px rgba(255,255,255,0.4);
            color: transparent;
        }
        
        .stat-box {
            text-align: center; 
            padding: 30px 20px; 
            border: 1px solid var(--border-color); 
            border-radius: 12px;
            background: rgba(15, 15, 15, 0.6); 
            backdrop-filter: blur(5px);
            margin-top: 40px;
            transition: transform 0.3s;
        }
        .stat-box:hover { border-color: var(--primary-red); transform: translateY(-5px); }
        .stat-number { font-size: clamp(2rem, 3vw, 3.5rem); font-weight: 800; color: white; display: block; }
        .stat-label { color: var(--primary-red); text-transform: uppercase; letter-spacing: 1px; font-size: 0.75rem; font-weight: 700; }
        .section-padding { padding: 100px 0; }
        .section-header { margin-bottom: 50px; }
        .section-title { font-size: 2.5rem; font-weight: 700; margin-bottom: 10px; }
        .section-sub { color: var(--text-grey); }

        /* Battle Cards */
        .custom-card {
            background: var(--card-bg); 
            border: 1px solid var(--border-color); 
            border-radius: 16px;
            overflow: hidden; 
            transition: all 0.3s ease; 
            height: 100%; 
            position: relative;
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
        }
        .card-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(15,15,15,1) 100%);
        }
        .live-badge {
            position: absolute; top: 15px; left: 15px; 
            background: var(--primary-red); color: white;
            padding: 6px 12px; font-size: 0.7rem; font-weight: 800; 
            border-radius: 4px; text-transform: uppercase;
            animation: pulse 1.5s infinite;
            z-index: 2;
        }

        /* Judge Cards */
        .judge-card {
            text-align: center;
            background: #0a0a0a;
            padding: 30px 20px;
            border-radius: 20px;
            border: 1px solid #1a1a1a;
            transition: 0.3s;
            height: 100%;
        }
        .judge-card:hover { border-color: var(--primary-red); transform: translateY(-5px); }
        .judge-img {
            width: 90px; height: 90px; border-radius: 50%; object-fit: cover;
            border: 3px solid #333; margin-bottom: 20px;
        }
        .verified-icon { color: #1da1f2; margin-left: 5px; }

        /* Rank Items */
        .rank-item {
            display: flex; align-items: center; justify-content: space-around;
            background: #111; padding: 20px; border-radius: 12px; margin-bottom: 15px;
            border-left: 4px solid transparent;
            transition: 0.3s;
        }
        .rank-item:hover { background: #161616; transform: scale(1.02); }
        .rank-1 { border-left-color: #FFD700; } 
        .rank-2 { border-left-color: #C0C0C0; } 
        .rank-3 { border-left-color: #CD7F32; } 
        .rank-number { font-size: 1.5rem; font-weight: 800; color: #444; width: 40px; }
        .rank-score { font-weight: 700; color: var(--primary-red); }

        /* Step Cards */
        .step-card { padding: 30px; border-left: 2px solid var(--border-color); position: relative; height: 100%; }
        .step-card:hover { border-left-color: var(--primary-red); background: linear-gradient(to right, rgba(239,35,60,0.05), transparent); }
        .step-number { font-size: 4rem; font-weight: 800; color: rgba(255,255,255,0.05); position: absolute; top: 0; right: 20px; }

        /* --- 6. FOOTER --- */
        footer { 
            border-top: 1px solid var(--border-color); 
            padding: 80px 0 30px 0; 
            margin-top: 100px; 
            background: #020202; 
        }
        .footer-heading { font-weight: 700; margin-bottom: 25px; color: white; font-size: 1.1rem; }
        .footer-link { display: block; color: #666; font-size: 0.9rem; margin-bottom: 12px; transition: 0.2s; }
        .footer-link:hover { color: var(--primary-red); padding-left: 5px; }
        
        .social-btn {
            width: 40px; height: 40px; border-radius: 50%; background: #111; color: white;
            display: inline-flex; align-items: center; justify-content: center; margin-right: 10px;
            transition: 0.3s; font-size: 1rem;
        }
        .social-btn:hover { background: var(--primary-red); transform: rotate(360deg); color: white; }

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.5; } 100% { opacity: 1; } }

        /* --- 7. MOBILE RESPONSIVENESS --- */
        @media (max-width: 991px) {
            .hero-title { font-size: 3.5rem; }
            .hero-section { text-align: center; padding-top: 120px; padding-bottom: 50px; }
            .hero-section .d-flex { justify-content: center; }
            .stat-box { margin-top: 20px; }
            .navbar-collapse { background: #0a0a0a; padding: 20px; border-radius: 10px; margin-top: 15px; border: 1px solid #222; }
        }
        
        @media (max-width: 768px) {
            .section-padding { padding: 60px 0; }
            .hero-title { font-size: 2.8rem; }
            .step-card { border-left: none; border-top: 2px solid var(--border-color); margin-bottom: 20px; }
            .step-card:hover { border-top-color: var(--primary-red); }
        }
    </style>
</head>
<body>

    <!-- 3D Background -->
    <div id="canvas-container"></div>
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
                    <p class="lead text-secondary mb-5 fade-in" style="max-width: 550px; margin: 0 auto 3rem lg-0;">
                        Welcome to LogicallyDebate. A decentralized platform where ideas fight for survival, judging is transparent, and intelligence is rewarded.
                    </p>
                    <div class="d-flex gap-3 fade-in flex-wrap">
                        <a href="{{ route('debates') }}" class="btn btn-danger btn-lg px-5 rounded-pill fw-bold" style="background: var(--primary-red);">Start Debating</a>
                        <button class="btn btn-outline-light btn-lg px-5 rounded-pill">Watch Demo</button>
                    </div>
                </div>
                
                <!-- 3D Interactive Overlay (Hidden on Mobile) -->
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="p-5 border border-secondary rounded-4 bg-dark bg-opacity-25 fade-in" style="backdrop-filter: blur(10px);">
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="m-0">Current Top Topic</h5>
                            <span class="badge bg-danger">HOT</span>
                        </div>
                        <h3 class="fw-bold mb-3">"AI will replace human creativity by 2030"</h3>
                        <div class="progress mb-3" style="height: 6px; background: #333;">
                            <div class="progress-bar bg-primary" style="width: 65%"></div>
                            <div class="progress-bar bg-danger" style="width: 35%"></div>
                        </div>
                        <div class="d-flex justify-content-between text-secondary small">
                            <span>AGREE (65%)</span>
                            <span>DISAGREE (35%)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="row fade-in">
                <div class="col-6 col-md-4">
                    <div class="stat-box">
                        <span class="stat-number count" data-target="1240">0</span>
                        <span class="stat-label">Live Debates</span>
                    </div>
                </div>
                <div class="col-6 col-md-4">
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
                    <p class="section-sub m-0">Witness high-stakes intellectual combat happening right now.</p>
                </div>
                <a href="{{ route('debates') }}" class="btn btn-outline-secondary rounded-pill">View Debate Hall</a>
            </div>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="custom-card scroll-reveal">
                        <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1555421689-491a97ff2040?q=80&w=800&auto=format&fit=crop');">
                            <div class="card-overlay"></div>
                            <span class="live-badge">Live</span>
                        </div>
                        <div class="p-4">
                            <div class="small text-danger fw-bold mb-2">POLITICS</div>
                            <h4 class="fw-bold mb-3">Universal Basic Income: Necessary or Harmful?</h4>
                            <div class="d-flex align-items-center justify-content-between mt-4 border-top border-secondary pt-3">
                                <div class="d-flex">
                                    <div class="bg-secondary rounded-circle" style="width:30px;height:30px; border:2px solid #000;"></div>
                                    <div class="bg-light rounded-circle" style="width:30px;height:30px; margin-left:-10px; border:2px solid #000;"></div>
                                </div>
                                <span class="text-secondary small"><i class="fas fa-eye me-1 text-danger"></i> 1.2k Watching</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="custom-card scroll-reveal">
                        <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1620712943543-bcc4688e7485?q=80&w=800&auto=format&fit=crop');">
                             <div class="card-overlay"></div>
                            <span class="live-badge">Live</span>
                        </div>
                        <div class="p-4">
                            <div class="small text-info fw-bold mb-2">TECHNOLOGY</div>
                            <h4 class="fw-bold mb-3">Is Open Source AI dangerous for security?</h4>
                            <div class="d-flex align-items-center justify-content-between mt-4 border-top border-secondary pt-3">
                                <div class="d-flex">
                                    <div class="bg-secondary rounded-circle" style="width:30px;height:30px; border:2px solid #000;"></div>
                                    <div class="bg-light rounded-circle" style="width:30px;height:30px; margin-left:-10px; border:2px solid #000;"></div>
                                </div>
                                <span class="text-secondary small"><i class="fas fa-eye me-1 text-danger"></i> 850 Watching</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="custom-card scroll-reveal">
                        <div class="card-img-top" style="background-image: url('https://images.unsplash.com/photo-1507413245164-6160d8298b31?q=80&w=800&auto=format&fit=crop');">
                             <div class="card-overlay"></div>
                            <span class="live-badge">Live</span>
                        </div>
                        <div class="p-4">
                            <div class="small text-warning fw-bold mb-2">SCIENCE</div>
                            <h4 class="fw-bold mb-3">Genetic Engineering: Playing God or Saving Lives?</h4>
                            <div class="d-flex align-items-center justify-content-between mt-4 border-top border-secondary pt-3">
                                <div class="d-flex">
                                    <div class="bg-secondary rounded-circle" style="width:30px;height:30px; border:2px solid #000;"></div>
                                    <div class="bg-light rounded-circle" style="width:30px;height:30px; margin-left:-10px; border:2px solid #000;"></div>
                                </div>
                                <span class="text-secondary small"><i class="fas fa-eye me-1 text-danger"></i> 3.4k Watching</span>
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
                <p class="section-sub">Our debates are moderated by verified industry experts.</p>
            </div>

            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="judge-card scroll-reveal">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Judge" class="judge-img">
                        <h5 class="fw-bold mb-1">Dr. Alan</h5>
                        <p class="text-secondary small">Philosophy Chair</p>
                        <div class="badge bg-secondary bg-opacity-25 text-light mt-2">Philosophy</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="judge-card scroll-reveal">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Judge" class="judge-img">
                        <h5 class="fw-bold mb-1">Sarah C.</h5>
                        <p class="text-secondary small">Tech Ethics Lead</p>
                        <div class="badge bg-secondary bg-opacity-25 text-light mt-2">AI & Tech</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="judge-card scroll-reveal">
                        <img src="https://randomuser.me/api/portraits/men/86.jpg" alt="Judge" class="judge-img">
                        <h5 class="fw-bold mb-1">Marcus W.</h5>
                        <p class="text-secondary small">Senior Economist</p>
                        <div class="badge bg-secondary bg-opacity-25 text-light mt-2">Economics</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="judge-card scroll-reveal">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Judge" class="judge-img">
                        <h5 class="fw-bold mb-1">Elena F.</h5>
                        <p class="text-secondary small">Historian & Author</p>
                        <div class="badge bg-secondary bg-opacity-25 text-light mt-2">History</div>
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
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-card scroll-reveal">
                        <span class="step-number">01</span>
                        <h4 class="fw-bold mt-4">Challenge</h4>
                        <p class="text-secondary">Create a topic or accept a challenge. Define the rules, time limits, and judging criteria.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card scroll-reveal">
                        <span class="step-number">02</span>
                        <h4 class="fw-bold mt-4">Debate</h4>
                        <p class="text-secondary">Engage in structured rounds. Our AI detects logical fallacies in real-time.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card scroll-reveal">
                        <span class="step-number">03</span>
                        <h4 class="fw-bold mt-4">Verdict</h4>
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
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h2 class="section-title mb-4">Top Debaters <br> of the Month</h2>
                    <p class="text-secondary mb-4">
                        Ranking is based on logic score, lack of fallacies, and audience retention. Climb the ranks to earn exclusive badges and invitations to VIP tournaments.
                    </p>
                    <a href="#" class="btn btn-outline-light rounded-pill px-4">View Global Rankings</a>
                </div>
                
                <div class="col-lg-6 offset-lg-1">
                    <!-- Rank 1 -->
                    <div class="rank-item rank-1 scroll-reveal">
                        <div class="d-flex align-items-center gap-3">
                            <span class="rank-number">01</span>
                            <img src="https://randomuser.me/api/portraits/men/11.jpg" style="width:50px; height:50px; border-radius:50%;" alt="">
                            <div>
                                <h5 class="m-0 fw-bold">LogicMaster_99</h5>
                                <small class="text-secondary">Grandmaster Debater</small>
                            </div>
                        </div>
                        <div class="rank-score">9,850 XP</div>
                    </div>

                    <!-- Rank 2 -->
                    <div class="rank-item rank-2 scroll-reveal">
                        <div class="d-flex align-items-center gap-3">
                            <span class="rank-number">02</span>
                            <img src="https://randomuser.me/api/portraits/women/22.jpg" style="width:50px; height:50px; border-radius:50%;" alt="">
                            <div>
                                <h5 class="m-0 fw-bold">Athena_Wisdom</h5>
                                <small class="text-secondary">Master Debater</small>
                            </div>
                        </div>
                        <div class="rank-score">8,420 XP</div>
                    </div>

                    <!-- Rank 3 -->
                    <div class="rank-item rank-3 scroll-reveal">
                        <div class="d-flex align-items-center gap-3">
                            <span class="rank-number">03</span>
                            <img src="https://randomuser.me/api/portraits/men/33.jpg" style="width:50px; height:50px; border-radius:50%;" alt="">
                            <div>
                                <h5 class="m-0 fw-bold">SocratesReborn</h5>
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
                <div class="col-md-8">
                    <div class="custom-card p-5 d-flex align-items-end" style="min-height: 300px; background: linear-gradient(to top, black, transparent), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1000&auto=format&fit=crop') center/cover;">
                        <div>
                            <span class="badge bg-danger mb-2">HOT TOPIC</span>
                            <h2 class="fw-bold">Space Colonization</h2>
                            <p class="text-light">Is Mars truly the backup plan for humanity?</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
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
            <div class="p-5 rounded-4 border border-secondary text-center" style="background: linear-gradient(45deg, #111, #000);">
                <h2 class="fw-bold mb-3">Join the Intellectual Elite</h2>
                <p class="text-secondary mb-4">Get weekly summaries of the best debates and logic puzzles.</p>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="email" class="form-control bg-dark border-secondary text-white py-3" placeholder="Enter your email">
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
                    start: "top 85%",
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





