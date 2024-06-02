from flask import Flask, jsonify, render_template, request
import apikey
import requests

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/cryptocurrency', methods=['GET'])
def get_cryptocurrency_data():
    headers = {
        'X-CMC_PRO_API_KEY': apikey.price_key,
        'Accepts': 'application/json'
    }

    params = {
        'start': '1',
        'limit': '7',
        'convert': 'USD'
    }

    url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest'

    response = requests.get(url, params=params, headers=headers)

    if response.status_code == 200:
        data = response.json()
        coins = data['data']
        cryptocurrency_data = [{'symbol': x['symbol'], 'price': x['quote']['USD']['price']} for x in coins]
        return jsonify(cryptocurrency_data)
    else:
        return jsonify({'error': 'Failed to fetch cryptocurrency data'})

if __name__ == '__main__':
    app.run(debug=True)
