import { Link } from '@inertiajs/react';
import type { ComponentProps, ReactNode } from 'react';

const styles = {
    primary: 'bg-brand-600 text-white border border-brand-600 hover:bg-brand-700 hover:border-brand-700',
    accent: 'bg-accent text-white border border-accent hover:brightness-95',
    ghost: 'bg-transparent text-ink border border-line hover:border-brand-600 hover:text-link',
    white: 'bg-white text-brand-700 border border-white hover:bg-brand-50',
};

const base =
    'inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-[0.72rem] font-bold uppercase tracking-wide transition-all duration-200';

type Variant = keyof typeof styles;

export function ButtonLink({
    href,
    variant = 'primary',
    className = '',
    children,
    ...rest
}: { href: string; variant?: Variant; className?: string; children: ReactNode } & Omit<ComponentProps<typeof Link>, 'href'>) {
    const external = /^https?:\/\//.test(href) || href.startsWith('mailto:') || href.startsWith('tel:') || href.startsWith('#');
    if (external) {
        return (
            <a href={href} className={`${base} ${styles[variant]} ${className}`}>
                {children}
            </a>
        );
    }
    return (
        <Link href={href} className={`${base} ${styles[variant]} ${className}`} {...rest}>
            {children}
        </Link>
    );
}

export function Button({
    variant = 'primary',
    className = '',
    children,
    ...rest
}: { variant?: Variant; className?: string; children: ReactNode } & ComponentProps<'button'>) {
    return (
        <button className={`${base} ${styles[variant]} ${className} disabled:opacity-60`} {...rest}>
            {children}
        </button>
    );
}
