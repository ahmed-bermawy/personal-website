document.addEventListener('DOMContentLoaded', () => {
    // The intro follows the page language (see lang/ for the rest of the copy).
    const LANG = document.documentElement.lang === 'ar' ? 'ar' : 'en';

    const SENTENCES_EN = [
        {
            sentence: "Surprise!! ",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph1",
        },
        {
            sentence: "You thought this is the only website I build 😁",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph2",
        },
        {
            sentence: "I like the idea that i'm writing on typewriter 😄",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph3",
        },
        {
            sentence:
                "And though that will be good idea to build my own website in this way 😊",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph4",
        },
        {
            sentence: "So Let me introduce myself 😊",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph5",
        },
        {
            sentence: "My name is Ahmed Bermawy",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph6",
        },
        {
            sentence: "I'm a Software Development Lead | Senior Backend Developer based in Cairo, Egypt",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph7",
        },
        {
            sentence: "I have 13+ years of experience in backend development, team leadership, and scalable system design",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph8",
        },
        {
            sentence: "I'm an expert in PHP, Laravel, Symfony, and Shopware with proven track record in microservices architecture",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph9",
        },
        {
            sentence: "Since November 2025, I've been working as a Software Development Lead at Damlag, contributing to elcinema.com—the largest Arabic database for movies, series, and actresses",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph10",
        },
        {
            sentence: "I've successfully boosted collaboration and efficiency by 25% and increased team code quality by 30%",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph11",
        },
        {
            sentence: "My expertise includes CI/CD, cloud deployment (AWS), database design, and I'm passionate about clean code and mentorship",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph12",
        },
        {
            sentence: "I also have experience with DevOps tools like Docker, GitHub Actions, Redis, RabbitMQ, and modern technologies like GraphQL and WebSockets",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph13",
        },
        {
            sentence: "I work extensively with Ruby on Rails, Node.js, and AWS services like ECR, ElastiCache, Elasticsearch, MongoDB, and Redis",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph14",
        },
        {
            sentence: "I'm also working on the first mobile application for elcinema.com, bringing the platform to iOS and Android 📱",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph15",
        },
    ];

    const SENTENCES_AR = [
        { sentence: "مفاجأة!! ", delay: 50, initialDelay: 0, elementId: "paragraph1" },
        { sentence: "كنت فاكر إن ده الموقع الوحيد اللي بنيته 😁", delay: 60, initialDelay: 0, elementId: "paragraph2" },
        { sentence: "عجبتني فكرة إني بكتب على آلة كاتبة 😄", delay: 60, initialDelay: 0, elementId: "paragraph3" },
        { sentence: "وفكرت إن دي هتكون طريقة حلوة إني أبني موقعي بالشكل ده 😊", delay: 60, initialDelay: 0, elementId: "paragraph4" },
        { sentence: "خليني أعرّفك بنفسي 😊", delay: 60, initialDelay: 0, elementId: "paragraph5" },
        { sentence: "اسمي أحمد البرماوي", delay: 60, initialDelay: 0, elementId: "paragraph6" },
        { sentence: "قائد تطوير برمجيات ومطوّر Backend، من القاهرة، مصر", delay: 60, initialDelay: 0, elementId: "paragraph7" },
        { sentence: "عندي خبرة تتجاوز 13 سنة في تطوير الـ Backend وقيادة الفرق وتصميم الأنظمة القابلة للتوسّع", delay: 60, initialDelay: 0, elementId: "paragraph8" },
        { sentence: "خبير في PHP وLaravel وSymfony وShopware، مع سجل حافل في بناء الخدمات المصغّرة", delay: 60, initialDelay: 0, elementId: "paragraph9" },
        { sentence: "من نوفمبر 2025 بشتغل قائد تطوير برمجيات في Damlag، ومساهم في elcinema.com—أكبر قاعدة بيانات عربية للأفلام والمسلسلات", delay: 60, initialDelay: 0, elementId: "paragraph10" },
        { sentence: "نجحت في رفع كفاءة التعاون بنسبة 25% وزيادة جودة الكود بنسبة 30%", delay: 60, initialDelay: 0, elementId: "paragraph11" },
        { sentence: "خبرتي بتشمل CI/CD والنشر السحابي على AWS وتصميم قواعد البيانات، وشغوف بالكود النظيف والإرشاد المهني", delay: 60, initialDelay: 0, elementId: "paragraph12" },
        { sentence: "عندي كمان خبرة في أدوات DevOps زي Docker وGitHub Actions وRedis وRabbitMQ، وتقنيات حديثة زي GraphQL وWebSockets", delay: 60, initialDelay: 0, elementId: "paragraph13" },
        { sentence: "بشتغل بشكل موسّع مع Ruby on Rails وNode.js وخدمات AWS زي ECR وElastiCache وElasticsearch وMongoDB وRedis", delay: 60, initialDelay: 0, elementId: "paragraph14" },
        { sentence: "وشغال حاليًا على أول تطبيق موبايل لـ elcinema.com، لتوصيل المنصة لـ iOS و Android 📱", delay: 60, initialDelay: 0, elementId: "paragraph15" },
    ];

    const mySentences = LANG === 'ar' ? SENTENCES_AR : SENTENCES_EN;

    let skip = false;
    const typewriterSound = document.getElementById('typewriterSound');
    const skipButton = document.getElementById('skipButton');

    // Input validation for DOM elements
    if (!typewriterSound) {
        console.error('typewriterSound element not found');
        return;
    }

    if (!skipButton) {
        console.error('skipButton element not found');
        return;
    }

    // Display "Hello, World!" for 4 seconds
    setTimeout(() => {
        // Show the skip button with fade-in effect
        skipButton.classList.add('show');
        // Start the typewriter effect
        typeWriter(mySentences, 0, 0);
    }, 4000);

    /**
     * Implements a typewriter effect by displaying text one character at a time.
     * Plays a typewriter sound effect while typing and moves to the next sentence when done.
     * 
     * @param {Array} sentences - Array of sentence objects containing text and display properties
     * @param {number} sentenceIndex - The index of the current sentence in the sentences array
     * @param {number} charIndex - The index of the current character in the current sentence
     * @returns {void}
     */
    function typeWriter(sentences, sentenceIndex, charIndex) {
        if (skip) {
            displayAllSentences(sentences);
            try {
                typewriterSound.pause();
            } catch (error) {
                console.error('Error pausing typewriter sound:', error);
                // Continue even if pausing fails
            }
            return;
        }

        if (sentenceIndex < sentences.length) {
            const {sentence, delay, initialDelay, elementId} = sentences[sentenceIndex];
            let element = document.getElementById(elementId);

            // Create the element if it doesn't exist
            if (!element) {
                element = document.createElement("h3");
                element.id = elementId;
                const container = document.querySelector('.container');
                if (container) {
                    container.appendChild(element);
                } else {
                    document.body.appendChild(element);
                }
            }

            if (charIndex < sentence.length) {
                // Play typewriter sound if not already playing
                if (typewriterSound.paused) {
                    // Add proper error handling for audio playback
                    typewriterSound.play()
                        .catch(error => {
                            console.error('Error playing typewriter sound:', error);
                            // Continue with typewriter effect even if sound fails
                        });
                }
                // Display one character at a time
                element.textContent = sentence.substring(0, charIndex + 1);
                charIndex++;
                setTimeout(() => typeWriter(sentences, sentenceIndex, charIndex), delay);
            } else {
                // Move to the next sentence after a pause
                setTimeout(() => typeWriter(sentences, sentenceIndex + 1, 0), initialDelay);
            }
        }
    }

    /**
     * Displays all sentences immediately without the typewriter effect.
     * Used when the user clicks the skip button.
     * 
     * @param {Array} sentences - Array of sentence objects containing text and display properties
     * @returns {void}
     */
    function displayAllSentences(sentences) {
        sentences.forEach(({sentence, elementId}) => {
            let element = document.getElementById(elementId);
            if (!element) {
                element = document.createElement("h3");
                element.id = elementId;
                const container = document.querySelector('.container');
                if (container) {
                    container.appendChild(element);
                } else {
                    document.body.appendChild(element);
                }
            }
            element.textContent = sentence;
        });
    }

    // Add event listener to the skip button
    skipButton.addEventListener("click", () => {
        skip = true;
        try {
            typewriterSound.pause();
        } catch (error) {
            console.error('Error pausing typewriter sound:', error);
            // Continue even if pausing fails
        }
        skipButton.classList.add('fade-out');
        skipButton.classList.remove('show');
        setTimeout(() => displayAllSentences(mySentences), 1000); // Wait for the fade-out effect to complete
    });
});
