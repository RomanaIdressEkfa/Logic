<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LogicallyDebate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;700&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-red: #ef233c;
            --dark-bg: #050505;
        }

        body {
            background-color: var(--dark-bg);
            color: white;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            background-image: radial-gradient(circle at top right, #1a0505 0%, #000000 60%);
        }

        .login-container {
            width: 100%;
            max-width: 900px;
            padding: 20px;
        }

        .login-card {
            background: #0f0f0f;
            border: 1px solid #222;
            border-radius: 24px;
            padding: 50px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            position: relative;
            overflow: hidden;
        }

        /* Role Selector Cards */
        .role-selector-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .role-card {
            background: #151515;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 20px 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .role-card:hover {
            border-color: var(--primary-red);
            transform: translateY(-3px);
        }

        .role-card.active {
            background: var(--primary-red);
            border-color: var(--primary-red);
        }

        .role-card i {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #666;
        }
        .role-card.active i, .role-card.active h6 { color: white; }
        
        .role-card h6 {
            margin: 0;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: #ccc;
            font-size: 0.9rem;
        }

        /* Form Styling */
        .form-control {
            background: #050505;
            border: 1px solid #333;
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .form-control:focus {
            background: #000;
            border-color: var(--primary-red);
            box-shadow: 0 0 0 4px rgba(239, 35, 60, 0.1);
            color: white;
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #ef233c 0%, #d90429 100%);
            border: none;
            padding: 15px;
            border-radius: 12px;
            color: white;
            font-weight: 800;
            font-family: 'Space Grotesk', sans-serif;
            text-transform: uppercase;
            font-size: 1.1rem;
            transition: 0.3s;
        }
        .btn-login:hover {
            box-shadow: 0 10px 20px rgba(239, 35, 60, 0.3);
            transform: translateY(-2px);
        }

        /* Mobile */
        @media (max-width: 768px) {
            .role-selector-container {
                grid-template-columns: 1fr; 
            }
            .login-card { padding: 30px 20px; }
        }
    </style>
</head>
<body>
    @include('frontend.shared.navbar')

    <div class="login-container mt-2">
        {{-- <div class="text-center mb-5">
            <a href="/">
                <img src="https://i.ibb.co.com/gbLB6Dqj/Logo-02.png" alt="Logically Debate" style="height: 50px;">
            </a>
        </div> --}}

        <div class="login-card">
            <h2 class="text-center fw-bold text-white mb-2" style="font-family: 'Space Grotesk';">Identity Verification</h2>
            <p class="text-center text-secondary mb-5">Select your role to access the terminal.</p>

           <form action="{{ route('login.submit') }}" method="POST">
    <!-- REQUIRED TO FIX 419 ERROR -->
    @csrf 
    
    <!-- Hidden Input to store selected role -->
    <input type="hidden" name="role" id="selectedRole" value="pro_debater">

    <!-- 1. Role Selection -->
    <div class="role-selector-container">
        <!-- Option 1: Pro Debater -->
        <div class="role-card active" onclick="selectRole('pro_debater', this)">
            <i class="fas fa-shield-alt"></i>
            <h6>Pro Debater</h6>
        </div>
        
        <!-- Option 2: Con Debater -->
        <div class="role-card" onclick="selectRole('con_debater', this)">
            <i class="fas fa-fire"></i>
            <h6>Con Debater</h6>
        </div>

        <!-- Option 3: Judge -->
        <div class="role-card" onclick="selectRole('judge', this)">
            <i class="fas fa-gavel"></i>
            <h6>Judge</h6>
        </div>
    </div>

    <!-- 2. Credentials -->
    <div class="row">
        <div class="col-md-6">
            <label class="text-secondary small mb-2 ps-2">EMAIL ADDRESS</label>
            <input type="email" name="email" class="form-control" placeholder="user@logicallydebate.com" required>
        </div>
        <div class="col-md-6">
            <label class="text-secondary small mb-2 ps-2">ACCESS KEY (PASSWORD)</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
    </div>

    <!-- Error Message Display -->
    @if ($errors->any())
        <div class="alert alert-danger bg-danger text-white border-0 small">
            <ul class="m-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div class="form-check">
            <input class="form-check-input bg-dark border-secondary" type="checkbox" id="remember">
            <label class="form-check-label text-secondary small" for="remember">Keep session active</label>
        </div>
        <a href="#" class="text-danger small text-decoration-none">Lost Access Key?</a>
    </div>

    <button type="submit" class="btn-login">
        Initialize Login <i class="fas fa-arrow-right ms-2"></i>
    </button>
</form>
        </div>
        
        <div class="text-center mt-4">
            <span class="text-secondary small">Don't have an identity? <a href="#" class="text-white fw-bold">Apply for Access</a></span>
        </div>
    </div>

    <script>
        function selectRole(roleValue, element) {
            // 1. Update Hidden Input
            document.getElementById('selectedRole').value = roleValue;

            // 2. Remove 'active' class from all cards
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('active');
            });

            // 3. Add 'active' class to clicked card
            element.classList.add('active');
        }
    </script>

</body>
</html>