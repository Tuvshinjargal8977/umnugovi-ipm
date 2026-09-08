import { Head, Link, router } from '@inertiajs/react';
import type { Paginated, ProjectCard as ProjectT } from '@/types';
import Container from '@/Components/Container';
import PageHero from '@/Components/PageHero';
import ProjectCard from '@/Components/ProjectCard';
import ProjectStages from '@/Components/ProjectStages';
import Pagination from '@/Components/Pagination';

interface Cat {
    name: string;
    slug: string;
    count: number;
}

export default function Index({
    projects,
    categories,
    active,
    activeStatus,
    statusOptions,
}: {
    projects: Paginated<ProjectT>;
    categories: Cat[];
    active: string | null;
    activeStatus: string | null;
    statusOptions: Record<string, string>;
}) {
    const go = (params: Record<string, string | null>) => {
        const q: Record<string, string> = {};
        if (active && !('category' in params)) q.category = active;
        if (activeStatus && !('status' in params)) q.status = activeStatus;
        Object.entries(params).forEach(([k, val]) => {
            if (val) q[k] = val;
        });
        router.get('/projects', q, { preserveScroll: true, preserveState: true });
    };

    return (
        <>
            <Head title="Төслүүд" />
            <PageHero
                eyebrow="Түншлэлийн төслүүд"
                title="Өмнөговь аймагт төр, хувийн хэвшлийн түншлэлээр хэрэгжүүлэх төслүүд"
                crumbs={[{ label: 'Нүүр', href: '/' }, { label: 'Төслүүд' }]}
            />

            <ProjectStages />

            <section className="bg-white">
                <Container className="py-14">
                    {/* status pills */}
                    <div className="mb-4 flex flex-wrap gap-2">
                        <Pill onClick={() => go({ status: null })} on={!activeStatus}>
                            Бүх явц
                        </Pill>
                        {Object.entries(statusOptions).map(([k, label]) => (
                            <Pill key={k} onClick={() => go({ status: k })} on={activeStatus === k}>
                                {label}
                            </Pill>
                        ))}
                    </div>

                    {/* category filter */}
                    {categories.length > 0 && (
                        <div className="mb-8 flex flex-wrap gap-2 border-t border-black/5 pt-4">
                            <Pill onClick={() => go({ category: null })} on={!active}>
                                Бүх салбар
                            </Pill>
                            {categories.map((c) => (
                                <Pill key={c.slug} onClick={() => go({ category: c.slug })} on={active === c.slug}>
                                    {c.name} <span className="opacity-60">{c.count}</span>
                                </Pill>
                            ))}
                        </div>
                    )}

                    {projects.data.length === 0 ? (
                        <p className="py-10 text-center text-ink-soft">Тохирох төсөл олдсонгүй.</p>
                    ) : (
                        <>
                            <div className="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                {projects.data.map((p) => (
                                    <ProjectCard key={p.slug} project={p} />
                                ))}
                            </div>
                            <Pagination links={projects.links} />
                        </>
                    )}
                </Container>
            </section>
        </>
    );
}

function Pill({ children, on, onClick }: { children: React.ReactNode; on: boolean; onClick: () => void }) {
    return (
        <button
            onClick={onClick}
            className={`rounded-full px-3.5 py-1.5 text-[0.72rem] font-semibold transition-colors ${
                on ? 'bg-brand-600 text-white' : 'bg-slate-100 text-ink-soft hover:bg-brand-50 hover:text-brand-700'
            }`}
        >
            {children}
        </button>
    );
}
