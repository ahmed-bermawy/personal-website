document.addEventListener('DOMContentLoaded', () => {
    const mySentences = [
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
            sentence: "I'm a Tech Lead | Senior Backend Developer based in Cairo, Egypt",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph7",
        },
        {
            sentence: "I have 12+ years of experience in backend development, team leadership, and scalable system design",
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
            sentence: "Currently, I'm working as a Tech Lead at Sure (Saudi Software House) directing a cross-functional team of 10+ engineers",
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
            sentence: "I'm currently learning Ruby on Rails to expand my expertise in web development frameworks",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph14",
        },
    ];

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
                document.body.appendChild(element);
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
                document.body.appendChild(element);
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
