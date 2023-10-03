function generateDynamicFavicon() {
  let link = document.querySelector("link[rel~='icon']");
  let randomNumber = Math.floor(Math.random() * 10);
  if (!link) {
    link = document.createElement("link");
    link.rel = "shortcut icon";
    link.href = listOfWebsiteFavicon(randomNumber);
    document.getElementsByTagName("head")[0].appendChild(link);
  }
}

function listOfWebsiteFavicon(randomNumber) {
  let list = [
    "https://www.google.com/favicon.ico",
    "https://www.php.net/favicon.ico",
    "https://stackoverflow.com/favicon.ico",
    "https://github.githubassets.com/favicons/favicon.svg",
    "https://developer.mozilla.org/favicon-48x48.cbbd161b.png",
    "https://facebook.com/favicon.ico",
    "https://static-exp1.licdn.com/sc/h/al2o9zrvru7aqj8e1x2rzsrca",
    "https://www.udemy.com/staticx/udemy/images/v8/favicon-32x32.png",
    "https://www.udacity.com/images/favicon-mask.svg",
    "https://www.youtube.com/s/desktop/f4861452/img/favicon_32x32.png",
    "https://a.slack-edge.com/80588/marketing/img/meta/favicon-32.png",
    "https://emojicopy.com/assets/icons/favicon-32x32.png",
    "https://en.wikipedia.org/static/favicon/wikipedia.ico",
  ];
  return list[randomNumber] + "?v=" + randomNumber;
}
