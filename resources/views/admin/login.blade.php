<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Logically Debate</title>
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        /* CORE STYLES */
        body, html {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            background-color: #050505;
            color: #ffffff;
        }

        /* 3D CANVAS BACKGROUND */
        #canvas-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        /* LOGIN WRAPPER */
        .login-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            padding: 15px; /* Mobile Padding */
        }

        /* --- CARD DESIGN (Responsive) --- */
        .login-card {
            background: #0f0f0f;
            border: 1px solid #1f1f1f;
            border-radius: 20px;
            padding: 30px;       /* Default padding for mobile */
            width: 100%;
            max-width: 550px;    /* Max width for desktop */
            box-shadow: 0 30px 60px rgba(0,0,0,0.9);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* DESKTOP VIEW (Large Screen) */
        @media (min-width: 768px) {
            .login-card {
                padding: 55px; /* Bigger padding on Desktop */
                border-radius: 24px;
            }
            .brand-logo h1 {
                font-size: 2.2rem;
            }
        }

        /* LOGO STYLES */
        .brand-logo h1 {
            font-weight: 800;
            font-size: 1.8rem; /* Mobile font size */
            color: white;
            margin-bottom: 5px;
            letter-spacing: -1px;
        }
        .brand-logo span {
            color: #ef233c;
        }
        .subtitle {
            font-size: 0.7rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 40px;
            font-weight: 600;
        }

        /* INPUT FIELDS */
        .form-label {
            display: block;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 700;
            color: #b0b0b0;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .custom-input {
            background-color: #161616;
            border: 1px solid #2a2a2a;
            color: #fff;
            border-radius: 10px;
            padding: 16px 20px;
            font-size: 1rem;
            width: 100%;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .custom-input:focus {
            background-color: #1a1a1a;
            border-color: #ef233c;
            outline: none;
            box-shadow: 0 0 15px rgba(239, 35, 60, 0.15);
            color: white;
        }

        /* BUTTON */
        .btn-login {
            background-color: #ef233c;
            color: white;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: none;
            padding: 16px;
            width: 100%;
            border-radius: 10px;
            margin-top: 10px;
            box-shadow: 0 5px 30px rgba(239, 35, 60, 0.3);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #ff0f2f;
            box-shadow: 0 8px 40px rgba(239, 35, 60, 0.5);
            transform: translateY(-3px);
            color: white;
        }

        .footer-text {
            margin-top: 30px;
            color: #333;
            font-size: 0.75rem;
            border-top: 1px solid #1a1a1a;
            padding-top: 20px;
        }
    </style>
</head>
<body>

    <!-- 3D Background -->
    <div id="canvas-container"></div>

    <!-- Login Form -->
    <div class="login-wrapper">
        <div class="login-card">
            
            <div class="brand-logo">
                <h1>Logically Debate<span>.</span></h1>
                <p class="subtitle">Admin Portal Access</p>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="alert alert-danger py-2 mb-4" style="font-size: 0.85rem; border-radius: 8px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.authenticate') }}" method="POST">
                @csrf
                
                <div class="mb-2">
                    <label class="form-label">Email Address</label>
                    <!-- Value removed, added placeholder -->
                    <input type="email" name="email" class="custom-input" placeholder="admin@logically.com" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Password</label>
                    <!-- Value removed -->
                    <input type="password" name="password" class="custom-input" placeholder="••••••••••••" required>
                </div>

                <button type="submit" class="btn btn-login">
                    Login as Admin
                </button>
            </form>

            <div class="footer-text">
                Secure Access • Logically Debate Systems Ltd.
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <script>
        // 3D RED PARTICLE SYSTEM
        const container = document.getElementById('canvas-container');
        const scene = new THREE.Scene();
        scene.fog = new THREE.FogExp2(0x050505, 0.002);

        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        container.appendChild(renderer.domElement);

        const geometry = new THREE.BufferGeometry();
        const particlesCount = 2000;
        const posArray = new Float32Array(particlesCount * 3);

        for(let i = 0; i < particlesCount * 3; i++) {
            posArray[i] = (Math.random() - 0.5) * 120;
        }

        geometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

        const material = new THREE.PointsMaterial({
            size: 0.18,
            color: 0xef233c, 
            transparent: true,
            opacity: 0.85,
        });

        const particlesMesh = new THREE.Points(geometry, material);
        scene.add(particlesMesh);

        camera.position.z = 40;

        let mouseX = 0;
        let mouseY = 0;
        
        document.addEventListener('mousemove', (event) => {
            mouseX = event.clientX - window.innerWidth / 2;
            mouseY = event.clientY - window.innerHeight / 2;
        });

        const clock = new THREE.Clock();
        function animate() {
            requestAnimationFrame(animate);
            const elapsedTime = clock.getElapsedTime();

            particlesMesh.rotation.y = elapsedTime * 0.04;
            particlesMesh.rotation.x = elapsedTime * 0.01;
            particlesMesh.rotation.y += mouseX * 0.00003;
            particlesMesh.rotation.x += mouseY * 0.00003;

            renderer.render(scene, camera);
        }
        animate();

        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });

        gsap.from(".login-card", {
            duration: 1.2,
            y: 30,
            opacity: 0,
            ease: "power3.out",
            delay: 0.1
        });
    </script>
</body>
</html>