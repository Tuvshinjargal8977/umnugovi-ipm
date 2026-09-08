import { Link } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import type { PostCard as PostT, ProjectCard as ProjectT } from '@/types';
import Container from '@/Components/Container';
import Seo from '@/Components/Seo';
import SectionHeading from '@/Components/SectionHeading';
import ProjectCard from '@/Components/ProjectCard';
import { ButtonLink } from '@/Components/Button';
import { catVisual } from '@/lib/catVisual';

interface Slide extends ProjectT {
    bg: string;
}

interface Featured extends ProjectT {
    summary: string | null;
    info_meeting_at: string | null;
}

const SECTION_LABELS: Record<string, string> = {
    pre_assessment: 'Урьдчилсан үнэлгээ хийгдсэн төслүүд',
    under_study: 'Судлагдаж буй төслүүд',
    ongoing: 'Хэрэгжиж буй төслүүд',
};

export default function Home({
    slides,
    featured,
    news,
    sections,
    stats,
}: {
    slides: Slide[];
    featured: Featured | null;
    news: PostT[];
    sections: Record<string, ProjectT[]>;
    stats: { projects: number; preAssessed: number; categories: number };
}) {
    const [active, setActive] = useState(0);

    useEffect(() => {
        if (slides.length < 2) return;
        const t = setInterval(() => setActive((i) => (i + 1) % slides.length), 6000);
        return () => clearInterval(t);
    }, [slides.length]);

    return (
        <>
            <Seo />

            {/* HERO */}
            {slides.length > 0 && (
                <section className="relative isolate h-[30rem] overflow-hidden bg-brand-950 md:h-[36rem]">
                    {slides.map((s, i) => (
                        <div
                            key={s.slug}
                            className={`absolute inset-0 transition-opacity duration-[900ms] ${
                                i === active ? 'opacity-100' : 'opacity-0'
                            }`}
                        >
                            <img
                                src={s.bg}
                                alt=""
                                loading={i === 0 ? 'eager' : 'lazy'}
                                className={`absolute inset-0 h-full w-full object-cover transition-transform duration-[8000ms] ease-out ${
                                    i === active ? 'scale-110' : 'scale-100'
                                }`}
                            />
                            <div className="absolute inset-0 bg-gradient-to-t from-brand-950 via-brand-950/70 to-brand-900/40" />
                            <div className="absolute inset-0 bg-gradient-to-r from-brand-950/85 to-transparent" />
                        </div>
                    ))}

                    <Container className="relative flex h-full items-end pb-16 md:items-center md:pb-0">
                        <div className="flex max-w-3xl flex-col gap-5">
                            <span className="eyebrow text-accent-soft">Түншлэлийн төсөл</span>
                            <div className="flex items-center gap-2">
                                <span className="rounded-full bg-accent px-3 py-1 text-[0.6rem] font-bold uppercase tracking-wider text-white">
                                    {slides[active].status_label}
                                </span>
                            </div>
                            <h2 className="text-[1.7rem] font-bold uppercase leading-[1.15] text-white md:text-[2.2rem]">
                                {slides[active].title}
                            </h2>
                            <div className="flex flex-wrap gap-3">
                                <ButtonLink href={`/projects/${slides[active].slug}`} variant="primary">
                                    Дэлгэрэнгүй <i className="bi bi-arrow-right" />
                                </ButtonLink>
                                <ButtonLink href="/projects" variant="white">
                                    Бүх төсөл
                                </ButtonLink>
                            </div>
                        </div>
                    </Container>

                    <div className="absolute inset-x-0 bottom-6 z-10">
                        <Container className="flex gap-2">
                            {slides.map((_, i) => (
                                <button
                                    key={i}
                                    onClick={() => setActive(i)}
                                    aria-label={`Слайд ${i + 1}`}
                                    className="group flex-1 py-2"
                                >
                                    <span
                                        className={`block h-0.5 rounded-full transition-all ${
                                            i === active ? 'bg-accent' : 'bg-white/25 group-hover:bg-white/50'
                                        }`}
                                    />
                                </button>
                            ))}
                        </Container>
                    </div>
                </section>
            )}

            {/* TAGLINE STRIP */}
            <section className="border-b border-black/5 bg-brand-950 text-white">
                <Container className="flex flex-wrap items-center justify-center gap-x-4 gap-y-1 py-3.5 text-center text-[0.66rem] font-bold uppercase tracking-wider sm:text-[0.74rem]">
                    {['Нэг байршил', 'Нэгдсэн төлөвлөлт', 'Дэд бүтэц', 'Аюулгүй орчин', 'Олон төрлийн худалдаа, үйлчилгээ'].map(
                        (t, i) => (
                            <span key={t} className="flex items-center gap-4">
                                {i > 0 && <span className="text-accent">+</span>}
                                {t}
                            </span>
                        ),
                    )}
                </Container>
            </section>

            {/* STATS */}
            <section className="bg-white">
                <Container className="grid grid-cols-3 divide-x divide-black/5 py-10 text-center">
                    {[
                        { n: stats.projects, l: 'Батлагдсан төсөл' },
                        { n: stats.preAssessed, l: 'Урьдчилсан үнэлгээтэй' },
                        { n: stats.categories, l: 'Салбар чиглэл' },
                    ].map((s) => (
                        <div key={s.l} className="px-2">
                            <div className="text-3xl font-black text-brand-700 md:text-4xl">{s.n}</div>
                            <div className="mt-1 text-[0.7rem] font-semibold uppercase tracking-wide text-ink-soft">{s.l}</div>
                        </div>
                    ))}
                </Container>
            </section>

            {/* FEATURED */}
            {featured && <FeaturedProject p={featured} />}

            {/* NEWS */}
            {news.length > 0 && (
                <section className="bg-slate-50">
                    <Container className="py-14">
                        <SectionHeading eyebrow="Мэдээ" action={{ label: 'Бүгд', href: '/posts' }}>
                            Мэдээ мэдээлэл
                        </SectionHeading>
                        <div className="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                            {news.map((p) => (
                                <Link
                                    key={p.slug}
                                    href={`/posts/${p.slug}`}
                                    className="group flex h-full flex-col overflow-hidden rounded-card bg-white ring-1 ring-black/[0.06] transition-all duration-200 hover:-translate-y-1 hover:ring-brand-500/40 hover:shadow-[0_1rem_2.5rem_-0.5rem_rgba(20,49,90,0.18)]"
                                >
                                    <div className="aspect-[16/10] overflow-hidden bg-slate-100">
                                        <img
                                            src={p.cover || '/images/placeholder.svg'}
                                            alt={p.cover ? p.title : ''}
                                            loading="lazy"
                                            className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="flex flex-1 flex-col gap-2 p-4">
                                        <span className="text-[0.66rem] font-medium uppercase tracking-wide text-accent">
                                            {p.published_at}
                                        </span>
                                        <span className="font-bold leading-snug text-ink line-clamp-3 transition-colors group-hover:text-brand-700">
                                            {p.title}
                                        </span>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    </Container>
                </section>
            )}

            {/* PROJECT SECTIONS */}
            {Object.entries(sections).map(([key, items], idx) =>
                items.length === 0 ? null : (
                    <section key={key} className={idx % 2 === 1 ? 'bg-slate-50' : 'bg-white'}>
                        <Container className="py-14">
                            <SectionHeading
                                eyebrow={idx === 0 ? 'Төслүүд' : undefined}
                                action={{ label: 'Бүгдийг харах', href: '/projects' }}
                            >
                                {SECTION_LABELS[key]}
                            </SectionHeading>
                            <div className="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                {items.slice(0, 4).map((p) => (
                                    <ProjectCard key={p.slug} project={p} />
                                ))}
                            </div>
                        </Container>
                    </section>
                ),
            )}

            {/* PARTNERS */}
            <section className="border-t border-black/5 bg-white">
                <Container className="py-14">
                    <SectionHeading eyebrow="Хамтын ажиллагаа" size="sm">
                        Хамтрагч байгууллагууд
                    </SectionHeading>
                    <div className="grid grid-cols-2 gap-3 md:grid-cols-4">
                        {['Азийн хөгжлийн банк', 'Дэлхийн банк', 'НҮБ-ын хөгжлийн хөтөлбөр', 'Эдийн засаг, хөгжлийн яам'].map((p) => (
                            <div
                                key={p}
                                className="flex h-20 items-center justify-center rounded-card bg-slate-50 p-3 text-center text-[0.78rem] font-bold text-slate-400 ring-1 ring-black/[0.04]"
                            >
                                {p}
                            </div>
                        ))}
                    </div>
                </Container>
            </section>
        </>
    );
}

