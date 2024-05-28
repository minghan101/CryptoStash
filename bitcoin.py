import apikey
import requests

headers = {
    'X-CMC_PRO_API_KEY' : apikey.key ,
    'Accepts' : 'application/json'
}

params = {
    'start' : '1',
    'limit' : '7',
    'convert' : 'USD'
}

url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest'

json = requests.get(url, params=params, headers=headers).json()

coins = json['data']

for x in coins:
    print(x['symbol'], x['quote']['USD']['price'])
    