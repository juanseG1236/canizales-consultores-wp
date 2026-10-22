import puppeteer from 'puppeteer-core';

const [path = '/', width = '1440', ...selectors] = process.argv.slice(2);

const browser = await puppeteer.launch({
	executablePath: 'C:/Program Files/Google/Chrome/Application/chrome.exe',
	headless: 'new',
});
const page = await browser.newPage();
await page.setViewport({ width: Number(width), height: 900 });
await page.goto('http://127.0.0.1:9400' + path, { waitUntil: 'networkidle0', timeout: 120000 });
await page.addStyleTag({ content: '#wpadminbar{display:none!important} html{margin-top:0!important} .admin-bar .site-header{top:0!important} .wa-float{display:none!important}' });
await page.evaluate(async () => {
	document.querySelectorAll('.reveal').forEach((el) => el.classList.add('is-visible'));
	await new Promise((r) => setTimeout(r, 1500));
});
for (const sel of selectors) {
	const el = await page.$(sel);
	if (!el) { console.log('missing', sel); continue; }
	const name = `shots/sec-${(path.replace(/\//g, '') || 'home')}-${sel.replace(/[^a-z0-9]+/gi, '')}-${width}.png`;
	await el.screenshot({ path: name });
	console.log('ok', name);
}
await browser.close();
