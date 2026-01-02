// Trading Bot - Simple Moving Average Strategy
class TradingBot {
    constructor() {
        // Initial portfolio
        this.initialCash = 10000;
        this.cash = this.initialCash;
        this.assets = 0;
        this.currentPrice = 100;
        this.priceHistory = [];
        this.tradeHistory = [];
        this.isRunning = false;
        
        // Moving average periods
        this.fastMAPeriod = 5;
        this.slowMAPeriod = 20;
        
        // Chart setup
        this.canvas = document.getElementById('priceChart');
        this.ctx = this.canvas ? this.canvas.getContext('2d') : null;
        
        // Initialize
        this.initializePrice();
        this.setupEventListeners();
        this.updateUI();
        this.startPriceSimulation();
    }
    
    initializePrice() {
        // Initialize with some historical data
        for (let i = 0; i < 50; i++) {
            this.priceHistory.push({
                price: 100 + (Math.random() - 0.5) * 10,
                timestamp: Date.now() - (50 - i) * 5000
            });
        }
        this.currentPrice = this.priceHistory[this.priceHistory.length - 1].price;
    }
    
    setupEventListeners() {
        document.getElementById('startBot').addEventListener('click', () => this.startBot());
        document.getElementById('stopBot').addEventListener('click', () => this.stopBot());
        document.getElementById('resetBot').addEventListener('click', () => this.reset());
        document.getElementById('manualBuy').addEventListener('click', () => this.buy(true));
        document.getElementById('manualSell').addEventListener('click', () => this.sell(true));
    }
    
    startBot() {
        this.isRunning = true;
        document.getElementById('botStatus').textContent = 'RUNNING';
        document.getElementById('botStatus').className = 'status-running';
        document.getElementById('startBot').disabled = true;
        document.getElementById('stopBot').disabled = false;
        this.addTradeLog('Bot started', 'system');
    }
    
    stopBot() {
        this.isRunning = false;
        document.getElementById('botStatus').textContent = 'STOPPED';
        document.getElementById('botStatus').className = 'status-stopped';
        document.getElementById('startBot').disabled = false;
        document.getElementById('stopBot').disabled = true;
        this.addTradeLog('Bot stopped', 'system');
    }
    
    reset() {
        this.cash = this.initialCash;
        this.assets = 0;
        this.tradeHistory = [];
        this.priceHistory = [];
        this.initializePrice();
        this.stopBot();
        this.updateUI();
        this.drawChart();
        document.getElementById('historyContainer').innerHTML = '<p class="no-trades">No trades yet. Start the bot to begin trading!</p>';
        this.addTradeLog('Portfolio reset', 'system');
    }
    
    startPriceSimulation() {
        setInterval(() => {
            // Simulate price movement
            const change = (Math.random() - 0.5) * 5;
            this.currentPrice = Math.max(50, Math.min(200, this.currentPrice + change));
            
            this.priceHistory.push({
                price: this.currentPrice,
                timestamp: Date.now()
            });
            
            // Keep only last 100 data points
            if (this.priceHistory.length > 100) {
                this.priceHistory.shift();
            }
            
            this.updateUI();
            this.drawChart();
            
            // Check trading signals if bot is running
            if (this.isRunning) {
                this.checkTradingSignals();
            }
        }, 2000);
    }
    
    calculateMA(period) {
        if (this.priceHistory.length < period) return null;
        
        const recentPrices = this.priceHistory.slice(-period);
        const sum = recentPrices.reduce((acc, item) => acc + item.price, 0);
        return sum / period;
    }
    
    checkTradingSignals() {
        const fastMA = this.calculateMA(this.fastMAPeriod);
        const slowMA = this.calculateMA(this.slowMAPeriod);
        
        if (!fastMA || !slowMA) return;
        
        // Previous MAs
        const prevFastMA = this.calculatePreviousMA(this.fastMAPeriod);
        const prevSlowMA = this.calculatePreviousMA(this.slowMAPeriod);
        
        if (!prevFastMA || !prevSlowMA) return;
        
        // Buy signal: Fast MA crosses above Slow MA
        if (prevFastMA <= prevSlowMA && fastMA > slowMA && this.assets === 0) {
            this.buy();
        }
        
        // Sell signal: Fast MA crosses below Slow MA
        if (prevFastMA >= prevSlowMA && fastMA < slowMA && this.assets > 0) {
            this.sell();
        }
    }
    
