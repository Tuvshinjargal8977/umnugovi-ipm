import { Link, router, usePage } from '@inertiajs/react';
import { useState } from 'react';
import type { PostCard as PostT, ProjectCard as ProjectT, SharedProps } from '@/types';
import Container from '@/Components/Container';
import Seo from '@/Components/Seo';
import PageHero from '@/Components/PageHero';
import SectionHeading from '@/Components/SectionHeading';
import ProjectCard from '@/Components/ProjectCard';

export default function Search({
    q,
    projects,
    posts,
    total,
}: {
    q: string;
    projects: ProjectT[];
    posts: PostT[];
    total: number;
}) {
    const [term, setTerm] = useState(q);
    const { locale } = usePage<SharedProps>().props;
    const en = locale === 'en';

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        router.get('/search', { q: term }, { preserveState: false });
    };

    return (
        <>
            <Seo title={q ? `"${q}" — ${en ? 'search' : 'хайлт'}` : en ? 'Search' : 'Хайлт'} noindex />
            <PageHero
                title={en ? 'Search' : 'Хайлт'}
                crumbs={[{ label: en ? 'Home' : 'Нүүр', href: '/' }, { label: en ? 'Search' : 'Хайлт' }]}
            >
                <form onSubmit={submit} className="mt-2 flex max-w-xl overflow-hidden rounded-md bg-white">
                    <input
                        value={term}
                        onChange={(e) => setTerm(e.target.value)}
                        placeholder={en ? 'Type your search term' : 'Хайх үгээ бичнэ үү'}
                        className="w-full bg-white px-4 py-3 text-[0.85rem] text-slate-800 outline-none placeholder:text-slate-400"
                        autoFocus
                    />
                    <button type="submit" aria-label={en ? 'Search' : 'Хайх'} className="bg-white px-4 text-brand-600">
                        <i className="bi bi-search" />
                    </button>
                </form>
            </PageHero>

            <section className="bg-surface">
                <Container className="py-12">
                    {q.length < 2 ? (
                        <p className="text-ink-soft">
                            {en ? 'Enter at least 2 characters to search.' : 'Хайх үгээ дор хаяж 2 тэмдэгт оруулна уу.'}
                        </p>
                    ) : (
                        <>
                            <p className="mb-6 text-ink-soft">
                                <strong>"{q}"</strong> — {en ? 'found' : 'нийт'} <strong>{total}</strong>{' '}
                                {en ? 'results' : 'илэрц олдлоо'}.
                            </p>

                            {total === 0 && (
                                <p className="text-ink-soft">
                                    {en
                                        ? 'No results found. Try a different search term.'
                                        : 'Илэрц олдсонгүй. Өөр түлхүүр үг ашиглаж үзнэ үү.'}
                                </p>
                            )}

                            {projects.length > 0 && (
                                <div className="mb-10">
                                    <SectionHeading size="sm">
                                        {en ? 'Projects' : 'Төслүүд'} ({projects.length})
                                    </SectionHeading>
                                    <div className="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                                        {projects.map((p) => (
                                            <ProjectCard key={p.slug} project={p} />
                                        ))}
                                    </div>
                                </div>
                            )}

                            {posts.length > 0 && (
                                <div>
                                    <SectionHeading size="sm">
                                        {en ? 'News' : 'Мэдээ мэдээлэл'} ({posts.length})
                                    </SectionHeading>
                                    <ul className="flex flex-col divide-y divide-line">
                                        {posts.map((p) => (
                                            <li key={p.slug} className="py-3">
                                                <div className="flex flex-wrap gap-3 text-[0.7rem] text-ink-soft">
                                                    <span>
                                                        <i className="bi bi-calendar3 mr-1" />
                                                        {p.published_at}
                                                    </span>
                                                    {p.category && (
                                                        <span>
                                                            <i className="bi bi-folder mr-1" />
                                                            {p.category.name}
                                                        </span>
                                                    )}
                                                </div>
                                                <Link href={`/posts/${p.slug}`} className="block font-bold text-ink hover:text-link">
                                                    {p.title}
                                                </Link>
                                                {p.excerpt && (
                                                    <span className="text-[0.78rem] text-ink-soft line-clamp-2">{p.excerpt}</span>
                                                )}
                                            </li>
                                        ))}
                                    </ul>
                                </div>
                            )}
                        </>
                    )}
                </Container>
            </section>
        </>
    );
}
