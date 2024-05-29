import apikey
import requests

api_key = apikey.news_key

def news():
    main_url = 'https://newsapi.org/v2/everything?q=tesla&from=2024-04-29&sortBy=publishedAt&apiKey=fc32e1b70e284eccb800c346892a0e42'
    news = requests.get(main_url).json()
    article = news["articles"] 
    
    news_article = []
    for a in article:
        news_article.append(a['title'])
        
    for i in range(5):
        print(i+1,news_article[i])
        
news()