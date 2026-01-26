<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Debate - LogicallyDebate</title>
    
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
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-main);
            font-family: 'Outfit', sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- NAVBAR --- */
        .navbar-global {
            height: 70px; background: rgba(9, 9, 11, 0.95); border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: space-between; padding: 0 40px;
        }
        .brand { font-family: 'Space Grotesk'; font-size: 1.5rem; font-weight: 800; color: white; text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .brand-icon { width: 36px; height: 36px; background: var(--primary-red); color: white; display: flex; align-items: center; justify-content: center; border-radius: 8px; transform: skew(-10deg); }
        .nav-links a { color: #888; text-decoration: none; font-weight: 600; margin: 0 15px; text-transform: uppercase; font-size: 0.9rem; transition: 0.3s; }
        .nav-links a:hover { color: white; }

        /* --- MAIN CONTAINER --- */
        .main-content {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: radial-gradient(#1a1a1a 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* --- FORM CARD --- */
        .create-card {
            width: 700px;
            background: #111;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.7);
            position: relative;
        }

        /* Progress Bar */
        .progress-line { height: 4px; background: #222; border-radius: 4px; margin-bottom: 30px; position: relative; }
        .progress-fill { width: 50%; height: 100%; background: var(--primary-blue); border-radius: 4px; box-shadow: 0 0 10px var(--primary-blue); }

        .form-title { font-family: 'Space Grotesk'; font-size: 2rem; font-weight: 700; margin-bottom: 10px; display: flex; align-items: center; gap: 15px; }
        .icon-box { width: 50px; height: 50px; background: rgba(59,130,246,0.1); color: var(--primary-blue); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        
        .form-sub { color: #888; margin-bottom: 30px; }

        /* Inputs */
        .form-label { font-weight: 600; color: #ccc; margin-bottom: 8px; display: block; font-size: 0.9rem; }
        .input-dark {
            width: 100%; background: #080808; border: 1px solid #333; color: white;
            padding: 15px; border-radius: 8px; font-size: 1rem; margin-bottom: 25px;
            transition: 0.3s;
        }
        .input-dark:focus { outline: none; border-color: var(--primary-blue); box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }

        /* Category Grid */
        .cat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 30px; }
        .cat-option {
            background: #1a1a1a; border: 1px solid #333; color: #888;
            padding: 12px; border-radius: 8px; text-align: center;
            font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: 0.2s;
        }
        .cat-option:hover { background: #222; color: white; }
        .cat-option.selected { background: var(--primary-blue); color: white; border-color: var(--primary-blue); }

        /* Buttons */
        .btn-action { width: 100%; padding: 15px; border-radius: 8px; font-weight: 700; text-transform: uppercase; border: none; font-size: 1rem; cursor: pointer; transition: 0.2s; }
        .btn-next { background: var(--primary-blue); color: white; }
        .btn-next:hover { background: #2563eb; }
        
        .cancel-btn { color: #666; font-weight: 600; text-decoration: none; display: inline-block; margin-top: 20px; transition: 0.2s; }
        .cancel-btn:hover { color: white; }

    </style>
</head>
<body>

    <!-- NAVBAR -->
   @include('frontend.shared.navbar')

    <!-- FORM SECTION -->
    <div class="main-content">
        <div class="create-card">
            
            <div class="progress-line"><div class="progress-fill"></div></div>

            <div class="form-title">
                <div class="icon-box"><i class="fas fa-pen-nib"></i></div>
                Create New Debate
            </div>
            <p class="form-sub">Challenge the world to a battle of logic. As a judge, you set the rules.</p>

            <form action="{{ route('debates') }}"> <!-- Linking to debates for demo -->
                
                <div>
                    <label class="form-label">Debate Topic</label>
                    <input type="text" class="input-dark" placeholder="e.g., Artificial Intelligence will replace doctors..." autofocus>
                </div>

                <div>
                    <label class="form-label">Category</label>
                    <div class="cat-grid">
                        <div class="cat-option selected">Politics</div>
                        <div class="cat-option">Technology</div>
                        <div class="cat-option">Philosophy</div>
                        <div class="cat-option">Science</div>
                        <div class="cat-option">Economics</div>
                        <div class="cat-option">Culture</div>
                        <div class="cat-option">Religion</div>
                        <div class="cat-option">History</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Max Participants</label>
                        <input type="number" class="input-dark" value="2">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Time Limit (Min)</label>
                        <input type="number" class="input-dark" value="45">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <a href="{{ route('home') }}" class="cancel-btn">Cancel</a>
                    <div style="width: 150px;">
                        <button type="submit" class="btn-action btn-next">Next Step <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        // Simple Interaction for Category Selection
        const options = document.querySelectorAll('.cat-option');
        options.forEach(opt => {
            opt.addEventListener('click', () => {
                options.forEach(o => o.classList.remove('selected'));
                opt.classList.add('selected');
            });
        });
    </script>

</body>
</html>