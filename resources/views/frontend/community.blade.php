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
        body { 
            background-color: var(--dark-bg); 
            color: white; 
            font-family: 'Inter', sans-serif; 
            padding-top: 90px; /* Space for Fixed Navbar */
        }
        
        /* Sidebar */
        .comm-sidebar { 
            background: #0a0a0a; 
            border-right: 1px solid #222; 
            min-height: 100vh; 
            padding: 30px; 
        }
        .channel-group { margin-bottom: 30px; }
        .channel-title { color: #666; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 10px; padding-left: 10px; }
        .channel-link { display: block; padding: 10px 15px; color: #ccc; text-decoration: none; border-radius: 8px; transition: 0.2s; }
        .channel-link:hover, .channel-link.active { background: #1a1a1a; color: white; }
        .channel-link i { width: 20px; color: var(--primary-red); }

        /* Feed */
        .post-card { background: #111; border: 1px solid #222; border-radius: 12px; padding: 25px; margin-bottom: 20px; transition: 0.2s; }
        .post-card:hover { border-color: #333; background: #151515; }
        .post-tag { font-size: 0.7rem; background: rgba(239, 35, 60, 0.1); color: var(--primary-red); padding: 3px 8px; border-radius: 4px; font-weight: 700; white-space: nowrap; }
        .user-img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }

        .create-post { background: #1a1a1a; padding: 20px; border-radius: 12px; margin-bottom: 30px; border: 1px solid #222; }

        /* Mobile Adjustments */
        @media (max-width: 991px) {
            .comm-sidebar { display: none; } /* Hidden by default on mobile, can use offcanvas if needed */
            .trending-sidebar { display: none; }
            .post-card { padding: 15px; }
        }
    </style>
</head>
<body>

   @include('frontend.shared.navbar')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Hidden on Mobile) -->
            <div class="col-lg-2 d-none d-lg-block comm-sidebar fixed-sidebar">
                <button class="btn btn-danger w-100 mb-4 fw-bold" style="background: var(--primary-red);">New Discussion</button>

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

            <!-- Feed (Full width on mobile, center on desktop) -->
            <div class="col-12 col-lg-7 p-3 p-md-5">
                
                <!-- Mobile Only Topic Filter -->
                <div class="d-lg-none mb-3">
                    <div class="d-flex gap-2 overflow-auto pb-2">
                        <span class="badge bg-danger">General</span>
                        <span class="badge bg-dark border border-secondary">Politics</span>
                        <span class="badge bg-dark border border-secondary">Tech</span>
                        <span class="badge bg-dark border border-secondary">Philosophy</span>
                    </div>
                </div>

                <div class="create-post d-flex gap-3 align-items-center">
                    <img src="https://randomuser.me/api/portraits/men/11.jpg" class="user-img">
                    <input type="text" class="form-control bg-dark border-secondary text-white rounded-pill" placeholder="What's on your mind?">
                </div>

                <!-- Post 1 -->
                <div class="post-card">
                    <div class="d-flex justify-content-between mb-3 align-items-start">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="https://randomuser.me/api/portraits/women/22.jpg" class="user-img">
                            <div>
                                <div class="fw-bold">Athena_Wisdom</div>
                                <div class="text-secondary small">2 hours ago</div>
                            </div>
                        </div>
                        <span class="post-tag">PHILOSOPHY</span>
                    </div>
                    <h5 class="fw-bold fs-5">Does objective morality exist without religion?</h5>
                    <p class="text-secondary small">I've been reading Sam Harris lately and wanted to discuss the concept of the moral landscape...</p>
                    <div class="d-flex gap-4 text-secondary small pt-3 border-top border-secondary mt-3">
                        <span><i class="far fa-heart me-1"></i> 45</span>
                        <span><i class="far fa-comment me-1"></i> 12</span>
                        <span><i class="fas fa-share me-1"></i> Share</span>
                    </div>
                </div>

                <!-- Post 2 -->
                <div class="post-card">
                    <div class="d-flex justify-content-between mb-3 align-items-start">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/86.jpg" class="user-img">
                            <div>
                                <div class="fw-bold">Marcus_Econ</div>
                                <div class="text-secondary small">5 hours ago</div>
                            </div>
                        </div>
                        <span class="post-tag">ECONOMICS</span>
                    </div>
                    <h5 class="fw-bold fs-5">Crypto is just digital fiat, convince me otherwise.</h5>
                    <p class="text-secondary small">The underlying value of bitcoin is purely speculative based on adoption curves...</p>
                    <div class="d-flex gap-4 text-secondary small pt-3 border-top border-secondary mt-3">
                        <span><i class="far fa-heart me-1"></i> 128</span>
                        <span><i class="far fa-comment me-1"></i> 340</span>
                    </div>
                </div>

            </div>

            <!-- Right Sidebar (Trending) -->
            <div class="col-lg-3 d-none d-lg-block p-4 border-start border-secondary bg-black trending-sidebar">
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>