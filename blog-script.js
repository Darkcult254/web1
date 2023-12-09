// your-script.js
document.addEventListener('DOMContentLoaded', function () {
    fetch('display_blog.php')
        .then(response => response.json()) // Assuming you return JSON data from display_blog.php
        .then(data => {
            displayLatestArticles(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

function displayLatestArticles(articles) {
    const latestArticlesList = document.getElementById('latest-articles-list');
    latestArticlesList.innerHTML = ''; // Clear the existing content

    for (let i = 0; i < 5 && i < articles.length; i++) {
        const article = articles[i];
        const listItem = document.createElement('li');
        const link = document.createElement('a');
        link.href = article.link; // Adjust the property accordingly
        link.textContent = article.title; // Adjust the property accordingly
        listItem.appendChild(link);
        latestArticlesList.appendChild(listItem);
    }
}