    calculatePreviousMA(period) {
        if (this.priceHistory.length < period + 1) return null;
        
        const recentPrices = this.priceHistory.slice(-period - 1, -1);
        const sum = recentPrices.reduce((acc, item) => acc + item.price, 0);
        return sum / period;
    }
    
    buy(manual = false) {
        if (this.cash < this.currentPrice) {
            this.addTradeLog('Insufficient funds to buy', 'error');
            return;
        }
        
        const quantity = Math.floor(this.cash / this.currentPrice);
        const cost = quantity * this.currentPrice;
        
        this.assets += quantity;
        this.cash -= cost;
        
        this.tradeHistory.push({
            type: 'buy',
            price: this.currentPrice,
            quantity: quantity,
            cost: cost,
            timestamp: Date.now(),
            manual: manual
        });
        
        this.addTradeLog(`BUY: ${quantity} units at $${this.currentPrice.toFixed(2)}`, 'buy');
        this.updateUI();
    }
    
    sell(manual = false) {
        if (this.assets === 0) {
            this.addTradeLog('No assets to sell', 'error');
            return;
        }
        
        const quantity = this.assets;
        const revenue = quantity * this.currentPrice;
        
        this.cash += revenue;
        this.assets = 0;
        
        this.tradeHistory.push({
            type: 'sell',
            price: this.currentPrice,
            quantity: quantity,
            revenue: revenue,
            timestamp: Date.now(),
            manual: manual
        });
        
        this.addTradeLog(`SELL: ${quantity} units at $${this.currentPrice.toFixed(2)}`, 'sell');
        this.updateUI();
    }
    
    updateUI() {
        // Update portfolio stats
        document.getElementById('cash').textContent = `$${this.cash.toFixed(2)}`;
        document.getElementById('assets').textContent = this.assets;
        
        const totalValue = this.cash + (this.assets * this.currentPrice);
        document.getElementById('totalValue').textContent = `$${totalValue.toFixed(2)}`;
        
        const profitLoss = totalValue - this.initialCash;
        const profitLossElement = document.getElementById('profitLoss');
        profitLossElement.textContent = `$${profitLoss.toFixed(2)}`;
        profitLossElement.style.color = profitLoss >= 0 ? '#10b981' : '#ef4444';
        
        // Update price display
        document.getElementById('currentPrice').textContent = `$${this.currentPrice.toFixed(2)}`;
        
        // Update price change
        if (this.priceHistory.length > 1) {
            const prevPrice = this.priceHistory[this.priceHistory.length - 2].price;
            const change = ((this.currentPrice - prevPrice) / prevPrice) * 100;
            const priceChangeElement = document.getElementById('priceChange');
            priceChangeElement.textContent = `${change >= 0 ? '+' : ''}${change.toFixed(2)}%`;
            priceChangeElement.className = change >= 0 ? 'price-change positive' : 'price-change negative';
        }
        
        // Update moving averages and signal
        const fastMA = this.calculateMA(this.fastMAPeriod);
        const slowMA = this.calculateMA(this.slowMAPeriod);
        
        document.getElementById('fastMA').textContent = fastMA ? `$${fastMA.toFixed(2)}` : '-';
        document.getElementById('slowMA').textContent = slowMA ? `$${slowMA.toFixed(2)}` : '-';
        
        if (fastMA && slowMA) {
            const signalElement = document.getElementById('signal');
            if (fastMA > slowMA) {
                signalElement.textContent = 'BUY';
                signalElement.className = 'signal-buy';
            } else if (fastMA < slowMA) {
                signalElement.textContent = 'SELL';
                signalElement.className = 'signal-sell';
            } else {
                signalElement.textContent = 'HOLD';
                signalElement.className = 'signal-neutral';
            }
        }
    }
    
    addTradeLog(message, type) {
        const historyContainer = document.getElementById('historyContainer');
        
        // Remove "no trades" message if it exists
        const noTrades = historyContainer.querySelector('.no-trades');
        if (noTrades) {
            noTrades.remove();
        }
        
        const tradeItem = document.createElement('div');
        tradeItem.className = `trade-item ${type}`;
        
        const now = new Date();
        const timeString = now.toLocaleTimeString();
        
        tradeItem.innerHTML = `
            <div class="trade-info">
                <div class="trade-type ${type}">${type.toUpperCase()}</div>
                <div class="trade-details">${message}</div>
            </div>
            <div class="trade-time">${timeString}</div>
        `;
        
        historyContainer.insertBefore(tradeItem, historyContainer.firstChild);
        
        // Keep only last 20 trades
        const trades = historyContainer.querySelectorAll('.trade-item');
        if (trades.length > 20) {
            trades[trades.length - 1].remove();
        }
    }
    
