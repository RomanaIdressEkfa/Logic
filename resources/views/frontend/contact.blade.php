<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - LogicallyDebate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;700&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
        :root { --primary-red: #ef233c; --dark-bg: #050505; }
        body { background-color: var(--dark-bg); color: white; font-family: 'Inter', sans-serif; }
        
        .navbar { background: rgba(10,10,10,0.95); border-bottom: 1px solid #222; padding: 15px 0; }
        .nav-link { color: #ccc !important; font-weight: 500; margin: 0 10px; }
        .nav-link:hover, .nav-link.active { color: var(--primary-red) !important; }
        .brand-logo { font-size: 1.5rem; font-weight: 800; color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .brand-icon { width: 35px; height: 35px; background: var(--primary-red); color: white; display: flex; align-items: center; justify-content: center; border-radius: 8px; transform: skew(-10deg); }

        .contact-box { background: #111; border: 1px solid #222; padding: 40px; border-radius: 20px; }
        .form-control { background: #1a1a1a; border: 1px solid #333; color: white; padding: 15px; }
        .form-control:focus { background: #1a1a1a; border-color: var(--primary-red); color: white; box-shadow: none; }
        .icon-box { width: 50px; height: 50px; background: rgba(239, 35, 60, 0.1); color: var(--primary-red); display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 1.2rem; margin-bottom: 15px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="brand-logo" href="{{ route('home') }}">
                <div class="brand-icon"><i class="fas fa-bolt"></i></div>
                <div>Logically<span style="color:var(--primary-red); font-weight:300;">Debate</span></div>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navContent">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('debates') }}">Debate Hall</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('leaderboard') }}">Leaderboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('community') }}">Community</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <h1 class="fw-bold mb-4" style="font-family: 'Space Grotesk'">Get in touch</h1>
                <p class="text-secondary mb-5">Have a suggestion for a debate topic, or want to report a bug? We are always open to feedback from our community.</p>

                <div class="d-flex gap-4 mb-4">
                    <div class="icon-box"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h5 class="fw-bold">Email Us</h5>
                        <p class="text-secondary">support@logicallydebate.com</p>
                    </div>
                </div>
                <div class="d-flex gap-4 mb-4">
                    <div class="icon-box"><i class="fab fa-discord"></i></div>
                    <div>
                        <h5 class="fw-bold">Join Discord</h5>
                        <p class="text-secondary">discord.gg/logically</p>
                    </div>
                </div>
                <div class="d-flex gap-4">
                    <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h5 class="fw-bold">Location</h5>
                        <p class="text-secondary">Dhaka, Bangladesh</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-box">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-secondary mb-2">First Name</label>
                                <input type="text" class="form-control" placeholder="John">
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary mb-2">Last Name</label>
                                <input type="text" class="form-control" placeholder="Doe">
                            </div>
                            <div class="col-12">
                                <label class="text-secondary mb-2">Email Address</label>
                                <input type="email" class="form-control" placeholder="john@example.com">
                            </div>
                            <div class="col-12">
                                <label class="text-secondary mb-2">Message</label>
                                <textarea class="form-control" rows="5" placeholder="Your message here..."></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-danger w-100 py-3 fw-bold" style="background: var(--primary-red);">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>