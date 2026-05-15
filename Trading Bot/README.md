# Trading Bot - Automated Trading System

A simple yet functional trading bot that uses a **Moving Average Crossover Strategy** to simulate automated trading. This is an educational project to demonstrate algorithmic trading concepts.

## 🚀 Features

- **Automated Trading**: Bot makes buy/sell decisions based on moving average crossovers
- **Real-time Price Simulation**: Simulates market price movements
- **Portfolio Management**: Track your cash, assets, and total portfolio value
- **Moving Average Indicators**: 
  - Fast MA (5 periods)
  - Slow MA (20 periods)
- **Visual Chart**: Real-time price chart with moving average overlays
- **Trading History**: Complete log of all trades executed
- **Manual Trading**: Override the bot with manual buy/sell controls
- **Profit/Loss Tracking**: Monitor your performance in real-time

## 📊 Trading Strategy

The bot uses a **Simple Moving Average (SMA) Crossover Strategy**:

### Buy Signal
- **When**: Fast MA crosses above Slow MA
- **Action**: Buy with all available cash

### Sell Signal
- **When**: Fast MA crosses below Slow MA
- **Action**: Sell all assets

### Hold Signal
- **When**: No crossover detected
- **Action**: No trade executed

## 🎮 How to Use

1. **Open** `index.html` in your web browser
2. **Click "Start Bot"** to enable automated trading
3. **Watch** as the bot analyzes price movements and executes trades
4. **Monitor** your portfolio performance in real-time
5. Use **Manual Trading** buttons to override the bot
6. **Reset** to start over with initial capital

## 💼 Initial Setup

- **Starting Capital**: $10,000
- **Initial Price**: $100
- **Fast Moving Average**: 5 periods
- **Slow Moving Average**: 20 periods
- **Price Update Interval**: 2 seconds

## 📈 Dashboard Components

### Portfolio Card
- Current cash balance
- Number of assets held
- Total portfolio value
- Profit/Loss from initial capital

### Price Chart
- Real-time price visualization
- Fast MA (green dashed line)
- Slow MA (red dashed line)
- Current trading signal indicator

### Bot Controls
- Start/Stop automated trading
- Reset portfolio to initial state
- Manual buy/sell buttons

### Trading History
- Chronological log of all trades
- Trade type (BUY/SELL/SYSTEM)
- Trade details (quantity, price)
- Timestamp of each trade

## 🛠️ Technical Details

### Technologies Used
- **HTML5** - Structure and layout
- **CSS3** - Styling and animations
- **Vanilla JavaScript** - Trading logic and UI interactions
- **Canvas API** - Real-time chart rendering

### Key Components

#### TradingBot Class
```javascript
- initializePrice() - Sets up initial price history
- startPriceSimulation() - Simulates market price movements
- calculateMA(period) - Calculates moving averages
- checkTradingSignals() - Analyzes signals for trading opportunities
- buy() / sell() - Execute trades
- drawChart() - Renders the price chart
```

## ⚠️ Important Notes

- **This is a simulation for educational purposes only**
- Not connected to real markets or exchanges
- No real money is involved
- Price movements are randomly generated
- Strategy performance is simulated

## 🎓 Learning Objectives

This project demonstrates:
1. Algorithmic trading concepts
2. Technical analysis using moving averages
3. Portfolio management
4. Real-time data visualization
5. Event-driven programming
6. DOM manipulation and Canvas API

## 🔮 Future Enhancements

Potential improvements:
- Multiple trading strategies (RSI, MACD, Bollinger Bands)
- Risk management (stop-loss, take-profit)
- Backtesting capabilities
- Multiple assets/symbols
- Historical data import
- Performance analytics
- Strategy optimization tools

## 📝 License

This is an educational project. Feel free to use and modify for learning purposes.

## 👨‍💻 Author

Created as part of a JavaScript learning portfolio.

---

**Happy Trading! 📈💰**
