<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahmed Bermawy</title>
    <link rel="stylesheet" href="assets/css/styles.css?v=9">
</head>
<body>
    <!-- Mentorship Service Card -->
    <div id="mentorshipCard" class="mentorship-card">
        <div class="card-header">
            <h3>🎯 Mentorship Services</h3>
            <span class="close-btn" onclick="closeCard('mentorshipCard')">&#x2715;</span>
        </div>
        <div class="card-content">
            <p>&#x1f4a1; <strong>Get personalized guidance from Ahmed</strong></p>
            <ul>
                <li>&#x1f680; Web Development Mentoring</li>
                <li>&#x1f4bc; Career Guidance &amp; Consulting</li>
                <li>&#x1f527; Technical Problem Solving</li>
                <li>&#x1f4c8; Project Review &amp; Code Optimization</li>
            </ul>
            <a href="https://topmate.io/ahmed_bermawy" target="_blank" class="cta-button">
                Book a Session
            </a>
        </div>
    </div>

    <!-- Family Tree Card -->
    <div id="familyTreeCard" class="family-tree-card">
        <div class="card-header tree-header">
            <h3>&#x1f333; Family Tree</h3>
            <span class="close-btn" onclick="closeCard('familyTreeCard')">&#x2715;</span>
        </div>
        <div class="card-content">
            <p>&#x1f49a; <strong>Build &amp; share your family history</strong></p>
            <ul>
                <li>&#x1f468;&#x200d;&#x1f469;&#x200d;&#x1f467;&#x200d;&#x1f466; Create your family tree visually</li>
                <li>&#x1f4f8; Add photos &amp; profile pictures</li>
                <li>&#x1f517; Share with relatives via link</li>
                <li>&#x1f310; Available in English &amp; العربية</li>
            </ul>
            <a href="https://family-tree.bermawy.tech" target="_blank" class="cta-button tree-button">
                &#x1f333; Try Family Tree
            </a>
        </div>
    </div>

    <div class="container">
        <h1>Hello, World!</h1>
        <button id="skipButton">Skip Intro</button>
        <audio id="typewriterSound" src="assets/sounds/typewriter.mp3"></audio>
        <h2 id="paragraph1"></h2>
    </div>

    <script>
    function closeCard(id) {
        var card = document.getElementById(id);
        if (card) {
            card.classList.remove('show');
            card.classList.add('hide');
        }
    }
    </script>
    <script src="assets/js/dynamicFavicon.js"></script>
    <script src="assets/js/typeWriter.js"></script>
    <script src="assets/js/mentorshipCard.js"></script>
    <script src="assets/js/familyTreeCard.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
