import { Link, router, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import type { SharedProps } from '@/types';
import Container from './Container';
import Brand from './Brand';
import ThemeToggle from './ThemeToggle';

function tel(v: string) {
    return 'tel:' + v.replace(/[^0-9+]/g, '');
}

export default function Header() {
    const page = usePage<SharedProps>();
    const { site, nav, locale } = page.props;
    const url = page.url;
    const [open, setOpen] = useState(false);
    const [q, setQ] = useState('');
    const [stuck, setStuck] = useState(false);

    useEffect(() => {
        const onScroll = () => setStuck(window.scrollY > 8);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
        return () => window.removeEventListener('scroll', onScroll);
    }, []);

    const submitSearch = (e: React.FormEvent) => {
        e.preventDefault();
        if (q.trim().length >= 2) router.get('/search', { q }, { preserveState: false });
    };

    const isActive = (href?: string) => {
        if (!href || href === '/' || !url) return false;
        return url === href || url.startsWith(href + '?') || url.startsWith(href + '/');
    };

    return (
        <header className="sticky top-0 z-40">
            {/* identity bar */}
            <div
                className={`border-b border-line-soft bg-surface transition-all duration-200 ${
                    stuck ? 'py-1.5 shadow-md' : 'py-3'
                }`}
            >
                <Container className="flex items-center gap-3">
                    <div className={stuck ? 'scale-90 origin-left transition-transform' : 'transition-transform'}>
                        <Brand variant="header" />
                    </div>

                    <div className="ml-auto hidden items-center gap-1.5 lg:flex">
                        {[
                            { href: tel(site.phone), icon: 'telephone', title: site.phone },
                            { href: `mailto:${site.email}`, icon: 'envelope', title: site.email },
                            { href: site.facebook || '#', icon: 'facebook', title: 'Facebook' },
                        ].map((c) => (
                            <a
                                key={c.icon}
                                href={c.href}
                                title={c.title}
                                className="flex h-8 w-8 items-center justify-center rounded-full border border-brand-200 text-[0.75rem] text-brand-600 transition-colors hover:border-brand-500 hover:bg-brand-500 hover:text-white dark:border-white/20 dark:text-white/85"
                            >
                                <i className={`bi bi-${c.icon}`} />
                            </a>
                        ))}
                        <ThemeToggle />
                    </div>

                    <form onSubmit={submitSearch} className="hidden xl:block">
                        <div className="relative">
                            <i className="bi bi-search pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[0.7rem] text-ink-soft" />
                            <input
                                value={q}
                                onChange={(e) => setQ(e.target.value)}
                                type="search"
                                placeholder="Хайх"
                                className="w-52 rounded-full border border-line bg-surface-sunken py-1.5 pl-8 pr-3 text-[0.72rem] text-ink outline-none transition-colors focus:border-brand-400 focus:bg-surface"
                            />
                        </div>
                    </form>

                    <div className="hidden items-center gap-0.5 rounded-full bg-surface-sunken p-0.5 lg:flex">
                        {['mn', 'en'].map((l) => (
                            <Link
                                key={l}
                                href={`/lang/${l}`}
                                preserveScroll
                                className={`rounded-full px-2 py-0.5 text-[0.7rem] font-bold uppercase transition-colors ${
                                    locale === l ? 'bg-brand-600 text-white' : 'text-ink-soft hover:text-link'
                                }`}
                            >
                                {l}
                            </Link>
                        ))}
                    </div>

                    <div className="ml-auto flex items-center gap-2 xl:hidden">
                        <ThemeToggle className="lg:hidden" />
                        <button
                            onClick={() => setOpen((v) => !v)}
                            className="flex h-9 w-9 items-center justify-center rounded-lg border border-brand-500 text-brand-500 dark:border-accent dark:text-accent"
                            aria-label="Цэс"
                        >
                            <i className={`bi ${open ? 'bi-x-lg' : 'bi-list'} text-lg`} />
                        </button>
                    </div>
                </Container>
            </div>

            {/* main nav */}
            <nav className="hidden border-t border-white/10 bg-brand-900 xl:block">
                <Container>
                    <ul className="flex justify-center">
                        {nav.map((item) => {
                            const active = isActive(item.url) || item.children?.some((c) => isActive(c.url));
                            return (
                                <li key={item.label} className="group relative">
                                    {item.url ? (
                                        <Link
                                            href={item.url}
                                            className={`flex items-center px-4 py-3.5 text-[0.7rem] font-semibold uppercase tracking-wide transition-colors ${
                                                active ? 'bg-white/10 text-white' : 'text-white/80 hover:text-white'
                                            }`}
                                        >
                                            {item.label}
                                        </Link>
                                    ) : (
                                        <>
                                            <button
                                                type="button"
                                                aria-haspopup="true"
                                                className={`flex items-center gap-1.5 px-4 py-3.5 text-[0.7rem] font-semibold uppercase tracking-wide transition-colors ${
                                                    active ? 'bg-white/10 text-white' : 'text-white/80 hover:text-white'
                                                }`}
                                            >
                                                {item.label}
                                                <i className="bi bi-chevron-down text-[0.5rem] transition-transform group-hover:rotate-180 group-focus-within:rotate-180" />
                                            </button>
                                            <ul className="invisible absolute left-0 top-full z-20 min-w-60 -translate-y-1 overflow-hidden rounded-xl border-t-2 border-accent bg-surface py-2 opacity-0 shadow-2xl transition-all duration-150 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100">
                                                {item.children!.map((c, i) => (
                                                    <li key={i}>
                                                        <NavChildLink href={c.url} label={c.label} />
                                                    </li>
                                                ))}
                                            </ul>
                                        </>
                                    )}
                                </li>
                            );
                        })}
                    </ul>
                </Container>
            </nav>

            {/* mobile menu */}
            {open && (
                <div className="border-t border-white/10 bg-brand-900 xl:hidden">
                    <Container className="pb-4">
                        <form onSubmit={submitSearch} className="my-3 flex overflow-hidden rounded-lg">
                            <input
                                value={q}
                                onChange={(e) => setQ(e.target.value)}
                                type="search"
                                placeholder="Хайх үгээ бичнэ үү"
                                className="w-full px-4 py-2 text-[0.8rem] outline-none"
                            />
                            <button className="bg-accent px-4 text-white">
                                <i className="bi bi-search" />
                            </button>
                        </form>
                        <ul className="flex flex-col divide-y divide-white/10">
                            {nav.map((item) => (
                                <li key={item.label} className="py-1">
                                    {item.url ? (
                                        <Link href={item.url} className="block py-2 text-[0.8rem] font-semibold uppercase text-white">
                                            {item.label}
                                        </Link>
                                    ) : (
                                        <details>
                                            <summary className="cursor-pointer list-none py-2 text-[0.8rem] font-semibold uppercase text-white">
                                                {item.label}
                                            </summary>
                                            <ul className="pb-2 pl-3">
                                                {item.children!.map((c, i) => (
                                                    <li key={i}>
                                                        <Link href={c.url} className="block py-1.5 text-[0.75rem] text-white/75">
                                                            {c.label}
                                                        </Link>
                                                    </li>
                                                ))}
                                            </ul>
                                        </details>
                                    )}
                                </li>
                            ))}
                        </ul>
                    </Container>
                </div>
            )}
        </header>
    );
}

function NavChildLink({ href, label }: { href: string; label: string }) {
    const external = /^https?:\/\//.test(href);
    const cls =
        'block px-5 py-2 text-[0.72rem] text-ink-soft transition-colors hover:bg-brand-tint hover:text-link';
    return external ? (
        <a href={href} target="_blank" rel="noopener" className={cls}>
            {label}
        </a>
    ) : (
        <Link href={href} className={cls}>
            {label}
        </Link>
    );
}
