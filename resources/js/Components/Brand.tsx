import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';
import type { SharedProps } from '@/types';

/**
 * Сүлд + "IPM" тэмдэг + байгууллагын нэр — нэг цул тэмдэг болгон эвлүүлсэн.
 * Сүлдний зураг ачаалагдахгүй бол градиент дүрсээр орлуулна.
 */
export default function Brand({ variant = 'header' }: { variant?: 'header' | 'footer' }) {
    const { site } = usePage<SharedProps>().props;
    const [emblemOk, setEmblemOk] = useState(true);

    const dark = variant === 'footer';

    return (
        <Link
            href="/"
            className={`flex items-center gap-2.5 ${variant === 'header' ? 'mr-auto' : ''}`}
            aria-label={site.name}
        >
            {emblemOk ? (
                <img
                    src={site.emblem}
                    onError={() => setEmblemOk(false)}
                    alt=""
                    className="h-12 w-12 shrink-0 object-contain"
                />
            ) : (
                <span className="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-brand-900 to-brand-500 text-lg text-white">
                    <i className="bi bi-diagram-3-fill" />
                </span>
            )}

            <span className="flex flex-col justify-center">
                <span
                    className={`text-[1.65rem] font-extrabold leading-none tracking-[-0.03em] ${
                        dark ? 'text-white' : 'text-brand-700'
                    }`}
                >
                    {site.nameShort}
                </span>
                <span
                    className={`mt-1 hidden whitespace-nowrap text-[0.6rem] font-semibold uppercase leading-none tracking-[0.03em] sm:block ${
                        dark ? 'text-white/80' : 'text-ink-soft'
                    }`}
                >
                    {site.name}
                </span>
            </span>
        </Link>
    );
}
