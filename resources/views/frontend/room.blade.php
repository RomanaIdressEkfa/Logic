<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Debate Arena - LogicallyDebate</title>
    
    <!-- External CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* -----------------------------------------------------------
           1. CORE VARIABLES & THEME CONFIGURATION
        ----------------------------------------------------------- */
        :root {
            --primary-red: #ef233c;
            --primary-blue: #3b82f6;
            --primary-green: #10b981;
            --dark-bg: #050505;       /* Pitch Black */
            --panel-bg: #0a0a0a;      /* Sidebar BG */
            --grid-line: rgba(255, 255, 255, 0.04);
            --border-color: #1f1f1f;
            
            --pro-gradient: linear-gradient(145deg, #0f172a 0%, #020617 100%);
            --pro-border: #1e40af;
            
            --con-gradient: linear-gradient(145deg, #2a0f0f 0%, #170202 100%);
            --con-border: #991b1b;

            --text-main: #e4e4e7;
            --text-muted: #a1a1aa;
        }

        * { box-sizing: border-box; outline: none; }

        body {
            background-color: var(--dark-bg);
            color: var(--text-main);
            font-family: 'Outfit', sans-serif;
            margin: 0; padding: 0;
            overflow: hidden; /* App-like Interface */
            height: 100vh;
        }

        h1, h2, h3, .font-heading { font-family: 'Space Grotesk', sans-serif; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #000; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-red); }

        /* -----------------------------------------------------------
           2. GLOBAL NAVIGATION (Fixed Top)
        ----------------------------------------------------------- */
        .navbar-global {
            height: 70px;
            background: rgba(5, 5, 5, 0.9);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px;
            z-index: 2000; position: relative;
        }

        .brand-logo { font-family: 'Space Grotesk'; font-size: 1.5rem; font-weight: 800; color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .brand-icon { width: 38px; height: 38px; background: var(--primary-red); color: white; display: flex; align-items: center; justify-content: center; border-radius: 8px; transform: skew(-10deg); font-size: 1.2rem; }
        
        .nav-links { display: flex; gap: 30px; list-style: none; margin: 0; }
        .nav-link { color: #888; text-decoration: none; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; transition: 0.3s; letter-spacing: 0.5px; }
        .nav-link:hover, .nav-link.active { color: white; text-shadow: 0 0 10px rgba(255,255,255,0.3); }

        /* -----------------------------------------------------------
           3. LIVE STATUS BAR
        ----------------------------------------------------------- */
        .live-bar {
            height: 50px;
            background: #000;
            border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px; z-index: 1900; position: relative;
        }
        .topic-title { font-weight: 700; color: white; font-size: 1.1rem; border-left: 3px solid var(--primary-red); padding-left: 15px; margin-left: 15px; }
        
        .live-badge {
            background: rgba(239, 35, 60, 0.1); border: 1px solid var(--primary-red);
            color: var(--primary-red); padding: 4px 10px; border-radius: 4px;
            font-size: 0.75rem; font-weight: 800; text-transform: uppercase;
            display: flex; align-items: center; gap: 8px; animation: glow 2s infinite;
        }
        .dot { width: 8px; height: 8px; background: var(--primary-red); border-radius: 50%; }

        /* -----------------------------------------------------------
           4. MAIN LAYOUT CONTAINER
        ----------------------------------------------------------- */
        .arena-layout {
            display: flex;
            height: calc(100vh - 120px); /* Total viewport minus navs */
            position: relative;
        }

        /* -----------------------------------------------------------
           5. INFINITE ARGUMENT CANVAS (Left Side)
        ----------------------------------------------------------- */
        .canvas-area {
            flex-grow: 1;
            background-color: var(--dark-bg);
            /* Technical Grid Pattern */
            background-image: 
                linear-gradient(var(--grid-line) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid-line) 1px, transparent 1px);
            background-size: 50px 50px;
            overflow: auto; /* Scrollable in all directions */
            padding: 100px;
            cursor: grab;
            display: flex;
            justify-content: center; /* Initial Center */
        }
        .canvas-area:active { cursor: grabbing; }

        /* --- TREE STRUCTURE CSS --- */
        .tree {
            display: flex; flex-direction: column; align-items: center;
            transform-origin: top center;
        }

        .tree ul {
            padding-top: 50px; position: relative;
            display: flex; justify-content: center;
            transition: all 0.5s;
        }

        .tree li {
            float: left; text-align: center; list-style-type: none;
            position: relative; padding: 50px 25px 0 25px;
            transition: all 0.5s;
        }

        /* Tree Connectors (The Lines) */
        .tree li::before, .tree li::after {
            content: ''; position: absolute; top: 0; right: 50%;
            border-top: 2px solid #444; width: 50%; height: 50px;
            transition: all 0.3s;
        }
        .tree li::after { right: auto; left: 50%; border-left: 2px solid #444; }
        
        .tree li:only-child::after, .tree li:only-child::before { display: none; }
        .tree li:only-child { padding-top: 0; }
        
        .tree li:first-child::before, .tree li:last-child::after { border: 0 none; }
        .tree li:last-child::before { border-right: 2px solid #444; border-radius: 0 15px 0 0; }
        .tree li:first-child::after { border-radius: 15px 0 0 0; }
        
        .tree ul ul::before {
            content: ''; position: absolute; top: 0; left: 50%;
            border-left: 2px solid #444; width: 0; height: 50px;
        }

        /* Collapse Logic */
        .tree li.collapsed ul { display: none; }
        .tree li.collapsed .toggle-node i { transform: rotate(0deg); } /* Reset rotate */

        /* -----------------------------------------------------------
           6. CARD DESIGN (The Main Focus)
        ----------------------------------------------------------- */
        .arg-card {
            width: 550px; /* Big Width */
            border-radius: 16px;
            text-align: left;
            position: relative;
            box-shadow: 0 20px 60px rgba(0,0,0,0.6);
            transition: all 0.2s ease;
            border: 1px solid rgba(255,255,255,0.05);
            z-index: 10;
        }
        .arg-card:hover { transform: translateY(-5px); z-index: 20; box-shadow: 0 30px 80px rgba(0,0,0,0.8); }
        .arg-card.selected { border: 2px solid white; box-shadow: 0 0 0 4px rgba(255,255,255,0.1); }

        /* Color Themes */
        .theme-pro { background: var(--pro-gradient); border-top: 5px solid var(--primary-blue); }
        .theme-con { background: var(--con-gradient); border-top: 5px solid var(--primary-red); }

        /* Card Internals */
        .card-inner { padding: 30px; }

        .card-head { display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px; }
        .user-grp { display: flex; align-items: center; gap: 15px; }
        .u-avatar { width: 55px; height: 55px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.1); object-fit: cover; }
        .u-name { font-size: 1.1rem; font-weight: 700; color: white; display: block; margin-bottom: 2px; }
        .u-role { font-size: 0.7rem; font-weight: 800; padding: 3px 8px; border-radius: 4px; text-transform: uppercase; letter-spacing: 1px; }
        .role-pro { background: rgba(59, 130, 246, 0.2); color: #93c5fd; border: 1px solid rgba(59, 130, 246, 0.4); }
        .role-con { background: rgba(239, 35, 60, 0.2); color: #fca5a5; border: 1px solid rgba(239, 35, 60, 0.4); }
        
        .u-time { font-size: 0.8rem; color: var(--text-muted); font-weight: 500; }

        .card-body {
            font-size: 1.2rem; /* LARGE TEXT */
            line-height: 1.6;
            color: #ececec;
            margin-bottom: 25px;
            font-weight: 400;
        }

        .card-actions { display: flex; gap: 15px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; }
        .act-btn {
            flex: 1; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1);
            color: #a1a1aa; padding: 12px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: 0.2s;
        }
        .act-btn:hover { background: rgba(255,255,255,0.1); color: white; }
        .act-agree:hover { color: var(--primary-green); border-color: var(--primary-green); }
        .act-disagree:hover { color: var(--primary-red); border-color: var(--primary-red); }

        /* Collapse Button (+/-) */
        .toggle-node {
            position: absolute; bottom: -20px; left: 50%; transform: translateX(-50%);
            width: 32px; height: 32px; background: #27272a; border: 2px solid #52525b; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; z-index: 50;
            transition: 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }
        .toggle-node:hover { background: white; color: black; border-color: white; }
        .toggle-node i { transition: transform 0.3s; }

        /* -----------------------------------------------------------
           7. RIGHT SIDEBAR (Console)
        ----------------------------------------------------------- */
        .sidebar-console {
            width: 450px;
            background: var(--panel-bg);
            border-left: 1px solid var(--border-color);
            display: flex; flex-direction: column; flex-shrink: 0; z-index: 100;
        }

        /* Video Section */
        .video-grid { display: grid; grid-template-columns: 1fr 1fr; height: 180px; border-bottom: 1px solid var(--border-color); }
        .vid-box { position: relative; background: #000; border-right: 1px solid #222; overflow: hidden; }
        .vid-box img { width: 100%; height: 100%; object-fit: cover; opacity: 0.8; }
        .vid-badge {
            position: absolute; bottom: 10px; left: 10px;
            background: rgba(0,0,0,0.8); color: white; padding: 3px 8px; border-radius: 4px;
            font-size: 0.7rem; font-weight: 700; border-left: 3px solid;
        }
        .mic-on { position: absolute; top: 10px; right: 10px; color: #4ade80; animation: pulse 1s infinite; }

        /* Voting Stats */
        .vote-area { padding: 25px; background: #0f0f10; border-bottom: 1px solid var(--border-color); }
        .vote-flex { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 8px; }
        .vote-num { font-family: 'Space Grotesk'; font-size: 2rem; font-weight: 800; line-height: 1; }
        .vote-label { font-size: 0.75rem; font-weight: 700; color: #666; text-transform: uppercase; }
        
        .bar-wrap { height: 10px; background: #27272a; border-radius: 20px; display: flex; overflow: hidden; }
        .fill-p { height: 100%; width: 65%; background: var(--primary-blue); box-shadow: 0 0 10px rgba(59,130,246,0.5); }
        .fill-c { height: 100%; width: 35%; background: var(--primary-red); box-shadow: 0 0 10px rgba(239,35,60,0.5); }

        .vote-btns { display: flex; gap: 15px; margin-top: 20px; }
        .v-btn { flex: 1; padding: 12px; border-radius: 8px; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; border: none; cursor: pointer; color: white; display: flex; align-items: center; justify-content: center; gap: 8px; transition: 0.2s; }
        .vb-pro { background: #172554; border: 1px solid #1e3a8a; } .vb-pro:hover { background: var(--primary-blue); }
        .vb-con { background: #450a0a; border: 1px solid #7f1d1d; } .vb-con:hover { background: var(--primary-red); }

        /* Chat Feed */
        .feed { flex-grow: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 15px; background: #0a0a0a; }
        .f-item { font-size: 0.9rem; line-height: 1.5; color: #d4d4d8; padding-bottom: 10px; border-bottom: 1px solid #1f1f1f; }
        .f-user { font-weight: 700; margin-right: 5px; }
        .sys-msg { color: #555; font-style: italic; font-size: 0.8rem; text-align: center; margin: 10px 0; border: none; }

        /* Input Area (Bottom Right) */
        .input-zone { padding: 25px; background: #111; border-top: 1px solid var(--border-color); }
        .reply-meta { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 0.8rem; color: #777; }
        .target-user { color: white; font-weight: 700; }

        /* Custom Stance Switcher */
        .stance-switch { display: flex; background: #000; padding: 5px; border-radius: 8px; border: 1px solid #333; margin-bottom: 15px; }
        .stance-opt { flex: 1; }
        .stance-chk { display: none; }
        .stance-lbl { 
            display: flex; justify-content: center; align-items: center; gap: 8px;
            width: 100%; padding: 10px; border-radius: 6px; 
            font-size: 0.75rem; font-weight: 800; text-transform: uppercase; cursor: pointer; color: #555; transition: 0.2s;
        }
        
        /* Interactive Colors */
        #st-agree:checked + label { background: #064e3b; color: #4ade80; box-shadow: 0 0 10px rgba(74,222,128,0.1); }
        #st-disagree:checked + label { background: #450a0a; color: #f87171; box-shadow: 0 0 10px rgba(248,113,113,0.1); }

        .write-box { 
            width: 100%; background: #050505; border: 1px solid #333; color: white; 
            border-radius: 8px; padding: 15px; font-size: 0.95rem; resize: none; font-family: 'Inter'; 
        }
        .write-box:focus { border-color: #666; }

        .send-btn { 
            width: 100%; padding: 14px; margin-top: 15px; background: white; color: black; 
            font-weight: 800; border: none; border-radius: 8px; text-transform: uppercase; cursor: pointer; 
            display: flex; align-items: center; justify-content: center; gap: 10px; transition: 0.2s;
        }
        .send-btn:hover { background: #d4d4d8; transform: translateY(-2px); }

        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.5; } 100% { opacity: 1; } }
        @keyframes glow { 0% { box-shadow: 0 0 5px rgba(239,35,60,0.2); } 50% { box-shadow: 0 0 15px rgba(239,35,60,0.6); } 100% { box-shadow: 0 0 5px rgba(239,35,60,0.2); } }

    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar-global">
        <a class="brand-logo" href="#">
            <div class="brand-icon"><i class="fas fa-bolt"></i></div>
            <div>Logically<span>Debate</span></div>
        </a>
        <ul class="nav-links">
             <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('debates') }}">Debate Hall</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('leaderboard') }}">Leaderboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('community') }}">Community</a></li>
        </ul>
        <a href="#" class="btn btn-outline-light rounded-pill px-4" style="border-color:#333;">Contact Us</a>
    </nav>

    <!-- LIVE STRIP -->
    <div class="live-bar">
        <div class="d-flex align-items-center">
            <a href="#" class="text-secondary text-decoration-none fw-bold small"><i class="fas fa-chevron-left"></i> Leave Arena</a>
            <div class="topic-title">Is the Quran the latest, unchanged and true holy book?</div>
        </div>
        <div class="d-flex align-items-center gap-4">
            <div class="live-badge"><div class="dot"></div> LIVE DEBATE</div>
            <div class="small fw-bold text-muted"><i class="fas fa-users text-danger me-2"></i> 5,227 Watching</div>
        </div>
    </div>

    <!-- MAIN LAYOUT -->
    <div class="arena-layout">
        
        <!-- LEFT: INFINITE TREE CANVAS -->
        <div class="canvas-area">
            <div class="tree">
                <div class="badge bg-dark border border-secondary text-muted rounded-pill px-4 py-2 mb-5 fw-bold">ARGUMENT ROOT</div>

                <ul>
                    <!-- NODE 1 (PRO) -->
                    <li>
                        <div class="arg-card theme-pro selected" onclick="selectCard(this, 'Abdullah Al Rajjak')">
                            <div class="card-inner">
                                <div class="card-head">
                                    <div class="user-grp">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="u-avatar">
                                        <div>
                                            <span class="u-name">Abdullah Al Rajjak <span class="u-role role-pro">PRO</span></span>
                                            <span class="u-time">08:24 AM</span>
                                        </div>
                                    </div>
                                    <i class="fas fa-ellipsis-h text-muted" style="cursor:pointer;"></i>
                                </div>
                                <div class="card-body">
                                    "The Quran was revealed after the Bible, serving as the final testament. Its textual integrity has been preserved through the Hafiz tradition (oral memorization) since the 7th century, unlike other scriptures which have undergone revisions."
                                </div>
                                <div class="card-actions">
                                    <button class="act-btn act-agree"><i class="fas fa-thumbs-up"></i> Agree (1.2k)</button>
                                    <button class="act-btn act-disagree"><i class="fas fa-thumbs-down"></i> Disagree (45)</button>
                                </div>
                            </div>
                            <!-- Collapse Button -->
                            <div class="toggle-node" onclick="toggleNode(this, event)">
                                <i class="fas fa-minus"></i>
                            </div>
                        </div>

                        <!-- LEVEL 2 -->
                        <ul>
                            <!-- CHILD 1 (CON) -->
                            <li>
                                <div class="arg-card theme-con" onclick="selectCard(this, 'Jhon Ahmed')">
                                    <div class="card-inner">
                                        <div class="card-head">
                                            <div class="user-grp">
                                                <img src="https://randomuser.me/api/portraits/men/85.jpg" class="u-avatar">
                                                <div>
                                                    <span class="u-name">Jhon's Ahmed <span class="u-role role-con">CON</span></span>
                                                    <span class="u-time">08:26 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            Chronological succession doesn't prove authenticity. We need historical verification of the <strong>written text</strong> (Uthmanic Codex) compared to pre-Uthmanic manuscripts like the Sana'a manuscript to verify status scientifically.
                                        </div>
                                        <div class="card-actions">
                                            <button class="act-btn act-agree">Agree (450)</button>
                                            <button class="act-btn act-disagree">Disagree (890)</button>
                                        </div>
                                    </div>
                                    <div class="toggle-node" onclick="toggleNode(this, event)"><i class="fas fa-minus"></i></div>
                                </div>

                                <!-- LEVEL 3 (Siblings) -->
                                <ul>
                                    <!-- Grandchild 1 (Pro) -->
                                    <li>
                                        <div class="arg-card theme-pro" onclick="selectCard(this, 'Abdullah Al Rajjak')">
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <div class="user-grp">
                                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="u-avatar">
                                                        <div>
                                                            <span class="u-name">Abdullah Al Rajjak <span class="u-role role-pro">PRO</span></span>
                                                            <span class="u-time">08:30 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    Agreed on verification. The carbon dating of the Birmingham Quran manuscript places it within the lifetime of the Prophet.
                                                </div>
                                                <div class="card-actions">
                                                    <button class="act-btn act-agree">Agree</button>
                                                    <button class="act-btn act-disagree">Disagree</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <!-- Grandchild 2 (Pro) -->
                                    <li>
                                        <div class="arg-card theme-pro" onclick="selectCard(this, 'Scholar Yusuf')">
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <div class="user-grp">
                                                        <img src="https://randomuser.me/api/portraits/men/12.jpg" class="u-avatar">
                                                        <div>
                                                            <span class="u-name">Scholar Yusuf <span class="u-role role-pro">PRO</span></span>
                                                            <span class="u-time">08:32 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    Furthermore, the minor dialectal variations (Qira'at) do not constitute a change in meaning, but rather enrich the understanding.
                                                </div>
                                                <div class="card-actions">
                                                    <button class="act-btn act-agree">Agree</button>
                                                    <button class="act-btn act-disagree">Disagree</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <!-- CHILD 2 (PRO) - Sibling of Jhon -->
                            <li>
                                <div class="arg-card theme-pro" onclick="selectCard(this, 'Fatima H')">
                                    <div class="card-inner">
                                        <div class="card-head">
                                            <div class="user-grp">
                                                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="u-avatar">
                                                <div>
                                                    <span class="u-name">Fatima H <span class="u-role role-pro">PRO</span></span>
                                                    <span class="u-time">08:28 AM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            The oral tradition (Mutawatir) is far stronger than isolated written texts in preserving language nuance and pronunciation over centuries.
                                        </div>
                                        <div class="card-actions">
                                            <button class="act-btn act-agree">Agree (600)</button>
                                            <button class="act-btn act-disagree">Disagree (10)</button>
                                        </div>
                                    </div>
                                    <div class="toggle-node" onclick="toggleNode(this, event)"><i class="fas fa-minus"></i></div>
                                </div>
                                
                                <!-- Level 3 -->
                                <ul>
                                    <li>
                                        <div class="arg-card theme-con" onclick="selectCard(this, 'Critic X')">
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <div class="user-grp">
                                                        <img src="https://randomuser.me/api/portraits/men/5.jpg" class="u-avatar">
                                                        <div>
                                                            <span class="u-name">Critic X <span class="u-role role-con">CON</span></span>
                                                            <span class="u-time">08:35 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    But memory is fallible. How do we account for the variances recorded in early Hadith literature regarding recitation?
                                                </div>
                                                <div class="card-actions">
                                                    <button class="act-btn act-agree">Agree</button>
                                                    <button class="act-btn act-disagree">Disagree</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- RIGHT: SIDEBAR CONSOLE -->
        <div class="sidebar-console">
            
            <!-- Video -->
            <div class="video-grid">
                <div class="vid-box">
                    <img src="https://images.unsplash.com/photo-1584286595398-a59f21d313f5?q=80&w=1000&auto=format&fit=crop">
                    <div class="vid-badge" style="border-color:var(--primary-blue)">Abdullah (Pro)</div>
                    <div class="mic-on"><i class="fas fa-microphone"></i></div>
                </div>
                <div class="vid-box">
                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400" style="filter:grayscale(60%)">
                    <div class="vid-badge" style="border-color:var(--primary-red)">Jhon's (Con)</div>
                </div>
            </div>

            <!-- Stats -->
            <div class="vote-area">
                <div class="vote-flex">
                    <div class="vote-label" style="color:var(--primary-blue)">PRO SUPPORT</div>
                    <div class="vote-label" style="color:var(--primary-red)">CON SUPPORT</div>
                </div>
                <div class="vote-flex">
                    <span class="vote-num" style="color:var(--primary-blue)">2,451</span>
                    <span class="vote-num" style="color:var(--primary-red)">1,320</span>
                </div>
                <div class="bar-wrap">
                    <div class="fill-p"></div>
                    <div class="fill-c"></div>
                </div>
                <div class="vote-btns">
                    <button class="v-btn vb-pro"><i class="fas fa-thumbs-up"></i> Vote Pro</button>
                    <button class="v-btn vb-con"><i class="fas fa-thumbs-down"></i> Vote Con</button>
                </div>
            </div>

            <!-- Chat -->
            <div class="feed">
                <div class="sys-msg">--- Debate Started 10 mins ago ---</div>
                <div class="f-item"><span class="f-user" style="color:#60a5fa">User123:</span> Carbon dating is key here.</div>
                <div class="f-item"><span class="f-user" style="color:#f87171">LogicFan:</span> What about the Sana'a text?</div>
                <div class="f-item"><span class="f-user" style="color:#34d399">Muslim_Logic:</span> Lower text was practice.</div>
                <div class="f-item"><span class="f-user" style="color:#facc15">Mod_Bot:</span> Please keep arguments civil.</div>
                <div class="f-item"><span class="f-user" style="color:#a78bfa">Dave:</span> Abdullah is calm, Jhon is aggressive.</div>
            </div>

            <!-- Input Area -->
            <div class="input-zone">
                <div class="reply-meta">
                    <span>Replying to:</span>
                    <span class="target-user" id="replyTarget">Abdullah Al Rajjak</span>
                </div>

                <div class="stance-switch">
                    <div class="stance-opt">
                        <input type="radio" name="st" id="st-agree" class="stance-chk" checked>
                        <label for="st-agree" class="stance-lbl"><i class="fas fa-check"></i> Agree</label>
                    </div>
                    <div class="stance-opt">
                        <input type="radio" name="st" id="st-disagree" class="stance-chk">
                        <label for="st-disagree" class="stance-lbl"><i class="fas fa-times"></i> Disagree</label>
                    </div>
                </div>

                <textarea class="write-box" rows="3" placeholder="Construct your argument here..."></textarea>
                
                <button class="send-btn"><i class="fas fa-paper-plane"></i> POST ARGUMENT</button>
            </div>

        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        // 1. Collapse/Expand Function
        function toggleNode(btn, e) {
            e.stopPropagation(); // Stop clicking card
            const li = btn.closest('li');
            li.classList.toggle('collapsed');
            
            // Toggle Icon (+/-)
            const icon = btn.querySelector('i');
            if (li.classList.contains('collapsed')) {
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            } else {
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            }
        }

        // 2. Select Card & Update Input Target
        function selectCard(card, name) {
            // Remove active class from all
            document.querySelectorAll('.arg-card').forEach(el => el.classList.remove('selected'));
            // Add to clicked
            card.classList.add('selected');
            // Update Sidebar Name
            document.getElementById('replyTarget').innerText = name;
        }
    </script>

</body>
</html>