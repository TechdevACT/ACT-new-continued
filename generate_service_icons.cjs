const fs = require('fs');
const path = require('path');

const icons = [
    { id: 1, name: 'lightbulb' },
    { id: 2, name: 'rocket' },
    { id: 3, name: 'puzzle' },
    { id: 4, name: 'briefcase' },
    { id: 5, name: 'users' },
    { id: 6, name: 'target' },
    { id: 7, name: 'zap' },
    { id: 8, name: 'shield-check' }
];

const outDir = path.join(__dirname, 'public', 'images');

const fetchIcon = async (name) => {
    const res = await fetch('https://unpkg.com/lucide-static@latest/icons/' + name + '.svg');
    return await res.text();
};

const generate = async () => {
    for (let i = 0; i < icons.length; i++) {
        const item = icons[i];
        console.log('Fetching ' + item.name + '...');
        const svgContent = await fetchIcon(item.name);
        
        // Extract inner paths using dotAll /s flag
        const innerContentMatch = svgContent.match(/<svg[^>]*>(.*?)<\/svg>/s);
        if (!innerContentMatch) {
            console.error('Failed to parse ' + item.name + '\\nContent:\\n' + svgContent.slice(0, 100));
            continue;
        }
        
        let paths = innerContentMatch[1].trim();
        paths = paths.replace(/class="[^"]*"/g, '');

        const circle1X = 100 + (i * 30) % 150;
        const circle1Y = 80 + (i * 20) % 100;
        
        const circle2X = 500 + (i * 40) % 150;
        const circle2Y = 150 - (i * 15) % 80;
        
        const rect1X = 150 + (i * 50) % 100;
        
        const template = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 689 260" fill="none">' +
    '<path d="M442 2.85H270C259 2.85 251 11.27 251 21.65V235.9C251 246.28 259 254.69 270 254.69H442C452 254.69 461 246.28 461 235.9V21.65C461 11.27 452 2.85 442 2.85Z" stroke="#FECA74" stroke-width="2"/>' +
    '<path d="M219 2.85H47C37 2.85 28 11.27 28 21.65V235.9C28 246.28 37 254.69 47 254.69H219C230 254.69 238 246.28 238 235.9V21.65C238 11.27 230 2.85 219 2.85Z" stroke="#FECA74" stroke-width="2"/>' +
    '<path d="M664 2.85H492C482 2.85 473 11.27 473 21.65V235.9C473 246.28 482 254.69 492 254.69H664C675 254.69 683 246.28 683 235.9V21.65C683 11.27 675 2.85 664 2.85Z" stroke="#FECA74" stroke-width="2"/>' +
    '<circle cx="' + circle1X + '" cy="' + circle1Y + '" r="40" fill="#FECA74" fill-opacity="0.6"/>' +
    '<circle cx="' + circle2X + '" cy="' + circle2Y + '" r="60" stroke="#FECA74" stroke-width="2" fill="none"/>' +
    '<rect x="' + rect1X + '" y="180" width="80" height="20" rx="10" fill="#464D51" opacity="0.8"/>' +
    '<circle cx="' + (circle2X - 50) + '" cy="' + (circle2Y + 40) + '" r="15" fill="#FECA74"/>' +
    '<rect x="' + (circle1X + 400) + '" y="' + (circle1Y - 20) + '" width="60" height="8" rx="4" fill="#464D51"/>' +
    '<circle cx="344.5" cy="130" r="75" fill="#FECA74" opacity="0.3"/>' +
    '<g transform="translate(296.5, 82) scale(4)" stroke="#464D51" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none">' +
        paths +
    '</g>' +
'</svg>';

        fs.writeFileSync(path.join(outDir, 'fnk_services_' + item.id + '_f.svg'), template);
        console.log('Generated fnk_services_' + item.id + '_f.svg');
    }
};

generate().catch(console.error);