    drawChart() {
        if (!this.ctx || !this.canvas) return;
        
        const width = this.canvas.width = this.canvas.offsetWidth;
        const height = this.canvas.height = this.canvas.offsetHeight;
        
        this.ctx.clearRect(0, 0, width, height);
        
        if (this.priceHistory.length < 2) return;
        
        // Calculate bounds
        const prices = this.priceHistory.map(item => item.price);
        const minPrice = Math.min(...prices);
        const maxPrice = Math.max(...prices);
        const priceRange = maxPrice - minPrice;
        
        const padding = 40;
        const chartWidth = width - padding * 2;
        const chartHeight = height - padding * 2;
        
        // Draw grid
        this.ctx.strokeStyle = '#e5e7eb';
        this.ctx.lineWidth = 1;
        
        for (let i = 0; i <= 5; i++) {
            const y = padding + (chartHeight / 5) * i;
            this.ctx.beginPath();
            this.ctx.moveTo(padding, y);
            this.ctx.lineTo(width - padding, y);
            this.ctx.stroke();
            
            // Price labels
            const price = maxPrice - (priceRange / 5) * i;
            this.ctx.fillStyle = '#6b7280';
            this.ctx.font = '12px Arial';
            this.ctx.textAlign = 'right';
            this.ctx.fillText(`$${price.toFixed(2)}`, padding - 5, y + 4);
        }
        
        // Draw price line
        this.ctx.strokeStyle = '#667eea';
        this.ctx.lineWidth = 2;
        this.ctx.beginPath();
        
        this.priceHistory.forEach((item, index) => {
            const x = padding + (chartWidth / (this.priceHistory.length - 1)) * index;
            const y = padding + chartHeight - ((item.price - minPrice) / priceRange) * chartHeight;
            
            if (index === 0) {
                this.ctx.moveTo(x, y);
            } else {
                this.ctx.lineTo(x, y);
            }
        });
        
        this.ctx.stroke();
        
        // Draw moving averages
        const fastMA = [];
        const slowMA = [];
        
        for (let i = 0; i < this.priceHistory.length; i++) {
            if (i >= this.fastMAPeriod - 1) {
                const sum = this.priceHistory.slice(i - this.fastMAPeriod + 1, i + 1)
                    .reduce((acc, item) => acc + item.price, 0);
                fastMA.push(sum / this.fastMAPeriod);
            } else {
                fastMA.push(null);
            }
            
            if (i >= this.slowMAPeriod - 1) {
                const sum = this.priceHistory.slice(i - this.slowMAPeriod + 1, i + 1)
                    .reduce((acc, item) => acc + item.price, 0);
                slowMA.push(sum / this.slowMAPeriod);
            } else {
                slowMA.push(null);
            }
        }
        
        // Draw fast MA
        this.ctx.strokeStyle = '#10b981';
        this.ctx.lineWidth = 1.5;
        this.ctx.setLineDash([5, 5]);
        this.ctx.beginPath();
        
        let started = false;
        fastMA.forEach((ma, index) => {
            if (ma !== null) {
                const x = padding + (chartWidth / (this.priceHistory.length - 1)) * index;
                const y = padding + chartHeight - ((ma - minPrice) / priceRange) * chartHeight;
                
                if (!started) {
                    this.ctx.moveTo(x, y);
                    started = true;
                } else {
                    this.ctx.lineTo(x, y);
                }
            }
        });
        
        this.ctx.stroke();
        
        // Draw slow MA
        this.ctx.strokeStyle = '#ef4444';
        this.ctx.beginPath();
        
        started = false;
        slowMA.forEach((ma, index) => {
            if (ma !== null) {
                const x = padding + (chartWidth / (this.priceHistory.length - 1)) * index;
                const y = padding + chartHeight - ((ma - minPrice) / priceRange) * chartHeight;
                
                if (!started) {
                    this.ctx.moveTo(x, y);
                    started = true;
                } else {
                    this.ctx.lineTo(x, y);
                }
            }
        });
        
        this.ctx.stroke();
        this.ctx.setLineDash([]);
    }
}

// Initialize the trading bot when the page loads
document.addEventListener('DOMContentLoaded', () => {
    const bot = new TradingBot();
});
