import { Link } from '@inertiajs/react';
import type { ReactNode } from 'react';

export default function SectionHeading({
    children,
    action,
    eyebrow,
    size = 'md',
}: {
    children: ReactNode;
    action?: { label: string; href: string };
    eyebrow?: string;
    size?: 'sm' | 'md' | 'lg';
}) {
    const text = size === 'lg' ? 'text-2xl md:text-[1.75rem]' : size === 'sm' ? 'text-lg md:text-xl' : 'text-xl md:text-[1.55rem]';
    return (
        <div className="mb-7">
            {eyebrow && <span className="eyebrow mb-2">{eyebrow}</span>}
            <div className="flex items-end gap-5">
                <h2 className={`m-0 shrink-0 font-bold leading-tight text-ink ${text}`}>{children}</h2>
                <span className="mb-1.5 h-px flex-1 bg-line" />
                {action && (
                    <Link
                        href={action.href}
                        className="mb-0.5 shrink-0 whitespace-nowrap text-[0.68rem] font-bold uppercase tracking-wide text-brand-600 transition-colors hover:text-accent dark:text-brand-300"
                    >
                        {action.label} <i className="bi bi-arrow-right" />
                    </Link>
                )}
            </div>
        </div>
    );
}
