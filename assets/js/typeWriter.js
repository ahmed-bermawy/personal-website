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
            sentence: "So Let my introduce myself 😊",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph5",
        },
        {
            sentence: "My name is Ahmed Al Bermawy",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph6",
        },
        {
            sentence: "I have around 12 years of experience in web development",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph7",
        },
        {
            sentence: "My proficiency spans Backend technologies, encompassing PHP Frameworks (specifically Laravel and Symfony)",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph8",
        },
        {
            sentence: "CMS platforms (including Shopware, WordPress, and Drupal), as well as expertise in Mysql, Apache Webserver, RESTful API, Facebook SDK, Youtube SDK, Google SDK, and Radius.",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph9",
        },
        {
            sentence: "On the Frontend side, I excel in HTML, HTML5, JavaScript, JQuery, Ajax, Json, CSS, CSS3, Bootstrap, and XML.",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph10",
        },
        {
            sentence: "Additionally, I am well-versed in operating on Centos and Ubuntu, adept at configuring environments on both distributions.",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph11",
        },
        {
            sentence: "I have a keen interest in continuously expanding my knowledge and skills, eagerly embracing new technologies as they emerge.",
            delay: 50,
            initialDelay: 0,
            elementId: "paragraph12",
        },
    ];

    let skip = false;
    const typewriterSound = document.getElementById('typewriterSound');
    const skipButton = document.getElementById('skipButton');

    if (!typewriterSound) {
        console.error('typewriterSound element not found');
        return;
    }

    // Display "Hello, World!" for 4 seconds
    setTimeout(() => {
        // Show the skip button with fade-in effect
        skipButton.classList.add('show');
        // Start the typewriter effect
        typeWriter(mySentences, 0, 0);
    }, 4000);

    function typeWriter(sentences, sentenceIndex, charIndex) {
        if (skip) {
            displayAllSentences(sentences);
            typewriterSound.pause();
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
                    typewriterSound.play();
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
        typewriterSound.pause();
        skipButton.classList.add('fade-out');
        skipButton.classList.remove('show');
        setTimeout(() => displayAllSentences(mySentences), 1000); // Wait for the fade-out effect to complete
    });
});
