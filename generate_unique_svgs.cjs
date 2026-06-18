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

// Generates 8 completely unique, complex background layouts matching the theme
const getBackground = (i) => {
    const baseFrame = '<path d="M667 2.88H22.86C11.83 2.88 2.89 11.82 2.89 22.84V236.15C2.89 247.17 11.83 256.11 22.86 256.11H667C678 256.11 687 247.17 687 236.15V22.84C687 11.82 678 2.88 667 2.88Z" stroke="#FECA74" stroke-width="2"/>';
    
    let bg = baseFrame;
    if (i === 1) { // Lightbulb
        bg += '<circle cx="150" cy="130" r="80" fill="#FECA74" fill-opacity="0.3"/>';
        bg += '<rect x="400" y="80" width="200" height="100" rx="50" stroke="#FECA74" stroke-width="2" fill="none"/>';
        bg += '<path d="M230 130 L400 130" stroke="#464D51" stroke-width="2" stroke-linecap="round"/>';
        bg += '<circle cx="230" cy="130" r="10" fill="#464D51"/>';
        bg += '<circle cx="480" cy="130" r="40" fill="#FECA74"/>';
    } else if (i === 2) { // Rocket
        bg += '<rect x="100" y="50" width="120" height="120" rx="20" fill="#464D51"/>';
        bg += '<rect x="240" y="90" width="200" height="120" rx="20" stroke="#FECA74" stroke-width="2" fill="none"/>';
        bg += '<circle cx="550" cy="150" r="60" fill="#FECA74" fill-opacity="0.5"/>';
        bg += '<path d="M160 110 L500 110" stroke="#FECA74" stroke-width="2" stroke-dasharray="10 10"/>';
    } else if (i === 3) { // Puzzle
        bg += '<circle cx="200" cy="80" r="30" fill="#FECA74"/>';
        bg += '<circle cx="500" cy="180" r="50" stroke="#FECA74" stroke-width="2" fill="none"/>';
        bg += '<path d="M220 100 L320 130 L460 160" stroke="#464D51" stroke-width="2"/>';
        bg += '<circle cx="344.5" cy="130" r="80" fill="#FECA74" fill-opacity="0.2"/>';
        bg += '<circle cx="100" cy="200" r="15" fill="#464D51"/>';
    } else if (i === 4) { // Briefcase
        bg += '<rect x="120" y="150" width="40" height="60" rx="10" fill="#FECA74"/>';
        bg += '<rect x="180" y="100" width="40" height="110" rx="10" fill="#464D51"/>';
        bg += '<rect x="240" y="60" width="40" height="150" rx="10" fill="#FECA74" fill-opacity="0.5"/>';
        bg += '<path d="M350 210 L600 210" stroke="#FECA74" stroke-width="4" stroke-linecap="round"/>';
        bg += '<circle cx="550" cy="100" r="45" stroke="#FECA74" stroke-width="2" fill="none"/>';
    } else if (i === 5) { // Users
        bg += '<circle cx="250" cy="130" r="100" fill="#FECA74" fill-opacity="0.2"/>';
        bg += '<circle cx="450" cy="130" r="80" stroke="#FECA74" stroke-width="2" fill="none"/>';
        bg += '<path d="M150 130 L530 130" stroke="#FECA74" stroke-width="2" stroke-dasharray="8 8"/>';
        bg += '<rect x="580" y="80" width="60" height="10" rx="5" fill="#464D51"/>';
        bg += '<rect x="580" y="110" width="40" height="10" rx="5" fill="#FECA74"/>';
    } else if (i === 6) { // Target
        bg += '<circle cx="344.5" cy="130" r="110" stroke="#FECA74" stroke-width="2" fill="none"/>';
        bg += '<circle cx="344.5" cy="130" r="70" fill="#FECA74" fill-opacity="0.4"/>';
        bg += '<path d="M100 130 L274.5 130" stroke="#464D51" stroke-width="4" stroke-linecap="round"/>';
        bg += '<circle cx="600" cy="130" r="20" fill="#FECA74"/>';
    } else if (i === 7) { // Zap
        bg += '<path d="M100 200 Q 200 50 344.5 130 T 600 50" stroke="#FECA74" stroke-width="2" fill="none"/>';
        bg += '<rect x="150" y="80" width="80" height="80" rx="20" fill="#FECA74" fill-opacity="0.5"/>';
        bg += '<rect x="450" y="120" width="100" height="100" rx="50" fill="#464D51"/>';
        bg += '<circle cx="500" cy="170" r="10" fill="#FECA74"/>';
    } else if (i === 8) { // Shield
        bg += '<rect x="244.5" y="30" width="200" height="200" rx="30" fill="#FECA74" fill-opacity="0.2" transform="rotate(45 344.5 130)"/>';
        bg += '<circle cx="150" cy="130" r="40" stroke="#FECA74" stroke-width="2" fill="none"/>';
        bg += '<circle cx="550" cy="130" r="40" stroke="#FECA74" stroke-width="2" fill="none"/>';
        bg += '<path d="M190 130 L270 130" stroke="#464D51" stroke-width="2" stroke-linecap="round"/>';
        bg += '<path d="M420 130 L510 130" stroke="#464D51" stroke-width="2" stroke-linecap="round"/>';
    }
    
    // Add central circle for icon backdrop for all
    bg += '<circle cx="344.5" cy="130" r="50" fill="#FECA74"/>';
    
    return bg;
};

const generate = async () => {
    for (let i = 0; i < icons.length; i++) {
        const item = icons[i];
        console.log('Fetching ' + item.name + '...');
        const svgContent = await fetchIcon(item.name);
        
        const innerContentMatch = svgContent.match(/<svg[^>]*>(.*?)<\/svg>/s);
        if (!innerContentMatch) {
            console.error('Failed to parse ' + item.name);
            continue;
        }
        
        let paths = innerContentMatch[1].trim();
        paths = paths.replace(/class="[^"]*"/g, '');

        const template = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 689 260" fill="none">' +
            getBackground(item.id) +
            // Scale and center the lucide icon (24x24) to the center (344.5, 130)
            // scale(3) means 72x72. 344.5 - 36 = 308.5, 130 - 36 = 94
            '<g transform="translate(308.5, 94) scale(3)" stroke="#464D51" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none">' +
                paths +
            '</g>' +
        '</svg>';

        fs.writeFileSync(path.join(outDir, 'fnk_services_' + item.id + '_f.svg'), template);
        console.log('Generated fnk_services_' + item.id + '_f.svg');
    }
};

generate().catch(console.error);
