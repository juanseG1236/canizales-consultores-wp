import puppeteer from 'puppeteer-core';

const base = 'http://127.0.0.1:9400';
const browser = await puppeteer.launch({
	executablePath: 'C:/Program Files/Google/Chrome/Application/chrome.exe',
	headless: 'new',
});
const page = await browser.newPage();
await page.setViewport({ width: 1440, height: 1000 });

await page.goto(base + '/wp-admin/', { waitUntil: 'networkidle0', timeout: 120000 });
if (page.url().includes('wp-login.php')) {
	await page.type('#user_login', 'admin');
	await page.type('#user_pass', 'password');
	await Promise.all([page.waitForNavigation({ waitUntil: 'networkidle0' }), page.click('#wp-submit')]);
}

const nonce = await page.evaluate(() => window.wpApiSettings ? window.wpApiSettings.nonce : '');
const pages = await page.evaluate(async (n) => {
	const r = await fetch('/wp-json/wp/v2/pages?per_page=50&status=publish,draft&_fields=id,slug', { headers: { 'X-WP-Nonce': n } });
	return r.json();
}, nonce);

const targets = pages.map((p) => ({ name: 'page:' + p.slug, url: `/wp-admin/post.php?post=${p.id}&action=edit` }));
targets.push({ name: 'site-editor:header', url: '/wp-admin/site-editor.php?postType=wp_template_part&postId=canizales//header&canvas=edit' });
targets.push({ name: 'site-editor:footer', url: '/wp-admin/site-editor.php?postType=wp_template_part&postId=canizales//footer&canvas=edit' });
targets.push({ name: 'site-editor:page-template', url: '/wp-admin/site-editor.php?postType=wp_template&postId=canizales//page&canvas=edit' });

for (const t of targets) {
	const errors = [];
	const onConsole = (msg) => {
		const text = msg.text();
		if (/Block validation|invalid content|Block validation failed/i.test(text)) errors.push(text.slice(0, 300));
	};
	page.on('console', onConsole);
	await page.goto(base + t.url, { waitUntil: 'networkidle0', timeout: 180000 });
	await new Promise((r) => setTimeout(r, 6000));
	const warnings = await page.evaluate(() => {
		const docs = [document, ...Array.from(document.querySelectorAll('iframe')).map((f) => { try { return f.contentDocument; } catch (e) { return null; } }).filter(Boolean)];
		let n = 0;
		const names = [];
		docs.forEach((d) => d.querySelectorAll('.block-editor-warning').forEach((w) => { n++; const b = w.closest('[data-type]'); names.push(b ? b.getAttribute('data-type') : '?'); }));
		return { n, names };
	});
	page.off('console', onConsole);
	console.log(`${t.name}: warnings=${warnings.n} ${warnings.names.join(',')} validationLogs=${errors.length}`);
	errors.slice(0, 2).forEach((e) => console.log('   ', e.replace(/\s+/g, ' ')));
}
await browser.close();
