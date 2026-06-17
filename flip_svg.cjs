const fs = require('fs');

const s3 = fs.readFileSync('public/images/fnk_services_3_f.svg', 'utf8');
const out3 = s3.replace('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 697 260" fill="none">', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 697 260" fill="none"><g transform="translate(697, 0) scale(-1, 1)">').replace('</svg>', '</g></svg>');
fs.writeFileSync('public/images/fnk_services_7_f.svg', out3);

const s5 = fs.readFileSync('public/images/fnk_services_5_f.svg', 'utf8');
const out5 = s5.replace('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 691 260" fill="none">', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 691 260" fill="none"><g transform="translate(691, 0) scale(-1, 1)">').replace('</svg>', '</g></svg>');
fs.writeFileSync('public/images/fnk_services_8_f.svg', out5);
