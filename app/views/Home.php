<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouCode Innovation Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        .innovation-bg {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }

        .tech-lines {
            background-image: linear-gradient(rgba(37, 99, 235, 0.1) 1px, transparent 1px),
                            linear-gradient(90deg, rgba(37, 99, 235, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            background-position: center center;
        }

        .gradient-text {
            background: linear-gradient(45deg, #2563eb, #3b82f6, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-3d {
            transition: all 0.5s ease;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(37, 99, 235, 0.2);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.1);
        }

        .card-3d:hover {
            transform: translateY(-10px) rotateX(10deg) rotateY(10deg);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.2);
            border-color: rgba(37, 99, 235, 0.4);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .shine-effect {
            position: relative;
            overflow: hidden;
        }

        .shine-effect::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.8) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        #canvas-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 0;
            opacity: 0.3;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(37, 99, 235, 0.2);
        }

        .btn-primary {
            background: linear-gradient(45deg, #2563eb, #3b82f6);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        }

        .gradient-bg {
            background: linear-gradient(120deg, #FF0080, #7928CA);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-pattern {
            background-color: #0F172A;
            background-image: radial-gradient(circle at 1px 1px, #FF0080 1px, transparent 0);
            background-size: 40px 40px;
            position: relative;
            overflow: hidden;
        }

        .hero-pattern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.7));
        }

        .card-hover {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            border-color: #FF0080;
            box-shadow: 0 10px 30px rgba(255, 0, 128, 0.2);
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #FF0080, #7928CA, #00DFD8, #007CF0);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .custom-shape {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .custom-shape svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        }

        .custom-shape .shape-fill {
            fill: #FFFFFF;
        }

        .neon-border {
            position: relative;
            border: 1px solid transparent;
            background-clip: padding-box;
        }

        .neon-border::before {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            margin: -2px;
            border-radius: inherit;
            background: linear-gradient(45deg, #00ffff, #ff00ff);
            z-index: -1;
        }

        .floating-3d {
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .card-3d {
            transition: transform 0.5s;
            transform-style: preserve-3d;
        }

        .card-3d:hover {
            transform: rotateY(10deg) rotateX(10deg);
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .cyber-button {
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
        }

        .cyber-button::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            top: 0;
            left: -100%;
            transition: 0.5s;
        }

        .cyber-button:hover::before {
            left: 100%;
        }

        .hologram {
            position: relative;
        }

        .hologram::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                0deg,
                rgba(0, 255, 255, 0.1) 0px,
                rgba(0, 255, 255, 0.1) 1px,
                transparent 1px,
                transparent 2px
            );
            pointer-events: none;
            animation: scan 3s linear infinite;
        }

        @keyframes scan {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(100%); }
        }

        .matrix-text {
            position: relative;
            overflow: hidden;
        }

        .matrix-text::before {
            content: attr(data-text);
            position: absolute;
            left: -2px;
            text-shadow: 2px 0 #00ffff;
            background: #000;
            overflow: hidden;
            animation: noise-1 3s linear infinite alternate;
        }

        @keyframes noise-1 {
            0%, 3%, 5%, 42%, 44%, 100% { opacity: 1; transform: scaleY(1); }
            4.3% { opacity: 1; transform: scaleY(1.7); }
            43% { opacity: 1; transform: scaleX(1.5); }
        }
    </style>
</head>
<body class="innovation-bg text-gray-800">
    <div id="canvas-container"></div>
    <div id="particles-js"></div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-effect">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img src="/public/assets/images/logo-youcode.png" alt="YouCode" class="h-12 floating">
                    <span class="text-2xl font-bold gradient-text">YouCode</span>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="#calendar" class="text-gray-600 hover:text-blue-600 transition-colors">
                        <i class="fas fa-calendar-alt mr-2"></i>Calendrier
                    </a>
                    <a href="/login" class="text-gray-600 hover:text-blue-600 transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                    </a>
                    <a href="/register" class="btn-primary px-6 py-2 text-white rounded-lg shine-effect">
                        <i class="fas fa-user-plus mr-2"></i>Inscription
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen relative flex items-center justify-center tech-lines">
        <div class="container mx-auto px-6 py-20 relative z-10">
            <div class="text-center max-w-4xl mx-auto" data-aos="fade-up">
                <h1 class="text-6xl font-bold mb-8 gradient-text">
                    Innovez avec YouCode
                </h1>
                <p class="text-xl text-gray-600 mb-12">
                    Découvrez une nouvelle façon d'apprendre et de partager vos connaissances
                </p>
                <div class="flex justify-center gap-8">
                    <a href="#register" class="btn-primary px-8 py-4 text-white rounded-lg shine-effect">
                        Commencer l'aventure
                    </a>
                    <a href="#calendar" class="px-8 py-4 glass-effect rounded-lg hover:shadow-lg transition-all">
                        Explorer le planning
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="card-3d p-8 rounded-xl" data-aos="fade-up">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-calendar-alt text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Calendrier Interactif</h3>
                    <p class="text-gray-600">
                        Consultez et gérez facilement les présentations à venir
                    </p>
                </div>
                <!-- Autres cartes similaires -->
            </div>
        </div>
    </section>

    <!-- Calendar Section -->
    <section id="calendar" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12 gradient-text">
                Prochaines Présentations
            </h2>
            <div class="grid md:grid-cols-3 gap-8">
                <?php foreach($presentations as $presentation): ?>
                <div class="card-3d p-6 rounded-xl bg-white" data-aos="fade-up">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-gray-800">
                            <?php echo htmlspecialchars($presentation['titre']); ?>
                        </h3>
                        <span class="px-4 py-1 rounded-full gradient-bg text-white text-sm">
                            <?php echo date('d/m', strtotime($presentation['presentation_date'])); ?>
                        </span>
                    </div>
                    <p class="text-gray-600 mb-4">
                        <?php echo htmlspecialchars($presentation['student_names']); ?>
                    </p>
                    <div class="flex items-center text-gray-500">
                        <i class="far fa-clock mr-2"></i>
                        <span><?php echo date('H:i', strtotime($presentation['presentation_date'])); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer moderne -->
    <footer class="bg-[#0F172A] border-t border-gray-800 py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-4 mb-6 md:mb-0">
                    <img src="/public/assets/images/logo-youcode.png" alt="YouCode" class="h-10">
                    <span class="text-xl font-bold gradient-text">YouCode</span>
                </div>
                <div class="flex space-x-6">
                    <!-- Icônes sociales avec effets hover -->
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Configuration Three.js
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('canvas-container').appendChild(renderer.domElement);

        // Création des points 3D
        const geometry = new THREE.BufferGeometry();
        const points = [];
        for(let i = 0; i < 1000; i++) {
            points.push(
                THREE.MathUtils.randFloatSpread(2000),
                THREE.MathUtils.randFloatSpread(1000),
                THREE.MathUtils.randFloatSpread(2000)
            );
        }
        geometry.setAttribute('position', new THREE.Float32BufferAttribute(points, 3));
        const material = new THREE.PointsMaterial({ color: 0x2563eb, size: 2 });
        const pointCloud = new THREE.Points(geometry, material);
        scene.add(pointCloud);

        camera.position.z = 1000;

        function animate() {
            requestAnimationFrame(animate);
            pointCloud.rotation.x += 0.001;
            pointCloud.rotation.y += 0.001;
            renderer.render(scene, camera);
        }
        animate();

        // Effet de parallaxe
        document.addEventListener('mousemove', (e) => {
            const cards = document.querySelectorAll('.card-3d');
            const mouseX = e.clientX / window.innerWidth - 0.5;
            const mouseY = e.clientY / window.innerHeight - 0.5;

            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const cardX = (rect.left + rect.width / 2) / window.innerWidth - 0.5;
                const cardY = (rect.top + rect.height / 2) / window.innerHeight - 0.5;

                const angleX = (mouseY - cardY) * 20;
                const angleY = (mouseX - cardX) * 20;

                card.style.transform = `rotateX(${angleX}deg) rotateY(${angleY}deg)`;
            });
        });

        AOS.init({
            duration: 1000,
            once: true
        });

        // Configuration Particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 80 },
                color: { value: '#00ffff' },
                shape: { type: 'circle' },
                opacity: { value: 0.5 },
                size: { value: 3 },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'none',
                    random: true,
                    out_mode: 'out'
                }
            }
        });
    </script>
</body>
</html>
