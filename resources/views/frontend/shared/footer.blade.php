<footer class="footer-premium">
    <!-- Atmospheric Glow -->
    <div class="footer-bg-glow"></div>

    <div class="container footer-content">
        <div class="row gy-5">

            <div class="col-lg-4 col-md-12">
                <!-- Image Logo -->
                <a href="{{ route('home') }}" class="brand-logo mb-4 d-inline-block">
                    <img src="https://i.ibb.co.com/gbLB6Dqj/Logo-02.png" alt="Logically Debate" style="height: 50px; width: auto;">
                </a>
                
                <p class="footer-desc">
                    The world's first decentralized platform for intellectual sparring. We value truth, logic, and respectful discourse above all else. Join the revolution of thought.
                </p>
                
                <div class="d-flex gap-3 mt-4 social-links-container">
                    <a href="#" class="social-glass"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-glass"><i class="fab fa-discord"></i></a>
                    <a href="#" class="social-glass"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-glass"><i class="fab fa-github"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <h5 class="footer-heading">Platform</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('debates') }}" class="footer-link-item"><i class="fas fa-chevron-right"></i> Live Hall</a></li>
                    <li><a href="#" class="footer-link-item"><i class="fas fa-chevron-right"></i> Tournaments</a></li>
                    <li><a href="{{ route('leaderboard') }}" class="footer-link-item"><i class="fas fa-chevron-right"></i> Leaderboard</a></li>
                    <li><a href="#" class="footer-link-item"><i class="fas fa-chevron-right"></i> Pricing</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-6">
                <h5 class="footer-heading">Community</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link-item"><i class="fas fa-chevron-right"></i> Guidelines</a></li>
                    <li><a href="#" class="footer-link-item"><i class="fas fa-chevron-right"></i> Become a Judge</a></li>
                    <li><a href="#" class="footer-link-item"><i class="fas fa-chevron-right"></i> Suggestions</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link-item"><i class="fas fa-chevron-right"></i> Contact Support</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12">
                <h5 class="footer-heading">Stay Intellectual</h5>
                <p class="text-secondary small mb-4">
                    Get the latest debate schedules, logic puzzles, and ranking updates delivered to your inbox.
                </p>
                <form action="#">
                    <div class="newsletter-wrapper">
                        <input type="email" class="input-premium" placeholder="Enter your email...">
                        <button type="button" class="btn-subscribe">Join</button>
                    </div>
                </form>
                
                <div class="d-flex align-items-center gap-2 mt-4 opacity-50">
                    <i class="fas fa-shield-alt text-secondary"></i>
                    <span class="small text-secondary">No spam. Unsubscribe anytime.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="text-secondary small m-0">&copy; 2026 LogicallyDebate Systems. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-secondary small text-decoration-none me-4 hover-white">Privacy Policy</a>
                    <a href="#" class="text-secondary small text-decoration-none hover-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
 
.footer-premium {
    background-color: #020202;
    position: relative;
    padding-top: 80px;
    margin-top: 100px;
    overflow: hidden;
}

.footer-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--primary-red), transparent);
    opacity: 0.8;
    box-shadow: 0 0 20px var(--primary-red);
}

.footer-bg-glow {
    position: absolute;
    top: -50%;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 500px;
    background: radial-gradient(circle, rgba(239, 35, 60, 0.08) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
}

.footer-content {
    position: relative;
    z-index: 1;
}

.footer-desc {
    color: #888;
    font-size: 0.95rem;
    line-height: 1.7;
    margin-top: 20px;
}

.footer-heading {
    color: white;
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 25px;
    position: relative;
    display: inline-block;
}

.footer-heading::after {
    content: '';
    display: block;
    width: 30px;
    height: 2px;
    background: var(--primary-red);
    margin-top: 8px;
    border-radius: 2px;
}

.footer-link-item {
    display: block;
    color: #a0a0a0;
    text-decoration: none;
    margin-bottom: 14px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.footer-link-item i {
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s ease;
    color: var(--primary-red);
    margin-right: 0;
    font-size: 0.8rem;
}

.footer-link-item:hover {
    color: white;
    padding-left: 5px;
}

.footer-link-item:hover i {
    opacity: 1;
    transform: translateX(0);
    margin-right: 8px;
}

.social-glass {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    text-decoration: none;
}

.social-glass:hover {
    background: var(--primary-red);
    border-color: var(--primary-red);
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(239, 35, 60, 0.4);
    color: white;
}

.newsletter-wrapper {
    position: relative;
}
.input-premium {
    background: #0f0f0f;
    border: 1px solid #222;
    color: white;
    padding: 15px 20px;
    border-radius: 12px;
    width: 100%;
    transition: 0.3s;
}
.input-premium:focus {
    border-color: var(--primary-red);
    box-shadow: 0 0 15px rgba(239, 35, 60, 0.2);
    outline: none;
}
.btn-subscribe {
    position: absolute;
    top: 5px;
    right: 5px;
    height: calc(100% - 10px);
    background: var(--primary-red);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0 20px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.8rem;
    transition: 0.3s;
}
.btn-subscribe:hover {
    background: #d90429;
    transform: scale(0.98);
}

.footer-bottom {
    background: #000;
    padding: 25px 0;
    margin-top: 70px;
    border-top: 1px solid #111;
}

@media (max-width: 768px) {
    .footer-premium { text-align: center; }
    .footer-heading::after { margin: 8px auto 0; } 
    .social-links-container { justify-content: center; }
    .footer-link-item { justify-content: center; }
    .footer-link-item:hover { padding-left: 0; transform: scale(1.05); }
    .footer-link-item i { display: none; } 
}
</style>