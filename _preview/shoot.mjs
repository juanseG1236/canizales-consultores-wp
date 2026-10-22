import puppeteer from 'puppeteer-core';

const base = 'http://127.0.0.1:9400';
const pages = process.argv.slice(2);
const targets = pages.length ? pages : ['/', '/la-firma/', '/insolvencia-y-reorganizacion/', '/servicios/', '/servicios/regimen-de-insolvencia/', '/recursos/', '/contacto/'];
const widths = (process.env.WIDTHS || '1440,390').split(',').map(Number);

const browser = await puppeteer.launch({
	executablePath: 'C:/Program Files/Google/Chrome/Application/chrome.exe',
	headless: 'new',
});

for (const width of widths) {
	const page = await browser.newPage();
	await page.setViewport({ width, height: width < 600 ? 844 : 900, deviceScaleFactor: 1 });
	for (const path of targets) {
		await page.goto(base + path, { waitUntil: 'networkidle0', timeout: 120000 });
		await page.addStyleTag({ content: '#wpadminbar{display:none!important} html{margin-top:0!important} .admin-bar .site-header{top:0!important}' });
		await page.evaluate(async () => {
			document.querySelectorAll('.reveal').forEach((el) => el.classList.add('is-visible'));
			await new Promise((r) => setTimeout(r, 1200));
		});
		const name = (path.replace(/\//g, '_').replace(/^_|_$/g, '') || 'home') + '-' + width + '.png';
		await page.screenshot({ path: `shots/${name}`, fullPage: true });
		console.log('ok', name);
	}
	await page.close();
}
await browser.close();
