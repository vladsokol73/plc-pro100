<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://plc-pro100.ru</loc>
    </url>
    <url>
        <loc>https://plc-pro100.ru/catalog</loc>
    </url>
    <url>
        <loc>https://plc-pro100.ru/brands</loc>
    </url>
    <sitemap>
        <loc>{{ url('sitemap/products') }}</loc>
        <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap/categories') }}</loc>
        <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
    </sitemap>
</sitemapindex>
