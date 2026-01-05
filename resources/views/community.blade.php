<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community - LogicallyDebate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;700&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
        :root { --primary-red: #ef233c; --dark-bg: #050505; --card-bg: #111; }
        body { background-color: var(--dark-bg); color: white; font-family: 'Inter', sans-serif; }
        
        /* Navbar */
        .navbar { background: rgba(10,10,10,0.95); border-bottom: 1px solid #222; padding: 15px 0; }
        .nav-link { color: #ccc !important; font-weight: 500; margin: 0 10px; }
        .nav-link:hover, .nav-link.active { color: var(--primary-red) !important; }
        .brand-logo { font-size: 1.5rem; font-weight: 800; color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .brand-icon { width: 35px; height: 35px; background: var(--primary-red); color: white; display: flex; align-items: center; justify-content: center; border-radius: 8px; transform: skew(-10deg); }

        /* Sidebar */
        .comm-sidebar { background: #0a0a0a; border-right: 1px solid #222; min-height: 100vh; padding: 30px; }
        .channel-group { margin-bottom: 30px; }
        .channel-title { color: #666; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 10px; padding-left: 10px; }
        .channel-link { display: block; padding: 10px 15px; color: #ccc; text-decoration: none; border-radius: 8px; transition: 0.2s; }
        .channel-link:hover, .channel-link.active { background: #1a1a1a; color: white; }
        .channel-link i { width: 20px; color: var(--primary-red); }

        /* Feed */
        .post-card { background: #111; border: 1px solid #222; border-radius: 12px; padding: 25px; margin-bottom: 20px; transition: 0.2s; }
        .post-card:hover { border-color: #333; background: #151515; }
        .post-tag { font-size: 0.7rem; background: rgba(239, 35, 60, 0.1); color: var(--primary-red); padding: 3px 8px; border-radius: 4px; font-weight: 700; }
        .user-img { width: 40px; height: 40px; border-radius: 50%; }

        .create-post { background: #1a1a1a; padding: 20px; border-radius: 12px; margin-bottom: 30px; border: 1px solid #222; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid px-4">
            <a class="brand-logo" href="{{ route('home') }}">
                <div class="brand-icon"><i class="fas fa-bolt"></i></div>
                <div>Logically<span style="color:var(--primary-red); font-weight:300;">Debate</span></div>
            </a>
            <button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navContent"><span class="fas fa-bars text-white"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="navContent">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('debates') }}">Debate Hall</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('leaderboard') }}">Leaderboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('community') }}">Community</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-none d-md-block comm-sidebar">
                <button class="btn btn-danger w-100 mb-4 fw-bold">New Discussion</button>

                <div class="channel-group">
                    <div class="channel-title">Core Channels</div>
                    <a href="#" class="channel-link active"><i class="fas fa-hashtag"></i> General</a>
                    <a href="#" class="channel-link"><i class="fas fa-bullhorn"></i> Announcements</a>
                    <a href="#" class="channel-link"><i class="fas fa-question-circle"></i> Help & Support</a>
                </div>

                <div class="channel-group">
                    <div class="channel-title">Topics</div>
                    <a href="#" class="channel-link"><i class="fas fa-university"></i> Politics</a>
                    <a href="#" class="channel-link"><i class="fas fa-microchip"></i> Technology</a>
                    <a href="#" class="channel-link"><i class="fas fa-book"></i> Philosophy</a>
                </div>
            </div>

            <!-- Feed -->
            <div class="col-md-9 col-lg-7 p-4 p-md-5">
                <div class="create-post d-flex gap-3 align-items-center">
                    <img src="https://randomuser.me/api/portraits/men/11.jpg" class="user-img">
                    <input type="text" class="form-control bg-dark border-secondary text-white rounded-pill" placeholder="What's on your mind?">
                </div>

                <!-- Post 1 -->
                <div class="post-card">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/22.jpg" class="user-img">
                            <div>
                                <div class="fw-bold">Athena_Wisdom</div>
                                <div class="text-secondary small">2 hours ago</div>
                            </div>
                        </div>
                        <span class="post-tag">PHILOSOPHY</span>
                    </div>
                    <h5>Does objective morality exist without religion?</h5>
                    <p class="text-secondary">I've been reading Sam Harris lately and wanted to discuss the concept of the moral landscape. If well-being is the metric...</p>
                    <div class="d-flex gap-4 text-secondary small pt-3 border-top border-secondary mt-3">
                        <span><i class="far fa-heart me-1"></i> 45 Likes</span>
                        <span><i class="far fa-comment me-1"></i> 12 Comments</span>
                        <span><i class="fas fa-share me-1"></i> Share</span>
                    </div>
                </div>

                <!-- Post 2 -->
                <div class="post-card">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/86.jpg" class="user-img">
                            <div>
                                <div class="fw-bold">Marcus_Econ</div>
                                <div class="text-secondary small">5 hours ago</div>
                            </div>
                        </div>
                        <span class="post-tag">ECONOMICS</span>
                    </div>
                    <h5>Crypto is just digital fiat, convince me otherwise.</h5>
                    <p class="text-secondary">The underlying value of bitcoin is purely speculative based on adoption curves, unlike gold which has industrial use...</p>
                    <div class="d-flex gap-4 text-secondary small pt-3 border-top border-secondary mt-3">
                        <span><i class="far fa-heart me-1"></i> 128 Likes</span>
                        <span><i class="far fa-comment me-1"></i> 340 Comments</span>
                    </div>
                </div>

            </div>

            <!-- Right Sidebar (Trending) -->
            <div class="col-lg-3 d-none d-lg-block p-4 border-start border-secondary bg-black">
                <h6 class="text-uppercase text-secondary fw-bold mb-4">Trending Discussions</h6>
                <div class="mb-3">
                    <a href="#" class="text-white text-decoration-none fw-bold d-block mb-1">AI Regulation Bill</a>
                    <small class="text-secondary">2.5k posts</small>
                </div>
                <div class="mb-3">
                    <a href="#" class="text-white text-decoration-none fw-bold d-block mb-1">Mars Landing 2030</a>
                    <small class="text-secondary">1.2k posts</small>
                </div>
            </div>
        </div>
    </div>

</body>
</html>