import { Link } from '@inertiajs/react';
import type { ProjectCard as T } from '@/types';
import { catVisual } from '@/lib/catVisual';

export default function ProjectCard({ project }: { project: T }) {
    const v = catVisual(project.category?.slug);

    return (
        <Link
            href={`/projects/${project.slug}`}
            className="group relative flex h-full flex-col overflow-hidden rounded-card bg-white ring-1 ring-black/[0.06] transition-all duration-200 hover:-translate-y-1 hover:ring-brand-500/40 hover:shadow-[0_1rem_2.5rem_-0.5rem_rgba(20,49,90,0.18)]"
        >
            <div className="relative aspect-[16/10] overflow-hidden">
                {project.cover ? (
                    <img
                        src={project.cover}
                        alt={project.title}
                        loading="lazy"
                        className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                    />
                ) : (
                    <div
                        className="flex h-full w-full items-center justify-center"
                        style={{ background: `linear-gradient(135deg, ${v.from}, ${v.to})` }}
                    >
                        <i className={`bi ${v.icon} text-5xl text-white/25 transition-transform duration-500 group-hover:scale-110`} />
                    </div>
                )}
                <span className="absolute left-3 top-3 rounded-full bg-brand-950/85 px-2.5 py-1 text-[0.58rem] font-bold uppercase tracking-wider text-white backdrop-blur">
                    {project.status_label}
                </span>
            </div>
            <div className="flex flex-1 flex-col gap-2 p-4">
                {project.category && (
                    <span className="text-[0.62rem] font-bold uppercase tracking-wide text-accent">{project.category.name}</span>
                )}
                <span className="font-bold leading-snug text-ink line-clamp-3 transition-colors group-hover:text-brand-700">
                    {project.title}
                </span>
                {project.proposal_deadline && (
                    <span className="mt-auto flex items-center gap-1.5 text-[0.7rem] text-ink-soft">
                        <i className="bi bi-calendar-event text-accent" />
                        Санал авах: {project.proposal_deadline}
                    </span>
                )}
            </div>
            <span className="h-0.5 w-0 bg-accent transition-all duration-300 group-hover:w-full" />
        </Link>
    );
}
