import puppeteer from 'puppeteer-core';

const base = 'http://127.0.0.1:9400';
const browser = await puppeteer.launch({
	executablePath: 'C:/Program Files/Google/Chrome/Application/chrome.exe',
	headless: 'new',
});
const page = await browser.newPage();
await page.setViewport({ width: 1440, height: 1000 });
await page.goto(base + '/wp-admin/', { waitUntil: 'domcontentloaded', timeout: 120000 });

const targets = [
	['inicio-editor', '/wp-admin/post.php?post=' + (process.argv[2] || '') + '&action=edit'],
	['header', '/wp-admin/site-editor.php?postType=wp_template_part&postId=canizales//header&canvas=edit'],
	['footer', '/wp-admin/site-editor.php?postType=wp_template_part&postId=canizales//footer&canvas=edit'],
	['page-template', '/wp-admin/site-editor.php?postType=wp_template&postId=canizales//page&canvas=edit'],
	['estilos', '/wp-admin/site-editor.php?p=%2Fstyles'],
];

for (const [name, url] of targets) {
	if (name === 'inicio-editor' && !process.argv[2]) continue;
	const logs = [];
	const onConsole = (m) => { if (/validation/i.test(m.text())) logs.push(m.text().slice(0, 200)); };
	page.on('console', onConsole);
	await page.goto(base + url, { waitUntil: 'domcontentloaded', timeout: 180000 });
	await new Promise((r) => setTimeout(r, 20000));
	const res = await page.evaluate(() => {
		const docs = [document, ...Array.from(document.querySelectorAll('iframe')).map((f) => { try { return f.contentDocument; } catch (e) { return null; } }).filter(Boolean)];
		let n = 0; let blocks = 0;
		docs.forEach((d) => { n += d.querySelectorAll('.block-editor-warning').length; blocks += d.querySelectorAll('[data-block]').length; });
		return { n, blocks };
	});
	page.off('console', onConsole);
	await page.screenshot({ path: `shots/editor-${name}.png` });
	console.log(`${name}: blocks=${res.blocks} warnings=${res.n} validationLogs=${logs.length}`);
	logs.slice(0, 2).forEach((l) => console.log('   ', l));
}
await browser.close();
