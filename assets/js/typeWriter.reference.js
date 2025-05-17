const textDisplay = document.getElementById('paragraph');
const textDisplay2 = document.getElementById('paragraph2');
const phrases = ['Surprise!!', 'You thought this is the only website I build ','&#128512;'];
const phrases2 = ['Surprise!!', 'You thought this is the only website I build','&#128512;'];
const speedUp = Math.random() * (50 -10) + 10
const normalSpeed = Math.random() * (100 - 50) + 50

let i = 0,
    j = 0,
    k = 0,
    l = 0,
    currentPhrase = [],
    currentPhrase2 = [],
    isDeleting = false,
    isEnd = false,
    time = 0

function loopOnPhrasesAndDeleteThem(){
    isEnd = false
    textDisplay2.innerHTML = currentPhrase2.join('')
    if (k < phrases2.length){
        if (!isDeleting && l <= phrases2[k].length){
            currentPhrase2.push(phrases2[k][l])
            l++
            textDisplay2.innerHTML = currentPhrase2.join('')
        }

        if (isDeleting && l <= phrases2[k].length){
            currentPhrase2.pop(phrases2[k][l])
            l--
            textDisplay2.innerHTML = currentPhrase2.join('')
        }

        if (l === phrases2[k].length) {
            isEnd = true
            isDeleting = true
        }

        if (isDeleting && l === 0){
            currentPhrase2 = []
            isDeleting= false
            k++
            if (k === phrases2.length){
                k = 0
            }
        }
    }
    time = isEnd ? 1000 : isDeleting ? speedUp : normalSpeed
    setTimeout(loopOnPhrasesAndDeleteThem, time);
}

function loopOnPhrases(){
    textDisplay.innerHTML = currentPhrase.join('');
    if (i < phrases.length){
        if (j <= phrases[i].length){
            currentPhrase.push(phrases[i][j]);
            j++
        }

        if (j === phrases[i].length) {
            currentPhrase.push(' ');
            j=0
            i++
        }
    }
    setTimeout(loopOnPhrases, 100)
}

// setTimeout(loopOnPhrases, 3000)
// setTimeout(loopOnPhrasesAndDeleteThem, 6000)


// function typeWriter(sentence, delay) {
//     let index = 0;
  
//     function type() {
//       if (index < sentence.length) {
//         // Display one character at a time
//         //console.clear(); // Optional: Clear console for a cleaner output
//         //console.log(sentence.substring(0, index + 1));
//         textDisplay1.innerHTML = sentence.substring(0, index + 1)
//         index++;
//         setTimeout(type, delay);
//       }
//     }
  
//     // Start the typewriter effect
//     type();
//   }



// function typeWriter(sentence, delay, elementId) {
//     let index = 0;
//     const element = document.getElementById(elementId);
  
//     function type() {
//       if (index < sentence.length) {
//         // Display one character at a time
//         element.textContent = sentence.substring(0, index + 1);
//         index++;
//         setTimeout(type, delay);
//       }
//     }
  
//     // Start the typewriter effect
//     type();
//   }
  
//   // Example usage
//   const mySentence = "Hello, this is a typewriter effect!";
//   const myDelay = 100; // milliseconds
//   const myElementId = "paragraph";
  
  typeWriter("Hello, this is a typewriter effect!", 100, "paragraph");
  typeWriter('You thought this is the only website I build', 100, "paragraph2");
  
//   // Example usage
//   const mySentence = "Hello, this is a typewriter effect!";
//   const myDelay = 100; // milliseconds
  
//   typeWriter(mySentence, myDelay);




// function typeWriter(sentence, delay, initialDelay, elementId) {
//     let index = 0;
//     const element = document.getElementById(elementId);
  
//     function type() {
//       if (index < sentence.length) {
//         // Display one character at a time
//         element.textContent = sentence.substring(0, index + 1);
//         index++;
//         setTimeout(type, delay);
//       }
//     }
  
//     // Start the typewriter effect after the initial delay
//     setTimeout(type, initialDelay);
//   }
  
//   // Example usage
//   const mySentence = "Hello, this is a typewriter effect!";
//   const myDelay = 100; // milliseconds
//   const myInitialDelay = 2000; // 2000 milliseconds = 2 seconds
//   const myElementId = "paragraph";
  
//   //typeWriter(mySentence, myDelay, myInitialDelay, myElementId);

//   typeWriter("Hello, this is a typewriter effect!",100, 0, "paragraph1");
//   typeWriter('You thought this is the only website I build',100, 4000, "paragraph2");
//   typeWriter('I want to discover the ablity of that',100, 8000, "paragraph3");
//   typeWriter('My name is Ahmed Al Bermawy',100, 12000, "paragraph4");



  function typeWriter(sentences, sentenceIndex, charIndex) {
    if (sentenceIndex < sentences.length) {
      const { sentence, delay, initialDelay, elementId } = sentences[sentenceIndex];
      const element = document.getElementById(elementId);
  
      if (charIndex < sentence.length) {
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
  
  // Example usage with multiple sentences
  const mySentences = [
    {
      sentence: "Surprise!! ",
      delay: 100,
      initialDelay: 0,
      elementId: "paragraph1"
    },
    {
      sentence: "You thought this is the only website I build 😁",
      delay: 100,
      initialDelay: 0,
      elementId: "paragraph2"
    },
    {
      sentence: "I like the idea that i'm writing on typewriter 😄",
      delay: 100,
      initialDelay: 0,
      elementId: "paragraph3"
    },
    {
        sentence: "And though that will be good idea to build my own website in this way 😊",
        delay: 100,
        initialDelay: 0,
        elementId: "paragraph4"
    },
    {
    sentence: "So Let my introduce me self 😊",
    delay: 100,
    initialDelay: 0,
    elementId: "paragraph5"
    },
    {
        sentence: "My name is Ahmed Al Bermawy",
        delay: 100,
        initialDelay: 0,
        elementId: "paragraph5"
    }
  ];
  
  // Start the typewriter effect
  typeWriter(mySentences, 0, 0);
