<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debate Hall - LogicallyDebate</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-red: #ef233c;
            --primary-blue: #3b82f6;
            --dark-bg: #050505;
            --card-bg: #0f0f10;
            --border-color: #27272a;
            --text-main: #e4e4e7;
            --text-muted: #a1a1aa;
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
        .nav-links a { color: #888; text-decoration: none; font-weight: 600; margin: 0 15px; text-transform: uppercase; font-size: 0.9rem; transition: 0.3s; }
        .nav-links a:hover, .nav-links a.active { color: white; }

        /* --- HERO BANNER --- */
        .hero-banner {
            position: relative; height: 500px; width: 100%;
            background: url('https://images.unsplash.com/photo-1555421689-491a97ff2040?q=80&w=1600') center/cover no-repeat;
            display: flex; align-items: flex-end;
        }
        .hero-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, rgba(5,5,5,0.2) 0%, rgba(5,5,5,1) 100%);
        }
        .hero-content { position: relative; z-index: 2; padding: 50px; width: 100%; max-width: 1400px; margin: 0 auto; }
        
        .hero-badge { background: var(--primary-red); color: white; font-weight: 800; font-size: 0.8rem; padding: 5px 12px; border-radius: 4px; text-transform: uppercase; display: inline-block; margin-bottom: 15px; letter-spacing: 1px; }
        .hero-title { font-family: 'Space Grotesk'; font-size: 3.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 20px; max-width: 800px; text-shadow: 0 10px 30px rgba(0,0,0,0.8); }
        .hero-desc { font-size: 1.1rem; color: #ccc; max-width: 600px; margin-bottom: 30px; }
        
        .hero-btns { display: flex; gap: 15px; }
        .btn-watch { background: white; color: black; font-weight: 700; padding: 12px 30px; border-radius: 8px; text-decoration: none; display: flex; align-items: center; gap: 10px; transition: 0.2s; }
        .btn-watch:hover { background: #ddd; transform: translateY(-2px); }
        .btn-info { background: rgba(255,255,255,0.2); color: white; font-weight: 700; padding: 12px 30px; border-radius: 8px; text-decoration: none; backdrop-filter: blur(5px); transition: 0.2s; }
        .btn-info:hover { background: rgba(255,255,255,0.3); }

        /* --- TICKER --- */
        .news-ticker { background: var(--primary-red); color: white; font-weight: 700; font-size: 0.85rem; padding: 8px 0; overflow: hidden; white-space: nowrap; }
        .ticker-content { display: inline-block; padding-left: 100%; animation: scroll 20s linear infinite; }
        @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-100%); } }

        /* --- LAYOUT --- */
        .content-container { max-width: 1400px; margin: 50px auto; padding: 0 20px; }
        
        .section-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; }
        .sec-title { font-family: 'Space Grotesk'; font-size: 2rem; font-weight: 700; margin: 0; }
        .sec-sub { color: var(--text-muted); font-size: 0.9rem; margin-top: 5px; }
        .view-all { color: var(--primary-blue); text-decoration: none; font-weight: 600; font-size: 0.9rem; }

        /* --- CATEGORIES --- */
        .cat-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 15px; margin-bottom: 60px; }
        .cat-card {
            background: #111; border: 1px solid var(--border-color); border-radius: 12px; padding: 25px;
            text-align: center; transition: 0.3s; cursor: pointer;
        }
        .cat-card:hover { background: #1a1a1a; border-color: var(--primary-red); transform: translateY(-5px); }
        .cat-icon { font-size: 1.8rem; color: var(--text-muted); margin-bottom: 10px; transition: 0.3s; }
        .cat-card:hover .cat-icon { color: white; }
        .cat-name { font-weight: 700; font-size: 0.9rem; color: white; }

        /* --- DEBATE CARD --- */
        .debate-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 60px; }
        
        .debate-card {
            background: #0f0f10; border: 1px solid var(--border-color); border-radius: 16px; overflow: hidden;
            transition: 0.3s; position: relative; display: flex; flex-direction: column; height: 100%;
        }
        .debate-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.6); border-color: #333; }
        
        .card-thumb { height: 200px; position: relative; background-size: cover; background-position: center; }
        .card-overlay { position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(to bottom, transparent, #0f0f10); }
        
        .status-tag { 
            position: absolute; top: 15px; left: 15px; padding: 5px 10px; border-radius: 6px; 
            font-size: 0.7rem; font-weight: 800; text-transform: uppercase; z-index: 2; letter-spacing: 0.5px;
        }
        .tag-live { background: var(--primary-red); color: white; animation: pulse 1.5s infinite; }
        .tag-soon { background: #fbbf24; color: black; }
        
        .card-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }
        .cat-label { color: var(--primary-blue); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-bottom: 8px; }
        .card-title { font-family: 'Space Grotesk'; font-size: 1.3rem; font-weight: 700; line-height: 1.3; margin-bottom: 15px; color: white; }
        
        .vs-row { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; background: #151515; padding: 10px; border-radius: 8px; border: 1px solid #222; }
        .vs-av { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; }
        .vs-text { font-size: 0.8rem; color: #888; font-weight: 600; flex-grow: 1; }
        .vs-badge { background: #333; color: #ccc; font-size: 0.65rem; padding: 2px 6px; border-radius: 4px; font-weight: 700; }

        .card-foot { border-top: 1px solid #222; padding-top: 15px; margin-top: auto; display: flex; justify-content: space-between; align-items: center; }
        .view-count { font-size: 0.85rem; color: #888; font-weight: 500; }
        .btn-join { 
            background: transparent; border: 1px solid #444; color: white; padding: 8px 20px; 
            border-radius: 30px; font-size: 0.85rem; font-weight: 700; transition: 0.2s; text-decoration: none;
        }
        .btn-join:hover { background: white; color: black; border-color: white; }

        /* --- FEATURED DEBATERS --- */
        .debater-row { display: flex; overflow-x: auto; gap: 20px; padding-bottom: 20px; scrollbar-width: none; }
        .debater-card { 
            min-width: 200px; background: #111; border: 1px solid #222; border-radius: 12px; padding: 20px; text-align: center;
            transition: 0.3s; cursor: pointer;
        }
        .debater-card:hover { border-color: var(--primary-blue); background: #151518; }
        .d-av { width: 70px; height: 70px; border-radius: 50%; margin-bottom: 15px; border: 3px solid #333; object-fit: cover; }
        .d-name { font-weight: 700; font-size: 1rem; color: white; display: block; margin-bottom: 5px; }
        .d-rank { color: var(--primary-blue); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.6; } 100% { opacity: 1; } }

        /* Responsive */
        @media (max-width: 1200px) { .debate-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) { .debate-grid, .cat-grid { grid-template-columns: 1fr; } .hero-title { font-size: 2.5rem; } }

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
            <a href="{{ route('debates') }}" class="active">Debate Hall</a>
            <a href="{{ route('leaderboard') }}">Leaderboard</a>
            <a href="#">Community</a>
        </div>
        <a href="#" class="btn btn-sm btn-outline-light rounded-pill px-4">Contact Us</a>
    </nav>

    <!-- NEWS TICKER -->
    <div class="news-ticker">
        <div class="ticker-content">
            🔥 BREAKING: "AI Ethics" Debate reaches 50k concurrent viewers! &nbsp;&nbsp;&bull;&nbsp;&nbsp; 🏆 Leaderboard Updated: LogicMaster_99 takes the lead! &nbsp;&nbsp;&bull;&nbsp;&nbsp; 📢 New Tournament "Clash of Minds" starts next Sunday!
        </div>
    </div>

    <!-- HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-badge">Featured Event</span>
            <h1 class="hero-title">The Future of Human Evolution: Tech vs Biology</h1>
            <p class="hero-desc">Join Dr. Michio Kaku and Elon Musk in a legendary debate about the path forward for humanity. Cybernetics or Genetic Engineering?</p>
            <div class="hero-btns">
                <a href="{{ route('debate.room') }}" class="btn-watch"><i class="fas fa-play"></i> Watch Live</a>
                <a href="#" class="btn-info"><i class="fas fa-info-circle"></i> Details</a>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content-container">

        <!-- CATEGORIES -->
        <div class="cat-grid">
            <div class="cat-card">
                <i class="fas fa-landmark cat-icon"></i>
                <div class="cat-name">Politics</div>
            </div>
            <div class="cat-card">
                <i class="fas fa-microchip cat-icon"></i>
                <div class="cat-name">Technology</div>
            </div>
            <div class="cat-card">
                <i class="fas fa-book-open cat-icon"></i>
                <div class="cat-name">Philosophy</div>
            </div>
            <div class="cat-card">
                <i class="fas fa-flask cat-icon"></i>
                <div class="cat-name">Science</div>
            </div>
            <div class="cat-card">
                <i class="fas fa-chart-line cat-icon"></i>
                <div class="cat-name">Economics</div>
            </div>
            <div class="cat-card">
                <i class="fas fa-globe cat-icon"></i>
                <div class="cat-name">History</div>
            </div>
        </div>

        <!-- LIVE NOW SECTION -->
        <div class="section-header">
            <div>
                <h2 class="sec-title">Live Battles <span style="color:var(--primary-red); font-size:1rem; vertical-align:middle;">●</span></h2>
                <p class="sec-sub">Witness high-stakes intellectual combat happening right now.</p>
            </div>
            <a href="#" class="view-all">View All</a>
        </div>

        <div class="debate-grid">
            <!-- Card 1 -->
            <div class="debate-card">
                <div class="card-thumb" style="background-image: url('https://images.unsplash.com/photo-1555421689-491a97ff2040?q=80&w=600');">
                    <div class="card-overlay"></div>
                    <span class="status-tag tag-live">Live</span>
                </div>
                <div class="card-body">
                    <div class="cat-label">Politics</div>
                    <h3 class="card-title">Universal Basic Income: Necessary or Harmful?</h3>
                    <div class="vs-row">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="vs-av">
                        <span class="vs-text">Dr. Harris vs Prof. Daniel</span>
                        <span class="vs-badge">R3</span>
                    </div>
                    <div class="card-foot">
                        <span class="view-count"><i class="fas fa-eye text-danger"></i> 1.2k Watching</span>
                        <a href="{{ route('debate.room') }}" class="btn-join">Join Room</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="debate-card">
                <div class="card-thumb" style="background-image: url('https://images.unsplash.com/photo-1620712943543-bcc4688e7485?q=80&w=600');">
                    <div class="card-overlay"></div>
                    <span class="status-tag tag-live">Live</span>
                </div>
                <div class="card-body">
                    <div class="cat-label">Technology</div>
                    <h3 class="card-title">Is Open Source AI dangerous for global security?</h3>
                    <div class="vs-row">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="vs-av">
                        <span class="vs-text">Sarah Connor vs T-800</span>
                        <span class="vs-badge">R1</span>
                    </div>
                    <div class="card-foot">
                        <span class="view-count"><i class="fas fa-eye text-danger"></i> 850 Watching</span>
                        <a href="{{ route('debate.room') }}" class="btn-join">Join Room</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="debate-card">
                <div class="card-thumb" style="background-image: url('https://images.unsplash.com/photo-1573164713988-8665fc963095?q=80&w=600');">
                    <div class="card-overlay"></div>
                    <span class="status-tag tag-live">Live</span>
                </div>
                <div class="card-body">
                    <div class="cat-label">Religion</div>
                    <h3 class="card-title">Is the Quran the latest, unchanged and true holy book?</h3>
                    <div class="vs-row">
                        <img src="https://randomuser.me/api/portraits/men/12.jpg" class="vs-av">
                        <span class="vs-text">Abdullah vs Jhon</span>
                        <span class="vs-badge">R5</span>
                    </div>
                    <div class="card-foot">
                        <span class="view-count"><i class="fas fa-eye text-danger"></i> 5.2k Watching</span>
                        <a href="{{ route('debate.room') }}" class="btn-join">Join Room</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- UPCOMING SECTION -->
        <div class="section-header">
            <div>
                <h2 class="sec-title">Upcoming Events</h2>
                <p class="sec-sub">Set reminders for the biggest clashes of the week.</p>
            </div>
            <a href="#" class="view-all">Schedule</a>
        </div>

        <div class="debate-grid">
            <!-- Up 1 -->
            <div class="debate-card">
                <div class="card-thumb" style="background-image: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=600');">
                    <div class="card-overlay"></div>
                    <span class="status-tag tag-soon">Starts in 2h</span>
                </div>
                <div class="card-body">
                    <div class="cat-label">Space</div>
                    <h3 class="card-title">Mars Colonization: Feasible in our lifetime?</h3>
                    <div class="vs-row">
                        <img src="https://randomuser.me/api/portraits/men/88.jpg" class="vs-av">
                        <span class="vs-text">Elon M. vs Neil D.</span>
                    </div>
                    <div class="card-foot">
                        <span class="view-count"><i class="far fa-bell"></i> 340 Waiting</span>
                        <button class="btn-join">Notify Me</button>
                    </div>
                </div>
            </div>

            <!-- Up 2 -->
            <div class="debate-card">
                <div class="card-thumb" style="background-image: url('https://images.unsplash.com/photo-1507413245164-6160d8298b31?q=80&w=600');">
                    <div class="card-overlay"></div>
                    <span class="status-tag tag-soon">Tomorrow</span>
                </div>
                <div class="card-body">
                    <div class="cat-label">Ethics</div>
                    <h3 class="card-title">Genetic Engineering: Playing God or Saving Lives?</h3>
                    <div class="vs-row">
                        <img src="https://randomuser.me/api/portraits/men/11.jpg" class="vs-av">
                        <span class="vs-text">Dr. CRISPR vs Bioethicist</span>
                    </div>
                    <div class="card-foot">
                        <span class="view-count"><i class="far fa-bell"></i> 1.1k Waiting</span>
                        <button class="btn-join">Notify Me</button>
                    </div>
                </div>
            </div>

            <!-- Up 3 -->
            <div class="debate-card">
                <div class="card-thumb" style="background-image: url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=600');">
                    <div class="card-overlay"></div>
                    <span class="status-tag tag-soon">Sunday</span>
                </div>
                <div class="card-body">
                    <div class="cat-label">Philosophy</div>
                    <h3 class="card-title">Does Free Will truly exist in a deterministic universe?</h3>
                    <div class="vs-row">
                        <img src="https://randomuser.me/api/portraits/women/22.jpg" class="vs-av">
                        <span class="vs-text">Sam H. vs Jordan P.</span>
                    </div>
                    <div class="card-foot">
                        <span class="view-count"><i class="far fa-bell"></i> 5k Waiting</span>
                        <button class="btn-join">Notify Me</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- FEATURED DEBATERS -->
        <div class="section-header">
            <div>
                <h2 class="sec-title">Top Minds</h2>
                <p class="sec-sub">The highest-ranked debaters of the season.</p>
            </div>
        </div>

        <div class="debater-row">
            <div class="debater-card">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="d-av">
                <span class="d-name">Abdullah R.</span>
                <span class="d-rank">Grandmaster</span>
            </div>
            <div class="debater-card">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="d-av">
                <span class="d-name">Sarah Connor</span>
                <span class="d-rank">Expert</span>
            </div>
            <div class="debater-card">
                <img src="https://randomuser.me/api/portraits/men/86.jpg" class="d-av">
                <span class="d-name">Marcus W.</span>
                <span class="d-rank">Master</span>
            </div>
            <div class="debater-card">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" class="d-av">
                <span class="d-name">Elena Fisher</span>
                <span class="d-rank">Pro</span>
            </div>
            <div class="debater-card">
                <img src="https://randomuser.me/api/portraits/men/11.jpg" class="d-av">
                <span class="d-name">LogicBot_99</span>
                <span class="d-rank">AI Champion</span>
            </div>
            <div class="debater-card">
                <img src="https://randomuser.me/api/portraits/men/5.jpg" class="d-av">
                <span class="d-name">Dave Smith</span>
                <span class="d-rank">Expert</span>
            </div>
        </div>

    </div>

</body>
</html>