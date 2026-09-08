import { Link } from '@inertiajs/react';
import Container from '@/Components/Container';
import Seo from '@/Components/Seo';
import PageHero from '@/Components/PageHero';

interface Sibling {
    title: string;
    slug: string;
    active: boolean;
}

export default function Show({
    page,
    siblings = [],
}: {
    page: { title: string; body: string | null; cover: string | null };
    siblings?: Sibling[];
}) {
    return (
        <>
            <Seo title={page.title} description={page.body || undefined} image={page.cover} type="article" />
            <PageHero
                eyebrow="Мэдээлэл"
                title={page.title}
                image={page.cover}
                crumbs={[{ label: 'Нүүр', href: '/' }, { label: page.title }]}
            />
            <section className="bg-white">
                <Container className="py-14">
                    <div className={siblings.length > 0 ? 'grid gap-10 lg:grid-cols-[16rem_1fr]' : ''}>
                        {siblings.length > 0 && (
                            <aside className="order-2 lg:order-1">
                                <div className="lg:sticky lg:top-28">
                                    <div className="mb-3 flex items-center gap-3">
                                        <h2 className="m-0 text-base font-bold text-ink">Холбоотой хуудас</h2>
                                        <span className="h-px flex-1 bg-black/10" />
                                    </div>
                                    <ul className="flex flex-col gap-1">
                                        {siblings.map((s) => (
                                            <li key={s.slug}>
                                                <Link
                                                    href={`/${s.slug}`}
                                                    className={`block rounded-lg px-3 py-2 text-[0.8rem] transition-colors ${
                                                        s.active
                                                            ? 'bg-brand-600 font-semibold text-white'
                                                            : 'text-slate-600 hover:bg-brand-50 hover:text-brand-700'
                                                    }`}
                                                >
                                                    {s.title}
                                                </Link>
                                            </li>
                                        ))}
                                    </ul>
                                </div>
                            </aside>
                        )}

                        <div className="order-1 lg:order-2">
                            <article
                                className="prose-cms max-w-3xl"
                                dangerouslySetInnerHTML={{ __html: page.body || '' }}
                            />
                        </div>
                    </div>
                </Container>
            </section>
        </>
    );
}
