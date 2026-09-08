import { Link } from '@inertiajs/react';

interface PageLink {
    url: string | null;
    label: string;
    active: boolean;
}

function clean(label: string): string {
    return label
        .replace('pagination.previous', '‹')
        .replace('pagination.next', '›')
        .replace('&laquo;', '‹')
        .replace('&raquo;', '›')
        .replace(/Previous|Өмнөх/i, '‹')
        .replace(/Next|Дараах/i, '›')
        .trim();
}

export default function Pagination({ links }: { links: PageLink[] }) {
    if (links.length <= 3) return null;
    return (
        <nav className="mt-8 flex flex-wrap items-center gap-1">
            {links.map((l, i) => (
                <Link
                    key={i}
                    href={l.url || '#'}
                    preserveScroll
                    className={`min-w-9 rounded-md px-3 py-2 text-center text-[0.8rem] font-semibold transition-colors ${
                        l.active
                            ? 'bg-brand-500 text-white'
                            : l.url
                              ? 'text-ink-soft hover:bg-brand-50 hover:text-brand-600'
                              : 'pointer-events-none text-black/25'
                    }`}
                >
                    {clean(l.label)}
                </Link>
            ))}
        </nav>
    );
}
