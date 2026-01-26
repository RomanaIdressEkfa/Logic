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
        body { 
            background-color: var(--dark-bg); 
            color: white; 
            font-family: 'Inter', sans-serif; 
            padding-top: 90px;
        }
        
        .contact-box { background: #111; border: 1px solid #222; padding: 40px; border-radius: 20px; }
        .form-control { background: #1a1a1a; border: 1px solid #333; color: white; padding: 15px; }
        .form-control:focus { background: #1a1a1a; border-color: var(--primary-red); color: white; box-shadow: none; }
        .icon-box { width: 50px; height: 50px; background: rgba(239, 35, 60, 0.1); color: var(--primary-red); display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 1.2rem; flex-shrink: 0; }
        
        @media (max-width: 991px) {
            .contact-box { padding: 25px; margin-top: 30px; }
        }
    </style>
</head>
<body>

  @include('frontend.shared.navbar')

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <h1 class="fw-bold mb-3" style="font-family: 'Space Grotesk'">Get in touch</h1>
                <p class="text-secondary mb-5">Have a suggestion for a debate topic, or want to report a bug? We are always open to feedback from our community.</p>

                <div class="d-flex gap-3 mb-4">
                    <div class="icon-box"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h5 class="fw-bold m-0">Email Us</h5>
                        <p class="text-secondary small m-0">support@logicallydebate.com</p>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-4">
                    <div class="icon-box"><i class="fab fa-discord"></i></div>
                    <div>
                        <h5 class="fw-bold m-0">Join Discord</h5>
                        <p class="text-secondary small m-0">discord.gg/logically</p>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h5 class="fw-bold m-0">Location</h5>
                        <p class="text-secondary small m-0">Dhaka, Bangladesh</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-box">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="text-secondary mb-2 small fw-bold">First Name</label>
                                <input type="text" class="form-control rounded-3" placeholder="John">
                            </div>
                            <div class="col-md-6">
                                <label class="text-secondary mb-2 small fw-bold">Last Name</label>
                                <input type="text" class="form-control rounded-3" placeholder="Doe">
                            </div>
                            <div class="col-12">
                                <label class="text-secondary mb-2 small fw-bold">Email Address</label>
                                <input type="email" class="form-control rounded-3" placeholder="john@example.com">
                            </div>
                            <div class="col-12">
                                <label class="text-secondary mb-2 small fw-bold">Message</label>
                                <textarea class="form-control rounded-3" rows="5" placeholder="Your message here..."></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-danger w-100 py-3 fw-bold rounded-pill" style="background: var(--primary-red);">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>