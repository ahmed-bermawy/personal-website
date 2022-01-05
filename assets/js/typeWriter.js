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

setTimeout(loopOnPhrases, 3000)
setTimeout(loopOnPhrasesAndDeleteThem, 6000)
