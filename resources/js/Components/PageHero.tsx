import { Link, usePage } from '@inertiajs/react';
import type { SharedProps } from '@/types';
import Container from './Container';

export interface Crumb {
    label: string;
    href?: string;
}

export default function PageHero({
    title,
    crumbs = [],
    image,
    eyebrow,
    children,
}: {
    title: string;
    crumbs?: Crumb[];
    image?: string | null;
    eyebrow?: string;
    children?: React.ReactNode;
}) {
    const { site } = usePage<SharedProps>().props;
    const bg = image || site.heroImage;

    return (
        <section className="relative isolate overflow-hidden bg-brand-950">
            <img src={bg} alt="" className="absolute inset-0 -z-10 h-full w-full object-cover" />
            <div className="absolute inset-0 -z-10 bg-gradient-to-t from-brand-950 via-brand-950/75 to-brand-900/50" />
            <div className="absolute inset-0 -z-10 bg-gradient-to-r from-brand-950/80 to-transparent" />
            <Container className="flex min-h-[14rem] flex-col justify-end gap-3 py-10 md:min-h-[19rem] md:py-14">
                {eyebrow && <span className="eyebrow text-accent-soft">{eyebrow}</span>}
                <h1 className="max-w-4xl text-[1.5rem] font-bold leading-[1.2] text-white md:text-[2rem]">{title}</h1>
                {crumbs.length > 0 && (
                    <nav
                        aria-label="breadcrumb"
                        className="flex flex-wrap items-center gap-2 text-[0.62rem] font-semibold uppercase tracking-wide text-white/70"
                    >
                        {crumbs.map((c, i) => (
                            <span key={i} className="flex items-center gap-2">
                                {i > 0 && <span className="text-white/40">/</span>}
                                {c.href ? (
                                    <Link href={c.href} className="transition-colors hover:text-white">
                                        {c.label}
                                    </Link>
                                ) : (
                                    <span className="text-white">{c.label}</span>
                                )}
                            </span>
                        ))}
                    </nav>
                )}
                {children}
            </Container>
        </section>
    );
}
