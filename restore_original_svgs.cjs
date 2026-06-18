const fs = require('fs');
const path = require('path');

const outDir = path.join(__dirname, 'public', 'images');

const fetchOriginal = async (num) => {
    const url = 'https://theme.madsparrow.me/osty/wp-content/uploads/2025/02/fnk_services_' + num + '_f.svg';
    console.log('Fetching', url);
    const res = await fetch(url);
    if (!res.ok) throw new Error('Failed to fetch ' + url);
    return await res.text();
};

const flipSvg = (content, originalWidth) => {
    // E.g. <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 691 260" fill="none">
    // We replace it with <svg ...><g transform="translate(691, 0) scale(-1, 1)">... </g></svg>
    return content
        .replace(/<svg([^>]*)>/, '<svg$1><g transform="translate(' + originalWidth + ', 0) scale(-1, 1)">')
        .replace('</svg>', '</g></svg>');
};

const run = async () => {
    const svgs = {};
    for (let i = 1; i <= 6; i++) {
        const content = await fetchOriginal(i);
        svgs[i] = content;
        fs.writeFileSync(path.join(outDir, 'fnk_services_' + i + '_f.svg'), content);
    }
    
    // Create 7 by flipping 2 (Digital & Tech)
    // viewBox for 2 is "0 0 691 260" (I can parse it)
    const match2 = svgs[2].match(/viewBox="0 0 (\\d+) \\d+"/);
    const w2 = match2 ? match2[1] : 691;
    fs.writeFileSync(path.join(outDir, 'fnk_services_7_f.svg'), flipSvg(svgs[2], w2));
    
    // Create 8 by flipping 5 (Human-Centered)
    const match5 = svgs[5].match(/viewBox="0 0 (\\d+) \\d+"/);
    const w5 = match5 ? match5[1] : 691;
    fs.writeFileSync(path.join(outDir, 'fnk_services_8_f.svg'), flipSvg(svgs[5], w5));
    
    console.log('Done!');
};

run().catch(console.error);
