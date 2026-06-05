document.addEventListener('DOMContentLoaded', () => {
    const weatherBar = document.getElementById('weather-bar');
    if (!weatherBar) return;

    const loadingIndicator = document.getElementById('weather-loading');
    const weatherContent = document.getElementById('weather-content');
    const weatherItems = document.getElementById('weather-items');
    const weatherItemsClone = document.getElementById('weather-items-clone');
    const timeVal = document.querySelector('.time-val');

    const cities = [
        { name: 'Araranguá', lat: -28.9344, lon: -49.4858 },
        { name: 'Balneário Arroio do Silva', lat: -28.9836, lon: -49.4122 },
        { name: 'Balneário Gaivota', lat: -29.1558, lon: -49.5761 },
        { name: 'Ermo', lat: -28.9831, lon: -49.6433 },
        { name: 'Jacinto Machado', lat: -29.0272, lon: -49.7656 },
        { name: 'Maracajá', lat: -28.8502, lon: -49.4533 },
        { name: 'Meleiro', lat: -28.8292, lon: -49.6372 },
        { name: 'Morro Grande', lat: -28.8456, lon: -49.7906 },
        { name: 'Passo de Torres', lat: -29.3308, lon: -49.7286 },
        { name: 'Praia Grande', lat: -29.1983, lon: -49.9500 },
        { name: 'Santa Rosa do Sul', lat: -29.1302, lon: -49.7125 },
        { name: 'São João do Sul', lat: -29.2227, lon: -49.7644 },
        { name: 'Sombrio', lat: -29.1122, lon: -49.6175 },
        { name: 'Timbé do Sul', lat: -28.8358, lon: -49.8453 },
        { name: 'Turvo', lat: -28.9348, lon: -49.6806 }
    ];

    // Function to map WMO Weather codes to emojis
    function getWeatherEmoji(code) {
        if (code === 0) return '☀️';
        if (code === 1) return '🌤️';
        if (code === 2) return '⛅';
        if (code === 3) return '☁️';
        if (code >= 45 && code <= 48) return '🌫️';
        if ((code >= 51 && code <= 55) || (code >= 61 && code <= 65)) return '🌧️';
        if (code >= 71 && code <= 77) return '❄️';
        if (code >= 80 && code <= 82) return '🌦️';
        if (code >= 95 && code <= 99) return '⛈️';
        return '☀️'; // default
    }

    // Update the clock
    function updateClock() {
        if (timeVal) {
            const now = new Date();
            timeVal.textContent = now.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
        }
    }
    updateClock();
    setInterval(updateClock, 60000);

    // Fetch weather data
    async function fetchWeather() {
        const lats = cities.map(c => c.lat).join(',');
        const lons = cities.map(c => c.lon).join(',');
        
        try {
            const response = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lats}&longitude=${lons}&current=temperature_2m,weather_code&timezone=auto`);
            if (!response.ok) throw new Error('API Error');
            const data = await response.json();
            
            renderWeather(data);
        } catch (error) {
            console.error('Failed to fetch weather:', error);
            renderErrorFallback();
        }
    }

    function renderWeather(data) {
        let htmlStr = '';
        let maxTemp = -999;
        let hottestCity = '';
        
        // Open-Meteo returns an array for multiple coordinates
        if (Array.isArray(data)) {
            data.forEach((locData, index) => {
                const temp = Math.round(locData.current.temperature_2m);
                const emoji = getWeatherEmoji(locData.current.weather_code);
                const city = cities[index].name;
                htmlStr += createWeatherItem(emoji, city, temp);
                
                if (temp > maxTemp) {
                    maxTemp = temp;
                    hottestCity = city;
                }
            });
        } else {
            // Fallback just in case it's a single response
            const temp = Math.round(data.current.temperature_2m);
            const emoji = getWeatherEmoji(data.current.weather_code);
            htmlStr = createWeatherItem(emoji, cities[0].name, temp);
            maxTemp = temp;
            hottestCity = cities[0].name;
        }

        displayWeather(htmlStr);
        updateHottestCity(hottestCity, maxTemp);
    }
    
    function updateHottestCity(city, temp) {
        const hottestEl = document.getElementById('weather-hottest');
        const hottestValEl = document.querySelector('.hottest-val');
        if (hottestEl && hottestValEl && city) {
            hottestValEl.textContent = `${city} ${temp}°C`;
            hottestEl.classList.remove('hidden');
        }
    }

    function renderErrorFallback() {
        let htmlStr = '';
        cities.forEach(city => {
            htmlStr += `<div class="inline-flex items-center space-x-1 px-3 py-1 flex-shrink-0">
                            <span class="text-gray-400" title="Indisponível">⚠️</span>
                            <span class="font-medium">${city.name}</span>
                            <span class="text-gray-500 text-xs">--°C</span>
                        </div>`;
        });
        displayWeather(htmlStr);
    }

    function createWeatherItem(emoji, city, temp) {
        return `<div class="inline-flex items-center space-x-1 px-3 py-1 hover:bg-gray-200 rounded-full cursor-default transition-colors flex-shrink-0">
                    <span>${emoji}</span>
                    <span class="font-medium">${city}</span>
                    <span class="font-bold text-gray-800 ml-1">${temp}°C</span>
                </div>`;
    }

    function displayWeather(htmlStr) {
        loadingIndicator.classList.add('hidden');
        weatherContent.classList.remove('hidden');
        weatherContent.classList.add('flex');

        if (weatherItems) weatherItems.innerHTML = htmlStr;
        if (weatherItemsClone) weatherItemsClone.innerHTML = htmlStr;
    }

    // Initial fetch
    fetchWeather();
    
    // Update every 30 minutes (1800000 ms)
    setInterval(fetchWeather, 1800000);
});
