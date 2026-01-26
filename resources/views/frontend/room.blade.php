<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Argument Tree - LogicallyDebate</title>
    
    <!-- External CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* -----------------------------------------------------------
           1. CORE VARIABLES
        ----------------------------------------------------------- */
        :root {
            --primary-red: #ef233c;
            --primary-blue: #3b82f6;
            --dark-bg: #050505;
            --grid-line: rgba(255, 255, 255, 0.04);
            --border-color: #1f1f1f;
            
            --pro-gradient: linear-gradient(145deg, #0f172a 0%, #020617 100%);
            --con-gradient: linear-gradient(145deg, #2a0f0f 0%, #170202 100%);
        }

        body {
            background-color: var(--dark-bg);
            color: #e4e4e7;
            font-family: 'Outfit', sans-serif;
            margin: 0; padding: 0;
            overflow: hidden; /* Desktop: Scroll handled by canvas */
            height: 100vh;
            padding-top: 90px;
        }

        /* -----------------------------------------------------------
           2. LIVE HEADER STRIP
        ----------------------------------------------------------- */
        .live-bar {
            height: 60px;
            background: rgba(10,10,10,0.95);
            border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px; 
            position: fixed; top: 90px; left: 0; right: 0; z-index: 1000;
        }
        .topic-title { font-family: 'Space Grotesk'; font-weight: 700; color: white; font-size: 1.2rem; border-left: 4px solid var(--primary-red); padding-left: 15px; }

        /* -----------------------------------------------------------
           3. INFINITE CANVAS (Desktop)
        ----------------------------------------------------------- */
        .canvas-area {
            height: calc(100vh - 150px); /* Adjust for navs */
            background-color: var(--dark-bg);
            /* Technical Grid Pattern */
            background-image: 
                linear-gradient(var(--grid-line) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid-line) 1px, transparent 1px);
            background-size: 40px 40px;
            overflow: auto; /* Allow scrolling */
            cursor: grab;
            display: flex;
            justify-content: center;
            padding: 80px;
        }
        .canvas-area:active { cursor: grabbing; }

        /* TREE CSS (Desktop Only) */
        .tree { display: flex; flex-direction: column; align-items: center; }
        .tree ul { padding-top: 50px; position: relative; display: flex; justify-content: center; transition: all 0.5s; }
        .tree li { float: left; text-align: center; list-style-type: none; position: relative; padding: 50px 20px 0 20px; transition: all 0.5s; }

        /* Connectors */
        .tree li::before, .tree li::after {
            content: ''; position: absolute; top: 0; right: 50%;
            border-top: 2px solid #333; width: 50%; height: 50px;
        }
        .tree li::after { right: auto; left: 50%; border-left: 2px solid #333; }
        .tree li:only-child::after, .tree li:only-child::before { display: none; }
        .tree li:only-child { padding-top: 0; }
        .tree li:first-child::before, .tree li:last-child::after { border: 0 none; }
        .tree li:last-child::before { border-right: 2px solid #333; border-radius: 0 15px 0 0; }
        .tree li:first-child::after { border-radius: 15px 0 0 0; }
        .tree ul ul::before { content: ''; position: absolute; top: 0; left: 50%; border-left: 2px solid #333; width: 0; height: 50px; }

        /* Collapse Logic */
        .tree li.collapsed ul { display: none; }

        /* -----------------------------------------------------------
           4. CARD DESIGN
        ----------------------------------------------------------- */
        .arg-card {
            width: 450px;
            text-align: left;
            position: relative;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            transition: 0.2s;
            border: 1px solid rgba(255,255,255,0.08);
            z-index: 10;
        }
        .arg-card:hover { transform: translateY(-3px); box-shadow: 0 20px 50px rgba(0,0,0,0.7); z-index: 20; border-color: rgba(255,255,255,0.2); }
        
        .theme-pro { background: var(--pro-gradient); border-top: 4px solid var(--primary-blue); }
        .theme-con { background: var(--con-gradient); border-top: 4px solid var(--primary-red); }

        .card-inner { padding: 20px; }

        /* Header */
        .card-head { display: flex; justify-content: space-between; margin-bottom: 15px; }
        .user-grp { display: flex; align-items: center; gap: 12px; }
        .u-avatar { width: 40px; height: 40px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.1); }
        .u-name { font-weight: 700; color: white; display: block; font-size: 0.95rem; }
        .u-role { font-size: 0.65rem; font-weight: 800; padding: 2px 6px; border-radius: 4px; text-transform: uppercase; }
        .role-pro { background: rgba(59, 130, 246, 0.2); color: #93c5fd; }
        .role-con { background: rgba(239, 35, 60, 0.2); color: #fca5a5; }

        /* Body */
        .card-body { font-size: 0.95rem; line-height: 1.5; color: #ddd; margin-bottom: 15px; }

        /* Footer */
        .card-actions { display: flex; gap: 10px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 15px; }
        .act-btn {
            flex: 1; background: transparent; border: 1px solid rgba(255,255,255,0.1);
            color: #888; padding: 8px; border-radius: 6px; font-weight: 600; font-size: 0.8rem;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; transition: 0.2s;
        }
        .act-btn:hover { background: rgba(255,255,255,0.05); color: white; }
        .act-reply { background: rgba(255,255,255,0.1); color: white; border: none; }

        /* Toggle Button */
        .toggle-node {
            position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%);
            width: 28px; height: 28px; background: #222; border: 2px solid #444; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; z-index: 50; font-size: 0.8rem;
        }

        /* -----------------------------------------------------------
           5. MOBILE RESPONSIVENESS (The Magic Switch)
        ----------------------------------------------------------- */
        @media (max-width: 991px) {
            body { overflow-y: auto; height: auto; padding-top: 0; }
            
            /* Hide Desktop Navs/Bars that take space */
            .live-bar { position: relative; top: 0; padding: 15px 20px; flex-direction: column; align-items: flex-start; gap: 10px; height: auto; margin-top: 90px; }
            .topic-title { font-size: 1rem; border-left-width: 3px; }

            /* Transform Canvas to List */
            .canvas-area { display: block; height: auto; padding: 20px 15px; background: none; }
            
            /* Kill the Tree Lines */
            .tree ul { display: block; padding: 0; }
            .tree li { float: none; padding: 0; margin-bottom: 15px; }
            .tree li::before, .tree li::after, .tree ul ul::before { display: none; }

            /* Adjust Cards for Mobile Stream */
            .arg-card { width: 100%; margin-bottom: 15px; }
            
            /* Indentation for replies */
            .tree ul ul { padding-left: 15px; border-left: 2px solid #333; margin-left: 5px; }
            
            .toggle-node { display: none; } /* No collapsing on mobile stream */
        }
    </style>
</head>
<body>

    @include('frontend.shared.navbar')

    <!-- TOPIC STRIP -->
    <div class="live-bar">
        <div class="topic-title">Is the Quran the latest, unchanged and true holy book?</div>
        <div class="d-flex align-items-center gap-3 w-100 justify-content-between mt-2 mt-lg-0">
            <span class="badge bg-danger">LIVE</span>
            <span class="small text-secondary"><i class="fas fa-eye"></i> 5.2k Watching</span>
        </div>
    </div>

    <!-- CANVAS / LIST AREA -->
    <div class="canvas-area">
        <div class="tree">
            <ul>
                <!-- ROOT ARGUMENT -->
                <li>
                    <div class="arg-card theme-pro">
                        <div class="card-inner">
                            <div class="card-head">
                                <div class="user-grp">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="u-avatar">
                                    <div>
                                        <span class="u-name">Abdullah Al Rajjak</span>
                                        <span class="u-role role-pro">PRO</span>
                                    </div>
                                </div>
                                <span class="text-secondary small">08:24 AM</span>
                            </div>
                            <div class="card-body">
                                The Quran was revealed after the Bible, serving as the final testament. Its textual integrity has been preserved through the Hafiz tradition since the 7th century.
                            </div>
                            <div class="card-actions">
                                <button class="act-btn"><i class="fas fa-thumbs-up"></i> 1.2k</button>
                                <button class="act-btn"><i class="fas fa-thumbs-down"></i> 45</button>
                                <button class="act-btn act-reply"><i class="fas fa-reply"></i> Reply</button>
                            </div>
                        </div>
                        <div class="toggle-node" onclick="toggleNode(this)"><i class="fas fa-minus"></i></div>
                    </div>

                    <!-- LEVEL 2 -->
                    <ul>
                        <!-- REPLY 1 (CON) -->
                        <li>
                            <div class="arg-card theme-con">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <div class="user-grp">
                                            <img src="https://randomuser.me/api/portraits/men/85.jpg" class="u-avatar">
                                            <div>
                                                <span class="u-name">Jhon Ahmed</span>
                                                <span class="u-role role-con">CON</span>
                                            </div>
                                        </div>
                                        <span class="text-secondary small">08:26 AM</span>
                                    </div>
                                    <div class="card-body">
                                        Chronological succession doesn't prove authenticity. We need verification of the written Uthmanic Codex compared to pre-Uthmanic manuscripts like Sana'a.
                                    </div>
                                    <div class="card-actions">
                                        <button class="act-btn"><i class="fas fa-thumbs-up"></i> 450</button>
                                        <button class="act-btn"><i class="fas fa-thumbs-down"></i> 890</button>
                                        <button class="act-btn act-reply"><i class="fas fa-reply"></i> Reply</button>
                                    </div>
                                </div>
                                <div class="toggle-node" onclick="toggleNode(this)"><i class="fas fa-minus"></i></div>
                            </div>

                            <!-- LEVEL 3 -->
                            <ul>
                                <li>
                                    <div class="arg-card theme-pro">
                                        <div class="card-inner">
                                            <div class="card-head">
                                                <div class="user-grp">
                                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="u-avatar">
                                                    <div>
                                                        <span class="u-name">Abdullah Al Rajjak</span>
                                                        <span class="u-role role-pro">PRO</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                The carbon dating of the Birmingham Quran manuscript places it within the lifetime of the Prophet, verifying the timeline.
                                            </div>
                                            <div class="card-actions">
                                                <button class="act-btn"><i class="fas fa-thumbs-up"></i> 200</button>
                                                <button class="act-btn act-reply"><i class="fas fa-reply"></i> Reply</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <!-- REPLY 2 (PRO) -->
                        <li>
                            <div class="arg-card theme-pro">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <div class="user-grp">
                                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="u-avatar">
                                            <div>
                                                <span class="u-name">Fatima H</span>
                                                <span class="u-role role-pro">PRO</span>
                                            </div>
                                        </div>
                                        <span class="text-secondary small">08:28 AM</span>
                                    </div>
                                    <div class="card-body">
                                        The oral tradition (Mutawatir) is far stronger than isolated written texts in preserving language nuance and pronunciation over centuries.
                                    </div>
                                    <div class="card-actions">
                                        <button class="act-btn"><i class="fas fa-thumbs-up"></i> 600</button>
                                        <button class="act-btn act-reply"><i class="fas fa-reply"></i> Reply</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <script>
        function toggleNode(btn) {
            const li = btn.closest('li');
            li.classList.toggle('collapsed');
            const icon = btn.querySelector('i');
            if(li.classList.contains('collapsed')) {
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            } else {
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            }
        }

        // Desktop Drag to Scroll
        const slider = document.querySelector('.canvas-area');
        let isDown = false;
        let startX, startY, scrollLeft, scrollTop;

        slider.addEventListener('mousedown', (e) => {
            if(window.innerWidth < 992) return; // Disable on mobile
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            startY = e.pageY - slider.offsetTop;
            scrollLeft = slider.scrollLeft;
            scrollTop = slider.scrollTop;
        });
        slider.addEventListener('mouseleave', () => { isDown = false; slider.classList.remove('active'); });
        slider.addEventListener('mouseup', () => { isDown = false; slider.classList.remove('active'); });
        slider.addEventListener('mousemove', (e) => {
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const y = e.pageY - slider.offsetTop;
            const walkX = (x - startX) * 1.5; // Scroll speed
            const walkY = (y - startY) * 1.5;
            slider.scrollLeft = scrollLeft - walkX;
            slider.scrollTop = scrollTop - walkY;
        });
    </script>
</body>
</html>