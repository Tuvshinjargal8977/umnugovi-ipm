import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';
import type { SharedProps } from '@/types';

/**
 * Emblem + IPM mark + Mongolian organisation name.
 * Falls back to a gradient icon if the emblem image is missing.
 */
export default function Brand({ variant = 'header' }: { variant?: 'header' | 'footer' }) {
    const { site } = usePage<SharedProps>().props;
    const [emblemOk, setEmblemOk] = useState(true);
    const [markOk, setMarkOk] = useState(true);

    const dark = variant === 'footer';
    const emblemH = variant === 'header' ? 'h-14' : 'h-14';
    const markH = 'h-8';

    return (
        <Link href="/" className={`flex items-center gap-3 ${variant === 'header' ? 'mr-auto' : ''}`} aria-label={site.name}>
            {emblemOk ? (
                <img src={site.emblem} onError={() => setEmblemOk(false)} alt="" className={`${emblemH} w-auto shrink-0`} />
            ) : (
                <span
                    className={`flex ${emblemH} aspect-square shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-brand-900 to-brand-500 text-lg text-white`}
                >
                    <i className="bi bi-diagram-3-fill" />
                </span>
            )}

            <span className="flex flex-col gap-0.5 leading-none">
                {markOk ? (
                    <img
                        src="/images/ipm-mark.svg"
                        onError={() => setMarkOk(false)}
                        alt={site.nameShort}
                        className={`${markH} w-auto ${dark ? 'brightness-0 invert' : ''}`}
                    />
                ) : (
                    <span className={`text-2xl font-black tracking-tight ${dark ? 'text-white' : 'text-brand-700'}`}>
                        {site.nameShort}
                    </span>
                )}
                <span
                    className={`hidden max-w-[15rem] text-[0.62rem] font-semibold uppercase leading-tight tracking-tight sm:block ${
                        dark ? 'text-white/80' : 'text-ink-soft'
                    }`}
                >
                    Өмнөговь аймгийн төслийн удирдлагын газар
                </span>
            </span>
        </Link>
    );
}