function FeaturedProject({ p }: { p: Featured }) {
    const v = catVisual(p.category?.slug);
    return (
        <section className="bg-slate-50">
            <Container className="py-14">
                <SectionHeading eyebrow="Онцлох" size="sm">
                    Санал авч буй төсөл
                </SectionHeading>
                <Link
                    href={`/projects/${p.slug}`}
                    className="group grid overflow-hidden rounded-card bg-white ring-1 ring-black/[0.06] transition-all hover:ring-brand-500/40 hover:shadow-[0_1.5rem_3rem_-0.75rem_rgba(20,49,90,0.2)] md:grid-cols-2"
                >
                    <div
                        className="relative flex min-h-[14rem] items-center justify-center overflow-hidden"
                        style={{ background: `linear-gradient(135deg, ${v.from}, ${v.to})` }}
                    >
                        {p.cover ? (
                            <img
                                src={p.cover}
                                alt=""
                                className="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            />
                        ) : (
                            <i className={`bi ${v.icon} text-7xl text-white/20`} />
                        )}
                        <span className="absolute left-4 top-4 rounded-full bg-white/95 px-3 py-1 text-[0.6rem] font-bold uppercase tracking-wider text-brand-700">
                            {p.status_label}
                        </span>
                    </div>
                    <div className="flex flex-col gap-3 p-6 md:p-8">
                        {p.category && (
                            <span className="text-[0.66rem] font-bold uppercase tracking-wide text-accent">{p.category.name}</span>
                        )}
                        <h3 className="text-lg font-bold leading-snug text-ink transition-colors group-hover:text-brand-700 md:text-xl">
                            {p.title}
                        </h3>
                        {p.summary && <p className="text-[0.82rem] leading-relaxed text-ink-soft line-clamp-4">{p.summary}</p>}
                        <div className="mt-2 flex flex-wrap gap-x-6 gap-y-2 text-[0.75rem] text-ink-soft">
                            {p.proposal_deadline && (
                                <span className="flex items-center gap-1.5">
                                    <i className="bi bi-calendar-event text-accent" /> Санал авах: {p.proposal_deadline}
                                </span>
                            )}
                            {p.info_meeting_at && (
                                <span className="flex items-center gap-1.5">
                                    <i className="bi bi-people text-accent" /> Уулзалт: {p.info_meeting_at}
                                </span>
                            )}
                        </div>
                        <span className="mt-3 inline-flex items-center gap-2 text-[0.72rem] font-bold uppercase tracking-wide text-brand-600">
                            Дэлгэрэнгүй <i className="bi bi-arrow-right transition-transform group-hover:translate-x-1" />
                        </span>
                    </div>
                </Link>
            </Container>
        </section>
    );
}
